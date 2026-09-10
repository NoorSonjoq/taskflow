<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-gradient']) }}>
    <span>{{ $slot }}</span>
</button>
