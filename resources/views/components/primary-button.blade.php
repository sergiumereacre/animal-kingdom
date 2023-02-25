<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-greenButtons border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 shadow-lg focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-greenButtons focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
