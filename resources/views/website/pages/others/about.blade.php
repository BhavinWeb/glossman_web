@extends('website.layouts.app')

@section('meta')
    @php
    $data = metaData('about');
    @endphp

    <meta name="title" content="{{ $data->title }}">
    <meta name="description" content="{{ $data->description }}">

    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:url" content="{{ route('website.about') }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $data->description }}">

    <meta name=twitter:card content=summary_large_image />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('website.about') }}" />
    <meta name=twitter:title content="{{ $data->title }}" />
    <meta name=twitter:description content="{{ $data->description }}" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection

@section('title', __('about_us'))

@section('website-content')
    <!-- Content Section Start -->
    <div class="about-content">
        <div class="container">
            <div class="row">
                <div class="col-xxl-6 col-lg-6 col-md-8 col-xs-10 offset-xxl-1 order-lg-2">
                    <div class="content-image">
                        <img src="{{ asset($cms->about_brand_logo) }}" alt="about" class="w-100">
                    </div>
                </div>
                <div class="col-xxl-5 col-lg-6 order-lg-1">
                    <div class="content-area">
                        <h6 class="subtitle">{{ $cms->about_sub_title }}</h6>
                        <h2 class="title">{{ $cms->about_title }}</h2>
                        <p class="text">{!! $cms->about_description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Section End -->

    <!-- Product Section Three Start -->
    <x-frontend.home.product-highlight :trending-products="$trending_products" :latest-products="$latest_products" :top-rated-products="$top_rated_products" :best-sale-products="$best_sale_products" />
    <!-- Product Section Three End -->

    <!-- Product Section Three Start -->
    <div class="products-section-03 products-section-03__v2 pt-0">
        <div class="container">
            <div class="row card-row">
                {{-- <div class="col-xl-3 col-md-6">
                    <div class="section-title">
                        <h2 class="title">{{ __('latest_product') }}</h2>
                    </div>
                    <div class="products-section-03__widget">
                        @foreach ($latest_products as $product)
                            <x-frontend.shop.product-sm :product="$product" />
                        @endforeach
                    </div>
                </div> --}}
                {{-- <div class="col-xl-3 col-md-6">
                    <div class="section-title">
                        <h2 class="title">{{ __('top_rated_products') }}</h2>
                    </div>
                    <div class="products-section-03__widget">
                        @foreach ($top_rated_products as $product)
                            <x-frontend.shop.product-sm :product="$product" />
                        @endforeach
                    </div>
                </div> --}}
                {{-- <div class="col-xl-3 col-md-6">
                    <div class="section-title">
                        <h2 class="title">{{ __('flash_sale_today') }}</h2>
                    </div>
                    <div class="products-section-03__widget">
                        @foreach ($best_sale_products as $product)
                            <x-frontend.shop.product-sm :product="$product" />
                        @endforeach
                    </div>
                </div> --}}
                {{-- <div class="col-xl-3 col-md-6">
                    <div class="section-title">
                        <h2 class="title">{{ __('todays_deals') }}</h2>
                    </div>
                    <div class="products-section-03__widget">
                        @foreach ($todays_deals as $product)
                            <x-frontend.shop.product-sm :product="$product" />
                        @endforeach
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Product Section Three End -->
    <!-- Newsletter Section Start -->
    <x-frontend.newsletter />
    <!-- Newsletter Section End -->
@endsection
