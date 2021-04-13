<div class="flex items-center h-screen justify-center">
    <div>
        <h1 class="text-5xl">Welcome to Scrum Poker</h1>

        <div class="flex justify-center">
            <div class="text-center mt-5">
                <x-input-cards wire:model.defer="cards"
                    class="my-4" />
                <button wire:click="createRoom"
                    class="bg-white text-3xl rounded-3xl px-16 py-8 bg-opacity-5 hover:bg-opacity-10 flex">
                    Create Room
                </button>
                {{ collect($cards)->join(', ') }}
            </div>
        </div>
    </div>
</div>
