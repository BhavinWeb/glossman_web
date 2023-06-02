<div class="footer-section-01">
    <div class="container">
        <div class="row card-row">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="footer-widget">
                    <div class="logo">
                        <a href="#">
                            <img class="footer-logo" src="{{ $setting->logo_image2_url }}" alt="logo"></a>
                    </div>
                    <div class="widget-content-info">
                        <span class="text-one">{{ $cms->footer_title }}</span>
                        <span class="phone">{{ $cms->footer_contact_number }}</span>
                        <span class="text-one">{{ $cms->footer_address }}</span>
                        <span class="mail"><a
                                href="mailto:info@clicon.com.com">{{ $cms->footer_email }}</a></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-sm-6">
                <div class="footer-widget">
                    <h2 class="title">{{ __('top_category') }}</h2>
                    <ul class="footer-list-group">
                        @foreach ($hcategories as $category)
                            <li>
                              <a href="{{ route('website.product', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach

                        <li class="text-btn">
                            <a href="{{ route('website.product') }}">
                                {{ __('browse_all_product') }}
                                <x-svg.arrow-long-right width="20" height="20" stroke="#EBC80C" />
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-sm-6">
                <div class="footer-widget">
                    <h2 class="title">{{ __('quick_links') }}</h2>
                    <ul class="footer-list-group">
                        <li><a href="{{ route('website.product') }}">{{ __('shop_product') }}</a></li>
                        <li><a href="{{ route('website.cart') }}">{{ __('shoping_cart') }}</a></li>
                        <li><a href="{{ route('website.customer.wishlist') }}">{{ __('wishlist') }}</a></li>
                        <li class="{{ request()->routeIs('website.compare') ? 'text-btn' : '' }}"><a
                                href="{{ route('website.compare') }}">{{ __('compare') }}</a></li>
                        <li><a href="{{ route('website.track.order') }}">{{ __('track_order') }}</a></li>
                        <li><a href="{{ route('website.faq') }}">{{ __('customer_help') }}</a></li>
                        <li><a href="{{ route('website.about') }}">{{ __('about_us') }}</a></li>
                        <li class="{{ request()->routeIs('website.terms') ? 'text-btn' : '' }}"><a
                                href="{{ route('website.terms') }}">{{ __('terms_conditions') }}</a></li>
                        <li class="{{ request()->routeIs('website.privacy') ? 'text-btn' : '' }}"><a
                                href="{{ route('website.privacy') }}">{{ __('privacy_policy') }}</a></li>
                        <li class="{{ request()->routeIs('website.refund') ? 'text-btn' : '' }}"><a
                                href="{{ route('website.refund') }}">{{ __('refund_policy') }}</a></li>
                    </ul>
                </div>
            </div>
            @if ($cms->android_app_link || $cms->ios_app_link)
                <div class="col-xl-2 col-lg-4 col-sm-6">
                    <div class="footer-widget footer-widget__04">
                        <h2 class="title">{{ __('download_app') }}</h2>
                        <div class="app-button-group">
                            @if ($cms->android_app_link)
                                <a class="google-play-btn" href="#">
                                    <svg width="30" height="32" viewBox="0 0 30 32" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19.087 14.813L5.29175 0.979426L22.8438 11.0562L19.087 14.813V14.813ZM1.69015 0.166626C0.877351 0.592226 0.333351 1.36663 0.333351 2.37463V29.9586C0.333351 30.9666 0.877351 31.741 1.69015 32.1666L17.7334 16.1634L1.69015 0.166626ZM28.271 14.269L24.5894 12.1378L20.4822 16.1698L24.5894 20.2018L28.3462 18.0706C29.471 17.1762 29.471 15.1634 28.271 14.269V14.269ZM5.29175 31.3602L22.8438 21.2834L19.087 17.5266L5.29175 31.3602V31.3602Z"
                                            fill="white" />
                                    </svg>
                                    <div class="text-group">
                                        <span class="text-one">{{ __('get_it_now') }}</span>
                                        <span class="text-two">{{ __('google_play') }}</span>
                                    </div>
                                </a>
                            @endif
                            @if ($cms->ios_app_link)
                                <a class="app-play-btn" href="#">
                                    <svg width="32" height="33" viewBox="0 0 32 33" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_762_10665)">
                                            <path
                                                d="M29.056 25.438C28.5893 26.5249 28.013 27.5614 27.336 28.5313C26.4307 29.8213 25.69 30.714 25.1193 31.21C24.2347 32.0233 23.286 32.4407 22.2707 32.464C21.542 32.464 20.6633 32.2567 19.64 31.836C18.6133 31.4173 17.67 31.2093 16.8073 31.2093C15.9027 31.2093 14.9327 31.4173 13.8947 31.836C12.8553 32.2567 12.018 32.476 11.378 32.4973C10.4047 32.5393 9.43401 32.1107 8.46468 31.21C7.84668 30.67 7.07401 29.746 6.14735 28.4367C5.15335 27.038 4.33601 25.4167 3.69601 23.5673C3.01068 21.5707 2.66668 19.6367 2.66668 17.7647C2.66668 15.62 3.13001 13.7707 4.05801 12.2207C4.78801 10.9753 5.75801 9.994 6.97268 9.27267C8.16433 8.55956 9.52403 8.17581 10.9127 8.16067C11.686 8.16067 12.7 8.4 13.9607 8.87C15.2173 9.34133 16.024 9.58067 16.378 9.58067C16.642 9.58067 17.5387 9.30067 19.058 8.74333C20.4953 8.226 21.708 8.012 22.7013 8.09667C25.394 8.314 27.4167 9.37533 28.7613 11.2873C26.354 12.746 25.1627 14.7893 25.1867 17.4107C25.208 19.4527 25.9487 21.152 27.4047 22.5007C28.0647 23.1273 28.8013 23.6113 29.6207 23.9547C29.4489 24.4552 29.2606 24.9499 29.056 25.438ZM22.8813 1.14067C22.8813 2.74067 22.2967 4.23533 21.1313 5.618C19.7247 7.26267 18.024 8.21267 16.1793 8.06267C16.1546 7.86139 16.1421 7.65879 16.142 7.456C16.142 5.92 16.8107 4.276 17.9987 2.93133C18.592 2.25067 19.3453 1.68467 20.26 1.23333C21.1733 0.788667 22.036 0.542667 22.848 0.5C22.8713 0.714 22.8813 0.928 22.8813 1.14V1.14067Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_762_10665">
                                                <rect width="32" height="32" fill="white"
                                                    transform="translate(0 0.5)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <div class="text-group">
                                        <span class="text-one">{{ __('get_it_now') }}</span>
                                        <span class="text-two">{{ __('app_store') }}</span>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            @if($tags && $tags->count())
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="footer-widget">
                    <h2 class="title">{{ __('popular_tag') }}</h2>
                    <ul class="footer-tag">
                        @foreach ($tags as $tag)
                            <li><a href="{{ route('website.product', ['tag' => $tag->slug]) }}">
                                    {{ $tag->name }}
                                </a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="copyright-01">
    <p class="text-14 text-gray-300">{{ __('copyright') }} {{ date('Y') }} <a
            href="{{ config('app.url') }}">{{ config('app.name') }}</a>. {{ __('all_rights_reserved') }}.</p>
</div>
