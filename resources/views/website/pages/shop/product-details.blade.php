@extends('website.layouts.app')

@section('meta')
    @php
    $data = metaData('home');
    @endphp

    <meta name="title" content="{{ $product->title }}">
    <meta name="description" content="{!! $product->description ?? $product->title !!}">

    <meta property="og:image" content="{{ $product->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $product->title }}">
    <meta property="og:url" content="{{ route('website.product.detail', $product->slug) }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{!! $product->description ?? $product->title !!}">

    <meta name=twitter:card content=summary_large_image />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('website.product.detail', $product->slug) }}" />
    <meta name=twitter:title content="{{ $product->title }}" />
    <meta name=twitter:description content="{!! $product->description ?? $product->title !!}" />
    <meta name=twitter:image content="{{ $product->image_url }}" />
@endsection

@section('title', $product->title)

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <a class="d-flex align-items-center text-gray-600" href="{{ route('website.product') }}">
            {{ __('shop') }}
        </a>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ $product->title }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Product Detail Section Start -->
    <div class="product-detail-section">
        <div class="container">
            <div class="product-detail-section__slider">
                <div class="product-detail-slider">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="slider-area">
                                <div class="product-slider--03">
                                    <div class="single-slider">
                                        <img width="515" height="440" class="object-fit-cover"
                                            src="{{ $product->image_url }}" alt="mac">
                                    </div>
                                    @foreach ($product->galleries as $gallery)
                                        <div class="single-slider">
                                            <img width="515px" height="440px" class="object-fit-cover"
                                                src="{{ $gallery->image_url }}" alt="mac">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="silde-wrap">
                                    <div class="product-slider--03__nav">
                                        <div class="single-slide">
                                            <div class="small-prduct">
                                                <img height="95px" width="95px" class="object-fit-cover"
                                                    src="{{ $product->image_url }}" alt="product">
                                            </div>
                                        </div>
                                        @foreach ($product->galleries as $gallery)
                                            <div class="single-slide">
                                                <div class="small-prduct">
                                                    <img height="95px" width="95px" class="object-fit-cover"
                                                        src="{{ $gallery->image_url }}" alt="product">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="product-slider--03__control-buttons">
                                        <button class="button button--prev">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20.25 12H3.75" stroke="white" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M10.5 5.25L3.75 12L10.5 18.75" stroke="white" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                        <button class="button button--next">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3.75 12H20.25" stroke="white" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M13.5 5.25L20.25 12L13.5 18.75" stroke="white" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="slider-content">
                                <div class="slider-content__ratting">
                                    <ul>
                                        @php
                                            $leftValue = 5 - $product->avg_rating;
                                        @endphp
                                        @for ($i = 0; $i < $product->avg_rating; $i++)
                                            <li>
                                                <x-svg.star height="14" width="14" />
                                            </li>
                                        @endfor
                                        @if ($leftValue > 0)
                                            @for ($i = 0; $i < $leftValue; $i++)
                                                <li>
                                                    <x-svg.null-star />
                                                </li>
                                            @endfor
                                        @endif

                                        <li class="rating-text">{{ $product->avg_rating }} {{ __('star_rating') }}
                                        </li>
                                        <li class="feedback-text">({{ $product->total_rated }}
                                            {{ __('user_feedback') }})</li>
                                    </ul>
                                </div>
                                <div class="slider-content__title">
                                    <h6>{{ $product->title }}</h6>
                                </div>
                                <div class="slider-content__fact">
                                    <ul>
                                        <li>{{ __('sku') }}: <span>{{ $product->sku }}</span></li>
                                        <li>{{ __('availability') }}:
                                            @if ($product->stock > 0)
                                                <span class="stock">{{ __('in_stock') }}</span>
                                            @else
                                                <span class="stock-out">{{ __('out_of_stock') }}</span>
                                            @endif
                                        </li>
                                        <li>{{ __('brand') }}: <span>{{ $product->brand->name }}</span></li>
                                        <li>{{ __('category') }}: <span>{{ $product->category->name }}</span></li>
                                    </ul>
                                </div>
                                <div class="slider-content__price-block">
                                    <div class="price">
                                        @if ($product->sale_price)
                                            <span>{{ multiCurrency($product->sale_price) }}</span>
                                            <del>{{ multiCurrency($product->price) }}</del>
                                        @else
                                            <span>{{ multiCurrency($product->price) }}</span>
                                        @endif
                                    </div>
                                    {{-- Badge --}}
                                    <x-frontend.shop.product-detail-badge :product="$product" />
                                </div>
                                <form action="{{ route('website.single.cart.quantity.update') }}" method="post"
                                    id="detail-quantity-form">
                                    @csrf
                                    <div class="slider-content__form">
                                        @foreach ($product_attributes as $attributes)
                                            @if ($attributes[0]->attribute->frontend_type == 'select')
                                                <div class="slider-content__form--storage">
                                                    <h6 class="title">{{ $attributes[0]->attribute->name }}</h6>
                                                    <div class="selectbox">
                                                        <select class="nice-select" name="value_id[]">
                                                            @foreach ($attributes as $attribute)
                                                                <option value="{{ $attribute->value_id }}">
                                                                    {{ ucwords($attribute->value) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="slider-content__form--color">
                                                    <h6 class="title">{{ $attributes[0]->attribute->name }}</h6>
                                                    <div>
                                                        @foreach ($attributes as $attribute)
                                                            <div class="form-check">
                                                                <input name="value_id[]"
                                                                    value="{{ $attribute->value_id }}"
                                                                    class="form-check-input " type="radio"
                                                                    name="flexRadioDefault" checked>
                                                                {{ ucwords($attribute->value) }}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    @if ($product->stock > 0)
                                        <div class="slider-content__button-group">
                                            <input type="text" name="id" value="{{ $product->id }}" hidden>
                                            <div class="product-quantity-count">
                                                <button type="button" class="button-count"
                                                    onclick="decrement_quantiity()">
                                                    <x-svg.minus />
                                                </button>
                                                <input name="quantity" type="number" class="number-product"
                                                    value="{{ $item_quantity }}" id="product-details-quantity">
                                                <button type="button" class="button-count"
                                                    onclick="increment_quantiity()">
                                                    <x-svg.plus />
                                                </button>
                                            </div>

                                            <div class="product-add-button">
                                                <button onclick="$('#detail-quantity-form').submit()"
                                                    class="btn btn-primary">
                                                    @if ($product->stock > 0)
                                                        {{ __('add_to_cart') }}
                                                        <x-svg.cart width="25" height="24" stroke="white" />
                                                    @else
                                                        {{ __('out_of_stock') }}
                                                    @endif
                                                </button>
                                            </div>
                                            <div class="product-buy-button">
                                                <a class="btn btn-outline-primary"
                                                    href="{{ route('website.buy.now', $product->id) }}">{{ __('buy_now') }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </form>
                                <div class="slider-content__content">
                                    <div class="content-one">
                                        <a href="javascript:void(0)"
                                            @if (auth()->check()) onclick="AddToFavorite('{{ $product->id }}')" @endif
                                            class="wishlist {{ auth()->check() ? '' : 'login_required' }}">
                                            <x-svg.love id="svg{{ $product->id }}" width="24" height="24"
                                                fill="none" stroke="#475156" :fill="$product->wishlisted ? '#000' : 'none'" />
                                            {{ __('add_to_wishlist') }}
                                        </a>
                                        @php
                                            $compares = session()->get('compares') ? session()->get('compares') : [];
                                        @endphp
                                        <a href="javascript:void(0)"
                                            @if (($key = array_search($product->id, $compares)) !== false) style="color:var(--bs-primary-500)" @endif
                                            onclick="AddToCompare('{{ $product->id }}')">
                                            @if (($key = array_search($product->id, $compares)) !== false)
                                                <x-svg.sync stroke="var(--bs-primary-500)" />
                                            @else
                                                <x-svg.sync />
                                            @endif
                                            {{ __('add_to_compare') }}
                                        </a>
                                    </div>
                                    <div class="content-two">
                                        <ul>
                                            <li class="text">{{ __('share_product') }}:</li>
                                            <li class="copy">
                                                <a href="javascript:void(0)" onclick="copyToClipboard()">
                                                    <x-svg.copy />
                                                </a>
                                            </li>
                                            <li class="fb">
                                                <a href="{{ socialMediaShareLinks(url()->current(), 'facebook') }}">
                                                    <x-svg.facebook-circle />
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ socialMediaShareLinks(url()->current(), 'twitter') }}">
                                                    <x-svg.twitter-circle />
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ socialMediaShareLinks(url()->current(), 'pinterest') }}">
                                                    <x-svg.pinterest-circle />
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="slider-content__payment-method">
                                    <p>100% {{ __('guaranted_safe_checkout') }}</p>
                                    <img src="{{ $cms->payment_methods_logo }}" alt="payment-method.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Detail Section End -->
    <!-- Product Information Section Start -->
    <div class="product-information">
        <div class="container">
            <div class="product-information__tab">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        @if ($product->long_description)
                            <button class="nav-link {{ $product->long_description ? 'active' : '' }}"
                                id="nav-description-tab" data-bs-toggle="tab" data-bs-target="#nav-description"
                                type="button" role="tab" aria-controls="nav-description"
                                aria-selected="true">{{ __('description') }}</button>
                        @endif
                        @if ($product->additional_information)
                            <button
                                class="nav-link {{ !$product->long_description && $product->additional_information ? 'active' : '' }}"
                                id="nav-information-tab" data-bs-toggle="tab" data-bs-target="#nav-information"
                                type="button" role="tab" aria-controls="nav-information"
                                aria-selected="false">{{ __('additional_information') }}</button>
                        @endif
                        @if ($product->specification)
                            <button
                                class="nav-link {{ !$product->long_description && !$product->additional_information && $product->specification ? 'active' : '' }}"
                                id="nav-specification-tab" data-bs-toggle="tab" data-bs-target="#nav-specification"
                                type="button" role="tab" aria-controls="nav-specification"
                                aria-selected="false">{{ __('specification') }}</button>
                        @endif
                        <button
                            class="nav-link {{ !$product->long_description && !$product->additional_information && !$product->specification ? 'active' : '' }}"
                            id="nav-review-tab" data-bs-toggle="tab" data-bs-target="#nav-review" type="button"
                            role="tab" aria-controls="nav-review"
                            aria-selected="false">{{ __('review') }}</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    @if ($product->long_description)
                        <div class="tab-pane fade {{ $product->long_description ? 'show active' : '' }}"
                            id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
                            <div class="information-content">
                                {!! $product->long_description !!}
                            </div>
                        </div>
                    @endif
                    @if ($product->additional_information)
                        <div class="tab-pane fade {{ !$product->long_description && $product->additional_information ? 'show active' : '' }}"
                            id="nav-information" role="tabpanel" aria-labelledby="nav-information-tab">
                            <div class="information-content">
                                {!! $product->additional_information !!}
                            </div>
                        </div>
                    @endif
                    @if ($product->specification)
                        <div class="tab-pane fade {{ !$product->long_description && !$product->additional_information && $product->specification ? 'show active' : '' }}"
                            id="nav-specification" role="tabpanel" aria-labelledby="nav-specification-tab">
                            <div class="information-content">
                                {!! $product->specification !!}
                            </div>
                        </div>
                    @endif
                    <div class="tab-pane fade {{ !$product->long_description && !$product->additional_information && !$product->specification ? 'show active' : '' }}"
                        id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                        <div class="review-content">
                            <div class="review-content__rating">
                                <div class="customer-rating">
                                    <h6 class="title">{{ $product->avg_rating }}</h6>
                                    <div class="star">
                                        @php
                                            $leftValue = 5 - $product->avg_rating;
                                        @endphp
                                        @for ($i = 0; $i < $product->avg_rating; $i++)
                                            <x-svg.star height="18" width="18" />
                                        @endfor
                                        @if ($leftValue > 0)
                                            @for ($i = 0; $i < $leftValue; $i++)
                                                <x-svg.null-star />
                                            @endfor
                                        @endif
                                    </div>
                                    <p class="text">{{ __('customer_rating') }} <span
                                            class="count text-gray-700 fw-normal">({{ $product->total_rated }})</span>
                                    </p>
                                </div>
                                <div class="rating-graph w-100">
                                    <div class="rating-bar">
                                        <div class="rating-bar__item">
                                            <div class="star">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i>
                                                        <x-svg.star />
                                                    </i>
                                                @endfor
                                            </div>
                                            <div class="rating-bar">
                                                <div class="rating-per"
                                                    style="max-width: {{ $rating['star_percentage'][5] }}%"></div>
                                            </div>
                                            <div class="rating-bar-count">
                                                <h6>{{ $rating['star_percentage'][5] }}%<span>({{ $rating['star_count'][5] }})</span>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="rating-bar__item">
                                            <div class="star">
                                                @for ($i = 0; $i < 4; $i++)
                                                    <i>
                                                        <x-svg.star />
                                                    </i>
                                                @endfor
                                                <i>
                                                    <x-svg.null-star />
                                                </i>
                                            </div>
                                            <div class="rating-bar">
                                                <div class="rating-per"
                                                    style="max-width: {{ $rating['star_percentage'][4] }}%"></div>
                                            </div>
                                            <div class="rating-bar-count">
                                                <h6>{{ $rating['star_percentage'][4] }}%<span>({{ $rating['star_count'][4] }})</span>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="rating-bar__item">
                                            <div class="star">
                                                @for ($i = 0; $i < 3; $i++)
                                                    <i>
                                                        <x-svg.star />
                                                    </i>
                                                @endfor
                                                @for ($i = 0; $i < 2; $i++)
                                                    <i>
                                                        <x-svg.null-star />
                                                    </i>
                                                @endfor
                                            </div>
                                            <div class="rating-bar">
                                                <div class="rating-per"
                                                    style="max-width: {{ $rating['star_percentage'][3] }}%"></div>
                                            </div>
                                            <div class="rating-bar-count">
                                                <h6>{{ $rating['star_percentage'][3] }}%<span>({{ $rating['star_count'][3] }})</span>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="rating-bar__item">
                                            <div class="star">
                                                @for ($i = 0; $i < 2; $i++)
                                                    <i>
                                                        <x-svg.star />
                                                    </i>
                                                @endfor
                                                @for ($i = 0; $i < 3; $i++)
                                                    <i>
                                                        <x-svg.null-star />
                                                    </i>
                                                @endfor
                                            </div>
                                            <div class="rating-bar">
                                                <div class="rating-per"
                                                    style="max-width: {{ $rating['star_percentage'][2] }}%"></div>
                                            </div>
                                            <div class="rating-bar-count">
                                                <h6>{{ $rating['star_percentage'][2] }}%<span>({{ $rating['star_count'][2] }})</span>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="rating-bar__item">
                                            <div class="star">
                                                <i>
                                                    <x-svg.star />
                                                </i>
                                                @for ($i = 0; $i < 4; $i++)
                                                    <i>
                                                        <x-svg.null-star />
                                                    </i>
                                                @endfor
                                            </div>
                                            <div class="rating-bar">
                                                <div class="rating-per"
                                                    style="max-width: {{ $rating['star_percentage'][1] }}%"></div>
                                            </div>
                                            <div class="rating-bar-count">
                                                <h6>{{ $rating['star_percentage'][1] }}%<span>({{ $rating['star_count'][1] }})</span>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (count($product->reviews))
                                <div class="review-content__feedback"></div>
                                <div class="comment-block-02">
                                    <h6 class="title">{{ __('customer_feedback') }}</h6>
                                    <div class="comment-block-02__wrapper">
                                        @foreach ($product->reviews as $review)
                                            @if ($review->status)
                                                <div class="comment-area">
                                                    <div class="comment-area__wrapper">
                                                        <div class="avatar">
                                                            <img src="{{ $review->user->image_url }}" alt="avatar">
                                                        </div>
                                                        <div class="content">
                                                            <div class="content__doc">
                                                                <h6 class="name">
                                                                    {{ $review->user->full_name }}</h6>
                                                                <span class="dot"></span>
                                                                <p class="time">
                                                                    {{ Carbon\Carbon::parse($review->created_at)->format('d F, Y H:i A') }}
                                                                </p>
                                                            </div>
                                                            <div class="content__rating">
                                                                @for ($i = 0; $i < $review->stars; $i++)
                                                                    <x-svg.star />
                                                                @endfor
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="text">{{ $review->comment }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Product Information Section End -->
    <!-- Product Section Three Start -->
    <x-frontend.home.product-highlight :trending-products="$trending_products" :latest-products="$latest_products" :top-rated-products="$top_rated_products" :best-sale-products="$best_sale_products" />
    <!-- Product Section Three End -->
@endsection

@section('frontend_scripts')
    <script>
        function increment_quantiity() {
            var inputQuantityElement = $("#product-details-quantity");
            var newQuantity = parseInt($(inputQuantityElement).val()) + 1;
            $(inputQuantityElement).val(newQuantity);
        }

        var currentProduct = {!! $product->id !!};
        var oldItems = JSON.parse(localStorage.getItem('CompareData')) || [];
        for (var index = 0; index < oldItems.length; ++index) {
            var data = JSON.parse(oldItems[index]);
            if (data.id == currentProduct) {
                $('#comparedsvg').removeClass('d-none');
                $('#comparesvg').addClass('d-none');
                $('#compareButton').css({
                    color: "var(--bs-primary-500)"
                });
                break;
            }
        }

        function decrement_quantiity() {
            var inputQuantityElement = $("#product-details-quantity");

            if ($(inputQuantityElement).val() > 1) {
                var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
                $(inputQuantityElement).val(newQuantity);
            }
        }

        function copyToClipboard() {
            let temp = $("<input>");
            $("body").append(temp);
            temp.val(window.location).select();
            document.execCommand("copy");
            temp.remove();
            alert("Copied to clipboard!");
        }
    </script>
@endsection
