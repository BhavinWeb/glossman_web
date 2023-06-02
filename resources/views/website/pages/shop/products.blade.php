@extends('website.layouts.app')

@section('meta')
    @php
    $data = metaData('products');
    @endphp

    <meta name="title" content="{{ $data->title }}">
    <meta name="description" content="{{ $data->description }}">

    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:url" content="{{ route('website.product') }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $data->description }}">

    <meta name=twitter:card content=summary_large_image />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('website.product') }}" />
    <meta name=twitter:title content="{{ $data->title }}" />
    <meta name=twitter:description content="{{ $data->description }}" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection

@section('title', __('shop'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('shop') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Shop Body Start -->
    <div class="shop-body-01">
        <form id="form" action="{{ route('website.product') }}" method="get">
            <div class="container">
                <div class="row">
                    <x-frontend.shop.filters :categories="$categories" :brands="$brands" :tags="$tags" />
                    <div class="col-xl-9">
                        <div class="shop-body-01__searchsortbox">
                            <x-frontend.shop.search-filter />
                        </div>
                        <div class="shop-body-01__active-result">
                            <ul class="keyword">
                                <li class="key-text">{{ __('active_filters') }}:</li>
                                @if (request('keyword') !== null)
                                    <li>
                                        <span>{{ request('keyword') }}</span>
                                        <x-frontend.active-filters closeFunction="closeKeyword()" />
                                    </li>
                                @endif
                                @if (request('category') !== null)
                                    <li>
                                        <span>{{ request('category') }}</span>
                                        <x-frontend.active-filters closeFunction="closeCategory()" />
                                    </li>
                                @endif
                                @if (request('category_m') !== null)
                                    <li>
                                        <span>{{ request('category_m') }}</span>
                                        <x-frontend.active-filters closeFunction="closeCategory()" />
                                    </li>
                                @endif
                                @if (request('tag') !== null)
                                    <li>
                                        <span>{{ request('tag') }}</span>
                                        <x-frontend.active-filters closeFunction="closeTag()" />
                                    </li>
                                @endif
                            </ul>
                            <div class="results-found">
                                <span class="number">{{ $products->total() }}</span>
                                <span class="text">{{ __('results_found') }}.</span>
                            </div>
                        </div>
                        @if ($products && count($products))
                            <div class="shop-body-01__product">
                                @foreach ($products as $product)
                                    <x-frontend.shop.product :product="$product" />
                                @endforeach
                            </div>
                            {!! $products->links('vendor.pagination.frontend') !!}
                        @else
                            <x-frontend.not-found message="no_products_found" :showbutton="false" />
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Shop Body End -->

    <!-- Product Attribute Modal -->
    <x-frontend.modal.product-attribute />
@endsection

@section('frontend_styles')
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/nouislider.min.css">
    <style>
        body {
            overflow: unset !important;
        }
    </style>
@endsection

@section('frontend_scripts')
    <script src="{{ asset('frontend') }}/js/nouislider.min.js"></script>
    <script src="{{ asset('frontend') }}/js/wNumb.min.js"></script>
    <script>
        $('#form').on('change', function() {
            changeFilter();
        });

        function closeKeyword() {
            $('#keyword').val('');
            $('#form').submit();
        }

        function closeCategory() {
            $('.category').val('');
            $('#form').submit();
        }

        function closeBrand() {
            $('.brand').val('');
            $('#form').submit();
        }

        function closeTag() {
            window.location.replace('{{ route('website.product') }}');
        }
    </script>
    <script>
        function changeFilter() {
            const slider = document.getElementById('priceRangeSlider')
            const value = slider.noUiSlider.get(true);
            document.getElementById('price_min').value = value[0]
            document.getElementById('price_max').value = value[1]
            const form = $('#form')
            const data = form.serializeArray();
            $('#form').submit()
        }

        function setDefaultPriceRangeValue() {
            const slider = document.getElementById('priceRangeSlider')
            slider.noUiSlider.set([{{ request('price_min') }}, {{ request('price_max') }}]);
        }

        $(document).ready(function() {
            const slider = document.getElementById('priceRangeSlider')
            let maxRange = Number.parseInt("{{ $maxPrice ?? 500 }}")
            let minPrice = 0;
            let maxPrice = maxRange;

            @if (request()->has('price_min') && request()->has('price_max'))
                minPrice = Number.parseInt("{{ request('price_min', 0) }}")
                maxPrice = Number.parseInt("{{ request('price_max', $maxPrice) }}")
            @endif
            noUiSlider.create(slider, {
                start: [minPrice, maxPrice],
                connect: true,
                range: {
                    min: [0],
                    max: [maxRange],
                },
                format: wNumb({
                    decimals: 0,
                    thousand: ',',
                    suffix: ' ({{ env('APP_CURRENCY_SYMBOL') }})',
                }),
                tooltips: true,
            });

            slider.noUiSlider.on('change', function() {
                changeFilter();
            });
        });
    </script>
@endsection
