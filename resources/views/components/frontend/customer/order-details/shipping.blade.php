@props([
    'order' => null,
])

<div class="shipping-details__head">
    <div class="order-tag">
        <h6 class="tag-text">
            #{{ $order->order_no }}
        </h6>
        <p class="tag-info">{{ $order->order_products_count }} {{ __('products') }}<span
                class="dot d-none d-md-block"></span>
            <br class="d-md-none">
            {{ __('order_placed_in') }} {{ date('d M, Y', strtotime($order->created_at)) }}
            {{ date('m:s A', strtotime($order->created_at)) }}
        </p>
    </div>
    <div class="price-tag">
        <span>{{ multiCurrency($order->total_price) }}</span>
    </div>
</div>
<div class="shipping-details__text">
</div>
