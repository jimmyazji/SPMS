@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-4 border-gray-100 text-md font-semibold leading-5 text-white focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out px-12 transition-padding'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-md font-semibold leading-5 text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-gray-white focus:border-gray-300 transition duration-150 ease-in-out px-8 hover:px-12 focus:px-12 transition-padding first:-left-px';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
