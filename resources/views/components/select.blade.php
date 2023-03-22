@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-greenButtons focus:ring-greenButtons rounded-lg shadow-md']) !!}>{{ $slot }}</select>
