<?php

namespace App\Livewire\App\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public Order $order;

    public function mount($order)
    {
        $this->order = Order::where('id', $order)
            ->where('user_id', Auth::id())
            ->firstOrFail();
    }

    public function checkPaymentStatus()
    {
        // Refresh order from database
        $this->order->refresh();
    }

    public function render()
    {
        $paymentDetails = $this->order->payment_details ?? [];

        return view('livewire.app.orders.show', [
            'paymentDetails' => $paymentDetails,
            'hasQrUrl' => !empty($paymentDetails['qr_url']),
            'hasPayUrl' => !empty($paymentDetails['pay_url']),
            'hasPayCode' => !empty($paymentDetails['pay_code']),
            'instructions' => $paymentDetails['instructions'] ?? [],
        ])->layout('layouts.app')->title('Order #' . $this->order->order_number);
    }
}
