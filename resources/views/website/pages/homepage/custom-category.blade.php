@php
$offer = $content->campaignOffer[0]['campaign'] ?? null;
$offer2 = $content->campaignOffer[1]['campaign'] ?? null;
@endphp

<!-- Product Section Two Start -->
<div class="products-section-02">
    <div class="container">
        <div class="row align-items-stretch">
            <!-- Featured Product Section Start -->
            <x-frontend.home.custom-category-product :subcategories="$custom_category->subcategories ?? null" :products="$custom_category_products ?? null" :name="$custom_category->name ?? null"
                :offerstatus="($offer && $offer->status) || ($offer2 && $offer2->status)" />
            <!-- Featured Product Section End -->
            @if (($offer && $offer->status) || ($offer2 && $offer2->status))
                <div class="col-xxl-3 order-xxl-2 col-lg-3 d-flex flex-column flex-md-row flex-lg-column flex-xl-column align-items-center align-items-sm-start mt-xxl-0 mt-4 campaign-banner-ads-4">
                    @if ($offer->status)
                        <a href="{{ route('website.campaign.details', $offer->slug) }}" class="d-inline-block mb-3 me-md-3 me-0 me-lg-0 me-xxl-0">
                            <img src="{{ $offer->image }}" alt="" class="img-fluid">
                        </a>
                        @endif
                        @if ($offer2->status)
                        <a href="{{ route('website.campaign.details', $offer2->slug) }}" class="d-inline-block">
                            <img src="{{ $offer2->image }}" alt="" class="img-fluid">
                        </a>
                    @endif
                </div>
                {{-- <div class="col-xxl-3 order-xxl-2 d-flex flex-md-row flex-sm-row flex-lg-row flex-column flex-xxl-column align-items-center align-items-sm-start mt-xxl-0 mt-4">
                    @if ($offer->status)
                        <a href="{{ route('website.campaign.details', $offer->slug) }}" class="d-inline-block mb-3 me-md-3 me-sm-3  me-lg-3 me-0 me-xxl-0">
                            <img src="{{ $offer->image }}" alt="" class="img-fluid">
                        </a>
                        @endif
                        @if ($offer2->status)
                        <a href="{{ route('website.campaign.details', $offer2->slug) }}" class="d-inline-block">
                            <img src="{{ $offer2->image }}" alt="" class="img-fluid">
                        </a>
                    @endif
                </div> --}}
            @endif
        </div>
    </div>
</div>
<!-- Product Section Two End -->
