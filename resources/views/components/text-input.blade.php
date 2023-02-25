@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-greenButtons focus:ring-greenButtons rounded-md shadow-lg']) !!}>
