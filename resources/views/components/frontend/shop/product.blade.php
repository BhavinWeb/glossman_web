@props(['product', 'class' => 'card-product--03', 'showRating' => true, 'onlyFeatured' => false, 'showbadge' => true])

<div class="card-product  {{ $class }}">
    <div class="card-image ">
        <img src="{{ $product->image_url }}" alt="card" class="mw-100">
        <div class="card-hover">
            <a href="javascript:void(0)"
                @if (auth()->check()) onclick="AddToFavorite('{{ $product->id }}')" @endif
                class="wishlist {{ auth()->check() ? '' : 'login_required' }}">
                <x-svg.love id="svg{{ $product->id }}" width="24" height="24" :fill="$product->wishlisted ? '#000' : 'none'" />
            </a>
            <a href="javascript:void(0)" class="cart"
                @if ($product->stock > 0) onclick="fetchproductAttribute({{ $product->id }})" @endif>
                <x-svg.cart />
            </a>
            @php
                $compares = session()->get('compares') ? session()->get('compares') : [];
            @endphp
            <a href="javascript:void(0)" class="view"
                @if (($key = array_search($product->id, $compares)) !== false) style="color:var(--bs-primary-500)" @endif
                onclick="AddToCompare('{{ $product->id }}')">
                @if (($key = array_search($product->id, $compares)) !== false)
                    <x-svg.sync stroke="var(--bs-primary-500)" />
                @else
                    <x-svg.sync />
                @endif
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        @if ($showbadge)
            <x-frontend.shop.product-badge :product="$product" :only-featured="$onlyFeatured" />
        @endif

        @if ($showRating)
            @php
                $leftValue = 5 - $product->avg_rating;
            @endphp
            <ul class="rating">
                @for ($i = 0; $i < $product->avg_rating; $i++)
                    <li>
                        <x-svg.star height="18" width="18" />
                    </li>
                @endfor
                @if ($leftValue > 0)
                    @for ($i = 0; $i < $leftValue; $i++)
                        <li>
                            <x-svg.null-star />
                        </li>
                    @endfor
                @endif
                <li>({{ $product->total_rated }})</li>
            </ul>
        @endif
        <a href="{{ route('website.product.detail', $product->slug) }}">
            <h6 class="title">{{ Str::limit($product->title, 48, '...') }}</h6>
        </a>
        @if ($product->sale_price)
            <p class="price-valu">
                <del>{{ multiCurrency($product->price) }}</del>
                {{ multiCurrency($product->sale_price) }}
            </p>
        @else
            <p class="price-valu">{{ multiCurrency($product->price) }}</p>
        @endif
    </div>
</div>

