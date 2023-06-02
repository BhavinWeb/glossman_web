@props([
    'order' => null,
])

<div class="shipping-details__progress-info">
    <div
        class="next-step-item {{ $order->order_status == 'pending' ||
        $order->order_status == 'processing' ||
        $order->order_status == 'on_the_way' ||
        $order->order_status == 'delivered' ||
        $order->order_status == 'cancelled'
            ? 'next-step-item-finish'
            : '' }}">
        <div class="next-step-item-tail">
            <div class="next-step-item-tail-underlay">
                <div class="next-step-item-tail-overlay w-100-p"></div>
            </div>
        </div>
        <div class="next-step-item-container">
            <div class="next-step-item-node">
                <span class="next-step-item-node-dot"></span>
                <div class="complete-check">
                    <x-svg.checked width="12" height="12" />
                </div>
            </div>
            <div class="next-step-item-title">
                <div class="icon">
                    <x-svg.dot />
                </div>
                <p>{{ __('order_placed') }}</p>
            </div>
        </div>
    </div>
    <div
        class="next-step-item {{ $order->order_status == 'processing' ||
        $order->order_status == 'on_the_way' ||
        $order->order_status == 'delivered' ||
        $order->order_status == 'cancelled'
            ? 'next-step-item-finish'
            : '' }}">
        <div class="next-step-item-tail">
            <div class="next-step-item-tail-underlay">
                <div class="next-step-item-tail-overlay w-100-p"></div>
            </div>
        </div>
        <div class="next-step-item-container">
            <div class="next-step-item-node">
                <span class="next-step-item-node-dot"></span>
                <div class="complete-check">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.125 3.375L4.875 8.625L2.25 6" stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
            <div class="next-step-item-title">
                <div class="icon">
                    <x-svg.packaging />
                </div>
                <p>{{ __('processing') }}</p>
            </div>
        </div>
    </div>

    @if ($order->order_status == 'cancelled')
        <div
            class="next-step-item {{ $order->order_status == 'on_the_way' || $order->order_status == 'cancelled' ? 'next-step-item-finish' : '' }}">
            <div class="next-step-item-tail">
                <div class="next-step-item-tail-underlay">
                    <div class="next-step-item-tail-overlay w-100-p"></div>
                </div>
            </div>
            <div class="next-step-item-container">
                <div class="next-step-item-node">
                    <span class="next-step-item-node-dot"></span>
                    <div class="complete-check">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.125 3.375L4.875 8.625L2.25 6" stroke="white" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <div class="next-step-item-title">
                    <div class="icon">
                        <x-svg.cancel />
                    </div>
                    <p>{{ __('cancelled') }}</p>
                </div>
            </div>
        </div>
    @else
        <div
            class="next-step-item {{ $order->order_status == 'on_the_way' || $order->order_status == 'delivered' ? 'next-step-item-finish' : '' }}">
            <div class="next-step-item-tail">
                <div class="next-step-item-tail-underlay">
                    <div class="next-step-item-tail-overlay w-100-p"></div>
                </div>
            </div>
            <div class="next-step-item-container">
                <div class="next-step-item-node">
                    <span class="next-step-item-node-dot"></span>
                    <div class="complete-check">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.125 3.375L4.875 8.625L2.25 6" stroke="white" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <div class="next-step-item-title">
                    <div class="icon">
                        <x-svg.road />
                    </div>
                    <p>{{ __('on_the_way') }}</p>
                </div>
            </div>
        </div>
        <div class="next-step-item {{ $order->order_status == 'delivered' ? 'next-step-item-finish' : '' }}">
            <div class="next-step-item-tail">
                <div class="next-step-item-tail-underlay">
                    <div class="next-step-item-tail-overlay w-100-p"></div>
                </div>
            </div>
            <div class="next-step-item-container">
                <div class="next-step-item-node">
                    <span class="next-step-item-node-dot"></span>
                    <div class="complete-check">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.125 3.375L4.875 8.625L2.25 6" stroke="white" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <div class="next-step-item-title">
                    <div class="icon">
                        <x-svg.delivered />
                    </div>
                    <p>{{ __('delivered') }}</p>
                </div>
            </div>
        </div>
    @endif
</div>
