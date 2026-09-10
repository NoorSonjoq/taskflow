<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-lg text-red-400 border border-red-500/20 bg-red-500/10 hover:bg-red-500/20 hover:text-red-300 transition-all duration-200']) }}>
    {{ $slot }}
</button>
