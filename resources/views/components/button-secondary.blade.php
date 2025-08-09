<button {{ $attributes->merge([
    'class' => 'border-2 border-[#06D6A0] text-[#06D6A0] font-semibold px-4 py-2 rounded-lg shadow-glow hover:bg-[#06D6A0] hover:text-[#0a3d29] transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#06D6A0]'
]) }}>
    {{ $slot }}
</button>
