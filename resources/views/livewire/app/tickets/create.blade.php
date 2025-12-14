<div>
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('app.tickets.index') }}" class="text-primary-400 hover:text-primary-300 text-sm flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                {{ __('tickets.create.back') }}
            </a>
        </div>

        <div class="bg-dark-elevated rounded-lg border border-dark-border p-6">
            <h1 class="text-xl font-bold text-white mb-6">{{ __('tickets.create.title') }}</h1>

            <form wire:submit="submit" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">{{ __('tickets.create.subject') }}</label>
                    <input wire:model="subject" type="text" placeholder="{{ __('tickets.create.subject_placeholder') }}" class="w-full rounded-md border-dark-border bg-dark-soft text-white placeholder-slate-500">
                    @error('subject')<span class="text-red-400 text-xs">{{ $message }}</span>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1">{{ __('tickets.create.category') }}</label>
                        <select wire:model="category" class="w-full rounded-md border-dark-border bg-dark-soft text-white">
                            @foreach($categories as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1">{{ __('tickets.create.priority') }}</label>
                        <select wire:model="priority" class="w-full rounded-md border-dark-border bg-dark-soft text-white">
                            @foreach($priorities as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">{{ __('tickets.create.description') }}</label>
                    <textarea wire:model="description" rows="6" placeholder="{{ __('tickets.create.description_placeholder') }}" class="w-full rounded-md border-dark-border bg-dark-soft text-white placeholder-slate-500"></textarea>
                    @error('description')<span class="text-red-400 text-xs">{{ $message }}</span>@enderror
                </div>

                <!-- Attachments -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">{{ __('tickets.create.attachments') }}</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-dark-border border-dashed rounded-lg cursor-pointer bg-dark-soft hover:bg-dark-muted transition">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-6 h-6 mb-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="text-xs text-slate-400">{{ __('tickets.create.attachments_hint') }}</p>
                            </div>
                            <input type="file" wire:model="attachments" multiple class="hidden" accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.doc,.docx,.txt">
                        </label>
                    </div>
                    @error('attachments.*')<span class="text-red-400 text-xs">{{ $message }}</span>@enderror
                    <p class="mt-1 text-xs text-slate-500">{{ __('tickets.create.attachments_note') }}</p>
                    
                    @if(count($attachments) > 0)
                    <div class="mt-3 space-y-2">
                        @foreach($attachments as $index => $attachment)
                        <div class="flex items-center justify-between bg-dark-soft rounded-md px-3 py-2 text-sm">
                            <span class="text-slate-300 truncate">{{ $attachment->getClientOriginalName() }}</span>
                            <button type="button" wire:click="removeAttachment({{ $index }})" class="text-red-400 hover:text-red-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="submit">{{ __('tickets.create.submit') }}</span>
                        <span wire:loading wire:target="submit">{{ __('tickets.create.submitting') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>