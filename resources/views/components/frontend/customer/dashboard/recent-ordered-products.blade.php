@props([
    'products' => [],
])
<div class="browsing-history-block">
    <div class="browsing-history-block__head">
        <h6 class="title text-uppercase">{{ __('recent_ordered_products') }}</h6>
        @if ($products->count() > 0)
            <a class="link-btn" href="{{ route('website.customer.order.history') }}">
                {{ __('view_all') }}
                <x-svg.arrow-long-right width="20" height="20" stroke="var(--bs-primary-500)" />
            </a>
        @endif
    </div>
    <div class="position-relative mt-4">

        <div class="product-slider--04">
            @foreach ($products as $product)
                <div class="single-slider">
                    <div class="card-product card-product--05 ">
                        <div class="card-image ">
                            <img src="{{ $product->product->image_url }}" alt="Image">
                        </div>
                        <div class="card-body p-0">
                            <ul class="rating">
                                @php
                                    $leftValue = 5 - $product->product->avg_rating;
                                @endphp
                                @for ($i = 0; $i < $product->product->avg_rating; $i++)
                                    <x-svg.star height="18" width="18" />
                                @endfor
                                @if ($leftValue > 0)
                                    @for ($i = 0; $i < $leftValue; $i++)
                                        <x-svg.null-star />
                                    @endfor
                                @endif
                                <li>({{ $product->product->total_rated }})</li>
                            </ul>
                            <a href="{{ route('website.product.detail', $product->product->slug) }}">
                                <h6 class="title">{{ Str::limit($product->product->title, 48, '...') }}
                                </h6>
                            </a>
                            <p class="price-valu">{{ multiCurrency($product->product->price) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="product-slider--04__control-buttons">
            <button class="button button--prev bg-white">
                <x-svg.arrow-long-left width="24" height="24" />
            </button>
            <button class="button button--next bg-white">
                <x-svg.arrow-long-right width="24" height="24" stroke="var(--bs-primary-500)" />
            </button>
        </div>
    </div>
</div>
