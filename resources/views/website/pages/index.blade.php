@extends('website.layouts.app')

@section('meta')
    @php
    $data = metaData('home');
    @endphp

    <meta name="title" content="{{ $data->title }}">
    <meta name="description" content="{{ $data->description }}">

    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:url" content="{{ route('website.index') }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $data->description }}">

    <meta name=twitter:card content=summary_large_image />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('website.index') }}" />
    <meta name=twitter:title content="{{ $data->title }}" />
    <meta name=twitter:description content="{{ $data->description }}" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection

@section('title', __('home'))

@section('website-content')
    @foreach ($home_page_contents as $content)
        @if ($content->slug == 'banner')
            @include('website.pages.homepage.banner')
        @endif
        @if ($content->slug == 'application-feature')
            @include('website.pages.homepage.application-feature')
        @endif
        @if ($content->slug == 'todays-deals')
            @include('website.pages.homepage.todays-deals')
        @endif
        @if ($content->slug == 'shop-with-categories' && $categories->count())
            @include('website.pages.homepage.shop-with-categories')
        @endif
        @if ($content->slug == 'featured-products' && $featured_products->count())
            @include('website.pages.homepage.featured-products')
        @endif
        @if ($content->slug == 'offer-ads')
            @include('website.pages.homepage.offer-ads')
        @endif
        @if ($content->slug == 'custom-category' && $data['custom_category_products'])
            @include('website.pages.homepage.custom-category')
        @endif
        @if ($content->slug == 'offer-ads-2')
            @include('website.pages.homepage.offer-ads-2')
        @endif
        @if ($content->slug == 'highlight-products')
            @include('website.pages.homepage.highlight-products')
        @endif
        @if ($content->slug == 'latest-posts' && ($latest_news && $latest_news->count()))
            @include('website.pages.homepage.latest-posts')
        @endif
        @if ($content->slug == 'newsletter')
            @include('website.pages.homepage.newsletter')
        @endif
    @endforeach

    <!-- Product Attribute Modal -->
    <x-frontend.modal.product-attribute />
@endsection
