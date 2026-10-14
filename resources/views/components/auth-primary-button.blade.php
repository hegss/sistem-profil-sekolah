<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full items-center py-2 bg-amber-600 border border-transparent rounded-xl font-semibold text-s text-white uppercase tracking-widest hover:bg-amber-700 focus:bg-amber-700 active:bg-amber-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
