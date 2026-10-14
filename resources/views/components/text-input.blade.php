@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-2 border-amber-500 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-200 focus:border-amber-500 focus:ring-amber-500 rounded-xl shadow-sm']) }}>
