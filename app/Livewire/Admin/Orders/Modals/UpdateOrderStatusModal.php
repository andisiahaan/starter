<?php

namespace App\Livewire\Admin\Orders\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Enums\OrderStatus;
use App\Helpers\Toast;
use App\Models\Order;

class UpdateOrderStatusModal extends ModalComponent
{
    public ?int $orderId = null;
    public ?Order $order = null;
    public string $newStatus = '';
    public string $statusNote = '';

    public function mount(int $orderId): void
    {
        $this->orderId = $orderId;
        $this->order = Order::findOrFail($orderId);
        $this->newStatus = $this->order->status->value;
    }

    public function updateStatus(): void
    {
        if (!$this->order) {
            return;
        }

        // Check permission based on action
        $permission = $this->newStatus === OrderStatus::PAID->value ? 'verify-orders' : 'edit-orders';
        if (!auth()->user()->can($permission)) {
            Toast::error(__('common.messages.no_permission'));
            $this->closeModal();
            return;
        }

        $validStatuses = implode(',', OrderStatus::values());
        $this->validate([
            'newStatus' => "required|in:{$validStatuses}",
        ]);

        $oldStatus = $this->order->status;
        $newStatusEnum = OrderStatus::from($this->newStatus);

        // Update notes if provided
        if ($this->statusNote) {
            $currentNotes = $this->order->notes ?? '';
            $newNote = "[" . now()->format('Y-m-d H:i') . "] Status changed from {$oldStatus->getLabel()} to {$newStatusEnum->getLabel()}: {$this->statusNote}";
            $this->order->notes = $currentNotes ? $currentNotes . "\n" . $newNote : $newNote;
        }

        $this->order->status = $newStatusEnum;

        if ($newStatusEnum === OrderStatus::PAID && !$this->order->verified_at) {
            $this->order->verified_at = now();
        }

        $this->order->save();

        Toast::success(__('admin.orders.messages.status_updated', [
            'old' => $oldStatus->getLabel(),
            'new' => $newStatusEnum->getLabel(),
        ]));

        $this->dispatch('refreshOrders');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('admin.livewire.orders.modals.update-order-status-modal', [
            'statuses' => OrderStatus::toSelectOptions(),
        ]);
    }
}
