@extends('website.layouts.app')

@section('meta')
    @php
    $data = metaData('cart');
    @endphp

    <meta name="title" content="{{ $data->title }}">
    <meta name="description" content="{{ $data->description }}">

    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:url" content="{{ route('website.cart') }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $data->description }}">

    <meta name=twitter:card content=summary_large_image />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('website.cart') }}" />
    <meta name=twitter:title content="{{ $data->title }}" />
    <meta name=twitter:description content="{{ $data->description }}" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection

@section('title', __('shoping_cart'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('shoping_cart') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Content Body Start -->
    <div class="shopping-card-body">
        <div class="container">
            @if (count($cart_items) > 0)
                <div class="row">
                    <div class="col-lg-8">
                        <div class="shopping-card-body__wrapper">
                            <h6 class="title">{{ __('shoping_cart') }}</h6>
                            <div class="shopping-card-body__wrapper--table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('products') }}</th>
                                            <th scope="col">{{ __('price') }}</th>
                                            <th scope="col">{{ __('quantity') }}</th>
                                            <th scope="col">{{ __('subtotal') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form action="{{ route('website.cart.update.quantity') }}" method="post"
                                            id="cart-form">
                                            @csrf
                                            @foreach ($cart_items as $item)
                                                <tr>
                                                    <td class="products" data-label="Products">
                                                        <span class="product-wrapper">
                                                            <a href="{{ route('website.cart.remove', $item->id) }}"
                                                                class="close-btn">
                                                                <x-svg.close-circle />
                                                            </a>
                                                            <img src="{{ $item->attributes->image }}" alt="wishlist">
                                                            <span class="text">
                                                                <a href="{{ route('website.product.detail', $item->associatedModel->slug) }}">
                                                                    {{ $item->name }}
                                                                    @if ($item->attributes && $item->attributes->attribute)
                                                                        (<b>
                                                                            @foreach ($item->attributes->attribute as $attribute)
                                                                                {{ $attribute['attribute'] }}: {{ $attribute['value'] }}
                                                                                @if (!$loop->last),@endif
                                                                            @endforeach
                                                                        </b>)
                                                                    @endif
                                                                </a>
                                                            </span>
                                                        </span>
                                                    </td>
                                                    <td class="price" data-label="Price">
                                                        <span class="price-wraper">
                                                            @if ($item->attributes->sale_price)
                                                                <del class="del-price text-14 text-gray-400">
                                                                    {{ multiCurrency($item->attributes->price) }}
                                                                </del>
                                                                <span class="main-price text-14 text-gray-900">
                                                                    {{ multiCurrency($item->price) }}
                                                                </span>
                                                            @else
                                                                <span class="main-price text-14 text-gray-900">
                                                                    {{ multiCurrency($item->price) }}
                                                                </span>
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td class="product-quantity" data-label="Quantity">
                                                        <div class="product-quantity-count">
                                                            <input type="text" name="ids[]" value="{{ $item->id }}"
                                                                hidden>
                                                            <button type="button" class="button-count"
                                                                onclick="decrement_quantiity({{ $item->id }})">
                                                                <x-svg.minus />
                                                            </button>
                                                            <input name="quantities[]" type="number" class="number-product"
                                                                value="{{ $item->quantity }}"
                                                                id="input-quantity-{{ $item->id }}">
                                                            <button type="button" class="button-count"
                                                                onclick="increment_quantiity({{ $item->id }})">
                                                                <x-svg.plus />
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td class="sub-total" data-label="Sub-Total">
                                                        {{ multiCurrency(($item->attributes->sale_price ? $item->attributes->sale_price : $item->price) * $item->quantity) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                            <div class="shopping-card-body__wrapper--button">
                                <a class="btn btn-1 btn-outline-secondary" href="{{ route('website.product') }}">
                                    <x-svg.arrow-left />
                                    {{ __('return_to_shop') }}
                                </a>
                                <a class="btn btn-2 btn-outline-secondary" href="javascript:void(0)"
                                    onclick="$('#cart-form').submit()">{{ __('update_cart') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="shopping-card-body__card-total">
                            <div class="card-total-block">
                                <h6 class="title">{{ __('cart_totals') }}</h6>
                                <ul class="subtotal-list">
                                    <li><span class="text">{{ __('subtotal') }}</span><span
                                            class="ammount">{{ multiCurrency($subtotal) }}</span>
                                    </li>
                                    @if (isset($coupon_condition))
                                        <li><span class="text">(-){{ __('coupon') }}</span><span class="ammount">
                                                {{ multiCurrency($coupon_condition->getType() == 'Percentage' ? str_replace('-', '', (str_replace('%', '', $coupon_condition->getValue()) / 100) * $subtotal) : str_replace('-', '', $coupon_condition->getValue())) }}
                                                @if ($coupon_condition->getType() == 'Percentage')
                                                    ({{ $coupon_condition->getValue() }})
                                                @endif
                                            </span></li>
                                    @endif
                                    <li class="line"></li>
                                    <li><span class="total-text">{{ __('total') }}</span><span
                                            class="total-ammount">{{ multiCurrency($total) }}</span>
                                    </li>
                                </ul>
                                @if (auth()->check())
                                    <a href="{{ route('website.checkout') }}" class=" btn btn-primary w-100">{{ __('proceed_to_checkout') }}
                                        <x-svg.arrow-long-right />
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class=" btn btn-primary w-100">{{ __('login_and_checkout') }}
                                        <x-svg.arrow-long-right />
                                    </a>
                                    <p class="text-center my-2">{{ __('or') }}</p>
                                    <a href="{{ route('website.checkout') }}" class=" btn btn-primary w-100 mt-0">{{ __('guest_checkout') }}
                                        <x-svg.arrow-long-right />
                                    </a>
                                @endif
                            </div>
                        </div>
                        @if (!isset($coupon_condition))
                            <div class="shopping-card-body__coupon-code">
                                <div class="coupon-code-block">
                                    <h6 class="title">{{ __('coupon_code') }}</h6>
                                    <div class="coupon-code-block__form">
                                        <form action="{{ route('website.coupon.apply') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="form-control {{ error('code') }}"
                                                    placeholder="{{ __('enter_code') }}" name="code">
                                                <x-forms.error name="code" />
                                            </div>
                                            <button type="submit" class=" btn btn-secondary">{{ __('apply_code') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div>
                                <b class="title">{{ __('coupon_code') }}</b>
                            </div>
                            <form action="{{ route('website.coupon.clear') }}" method="post" class="mt-2">
                                @csrf
                                <p>{{ $coupon_condition->getAttributes()['code'] }} <a
                                        onclick="$(this).closest('form').submit();"
                                        href="javascript:void(0)">{{ __('remove') }}</a></p>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                            </form>
                        @endif
                    </div>
                </div>
            @else
                <x-frontend.not-found message="your_shopping_cart_is_empty" />
            @endif
        </div>
    </div>
    <!-- Content Body End -->
@endsection

@section('frontend_scripts')
    <script>
        function increment_quantiity(itemId) {
            var inputQuantityElement = $("#input-quantity-" + itemId);
            var newQuantity = parseInt($(inputQuantityElement).val()) + 1;
            $(inputQuantityElement).val(newQuantity);
        }

        function decrement_quantiity(itemId) {
            var inputQuantityElement = $("#input-quantity-" + itemId);

            if ($(inputQuantityElement).val() > 1) {
                var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
                $(inputQuantityElement).val(newQuantity);
            }
        }
    </script>
@endsection
