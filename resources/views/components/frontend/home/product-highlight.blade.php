@props(['trending-products', 'latest-products', 'top-rated-products', 'best-sale-products'])

@if($trendingProducts && $trendingProducts->count() || $bestSaleProducts && $bestSaleProducts->count() || $topRatedProducts && $topRatedProducts->count() || $latestProducts && $latestProducts->count())
<div class="products-section-03 mt-7">
    <div class="container">
        <div class="row card-row">
          @if($trendingProducts && $trendingProducts->count())
          <div class="col-xl-3 col-md-6">
              <div class="section-title">
                  <h2 class="title">{{ __('trending') }}</h2>
              </div>
              <div class="products-section-03__widget">
                  @foreach ($trendingProducts as $product)
                      <x-frontend.shop.product-sm :product="$product" />
                  @endforeach
              </div>
          </div>
          @endif
          @if($bestSaleProducts && $bestSaleProducts->count())
          <div class="col-xl-3 col-md-6">
            <div class="section-title">
              <h2 class="title">{{ __('top_selling') }}</h2>
            </div>
            <div class="products-section-03__widget">
              @foreach ($bestSaleProducts as $product)
              <x-frontend.shop.product-sm :product="$product" />
              @endforeach
            </div>
          </div>
          @endif
          @if($topRatedProducts && $topRatedProducts->count())
          <div class="col-xl-3 col-md-6">
            <div class="section-title">
              <h2 class="title">{{ __('top_rated') }}</h2>
            </div>
            <div class="products-section-03__widget">
              @foreach ($topRatedProducts as $product)
              <x-frontend.shop.product-sm :product="$product" />
              @endforeach
            </div>
          </div>
          @endif
          @if($latestProducts && $latestProducts->count())
          <div class="col-xl-3 col-md-6">
            <div class="section-title">
              <h2 class="title">{{ __('new_arrival') }}</h2>
            </div>
            <div class="products-section-03__widget">
              @foreach ($latestProducts as $product)
              <x-frontend.shop.product-sm :product="$product" />
              @endforeach
            </div>
          </div>
          @endif
        </div>
    </div>
</div>
@endif
