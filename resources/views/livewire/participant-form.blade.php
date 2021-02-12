<div class="flex items-center justify-center h-screen">
    <form wire:submit.prevent="join" class="space-y-3 w-80">
        <div>
            <x-input
                class="w-full"
                placeholder="Type your name..."
                wire:model='name'
            />
            <x-jet-input-error for="name" />
        </div>

        <x-button.primary
            type="submit"
            class="py-1.5 px-4 text-lg w-full">
            Join Room
        </x-button.primary>
    </form>
</div>
