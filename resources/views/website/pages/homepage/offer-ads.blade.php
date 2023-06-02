@php
$offer = $content->campaignOffer[0]['campaign'] ?? null;
$offer2 = $content->campaignOffer[1]['campaign'] ?? null;
@endphp

<!-- Banner Two Section Start -->
@if (($offer && $offer->status) || ($offer && $offer2->status))
    <div class="banner-area-02">
        <div class="container">
            <div class="row">
                @if ($offer->status)
                    <div class="col-xl-6 col-md-6">
                        <a href="{{ route('website.campaign.details', $offer->slug) }}">
                            <div class="banner-area-02__add-one mb-2">
                                <img src="{{ $offer->image }}" alt="" class="img-fluid">
                            </div>
                        </a>
                    </div>
                @endif
                @if ($offer2->status)
                    <div class="col-xl-6 col-md-6">
                        <a href="{{ route('website.campaign.details', $offer2->slug) }}">
                            <div class="banner-area-02__add-two">
                                <img src="{{ $offer2->image }}" alt="" class="img-fluid">
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
<!-- Banner Two Section End -->
