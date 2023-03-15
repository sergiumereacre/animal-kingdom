<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-redButtons hover:bg-red-900 border border-transparent rounded-2xl font-semibold text-xs text-white uppercase tracking-widest shadow-lg focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
