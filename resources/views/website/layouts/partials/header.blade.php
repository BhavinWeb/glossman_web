<!-- Header Area -->
<header
    class="site-header site-header--menu-center mobile-menu-trigger-dark bg-secondary-700 d-lg-none site-header--absolute">
    <div class="container">
        <nav class="navbar site-navbar">
            <!-- Brand Logo-->
            <div class="site-header__brand">
                <a href="{{ route('website.index') }}">
                    <img src="{{ $setting->logo_image_url }}" alt="logo" class="logo-black">
                </a>
            </div>
            <div class="menu-block-wrapper ">
                <div class="menu-overlay"></div>
                <nav class="menu-block menu-block-inner" id="append-menu-header">
                    <div class="mobile-menu-head">
                        <div class="go-back">
                            <i class="fa fa-angle-left"></i>
                        </div>
                        <div class="current-menu-title"></div>
                        <div class="mobile-menu-close">&times;</div>
                    </div>
                    <ul class="site-menu-main">
                        <li class="nav-item nav-item-has-children">
                            <a href="{{ route('website.index') }}"
                                class="nav-link-item drop-trigger">{{ __('home') }}</a>
                        </li>
                        <li class="nav-item nav-item-has-children">
                            <a href="{{ route('website.product') }}"
                                class="nav-link-item drop-trigger">{{ __('shop') }}</a>
                        </li>
                        <li class="nav-item nav-item-has-children">
                            <a href="{{ route('website.post') }}"
                                class="nav-link-item drop-trigger">{{ __('blog') }}</a>
                        </li>
                        <li class="nav-item nav-item-has-children">
                            <a href="{{ route('website.cart') }}"
                                class="nav-link-item drop-trigger">{{ __('shoping_cart') }}</a>
                        </li>
                        <li class="nav-item nav-item-has-children">
                            <a href="{{ route('website.customer.wishlist') }}"
                                class="nav-link-item drop-trigger {{ auth()->check() ? '' : 'login_required' }}">{{ __('wishlist') }}</a>
                        </li>
                    </ul>
                    @if ($cms->social_twitter || $cms->social_facebook || $cms->social_pinterest || $cms->social_reddit || $cms->social_youtube || $cms->social_instagram)
                        <div class="m-social-block">
                            <ul class="list-unstyled list-group">
                                <li class="text text-14">{{ __('follow_us') }}:</li>
                                @if ($cms->social_twitter)
                                    <li><a href="{{ $cms->social_twitter }}" target="_blank"><i
                                                class="fab fa-twitter"></i></a></li>
                                @endif
                                @if ($cms->social_facebook)
                                    <li><a href="{{ $cms->social_facebook }}" target="_blank"><i
                                                class="fab fa-facebook"></i></a>
                                    </li>
                                @endif
                                @if ($cms->social_pinterest)
                                    <li><a href="{{ $cms->social_pinterest }}" target="_blank"><i
                                                class="fab fa-pinterest-p"></i></a>
                                    </li>
                                @endif
                                @if ($cms->social_reddit)
                                    <li><a href="{{ $cms->social_reddit }}" target="_blank"><i
                                                class="fab fa-reddit"></i></a></li>
                                @endif
                                @if ($cms->social_youtube)
                                    <li><a href="{{ $cms->social_youtube }}" target="_blank"><i
                                                class="fab fa-youtube"></i></a></li>
                                @endif
                                @if ($cms->social_instagram)
                                    <li><a href="{{ $cms->social_instagram }}" target="_blank"><i
                                                class="fab fa-instagram"></i></a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </nav>
            </div>
            <!-- mobile menu trigger -->
            <div class="mobile-menu-trigger">
                <span></span>
            </div>
            <!--/.Mobile Menu Hamburger Ends-->
        </nav>
    </div>
</header>
<!-- navbar- -->
@if ($top_header_content->status)
    @php
        $offer = $top_header_content->campaignOffer[0]['campaign'] ?? null;
        $explode_text = $offer ? explode(' ', $offer->title) : [];
    @endphp
    @if ($offer)
        <a id="top_header_content_href" href="{{ route('website.campaign.details', $offer->slug) }}">
            <div class="offer-widget-01 d-none d-lg-block" id="top_header_content"
                style="background-image: url('{{ $offer->image }}')">
                <div onclick="hideHeader()" class="offer-widget-01__wrapper--close-button">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 3.5L3.5 12.5" stroke="white" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M12.5 12.5L3.5 3.5" stroke="white" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </a>
    @endif
