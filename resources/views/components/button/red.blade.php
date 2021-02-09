<x-button {{ $attributes->merge([
    'class' => 'bg-red-400 hover:bg-red-500 rounded-lg'
]) }}>{{ $slot }}</x-button>
