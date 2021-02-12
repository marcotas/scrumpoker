<div
    wire:poll="verifySelectedFeature"
    class='max-w-6xl px-8 mx-auto'
>
    <div class="pt-16 flex items-center justify-between">
        <div>
            <h1 class="text-4xl">Scrum Poker</h1>
            @if(isManager())
                <h3 class="text-xl opacity-50">You are the Manager</h3>
            @endif
            @if(participant())
                <h3 class="text-xl opacity-50">Welcome, {{ participant()->name }}</h3>
            @endif
        </div>

        <x-button class="bg-primary-500 flex items-center space-x-2 px-3 py-1 rounded-lg text-white">
            <span class="text-xl">Share</span>
            <x-icon.share class="w-5 h-5"></x-icon.share>
        </x-button>
    </div>

    <div class="grid grid-cols-12 gap-10 mt-32">
        <div class="col-span-4 space-y-3">
            <div>
                @if(isManager())
                    <form wire:submit.prevent='addNewFeature' class="relative">
                        <input
                            type="text"
                            wire:model.defer='newFeature'
                            class="rounded-full w-full bg-white bg-opacity-10 pl-3 pr-10 py-1.5 border-none focus:outline-none focus:ring-2 focus:ring-primary-500"
                            placeholder="Add new feature..."
                        />
                        <x-button type="submit" class="bg-primary-500 p-1 rounded-full absolute top-1 right-1">
                            <x-icon.plus class="w-5 h-5"></x-icon.plus>
                        </x-button>
                    </form>
                    <x-jet-input-error for="newFeature"></x-jet-input-error>
                @endif

                @if($this->completedFeatureCount > 0)
                <span class="opacity-50 text-xs cursor-pointer hover:underline" wire:click="$toggle('showCompleted')">
                    {{ $showCompleted ? 'Hide' : 'Show' }} {{ $this->completedFeatureCount }} completed features
                </span>
                @endif
            </div>

            @foreach ($this->featureList as $feature)
                <livewire:feature-list-item
                    :feature="$feature"
                    :selectedFeatureId="$selectedFeatureId"
                    :key='"room-{$room->id}-{$feature->id}-" . $selectedFeatureId ?? null'
                />
            @endforeach
        </div>

        <div class="col-span-8">
            @if($selectedFeatureId)
                <livewire:voting-feature
                    :key="$selectedFeatureId . $room->participants()->count()"
                    :selectedFeatureId="$selectedFeatureId"
                />
            @endif
        </div>
    </div>
</div>
