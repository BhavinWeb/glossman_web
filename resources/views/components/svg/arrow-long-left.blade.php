@props([
    'width' => 24,
    'height' => 24,
    'fill' => 'none',
    'stroke' => 'var(--bs-primary-500)',
])
<svg width="{{ $width }}" height="{{ 24 }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M20.25 12H3.75" stroke="{{ $stroke }}" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
    <path d="M10.5 5.25L3.75 12L10.5 18.75" stroke="{{ $stroke }}" stroke-width="1.5" stroke-linecap="round"
        stroke-linejoin="round"></path>
</svg>
