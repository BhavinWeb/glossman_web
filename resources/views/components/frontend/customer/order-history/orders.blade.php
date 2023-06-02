@props([
    'orders' => [],
])

<div class="recent-order-block">
    <div class="recent-order-block__head">
        <h6 class="title">
            @if (request()->routeIs('website.customer.dashboard'))
                {{ __('recent_orders') }}
            @else
                {{ __('order_history') }}
            @endif
        </h6>
        @if (request()->routeIs('website.customer.dashboard'))
            <a class="link-btn" href="{{ route('website.customer.order.history') }}">{{ __('view_all') }}
                <x-svg.arrow-long-right width="20" height="20" stroke="var(--bs-primary-500)" />
            </a>
        @endif
    </div>
    <div class="recent-order-block__table">
        @if ($orders->count())
            <table>
                <thead>
                    <tr>
                        <th scope="col">{{ __('order_id') }}</th>
                        <th scope="col">{{ __('status') }}</th>
                        <th scope="col">{{ __('date') }}</th>
                        <th scope="col">{{ __('total') }}</th>
                        <th scope="col">{{ __('action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="order-id" data-label="Order ID">
                                #{{ $order->order_no }}
                            </td>
                            <td class="status
                                {{ $order->order_status == 'delivered' ? 'text-success-500' : '' }}
                                {{ $order->order_status == 'cancelled' ? 'text-danger-500' : '' }}
                                {{ $order->order_status == 'on_the_way' ? 'text-primary-500' : '' }}
                                {{ $order->order_status == 'processing' ? 'text-primary-500' : '' }}
                                {{ $order->order_status == 'pending' ? 'text-primary-500' : '' }}"
                                data-label="Status">
                                {{ str_ireplace(['_'], ' ', Str::upper($order->order_status)) }}
                            </td>
                            <td class="date" data-label="Date">
                                {{ date('M d, Y m:s', strtotime($order->created_at)) }}
                            </td>
                            <td class="total" data-label="Total">
                                {{ multiCurrency($order->total_price) }} ({{ $order->order_products_count }}
                                {{ __('products') }})
                            </td>
                            <td class="actions" data-label="Action">
                                <a
                                    href="{{ route('website.customer.order.detail', ['order' => $order->order_no]) }}">
                                    {{ __('view_details') }}
                                    <x-svg.arrow-long-right width="16" height="16" stroke="#2DA5F3" />
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <x-frontend.not-found message="nothing_found" />
        @endif

    </div>
    @if (!request()->routeIs('website.customer.dashboard'))
        {{ $orders->onEachSide(0)->links('vendor.pagination.frontend') }}
    @endif
</div>
