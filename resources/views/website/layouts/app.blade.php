<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @yield('meta')
    <title>@yield('title') - {{ config('app.name') }}</title>
    @include('website.layouts.partials.styles')
</head>

<body>
    <div class="site-wrapper overflow-hidden">
        <!-- Header Section Start -->
        @include('website.layouts.partials.header')

        @yield('website-content')

        <!-- Footer Section Start -->
        @include('website.layouts.partials.footer')
        <!-- Footer Section End -->
    </div>

    <!-- Product Modal-->
    <x-frontend.modal.product-quick-view />

    <!-- Plugin's Scripts -->
    @include('website.layouts.partials.scripts')
</body>

</html>
