<div>
<button {{ $attributes->merge(['class' => $type === 'secondary' ? 'btn-secondary' : 'btn-primary']) }}>
  {{ $slot }}
</button>
</div>