@endif
<!-- Offer Widget End -->
<!-- Top Nav Start -->
<div class="top-nav bg-secondary-700 d-none d-lg-block">
    <div class="container">
        <div class="top-nav__wrapper">
            <div class="top-nav__wrapper--text">
                <p class="text-white text-white text-14">{{ $cms->welcome_message }} </p>
            </div>
            <div class="top-nav__wrapper--content">
                @if ($cms->social_twitter || $cms->social_facebook || $cms->social_pinterest || $cms->social_reddit || $cms->social_youtube || $cms->social_instagram)
                    <div class="social-content">
                        <ul class="list-unstyled list-group">
                            <li class="text-white text-14">{{ __('follow_us') }}:</li>
                            @if ($cms->social_twitter)
                                <li><a href="{{ $cms->social_twitter }}" target="_blank">
                                        <i class="fab fa-twitter"></i></a>
                                </li>
                            @endif
                            @if ($cms->social_facebook)
                                <li><a href="{{ $cms->social_facebook }}" target="_blank"><i
                                            class="fab fa-facebook"></i></a></li>
                            @endif
                            @if ($cms->social_pinterest)
                                <li><a href="{{ $cms->social_pinterest }}" target="_blank"><i
                                            class="fab fa-pinterest-p"></i></a>
                                </li>
                            @endif
                            @if ($cms->social_reddit)
                                <li><a href="{{ $cms->social_reddit }}" target="_blank"><i
                                            class="fab fa-reddit"></i></a></li>
                            @endif
                            @if ($cms->social_youtube)
                                <li><a href="{{ $cms->social_youtube }}" target="_blank"><i
                                            class="fab fa-youtube"></i></a></li>
                            @endif
                            @if ($cms->social_instagram)
                                <li><a href="{{ $cms->social_instagram }}" target="_blank"><i
                                            class="fab fa-instagram"></i></a></li>
                            @endif
                        </ul>
                    </div>
                @endif
                <div class="switcher">
                    @if (allowLaguageChanage())
                        <div class="switcher__language">
                            <select class="niceselect-selector" onchange="switchLanguage(this)">
                                @foreach ($languages as $language)
                                    <option value="{{ $language->code }}"
                                        {{ $language->code == app()->getLocale() ? 'selected' : '' }}>
                                        {{ $language->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="switcher__currency text-white">
                        {{ config('zakirsoft.currency') }} (
                        {{ config('zakirsoft.currency_symbol') }} )
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Nav End -->
<!-- Desk Nav Start -->
<div class="desk-nav bg-secondary-700 d-none d-lg-block">
    <div class="container">
        <div class="desk-nav__wrapper">
            <div class="desk-nav__wrapper--logo">
                <a href="{{ route('website.index') }}" class="logo">
                    <img src="{{ $setting->logo_image2_url }}" alt="logo" class="footer-logo">
                </a>
            </div>
            <div class="desk-nav__wrapper--search">
                <form action="{{ route('website.product') }}" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="{{ __('search_for_anything') }}..."
                            name="keyword" value="{{ request('keyword') }}">
                        <div class="icon">
                            <x-svg.search />
                        </div>
                    </div>
                </form>
            </div>
            <div class="desk-nav__wrapper--widget">
                <div class="cart cart-hide_show">
                    <button id="showHiddenMenuOne" class="plain-btn ">
                        <x-svg.cart width="32" height="32" fill="white" stroke="white" />
                      <div class="frame">
                        <span class="cartCount">0</span>
                      </div>
                    </button>
                    <div class="shopping-cart-popup">
                        <div class="card-header">
                            <h6 class="title">{{ __('shoping_cart') }}
                                <span class="count">(<small class="cartCount"></small>)</span>
                            </h6>
                        </div>
                        <div class="card-body" id="cartsItems"></div>
                        <div class="card-subtototal">
                            <p class="text text-14 text-gray-700">{{ __('subtotal') }}</p>
                            <p class="price" id="cartSubtotal"></p>
                        </div>
                        <div class="card-button-group">
                            @if (auth()->check())
                                <a href="{{ route('website.checkout') }}" class="btn btn-primary w-100 d-block">
                                    {{ __('checkout_now') }}
                                    <x-svg.arrow-long-right />
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary w-100">{{ __('login_and_checkout') }}
                                    <x-svg.arrow-long-right />
                                </a>
                                <p class="text-center my-2">{{ __('or') }}</p>
                                <a href="{{ route('website.checkout') }}" class=" btn btn-primary w-100 mt-0">{{ __('guest_checkout') }}
                                    <x-svg.arrow-long-right />
                                </a>
                            @endif
                            <a href="{{ route('website.cart') }}" class="btn btn-outline-primary w-100 d-block mt-3">
                                {{ __('view_cart') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="wishlist">
                    <a href="{{ route('website.customer.wishlist') }}" class="plain-btn">
                        <x-svg.love width="32" height="32" stroke="white" fill="none" />
                    </a>
                </div>
                @auth('user')
                    <a href="{{ route('website.customer.dashboard') }}">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16 20C20.4183 20 24 16.4183 24 12C24 7.58172 20.4183 4 16 4C11.5817 4 8 7.58172 8 12C8 16.4183 11.5817 20 16 20Z"
                                stroke="white" stroke-width="2" stroke-miterlimit="10" />
                            <path
                                d="M3.875 27.0001C5.10367 24.8716 6.87104 23.104 8.99944 21.875C11.1278 20.646 13.5423 19.999 16 19.999C18.4577 19.999 20.8722 20.646 23.0006 21.875C25.129 23.104 26.8963 24.8716 28.125 27.0001"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                @else
                    <div
                        class="user user-hide_show {{ !Route::is('users.login') && !Route::is('register') && !Route::is('password.request') && !Route::is('password.reset') && ($errors->has('email') || $errors->has('password')) ? 'is-active' : '' }}">
                        <div id="showHiddenMenuTwo">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16 20C20.4183 20 24 16.4183 24 12C24 7.58172 20.4183 4 16 4C11.5817 4 8 7.58172 8 12C8 16.4183 11.5817 20 16 20Z"
                                    stroke="white" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M3.875 27.0001C5.10367 24.8716 6.87104 23.104 8.99944 21.875C11.1278 20.646 13.5423 19.999 16 19.999C18.4577 19.999 20.8722 20.646 23.0006 21.875C25.129 23.104 26.8963 24.8716 28.125 27.0001"
                                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="signin-popup" id="hiddenWidgetTwo">
                            <h2 class="title">{{ __('sign_in_to_your_account') }}</h2>
                            <div class="signin-form">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1"
                                            class="form-label">{{ __('email_address') }}</label>
                                        <input name="email" type="email" id="email"
                                            class="form-control {{ error('email') }}" id="exampleInputEmail1"
                                            value="{{ old('email') }}" placeholder="@lang('email_address')">
                                        <x-forms.error name="email" />
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label class="form-label">{{ __('password') }}</label>
                                            <a href="{{ route('password.request') }}"
                                                class="forgot-btn">{{ __('forgot_password') }}</a>
                                        </div>
                                        <div class="pass-box">
                                            <input name="password" class="form-control {{ error('password') }}"
                                                id="password-hide_show9" type="password" placeholder="@lang('password')"
                                                value="{{ old('password') }}" />
                                            <div
                                                class="pass-box--eye select-icon__nine {{ errorHas('password', 'mt--10') }}">
                                                <i class="far fa-eye"></i>
                                            </div>
                                            <x-forms.error name="password" />
                                        </div>
                                    </div>
                                    <div class="form-button">
                                        <button type="submit" class="btn btn-primary w-100">
                                            {{ __('login') }}
                                            <svg width="21" height="20" viewbox="0 0 21 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3.625 10H17.375" stroke="#191C1F" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M11.75 4.375L17.375 10L11.75 15.625" stroke="#191C1F"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="from-text">
                                        <div class="texts">
                                            <p class="text">{{ __('dont_have_account') }}</p>
                                        </div>
                                        <a href="{{ route('register') }}"
                                            class="btn btn-outline-primary w-100">{{ __('create_account') }}</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
<!-- Desk Nav End -->
<!-- Bottom Nav Start -->
<div class="bottom-nav d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="bottom-nav__wrapper">
                <div class="left-sidebar">
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('all_category') }}
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 6L8 11L3 6" stroke="#191C1F" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            @foreach ($hcategories as $pcategory)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('website.product', ['category' => $pcategory->slug]) }}">
                                        {{ $pcategory->name }}
                                        @if (count($pcategory->subcategories))
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.5 2.25L8.25 6L4.5 9.75" stroke="#191C1F" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        @endif
                                    </a>
                                    @if (count($pcategory->subcategories))
                                        <div class="sub-item">
                                            <div class="sub-wrapper">
                                                @if ($pcategory->subcategories)
                                                    <ul class="input-field">
                                                        @foreach ($pcategory->subcategories as $category)
                                                            <li><a
                                                                    href="{{ route('website.product', ['category' => $category->slug]) }}">
                                                                    {{ $category->name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                                @if (count($pcategory->featured_products))
                                                    <div class="featured-itme-01">
                                                        <div class="featured-list">
                                                            <h6 class="title">{{ __('featured') }}
                                                                {{ $pcategory->name }}</h6>
                                                            @foreach ($pcategory->featured_products as $product)
                                                                <a href="{{ route('website.product.detail', $product->slug) }}"
                                                                    class="d-block">
                                                                    <div class="single-featured">
                                                                        <div class="card-image">
                                                                            <img height="80px" width="80px"
                                                                                class="object-fit-cover"
                                                                                src="{{ $product->image_url }}"
                                                                                alt="accessories">
                                                                        </div>
                                                                        <div class="card-contetn">
                                                                            <p>{{ $product->title }}</p>
                                                                            <span>
                                                                                {{ $product->sale_price ? multicurrency($product->sale_price) : multicurrency($product->price) }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <nav class="mainnav">
                        <ul>
                            <li class="single-list {{ request()->routeIs('website.index') ? 'active' : '' }}">
                                <a href="{{ route('website.index') }}">
                                    <span class="d-block me-1">
                                        <x-svg.home />
                                    </span>
                                    <span class="text-14">
                                        {{ __('home') }}
                                    </span>
                                </a>
                            </li>
                            <li class="single-list {{ request()->routeIs('website.product') ? 'active' : '' }}">
                                <a href="{{ route('website.product') }}">
                                    <span class="d-block me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#5F6C72"
                                            viewBox="0 0 256 256">
                                            <rect width="256" height="256" fill="none"></rect>
                                            <path d="M48,139.6V208a8,8,0,0,0,8,8H200a8,8,0,0,0,8-8V139.6" fill="none"
                                                stroke="#5F6C72" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="16"></path>
                                            <path
                                                d="M54,40H202a8.1,8.1,0,0,1,7.7,5.8L224,96H32L46.3,45.8A8.1,8.1,0,0,1,54,40Z"
                                                fill="none" stroke="#5F6C72" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="16"></path>
                                            <path d="M96,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="#5F6C72"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path>
                                            <path d="M160,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="#5F6C72"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path>
                                            <path d="M224,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="#5F6C72"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path>
                                        </svg>
                                    </span>
                                    <span class="text-14">
                                        {{ __('shop') }}
                                    </span>
                                </a>
                            </li>
                            <li class="single-list {{ request()->routeIs('website.track.order') ? 'active' : '' }}">
                                <a href="{{ route('website.track.order') }}">
                                    <span class="d-block me-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.25 21.75H18.75" stroke="#5F6C72" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M12 12.75C13.6569 12.75 15 11.4069 15 9.75C15 8.09315 13.6569 6.75 12 6.75C10.3431 6.75 9 8.09315 9 9.75C9 11.4069 10.3431 12.75 12 12.75Z"
                                                stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M19.5 9.75C19.5 16.5 12 21.75 12 21.75C12 21.75 4.5 16.5 4.5 9.75C4.5 7.76088 5.29018 5.85322 6.6967 4.4467C8.10322 3.04018 10.0109 2.25 12 2.25C13.9891 2.25 15.8968 3.04018 17.3033 4.4467C18.7098 5.85322 19.5 7.76088 19.5 9.75V9.75Z"
                                                stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span class="text-14">
                                        {{ __('track_order') }}
                                    </span>
                                </a>
                            </li>
                            <li class="single-list {{ request()->routeIs('website.compare') ? 'active' : '' }}">
                                <a href="{{ route('website.compare') }}">
                                    <span class="d-block me-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.48125 9.34668H2.98125V4.84668" stroke="#5F6C72"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M17.8312 6.16885C17.0659 5.40236 16.1569 4.79429 15.1563 4.37941C14.1557 3.96453 13.0832 3.75098 12 3.75098C10.9168 3.75098 9.84425 3.96453 8.84367 4.37941C7.84309 4.79429 6.93412 5.40236 6.16875 6.16885L2.98125 9.34698"
                                                stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M16.5188 14.6533H21.0188V19.1533" stroke="#5F6C72"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M6.16875 17.8314C6.93412 18.5979 7.84309 19.206 8.84367 19.6209C9.84425 20.0358 10.9168 20.2493 12 20.2493C13.0832 20.2493 14.1557 20.0358 15.1563 19.6209C16.1569 19.206 17.0659 18.5979 17.8312 17.8314L21.0187 14.6533"
                                                stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span class="text-14">
                                        {{ __('compare') }}
                                    </span>
                                </a>
                            </li>
                            <li class="single-list {{ request()->routeIs('website.faq') ? 'active' : '' }}">
                                <a href="{{ route('website.faq') }}">
                                    <span class="d-block me-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z"
                                                stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M11.25 11.25H12V16.5H12.75" stroke="#5F6C72" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M12.1875 7.875C12.1875 8.08211 12.0196 8.25 11.8125 8.25C11.6054 8.25 11.4375 8.08211 11.4375 7.875C11.4375 7.66789 11.6054 7.5 11.8125 7.5C12.0196 7.5 12.1875 7.66789 12.1875 7.875Z"
                                                fill="#191C1F" stroke="#5F6C72" stroke-width="1.5" />
                                        </svg>
                                    </span>
                                    <span class="text-14">
                                        {{ __('need_help') }}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="tell">
                    <span>
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.4343 4.375C18.9185 4.77332 20.2718 5.55499 21.3584 6.64159C22.445 7.72818 23.2266 9.08147 23.625 10.5656"
                                stroke="#191C1F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M16.5266 7.75488C17.4192 7.99195 18.2333 8.46077 18.8864 9.11384C19.5395 9.7669 20.0083 10.581 20.2454 11.4736"
                                stroke="#191C1F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M10.1172 13.6504C11.0176 15.5098 12.5211 17.0095 14.3828 17.9051C14.5201 17.9701 14.672 17.9983 14.8235 17.9868C14.975 17.9752 15.1209 17.9245 15.2469 17.8395L17.9812 16.0129C18.1021 15.931 18.2417 15.881 18.387 15.8676C18.5324 15.8542 18.6788 15.8778 18.8125 15.9363L23.9312 18.1348C24.1062 18.2076 24.2524 18.3359 24.3472 18.4999C24.4421 18.664 24.4804 18.8546 24.4562 19.0426C24.294 20.3089 23.6759 21.4726 22.7177 22.3162C21.7594 23.1597 20.5266 23.6251 19.25 23.6254C15.3049 23.6254 11.5214 22.0582 8.73179 19.2686C5.94218 16.479 4.375 12.6955 4.375 8.7504C4.37529 7.47377 4.84073 6.24099 5.68425 5.28273C6.52776 4.32447 7.69153 3.70639 8.95781 3.54415C9.14576 3.52001 9.33643 3.55832 9.50047 3.65319C9.66451 3.74805 9.79281 3.89421 9.86562 4.06915L12.0641 9.19884C12.1212 9.33047 12.1451 9.47414 12.1337 9.61719C12.1223 9.76024 12.0758 9.89829 11.9984 10.0192L10.1719 12.7973C10.0906 12.9229 10.0428 13.0673 10.0333 13.2167C10.0237 13.3661 10.0526 13.5154 10.1172 13.6504V13.6504Z"
                                stroke="#191C1F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <a href="tel:{{ $cms->footer_contact_number }}">{{ $cms->footer_contact_number }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bottom Nav End -->

@push('frontend_scripts')
    <script>
        function switchLanguage(data) {
            var id = data.value;
            var url = "{{ route('changeLanguage', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    location.reload();

                }
            });
        }

        if (localStorage.getItem('top_header_visibility') && localStorage.getItem('top_header_visibility') == 'hide') {
            document.getElementById('top_header_content').style.setProperty('display', 'none', 'important');
        } else {
            document.getElementById('top_header_content').style.setProperty('display', 'block', 'important');
        }

        function hideHeader() {
            $("#top_header_content_href").attr("href", "javascript:void(0);")
            localStorage.setItem('top_header_visibility', 'hide');
            document.getElementById('top_header_content').style.setProperty('display', 'none', 'important');
        }
    </script>
@endpush

{!! $setting->header_script !!}
