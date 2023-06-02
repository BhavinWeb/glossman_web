@extends('website.layouts.app')

@section('title', __('checkout_success'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('checkout_success') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Content Body Start -->
    <div class="check-out-success-body">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-6 col-md-8 col-sm-10">
                    <div class="check-out-success-body__wrapper">
                        <div class="icon">
                            <x-svg.check-round />
                        </div>
                        <div class="section-title">
                            <h2 class="title pb-2 text-24 text-gray-900">{{ __('your_order_is_successfully_place') }}</h2>
                        </div>
                        <div class="button-group">
                            @if (auth('user')->check())
                                <a href="{{ route('website.customer.dashboard') }}" class="btn btn-1 btn-outline-primary">
                                    <x-svg.dashboard />
                                    {{ __('goto_dashboard') }}
                                </a>
                                <a href="{{ route('website.customer.order.detail', ['order' => $order_no]) }}"
                                    class="btn btn-2 btn-primary">
                                    {{ __('view_order') }}
                                    <x-svg.arrow-long-right stroke="white" width="20" height="20" strokewidth="2" />
                                </a>
                            @else
                                <a href="{{ route('website.track.order.detail', ['order' => $order_no]) }}"
                                    class="btn btn-2 btn-primary">
                                    {{ __('view_order') }}
                                    <x-svg.arrow-long-right stroke="white" width="20" height="20" strokewidth="2" />
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Body End -->
@endsection
