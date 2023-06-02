@extends('website.layouts.app')

@section('title', __('checkout'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <a class="d-flex align-items-center text-gray-600" href="{{ route('website.cart') }}">
            {{ __('shoping_cart') }}
        </a>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('checkout') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Content Body Start -->
    <div class="check-out-body">
        <div class="container">

            <div class="alert alert-primary print-error-msg d-none">
                <ul></ul>
            </div>

            @if ($errors->any())
                <div class="alert alert-primary">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('website.checkout.store') }}" method="post" id="checkout-form">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-lg-4 order-lg-2">
                        <x-frontend.checkout.order-summery :cartitems="$cart_items" :total="$total" :subtotal="$subtotal"
                            :coupon-condition="$coupon_condition" />
                    </div>
                    <div class="col-lg-8 order-lg-1">
                        <div class="check-out-body__form">

                            <x-frontend.checkout.billing-shipping :address="$address" :countries="$countries" :billingstates="$billing_states"
                                :shippingstates="$shipping_states" :billingcities="$billing_cities" :shippingcities="$shipping_cities" :billingaddress="$billing_address" :shippingaddress="$shipping_address"
                                :shippingmethods="$shipping_methods" :pickuppoints="$pickup_points" :total="$total" />

                            <x-frontend.checkout.payment-option :manual-payments="$manual_payments"/>
                            <x-frontend.checkout.order-notes />
                            <x-frontend.checkout.payment-process :total="$total" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Content Body End -->
@endsection

@section('frontend_styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .select2-results__option[aria-selected=true] {
            display: none;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            color: #fff;
            border: 1px solid #fff;
            background: #007bff;
            border-radius: 30px;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }
    </style>
@endsection

@section('frontend_scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <x-frontend.customer.settings.scripts />
    <x-frontend.customer.checkout-scripts />
@endsection
