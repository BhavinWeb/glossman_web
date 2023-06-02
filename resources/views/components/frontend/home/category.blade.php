@props([
    'categories' => $categories,
])

<div class="shop-category-section-01 my-5 mt-7">
    <div class="container">
        <div class="section-title-block text-center">
            <h2 class="title">{{ __('shop_with_categories') }}</h2>
        </div>
        <div class="shop-category-section-01__slider">
            <div class="product-slider-02">
                @if ($categories->count() > 0)
                    @foreach ($categories as $category)
                        <x-frontend.home.category-card :category="$category" />
                    @endforeach
                @else
                    <div>
                        {{ __('no_data_found') }}
                    </div>
                @endif
            </div>
            <div class="product-slider-02__control-buttons">
                <button class="button button--prev">
                    <x-svg.arrow-long-left width="24" height="24" stroke="white" />
                </button>
                <button class="button button--next">
                    <x-svg.arrow-long-right width="24" height="24" stroke="white" />
                </button>
            </div>
        </div>
    </div>
</div>
