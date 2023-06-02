@extends('website.layouts.app')

@section('meta')
    @php
    $data = metaData('faq');
    @endphp

    <meta name="title" content="{{ $data->title }}">
    <meta name="description" content="{{ $data->description }}">

    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:url" content="{{ route('website.faq') }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $data->description }}">

    <meta name=twitter:card content=summary_large_image />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('website.faq') }}" />
    <meta name=twitter:title content="{{ $data->title }}" />
    <meta name=twitter:description content="{{ $data->description }}" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection

@section('title', __('faq'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('faq') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Faq Body Start -->
    <div class="faq-body">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="faq-body__faq">
                        <h2 class="title">
                            {{ __('frequently_asked_questions') }}
                        </h2>
                        @if($faq->count())
                        <div class="accordion-01">
                            <div class="accordion" id="accordionExample">
                                @foreach ($faq as $list)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button {{ $loop->index ? 'collapsed ' : '' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne{{ $list->id }}" aria-expanded="true"
                                                aria-controls="collapseOne{{ $list->id }}">
                                                {{ $list->question }}
                                            </button>
                                        </h2>

                                        <div id="collapseOne{{ $list->id }}"
                                            class="accordion-collapse collapse {{ $loop->index == '0' ? 'show ' : '' }}"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                {!! $list->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @else 
                            {{ __('no_data_found') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Faq Body End -->
@endsection
