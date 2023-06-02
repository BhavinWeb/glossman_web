@props(['message' => 'no_data_found', 'button' => false, 'buttonText' => 'explore_products', 'route' => 'website.product'])

<div class="row">
    <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center">
        <img src="{{ asset('frontend') }}/image/empty.png" width="40%" alt="" class="img-fluid mb-4">
        <h3 class="mb-4 p-1">{{ __($message) }}</h3>
        @if ($button)
            <a href="{{ route($route) }}" class="btn btn-primary mb-4">{{ __($buttonText) }}</a>
        @endif
    </div>
</div>
