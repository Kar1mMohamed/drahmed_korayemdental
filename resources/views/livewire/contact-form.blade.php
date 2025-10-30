<form wire:submit="submit" class="space-y-6 animate-fade-in-up">
    @if($successMessage)
        <div class="p-4 bg-accent/20 border border-accent text-foreground">
            {{ $successMessage }}
        </div>
    @endif

    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label for="name" class="block text-sm font-medium mb-2">Name</label>
            <input type="text" wire:model="name" id="name" class="w-full px-4 py-3 bg-secondary border border-border text-foreground focus:outline-none focus:ring-2 focus:ring-accent">
            @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="phone" class="block text-sm font-medium mb-2">Phone</label>
            <input type="tel" wire:model="phone" id="phone" class="w-full px-4 py-3 bg-secondary border border-border text-foreground focus:outline-none focus:ring-2 focus:ring-accent">
            @error('phone') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>
    </div>

    <div>
        <label for="email" class="block text-sm font-medium mb-2">Email</label>
        <input type="email" wire:model="email" id="email" class="w-full px-4 py-3 bg-secondary border border-border text-foreground focus:outline-none focus:ring-2 focus:ring-accent">
        @error('email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="message" class="block text-sm font-medium mb-2">Message</label>
        <textarea wire:model="message" id="message" rows="5" class="w-full px-4 py-3 bg-secondary border border-border text-foreground focus:outline-none focus:ring-2 focus:ring-accent"></textarea>
        @error('message') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="btn-hero w-full transition-all duration-300" wire:loading.attr="disabled" wire:loading.class="opacity-70 cursor-not-allowed">
        <span wire:loading.remove wire:target="submit">Send Message</span>
        <span wire:loading wire:target="submit" class="inline-flex items-center justify-center gap-3">
            <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" fill="none"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            <span>Sending...</span>
        </span>
    </button>
</form>
