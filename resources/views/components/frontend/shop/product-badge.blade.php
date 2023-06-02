@props(['product', 'onlyFeatured' => false])

@if ($product->stock > 0)
    @if ($onlyFeatured)
        @if ($product->featured)
            <p class="bg-warning-500 text-black badge">{{ __('featured') }}</p>
        @endif
    @else
        @if ($product->on_sale)
            <p class="bg-success-500 text-white badge">{{ __('sale') }}</p>
        @elseif ($product->hot)
            <p class="bg-danger-500 text-white badge">{{ __('hot') }}</p>
        @elseif ($product->featured)
            <p class="bg-warning-500 text-black badge">{{ __('featured') }}</p>
        @endif
    @endif
@else
    <p class="bg-danger-500 text-white badge">{{ __('stock_out') }}</p>
@endif
