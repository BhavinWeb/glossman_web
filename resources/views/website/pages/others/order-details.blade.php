@extends('website.layouts.app')

@section('title', __('order_details'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('order_details') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Content Body Start -->
    <div class="trackorder-details-body">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="shipping-details-wrapper">
                        <div class="shipping-details">
                            <x-frontend.customer.order-details.shipping :order="$order" />
                            <x-frontend.customer.order-details.progress :order="$order" />
                        </div>
                        @if ($activities->count() > 0)
                            <div class="order-activity-wrapper">
                                <x-frontend.customer.order-details.order-activity :activities="$activities" />
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Body End -->
@endsection
