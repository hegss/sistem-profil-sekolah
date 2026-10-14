@props(['value'])

<label {{ $attributes->merge(['class' => 'absolute -top-3 left-3 font-medium text-sm text-amber-900 bg-gray-100 dark:text-amber-200 dark:bg-gray-800 px-2']) }}>
    {{ $value ?? $slot }}
</label>
