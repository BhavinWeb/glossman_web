@php
$offer = $content->campaignOffer[0]['campaign'] ?? null;
@endphp

<!-- Cta Two Section Start -->
@if ($offer && $offer->status)
<div class="mb-5 pb-5">
    <div class="container">
        <a href="{{ route('website.campaign.details', $offer->slug) }}">
            <img src="{{ $offer->image }}" alt="" class="img-fluid">
        </a>
    </div>
</div>
@endif
<!-- Cta Two Section End -->
