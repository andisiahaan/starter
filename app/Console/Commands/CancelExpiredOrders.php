<?php

namespace App\Console\Commands;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CancelExpiredOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:cancel-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel pending orders that have passed their expiration time';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $expiredOrders = Order::query()
            ->where('status', OrderStatus::PENDING)
            ->whereNotNull('expires_at')
            ->where('expires_at', '<', now())
            ->get();

        if ($expiredOrders->isEmpty()) {
            $this->info('No expired orders found.');
            return self::SUCCESS;
        }

        $count = 0;
        foreach ($expiredOrders as $order) {
            try {
                $order->markAsCancelled('Order expired - payment not received in time');
                $count++;
                
                Log::info('[CancelExpiredOrders] Order cancelled', [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'expired_at' => $order->expires_at,
                ]);
            } catch (\Throwable $e) {
                Log::error('[CancelExpiredOrders] Failed to cancel order', [
                    'order_id' => $order->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        $this->info("Cancelled {$count} expired orders.");

        return self::SUCCESS;
    }
}
