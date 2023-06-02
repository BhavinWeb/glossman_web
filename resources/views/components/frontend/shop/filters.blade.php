@props(['categories', 'brands', 'tags'])

<div class="col-xl-3">
    <div class="shop-body-01__filter d-none d-xl-block">
        <div class="shop-body-01__filter--catagory">
            <div class="category-block-01">
                <h6 class="title">{{ __('category') }}</h6>
                @foreach ($categories as $category)
                    <div class="form-check">
                        <input class="form-check-input category" name="category" value="{{ $category->slug }}"
                            type="radio" id="category_filter_{{ $category->id }}"
                            {{ request('category') === $category->slug ? 'checked' : '' }}>
                        <label class="form-check-label fontcheck" for="category_filter_{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="shop-body-01__filter--line"></div>
        <div class="shop-body-01__filter--pricerange">
            <div class="price-range-block">
                <h6 class="title mb-7 pb-2">{{ __('price_range') }}</h6>
                <div class="slider-wrapper">
                    <input type="hidden" name="price_min" id="price_min">
                    <input type="hidden" name="price_max" id="price_max">
                    <div class="pe-3 pb-2 ps-2 mb-4 list-sidebar__accordion-body">
                        <div class="price-range-slider">
                            <div id="priceRangeSlider"></div>
                        </div>
                    </div>
                </div>
                <div class="price-box">
                    <div class="form-check">
                        <input class="form-check-input" value="" name="price" type="radio" id="all_price"
                            @if (request('price') == null && !request('price')) checked @endif>
                        <label class="form-check-label" for="all_price">
                            {{ __('all_price') }}
                        </label>
                    </div>
                    @php
                        $symbol = config('zakirsoft.currency_symbol');
                    @endphp
                    <div class="form-check">
                        <input class="form-check-input individual" type="radio" name="price" value="0" id="l"
                            @if (request('price') == 0 && request('price') !== null) checked @endif>
                        <label class="form-check-label" for="l">
                            {{ __('under') }} {{ $symbol }}25
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input individual" value="25" type="radio" name="price" id="m"
                            @if (request('price') == 25) checked @endif>
                        <label class="form-check-label" for="m">
                            {{ $symbol }}25 to
                            {{ $symbol }}100
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input individual" value="100" type="radio" name="price" id="n"
                            @if (request('price') == 100) checked @endif>
                        <label class="form-check-label" for="n">
                            {{ $symbol }}100 to
                            {{ $symbol }}300
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input individual" value="300" type="radio" name="price" id="oo"
                            @if (request('price') == 300) checked @endif>
                        <label class="form-check-label" for="oo">
                            {{ $symbol }}300 to
                            {{ $symbol }}500
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input individual" value="500" type="radio" name="price" id="o"
                            @if (request('price') == 500) checked @endif>
                        <label class="form-check-label" for="o">
                            {{ $symbol }}500 to
                            {{ $symbol }}1,000
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input individual" value="1000" type="radio" name="price" id="p"
                            @if (request('price') == 1000) checked @endif>
                        <label class="form-check-label" for="p">
                            {{ $symbol }}1,000 to
                            {{ $symbol }}10,000
                        </label>
                    </div>
                </div>
            </div>
        </div>
        @if($brands && $brands->count())
        <div class="shop-body-01__filter--line"></div>
        <div class="shop-body-01__filter--popularbrands">
            <div class="popularbrands-block-01">
                <h6 class="title">{{ __('popular_brands') }}</h6>
                <div class="form-chek-wrapper">
                    @foreach ($brands as $brand)
                        <div class="form-check">
                            <input class="form-check-input brand" name="brand[]" type="checkbox"
                                id="brand_filter_{{ $brand->id }}" value="{{ $brand->slug }}"
                                {{ request('brand') && in_array($brand->slug, request('brand')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="brand_filter_{{ $brand->id }}">
                                {{ $brand->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        @if($tags && $tags->count())
        <div class="shop-body-01__filter--line"></div>
        <div class="shop-body-01__filter--populartag">
            <div class="populartag-block-02">
                <h6 class="title">{{ __('popular_tag') }}</h6>
                <ul class="tag-wrapper">
                    @foreach ($tags as $tag)
                        <li><a class="{{ request('tag') == $tag->slug ? 'tag-active' : '' }}"
                                href="?tag={{ $tag->slug }}">
                                {{ $tag->name }}
                            </a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>
    {{-- mobile menu start --}}
    <div class="shop-body-01__offcanvas offcanvas-01 d-block d-xl-none">
        <a class="offcanvas-btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
            aria-controls="offcanvasExample">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z" />
            </svg> {{ __('filter') }}
        </a>
        <div class="offcanvas offcanvas-start @if (request('category_m') !== null || request('brand') !== null || request('price_m') !== null || request('tag') !== null) show @endif" tabindex="-1"
            id="offcanvasExample">
            <div class="offcanvas-header">
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="shop-body-01__filter">
                    <div class="shop-body-01__filter--catagory">
                        <div class="category-block-01">
                            <h6 class="title">{{ __('category') }}</h6>
                            @foreach ($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input category" name="category_m"
                                        value="{{ $category->slug }}" type="radio" id="cat_{{ $category->id }}_m"
                                        {{ request('category_m') === $category->slug ? 'checked' : '' }}>
                                    <label class="form-check-label fontcheck" for="cat_{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="shop-body-01__filter--line"></div>
                    <div class="shop-body-01__filter--pricerange">
                        <div class="price-range-block">
                            <h6 class="title mb-5">{{ __('price_range') }}</h6>
                            <div class="price-box">
                                <div class="form-check">
                                    <input class="form-check-input" value="" type="radio" id="select-all"
                                        @if (request('price_m') == null && !request('price_m')) checked @endif>
                                    <label class="form-check-label" for="select-all">
                                        {{ __('all_price') }}
                                    </label>
                                </div>
                                @php
                                    $symbol = config('zakirsoft.symbol');
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input individual" type="radio" name="price_m" value="0"
                                        id="price_1" @if (request('price_m') == 0 && request('price_m') !== null) checked @endif>
                                    <label class="form-check-label" for="price_1">
                                        {{ __('under') }} {{ $symbol }}25
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input individual" value="25" type="radio" name="price_m"
                                        id="price_2" @if (request('price_m') == 25) checked @endif>
                                    <label class="form-check-label" for="price_2">
                                        {{ $symbol }}25 to {{ $symbol }}100
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input individual" value="100" type="radio" name="price_m"
                                        id="price_3" @if (request('price_m') == 100) checked @endif>
                                    <label class="form-check-label" for="price_3">
                                        {{ $symbol }}100 to {{ $symbol }}300
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input individual" value="300" type="radio" name="price_m"
                                        id="price_4" @if (request('price_m') == 300) checked @endif>
                                    <label class="form-check-label" for="price_4">
                                        {{ $symbol }}300 to {{ $symbol }}500
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input individual" value="500" type="radio" name="price_m"
                                        id="price_5" @if (request('price_m') == 500) checked @endif>
                                    <label class="form-check-label" for="price_5">
                                        {{ $symbol }}500 to {{ $symbol }}1,000
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input individual" value="1000" type="radio" name="price_m"
                                        id="price_6" @if (request('price_m') == 1000) checked @endif>
                                    <label class="form-check-label" for="price_6">
                                        {{ $symbol }}1,000 to {{ $symbol }}10,000
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-body-01__filter--line"></div>
                    <div class="shop-body-01__filter--popularbrands">
                        <div class="popularbrands-block-01">
                            <h6 class="title">{{ __('popular_brands') }}</h6>
                            <div class="form-chek-wrapper">
                                @foreach ($brands as $brand)
                                    <div class="form-check">
                                        <input class="form-check-input brand" name="brand[]" type="checkbox"
                                            id="flexCheckChecked4_{{ $brand->id }}" value="{{ $brand->slug }}"
                                            {{ request('brand') && in_array($brand->slug, request('brand')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckChecked4_{{ $brand->id }}">
                                            {{ $brand->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="shop-body-01__filter--line"></div>
                    <div class="shop-body-01__filter--populartag">
                        <div class="populartag-block-02">
                            <h6 class="title">{{ __('popular_tag') }}</h6>
                            <ul class="tag-wrapper">
                                @foreach ($tags as $tag)
                                    <li><a lass="{{ request('tag') == $tag->slug ? 'tag-active' : '' }}"
                                            href="?tag={{ $tag->slug }}" href="?tag={{ $tag->slug }}">
                                            {{ $tag->name }}
                                        </a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- mobile manu ends --}}
</div>

@push('frontend_styles')
    <style>
        .noUi-connect {
            background: var(--bs-primary-500);
        }

        #priceRangeSlider {
            height: 5px;
        }

        .noUi-horizontal .noUi-handle {
            height: 20px;
            width: 20px;
            top: -10px;
            border-radius: 50%;
            border: 2px solid var(--bs-primary-500);
        }

        .tag-active {
            background: var(--bs-primary-500) !important;
            color: #e4e7e9 !important;
        }
    </style>
@endpush
