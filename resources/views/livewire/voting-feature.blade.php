<div class="w-full">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl opacity-50">Voting Feature</h2>

        @if(isManager())
            <div class="flex items-center space-x-1">
                <x-button.red class="p-2">
                    <x-icon.trash class="w-4 h-4"></x-icon.trash>
                </x-button.red>
                <x-button.primary>Reveal</x-button.primary>
                <x-button.green>Complete</x-button.green>
            </div>
        @endif
    </div>

    <h1 class="text-4xl mb-10">{{ $feature->name }}</h1>

    <div class="-mx-3">
        <div class="flex flex-wrap">
            @foreach ($participants as $participant)
                <x-voting-card rating="?" :name="$participant['name']" />
            @endforeach
        </div>
    </div>

    <h3 class="text-2xl mt-10 mb-3 opacity-50">Cards:</h3>

    <div class="-mx-3">
        <div class="flex flex-wrap">
            @foreach ($ratings as $rating)
                <x-voting-card :rating="$rating" />
            @endforeach
        </div>
    </div>
</div>
