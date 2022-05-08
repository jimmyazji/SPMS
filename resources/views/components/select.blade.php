@props(['disabled' => false, 'id'])

<select @error($id) {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-red-500 focus:border-red-500 focus:ring focus:ring-red-300 focus:ring-opacity-50 text-sm text-gray-800']) !!}
@else {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm text-gray-800 @if($disabled) text-gray-500 @endif']) !!} @enderror>
    {{ $slot }}
</select>