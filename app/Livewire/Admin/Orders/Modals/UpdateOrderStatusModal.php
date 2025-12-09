<?php

namespace App\Livewire\Admin\Orders\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use App\Models\Order;

class UpdateOrderStatusModal extends ModalComponent
{
    public ?int $orderId = null;
    public ?Order $order = null;
    public string $newStatus = '';
    public string $statusNote = '';

    public array $statuses = [
        'pending' => 'Pending',
        'verified' => 'Verified',
        'failed' => 'Failed',
        'cancelled' => 'Cancelled',
    ];

    public function mount(int $orderId): void
    {
        $this->orderId = $orderId;
        $this->order = Order::findOrFail($orderId);
        $this->newStatus = $this->order->status;
    }

    public function updateStatus(): void
    {
        if (!$this->order) {
            return;
        }

        $this->validate([
            'newStatus' => 'required|in:pending,verified,failed,cancelled',
        ]);

        $oldStatus = $this->order->status;

        // Update notes if provided
        if ($this->statusNote) {
            $currentNotes = $this->order->notes ?? '';
            $newNote = "[" . now()->format('Y-m-d H:i') . "] Status changed from {$oldStatus} to {$this->newStatus}: {$this->statusNote}";
            $this->order->notes = $currentNotes ? $currentNotes . "\n" . $newNote : $newNote;
        }

        $this->order->status = $this->newStatus;

        if ($this->newStatus === 'verified' && !$this->order->verified_at) {
            $this->order->verified_at = now();
        }

        $this->order->save();

        Toast::success("Order status updated from '{$oldStatus}' to '{$this->newStatus}'.");

        $this->dispatch('refreshOrders');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('admin.livewire.orders.modals.update-order-status-modal');
    }
}
