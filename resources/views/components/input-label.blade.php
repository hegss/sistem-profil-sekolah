@props(['value'])

<label {{ $attributes->merge(['class' => 'absolute -top-3 left-3 font-medium text-sm text-gray-200 bg-gray-800 px-2']) }}>
    {{ $value ?? $slot }}
</label>
