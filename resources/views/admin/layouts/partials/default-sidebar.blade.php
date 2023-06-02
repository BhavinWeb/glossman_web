<aside id="sidebar" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ $setting->favicon_image_url }}" alt="{{ __('logo') }}" class="elevation-3">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-nav-wrapper">
            <!-- Sidebar Menu -->
            <nav class="sidebar-main-nav mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                    data-accordion="false">
                    @if (userCan('dashboard.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('admin.dashboard') ? true : false" route="admin.dashboard" icon="fas fa-tachometer-alt">
                            {{ __('dashboard') }}
                        </x-admin.sidebar-list>
                    @endif
					
                    
                    @if (userCan('order.view') && Module::collections()->has('Order'))
                    <li class="nav-header text-uppercase">{{ __('order') }}</li>
                        <x-admin.sidebar-list :linkActive="Route::is('module.order.index') ? true : false" route="module.order.index" icon="fas fa-box">
                            {{ __('order') }}
                        </x-admin.sidebar-list>
                    @endif
                    
                  	@if (userCan('customer.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.customer.*') ? true : false" route="module.customer.index" icon="fas fa-users">
                            {{ __('customer') }} 
                        </x-admin.sidebar-list>
                    @endif
                  
                  	 @if (userCan('coupon.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('.*') ? true : false" route="coupon.index" icon="fas fa-tag">
                            {{ __('coupon') }}
                        </x-admin.sidebar-list>
                    @endif
                  
                  @if (userCan('service.view'))
                   <li class="nav-header text-uppercase">Service</li>
                   <x-admin.sidebar-list :linkActive="Route::is('module.service.index') ? true : false" route="module.service.index" icon="fab fa-product-hunt">
                                  Service 
                    </x-admin.sidebar-list>
                  @endif
                  
                  @if (userCan('service.bookingView'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.service.booking') ? true : false" route="module.service.booking" icon="fab fa-product-hunt">
                            Service Booking
                        </x-admin.sidebar-list>
                  @endif
                  
                   @if (userCan('package.view'))
                  <li class="nav-header text-uppercase">Packages</li>
                  <x-admin.sidebar-list :linkActive="Route::is('module.package.*') ? true : false" route="module.package.index" icon="fab fa-product-hunt">
                    Packages 
                  </x-admin.sidebar-list>
                  @endif
                  
                  @if (userCan('driver.view'))
						<!-- Driver -->
                        <li class="nav-header text-uppercase">Driver</li>
			                
						<x-admin.sidebar-list :linkActive="Route::is('admin.driver.*') ? true : false" route="admin.driver" icon="fab fa-product-hunt">
                            Driver
                        </x-admin.sidebar-list>
                        <!-- Driver ends -->
				@endif
                  @if (userCan('product.view'))
                    <!-- ====== Discount start ======== -->
                    <li class="nav-header text-uppercase">{{ __('products') }}</li>
                    <!-- ====== Product Start======== -->
                        <x-admin.sidebar-list :linkActive="Route::is('module.product.*') ? true : false" route="module.product.index" icon="fab fa-product-hunt">
                            {{ __('product') }}
                        </x-admin.sidebar-list>
                    @endif
                  
                  @if (userCan('category.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.category.*') || Route::is('module.subcategory.*') ? true : false" route="module.category.index" icon="fas fa-th-large">
                            {{ __('category') }}
                        </x-admin.sidebar-list>
                    @endif
                   @if (userCan('category.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.service_p.*') ? true : false" route="module.service_p.index" icon="fas fa-th-large">
                            {{ __('service_product') }}
                        </x-admin.sidebar-list>
                    @endif
                  
                  @if (userCan('brand.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.brand.*') ? true : false" route="module.brand.index" icon="fas fa-ring">
                            {{ __('brand') }}
                        </x-admin.sidebar-list>
                    @endif
                  @if (userCan('slider.view') || Module::collections()->has('Location') || userCan('faq.view'))
                   <li class="nav-header text-uppercase">{{ __('others') }}</li>
                    <!-- ====== slider Start ======== -->
                    @if (userCan('slider.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.slider.*') ? true : false" route="module.slider.index" icon="fas fa-sliders-h">
                            {{ __('slider') }}
                        </x-admin.sidebar-list>
                    @endif
                  
                  <!-- ====== Location Start======== -->
                    @if (Module::collections()->has('Location'))
                        @if (userCan('country.view') || userCan('state.view') || userCan('city.view') )
                            <x-admin.sidebar-dropdown :linkActive="Route::is('module.country*') ||
                            Route::is('module.state*') ||
                            Route::is('module.city*')
                                ? true
                                : false" :subLinkActive="Route::is('module.country*') ||
                            Route::is('module.state*') ||
                            Route::is('module.city*')
                                ? true
                                : false" icon="fas fa-map">
                                @slot('title')
                                    {{ __('location') }}
                                @endslot
                                @if (userCan('country.view'))
                                    <ul class="nav nav-treeview">
                                        <x-admin.sidebar-list :linkActive="Route::is('module.country.*') ? true : false" route="module.country.index"
                                            icon="fas fa-circle">
                                            {{ __('country') }}
                                        </x-admin.sidebar-list>
                                    </ul>
                                @endif
                                @if (userCan('state.view'))
                                    <ul class="nav nav-treeview">
                                        <x-admin.sidebar-list :linkActive="Route::is('module.state.*') ? true : false" route="module.state.index"
                                            icon="fas fa-circle">
                                            {{ __('state') }}
                                        </x-admin.sidebar-list>
                                    </ul>
                                @endif
                                @if (userCan('city.view'))
                                    <ul class="nav nav-treeview">
                                        <x-admin.sidebar-list :linkActive="Route::is('module.city.*') ? true : false" route="module.city.index"
                                            icon="fas fa-circle">
                                            {{ __('city') }}
                                        </x-admin.sidebar-list>
                                    </ul>
                                @endif
                            </x-admin.sidebar-dropdown>
                        @endif
                    @endif

                    <!-- ====== Faq Start ======== -->
                    @if (userCan('faq.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.faq.*') ? true : false" route="module.faq.index" icon="fas fa-question-circle">
                            {{ __('faq') }}
                        </x-admin.sidebar-list>
                    @endif
                  @endif
                  @if (userCan('admin.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('user.*') ? true : false" route="user.index" icon="fas fa-users">
                            {{ __('user_role_manage') }}
                        </x-admin.sidebar-list>
                    @endif
                   
                </ul>
            </nav>
            <!-- Sidebar Menu -->
            <nav class="mt-2 nav-footer border-secondary pt-5">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview1" role="menu"
                    data-accordion="false">
                   	 <li class="nav-item">
                        <a target="_blank" href="/" class="nav-link bg-primary text-light"
                            >
                            <i class="nav-icon fas fa-globe"></i>
                            <p>{{ __('visit_website') }}</p>
                        </a>
                    </li>
                    @if (userCan('setting.view') || userCan('setting.update'))
                        <x-admin.sidebar-list :linkActive="request()->is('admin/settings/*') ? true : false" route="settings.general" icon="fas fa-cog">
                            {{ __('settings') }}
                        </x-admin.sidebar-list>
                    @endif
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>{{ __('sign_out') }} </p>
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                            class="d-none invisible">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
