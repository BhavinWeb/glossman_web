@extends('frontend.layouts.main')
@section('css')
<style>
    .fas{
        cursor: pointer;
    }
    .timeline-icon.border.bg-primary::before {
        background: url("images/current_location.png");
        content: "";
        height: 80px;
        width: 80px;
        background-repeat: no-repeat;
        position: absolute;
        background-size: contain;
    }

    .timeline-with-icons {
        border-left: 1px solid hsl(0, 0%, 90%);
        position: relative;
        list-style: none;
    }

    .timeline-with-icons .timeline-item {
        position: relative;
        margin-bottom:20%;

    }

    .timeline-with-icons .timeline-item:after {
        position: absolute;
        display: block;
        top: 0;
    }

    .timeline-with-icons .timeline-icon {
        border: 2px solid #dee2e6 !important;
        left: -21px;
        /* background-color: hsl(217, 88.2%, 90%); */
        color: hsl(217, 88.8%, 35.1%);
        border-radius: 50%;
        height: 40px;
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    @media (min-width: 768px) {
        td {
            padding-right: 50px;
            padding-bottom: 10px;
        }
    }
</style>
@endsection
@section('content')

<div id="footer" style="padding-bottom: 0;">
        <div id="">
            <div class="container clearfix">
                <div class="common-breadcrumbs gap-2 d-flex flex-column">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb h7">
                            <li class="text-uppercase"><a href="#">HOME</a></li>
                            <li class="text-uppercase px-4">|</li>
                            <li class="text-uppercase" aria-current="page">Details</li>
                        </ol>
                    </nav>
                    <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">Details</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="my-5 px-3 container clearfix">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-xl-6 font-ui">
                <div class="my-3 fw-light" style="font-size: 20px">Order No : &nbsp;{{$data['booking_details']['order_id']}}</div>
                <table>
                    <tr>
                        <td>Customer Name</td>
                        <td>:</td>
                        <td>{{$data['booking_details']['order_id']}}</td>
                    </tr>
                    <tr>
                        <td>Date & Time</td>
                        <td>:</td>
                        <td>{{$data['booking_details']['date_time']}}</td>
                    </tr>
                    <tr>
                        <td>Payment</td>
                        <td>:</td>
                        <td>{{$data['booking_details']['payment']}}</td>
                    </tr>
                    <tr>
                        <td>SP Status</td>
                        <td>:</td>
                        <td>{{$data['booking_details']['sp_status']}}</td>
                    </tr>
                    
                    <tr>
                        <td>Service type</td>
                        <td>:</td>
                        <td>{{$data['booking_details']['service_type']}}</td>
                    </tr>
                    <tr>
                        <td>Service Date & Time</td>
                        <td>:</td>
                        <td>{{$data['booking_details']['service_date_time']}}</td>
                    </tr>
                </table>

                <div class="row">



                <div class="my-3">
                    <h1 class="my-3 font-h fw-semibold">Service Details</h1>
                    <table>
                    @foreach($data['service_list'] as $service_data)
                        <tr>
                            <td>{{$service_data->name}}</td>
                            <td>:</td>
                            <td>{{$service_data->currency}} {{$service_data->price}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                    <div class="my-3">
                        <h1 class="my-3 font-h fw-semibold">Package  Visits</h1>
                        <table>
                            <tr>
                                <td>Number of visits pending</td>
                                <td>:</td>
                                <td>{{$data['booking_details']['number_of_package_visit_pending']}}</td>
                            </tr>

                        </table>
                    </div>
                    <div class="row my-3">
                        <div class="col-xl-9 col-12">
                            <h1 class="my-3 font-h fw-semibold">Service Address</h1>
                            <table>
                                <tr>
                                    <span class="float-end d-none"><i style='font-size:24px' class='fas'>&#xf044;</i></span>
                                </tr>
                                <tr>
                                    <td style="line-height: 30px;">{{$data['booking_details']['user_name']}}<br/>
                                       {{$data['booking_details']['address']}}
                                        {{Auth::user()->email}}<br/>
                                        {{Auth::user()->phone}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="my-3">
                        <h1 class="my-1 font-h fw-semibold">Details</h1>
                        <table>
                            <tr>
                                <td>Sub Total</td>
                                <td>:</td>
                                <td>${{$data['booking_details']['sub_total']}}</td>
                            </tr>
                            <tr>
                                <td>VAR</td>
                                <td>:</td>
                                <td>{{$data['booking_details']['tax']}} %</td>
                            </tr>
                            <tr>
                                <td>Total Amount</td>
                                <td>:</td>
                                <td>${{$data['booking_details']['total_price']}}</td>
                            </tr>

                        </table>
                    </div>
                <!-- Section: Timeline -->
            </div>
        </div>
    </div>
@endsection
@section('javascript')
@endsection
