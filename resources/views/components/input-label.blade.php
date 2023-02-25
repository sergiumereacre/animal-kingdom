@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-greenButtons']) }}>
    {{ $value ?? $slot }}
</label>
