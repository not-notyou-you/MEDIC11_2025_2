<button {{ $attributes->merge([
    'class' => 'border-2 border-[#048C6A] text-[#048C6A] font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-[#048C6A] hover:text-white transition duration-300 active:transform active:scale-95 active:shadow-lg active:shadow-[#048C6A]'
]) }}>
    {{ $slot }}
</button>
