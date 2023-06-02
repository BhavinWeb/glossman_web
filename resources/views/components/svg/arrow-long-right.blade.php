@props([
    'width' => 24,
    'height' => 24,
    'fill' => 'none',
    'stroke' => '#191C1F',
    'strokewidth' => 1.5,
])

<svg width="{{ $width }}" height="{{ $height }}" viewBox="0 0 24 24" fill="{{ $fill }}"
    xmlns="http://www.w3.org/2000/svg">
    <path d="M3.75 12H20.25" stroke="{{ $stroke }}" stroke-width="{{ $strokewidth }}" stroke-linecap="round"
        stroke-linejoin="round" />
    <path d="M13.5 5.25L20.25 12L13.5 18.75" stroke="{{ $stroke }}" stroke-width="{{ $strokewidth }}"
        stroke-linecap="round" stroke-linejoin="round" />
</svg>