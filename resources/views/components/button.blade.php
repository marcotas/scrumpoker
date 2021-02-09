<button {{ $attributes->merge([
    'class' => 'active:scale-95 transform-gpu transition-all duration-75'
]) }}>{{ $slot }}</button>
