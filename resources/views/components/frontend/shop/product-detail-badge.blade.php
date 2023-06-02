@props(['product'])

@if ($product->sale)
    <p class="bg-success-500 text-white badge mx-1">{{ __('sale') }}</p>
@endif

@if ($product->hot)
    <p class="bg-danger-500 text-white badge mx-1">{{ __('hot') }}</p>
@endif

@if ($product->featured)
    <p class="bg-warning-500 text-black badge mx-1">{{ __('featured') }}</p>
@endif
