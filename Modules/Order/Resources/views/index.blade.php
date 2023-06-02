@extends('admin.layouts.app')

@section('title')
    {{ __('orders') }}
@endsection

@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('orders') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('orders') }}</li>
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
                            <p class="text-muted font-15 mb-0">{{ __('total_orders') }}</p>
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
                            <p class="text-muted font-15 mb-0">{{ __('pending_orders') }}</p>
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
                            <p class="text-muted font-15 mb-0">{{ __('canceled_orders') }}</p>
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
                            <p class="text-muted font-15 mb-0">{{ __('processing_orders') }}</p>
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
                            <p class="text-muted font-15 mb-0">{{ __('on_the_way_orders') }}</p>
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
                            <p class="text-muted font-15 mb-0">{{ __('delivered_orders') }}</p>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <form class="row mt-2" id="filterForm" action="{{ route('module.order.index') }}" method="GET">
                            <div class="col-sm-12 col-md-2 p-1">
                                <h3 class="card-title line-height-36">{{ __('order_list') }}</h3>
                            </div>
                            <div class="col-sm-6 col-md-2 p-1">
                                <select name="delivery_status" class="form-control w-100-p">
                                    <option value="" selected>
                                        {{ __('delivery_status') }}
                                    </option>
                                    <!--<option {{ request('delivery_status') == 'pending' ? 'selected' : '' }}
                                        value="pending">
                                        {{ __('pending') }}
                                    </option>-->
                                    <option {{ request('delivery_status') == 'processing' ? 'selected' : '' }}
                                        value="processing">
                                        {{ __('processing') }}
                                    </option>
                                    <option {{ request('delivery_status') == 'on_the_way' ? 'selected' : '' }}
                                        value="on_the_way">
                                        {{ __('on_the_way') }}
                                    </option>
                                    <option {{ request('delivery_status') == 'delivered' ? 'selected' : '' }}
                                        value="delivered">
                                        {{ __('delivered') }}
                                    </option>
                                    <option {{ request('delivery_status') == 'cancelled' ? 'selected' : '' }}
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
                                        placeholder="{{ __('order_no') }}/ {{ __('custmer_name') }}/ {{ __('sku') }}"
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
                                    <th>{{ __('order_no') }}</th>
                                    <th>{{ __('customer') }}</th>
                                    <th>{{ __('total_price') }}</th>
                                    <th>{{ __('payment') }}</th>
                                    @if (userCan('order.statusUpdate'))
                                        <th>{{ __('status') }}</th>
                                    @endif
                                    @if (userCan('order.download') || userCan('order.details'))
                                        <th width="10%">{{ __('action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('module.order.show', $order->order_no) }}">
                                                #{{ $order->order_no }}
                                            </a>
                                        </td>
                                        <td>
                                            @if ($order->customer)
                                                
                                                
                                                @php	
                                                	
                                                	$rsltUser = \App\Models\User::where("id", $order->user_id)->first();
                                                
                                                @endphp
                                                
                                                    {{ $rsltUser->name }}
                                               
                                            @else
                                                <span class="badge badge-pill badge-secondary">{{ __('guest_checkout') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ multiCurrency($order->total_price) }}</td>
                                        <td>
                                            @if ($order->payment_method == 'offline')
                                                @if (isset($order->manualPayment) && isset($order->manualPayment->name))
                                                    <span>{{ ucfirst($order->manualPayment->name) }}</span>/
                                                @else
                                                    <span>{{ ucfirst($order->payment_method) }}</span>/
                                                @endif
                                            @else
                                                <span>{{ ucfirst($order->payment_method) }}</span>/
                                            @endif

                                            <span
                                                class="badge badge-pill badge-{{ $order->payment_status == 'paid' ? 'success' : 'danger' }}">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                            <br>
                                            @if ($order->payment_status == 'unpaid')
                                                <x-admin.order-mark-paid :orderid="$order->id" />
                                            @endif
                                        </td>
                                        @if (userCan('order.statusUpdate'))
                                            <td>
                                                <div class="btn-group">
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
                                                      @if ($order->order_status != 'on_the_way')
                                                            @if ($order->order_status != 'processing')
                                                                <li>
                                                                    <form
                                                                        action="{{ route('module.order.status.change', $order->order_no) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" value="processing"
                                                                            name="status">
                                                                        <button type="submit" class="dropdown-item">
                                                                            <i class="fas fa-exchange-alt text-info mr-1"></i>
                                                                            {{ __('processing') }}
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            @endif
                                                        @endif
                                                       <!-- @if ($order->order_status != 'processing')
                                                            <li>
                                                                <form
                                                                    action="{{ route('module.order.status.change', $order->order_no) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" value="processing"
                                                                        name="status">
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i class="fas fa-exchange-alt text-info mr-1"></i>
                                                                        {{ __('processing') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif -->
                                                        @if ($order->order_status != 'on_the_way')
                                                            <li>
                                                                <form
                                                                    action="{{ route('module.order.status.change', $order->order_no) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" value="on_the_way"
                                                                        name="status">
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i
                                                                            class="fas fa-exchange-alt text-secondary mr-1"></i>
                                                                        {{ __('on_the_way') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                        @if ($order->order_status != 'delivered')
                                                            <li>
                                                                <form
                                                                    action="{{ route('module.order.status.change', $order->order_no) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" value="delivered"
                                                                        name="status">
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i
                                                                            class="fas fa-exchange-alt text-success mr-1"></i>
                                                                        {{ __('delivered') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                         @endif
                                                        @if ($order->order_status != 'cancelled')
                                                            <li>
                                                                <form
                                                                    action="{{ route('module.order.status.change', $order->order_no) }}"
                                                                    method="POST">
                                                                    @csrf
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
                                        @endif
                                        @if (userCan('order.download') || userCan('order.details'))
                                            <td>
                                                @if (userCan('order.details'))
                                                    <a href="{{ route('module.order.show', $order->order_no) }}"
                                                        class="btn btn-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endif
                                                @if (userCan('order.download'))
                                                    <a href="{{ route('module.order.generate', $order->id) }}"
                                                        target="_blank" class="btn btn-info">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                @endif
                                                 @if (userCan('order.details'))
                                                    <a href="#" onclick="show_notes({{$order->id}},'{{$order->note}}')"
                                                        class="btn btn-primary">
                                                        <i class="fas fa-sticky-note"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="20">
                                            <x-admin.not-found word="order" />
                                        </td>
                                    </tr>
                                @endforelse
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
      	
        <div class="col-sm-12 ">
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
    <script>
    
    	var order_id = 0;
    
        function show_notes(id,notes){
       
       	$("#notes").val(notes);
       
       	$("#staticBackdrop").modal("toggle");
       	
       	order_id = id;
	
       }
       
       
       
    function add_note(){
   	
       var formData = {
         "_token": "{{ csrf_token() }}",
           order_id: order_id,
           note:$("#notes").val(),
           
       };
       
       var type = "POST";
       var ajaxurl = "{{URL::to('/admin/order/update-note')}}";
       $.ajax({
           type: type,
           url: ajaxurl,
           data:formData,
           dataType: 'json',
           success: function (data) {
           
		   $('#staticBackdrop').modal('toggle');
		   location.reload();	   
		   
           },
           error: function (data) {
               console.log(data);
           }
       });
       
       
       }
       
       
        $('#filterForm').on('change', function() {
            $(this).submit();
        })
        
    </script>
@endsection
@section('style')
    <style>
        .order-table-list {
            overflow: unset !important;
        }
    </style>
@endsection
