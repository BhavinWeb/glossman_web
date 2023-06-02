@extends('website.layouts.app')

@section('title', __('sign_in'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('sign_in') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Sign In Body Start -->
    <div class="signin-body-01">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5 col-md-7 col-xs-10">
                    <div class="accout-wrapper">
                        <div class="account-head">
                            <a class="head-btn border-b-4 text-gray-900" href="#">{{ __('sign_in') }}</a>
                            <a class="head-btn text-gray-500" href="{{ route('register') }}">{{ __('sign_up') }}</a>
                        </div>
                        <div class="accout-wrapper__form">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label class=" form-label" for="email">{{ __('email_address') }}</label>
                                    <input name="email" type="email" id="email" class="form-control {{ error('email') }}"
                                        value="{{ old('email') }}" placeholder="@lang('email')">
                                    <x-forms.error name="email" />
                                </div>
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="form-label">{{ __('password') }}</label>
                                        <a href="{{ route('password.request') }}" class="forgot-btn">
                                            {{ __('forget_password') }}
                                        </a>
                                    </div>
                                    <div class="pass-box">
                                        <input name="password" class="form-control {{ error('password') }}"
                                            id="password-hide_show1" type="password" placeholder="@lang('password')"
                                            value="{{ old('password') }}">
                                        <div class="pass-box--eye select-icon__one {{ errorHas('password', 'mt--10') }}">
                                            <i class="far fa-eye"></i>
                                        </div>
                                        <x-forms.error name="password" />
                                    </div>
                                </div>
                                <div class="form-button">
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('login') }}
                                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.625 10H17.375" stroke="#191C1F" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M11.75 4.375L17.375 10L11.75 15.625" stroke="#191C1F"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                </div>
                                @if (config('zakirsoft.google_active') || config('zakirsoft.facebook_active') || config('zakirsoft.twitter_active') || config('zakirsoft.linkedin_active') || config('zakirsoft.github_active'))
                                    <div class="from-text">
                                        <div class="texts">
                                            <p class="text">{{ __('or') }}</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-otherlogin">
                                    @if (config('zakirsoft.google_active') && config('zakirsoft.google_id') && config('zakirsoft.google_secret'))
                                        <a href="{{ route('social-login', 'google') }}" class="btn w-100">
                                            <img src="{{ asset('frontend') }}/image/logo/svg/google.svg" alt="google">
                                            <span>{{ __('login_with_google') }}</span>
                                        </a>
                                    @endif
                                    @if (config('zakirsoft.facebook_active') && config('zakirsoft.facebook_id') && config('zakirsoft.facebook_secret'))
                                        <a href="{{ route('social-login', 'facebook') }}" class="btn w-100">
                                            <img src="{{ asset('frontend') }}/image/logo/svg/facebook.svg"
                                                alt="facebook">
                                            <span>{{ __('login_with_facebook') }}</span>
                                        </a>
                                    @endif
                                    @if (config('zakirsoft.twitter_active') && config('zakirsoft.twitter_id') && config('zakirsoft.twitter_secret'))
                                        <a href="{{ route('social-login', 'twitter') }}" class="btn w-100">
                                            <img src="{{ asset('frontend') }}/image/logo/svg/twitter.svg" alt="twitter">
                                            <span>{{ __('login_with_twitter') }}</span>
                                        </a>
                                    @endif
                                    @if (config('zakirsoft.linkedin_active') && config('zakirsoft.linkedin_id') && config('zakirsoft.linkedin_secret'))
                                        <a href="{{ route('social-login', 'linkedin') }}" class="btn w-100">
                                            <img src="{{ asset('frontend') }}/image/logo/svg/linkedin.svg"
                                                alt="linkedin">
                                            <span>{{ __('login_with_linkedin') }}</span>
                                        </a>
                                    @endif
                                    @if (config('zakirsoft.github_active') && config('zakirsoft.github_id') && config('zakirsoft.github_secret'))
                                        <a href="{{ route('social-login', 'github') }}" class="btn w-100">
                                            <img src="{{ asset('frontend') }}/image/logo/svg/github.svg" alt="github">
                                            <span>{{ __('login_with_github') }}</span>
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign In Body End -->
@endsection
