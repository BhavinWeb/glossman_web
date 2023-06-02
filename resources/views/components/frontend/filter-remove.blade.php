@props([
    'name' => null,
])

<button onclick="FilterRemove('{{ $name }}')">
    <x-svg.close-circle width="20" height="20" />
</button>
