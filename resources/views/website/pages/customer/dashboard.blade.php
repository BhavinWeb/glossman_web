@extends('website.layouts.app')

@section('title', __('dashboard'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('dashboard') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Content Body Start -->
    <div class="dasboard-body">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="dasboard-body__side-nav">
                        <div class="dasboard-body__side-nav--desk d-none d-xl-block">
                            <x-frontend.customer.side-bar />
                        </div>
                        <!--✯✯✯✯✯ CUSTOMER MOBILE SIDEBAR START ✯✯✯✯✯-->
                        <x-frontend.customer.mobile-side-bar />
                        <!--✯✯✯✯✯ CUSTOMER MOBILE SIDEBAR END ✯✯✯✯✯-->
                    </div>
                </div>
                <div class="col-xl-9 col-lg-12">
                    <div class="dasboard-body__content">
                        <div class="dasboard-info">
                            <x-frontend.customer.dashboard.others :billing="$billing_address" :totalorders="$total_orders" :pendingorders="$pending_orders"
                                :completedorders="$completed_orders" />
                        </div>
                        @if ($orders->count())
                            <div class="recent-order-info">
                                <div class="recent-order-block">
                                    <x-frontend.customer.order-history.orders :orders="$orders" />
                                </div>
                            </div>
                        @endif
                        @if ($products->count())
                            <div class="dasboard-body__content--slider">
                                <x-frontend.customer.dashboard.recent-ordered-products :products="$products" />
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Body End -->
@endsection
