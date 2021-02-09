@props(['rating', 'name' => null])

<div class="mx-3 my-3 col-span-1" style="max-width: 96px">
    <div class="w-24 h-36 mb-1 bg-white rounded-2xl flex items-center justify-center text-gray-900 text-opacity-75 text-5xl">
        <span>{{ $rating }}</span>
    </div>

    <div class="text-center">{{ $name }}</div>
</div>
