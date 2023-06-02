<!-- Banner Section Start -->
<div class="banner-area">
    <div class="container">
        <div class="row">
            @php
                $offer = $content->campaignOffer[0]['campaign'] ?? null;
                $offer2 = $content->campaignOffer[1]['campaign'] ?? null;
            @endphp
            <x-frontend.slider :sliders="$sliders" :offerstatus="($offer && $offer->status) || ($offer2 && $offer2->status)" />
            @if (($offer && $offer->status) || ($offer2 && $offer2->status))
                <div class="col-xxl-4">
                    <div class="banner-area__add flex-md-row flex-xxl-column">
                        @if ($offer->status)
                            <a href="{{ route('website.campaign.details', $offer->slug) }}" class="one banner-campaign">
                                <img src="{{ $offer->image }}" alt="" class="img-fluid w-sm-full">
                            </a>
                        @endif
                        @if ($offer2->status)
                            <a href="{{ route('website.campaign.details', $offer2->slug) }}" class="two banner-campaign">
                                <img src="{{ $offer2->image }}" alt="" class="img-fluid w-sm-full">
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- Banner Section End -->
