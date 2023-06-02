<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);

        * {
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background: #E0E0E0;
            font-family: 'Roboto', sans-serif;

            background-size: 100%;
        }

        ::selection {
            background: #f31544;
            color: #FFF;
        }

        ::moz-selection {
            background: #f31544;
            color: #FFF;
        }

        h1 {
            font-size: 1.5em;
            color: #222;
        }

        h2 {
            font-size: .9em;
        }

        h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        p {
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
        }

        #invoiceholder {
            width: 100%;
            hieght: 100%;
            padding-top: 50px;
        }

        #headerimage {
            z-index: -1;
            position: relative;
            top: -50px;
            height: 350px;
            overflow: hidden;
        }

        #invoice {
            position: relative;
            top: -290px;
            margin: 0 auto;
            width: 900px;
            background: #FFF;
        }

        [id*='invoice-'] {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
            padding: 30px;
        }

        #invoice-top {
            min-height: 120px;
        }

        #invoice-mid {
            min-height: 120px;
        }

        #invoice-bot {
            min-height: 250px;
        }

        .info {
            display: block;
            margin-left: 20px;
        }

        .title p {
            text-align: right;
        }

        #project {
            margin-left: 52%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 5px 0 5px 15px;
            border: 1px solid #EEE
        }

        .tabletitle {
            padding: 5px;
            background: #EEE;
        }

        .service {
            border: 1px solid #EEE;
        }

        .item {
            width: 40%;
        }

        .itemtext {
            font-size: .9em;
        }

        #legalcopy {
            margin-top: 30px;
        }

        form {
            float: right;
            margin-top: 30px;
            text-align: right;
        }


        .effect2 {
            position: relative;
        }

        .effect2:after {
            -webkit-transform: rotate(3deg);
            -moz-transform: rotate(3deg);
            -o-transform: rotate(3deg);
            -ms-transform: rotate(3deg);
            transform: rotate(3deg);
            right: 10px;
            left: auto;
        }



        .legal {
            width: 70%;
        }
    </style>
</head>

<body>
    <div id="invoiceholder">
        <div id="headerimage"></div>
        <div id="invoice" class="effect2">

            <div id="invoice-top">
                <div class="info">
                    @if ($order->customer)
                        <h2>{{ $order->customer->full_name }}</h2>
                    @else
                        <h2><span class="badge badge-pill badge-secondary">{{ __('guest_checkout') }}</span></h2>
                    @endif
                    <p> {{ $order->customer->email }} </br>
                        @if ($order->customer->phone)
                            {{ $order->customer->phone }}
                        @endif
                    </p>
                </div> <br>
                <div class="title">
                    <h2>Invoice #{{ $order->order_no }}</h2>
                </div>
                <br>
                <h1 style="color: {{ $order->payment_status == 'paid' ? 'forestgreen' : '#f31544' }}">
                    {{ ucwords($order->payment_status) }}
                </h1>
            </div>
            <div id="invoice-mid">
                <div class="info">
                    <h2>Billing Information</h2>
                    <p>{{ $order->billingAddress->full_name }}</p>
                    <p>{{ $order->billingAddress->email }}</p>
                    <p>{{ $order->billingAddress->phone }}</p>
                </div>
                <br>
                <div id="project">
                    <h2>Shipping Information</h2>
                    <p>{{ $order->shippingAddress->full_name }}</p>
                    <p>{{ $order->shippingAddress->email }}</p>
                    <p>{{ $order->shippingAddress->phone }}</p>
                </div>
            </div>

            <div id="invoice-bot">

                <div id="table">
                    <table>
                        <tr class="tabletitle">
                            <td class="item" width="40%">
                                <h2>Product</h2>
                            </td>
                            <td class="Hours" width="20%">
                                <h2>Price</h2>
                            </td>
                            <td class="Rate" width="20%">
                                <h2>Quantity</h2>
                            </td>
                            <td class="subtotal" width="20%">
                                <h2>Sub-total</h2>
                            </td>
                        </tr>
                        @foreach ($order->orderProducts as $item)
                            <tr class="service">
                                <td class="tableitem">
                                    <p class="itemtext">{{ $item->product->title }}</p>
                                    <br>
                                    <p><b>Variants:</b>
                                        @foreach ($item->attributes as $attribute)
                                            <p class="mb-0">{{ $attribute->attribute }}:
                                                {{ $attribute->value }}</p>
                                        @endforeach
                                    </p>
                                </td>
                                <td class="tableitem">
                                    <p class="itemtext">
                                        @if ($item->product->sale_price)
                                            {{ multiCurrency($item->product->sale_price) }}
                                        @else
                                            {{ multiCurrency($item->product->price) }}
                                        @endif
                                    </p>
                                </td>
                                <td class="tableitem">
                                    <p class="itemtext">
                                        {{ $item->quantity }}
                                    </p>
                                </td>
                                <td class="tableitem">
                                    <p class="itemtext">
                                        @if ($item->product->sale_price)
                                            {{ multiCurrency($item->quantity * $item->product->sale_price) }}
                                        @else
                                            {{ multiCurrency($item->quantity * $item->product->price) }}
                                        @endif
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                        @if ($order->discount_price)
                            <tr class="tabletitle">
                                <td></td>
                                <td></td>
                                <td class="Rate">
                                    <h2>Discount</h2>
                                </td>
                                <td class="payment">
                                    <h2>{{ multiCurrency($order->discount_price) }}</h2>
                                </td>
                            </tr>
                        @endif
                        <tr class="tabletitle">
                            <td></td>
                            <td></td>
                            <td class="Rate">
                                <h2>Subtotal</h2>
                            </td>
                            <td class="payment">
                                <h2>{{ multiCurrency($order->subtotal_price) }}</h2>
                            </td>
                        </tr>
                        @if ($order->coupon_type && $order->coupon_discount_amount)
                            <tr class="tabletitle">
                                <td></td>
                                <td></td>
                                <td class="Rate">
                                    <h2>(-)Coupon
                                        ${{ $order->coupon_type == 'Percentage' ? str_replace('-', '', $order->coupon_discount_amount) : '' }}:
                                    </h2>
                                </td>
                                <td class="payment">
                                    <h2>
                                        {{ multiCurrency($order->coupon_type == 'Percentage' ? str_replace('-', '', (str_replace('%', '', $order->coupon_discount_amount) / 100) * $order->subtotal_price) : str_replace('-', '', $order->coupon_discount_amount)) }}
                                    </h2>
                                </td>
                            </tr>
                        @endif
                        <tr class="tabletitle">
                            <td></td>
                            <td></td>
                            <td class="Rate">
                                <h2>Total</h2>
                            </td>
                            <td class="payment">
                                <h2>{{ multiCurrency($order->total_price) }}</h2>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
