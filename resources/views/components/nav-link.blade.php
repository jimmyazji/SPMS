@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-4 border-gray-100 text-md font-semibold leading-5 text-white focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-md font-semibold leading-5 text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-gray-white focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
