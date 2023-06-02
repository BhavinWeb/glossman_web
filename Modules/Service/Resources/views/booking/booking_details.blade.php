@extends('admin.layouts.app')
@section('title')
    {{ __('details') }}
@endsection
<style>
.column_image {
  float: left;
  width: 23.33%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row_image::after {
  content: "";
  clear: both;
  display: table;
}

.column_image{
    
    border-radius: 20px;
    margin-left:20px;
    height:400px;}
    
    .column_image img{
    border-radius: 20px;
        max-height: 400px;
    height: auto;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    
                        <h3 class="card-title line-height-36">{{ __('details') }}</h3>
                        
                        <a href="{{ route('module.service.booking') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}
                        </a>
                        
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
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
				        <td>{{$data['booking_details']['date_time']}}</td>
				    </tr>
				</table>
                            </div>
                            <div class="col-sm-12">
                    		 <div class="my-3">
					    <h3 class="my-3 font-h fw-semibold">Service Details</h3>
					    <table>
					    @foreach($data['service_list'] as $service_data)
						<tr>
						    <td>{{$service_data->name}}</td>
						    <td>:</td>
						    <td>${{$service_data->price}}</td>
						</tr>
						@endforeach
					    </table>
					</div>
                            </div>
                            <div class="col-sm-12">
                            <h3 class="my-3 font-h fw-semibold">Service Address</h3>
                            <table>
                                
                                <tr>
                                    <td style="line-height: 30px;">{{$data['booking_details']['user_name']}}<br/>
                                       {{$data['booking_details']['address']}}<br/>
                                        {{Auth::user()->email}}<br/>
                                        {{Auth::user()->phone}}</td>
                                </tr>
                            </table>
                             </div>
                              <div class="col-sm-12">
                              	 <div class="my-3">
                              	  <h3 class="my-3 font-h fw-semibold">Details</h3>
                       
                        <table>
                            <tr>
                                <td>Sub Total</td>
                                <td>:</td>
                                <td>${{$data['booking_details']['sub_total']}}</td>
                            </tr>
                            <tr>
                                <td>VAR 10%</td>
                                <td>:</td>
                                <td>{{$data['booking_details']['tax']}}%</td>
                            </tr>
                            <tr>
                                <td>Total Amount</td>
                                <td>:</td>
                                <td>${{$data['booking_details']['total_price']}}</td>
                            </tr>

                        </table>

                          <h3 class="my-3 font-h fw-semibold">Customer Note</h3>
                        <table>
                            <tr>
                                <td> Note</td>
                                <td>:</td>
                                <td>{{$data['booking_details']['note']}}</td>
                            </tr>
                            
                        </table>
                        
                         <h3 class="my-3 font-h fw-semibold">Admin Note</h3>
                        <table>
                          
                            
                            <tr>
                                <td> Note</td>
                                <td>:</td>
                                <td>{{$data['booking_details']['admin_note']}}</td>
                            </tr>
                        </table>
                        
                    </div>
                    <div class="mt-3 mb-3">
                     <h3 class="my-3 font-h fw-semibold">After Images</h3>
                    </div>
                    <div class="row row_image">
                    @if($data['booking_details']['after_image'] != null)
                    @foreach($data['booking_details']['after_image'] as $after_image)
			<div class="column_image col-sm-12 col-md-3 mt-3">
			<img src="{{asset('uploads/service_images/'.str_replace(' ', '', $after_image))}}" alt="Snow" style="width:100%">
			</div>
			@endforeach
			@endif
			</div>
			<div class="mt-3 mb-3">
                  <h3 class="my-3 font-h fw-semibold">Before Images</h3>
                    </div>
                    <div class="row row_image">
                     
                    @if($data['booking_details']['before_image'] != null)
                    @foreach($data['booking_details']['before_image'] as $before_image)
			<div class="column_image col-sm-12 col-md-3 mt-3">
			<img src="{{asset('uploads/service_images/'.str_replace(' ', '', $before_image))}}" alt="Snow" style="width:100%">
			</div>
			@endforeach
			@endif
			</div>
                              </div>
                        </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    
@endsection

