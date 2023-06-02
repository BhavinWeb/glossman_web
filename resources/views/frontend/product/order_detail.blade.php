@extends('frontend.layouts.main')
@section('css')
<style>
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
                <div class="my-3 fw-light" style="font-size: 20px">Order No : &nbsp;#{{$data['order_details']->order_no}}</div>
                <table>
                    <tr>
                        <td>Customer Name</td>
                        <td>:</td>
                        <td>{{$data['order_address']->first_name}} {{$data['order_address']->last_name}}</td>
                    </tr>
                    <tr>
                        <td>Placed On</td>
                        <td>:</td>
                        <td>{{$data['order_details']->date}}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                          @if($data['order_details']->order_status == "pending")
		        <td>Pending</td>
		        @elseif($data['order_details']->order_status == "processing")
		        <td>Processing</td>
		        @elseif($data['order_details']->order_status == "on_the_way")
		        <td>On The Way</td>
		         @elseif($data['order_details']->order_status == "delivered")
		         <td>Delivered</td>
		         @elseif($data['order_details']->order_status == "cancelled")
		         
		         <td>Cancelled</td>
		         @endif
                      
                    </tr>
                    <tr>
                        <td>Expected date to delivery</td>
                        <td>:</td>
                        <td>{{$data['order_details']->delivery_date}}</td>
                    </tr>
                </table>

                <div class="row">
                    <div class="col-md-12 my-5">
                        <h1 class="my-3 font-h fw-semibold">Order Details</h1>
                           @foreach($data['product_list'] as $p_data)
                       	
                       	
                 
                        <div class="row my-5">
                            <div class="col-sm-12 col-md-4 pl-0 border mb-3">
                                <img src="{{asset($p_data->product->image)}}" alt="" class="img-fluid" />
                            </div>
                            <div class="col-sm-12 col-md-8 d-flex flex-column " style="line-height: 29px;">
                                <div class="d-flex justify-content-end d-none">
                                    X
                                </div>
                               <!-- <div class="d-flex flex-column flex-fill justify-content-between"> -->
                                 <div class="d-flex flex-column ">
                                    <p>{{$p_data->product->title}}</p>


                                    <div  class="mb-3">
                                        <span>{{$p_data->quantity}} X {{$p_data->product->currency}} {{$p_data->product->sale_price}}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

                <div class="row my-5">
                    <div class="">
                        <h1 class="my-3 font-h fw-semibold">Shipping Address</h1>
                        <table class="col-md-4">
                            <tr>
                                <span class="float-end d-none"><i style='font-size:24px' class='fas'>&#xf044;</i></span>
                            </tr>
                            <tr class="text-ui">
                               {{$data['order_address']->address}}
                            </tr>
                        </table>
                    </div>
                </div>


                <div class="my-5">
                    <h1 class="my-3 font-h fw-semibold">Payment Details</h1>
                    <table>
                        <tr>
                            <td>Subtotal</td>
                            <td>:</td>
                            <td>${{$data['order_details']->subtotal_price}}</td>
                        </tr>
                        <tr>
                            <td>Delivery Charges</td>
                            <td>:</td>
                            <td>${{$data['order_details']->delivery_charge}}</td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td>:</td>
                            <td>${{$data['order_details']->discount_price}}</td>
                        </tr>
                        <tr>
                            <td>Total amount</td>
                            <td>:</td>
                            <td>${{$data['order_details']->total_price}}</td>
                        </tr>
                    </table>
                </div>

                <h1 class="my-3 font-h fw-semibold ">Track Order</h1>
                <!-- Section: Timeline -->
                <section class="py-5 mx-5">

                <ul class="timeline-with-icons">
                        <li class="timeline-item d-flex flex-row">
                            @if(!empty($data['order_status'][0]))
                                <span class="timeline-icon border sdf  bg-primary">
                                </span>
                                @else
                                
                                <span class="timeline-icon border sdff bg-white">
                                </span>
                                
                            @endif
                            <div class="d-flex gap-2 flex-column justify-content-start">
                                <h5 class="px-4 font-ui fw-light"
                                    style="font-size: 20px;color: #2A2A2A ;letter-spacing: 1px;">
                                    Order and Approved</h5>
                                <p class="text-muted px-4 mb-2 font-ui fw-light"
                                   style="font-size: 25px;color: #2A2A2A!important;letter-spacing: 1px;">
                                   @if(!empty($data['order_status'][0]))
                                        {{date('M d, Y h:i A', strtotime($data['order_status'][0]->created_at))}}
                                    @endif</p>
                            </div>
                        </li>

                        <li class="timeline-item d-flex flex-row">
                            @if(!empty($data['order_status'][1]))
                                <span class="timeline-icon border sdf  bg-primary">
                                </span>
                                @else
                                
                                <span class="timeline-icon border sdff bg-white">
                                </span>
                                
                            @endif
                            <div class="d-flex gap-2 flex-column justify-content-start">
                                <h5 class="px-4 font-ui fw-light"
                                    style="font-size: 20px;color: #2A2A2A ;letter-spacing: 1px;">
                                    Picked for shipping</h5>
                                <p class="text-muted px-4 mb-2 font-ui fw-light"
                                   style="font-size: 25px;color: #2A2A2A!important;letter-spacing: 1px;">
                                   @if(!empty($data['order_status'][1]))
                                   {{date('M d, Y h:i A', strtotime($data['order_status'][1]->created_at))}}
                                    @endif</p>
                            </div>
                        </li>

                       

                        <li class="timeline-item d-flex flex-row">
                            @if(!empty($data['order_status'][2]))
                                <span class="timeline-icon border sdf  bg-primary">
                                </span>
                                @else
                                
                                <span class="timeline-icon border sdff bg-white">
                                </span>
                                
                            @endif
                            <div class="d-flex gap-2 flex-column justify-content-start">
                                <h5 class="px-4 font-ui fw-light"
                                    style="font-size: 20px;color: #2A2A2A ;letter-spacing: 1px;">
                                    Delivery</h5>
                                <p class="text-muted px-4 mb-2 font-ui fw-light"
                                   style="font-size: 25px;color: #2A2A2A!important;letter-spacing: 1px;">
                                   @if(!empty($data['order_status'][2]))
                                   {{date('M d, Y h:i A', strtotime($data['order_status'][2]->created_at))}}
                                    @endif</p>
                            </div>
                        </li>

                       
                    </ul>
                    <ul class="timeline-with-icons d-none">
                        <li class="timeline-item d-flex flex-row">

                                        <span class="timeline-icon border bg-dark">
                                        </span>
                            <div class="d-flex gap-2 flex-column justify-content-start">
                                <h5 class="px-4 font-ui fw-light"
                                    style="font-size: 20px;color: #2A2A2A ;letter-spacing: 1px;">
                                    Order and Approved</h5>
                                <p class="text-muted px-4 mb-2 font-ui fw-light"
                                   style="font-size: 25px;color: #2A2A2A!important;letter-spacing: 1px;">
                                    Oct 05, 2022, 11.30 AM</p>
                            </div>
                        </li>

                        <li class="timeline-item d-flex flex-row align-self-start">

                                <span class="timeline-icon border bg-primary">

                                </span>
                            <div class="d-flex gap-2 flex-column justify-content-start"
                                 style="  margin-top: -12px;">
                                <h5 class="px-4 font-ui fw-light"
                                    style="font-size: 20px;color: #2A2A2A ;letter-spacing: 1px;">
                                    Picked for shipping</h5>
                                <p class="text-muted px-4 mb-2 font-ui fw-light"
                                   style="font-size: 25px;color: #2A2A2A!important;letter-spacing: 1px;">
                                    Oct 06, 2022, 09.00 AM</p>
                            </div>
                        </li>

                        <li class="timeline-item  d-flex flex-row">

                                <span style="background: #fff;" class="timeline-icon border">

                                </span>
                            <div class="d-flex flex-column justify-content-start"
                                 style="  margin-top: 7px;">
                                <h5 class="px-4 font-ui fw-light"
                                    style="font-size: 20px;color: #2A2A2A ;letter-spacing: 1px;">
                                    Picked for shipping</h5>
                                </p>
                            </div>
                        </li>

                        <li class="timeline-item  d-flex flex-row">

                                <span style="background: #fff;" class="timeline-icon border   ">

                                </span>
                            <div style="  margin-top: 7px;">
                                <h5 class="px-4 font-ui fw-light"
                                    style="font-size: 20px;color: #2A2A2A ;letter-spacing: 1px;">
                                    Delivery</h5>
                            </div>
                        </li>
                    </ul>
                </section>
                <!-- Section: Timeline -->
            </div>
        </div>
    </div>
@endsection
@section('javascript')
@endsection
