@extends('website.layouts.app')

@section('meta')
    @php
    $data = metaData('compare');
    @endphp

    <meta name="title" content="{{ $data->title }}">
    <meta name="description" content="{{ $data->description }}">

    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:url" content="{{ route('website.compare') }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $data->description }}">

    <meta name=twitter:card content=summary_large_image />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('website.compare') }}" />
    <meta name=twitter:title content="{{ $data->title }}" />
    <meta name=twitter:description content="{{ $data->description }}" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection

@section('title', __('compare'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('compare') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Content Body Start -->
    <div class="compare-body">
        <div class="container">
            @if ($products->count() > 0)
                <div class="border">
                    <div class="d-flex items-center text-center justify-content-between">
                        <h6 class="compare-list">
                            {{ __('compare_list') }}
                        </h6>
                        <h6 class="compare-list">
                            <a href="{{ url('shop') }}">
                                {{ __('add_another_product') }}
                            </a>
                        </h6>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-product-01 m-0">
                        <thead>
                            <tr>
                                <th class="w-25"></th>
                                @foreach ($products as $product)
                                    <x-frontend.compare.table-th :product="$product" />
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="option">Customer feedback:</td>
                                @foreach ($products as $product)
                                    <x-frontend.compare.rating :rating="$product->avg_rating" :rated="$product->total_rated" />
                                @endforeach
                            </tr>
                            <tr>
                                <td class="option">Price:</td>
                                @foreach ($products as $product)
                                    <x-frontend.compare.price :price="$product->price" />
                                @endforeach
                            </tr>
                            <tr>
                                <td class="option">Brand:</td>
                                @foreach ($products as $product)
                                    <x-frontend.compare.brand :brand="$product->brand->name" />
                                @endforeach
                            </tr>
                            <tr>
                                <td class="option">Stock status:</td>
                                @foreach ($products as $product)
                                    <x-frontend.compare.stock :stock="$product->stock" />
                                @endforeach
                            </tr>
                            <!-- product_attributes  -->
                            @foreach ($allattributes as $attribute)
                                <tr>
                                    <td class="option">{{ Str::ucfirst($attribute->name) }}:</td>
                                    @foreach ($products as $product)
                                        @if ($product->attributes->count() > 0)
                                            @foreach ($product->attributes as $productattribute)
                                                @if ($attribute->id == $productattribute->attribute_id)
                                                    <td class="type">
                                                        <p>{{ Str::ucfirst($productattribute->value) }}</p>
                                                    </td>
                                                @endif
                                            @endforeach
                                        @else
                                            <td class="type">
                                                <p></p>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <x-frontend.not-found message="your_compare_list_is_empty" button="add_product" />
            @endif
        </div>
    </div>
    <!-- Content Body End -->
@endsection

@push('frontend_styles')
    <style>
        .compare-list {
            padding: 16px 24px;
            font-weight: 500;
            font-size: 18px;
            line-height: 20px;
            color: var(--bs-gray-900);
        }
    </style>
@endpush
