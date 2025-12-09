<?php

namespace App\Http\Controllers\Api\Callback;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class TripayCallbackController extends Controller
{
    public function handle(Request $request)
    {
        Log::debug('Tripay callback received');

        $json = $request->getContent();
        Log::debug('Raw JSON content', ['json' => $json]);

        $data = json_decode($json);
        if (JSON_ERROR_NONE !== json_last_error()) {
            Log::error('Invalid JSON in callback');
            return Response::json([
                'success' => false,
                'message' => 'Invalid JSON',
            ]);
        }

        $merchantRef = $data->merchant_ref ?? null;
        $reference = $data->reference ?? null;
        $status = strtoupper($data->status ?? '');
        $isClosedPayment = $data->is_closed_payment ?? 0;

        Log::debug('Parsed callback data', compact('merchantRef', 'reference', 'status', 'isClosedPayment'));

        // Find order by order_number (merchant_ref) and payment_reference
        $order = Order::where('order_number', $merchantRef)
            ->where('payment_reference', $reference)
            ->first();

        if (!$order || !$reference || !$status || $isClosedPayment != 1) {
            Log::warning('Invalid or missing order callback data', compact('merchantRef', 'reference', 'status', 'isClosedPayment'));
            return Response::json([
                'success' => false,
                'message' => 'Missing or invalid data',
            ]);
        }

        // Validate signature
        $privateKey = config('tripay.private_key');
        if (!$privateKey) {
            Log::error('Private key not configured');
            return Response::json([
                'success' => false,
                'message' => 'Private key not configured',
            ]);
        }

        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $signature = hash_hmac('sha256', $json, $privateKey);

        Log::debug('Validating signature', [
            'expected' => $signature,
            'received' => $callbackSignature,
        ]);

        if ($signature !== (string) $callbackSignature) {
            Log::debug('Invalid signature');
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ], 403);
        }

        $event = $request->server('HTTP_X_CALLBACK_EVENT');
        Log::debug('Callback event received', ['event' => $event]);

        if ('payment_status' !== (string) $event) {
            Log::warning('Invalid callback event', ['event' => $event]);
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event',
            ]);
        }

        // Check if order already verified
        if ($order->status === 'verified') {
            Log::debug('Order already verified', ['order_id' => $order->id]);
            return Response::json([
                'success' => true,
                'message' => 'Order already processed',
            ]);
        }

        try {
            Log::debug('Processing order status update', ['order_id' => $order->id, 'new_status' => $status]);

            switch ($status) {
                case 'PAID':
                    // Mark as verified - this will trigger OrderObserver for credit giving
                    $order->update([
                        'status' => 'verified',
                        'verified_at' => now(),
                        'payment_details' => array_merge(
                            (array) $order->payment_details,
                            ['paid_at' => now()->toISOString(), 'callback_status' => 'PAID']
                        ),
                    ]);
                    Log::debug('Order marked as verified', ['order_id' => $order->id]);
                    break;

                case 'EXPIRED':
                    $order->update([
                        'status' => 'failed',
                        'notes' => 'Payment expired',
                        'payment_details' => array_merge(
                            (array) $order->payment_details,
                            ['expired_at' => now()->toISOString(), 'callback_status' => 'EXPIRED']
                        ),
                    ]);
                    Log::debug('Order marked as expired/failed', ['order_id' => $order->id]);
                    break;

                case 'FAILED':
                    $order->update([
                        'status' => 'failed',
                        'notes' => 'Payment failed',
                        'payment_details' => array_merge(
                            (array) $order->payment_details,
                            ['failed_at' => now()->toISOString(), 'callback_status' => 'FAILED']
                        ),
                    ]);
                    Log::debug('Order marked as failed', ['order_id' => $order->id]);
                    break;

                default:
                    Log::debug('Unsupported status in callback', ['status' => $status]);
                    return Response::json([
                        'success' => false,
                        'message' => 'Unsupported status',
                    ]);
            }

            return Response::json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Exception while processing callback', ['error' => $e->getMessage()]);
            return Response::json([
                'success' => false,
                'message' => 'Failed to process: ' . $e->getMessage(),
            ], 500);
        }
    }
}
