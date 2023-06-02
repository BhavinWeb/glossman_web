@extends('website.layouts.app')

@section('title', __('order_details'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <a class="d-flex align-items-center text-gray-600" href="{{ route('website.customer.dashboard') }}">
            {{ __('dashboard') }}
        </a>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('order_details') }}</span>
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
                    <div class="shipping-details-wrapper">
                        <div class="order-details">
                            <h6>
                                <a href="{{ url()->previous() }}">
                                    <x-svg.arrow-long-left stroke="#191C1F" />
                                </a>
                                {{ __('order_details') }}

                                <span
                                    class="badge bg-{{ $order->payment_status == 'paid' ? 'secondary' : 'primary' }} mx-2">
                                    {{ $order->payment_status == 'paid' ? __('paid') : __('unpaid') }}
                                </span>
                            </h6>
                            <form action="{{ route('website.customer.order.download', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="">
                                    <x-svg.download />
                                </button>
                            </form>
                        </div>
                        <div class="shipping-details rounded-0">
                            <x-frontend.customer.order-details.shipping :order="$order" />
                            <x-frontend.customer.order-details.progress :order="$order" />
                        </div>
                        @if ($activities && count($activities))
                            <div class="order-activity-wrapper order-activity-wrapper-b-modifi">
                                <h6 class="title">{{ __('order_activity') }}</h6>
                                <x-frontend.customer.order-details.order-activity :activities="$activities" />
                            </div>
                        @endif
                        <div class="shopping-card-body__wrapper">
                            <h6 class="title t-l-r-0 t-r-r-0">
                                {{ __('product') }}
                                <span class=" text-gray-600">({{ $order->order_products_count }})</span>
                            </h6>
                            <x-frontend.customer.order-details.order-products :order="$order" />
                        </div>
                        <div class="shipping-all-details">
                            <div class="row gx-7 card-row">
                                <x-frontend.customer.order-details.address :shipping="$shipping_address" :billing="$billing_address" />
                                <div class="col-lg-4 col-md-6 col-sm-8 col-xs-10">
                                    <div class="shipping-all-details__note">
                                        <h4 class="title">{{ __('order_notes') }}</h4>
                                        <p>
                                            {{ $order->notes }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Body End -->
@endsection
