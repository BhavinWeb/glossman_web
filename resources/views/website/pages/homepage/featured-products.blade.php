@php
$offer = $content->campaignOffer[0]['campaign'] ?? null;
@endphp

<!-- Product Section One Start -->
<div class="products-section-01">
    <div class="container">
        <div class="row align-items-stretch">
            @if ($offer && $offer->status)
                <div class="col-xxl-3 d-xxl-inline-block d-none">
                    <a href="{{ route('website.campaign.details', $offer->slug) }}">
                        <div class="products-section-01__add h-100 featured-product-campaign">
                            <img src="{{ $offer->image }}" alt="" class="img-fluid">
                        </div>
                    </a>
                </div>
            @endif
            <!-- Featured Product Section Start -->
            <x-frontend.home.featured-product :products="$featured_products" :name="__('featured_products')" :offerstatus="$offer && $offer->status" />
            <!-- Featured Product Section End -->
        </div>
    </div>
</div>
<!-- Product Section One End -->
