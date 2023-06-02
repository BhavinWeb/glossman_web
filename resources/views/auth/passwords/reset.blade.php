@extends('website.layouts.app')

@section('title', __('reset_password'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('reset_password') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Reset Body Start -->
    <div class="reset-body-01">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5 col-md-7 col-xs-10">
                    <div class="accout-wrapper forgot-wrapper">
                        <div class="account-head-text">
                            <h2 class="title">{{ __('reset_password') }}</h2>
                        </div>
                        <div class="accout-wrapper__form">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group d-none">
                                    <label class=" form-label" for="email">{{ __('email_address') }}</label>
                                    <input name="email" type="email" id="email" class="form-control {{ error('email') }}"
                                        value="{{ $email ?? old('email') }}">
                                    <x-forms.error name="email" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">{{ __('password') }}</label>
                                    <div class="pass-box">
                                        <input name="password" class="form-control {{ error('password') }}"
                                            id="password-hide_show4" type="password" placeholder="{{ __('password') }}">
                                        <div class="pass-box--eye select-icon__one {{ errorHas('password', 'mt--10') }}">
                                            <i class="far fa-eye"></i>
                                        </div>
                                        <x-forms.error name="password" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">{{ __('confirm_password') }}</label>
                                    <div class="pass-box">
                                        <input class="form-control" id="password-hide_show5" type="password"
                                            placeholder="{{ __('confirm_password') }}" name="password_confirmation">
                                        <div class="pass-box--eye select-icon__three">
                                            <i class="far fa-eye"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-button">
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('reset_password') }}
                                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.625 10H17.375" stroke="#191C1F" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M11.75 4.375L17.375 10L11.75 15.625" stroke="#191C1F"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
