@props(['cartitems', 'total', 'subtotal', 'couponCondition'])

<div class="check-out-body__order-summery">
    <div class="order-summery">
        <h6 class="title">{{ __('order_summery') }}</h6>
        <div class="product-list">
            @foreach ($cartitems as $item)
                <div class="single-item">
                    <div class="img">
                        <img src="{{ $item->attributes->image }}" alt="product">
                    </div>
                    <div class="content">
                        <p>{{ $item->name }}</p>
                        <span>{{ $item->quantity }} x<small>
                                {{ multiCurrency($item->attributes->sale_price ? $item->attributes->sale_price : $item->price) }}</small></span>
                    </div>
                </div>
            @endforeach
        </div>
        <ul class="subtotal-list">
            <li><span class="text">{{ __('subtotal') }}</span><span
                    class="ammount">{{ multiCurrency($subtotal) }}</span>
            </li>

            @if (isset($couponCondition) && $couponCondition)
                <li><span class="text">(-){{ __('coupon') }}</span><span class="ammount">
                        {{ multiCurrency($couponCondition->getType() == 'percentage' ? str_replace('-', '', (str_replace('%', '', $couponCondition->getValue()) / 100) * $subtotal) : str_replace('-', '', $couponCondition->getValue())) }}
                    </span></li>
            @endif
            <li id="checkout_shipping_method" class="d-none"><span class="text">{{ __('shipping') }}
                    (<span id="checkout_shipping_type"></span>)</span>
                <span class="ammount" id="checkout_shipping_amount">0</span>
            </li>
            <li><span class="total-text">{{ __('total') }}</span>
                <span class="total-ammount">{{ multiCurrency($total) }}
                </span>
            </li>
        </ul>
        <div id="order-checkout-buttons">
            <button id="checkout-button-cashon" type="submit" class="btn btn-primary w-100 d-none">
                {{ __('proceed_to_checkout') }}
                <x-svg.arrow-long-right stroke="white" />
            </button>
            <button id="checkout-button" type="button" class="btn btn-primary w-100">
                {{ __('proceed_to_checkout') }}
                <x-svg.arrow-long-right stroke="white" />
            </button>
        </div>
        <button type="button" class="btn btn-primary w-100 d-none" disabled id="order-processing-button">
            <i class="fas fa-spinner fa-spin fa-2x"></i>
        </button>
    </div>
</div>
