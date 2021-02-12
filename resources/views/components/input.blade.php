@props(['type' => 'text'])

<input {{ $attributes->merge([
    'class' => 'bg-transparent rounded-lg focus:ring-0 focus:outline-none outline-none border-2 focus:border-primary-500 focus:bg-opacity-10 focus:bg-white hover:bg-white hover:bg-opacity-5 transition duration-100 cursor-pointer focus:cursor-text',
])->except('text') }} type="{{ $type }}" />
