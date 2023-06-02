@extends('website.layouts.app')

@section('title', __('refund_policy'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('refund_policy') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Content Section Start -->
    <div class="about-content">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12 col-lg-12 order-lg-12">
                    <div class="content-area">
                        {!! $cms->refund_policy_page !!}
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
