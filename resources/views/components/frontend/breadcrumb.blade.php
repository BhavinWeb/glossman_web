<div class="breadcrumb ">
    <div class="container">
        <div class="breadcrumb__navigation">
            <p class="breadcrumb__navigation--text">
                <a class="d-flex align-items-center text-gray-600" href="{{ route('website.index') }}">
                    <x-svg.home />
                    {{ __('home') }}
                </a>
                {{ $slot }}
            </p>
        </div>
    </div>
</div>
