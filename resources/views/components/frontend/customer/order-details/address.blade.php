@props(['shipping' => null, 'billing' => null])

<div class="col-lg-4 col-md-6 col-sm-8 col-xs-10">
    <div class="shipping-all-details__address">
        <h4 class="title">{{ __('billing_address') }}</h4>
        <div class="content">
            <h6>{{ $billing->first_name }} {{ $billing->last_name }}</h6>
            <p>
                {{ $billing->address }},
                {{ $billing->city ? $billing->city->name : '' }},
                {{ $billing->state ? $billing->state->name : '' }},
                {{ $billing->country ? $billing->country->name : '' }}
            </p>
            <ul class="list-group">
                <li>{{ __('phone_number') }}: <span> +{{ $billing->phone }}</span></li>
                <li>{{ __('email') }}: <span> {{ $billing->email }}</span></li>
            </ul>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-6 col-sm-8 col-xs-10">
    <div class="shipping-all-details__address">
        <h4 class="title">{{ __('shipping_address') }}</h4>
        <div class="content">
            <h6>{{ $shipping->first_name }} {{ $shipping->last_name }}</h6>
            <p>
                {{ $shipping->address }},
                {{ $shipping->city ? $shipping->city->name : '' }},
                {{ $shipping->state ? $shipping->state->name : '' }},
                {{ $shipping->country ? $shipping->country->name : '' }}
            </p>
            <ul class="list-group">
                <li>{{ __('phone_number') }}: <span> +{{ $shipping->phone }}</span></li>
                <li>{{ __('email') }}: <span> {{ $shipping->email }}</span></li>
            </ul>
        </div>
    </div>
</div>
