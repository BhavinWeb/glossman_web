@props([
    'billing' => null,
    'totalorders' => 0,
    'pendingorders' => 0,
    'completedorders' => 0,
])
<div class="dasboard-head">
    <h4 class="title">
        {{ __('hello') }}, {{ Str::ucfirst(auth()->user()->first_name) }}
        {{ Str::ucfirst(auth()->user()->last_name) }}
    </h4>
    <p>{{ __('from_your_account_dashboard_you_can_easily_check_view_your') }} <br>
        <a href="{{ route('website.customer.order.history') }}">
            {{ __('recent_orders') }}
        </a>, {{ __('manage_your') }}
        <a href="{{ route('website.customer.setting') }}">
            {{ __('shipping_and_billing_addresses') }}
        </a> {{ __('and') }} <br> {{ __('edit_your') }}
        <a href="{{ route('website.customer.setting') }}">
            {{ __('password') }}
        </a> {{ __('and') }} <a href="{{ route('website.customer.setting') }}">
            {{ __('account_details') }}.
        </a>
    </p>
</div>
<div class="row card-row">
    <div class="col-lg-4 col-sm-6">
        <div class="account-info-card">
            <h6 class="title">{{ __('account_info') }}</h6>
            <div class="card-body">
                <div class="card-body__head">
                    <div class="client-img">
                        <img src="{{ auth()->user()->image_url }}" alt="client">
                    </div>
                    <div class="client-info">
                        <h6>
                            {{ Str::ucfirst(auth()->user()->first_name) }}
                            {{ Str::ucfirst(auth()->user()->last_name) }}
                        </h6>
                        <p>
                            {{ auth()->user()->city ? auth()->user()->city->name . ', ' : '' }}
                            {{ auth()->user()->state ? auth()->user()->state->name . ', ' : '' }}
                            {{ auth()->user()->country ? auth()->user()->country->name : '' }}
                        </p>
                    </div>
                </div>
                <ul class="card-body__foot">
                    <li>{{ __('email') }}: <span>{{ auth()->user()->email }}</span></li>
                    <li>{{ __('2nd_email') }}: <span> {{ auth()->user()->secondary_email }}</span></li>
                    <li>{{ __('phone') }}: <span>{{ auth()->user()->phone }}</span></li>
                </ul>
                <a href="{{ route('website.customer.setting') }}">
                    <button class="btn btn-outline-secondary">{{ __('edit_account') }}</button>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="billing-address-card">
            <h6 class="title">{{ __('billing_address') }}</h6>
            @if ($billing)
                <div class="card-body">
                    <div class="card-body__head">
                        <div class="client-info">
                            <h6>{{ $billing->first_name }} {{ $billing->last_name }}</h6>
                            <p>
                                {{ $billing->address }}, {{ $billing->city->name }},
                                {{ $billing->state->name }},
                                {{ $billing->country->name }}
                            </p>
                        </div>
                    </div>
                    <ul class="card-body__foot">
                        <li>{{ __('phone_number') }}: <span> +{{ $billing->phone }}</span></li>
                        <li>{{ __('email') }}: <span> {{ $billing->email }}</span></li>
                    </ul>
                    <a href="{{ route('website.customer.setting', '#billing_setting') }}">
                        <button class="btn btn-outline-secondary">{{ __('edit_address') }}</button>
                    </a>
                </div>
            @else
                <div class="card-body">
                    <a href="{{ route('website.customer.setting', '#billing_setting') }}">
                        <button class="btn btn-outline-secondary">{{ __('add_address') }}</button>
                    </a>
                </div>
            @endif
        </div>
    </div>
    <div class="col-lg-4">
        <div class="row card-row align-content-stretch">
            <div class="col-12">
                <div class="fun-fact-card bg-secondary-50">
                    <div class="icon">
                        <x-svg.rocket />
                    </div>
                    <div class="content">
                        <h6 class="title"><span class="counter">{{ $totalorders }}</span></h6>
                        <p class="text">{{ __('total_orders') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="fun-fact-card bg-primary-50">
                    <div class="icon">
                        <x-svg.pending-order />
                    </div>
                    <div class="content">
                        <h6 class="title"><span class="counter">{{ $pendingorders }}</span></h6>
                        <p class="text">{{ __('pending_orders') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="fun-fact-card bg-success-50">
                    <div class="icon">
                        <x-svg.box />
                    </div>
                    <div class="content">
                        <h6 class="title"><span class="counter">{{ $completedorders }}</span></h6>
                        <p class="text">{{ __('completed_orders') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
