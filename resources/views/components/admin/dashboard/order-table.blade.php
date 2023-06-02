@props([
    'recentOrders' => $recentOrders,
])
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title p-2">{{ __('recent_orders') }}</h2>
        </div>
        <div class="card-body table-responsive p-0">
            <div class="table-responsive">
                <table class="table table-vcenter">
                    <thead class="text-center">
                        <tr>
                            <th class="w-1">{{ __('no') }}.</th>
                            <th>{{ __('customer') }}</th>
                            <th>{{ __('total_products') }}</th>
                            <th>{{ __('total_amount') }}</th>
                            <th>{{ __('delivery_status') }}</th>
                            <th>{{ __('payment_status') }}</th>
                            <th>{{ __('options') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">

                        @if ($recentOrders->count() > 0)
                            @foreach ($recentOrders as $order)
                                <tr>
                                    <td>
                                        <a
                                            href="{{ $order->customer ? route('module.order.show', $order->order_no) : '' }}">
                                            #{{ $order->order_no }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="text-muted">
                                            @if ($order->customer)
                                                <a href="{{ $order->customer ? route('module.customer.show', $order->customer->id) : '' }}">
                                                    {{ $order->customer ? Str::ucfirst($order->customer->full_name) : '' }}
                                                </a>
                                            @else
                                                <span class="badge badge-pill badge-secondary">{{ __('guest_checkout') }}</span>
                                            @endif
                                        </div>
                                        <div class="text-muted text-xs">
                                            {{ $order->customer ? Str::ucfirst($order->customer->email) : '' }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="flag flag-country-us">
                                            {{ $order->order_products_count }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ multiCurrency($order->total_price) }}
                                    </td>
                                    <td>
                                        <button type="button"
                                            class="btn
                                        @if ($order->order_status == 'pending') btn-warning @endif
                                        @if ($order->order_status == 'processing') btn-info @endif
                                        @if ($order->order_status == 'on_the_way') btn-secondary @endif
                                        @if ($order->order_status == 'delivered') btn-success @endif
                                        @if ($order->order_status == 'cancelled') btn-danger @endif btn-xs">
                                            {{ str_ireplace(['_'], ' ', ucfirst($order->order_status)) }}
                                        </button>
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $order->payment_status == 'unpaid' ? 'bg-warning' : 'bg-success' }} me-1">
                                            {{ str_ireplace(['_'], ' ', ucfirst($order->payment_status)) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('module.order.show', $order->order_no) }}"
                                            class="btn btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('module.order.generate', $order->id) }}"
                                            class="btn btn-info">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">
                                    <div class="empty py-5">
                                        <div class="empty-img">
                                            <img src="{{ asset('backend/image') }}/not-found.svg" height="128"
                                                alt="">
                                        </div>
                                        <h5 class="mt-4">{{ __('no_results_found') }}</h5>
                                        <p class="empty-subtitle text-muted">
                                            {{ __('there_is_no') }} {{ __('found_in_this_page') }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
