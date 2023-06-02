<div class="dashboard-nav-block">
    <ul>
        <li class="{{ request()->routeIs('website.customer.dashboard') ? 'active' : '' }}">
            <a href="{{ route('website.customer.dashboard') }}">
                <x-svg.dashboard />
                {{ __('dashboard') }}
            </a>
        </li>
        <li
            class="{{ request()->routeIs('website.customer.order.history') || request()->routeIs('website.customer.order.detail')? 'active': '' }}">
            <a href="{{ route('website.customer.order.history') }}">
                <x-svg.order-history />
                {{ __('order_history') }}
            </a>
        </li>
        <li><a href="{{ route('website.track.order') }}">
                <x-svg.location />
                {{ __('track_order') }}
            </a></li>
        <li><a href="{{ route('website.cart') }}">
                <x-svg.cart width="20" height="20" fill="#333" />
                {{ __('shoping_cart') }}
            </a></li>
        <li>
            <a href="{{ route('website.customer.wishlist') }}">
                <x-svg.heart width="20" height="20" />
                {{ __('wishlist') }}
            </a>
        </li>
        <li class="{{ request()->routeIs('website.compare') ? 'active' : '' }}">
            <a href="{{ route('website.compare') }}">
                <x-svg.compare width="20" height="20" />
                {{ __('compare') }}
            </a>
        </li>
        <li class="{{ request()->routeIs('website.customer.address') ? 'active' : '' }}"><a
                href="{{ route('website.customer.address') }}">
                <x-svg.address width="20" height="20" />
                {{ __('address') }}
            </a></li>
        <li class="{{ request()->routeIs('website.customer.browse.history') ? 'active' : '' }}">
            <a href="{{ route('website.customer.browse.history') }}">
                <x-svg.history width="20" height="20" />
                {{ __('browsing_history') }}
            </a>
        </li>
        <li class="{{ request()->routeIs('website.customer.setting') ? 'active' : '' }}">
            <a href="{{ route('website.customer.setting') }}">
                <x-svg.setting width="20" height="20" />
                {{ __('settings') }}
            </a>
        </li>
        <li><a href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <x-svg.log-out width="20" height="20" />
                {{ __('logout') }}
            </a></li>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </ul>
</div>
