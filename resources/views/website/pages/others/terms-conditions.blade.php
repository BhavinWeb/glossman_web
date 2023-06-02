@extends('website.layouts.app')

@section('meta')
    @php
    $data = metaData('terms-condition');
    @endphp

    <meta name="title" content="{{ $data->title }}">
    <meta name="description" content="{{ $data->description }}">

    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:url" content="{{ route('website.terms') }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $data->description }}">

    <meta name=twitter:card content=summary_large_image />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('website.terms') }}" />
    <meta name=twitter:title content="{{ $data->title }}" />
    <meta name=twitter:description content="{{ $data->description }}" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection

@section('title', __('terms_of_condition'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('terms_of_condition') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Content Section Start -->
    <div class="about-content">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12 col-lg-12 order-lg-12">
                    <div class="content-area">
                        {!! $cms->terms_page !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Section Three End -->
    <!-- Newsletter Section Start -->
    <x-frontend.newsletter />
    <!-- Newsletter Section End -->
@endsection
