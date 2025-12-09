<div>
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('app.orders.index') }}" class="inline-flex items-center text-sm text-slate-400 hover:text-white transition-colors mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Orders
            </a>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">Order #{{ $order->order_number }}</h1>
                    <p class="mt-1 text-sm text-slate-400">Created {{ $order->created_at->format('M d, Y H:i') }}</p>
                </div>
                <span class="px-3 py-1.5 rounded-full text-sm font-medium 
                    @if($order->status === 'verified') bg-green-900/30 text-green-400
                    @elseif($order->status === 'pending') bg-yellow-900/30 text-yellow-400
                    @elseif($order->status === 'failed') bg-red-900/30 text-red-400
                    @else bg-slate-700 text-slate-300
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Payment Section (2 columns) -->
            <div class="lg:col-span-2 space-y-6">
                @if($order->status === 'pending')
                <!-- Payment Info Card -->
                <div class="bg-dark-elevated rounded-2xl border border-dark-border overflow-hidden">
                    <div class="px-6 py-4 border-b border-dark-border bg-dark-soft">
                        <h2 class="text-lg font-semibold text-white">Complete Your Payment</h2>
                        @if($order->expires_at)
                        <p class="mt-1 text-sm text-slate-400">
                            Payment expires:
                            <span class="text-yellow-400 font-medium">{{ $order->expires_at->format('M d, Y H:i') }}</span>
                            <span class="text-slate-500">({{ $order->expires_at->diffForHumans() }})</span>
                        </p>
                        @endif
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- QR Code Section -->
                        @if($hasQrUrl)
                        <div class="text-center">
                            <p class="text-sm text-slate-400 mb-4">Scan QR Code to Pay</p>
                            <div class="inline-block p-4 bg-white rounded-2xl shadow-lg">
                                <img src="{{ $paymentDetails['qr_url'] }}" alt="QR Payment" class="w-64 h-64 object-contain">
                            </div>
                            @if(!empty($paymentDetails['qr_string']))
                            <p class="mt-3 text-xs text-slate-500">{{ $paymentDetails['qr_string'] }}</p>
                            @endif
                        </div>
                        @endif

                        <!-- Pay URL Button -->
                        @if($hasPayUrl)
                        <div class="text-center">
                            <a href="{{ $paymentDetails['pay_url'] }}" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all shadow-lg shadow-primary-500/25">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                Pay Now
                            </a>
                            <p class="mt-2 text-xs text-slate-500">You will be redirected to payment page</p>
                        </div>
                        @endif

                        <!-- Pay Code Section -->
                        @if($hasPayCode)
                        <div class="bg-dark-soft rounded-xl p-5 border border-dark-border">
                            <p class="text-sm text-slate-400 mb-2 text-center">Payment Code</p>
                            <div class="flex items-center justify-center gap-3">
                                <code class="px-6 py-3 bg-dark-base rounded-lg text-2xl font-mono font-bold text-primary-400 tracking-wider border border-dark-border">
                                    {{ $paymentDetails['pay_code'] }}
                                </code>
                                <button
                                    onclick="navigator.clipboard.writeText('{{ $paymentDetails['pay_code'] }}'); this.querySelector('span').textContent = 'Copied!'; setTimeout(() => this.querySelector('span').textContent = 'Copy', 2000)"
                                    class="px-4 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-medium transition-colors">
                                    <span>Copy</span>
                                </button>
                            </div>
                        </div>
                        @endif

                        <!-- Manual Payment Instructions -->
                        @if(!$hasQrUrl && !$hasPayUrl && !$hasPayCode && !empty($paymentDetails['instructions']))
                        <div class="bg-dark-soft rounded-xl p-5 border border-dark-border">
                            <h3 class="font-semibold text-white mb-3">Payment Instructions</h3>
                            <div class="prose prose-sm prose-invert max-w-none">
                                {!! nl2br(e($paymentDetails['instructions'])) !!}
                            </div>
                        </div>
                        @endif

                        <!-- Payment Method Instructions -->
                        @if(!empty($instructions))
                        <div class="space-y-4">
                            <h3 class="font-semibold text-white">How to Pay</h3>
                            @foreach($instructions as $instruction)
                            <div class="bg-dark-soft rounded-xl p-4 border border-dark-border">
                                <h4 class="font-medium text-white mb-3">{{ $instruction['title'] ?? 'Instructions' }}</h4>
                                <ol class="space-y-2">
                                    @foreach($instruction['steps'] ?? [] as $index => $step)
                                    <li class="flex gap-3 text-sm text-slate-300">
                                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-primary-900/30 text-primary-400 flex items-center justify-center text-xs font-medium">
                                            {{ $index + 1 }}
                                        </span>
                                        <span>{{ $step }}</span>
                                    </li>
                                    @endforeach
                                </ol>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Refresh Button -->
                    <div class="px-6 py-4 border-t border-dark-border bg-dark-soft">
                        <button wire:click="checkPaymentStatus" wire:loading.attr="disabled"
                            class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-dark-muted hover:bg-dark-base text-slate-300 rounded-lg transition-colors">
                            <svg wire:loading wire:target="checkPaymentStatus" class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <svg wire:loading.remove wire:target="checkPaymentStatus" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <span wire:loading.remove wire:target="checkPaymentStatus">Check Payment Status</span>
                            <span wire:loading wire:target="checkPaymentStatus">Checking...</span>
                        </button>
                    </div>
                </div>
                @endif

                <!-- Verified Success -->
                @if($order->status === 'verified')
                <div class="bg-gradient-to-br from-green-900/30 to-green-800/10 rounded-2xl border border-green-700/50 p-8 text-center">
                    <div class="w-16 h-16 mx-auto bg-green-500 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">Payment Successful!</h2>
                    <p class="text-green-400">
                        @if($order->credit_given_at)
                        {{ number_format($order->credit_amount, 0, ',', '.') }} credits have been added to your account.
                        @else
                        Your payment has been verified. Credits will be added shortly.
                        @endif
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('app.credits.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            View My Credits
                        </a>
                    </div>
                </div>
                @endif

                <!-- Failed/Cancelled -->
                @if(in_array($order->status, ['failed', 'cancelled']))
                <div class="bg-gradient-to-br from-red-900/30 to-red-800/10 rounded-2xl border border-red-700/50 p-8 text-center">
                    <div class="w-16 h-16 mx-auto bg-red-500 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">Payment {{ ucfirst($order->status) }}</h2>
                    <p class="text-red-400">
                        @if($order->notes)
                        {{ $order->notes }}
                        @else
                        Your payment could not be processed.
                        @endif
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('app.credits.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors">
                            Try Again
                        </a>
                    </div>
                </div>
                @endif
            </div>

            <!-- Order Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-dark-elevated rounded-2xl border border-dark-border overflow-hidden sticky top-24">
                    <div class="px-5 py-4 border-b border-dark-border bg-dark-soft">
                        <h3 class="font-semibold text-white">Order Summary</h3>
                    </div>
                    <div class="p-5 space-y-4">
                        <!-- Product -->
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Product</p>
                            <p class="font-medium text-white">{{ $order->product_name }}</p>
                        </div>

                        <!-- Credits -->
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Credits</p>
                            <p class="text-2xl font-bold text-primary-400">{{ number_format($order->credit_amount, 0, ',', '.') }}</p>
                        </div>

                        <!-- Payment Method -->
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Payment Method</p>
                            <p class="font-medium text-white">{{ $order->paymentMethod?->name ?? $paymentDetails['payment_name'] ?? $order->payment_method_code ?? 'N/A' }}</p>
                        </div>

                        <div class="border-t border-dark-border pt-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-400">Subtotal</span>
                                <span class="text-white">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-400">Fee</span>
                                <span class="text-white">Rp {{ number_format($order->fee_amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between pt-2 border-t border-dark-border">
                                <span class="font-medium text-white">Total</span>
                                <span class="text-xl font-bold text-primary-400">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Reference -->
                        @if($order->payment_reference)
                        <div class="pt-4 border-t border-dark-border">
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Reference</p>
                            <code class="text-xs bg-dark-soft px-2 py-1 rounded text-primary-400 break-all">{{ $order->payment_reference }}</code>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>