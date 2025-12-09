<?php

namespace App\Livewire\App\Credits\Modals;

use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Services\Tripay\Transaction;
use App\Services\Tripay\TripayClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class PurchaseConfirm extends Component
{
    public ?Product $product = null;
    public ?int $paymentMethodId = null;
    public ?PaymentMethod $selectedPaymentMethod = null;

    public bool $loading = false;
    public ?string $errorMessage = null;

    protected $listeners = ['openPurchaseModal' => 'openModal'];

    public function openModal(int $productId)
    {
        $this->product = Product::find($productId);
        $this->paymentMethodId = null;
        $this->selectedPaymentMethod = null;
        $this->loading = false;
        $this->errorMessage = null;

        $this->dispatch('show-purchase-modal');
    }

    public function updatedPaymentMethodId($value)
    {
        if ($value) {
            $this->selectedPaymentMethod = PaymentMethod::find($value);
        } else {
            $this->selectedPaymentMethod = null;
        }
    }

    public function calculateTotal(): array
    {
        if (!$this->product || !$this->selectedPaymentMethod) {
            return [
                'subtotal' => 0,
                'fee' => 0,
                'total' => 0,
            ];
        }

        $subtotal = $this->product->price;
        $fee = $this->selectedPaymentMethod->calculateFee($subtotal);
        $total = $subtotal + $fee;

        return [
            'subtotal' => $subtotal,
            'fee' => $fee,
            'total' => $total,
        ];
    }

    public function purchase()
    {
        if (!$this->product || !$this->paymentMethodId) {
            $this->errorMessage = 'Please select a payment method.';
            return;
        }

        $this->loading = true;
        $this->errorMessage = null;

        $paymentMethod = PaymentMethod::find($this->paymentMethodId);
        if (!$paymentMethod) {
            $this->errorMessage = 'Payment method not found.';
            $this->loading = false;
            return;
        }

        $user = Auth::user();
        $pricing = $this->calculateTotal();

        try {
            // Create the order first
            $order = Order::create([
                'user_id' => $user->id,
                'product_id' => $this->product->id,
                'payment_method_id' => $paymentMethod->id,
                'product_name' => $this->product->name,
                'product_price' => $this->product->price,
                'credit_amount' => $this->product->total_credit,
                'payment_method_code' => $paymentMethod->code,
                'subtotal' => $pricing['subtotal'],
                'fee_amount' => $pricing['fee'],
                'total_amount' => $pricing['total'],
                'status' => 'pending',
            ]);

            // Check if provider is TRIPAY using the new provider column
            if ($paymentMethod->isTripay()) {
                // Request payment from Tripay
                $tripayResponse = $this->createTripayTransaction($order, $paymentMethod, $user);

                if (!$tripayResponse['success']) {
                    $order->update([
                        'status' => 'failed',
                        'notes' => $tripayResponse['message'] ?? 'Tripay request failed',
                    ]);
                    $this->errorMessage = $tripayResponse['message'] ?? 'Failed to create payment. Please try again.';
                    $this->loading = false;
                    return;
                }

                $paymentData = $tripayResponse['data'];

                // Update order with Tripay response
                $order->update([
                    'payment_reference' => $paymentData['reference'] ?? null,
                    'gateway_reference' => $paymentData['reference'] ?? null,
                    'payment_details' => $paymentData,
                    'expires_at' => isset($paymentData['expired_time'])
                        ? \Carbon\Carbon::createFromTimestamp($paymentData['expired_time'])
                        : null,
                ]);
            } else {
                // MANUAL payment - store payment method description
                $order->update([
                    'payment_details' => [
                        'provider' => PaymentMethod::PROVIDER_MANUAL,
                        'instructions' => $paymentMethod->description,
                        'payment_method_name' => $paymentMethod->name,
                    ],
                ]);
            }

            $this->loading = false;

            // Redirect to order detail page
            $this->dispatch('close-purchase-modal');
            $this->redirect(route('app.orders.show', $order->id), navigate: true);
        } catch (\Exception $e) {
            Log::error('Purchase error: ' . $e->getMessage(), [
                'product_id' => $this->product->id,
                'user_id' => $user->id,
                'trace' => $e->getTraceAsString(),
            ]);

            $this->errorMessage = 'An error occurred while processing your order. Please try again.';
            $this->loading = false;
        }
    }

    protected function createTripayTransaction(Order $order, PaymentMethod $paymentMethod, $user): array
    {
        try {
            $tripayClient = new TripayClient(
                baseUrl: config('services.tripay.base_url'),
                merchantCode: config('services.tripay.merchant_code'),
                apiKey: config('services.tripay.api_key'),
                privateKey: config('services.tripay.private_key')
            );
            $transaction = new Transaction($tripayClient);

            $amount = (int) $order->total_amount;

            $payload = [
                'method' => $paymentMethod->code,
                'merchant_ref' => $order->order_number,
                'amount' => $amount,
                'customer_name' => $user->name,
                'customer_email' => $user->email,
                'customer_phone' => $user->phone ?? '08000000000',
                'order_items' => [
                    [
                        'sku' => 'CREDIT-' . $order->product_id,
                        'name' => $order->product_name . ' (' . number_format($order->credit_amount) . ' Credits)',
                        'price' => $amount,
                        'quantity' => 1,
                    ]
                ],
                'callback_url' => route('api.callback.tripay'),
                'return_url' => route('app.orders.index'),
                'expired_time' => now()->addHours(24)->timestamp,
            ];

            $response = $transaction->create($payload);

            return $response;
        } catch (\Exception $e) {
            Log::error('Tripay transaction error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function closeModal()
    {
        $this->product = null;
        $this->paymentMethodId = null;
        $this->selectedPaymentMethod = null;
        $this->loading = false;
        $this->errorMessage = null;

        $this->dispatch('close-purchase-modal');
    }

    public function render()
    {
        return view('livewire.app.credits.modals.purchase-confirm', [
            'paymentMethods' => PaymentMethod::active()->get(),
            'pricing' => $this->calculateTotal(),
        ]);
    }
}
