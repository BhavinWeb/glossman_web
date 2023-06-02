@props([
    'price' => null,
])

<td class="price">
    <p>{{ multiCurrency($price) }}</p>
</td>
