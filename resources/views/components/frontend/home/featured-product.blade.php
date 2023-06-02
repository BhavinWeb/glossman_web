@props([
    'products' => $products,
    'name' => $name ?? 'Featured Product',
    'offerstatus' => $offerstatus ?? false,
])

<div class="col-xxl-{{ $offerstatus ? '9' : '12' }}">
    <div class="products-section-01__wrappper featured-products-section">
        <div class="products-section-01__wrappper--content">
            <div class="section-title">
                <h2 class="title">{{ $name }}</h2>
            </div>
        </div>
        @if ($products)
            <div class="tab-content" id="pills-tabContentTwo">
                <div class="tab-pane fade show active" id="pills-all-2" role="tabpanel"
                    aria-labelledby="pills-all-2-tab">
                    <div class="products-section-01__wrappper--product">
                        @foreach ($products as $product)
                            <x-frontend.shop.product :product="$product" class="card-product--03" :only-featured="true"
                                :showbadge="false" />
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
