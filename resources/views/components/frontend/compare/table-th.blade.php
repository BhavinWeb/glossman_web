@props([
    'product' => null,
])

<th class="w-25">
    <div class="big-product-card-02">
        <div onclick="AddToCompare('{{ $product->id }}')" class="close-button">
            <button type="button" class="close-btn">
                <x-svg.close-circle />
            </button>
        </div>
        <div class="image">
            <img src="{{ $product->image_url }}" alt="product" class="w-100">
        </div>
        <div class="content">
            <p><a href="{{ route('website.product.detail', $product->slug) }}">{{ $product->title }}</a></p>
        </div>
        <div class="add-button">
            <button class=" btn btn-primary" onclick="AddToCart('{{ $product->id }}')">
                {{ __('add_to_cart') }}
                <x-svg.cart width="20" height="20" />
            </button>
            <button type="button"
                @if (auth()->check()) onclick="AddToFavorite('{{ $product->id }}')" @endif
                class="wishlist-button {{ auth()->check() ? '' : 'login_required' }}">
                <x-svg.love id="svg{{ $product->id }}" width="24" height="24" fill="none" stroke="#475156" />
            </button>
        </div>
    </div>
</th>
