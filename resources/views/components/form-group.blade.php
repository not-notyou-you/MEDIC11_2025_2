@props([
    'name',
    'label',
    'type' => 'text',
    'value' => '',
    'placeholder' => null,
    'textarea' => false,
    'note' => null,
    'min' => null,
    'options' => [],
])

<div class="mb-6 px-5" id="{{ $name }}-wrapper">
    <label for="{{ $name }}" class="block text-[#048C6A] font-semibold text-sm mb-1">{{ $label }}</label>

    @if($textarea)
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            rows="4"
            placeholder="{{ $placeholder }}"
            class="w-full px-4 py-2 border-2 border-[#048C6A] rounded-lg text-[#048C6A] bg-white shadow-inner outline-none focus:ring-2 focus:ring-[#06D6A0] font-medium resize-none @error($name) border-red-500 @enderror"
        >{{ old($name, $value) }}</textarea>
    @elseif(!empty($options))
        <select
            id="{{ $name }}"
            name="{{ $name }}"
            class="w-full px-4 py-2 border-2 border-[#048C6A] rounded-lg text-[#048C6A] bg-white shadow-inner outline-none focus:ring-2 focus:ring-[#06D6A0] font-medium @error($name) border-red-500 @enderror"
        >
            <option value="" disabled selected>Pilih {{ strtolower($label) }}</option>
            @foreach($options as $optValue => $optLabel)
                <option value="{{ $optValue }}" {{ old($name) == $optValue ? 'selected' : '' }}>
                    {{ $optLabel }}
                </option>
            @endforeach
        </select>
    @else
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            @if($min !== null) min="{{ $min }}" @endif
            placeholder="{{ $placeholder }}"
            value="{{ old($name, $value) }}"
            class="w-full px-4 py-2 border-2 border-[#048C6A] rounded-lg text-[#048C6A] bg-white shadow-inner outline-none focus:ring-2 focus:ring-[#06D6A0] font-medium @error($name) border-red-500 @enderror"
        />
    @endif

    @if($note)
        <p class="text-sm text-gray-600 mt-1">{{ $note }}</p>
    @endif

    @error($name)
        <p class="text-red-500 text-sm font-semibold mt-1">{{ $message }}</p>
    @enderror
</div>
