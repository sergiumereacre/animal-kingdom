@props(['disabled' => false])

<input onkeydown="limit(this)" onkeyup="limit(this)" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-greenButtons focus:ring-greenButtons rounded-lg shadow-md']) !!}>
