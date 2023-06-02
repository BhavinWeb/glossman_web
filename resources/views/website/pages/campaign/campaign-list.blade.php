@extends('website.layouts.app')

@section('title', __('campaigns'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('campaigns') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <div class="container mt-5">
        <div class="row">
            @forelse ($campaigns as $campaign)
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                    <div class="card mb-3 p-0 text-center">
                        <a href="{{ route('website.campaign.details', $campaign->slug) }}">
                            <img src="{{ $campaign->image }}" alt="..." class="campaign-image">
                        </a>
                        <div class="card-body px-0">
                            <p class="card-text mt-2">
                                <small class="text-muted">
                                    <i class="fa fa-calendar"></i>
                                    {{ formatDate($campaign->start_date, 'd M Y') }}
                                    &nbsp;
                                    -
                                    &nbsp;
                                    <i class="fa fa-calendar"></i>
                                    {{ formatDate($campaign->end_date, 'd M Y') }}
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center my-5 py-5">
                    <h3>{{ __('nothing_found') }}</h3>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@section('frontend_styles')
    <style>
        .campaign-image {
            height: 170px;
            width: 100%;
            object-fit: cover;
        }

    </style>
@endsection
