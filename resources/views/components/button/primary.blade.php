<x-button {{ $attributes->merge([
    'class' => 'bg-primary-400 hover:bg-primary-500 py-1 px-3 rounded-lg'
]) }}>{{ $slot }}</x-button>
