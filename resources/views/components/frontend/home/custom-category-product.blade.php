@props([
    'subcategories' => $subcategories,
    'products' => $products,
    'name' => $name ?? 'Category Product',
    'offerstatus' => $offerstatus ?? false,
])

<div class="col-lg-{{ $offerstatus ? '9' : '12' }}">
    <div class="products-section-01__wrappper">
        <div class="products-section-01__wrappper--content">
            <div class="section-title">
                <h2 class="title">{{ $name }}</h2>
            </div>
            <div class="button-group">
                <ul class="nav nav-pills" id="pills-tabtwo" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="custom-category-product-tab" data-bs-toggle="pill"
                            data-bs-target="#custom-category-product" type="button" role="tab"
                            aria-controls="custom-category-product" aria-selected="true">{{ __('all_product') }}</button>
                    </li>
                    @if ($subcategories)
                        @foreach ($subcategories as $subcategory)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="{{ $subcategory->slug }}-tab" data-bs-toggle="pill"
                                    data-bs-target="#{{ $subcategory->slug }}" type="button" role="tab"
                                    aria-controls="{{ $subcategory->slug }}" aria-selected="false">
                                    {{ $subcategory->name }}
                                </button>
                            </li>
                        @endforeach
                    @endif
                </ul>
                <div class="all-product-button">
                    <a class="text-btn" href="{{ route('website.product') }}">
                        {{ __('browse_all_product') }}
                        <x-svg.arrow-long-right width="20" height="20" stroke="var(--bs-primary-500)" />
                    </a>
                </div>
            </div>
        </div>
        @if ($products)
            <div class="tab-content" id="pills-tabContentTwo">
                <div class="tab-pane fade show active" id="custom-category-product" role="tabpanel"
                    aria-labelledby="custom-category-product-tab">
                    <div class="products-section-01__wrappper--product">
                        @foreach ($products as $product)
                            <x-frontend.shop.product :product="$product" class="card-product--03" />
                        @endforeach
                    </div>
                </div>
                @if ($subcategories)
                    @foreach ($subcategories as $subcategory)
                        <div class="tab-pane fade" id="{{ $subcategory->slug }}" role="tabpanel"
                            aria-labelledby="{{ $subcategory->slug }}-tab">
                            <div class="products-section-02__wrappper--product">
                                @foreach ($subcategory->products as $product)
                                    <x-frontend.shop.product :product="$product" class="card-product--03" />
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        @endif
    </div>
</div>
