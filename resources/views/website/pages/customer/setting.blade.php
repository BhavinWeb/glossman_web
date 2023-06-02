@extends('website.layouts.app')

@section('title', __('settings'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <a class="d-flex align-items-center text-gray-600" href="{{ route('website.customer.dashboard') }}">
            {{ __('dashboard') }}
        </a>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('settings') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Content Body Start -->
    <div class="dasboard-setting">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="dasboard-body__side-nav">
                        <div class="dasboard-body__side-nav--desk d-none d-lg-block">
                            <x-frontend.customer.side-bar />
                        </div>
                        <!--✯✯✯✯✯ CUSTOMER MOBILE SIDEBAR START ✯✯✯✯✯-->
                        <x-frontend.customer.mobile-side-bar />
                        <!--✯✯✯✯✯ CUSTOMER MOBILE SIDEBAR END ✯✯✯✯✯-->
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="account-setting">
                        <h6 class="title">{{ __('account_setting') }}</h6>
                        <x-frontend.customer.settings.profile-info :countries="$countries" :states="$states" :cities="$cities" />
                    </div>
                    <div class="row">
                        <div class="col-lg-6" id="billing_setting">
                            <div class="address-form">
                                <h6 class="title">{{ __('billing_address') }}</h6>
                                <x-frontend.customer.settings.billing-address-update :countries="$countries" :states="$billing_states"
                                    :cities="$billing_cities" :billingaddress="$billing_address" />
                            </div>
                        </div>
                        <div class="col-lg-6" id="shipping_setting">
                            <div class="address-form">
                                <h6 class="title">{{ __('shipping_address') }}</h6>
                                <x-frontend.customer.settings.shipping-address-update :countries="$countries" :states="$shipping_states"
                                    :cities="$shipping_cities" :shippingaddress="$shipping_address" />
                            </div>
                        </div>
                    </div>
                    <div class="passwoed-change-field">
                        <h6 class="title">{{ __('change_password') }}</h6>
                        <x-frontend.customer.settings.password-update />
                    </div>
                </div>
            </div>
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
    <x-frontend.customer.settings.scripts />
@endsection
