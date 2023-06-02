@props(['product'])

<a href="{{ route('website.product.detail', $product->slug) }}" class=" d-block single-item">
    <div class=" trending card-product card-product--04 ">
        <div class="card-image">
            <img height="80px" width="80px" src="{{ $product->image_url }}" alt="card">
        </div>
        <div class="card-body p-0">
            <h6 class="title">{{ Str::limit($product->title, 48, '...') }}</h6>
            @if ($product->sale_price)
                <del>{{ multiCurrency($product->price) }}</del>
                <span class="price">{{ multiCurrency($product->sale_price) }}</span>
            @else
                <span class="price">{{ multiCurrency($product->price) }}</span>
            @endif
        </div>
    </div>
</a>
