@extends('website.layouts.app')

@section('title', __('forget_password'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('forget_password') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Forgot Body Start -->
    <div class="forgot-body-01">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5 col-md-7 col-xs-10">
                    <div class="accout-wrapper forgot-wrapper">
                        <div class="account-head-text">
                            <h2 class="title">{{ __('forget_password') }}</h2>
                            <p class="text">
                                {{ __('enter_the_email_address_or_mobile_phone_number_associated_with_your') }}
                                {{ config('app.name') }} {{ __('account') }}.</p>
                        </div>
                        <div class="accout-wrapper__form">
                            @if (session('status'))
                                <div class="alert bg-success text-white bg-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <label class=" form-label" for="email">{{ __('email_address') }}</label>
                                    <input name="email" type="email" id="email" class="form-control {{ error('email') }}"
                                        value="{{ old('name') }}" placeholder="@lang('email_address')">
                                    <x-forms.error name="email" />
                                </div>

                                <div class="form-button">
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('send_code') }}
                                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.625 10H17.375" stroke="#191C1F" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M11.75 4.375L17.375 10L11.75 15.625" stroke="#191C1F"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="from-text">
                                    <span class="link-text">{{ __('already_have_account') }}?
                                        <a href="{{ route('login') }}">
                                            {{ __('login') }}
                                        </a>
                                    </span>
                                    <span class="link-text">{{ __('dont_have_account') }}?
                                        <a href="{{ route('register') }}">
                                            {{ __('register') }}
                                        </a>
                                    </span>
                                </div>
                                <div class="form-line"></div>
                                <div class="form-check m-0">
                                    <label class="form-check-label m-0">
                                        {{ __('you_may_contact') }} <a class="text-primary-500"
                                            href="{{ route('website.faq') }}">{{ __('customer_service') }}</a>
                                        {{ __('for_help_restoring_access_to_your_account') }}.
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
