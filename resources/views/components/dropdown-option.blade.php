@props(['avtive' => false])
@php
    $classes = 'text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9 hover:bg-gray-100'
@endphp
<li {{ $attributes(['class' => $classes]) }} id="listbox-option-0"
    role="option">
    {{ $slot }}
</li>