@props([
    'wishlists' => $wishlists,
])

<div class="wishlist-body__wrapper--table">
    <table>
        <thead>
            <tr>
                <th scope="col">{{ __('products') }}</th>
                <th scope="col">{{ __('price') }}</th>
                <th scope="col">{{ __('stock_status') }}</th>
                <th scope="col">{{ __('actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wishlists as $wishlist)
                <tr id="wishlisttr{{ $wishlist->id }}">
                    <td class="products" data-label="Products">
                        <span class="product-wrapper">
                            <img src="{{ $wishlist->image_url }}" alt="wishlist">
                            <span class="text">
                                <a
                                    href="{{ route('website.product.detail', $wishlist->slug) }}">{{ $wishlist->title }}</a>
                            </span>
                        </span>
                    </td>
                    <td class="price" data-label="Price">
                        <span class="price-wraper">
                            <del class="del-price text-14 text-gray-400">
                                {{ multiCurrency($wishlist->sale_price) }}
                            </del>
                            <span class="main-price text-14 text-gray-900">
                                {{ multiCurrency($wishlist->price) }}
                            </span>
                        </span>
                    </td>
                    <td class="stock-status" data-label="Stock Status">
                        <span class="{{ $wishlist->stock != 0 ? 'text-success-500' : 'text-danger-500' }}">
                            {{ $wishlist->stock != 0 ? __('in_stock') : __('out_of_stock') }}
                        </span>
                    </td>
                    <td class="actions" data-label="Actions">
                        <span class="button-wrappr">
                            <button type="button"
                                @if ($wishlist->stock != 0) onclick="AddToCart('{{ $wishlist->id }}')" @endif
                                class="btn btn-primary {{ $wishlist->stock != 0 ? '' : 'disable' }}">
                                {{ __('add_to_cart') }}
                                <x-svg.cart width="24" height="24" />
                            </button>
                            <button type="button"
                                onclick="removeFavorite('{{ $loop->index }}','{{ $wishlist->id }}')"
                                class="close-btn">
                                <x-svg.close-circle width="24" height="24" />
                            </button>
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
