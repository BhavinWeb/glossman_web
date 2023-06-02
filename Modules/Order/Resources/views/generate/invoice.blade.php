<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>{{ config('app.name') }}</title>
    <style>
        *{ font-family: DejaVu Sans !important;}

        /* Font Include */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

        .main-body {
            font-family: 'Roboto', sans-serif;
            background: #E6E6E6;
        }

        .invoice {
            font-family: 'Roboto', sans-serif;
            background: #FFFFFF;
            /* padding: 30px 2px; */
            margin: 0 auto;
        }

        .invoice[size="A4"] {
            width: 21cm;
            height: 29.7cm;
            padding: 0;
            margin: 0;
            width: 705px;
        }

        .bb {
            border-bottom: 3px solid var(--darkWhite);
        }

        /* Top Section */
        .top-content {
            font-family: 'Roboto', sans-serif;
            padding-bottom: 20px;
            margin-bottom: 30px;
            border-bottom: 1px solid #D2D5D9;
        }

        .top-left h4 {
            padding-top: 10px;
        }

        .top-left p {
            color: #21232A;
            margin: 0px;
            font-size: 12px;
        }

        .logo {
            max-width: 200px;
            margin-left: auto;
        }

        .logo img {
            max-width: 100%;
            height: auto;
        }

        /* User Store Section */
        .bill-to-content {
            padding-top: 5px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .bill-to-content-left p {
            color: #21232A;
            margin: 0;
            font-size: 12px;
        }

        .bill-to-content h2 {
            font-family: 'Roboto', sans-serif;
        }

        .bill-to-content-left,
        .bill-to-content-right,
        .balance-info-left,
        .balance-info-right,
        .top-left,
        .top-right {
            width: 49.6%;
            margin: 0;
            display: inline-block;
        }

        .bill-to-content-right {
            margin-top: 10px;
        }

        .bill-to-content-right table,
        .balance-info-right table {
            width: max-content;
            margin-left: auto;
        }

        .balance-info-right table tbody tr td:last-child {
            text-align: right;
        }

        .bill-to-content-right td,
        .balance-info-right td {
            padding: 8px 18px;
        }

        .bill-to-content-right h4,
        .balance-info-right h4 {
            margin: 0px;
        }

        .table-row-bg {
            color: #000;
            background: #D2D5D9;
        }

        /* Product Section */
        .table {
            width: calc(100% - 10px);
            width: 100%;
            overflow: scroll;
        }

        .product-area .table thead tr {
            color: #000;
            font-weight: 700;
            background: #D2D5D9;
        }

        .item-col {
            max-width: 120px;
        }

        .description-col {
            max-width: 200px;
        }

        .table tr td {
            overflow: hidden;
            -o-text-overflow: ellipsis;
            text-overflow: ellipsis;
            font-size: 12px;
            padding: 10px 15px;
            margin: 0px;
            border-bottom: 1px solid #D2D3D9;
        }

        /* Balance Info Section */
        .balance-info {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            margin-top: 100px;
        }

        .invoice-text {
            width: 140px !important;
        }

    </style>
</head>

<body class="main-body">
    <div class="invoice page-break" size="A4">
        <section class="top-content bb">
            <div class="top-left">
                <div>
                    <h4>Bill From:</h4>
                </div>
                <div>
                    <p>{{ config('app.name') }}</p>
                    <p>{{ $setting->owner_email }}</p>
                    <p>{{ str_replace('https://', '', config('app.url')) }}</p>
                </div>
            </div>
            <div class="top-right">
                <div class="logo">
                    <img src="{{ setting()->logo_image_url }}" alt="" class="img-fluid">
                </div>
            </div>
        </section>

        <section class="bill-to-content">
            <div class="bill-to-content-left">
              
                <div>
                @if(is_array($order_address))
                    <h4>Ship To:</h4>
                    <p>{{ $order_address->full_name }}</p>
                    <p>{{ $order_address->address }}</p>
                    <p>{{ $order_address->phone }}</p>
                    <p>{{ $order_address->email }}</p>
                    @else
                    <h4>Ship To:</h4>
                    <p>-</p>
                    <p>-</p>
                    <p>-</p>
                    <p>-</p>
                    @endif
                </div>
            </div>
            <div class="bill-to-content-right">
                <table cellspacing="0">
                    <tr>
                        <td class="invoice-text">
                            <h4>INVOICE</h4>
                        </td>
                        <td>
                            #{{ $order->order_no }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>INVOICE DATE</h4>
                        </td>
                        <td>
                            {{ formatDate($order->created_at, 'M d, Y') }}
                        </td>
                    </tr>
                </table>
            </div>
        </section>
        <section class="product-area">
            <table class="table" cellspacing="0">
                <thead>
                    <tr>
                        <td class="item-col">Item </td>
                        <td>Quantity</td>
                        <td>Unit Cost</td>
                        <td>Line Total</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderProducts as $item)
                        @php
                            $price = $item->product->sale_price ? $item->product->sale_price : $item->product->price;
                        @endphp
                        <tr>
                            <td class="item-col">
                                {{ Str::limit($item->product->title, 50, '...') }}
                                @if ($item->attributes)
                                    (<b>
                                        @foreach ($item->attributes as $attribute)
                                            {{ $attribute['attribute'] }}: {{ $attribute['value'] }}
                                            @if (!$loop->last),@endif
                                        @endforeach
                                    </b>)
                                @endif
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                {{ multiCurrency($price) }}
                            </td>
                            <td>
                                {{ multiCurrency($price * $item->quantity) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section class="balance-info">
            <div class="balance-info-right">
                <table cellspacing="0">
                    <tr>
                        <td class="invoice-text">
                            <h4>SUBTOTAL</h4>
                        </td>
                        <td>
                            {{ multiCurrency($order->subtotal_price) }}
                        </td>
                    </tr>
                    @if ($order->coupon_type && $order->coupon_discount_amount)
                        @php
                            $coupon_type = $order->coupon_type;
                        @endphp
                        <tr>
                            <td>
                                <h4>(-)Coupon
                                    ${{ $coupon_type == 'Percentage' ? str_replace('-', '', $order->coupon_discount_amount) : '' }}:
                                </h4>
                            </td>
                            <td>
                                {{ multiCurrency($order->coupon_type == 'Percentage' ? str_replace('-', '', (str_replace('%', '', $order->coupon_discount_amount) / 100) * $order->subtotal_price) : str_replace('-', '', $order->coupon_discount_amount)) }}
                            </td>
                        </tr>
                    @endif
                    @if ($order->shippingMethod)
                        <tr>
                            <td>
                                <h4>(+)Shipping :</h4>
                            </td>
                            <td>
                                {{ multiCurrency($order->shipping_price) }}
                            </td>
                        </tr>
                    @endif
                    <tr class="table-row-bg">
                        <td>
                            <h4>TOTAL</h4>
                        </td>
                        <td>
                            {{ multiCurrency($order->total_price) }}
                        </td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
</body>

</html>
