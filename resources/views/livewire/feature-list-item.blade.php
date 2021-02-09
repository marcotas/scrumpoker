<div
    @if(isManager())
        wire:click="$emit('featureSelected', {{ $feature->id }})"
    @endif
    class="
        rounded-lg group relative p-2 border-2 cursor-pointer transition-all duration-200
        @if($this->isSelectedFeature())
            opacity-100 border-primary-400 hover:border-primary-500 bg-primary-500 bg-opacity-25
        @else
            opacity-75 border-transparent hover:border-gray-700 hover:bg-white hover:bg-opacity-5
        @endif
    "
>
    <span class="
        @if($feature->isCompleted()) text-green-500 @endif
    ">{{ $feature->name }}</span>

    @if(isManager())
        <div class="absolute bottom-0 right-0 p-1.5">
            <x-button wire:click="remove" class="bg-red-400 p-1.5 rounded-full opacity-0 group-hover:opacity-100 transition duration-200">
                <x-icon.trash class="w-4 h-4"></x-icon.trash>
            </x-button>

            <x-button
                wire:click="toggleComplete"
                class="bg-green-400 p-1.5 rounded-full
                {{ $feature->isCompleted() ? 'opacity-100' : 'opacity-0' }}
                group-hover:opacity-100 transition duration-200"
            >
                <x-icon.check class="w-4 h-4"></x-icon.check>
            </x-button>
        </div>
    @endif
</div>
