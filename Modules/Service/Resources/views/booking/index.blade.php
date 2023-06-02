@extends('admin.layouts.app')

@section('title')
    {{ __('booking') }}
@endsection

@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('booking') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('bookings') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="">
        <div class="row mb-3 flex-wrap">
            @isset($stats['total'])
                <div class="col min-w-250">
                    <div class="card rounded-0">
                        <div class="card-body text-center">
                            <i class="fas fa-shopping-cart text-muted font-size-24"></i>
                            <h3><span>{{ $stats['total'] }}</span></h3>
                            <p class="text-muted font-15 mb-0">{{ __('total_booking') }}</p>
                        </div>
                    </div>
                </div>
            @endisset
            @isset($stats['pending'])
                <div class="col min-w-250">
                    <div class="card rounded-0">
                        <div class="card-body text-center">
                            <i class="fas fa-hourglass-start text-muted font-size-24"></i>
                            <h3><span>{{ $stats['pending'] }}</span></h3>
                            <p class="text-muted font-15 mb-0">{{ __('pending_booking') }}</p>
                        </div>
                    </div>
                </div>
            @endisset
            @isset($stats['cancelled'])
                <div class="col min-w-250">
                    <div class="card rounded-0">
                        <div class="card-body text-center">
                            <i class="fas fa-times text-muted font-size-24"></i>
                            <h3><span>{{ $stats['cancelled'] }}</span></h3>
                            <p class="text-muted font-15 mb-0">{{ __('canceled_booking') }}</p>
                        </div>
                    </div>
                </div>
            @endisset
            @isset($stats['processing'])
                <div class="col min-w-250">
                    <div class="card rounded-0">
                        <div class="card-body text-center">
                            <i class="fas fa-box-open text-muted font-size-24"></i>
                            <h3><span>{{ $stats['processing'] }}</span></h3>
                            <p class="text-muted font-15 mb-0">{{ __('processing_booking') }}</p>
                        </div>
                    </div>
                </div>
            @endisset
            @isset($stats['on_the_way'])
                <div class="col min-w-250">
                    <div class="card rounded-0">
                        <div class="card-body text-center">
                            <i class="fas fa-shipping-fast text-muted font-size-24"></i>
                            <h3><span>{{ $stats['on_the_way'] }}</span></h3>
                            <p class="text-muted font-15 mb-0">{{ __('on_the_way_booking') }}</p>
                        </div>
                    </div>
                </div>
            @endisset
            @isset($stats['delivered'])
                <div class="col min-w-250">
                    <div class="card rounded-0">
                        <div class="card-body text-center">
                            <i class="fas fa-check text-muted font-size-24"></i>
                            <h3><span>{{ $stats['delivered'] }}</span></h3>
                            <p class="text-muted font-15 mb-0">{{ __('delivered_booking') }}</p>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <form class="row mt-2" id="filterForm" action="{{ route('module.service.booking') }}" method="GET">
                            <div class="col-sm-12 col-md-2 p-1">
                                <h3 class="card-title line-height-36">{{ __('booking_list') }}</h3>
                            </div>
                            <div class="col-sm-6 col-md-2 p-1">
                                <select name="service_status" class="form-control w-100-p">
                                    <option value="" selected>
                                        {{ __('delivery_status') }}
                                    </option>
                                    <option {{ request('service_status') == 'Pending' ? 'selected' : '' }}
                                        value="Pending">
                                        {{ __('pending') }}
                                    </option>
                                    <option {{ request('service_status') == 'accept' ? 'selected' : '' }}
                                        value="accept">
                                        {{ __('Accept') }}
                                    </option>
                                    <option {{ request('service_status') == 'ontheway' ? 'selected' : '' }}
                                        value="ontheway">
                                        {{ __('on_the_way') }}
                                    </option>
                                   
                                    <option {{ request('service_status') == 'completed' ? 'selected' : '' }}
                                        value="completed">
                                        {{ __('Completed') }}
                                    </option>
                                    <option {{ request('service_status') == 'cancelled' ? 'selected' : '' }}
                                        value="cancelled">
                                        {{ __('cancelled') }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-2 p-1">
                                <select name="payment_status" id="filter" class="form-control w-100-p">
                                    <option value="" selected>
                                        {{ __('payment_status') }}
                                    </option>
                                    <option {{ request('payment_status') == 'paid' ? 'selected' : '' }} value="paid">
                                        {{ __('paid') }}
                                    </option>
                                    <option {{ request('payment_status') == 'unpaid' ? 'selected' : '' }} value="unpaid">
                                        {{ __('unpaid') }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-2 p-1">
                                <div class="input-group mb-3 myFilterClass">
                                    <input name="keyword" value="{{ request('keyword') ? request('keyword') : '' }}"
                                        type="text"
                                        placeholder="{{ __('booking_number') }}"
                                        class="form-control font-size-13">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body text-center table-responsive p-0 order-table-list">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">{{ __('sl') }}</th>
                                    <th>{{ __('booking_number') }}</th>
                                    <th>{{ __('customer') }}</th>
                                    <th>{{ __('total_price') }}</th>
                                    <th>{{ __('payment') }}</th>
                                    <th>{{ __('Assign Driver')}}</th>
                                    <th>{{ __('Driver Status')}}</th>
                                    <th>{{ __('status') }}</th>
                                    <th>{{ __('sp_status') }}</th>
                                    <th width="10%">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('module.booking.show', ['booking_id'=>$order->booking_no])}}">
                                                #{{ $order->booking_no }}
                                            </a>
                                        </td>
                                         <td>
                                                {{ ucfirst( \App\Models\User::where(['id' => $order->user_id])->pluck('name')->first()); }}
                                        </td>
                                       
                                       
                                        <td>{{ multiCurrency($order->total_price) }}</td>
                                        <td>
                                        	<span>{{ ucfirst($order->payment_method) }}</span>   
                                        </td>
                                        <td>
                                            <?php $driver =  \App\Models\Driver::where('status', 1)->get(); ?>
                                                <select name="assign_driver" class="form-control assign_driver" book-id={{ $order->id }}>
                                                    <option selected disabled>Select Driver</option>
                                                    @if($order->service_status != "cancelled")
                                                      @if($order->service_status == "pending")
                                                        @foreach($driver as $item)
                                                            @if ($item->id == $order->driver_id)
                                                                <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                                            @else
                                                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endif
                                                        @endforeach
                                                      @endif
                                                    @endif
                                                </select>
                                        </td>
                                       <td> 
                                            @if($order->driver_status == null)
                                               <span class="btn btn-secondary">Pending</span> 
                                            @elseif($order->driver_status == 1)
                                                <span class="btn btn-success">Accept</span> 
                                            @elseif($order->driver_status == 0)
                                               <span class="btn btn-danger">Reject</span> 
                                            @endif
                                         </td>
                                      
                                      <td>
                                                <div class="btn-group">
                                                
                                                    @php 
													$orderStatusColor = 'danger';
                                                    	if($order->service_status == 'pending'){
                                                    		$orderStatusColor = 'warning';
                                                    	
                                                    	}elseif($order->service_status == 'accept'){
                                                    		$orderStatusColor = 'info';
                                                    	}elseif($order->service_status == 'ontheway'){
                                                    		$orderStatusColor = 'secondary';
                                                    	}elseif($order->service_status == 'completed'){
                                                    		$orderStatusColor = 'success';
                                                    	}
                                                    	
                                                    	@endphp
                                                       
                                                    
                                                    <button type="button"
                                                        class="btn btn-{{ $orderStatusColor }}
                                                    dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        {{ str_ireplace(['_'], ' ', ucfirst($order->service_status)) }}
                                                    </button>
                                                    @if ($order->service_status != 'completed' && $order->service_status != 'cancelled')
                                                    <ul class="dropdown-menu" x-placement="bottom-start">
                                                        {{-- @if ($order->service_status != 'pending')
                                                            <li>
                                                                <form
                                                                    action="{{ route('module.booking.status.change') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" value="{{$order->id}}"
                                                                        name="id">
                                                                    <input type="hidden" value="Pending" name="status">
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i
                                                                            class="fas fa-exchange-alt text-warning mr-1"></i>
                                                                        {{ __('pending') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                        @if ($order->service_status != 'accept')
                                                            <li>
                                                                <form
                                                                    action="{{ route('module.booking.status.change') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" value="{{$order->id}}"
                                                                        name="id">
                                                                    <input type="hidden" value="accept" name="status">
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i
                                                                            class="fas fa-exchange-alt text-secondary mr-1"></i>
                                                                        {{ __('Accept') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                        @if ($order->service_status != 'ontheway')
                                                            <li>
                                                                <form
                                                                    action="{{ route('module.booking.status.change') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" value="{{$order->id}}"
                                                                        name="id">
                                                                    <input type="hidden" value="ontheway"
                                                                        name="status">
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i class="fas fa-exchange-alt text-info mr-1"></i>
                                                                        {{ __('On The Way') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                       
                                                        @if ($order->service_status != 'completed')
                                                            <li>
                                                                <form
                                                                    action="{{ route('module.booking.status.change') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                     <input type="hidden" value="{{$order->id}}"
                                                                        name="id">
                                                                    <input type="hidden" value="completed"
                                                                        name="status">
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i
                                                                            class="fas fa-exchange-alt text-success mr-1"></i>
                                                                        {{ __('completed') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif --}}
                                                        @if ($order->service_status != 'cancelled')
                                                            <li>
                                                                <form
                                                                    action="{{ route('module.booking.status.change') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" value="{{$order->id}}"
                                                                        name="id">
                                                                    <input type="hidden" value="cancelled"
                                                                        name="status">
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i
                                                                            class="fas fa-exchange-alt text-danger mr-1"></i>
                                                                        {{ __('cancelled') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                    @endif
                                                </div>
                                            </td>
                                      <td>
                                                <div class="btn-group">
                                                    @php
                                                        $orderStatusColor = "info";
                                                        if($order->sp_status == "instant"){
                                                        	$orderStatusColor = "warning";
                                                        }
                                                        
                                                    @endphp
                                                    <button type="button"
                                                        class="btn btn-{{ $orderStatusColor }}
                                                    dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        {{ str_ireplace(['_'], ' ', ucfirst($order->sp_status)) }}
                                                    </button>
                                                    <ul class="dropdown-menu" x-placement="bottom-start">
                                                        @if ($order->sp_status != 'instant')
                                                            <li>
                                                                <form
                                                                    action="{{ route('module.booking.spstatus.change') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" value="{{$order->id}}"
                                                                        name="id">
                                                                    <input type="hidden" value="instant" name="status">
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i
                                                                            class="fas fa-exchange-alt text-warning mr-1"></i>
                                                                        {{ __('instant') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                        @if ($order->sp_status != 'schedule')
                                                            <li>
                                                                <form
                                                                    action="{{ route('module.booking.spstatus.change') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" value="{{$order->id}}"
                                                                        name="id">
                                                                    <input type="hidden" value="schedule"
                                                                        name="status">
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i class="fas fa-exchange-alt text-info mr-1"></i>
                                                                        {{ __('processing') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                       
                                                    </ul>
                                                </div>
                                            </td>
                                      <td>
                                                
                                                    <a href="{{ route('module.booking.show', ['booking_id'=>$order->booking_no])}}"
                                                        class="btn btn-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                
                                                
                                                    <a href="#" onclick="show_notes({{$order->id}},'{{$order->admin_note}}')"
                                                        class="btn btn-primary">
                                                        <i class="fas fa-sticky-note"></i>
                                                    </a>
                                               
                                               
                                                    <a href="{{route('module.booking.map', ['booking_id'=>$order->booking_no])}}" 
                                                        class="btn btn-primary">
                                                        <i class="fas fa-map"></i>
                                                    </a>
                                               
                                               
                                            </td>
                                    </tr>
                              @endforeach
                            </tbody>

                        </table>
                    </div>
                    @if ($orders->total() > $orders->count())
                        <div class="mt-3 d-flex justify-content-center">{{ $orders->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    
 <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="col-sm-12 mt-4">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Upload Image</label>
                <input type="file" id="files" name="files[]" class="form-control"> <br>
                <span class="text-danger" id="image_error"></span>
            </div>
        </div>
        <div class="col-sm-12 mt-4">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Note</label>
                 <textarea class="form-control" id="notes">  </textarea>
            </div>
        </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="add_note();">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')

<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
<script>
  
 const firebaseConfig = {
  apiKey: "AIzaSyDyy180oNh48A3EPga0aWuWqf8xIgYlyKI",
  authDomain: "selenium-12451.firebaseapp.com",
  projectId: "selenium-12451",
  storageBucket: "selenium-12451.appspot.com",
  messagingSenderId: "1098656685511",
  appId: "1:1098656685511:web:d43b3ca7c306931a32cde2",
  measurementId: "G-FGPF7FZV81"
};
       // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging.requestPermission().then(function () {
            return messaging.getToken()
        }).then(function(token) {
            
          console.log("token data");
         console.log(token);

        }).catch(function (err) {
            console.log(`Token Error :: ${err}`);
        });
    }

    initFirebaseMessagingRegistration();
  
    messaging.onMessage(function({data:{body,title}}){
        new Notification(title, {body});
    });
   
</script>
<script>


    $(document).ready(function () {
    
      
        $('.assign_driver').change(function (e) { 
            e.preventDefault();
           			
            var driverId = $(this).val();
            var bookingId = $(this).attr("book-id");

            let data = {
                driver_id : driverId,
                booking_id :bookingId,
            }
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
          
            $.ajax({
                data: data,
                url: '{{route("module.booking.assign_driver")}}',
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    });
</script>


    <script>
    var service_booking_id = 0;
        $('#filterForm').on('change', function() {
            $(this).submit();
        })
        
        
       function show_notes(id,notes){
       	
       	
       	$("#notes").val(notes);
       
       	$("#staticBackdrop").modal("toggle");
       	service_booking_id = id;
       	
	
       }
       
       function add_note(){
       
       	$array =[];
	  var form_data = new FormData();
	  form_data.append("_token", '{{ csrf_token() }}');
	  form_data.append('service_id',service_booking_id);
	  form_data.append('service_note',$("#notes").val());
	  form_data.append('is_admin',1);

	   // Read selected files
	   var totalfiles = document.getElementById('files').files.length;
	  if(totalfiles != 0){
	   if(totalfiles < 5){
		   for (var index = 0; index < totalfiles; index++) {
		      form_data.append("files[]", document.getElementById('files').files[index]);
		   }
	   }
	    else{
	    	$("#image_error").html("Please select image lessthen 5!");
	    }	
	    }else{
	    	form_data.append("files[]",$array );
	    }
	    $.ajax({
		method: 'POST',
		url: '{{route("module.booking.update_note")}}',
		data: form_data,
		contentType: false,
		processData: false,
		success: function (data) {
		
		    $("#staticBackdrop").modal("toggle");
		    location.reload();
		},
		error: function () {
		  console.log(`Failed`)
		}
	    });
	   
       	
       }
       
    </script>
@endsection
@section('style')
    <style>
        .order-table-list {
            overflow: unset !important;
        }
    </style>
@endsection


