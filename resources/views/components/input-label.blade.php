@props(['value'])

<label {{ $attributes->merge(['class' => 'absolute -top-3 left-3 font-medium text-sm text-blue-950 bg-gray-100 dark:text-gray-200 dark:bg-gray-800 px-2']) }}>
    {{ $value ?? $slot }}
</label>
