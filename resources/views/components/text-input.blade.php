@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-2 border-blue-500 bg-gray-100 dark:bg-gray-300 text-gray-900 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm']) }}>
