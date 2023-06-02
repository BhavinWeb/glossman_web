@extends('admin.layouts.app')
@section('title')
    {{ __('details') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('details') }}</h3>
                        <a href="{{ route('module.product.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('product_list') }}</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <h3 class="d-inline-block d-sm-none"> {{ $product->title }}</h3>
                                <div class="col-12">
                                    <img src="{{ $product->image_url }}" class="product-image" alt="{{ __('image') }}">
                                </div>
                                <div class="col-12 product-image-thumbs">
                                    <div class="product-image-thumb active">
                                        <img src="{{ $product->image_url }}" alt="Product Image">
                                    </div>
                                    @foreach ($product->galleries as $gallery)
                                        <div class="product-image-thumb ">
                                            <img src="{{ $gallery->image_url }}" alt="Product Image">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="mt-4 product-share">
                                    @php
                                        $leftValue = 5 - $product->avg_rating;
                                    @endphp
                                    @for ($i = 0; $i < $product->avg_rating; $i++)
                                        <a href="#" class="text-warning">
                                            <i class="fas fa-star "></i>
                                        </a>
                                    @endfor
                                    @if ($leftValue > 0)
                                        @for ($i = 0; $i < $leftValue; $i++)
                                            <a href="#" class="text-warning">
                                                <i class="far fa-star "></i>
                                            </a>
                                        @endfor
                                    @endif
                                    <span>{{ $product->avg_rating }} {{ __('star_rating') }}
                                        ({{ $product->total_rated }} {{ __('user_feedback') }})</span>
                                </div>
                                <h3 class="my-3">
                                    {{ $product->title }}
                                </h3>
                                <div class="w-50 mb-3 text-center">
                                    <div class="d-flex justify-content-between">
                                        <span>{{ __('sku') }}: {{ $product->sku }}</span>
                                        <span>{{ __('brand') }}: {{ $product->brand->name }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>{{ __('availability') }}: @if ($product->stock > 0)
                                                <span class="text-success">{{ __('in_stock') }}</span>
                                            @else
                                                <span class="text-danger">{{ __('out_of_stock') }}</span>
                                            @endif
                                        </span>
                                        <span>{{ __('category') }}: {{ $product->category->name }}</span>
                                    </div>
                                </div>
                                <p>{{ $product->short_description }}</p>
                                <hr>
                                @foreach ($attributes as $attributes)
                                    <h4>{{ $attributes[0]->attribute->name }}</h4>
                                    <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                                        @foreach ($attributes as $attribute)
                                            <label class="btn btn-default text-center active">
                                                <input type="radio" name="color_option" id="color_option_a1"
                                                    autocomplete="off" checked="">
                                                {{ ucwords($attribute->value) }}
                                                <br>
                                            </label>
                                        @endforeach
                                    </div>
                                @endforeach
                                <div class="bg-gray py-2 px-3 mt-4">
                                    @if ($product->sale_price)
                                        <h2 class="mb-0">
                                            {{ multiCurrency($product->sale_price) }}
                                            <del>{{ multiCurrency($product->price) }}</del>
                                        </h2>
                                    @else
                                        <h2 class="mb-0">
                                            {{ multiCurrency($product->price) }}
                                        </h2>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <nav class="w-100">
                                <div class="nav nav-tabs" id="product-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab"
                                        href="#tab_description" role="tab" aria-controls="product-desc"
                                        aria-selected="true">{{ __('description') }}</a>
                                    <a class="nav-item nav-link" id="product-desc-tab" data-toggle="tab"
                                        href="#tab_additional" role="tab" aria-controls="product-desc"
                                        aria-selected="true">{{ __('additional_information') }}</a>
                                    <a class="nav-item nav-link" id="product-desc-tab" data-toggle="tab"
                                        href="#tab_specification" role="tab" aria-controls="product-desc"
                                        aria-selected="true">{{ __('specification') }}</a>
                                    <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab"
                                        href="#tab_rating" role="tab" aria-controls="product-rating"
                                        aria-selected="false">{{ __('rating') }}</a>
                                </div>
                            </nav>
                            <div class="tab-content p-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="tab_description" role="tabpanel"
                                    aria-labelledby="product-desc-tab">
                                    {!! $product->long_description ?? 'Nothing found' !!}
                                </div>
                                <div class="tab-pane fade" id="tab_additional" role="tabpanel"
                                    aria-labelledby="product-comments-tab">
                                    {!! $product->additional_information ?? 'Nothing found' !!}
                                </div>
                                <div class="tab-pane fade" id="tab_specification" role="tabpanel"
                                    aria-labelledby="product-comments-tab">
                                    {!! $product->specification ?? 'Nothing found' !!}
                                </div>
                                <div class="tab-pane fade" id="tab_rating" role="tabpanel"
                                    aria-labelledby="tab_rating-tab">
                                    @foreach ($product->reviews as $review)
                                        @if ($review->status)
                                            <div class="list-group">
                                                <a href="javascript:void(0)"
                                                    class="list-group-item list-group-item-action flex-column align-items-start">
                                                    <div class="d-flex  justify-content-between">
                                                        <h5 class="mb-1">{{ $review->user->full_name }}</h5>
                                                        <small>
                                                            {{ $review->created_at->diffForHumans() }}
                                                        </small>
                                                    </div>
                                                    <p class="mb-1">{{ $review->comment }}</p>
                                                    @for ($i = 0; $i < $review->stars; $i++)
                                                        <x-svg.star />
                                                    @endfor
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.product-image-thumb').on('click', function() {
                var $image_element = $(this).find('img')
                $('.product-image').prop('src', $image_element.attr('src'))
                $('.product-image-thumb.active').removeClass('active')
                $(this).addClass('active')
            })
        })
    </script>
@endsection
