<?php

namespace App\Observers;

use App\Enums\CreditLogType;
use App\Enums\NotificationType;
use App\Models\Order;
use App\Notifications\Admin\AdminOrderCreatedNotification;
use App\Notifications\Orders\CreditAddedNotification;
use App\Notifications\Orders\OrderCreatedNotification;
use App\Notifications\Orders\OrderStatusChangedNotification;
use App\Support\NotificationHelper;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Observer for Order model events.
 * Handles notifications and credit processing.
 */
class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        $user = $order->user;
        
        if (!$user) {
            Log::warning('[OrderObserver] Order created without user', [
                'order_id' => $order->id,
            ]);
            return;
        }

        // Check if notification type is enabled
        if (!NotificationHelper::isTypeEnabled('order.created')) {
            Log::info('[OrderObserver] Order created notification is disabled', [
                'order_id' => $order->id,
            ]);
            return;
        }

        NotificationHelper::sendAsync(
            $user,
            new OrderCreatedNotification($order)
        );
        
        // Notify admins about new order
        NotificationHelper::sendToAdmins(
            new AdminOrderCreatedNotification($order),
            NotificationType::ADMIN_ORDER_CREATED->value
        );
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        // Detect status change
        if ($order->isDirty('status')) {
            $this->handleStatusChange($order);
        }
    }

    /**
     * Handle order status change.
     */
    protected function handleStatusChange(Order $order): void
    {
        $oldStatus = $order->getOriginal('status');
        $newStatus = $order->status;

        Log::info('[OrderObserver] Order status changed', [
            'order_id' => $order->id,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
        ]);

        $user = $order->user;
        
        if (!$user) {
            Log::warning('[OrderObserver] Order updated without user', [
                'order_id' => $order->id,
            ]);
            return;
        }

        // Send status change notification
        $notificationType = match ($newStatus) {
            'paid' => 'order.paid',
            'processing' => 'order.processing',
            'completed' => 'order.completed',
            'failed', 'cancelled' => 'order.failed',
            'refunded' => 'order.refunded',
            default => null,
        };

        if ($notificationType && NotificationHelper::isTypeEnabled($notificationType)) {
            NotificationHelper::sendAsync(
                $user,
                new OrderStatusChangedNotification($order, $oldStatus, $newStatus)
            );
        }

        // Handle credit giving on verified status
        if ($newStatus === 'verified') {
            $this->processCreditGiving($order);
            $this->processReferralCommission($order);
        }
    }

    /**
     * Process referral commission for verified orders.
     */
    protected function processReferralCommission(Order $order): void
    {
        try {
            $referralService = app(\App\Services\ReferralService::class);
            $referralService->createCommissionForOrder($order);
        } catch (Throwable $e) {
            Log::error('[OrderObserver] Failed to process referral commission', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Process credit giving for verified orders.
     * Idempotent - checks credit_given_at before processing.
     */
    protected function processCreditGiving(Order $order): void
    {
        // Idempotency check - prevent double credit giving
        if ($order->credit_given_at !== null) {
            Log::info('[OrderObserver] Credit already given for order', [
                'order_id' => $order->id,
                'credit_given_at' => $order->credit_given_at,
            ]);
            return;
        }

        // Check if order has credit amount
        if ($order->credit_amount <= 0) {
            Log::info('[OrderObserver] Order has no credit amount', [
                'order_id' => $order->id,
                'credit_amount' => $order->credit_amount,
            ]);
            return;
        }

        $user = $order->user;
        
        if (!$user) {
            Log::error('[OrderObserver] Cannot give credit - user not found', [
                'order_id' => $order->id,
                'user_id' => $order->user_id,
            ]);
            return;
        }

        try {
            // Add credit to user
            $user->addCredit(
                amount: $order->credit_amount,
                type: CreditLogType::PURCHASE,
                description: "Credit from order #{$order->order_number}",
                reference: $order
            );

            // Mark credit as given using updateQuietly to prevent recursive observer calls
            $order->updateQuietly([
                'credit_given_at' => now(),
            ]);

            Log::info('[OrderObserver] Credit given successfully', [
                'order_id' => $order->id,
                'user_id' => $user->id,
                'credit_amount' => $order->credit_amount,
            ]);

            // Send credit added notification
            if (NotificationHelper::isTypeEnabled('credit.added')) {
                NotificationHelper::sendAsync(
                    $user,
                    new CreditAddedNotification($order, (float) $order->credit_amount)
                );
            }
        } catch (Throwable $e) {
            Log::error('[OrderObserver] Failed to give credit', [
                'order_id' => $order->id,
                'user_id' => $user->id,
                'credit_amount' => $order->credit_amount,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            // Do not re-throw - we don't want to break the order update
        }
    }
}
