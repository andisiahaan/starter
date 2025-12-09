<div class="p-6 space-y-8">
    {{-- Section Header --}}
    <div class="border-b border-slate-200 dark:border-dark-border pb-4">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Notification Preferences</h2>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Choose how you want to receive notifications.</p>
    </div>

    {{-- Channels Section --}}
    <div class="space-y-4">
        <h3 class="text-sm font-medium text-slate-900 dark:text-white uppercase tracking-wider">Notification Channels</h3>
        
        <div class="grid gap-4 sm:grid-cols-3">
            @foreach($channels as $channel)
                @php 
                    $channelGlobalEnabled = isset($globalSettings['channels'][$channel->value]) ? $globalSettings['channels'][$channel->value] : false;
                    $channelUserEnabled = isset($userPreferences['channels'][$channel->value]) ? $userPreferences['channels'][$channel->value] : $channel->isRequired();
                    $isPush = $channel === \App\Enums\NotificationChannel::PUSH;
                @endphp
                @if($channelGlobalEnabled || $channel->isRequired())
                <div class="p-4 rounded-lg border-2 transition-colors {{ $channelUserEnabled ? 'border-primary-500 bg-primary-50 dark:bg-primary-900/20' : 'border-slate-200 dark:border-dark-border' }}"
                     @if(!$channel->isRequired() && !$isPush) wire:click="toggleChannel('{{ $channel->value }}')" @endif
                     @class(['cursor-pointer hover:border-primary-300 dark:hover:border-primary-700' => !$channel->isRequired() && !$isPush])>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full {{ $channelUserEnabled ? 'bg-primary-100 dark:bg-primary-900/30' : 'bg-slate-100 dark:bg-dark-soft' }} flex items-center justify-center">
                                <svg class="w-5 h-5 {{ $channelUserEnabled ? 'text-primary-600 dark:text-primary-400' : 'text-slate-500 dark:text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $channel->getIcon() }}" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $channel->getLabel() }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">{{ $channel->getDescription() }}</p>
                            </div>
                        </div>
                        
                        @if($channel->isRequired())
                            <span class="px-2 py-1 text-xs font-medium text-primary-700 dark:text-primary-300 bg-primary-200 dark:bg-primary-800/50 rounded">Required</span>
                        @elseif($isPush)
                            {{-- Push channel: Toggle + Manage button --}}
                            <div class="flex items-center gap-2">
                                {{-- Toggle --}}
                                <button wire:click="toggleChannel('{{ $channel->value }}')" class="relative focus:outline-none">
                                    <div class="w-10 h-6 rounded-full transition-colors {{ $channelUserEnabled ? 'bg-primary-500' : 'bg-slate-300 dark:bg-dark-border' }}">
                                        <div class="absolute top-1 left-1 w-4 h-4 rounded-full bg-white transition-transform {{ $channelUserEnabled ? 'translate-x-4' : '' }}"></div>
                                    </div>
                                </button>
                                {{-- Manage button --}}
                                <button wire:click="$dispatch('openModal', { component: 'app.account.modals.push-subscriptions-modal' })" 
                                        class="px-2.5 py-1.5 text-xs font-medium text-slate-600 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 bg-slate-100 dark:bg-dark-soft hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>
                        @else
                            {{-- Regular toggle --}}
                            <div class="relative">
                                <div class="w-10 h-6 rounded-full transition-colors {{ $channelUserEnabled ? 'bg-primary-500' : 'bg-slate-300 dark:bg-dark-border' }}">
                                    <div class="absolute top-1 left-1 w-4 h-4 rounded-full bg-white transition-transform {{ $channelUserEnabled ? 'translate-x-4' : '' }}"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>

    {{-- Notification Types --}}
    <div class="space-y-4">
        <h3 class="text-sm font-medium text-slate-900 dark:text-white uppercase tracking-wider">Notification Types</h3>
        
        <div class="space-y-4">
            @foreach($categorizedTypes as $category)
            <div class="bg-slate-50 dark:bg-dark-soft rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
                {{-- Category Header --}}
                <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-dark-border">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $category['color']['bg'] ?? 'bg-slate-100' }}">
                            <svg class="w-4 h-4 {{ $category['color']['text'] ?? 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $category['icon'] ?? '' }}" />
                            </svg>
                        </div>
                        <span class="font-medium text-slate-900 dark:text-white">{{ $category['label'] ?? 'Unknown' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <button wire:click="enableCategory('{{ $category['key'] ?? '' }}')" class="text-xs text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">Enable all</button>
                        <span class="text-slate-300 dark:text-dark-border">|</span>
                        <button wire:click="disableCategory('{{ $category['key'] ?? '' }}')" class="text-xs text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">Disable all</button>
                    </div>
                </div>
                
                {{-- Types --}}
                <div class="divide-y divide-slate-200 dark:divide-dark-border">
                    @foreach($category['types'] ?? [] as $type)
                    <div class="flex items-center justify-between p-4 hover:bg-white dark:hover:bg-dark-elevated/50 transition-colors cursor-pointer"
                         wire:click="toggleType('{{ $type['value'] ?? '' }}')"
                         @if($type['isSecurityCritical'] ?? false) title="Security notifications cannot be disabled" @endif>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $type['label'] ?? 'Unknown' }}</p>
                                @if($type['isSecurityCritical'] ?? false)
                                    <span class="px-1.5 py-0.5 text-xs font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400 rounded">Security</span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">{{ $type['description'] ?? '' }}</p>
                        </div>
                        <div class="relative">
                            @php $typeUserEnabled = $type['userEnabled'] ?? true; @endphp
                            <div class="w-10 h-6 rounded-full transition-colors {{ $typeUserEnabled ? 'bg-primary-500' : 'bg-slate-300 dark:bg-dark-border' }}">
                                <div class="absolute top-1 left-1 w-4 h-4 rounded-full bg-white transition-transform {{ $typeUserEnabled ? 'translate-x-4' : '' }}"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
