@extends('admin.settings.setting-layout')

@section('title')
    {{ __('order_details') }}
@endsection

@section('content')
    @php
    if ($order->order_status == 'pending') {
        $order_status_color = 'warning';
    } elseif ($order->order_status == 'processing') {
        $order_status_color = 'info';
    } elseif ($order->order_status == 'on_the_way') {
        $order_status_color = 'secondary';
    } elseif ($order->order_status == 'delivered') {
        $order_status_color = 'success';
    } elseif ($order->order_status == 'cancelled') {
        $order_status_color = 'danger';
    }
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body ">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5>{{ __('order_details') }}: #{{ $order->order_no }}</h5>
                                <p class="">
                                    {{ Carbon\Carbon::parse($order->created_at)->format('F d, Y, H:i A') }}
                                </p>
                                <div><strong class="me-2">{{ __('status') }}: </strong>
                                    <div class="badge badge-pill badge-{{ $order_status_color }}">
                                        {{ ucwords($order->order_status) }}
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('module.order.generate', $order->id) }}" target="_blank">
                                    <b><i class="fas fa-download"></i>
                                        {{ __('download_invoice') }}</b>
                                </a>
                                <div class="btn-group d-block mt-3 btn-lg">
                                    @php
                                        $orderStatusColor = $order->order_status == 'pending' ? 'warning' : ($order->order_status == 'processing' ? 'info' : ($order->order_status == 'on_the_way' ? 'secondary' : ($order->order_status == 'delivered' ? 'success' : 'danger')));
                                    @endphp
                                    <button type="button"
                                        class="btn btn-{{ $orderStatusColor }}
                                    dropdown-toggle"
                                        data-toggle="dropdown" aria-expanded="false">
                                        {{ str_ireplace(['_'], ' ', ucfirst($order->order_status)) }}
                                    </button>
                                     @if($order->order_status != "cancelled")
                                    <ul class="dropdown-menu" x-placement="bottom-start">
                                   
                                     @if($order->order_status != "delivered")
                                       <!-- @if ($order->order_status != 'pending')
                                            <li>
                                                <form action="{{ route('module.order.status.change', $order->order_no) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" value="pending" name="status">
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-exchange-alt text-warning mr-1"></i>
                                                        {{ __('pending') }}
                                                    </button>
                                                </form>
                                            </li>
                                        @endif -->
                                        @if ($order->order_status != 'processing')
                                            <li>
                                                <form action="{{ route('module.order.status.change', $order->order_no) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" value="processing" name="status">
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-exchange-alt text-info mr-1"></i>
                                                        {{ __('processing') }}
                                                    </button>
                                                </form>
                                            </li>
                                        @endif
                                        @if ($order->order_status != 'on_the_way')
                                            <li>
                                                <form action="{{ route('module.order.status.change', $order->order_no) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" value="on_the_way" name="status">
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-exchange-alt text-secondary mr-1"></i>
                                                        {{ __('on_the_way') }}
                                                    </button>
                                                </form>
                                            </li>
                                        @endif
                                        @if ($order->order_status != 'delivered')
                                            <li>
                                                <form action="{{ route('module.order.status.change', $order->order_no) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" value="delivered" name="status">
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-exchange-alt text-success mr-1"></i>
                                                        {{ __('delivered') }}
                                                    </button>
                                                </form>
                                            </li>
                                        @endif
                                         @endif
                                        @if ($order->order_status != 'cancelled')
                                            <li>
                                                <form action="{{ route('module.order.status.change', $order->order_no) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" value="cancelled" name="status">
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-exchange-alt text-danger mr-1"></i>
                                                        {{ __('cancelled') }}
                                                    </button>
                                                </form>
                                            </li>
                                        @endif
                                       
                                    </ul>
                                     @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                        
				@if(!is_array($order_address))
		                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
		                        <h5 class="mb-3">{{ __('shipping_address') }}</h5>
		                        <h6 class="mb-2">{{ $order_address->first_name }} {{ $order_address->last_name }}</h6>
		                        <p class="mb-0">{{ $order_address->address }}</p>
		                        <p class="mb-0"> <strong>{{ __('email') }}: </strong><a
		                                href="mailto:ricky@gmail.com">{{ $order_address->email }}</a></p>
		                        <p class="mb-0"> <strong>{{ __('phone') }}: </strong><a
		                                href="tel:{{ $order_address->phone }}">{{ $order_address->phone }}</a>
		                        </p>
		                    </div>
		                    @else
		                    
		                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
		                        <h5 class="mb-3">{{ __('shipping_address') }}</h5>
		                        <h6 class="mb-2">-<h6>
		                        <p class="mb-0">-</p>
		                        <p class="mb-0"> <strong>{{ __('email') }}: </strong><a
		                                href="mailto:ricky@gmail.com">-</a></p>
		                        <p class="mb-0"> <strong>{{ __('phone') }}: </strong><a
		                                href="tel:{{ $order_address->phone }}">-</a>
		                        </p>
		                    </div>
                            
                            @endif
                            <div class="col-md-6 col-lg-4">
                                <h5 class="mb-3">{{ __('payment_method') }}</h5>
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <h6 class="mb-0">{{ __('method') }}:
                                            @if ($order->payment_method == 'offline')
                                                @if (isset($order->manualPayment) && isset($order->manualPayment->name))
                                                    {{ ucfirst($order->manualPayment->name) }}
                                                @else
                                                    {{ ucfirst($order->payment_method) }}
                                                @endif
                                            @else
                                                {{ ucfirst($order->payment_method) }}
                                            @endif
                                        </h6>

                                        <p class="mb-0">
                                            {{ __('status') }}:
                                            <span
                                                class="badge badge-pill badge-{{ $order->payment_status == 'paid' ? 'success' : 'danger' }}">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                            @if ($order->payment_status == 'unpaid')
                                                <x-admin.order-mark-paid :orderid="$order->id" />
                                            @endif
                                        </p>
                                        <p class="mb-0">
                                            Note:
                                            <span
                                                class="">
                                                      {{ ucfirst($order->note) }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive fs--1">
                            <table class="table table-striped border-bottom">
                                <thead class="bg-200 text-900">
                                    <tr>
                                        <th class="border-0">{{ __('products') }}</th>
                                        <th class="border-0 text-center">{{ __('variants') }}</th>
                                        <th class="border-0 text-center">{{ __('quantity') }}</th>
                                        <th class="border-0 text-end">{{ __('rate') }}</th>
                                        <th class="border-0 text-end">{{ __('amount') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderProducts as $item)
                                        <tr class="border-200">
                                            <td class="align-middle">
                                                <h6 class="mb-0 text-nowrap">{{ $item->product->title }}</h6>
                                            </td>
                                            <td class="align-middle text-center">
                                                @foreach ($item->attributes as $attribute)
                                                    <p class="mb-0">{{ $attribute->attribute }}:
                                                        {{ $attribute->value }}</p>
                                                @endforeach
                                            </td>
                                            <td class="align-middle text-center">{{ $item->quantity }}</td>
                                            <td class="align-middle text-end">
                                                @if ($item->product->sale_price)
                                                    {{ multiCurrency($item->product->sale_price) }}
                                                @else
                                                    {{ multiCurrency($item->product->price) }}
                                                @endif
                                            </td>
                                            <td class="align-middle text-end">
                                                @if ($item->product->sale_price)
                                                    {{ multiCurrency($item->quantity * $item->product->sale_price) }}
                                                @else
                                                    {{ multiCurrency($item->quantity * $item->product->price) }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row g-0 justify-content-end">
                            <div class="col-auto">
                                <table class="table table-sm table-borderless fs--1 text-end">
                                    <tbody>
                                        <tr>
                                            <th class="text-900">{{ __('subtotal') }}:</th>
                                            <td class="fw-semi-bold">{{ multiCurrency($order->subtotal_price) }}</td>
                                        </tr>
                                        @if ($order->coupon_type && $order->coupon_discount_amount)
                                            <tr>
                                                <th class="text-900">
                                                    (-){{ __('coupon') }}
                                                    {{ $order->coupon_type == 'Percentage' ? str_replace('-', '', $order->coupon_discount_amount) : '' }}:
                                                </th>
                                                <td class="fw-semi-bold">
                                                    ${{ $order->coupon_type == 'Percentage' ? str_replace('-', '', (str_replace('%', '', $order->coupon_discount_amount) / 100) * $order->subtotal_price) : str_replace('-', '', $order->coupon_discount_amount) }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($order->shippingMethod)
                                            <tr>
                                                <th class="text-900">(+){{ __('shipping') }}:
                                                </th>
                                                <td class="fw-semi-bold">
                                                    {{ multiCurrency($order->shipping_price) }}
                                                </td>
                                            </tr>
                                        @endif
                                        <tr class="border-top">
                                        <tr>
                                            <th class="text-900">{{ __('total') }}:</th>
                                            <td class="fw-semi-bold">{{ multiCurrency($order->total_price) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('style')
    <style>
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #343a40;
        }

        .nav-pills .nav-link:not(.active):hover {
            color: #343a40;
        }
    </style>
@endsection
