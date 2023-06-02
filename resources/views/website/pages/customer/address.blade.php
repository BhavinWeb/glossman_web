@extends('website.layouts.app')

@section('title', __('address'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <a class="d-flex align-items-center text-gray-600" href="{{ route('website.customer.dashboard') }}">
            {{ __('dashboard') }}
        </a>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('address') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Content Body Start -->
    <div class="dasboard-body">
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
                    <div class="dasboard-body__content">
                        <div class="row card-row">
                            <div class="col-md-6">
                                <div class="shipping-details-card">
                                    <h4 class="title">{{ __('billing_address') }}</h4>
                                    @if ($billing_address)
                                        <div class="content">
                                            <h6>{{ $billing_address->full_name }}</h6>
                                            <p>{{ $billing_address->address }}</p>
                                            <ul class="list-group">
                                                <li>{{ __('phone_number') }}: <span>
                                                        {{ $billing_address->phone }}</span>
                                                </li>
                                                <li>{{ __('email') }}: <span> {{ $billing_address->email }}</span></li>
                                            </ul>
                                            <a class="btn btn-outline-secondary"
                                                href="{{ route('website.customer.setting', '#billing_setting') }}">{{ __('edit_address') }}</a>
                                        </div>
                                    @else
                                        <div class="content">
                                            <a class="btn btn-outline-secondary mt-0"
                                                href="{{ route('website.customer.setting', '#billing_setting') }}">
                                                {{ __('add_address') }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="shipping-details-card">
                                    <h4 class="title">{{ __('shipping_address') }}</h4>
                                    @if ($shipping_address)
                                        <div class="content">
                                            <h6>{{ $shipping_address->full_name }}</h6>
                                            <p>{{ $shipping_address->address }}</p>
                                            <ul class="list-group">
                                                <li>{{ __('phone_number') }}: <span>
                                                        {{ $shipping_address->phone }}</span>
                                                </li>
                                                <li>{{ __('email') }}: <span> {{ $shipping_address->email }}</span>
                                                </li>
                                            </ul>
                                            <a class="btn btn-outline-secondary"
                                                href="{{ route('website.customer.setting', '#shipping_setting') }}">
                                                {{ __('edit_address') }}
                                            </a>
                                        </div>
                                    @else
                                        <div class="content">
                                            <a class="btn btn-outline-secondary mt-0"
                                                href="{{ route('website.customer.setting', '#shipping_setting') }}">
                                                {{ __('add_address') }}
                                            </a>
                                        </div>
                                    @endif
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
