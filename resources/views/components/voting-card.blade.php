@props([
    'rating',
    'participant' => null,
    'name' => null,
])

<div x-data {{ $attributes }} class="mx-3 group relative my-3 col-span-1" style="max-width: 96px">
    <div @click="console.log('teste 2')" class="w-24 h-36 mb-1 bg-white rounded-2xl flex items-center justify-center text-gray-900 text-opacity-75 text-5xl">
        <span>{{ $rating }}</span>
    </div>

    @if($participant && isManager())
        <button
            @click="$dispatch('remove-participant', {{ $participant->id }})"
            class="flex opacity-0 group-hover:opacity-100 absolute -top-2 -right-2 rounded-full items-center justify-center p-1 bg-red-400 hover:bg-red-500 transition duration-200">
            <x-icon.x class="w-4 h-4"></x-icon.x>
        </button>
    @endif

    <div class="text-center">{{ $name }}</div>
</div>
