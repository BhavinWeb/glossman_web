<aside id="sidebar" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ $setting->favicon_image_url }}" alt="{{ __('logo') }}" class="elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="sidebar-nav-wrapper">
            <!-- Sidebar Menu -->
            <nav class="sidebar-main-nav mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                    data-accordion="false">
                    @if ($user->can('dashboard.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('admin.dashboard') ? true : false" route="admin.dashboard" icon="fas fa-tachometer-alt">
                            {{ __('dashboard') }}
                        </x-admin.sidebar-list>
                    @endif


                    <li class="nav-header text-uppercase">{{ __('system_settings') }}</li>
                    <x-admin.sidebar-list :linkActive="Route::is('settings.general') ? true : false" route="settings.general" icon="fas fa-cog">
                        {{ __('general') }}
                    </x-admin.sidebar-list>
                  
                    <x-admin.sidebar-list :linkActive="Route::is('settings.theme') ? true : false" route="settings.theme" icon="fas fa-swatchbook">
                        {{ __('theme') }}
                    </x-admin.sidebar-list>
                  
                   <x-admin.sidebar-list :linkActive="Route::is('settings.seo.*') ? true : false" route="settings.seo.index" icon="fas fa-ring">
                           SEO
                        </x-admin.sidebar-list>
                   
                </ul>
            </nav>
            <!-- Sidebar Menu -->
            @if ($user->can('dashboard.view'))
                <nav class="mt-2 nav-footer border-top pt-5">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview"
                        role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link bg-primary text-light"
                              >
                                <i class="nav-icon fas fa-chevron-left"></i>
                                <p>{{ __('go_back') }}</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            @endif
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
