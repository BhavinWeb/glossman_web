@extends('website.layouts.app')

@section('title', __('campaign_products'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('campaign_products') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-xl-12 my-5 pt-5">
                <div class="card text-center">
                    <h2>{{ formatDate($campaign->start_date, 'd M Y') }} -
                        {{ formatDate($campaign->end_date, 'd M Y') }}
                    </h2>
                </div>
                <div class="shop-body-01__product mt-5">
                    @forelse ($campaign->campaignProducts as $campaign_product)
                        <x-frontend.shop.product :product="$campaign_product->product" />
                    @empty
                        <div class="text-center my-5 py-5">
                            <h3>{{ __('nothing_found') }}</h3>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
