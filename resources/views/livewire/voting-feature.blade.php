@if($feature)
<div class="w-full" wire:poll="verifyParticipants">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl opacity-50">Voting Feature</h2>

        @if(isManager())
            <div class="flex items-center space-x-1">
                <x-button.red wire:click="remove" class="p-2">
                    <x-icon.trash class="w-4 h-4"></x-icon.trash>
                </x-button.red>
                <x-button.primary wire:click="reveal">Reveal</x-button.primary>
                <x-button.green wire:click="toggleComplete">
                    {{ $feature->isCompleted() ? 'Uncomplete' : 'Complete' }}
                </x-button.green>
            </div>
        @endif
    </div>

    <div>
        @if(isManager())
            <input
                type="text"
                class="w-full text-4xl mb-10 p-0 bg-transparent outline-none focus:outline-none ring-0 focus:ring-0 focus:border-0 border-0 cursor-pointer hover:bg-white hover:bg-opacity-5 focus:bg-white focus:bg-opacity-10 rounded-lg"
                wire:model="feature.name"
                wire:blur="saveFeature"
            />
            <x-jet-input-error for="feature.name" />
        @else
            <h1 class="text-4xl mb-10">{{ $feature->name }}</h1>
        @endif
    </div>

    <div class="-mx-3">
        <div x-data class="flex flex-wrap">
            @foreach ($this->participants as $participant)
                <x-voting-card
                    :rating="$feature->isRevealed() ? $this->voteValue($participant) : ''"
                    :participant="$participant"
                    :selected="$this->voteValue($participant)"
                    :name="$participant['name']"
                    @remove-participant="$wire.removeParticipant($event.detail)"
                />
            @endforeach
        </div>
    </div>

    @if(participant())
        <h3 class="text-2xl mt-10 mb-3 opacity-50">Cards:</h3>

        <div class="-mx-3">
            <div class="flex flex-wrap">
                @foreach ($ratings as $rating)
                    <x-voting-card
                        :rating="$rating"
                        :selected="$rating == $voted"
                        wire:click="vote('{{ $rating }}')"
                    />
                @endforeach
            </div>
        </div>
    @endif
</div>
@endif
