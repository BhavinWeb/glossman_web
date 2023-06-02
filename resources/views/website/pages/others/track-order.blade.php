@extends('website.layouts.app')

@section('meta')
    @php
    $data = metaData('track-order');
    @endphp

    <meta name="title" content="{{ $data->title }}">
    <meta name="description" content="{{ $data->description }}">

    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:url" content="{{ route('website.track.order') }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $data->description }}">

    <meta name=twitter:card content=summary_large_image />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('website.track.order') }}" />
    <meta name=twitter:title content="{{ $data->title }}" />
    <meta name=twitter:description content="{{ $data->description }}" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection

@section('title', __('track_order'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('track_order') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Content Body Start -->
    <div class="trackorder-body">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <div class="section-title-block">
                        <h2 class="title">{{ __('track_order') }}</h2>
                        <p class=" text-14 text-gray-600">
                            {{ __('to_track_your_order_please_enter_your_order_id_in_the_input_field_below_and_press_the_track_order_button_this_was_given_to_you_on_your_receipt_and_in_the_confirmation_email_you_should_have_received') }}
                        </p>
                    </div>
                    <div class="order-form">
                        <form action="{{ route('website.track.order.detail') }}" method="get">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="from-group">
                                        <label class="form-label" for="orderid">{{ __('order_id') }}</label>
                                        <input name="order" type="text" class="form-control {{ error('order') }}"
                                            placeholder="e.g - F89Gh456SF" value="{{ old('order') }}">
                                        <x-forms.error name="order" />
                                    </div>
                                </div>
                                <p class="text">
                                    <x-svg.exclamation />
                                    {{ __('order_id_that_was_sent_in_your_email_address') }}
                                </p>
                                <div class="button-group">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('track_order') }}
                                        <x-svg.arrow-long-right width="24" height="24" stroke="white" />
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Body End -->
@endsection
