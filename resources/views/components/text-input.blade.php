@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-2 border-blue-500 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm']) }}>
