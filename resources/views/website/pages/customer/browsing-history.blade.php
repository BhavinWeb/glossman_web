@extends('website.layouts.app')

@section('title', __('browsing_history'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <a class="d-flex align-items-center text-gray-600" href="{{ route('website.customer.dashboard') }}">
            {{ __('dashboard') }}
        </a>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('browsing_history') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Content Body Start -->
    <div class="browsing-history">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="dasboard-body__side-nav">
                        <div class="dasboard-body__side-nav--desk d-none d-lg-block">
                            <x-frontend.customer.side-bar />
                        </div>
                        <!--✯✯✯✯✯ CUSTOMER MOBILE SIDEBAR START ✯✯✯✯✯-->
                        <x-frontend.customer.mobile-side-bar />
                        <!--✯✯✯✯✯ CUSTOMER MOBILE SIDEBAR END ✯✯✯✯✯-->
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="browsing-history__head">
                        <h2 class="title">{{ __('browsing_history') }}</h2>
                        <form id="browseOnOff" action="{{ route('website.customer.save.browse.history') }}" method="POST">
                            @csrf
                            <div class="wrapper">
                                <p>{{ __('turn_browsing_history_on_off') }}</p>
                                <div class="switcher">
                                    <input type="checkbox" onclick="document.getElementById('browseOnOff').submit()"
                                        value="1" name="save_browse_history" class="input-switch"
                                        {{ Session::get('browse_history_save') ? 'checked' : '' }}>
                                </div>
                            </div>
                        </form>
                    </div>
                    <form id="browse-filter" action="{{ route('website.customer.browse.history') }}" method="get">
                        <div class="browsing-history__filter">
                            <x-frontend.customer.browsing-history.filter />
                        </div>
                    </form>
                    <div class="shop-body-01__active-result">
                        <x-frontend.customer.browsing-history.filter-data :count="$browse_products->count()" />
                    </div>
                    @if ($browse_products->count() > 0)
                        @foreach ($browse_products as $key => $products)
                            <div class="product-history">
                                <h6 class="date">{{ date('d M Y', strtotime($key)) }}</h6>
                                <div class="row justify-content-center justify-content-xs-start gx-lg-1 card-row product">
                                    @foreach ($products as $product)
                                        <x-frontend.customer.browsing-history.product-card :product="$product" />
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        <a class="{{ request('items') == 'all' ? 'd-none' : '' }}"
                            href="{{ route('website.customer.browse.history', ['items' => 'all']) }}">
                            <div class="load-btn">
                                <button class="btn btn-outline-primary">
                                    <x-svg.spinner />
                                    {{ __('load_all') }}
                                </button>
                            </div>
                        </a>
                    @else
                        <div class="mt-4 text-center">
                            {{ __('nothing_found') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Content Body End -->
@endsection

@section('frontend_scripts')

    <script>
        function RemoveFromBrowse(product) {

            $.ajax({
                url: `/customer/remove/from/browse/history/${product}`,
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(data) {
                    location.reload();
                }
            });
        }

        function FilterRemove(name) {

            $(`input[name=${name}]`).val('');
            $('#browse-filter').submit();
        }
    </script>

@endsection
