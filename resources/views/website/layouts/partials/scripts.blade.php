 <script src="{{ mix('frontend/vendor.min.js') }}"></script>
 <script src="{{ mix('frontend/app.min.js') }}"></script>

 @include('website.layouts.partials.script.others')
 @include('website.layouts.partials.script.notification')
 @include('website.layouts.partials.script.cart')
 @yield('frontend_scripts')
 @stack('frontend_scripts')

 {!! $setting->body_script !!}
