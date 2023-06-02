<!-- BestDeals Section Start -->
@if (count($todays_deals) > 0)
    <div class="best-deal-section-01">
        <div class="container">
            <div class="best-deal-section-01__wrapper">
                <div class="best-deal-section-01__top-content">
                    <div class="section-content">
                        <h2 class="title">{{ __('todays_deals') }}</h2>
                    </div>
                </div>
                <div class="best-deal-section-01__top-button">
                    <a class="btn-text" href="{{ route('website.product') }}">{{ __('browse_all_product') }}
                        <x-svg.arrow-long-right width="20" height="20" stroke="#2DA5F3" />
                    </a>
                </div>
            </div>
            <div class="best-deal-section-01__product-area">
                <div class="best-deal-section-01__product-area--big-product">
                    <div class="big-product-card-01 d-block d-md-flex d-xxl-block">
                        <div class="card-image">
                            <a href="{{ route('website.product.detail', $todays_deals[0]->slug) }}">
                                <img src="{{ $todays_deals[0]->image_url }}" alt="ps5" class="w-100">
                            </a>
                        </div>
                        <div class="card-body mb-3 mb-md-0">
                            @if ($todays_deals[0]->total_rated)
                                <ul class="rating">
                                    @php
                                        $leftValue = 5 - $todays_deals[0]->avg_rating;
                                    @endphp
                                    @for ($i = 0; $i < $todays_deals[0]->avg_rating; $i++)
                                        <li>
                                            <x-svg.star fill="#EBC80C" />
                                        </li>
                                    @endfor
                                    @if ($leftValue > 0)
                                        @for ($i = 0; $i < $leftValue; $i++)
                                            <li>
                                                <x-svg.null-star />
                                            </li>
                                        @endfor
                                    @endif

                                    <li class="text-gray-500">({{ $todays_deals[0]->total_rated }})</li>
                                </ul>
                            @endif
                            <a href="{{ route('website.product.detail', $todays_deals[0]->slug) }}">
                                <h6 class="title">{{ Str::limit($todays_deals[0]->title, 48, '...') }}</h6>
                            </a>
                            <span class="price-valu">
                                @if ($todays_deals[0]->sale_price)
                                    <del>{{ multiCurrency($todays_deals[0]->price) }}</del>
                                    {{ multiCurrency($todays_deals[0]->sale_price) }}
                                @else
                                    {{ multiCurrency($todays_deals[0]->price) }}
                                @endif
                            </span>
                            <p class="text">
                                {!! Str::limit($todays_deals[0]->short_description, 80, '...') !!}

                            </p>
                        </div>
                        <div class="card-button-group">
                            <a class="wishlist-btn {{ auth()->check() ? '' : 'login_required' }}"
                                href="javascript:void(0)" onclick="AddToFavorite('{{ $todays_deals[0]->id }}')">
                                <x-svg.love id="svg{{ $todays_deals[0]->id }}" width="24" height="24"
                                    :fill="$todays_deals[0]->wishlisted ? '#000' : 'none'" stroke="#000" />
                            </a>

                            <a href="javascript:void(0)" class="btn btn-primary w-100 addtocard-btn text-uppercase"
                                @if ($todays_deals[0]->stock > 0) onclick="fetchproductAttribute({{ $todays_deals[0]->id }})" @endif>
                                <x-svg.cart width="21" height="20" stroke="white" />
                                {{ __('add_to_card') }}
                            </a>

                            @php
                                $compares = session()->get('compares') ? session()->get('compares') : [];
                            @endphp
                            <a href="javascript:void(0)" class="action-btn"
                                @if (($key = array_search($todays_deals[0]->id, $compares)) !== false) style="color:#191C1F" @endif
                                onclick="AddToCompare('{{ $todays_deals[0]->id }}')">
                                @if (($key = array_search($todays_deals[0]->id, $compares)) !== false)
                                    <x-svg.sync stroke="#191C1F" />
                                @else
                                    <x-svg.sync />
                                @endif
                            </a>
                        </div>
                        <div class="offer-tag">
                            <x-frontend.shop.product-badge :product="$todays_deals[0]" />
                        </div>
                    </div>
                </div>

                <div class="best-deal-section-01__product-area--small-product">
                    @foreach ($todays_deals as $key => $product)
                        @if ($key != 0)
                            <x-frontend.shop.product :product="$product" class="card-product--01" :showRating="false" />
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
<!-- BestDeals Section End -->
