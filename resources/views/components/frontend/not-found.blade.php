@props(['message' => 'data', 'route' => 'website.product', 'showbutton' => true, 'button' => 'explore_products'])

<div class="row">
    <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center">
        <img src="{{ asset('frontend') }}/image/bag.svg" alt="" class="img-fluid mb-4">
        <h2 class="mb-4">{{ __($message) }}</h2>
        @if ($showbutton)
            <a href="{{ route($route) }}" class="btn btn-primary">@lang($button)</a>
        @endif
    </div>
</div>
