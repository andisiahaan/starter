<div>
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('app.tickets.index') }}" class="text-primary-400 hover:text-primary-300 text-sm flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Tickets
            </a>
        </div>

        <div class="bg-dark-elevated rounded-lg border border-dark-border p-6">
            <h1 class="text-xl font-bold text-white mb-6">Create Support Ticket</h1>

            <form wire:submit="submit" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Subject</label>
                    <input wire:model="subject" type="text" placeholder="Brief description of your issue" class="w-full rounded-md border-dark-border bg-dark-soft text-white placeholder-slate-500">
                    @error('subject')<span class="text-red-400 text-xs">{{ $message }}</span>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1">Category</label>
                        <select wire:model="category" class="w-full rounded-md border-dark-border bg-dark-soft text-white">
                            @foreach($categories as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1">Priority</label>
                        <select wire:model="priority" class="w-full rounded-md border-dark-border bg-dark-soft text-white">
                            @foreach($priorities as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Description</label>
                    <textarea wire:model="description" rows="6" placeholder="Please describe your issue in detail..." class="w-full rounded-md border-dark-border bg-dark-soft text-white placeholder-slate-500"></textarea>
                    @error('description')<span class="text-red-400 text-xs">{{ $message }}</span>@enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition">
                        Submit Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>