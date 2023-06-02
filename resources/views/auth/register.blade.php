@extends('website.layouts.app')

@section('title', __('sign_up'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('sign_up') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Sign Up Body Start -->
    <div class="signup-body-01">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5 col-md-7 col-xs-10">
                    <div class="accout-wrapper">
                        <div class="account-head">
                            <a class="head-btn text-gray-500" href="{{ route('login') }}">{{ __('sign_in') }}</a>
                            <a class="head-btn border-b-4 text-gray-900" href="#">{{ __('sign_up') }}</a>
                        </div>
                        <div class="accout-wrapper__form">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label class=" form-label" for="name">{{ __('name') }}</label>
                                    <input type="text" class=" form-control {{ error('name') }}" name="name"
                                        placeholder="{{ __('name') }}" value="{{ old('name') }}">
                                    <x-forms.error name="name" />
                                </div>
                                <div class="form-group">
                                    <label class=" form-label" for="email">{{ __('email_address') }}</label>
                                    <input type="email" id="email" class=" form-control {{ error('email') }}"
                                        name="email" placeholder="{{ __('email') }}" value="{{ old('email') }}">
                                    <x-forms.error name="email" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">{{ __('password') }}</label>
                                    <div class="pass-box">
                                        <input class="form-control {{ error('password') }}" id="password-hide_show2"
                                            type="password" placeholder="{{ __('password') }}" name="password"
                                            value="{{ old('password') }}">
                                        <div class="pass-box--eye select-icon__two">
                                            <i class="far fa-eye {{ $errors->has('password') ? 'mb-4' : '' }}"></i>
                                        </div>
                                        <x-forms.error name="password" />
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="form-label">{{ __('confirm_password') }}</label>
                                    <div class="pass-box">
                                        <input class="form-control {{ error('password_confirmation') }}"
                                            id="password-hide_show3" type="password"
                                            placeholder="{{ __('confirm_password') }}" name="password_confirmation"
                                            value="{{ old('password_confirmation') }}">
                                        <div class="pass-box--eye select-icon__three">
                                            <i class="far fa-eye"></i>
                                        </div>
                                    </div>
                                    <x-forms.error name="password_confirmation" />
                                </div>
                                <div class="form-check">
                                    <input name="agree" class="form-check-input {{ error('agree') }}" type="checkbox"
                                        value="1" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ __('are_you_agree_to') }} {{ env('APP_NAME') }} <a
                                            href="{{ route('website.terms') }}">{{ __('terms_of_condition') }}</a>
                                        {{ __('and') }} <a
                                            href="{{ route('website.privacy') }}">{{ __('privacy_policy') }}</a>.
                                    </label>
                                </div>
                                <div class="form-button mt-0">
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('sign_up') }}
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
                                    @if (env('GOOGLE_LOGIN_ACTIVE'))
                                        <a href="{{ route('social-login', 'google') }}" class="btn w-100">
                                            <img src="{{ asset('frontend') }}/image/logo/svg/google.svg" alt="google">
                                            <span>{{ __('register_with_google') }}</span>
                                        </a>
                                    @endif
                                    @if (env('FACEBOOK_LOGIN_ACTIVE'))
                                        <a href="{{ route('social-login', 'facebook') }}" class="btn w-100">
                                            <img src="{{ asset('frontend') }}/image/logo/svg/facebook.svg"
                                                alt="facebook">
                                            <span>{{ __('register_with_facebook') }}</span>
                                        </a>
                                    @endif
                                    @if (env('TWITTER_LOGIN_ACTIVE'))
                                        <a href="{{ route('social-login', 'twitter') }}" class="btn w-100">
                                            <img src="{{ asset('frontend') }}/image/logo/svg/twitter.svg" alt="twitter">
                                            <span>{{ __('register_with_twitter') }}</span>
                                        </a>
                                    @endif
                                    @if (env('LINKEDIN_LOGIN_ACTIVE'))
                                        <a href="{{ route('social-login', 'linkedin') }}" class="btn w-100">
                                            <img src="{{ asset('frontend') }}/image/logo/svg/linkedin.svg"
                                                alt="linkedin">
                                            <span>{{ __('register_with_github') }}</span>
                                        </a>
                                    @endif
                                    @if (env('GITHUB_LOGIN_ACTIVE'))
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
@endsection
