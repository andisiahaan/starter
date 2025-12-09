<?php

namespace App\Livewire\Admin\Orders\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Models\Order;

class OrderDetailModal extends ModalComponent
{
    public ?int $orderId = null;
    public ?Order $order = null;

    public function mount(int $orderId): void
    {
        $this->orderId = $orderId;
        $this->order = Order::with(['user', 'product', 'paymentMethod'])->findOrFail($orderId);
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function render()
    {
        return view('admin.livewire.orders.modals.order-detail-modal');
    }
}
