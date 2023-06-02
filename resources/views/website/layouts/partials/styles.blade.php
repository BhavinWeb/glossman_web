<link rel="shortcut icon" href="{{ asset('frontend') }}/image/favicon.png" type="image/x-icon" />
<link rel="stylesheet" href="{{ asset('frontend') }}/fonts/fontawesome-5/css/all.css" />
<link rel="stylesheet" href="{{ mix('frontend/vendor.min.css') }}" />
<link rel="stylesheet" href="{{ mix('frontend/app.min.css') }}" />
@yield('frontend_styles')
@stack('frontend_styles')
@php
    $primaryColor = $setting->frontend_primary_color;
    $secondaryColor = $setting->frontend_secondary_color;
@endphp

<style>
    :root {
        --main-nav-txt: {{ $secondaryColor }} !important;
        --main-nav-bg: {{ $primaryColor }} !important;
        /* --main-nav-txt: {{ $setting->frontend_navbar_bg_color }} !important;
        --main-nav-bg: {{ $setting->frontend_navbar_txt_color }} !important; */
        --bs-primary: {{ $primaryColor }} !important;
        --bs-secondary: {{ $secondaryColor }} !important;
        --bs-primary-50: {{ adjustBrightness($primaryColor, 0.9) }} !important;
        --bs-primary-100: {{ adjustBrightness($primaryColor, 0.8) }} !important;
        --bs-primary-200: {{ adjustBrightness($primaryColor, 0.6) }} !important;
        --bs-primary-300: {{ adjustBrightness($primaryColor, 0.4) }} !important;
        --bs-primary-400: {{ adjustBrightness($primaryColor, 0.2) }} !important;
        --bs-primary-500: {{ $primaryColor }} !important;
        --bs-primary-600: {{ adjustBrightness($primaryColor, -0.2) }} !important;
        --bs-primary-700: {{ adjustBrightness($primaryColor, -0.4) }} !important;
        --bs-primary-800: {{ adjustBrightness($primaryColor, -0.6) }} !important;
        --bs-primary-900: {{ adjustBrightness($primaryColor, -0.8) }} !important;

        --bs-secondary-50: {{ adjustBrightness($secondaryColor, 0.9) }} !important;
        --bs-secondary-100: {{ adjustBrightness($secondaryColor, 0.8) }} !important;
        --bs-secondary-200: {{ adjustBrightness($secondaryColor, 0.6) }} !important;
        --bs-secondary-300: {{ adjustBrightness($secondaryColor, 0.4) }} !important;
        --bs-secondary-400: {{ adjustBrightness($secondaryColor, 0.2) }} !important;
        --bs-secondary-500: {{ $secondaryColor }} !important;
        --bs-secondary-600: {{ adjustBrightness($secondaryColor, -0.2) }} !important;
        --bs-secondary-700: {{ adjustBrightness($secondaryColor, -0.4) }} !important;
        --bs-secondary-800: {{ adjustBrightness($secondaryColor, -0.6) }} !important;
        --bs-secondary-900: {{ adjustBrightness($secondaryColor, -0.8) }} !important;
    }
    .select2 .selection {
        width: 100%;
    }
</style>

{!! $setting->header_css !!}
