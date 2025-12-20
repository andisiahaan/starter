@if($enabled && ($canClaim || $hasClaimed))
<div class="lg:col-span-3" wire:key="free-credit-widget">
    @if($canClaim)
    {{-- Can Claim State --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl shadow-lg">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <circle cx="1" cy="1" r="1" fill="currentColor"/>
                    </pattern>
                </defs>
                <rect fill="url(#grid)" width="100" height="100"/>
            </svg>
        </div>
        
        <div class="relative px-6 py-5 sm:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 w-14 h-14 rounded-full bg-white/20 flex items-center justify-center animate-pulse">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-emerald-100 text-sm font-medium uppercase tracking-wide">{{ __('free_credit.title') }}</p>
                        <p class="text-white text-3xl font-bold">{{ number_format($amount, 0, ',', '.') }} <span class="text-lg font-normal">Credits</span></p>
                        <p class="text-emerald-200 text-sm mt-0.5">{{ $periodDisplay }}</p>
                    </div>
                </div>
                
                <button wire:click="claim" 
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-75 cursor-wait"
                        class="flex-shrink-0 inline-flex items-center justify-center px-6 py-3 bg-white text-emerald-600 text-sm font-semibold rounded-xl shadow-lg hover:bg-emerald-50 hover:scale-105 transition-all duration-200">
                    <span wire:loading.remove wire:target="claim">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </span>
                    <span wire:loading wire:target="claim" class="mr-2">
                        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                    <span wire:loading.remove wire:target="claim">{{ __('free_credit.claim_now') }}</span>
                    <span wire:loading wire:target="claim">{{ __('common.loading') }}</span>
                </button>
            </div>
        </div>
    </div>
    
    @else
    {{-- Already Claimed State --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-700 rounded-2xl border border-slate-200 dark:border-slate-600">
        <div class="px-6 py-5 sm:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 w-14 h-14 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                        <svg class="w-7 h-7 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium uppercase tracking-wide">{{ __('free_credit.title') }}</p>
                        <p class="text-slate-900 dark:text-white text-xl font-bold">{{ __('free_credit.already_claimed') }}</p>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mt-0.5">
                            {{ __('free_credit.claimed_at', ['date' => $claimedAt]) }}
                        </p>
                    </div>
                </div>
                
                <div class="flex-shrink-0 text-right">
                    <p class="text-emerald-600 dark:text-emerald-400 text-2xl font-bold">+{{ number_format($amount, 0, ',', '.') }}</p>
                    <p class="text-slate-500 dark:text-slate-400 text-xs">{{ $periodDisplay }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endif
