@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-greenButtons focus:ring-greenButtons rounded-lg shadow-md']) !!}>
