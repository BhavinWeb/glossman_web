@php
$user = auth()->user();
$adminNotifications = unNotifications();
@endphp
{{-- data-toggle="tooltip" data-placement="top" title="Quick Action" --}}
<li class="nav-item dropdown">
    <a class="nav-link d-flex justify-content-center align-items-center bootstrap-tooltip" data-toggle="dropdown" href="#"
        aria-expanded="false" data-placement="top" title="{{ __('quick_actions') }}">
        <i class="fas fa-plus"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">{{ __('quick_actions') }}</span>
        <div class="dropdown-divider"></div>
        <div class="row row-paddingless quick-action-bar">
            @if (userCan('product.create'))
                <div class="col-6 p-0 border-bottom border-right">
                    <a href="{{ route('module.product.create') }}" class="d-block text-center py-3 bg-hover-light"> <i
                            class="fab fa-product-hunt"></i>
                        <span class="w-100 d-block text-muted">{{ __('add_product') }}</span>
                    </a>
                </div>
            @endif
            @if (userCan('coupon.create'))
                <div class="col-6 p-0 border-bottom border-right">
                    <a href="{{ route('coupon.create') }}" class="d-block text-center py-3 bg-hover-light"> <i
                            class="fas fa-tag"></i>
                        <span class="w-100 d-block text-muted">{{ __('add_coupon') }}</span>
                    </a>
                </div>
            @endif
            @if (userCan('category.create'))
                <div class="col-6 p-0 border-bottom border-right">
                    <a href="{{ route('module.category.create') }}" class="d-block text-center py-3 bg-hover-light">
                        <i class="fas fa-th-large"></i>
                        <span class="w-100 d-block text-muted">{{ __('add_category') }}</span>
                    </a>
                </div>
            @endif
            @if (userCan('brand.create'))
                <div class="col-6 p-0 border-bottom border-right">
                    <a href="{{ route('module.brand.index') }}" class="d-block text-center py-3 bg-hover-light"> <i
                            class="fas fa-ring"></i>
                        <span class="w-100 d-block text-muted">{{ __('add_brand') }}</span>
                    </a>
                </div>
            @endif
           
            @if (userCan('setting.view') || userCan('setting.update'))
                <div class="col-6 p-0 border-bottom border-right">
                    <a href="{{ route('settings.general') }}" class="d-block text-center py-3 bg-hover-light"> <i
                            class="fas fa-cog"></i>
                        <span class="w-100 d-block text-muted">{{ __('settings') }}</span>
                    </a>
                </div>
            @endif
        </div>
        <div class="dropdown-divider"></div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link d-flex justify-content-center align-items-center bootstrap-tooltip" data-widget="fullscreen" href="#"
        role="button" data-placement="top" title="{{ __('full_screen') }}">
        <i class="fas fa-expand-arrows-alt"></i>
    </a>
</li>
<li class="nav-item">
    <form action="{{ route('settings.mode.update') }}" method="post" id="mode_form">
        @csrf
        @method('PUT')
        @if ($setting->dark_mode)
            <input type="hidden" name="dark_mode" value="0">
        @else
            <input type="hidden" name="dark_mode" value="1">
        @endif
    </form>
    <a onclick="$('#mode_form').submit()" class="nav-link d-flex justify-content-center align-items-center bootstrap-tooltip" href="#"
        role="button" data-placement="top" title="{{ __('theme_mode') }}">
        @if ($setting->dark_mode)
            <i class="fas fa-sun"></i>
        @else
            <i class="fas fa-moon"></i>
        @endif
    </a>
</li>
<li class="nav-item dropdown d-none" onclick="ReadNotification()">
    <a class="nav-link d-flex justify-content-center align-items-center bootstrap-tooltip" data-toggle="dropdown" href="#"
        aria-expanded="true" data-placement="top" title="{{ __('notifications') }}">
        <i class="fas fa-bell"></i>
        @if ($adminNotifications != 0)
            <span class="badge badge-warning navbar-badge" id="unNotifications">
                {{ $adminNotifications }}
            </span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header text-md">{{ __('notifications') }}</span>
        @if (Notifications()->count() > 0)
            @foreach (Notifications() as $notification)
                <div class="dropdown-divider"></div>
                <a href="{{ route('module.order.show', $notification->data['order']['order_no']) }}"
                    class="dropdown-item word-break">
                    @if ($notification->type == 'App\Notifications\Backend\OrderPlacedNotification')
                        {{ multiCurrency($notification->data['order']['total_price']) }} -
                    @endif
                    {{ Str::limit($notification->data['title'], 30, '...') }}
                    <span
                        class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                </a>
            @endforeach
        @else
            <span class="d-flex justify-content-center mb-2 text-sm">
                {{ __('no_notification') }}
            </span>
        @endif
        @if (Notifications()->count() != 0)
            <div class="dropdown-divider"></div>
            <a href="{{ route('admin.all.notification') }}"
                class="dropdown-item dropdown-footer">{{ __('see_all_notifications') }}</a>
        @endif
    </div>
</li>
<li class="nav-item dropdown user-menu">
    <a href="{{ route('profile') }}" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        @if ($user->image_url)
            <img src="{{ $user->image_url }}" class="user-image img-circle elevation-2">
        @else
            <img src="{{ asset('image/default.png') }}" class="user-image img-circle elevation-2">
        @endif
        <span class="d-none d-md-inline">{{ $user->name }}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right rounded border-0">
        <!-- User image -->
        <li class="user-header bg-primary rounded-top">
            <img src="{{ $user->image_url }}" class="user-image img-circle elevation-2"
                alt="{{ __('user_image') }}">
            <p>
                {{ $user->name }} -
                @foreach ($user->getRoleNames() as $role)
                    (<span>{{ ucwords($role) }}</span>)
                @endforeach
                <small>{{ __('member_since') }} {{ $user->created_at->format('M d, Y') }}</small>
            </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer border-bottom d-flex">
            <a href="{{ route('profile') }}" class="btn btn-default">{{ __('profile') }}</a>
            <a href="javascript:void(0)"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                class="btn btn-default ml-auto">{{ __('sign_out') }}</a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none invisible">
                @csrf
            </form>
        </li>
    </ul>
</li>
