@props([
    'stock' => null,
])

<td class="stock-status">
    @if ($stock != 0)
        <p class="text-success-500">{{ __('in_stock') }}</p>
    @else
        <p class="text-danger-500">{{ __('out_of_stock') }}</p>
    @endif
</td>
