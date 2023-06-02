@extends('admin.layouts.app')
@section('title')
    {{ __('customer_list') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('customer_list') }}</h3>
                        <div class="align-items-center  ml-auto">
                            <button onclick="toggleShowFilter();"
                                class="btn bg-warning float-right d-flex align-items-center justify-content-center ml-2 toggleFilter"><i
                                    class="fas fa-filter mr-1"></i> {{ __('filter') }}</button>
                            @if (userCan('customer.create'))
                                <a href="{{ route('module.customer.create') }}"
                                    class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                    <i class="fas fa-plus"></i>
                                    &nbsp; {{ __('create') }}
                                </a>
                            @endif
                        </div>
                    </div>
                    <form id="formSubmit" action="{{ route('module.customer.index') }}" method="GET">
                        <div id="filter"
                            class="row justify-content-between my-3 pl-3 {{ request('perpage') || request('sort_by') || request('keyword') ? '' : 'd-none' }}">
                            <div class="col-sm-12 col-md-6 ml-2 customRow1">
                                <div class="row">
                                    <div class="col-sm-2 customdiv1">
                                        <select name="perpage" class="form-control form-control-sm">
                                            <option {{ request('perpage') == '10' ? 'selected' : '' }} value="10">10
                                            </option>
                                            <option {{ request('perpage') == '25' ? 'selected' : '' }} value="25">25
                                            </option>
                                            <option {{ request('perpage') == '50' ? 'selected' : '' }} value="50">50
                                            </option>
                                            <option {{ request('perpage') == '100' ? 'selected' : '' }} value="100">100
                                            </option>
                                            <option {{ request('perpage') == 'all' ? 'selected' : '' }} value="all">
                                                {{ __('all') }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 customdiv2">
                                        <select name="sort_by" class="form-control form-control-sm">
                                            <option value="" class="d-none">
                                                {{ __('sort_by') }}
                                            </option>
                                            <option value="latest"
                                                {{ request('sort_by') == 'latest' ? 'selected' : '' }}>
                                                {{ __('latest') }}
                                            </option>
                                            <option {{ request('sort_by') == 'oldest' ? 'selected' : '' }}
                                                value="oldest">
                                                {{ __('oldest') }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2 d-flex customdiv4">
                                        <button class="btn btn-primary btn-sm" type="submit">{{ __('filter') }}</button>
                                        <a href="{{ route('module.customer.index') }}" id="crossB"
                                            class="d-none btn btn-danger ml-2 btn-sm">{{ __('clear') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 text-right mr-2 customRow2">
                                <input type="text"
                                    @if (request('keyword')) value="{{ request('keyword') }}" @endif
                                    id="keyword" class="form-control" placeholder="{{ __('search') }}..."
                                    name="keyword">
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr class="text-center">
                                <tr role="row">
                                    <th>{{_('profile')}}</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('email') }}</th>
                                    <th>{{ __('phone') }}</th>
                                    <th>{{ __('billing_address') }}</th>
                                    <th>{{ __('total_orders') }}</th>
                                    <th>{{ __('joined') }}</th>
                                   
                                    <th>{{ __('status') }}</th>
                                     <th>User status</th>
                                    @if (userCan('customer.update') || userCan('customer.delete'))
                                        <th class="text-center">{{ __('action') }}</th>
                                    @endif
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $key => $customer)
                                    <tr>
                                      @if($customer->image != "")
                                    <td><img class="img-circle img-size-32 mr-2"
                                                src="{{asset('uploads/user_image/'.$customer->image) }}" alt=""></td>
                                @else
                                    <td><img class="img-circle img-size-32 mr-2"
                                                src="{{asset('default.png') }}" alt=""></td>
                                
                                @endif
                                
                                        <td>
                                         
                                            <span><a
                                                    href="{{ route('module.customer.show', $customer->id) }}">{{ $customer->full_name }}</a></span>
                                        </td>
                                        <td>
                                            {{ $customer->email }}
                                        </td>
                                        <td>
                                            {{ $customer->phone ?? '-' }}
                                        </td>
                                        <td>
                                            {{ $customer->billingAddress->address ?? '-' }}
                                        </td>
                                        <td>
                                            {{ $customer->orders_count ?? '0' }}
                                        </td>
                                        <td>
                                            {{ date('Y/m/d', strtotime($customer->created_at)) ?? '-' }}
                                        </td>
                                        <td class="text-center">
                                            <label class="switch ">
                                                <input data-id="{{ $customer->id }}" type="checkbox"
                                                    class="success toggle-switch"
                                                    {{ !$customer->banned_status ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                         <td class="text-center">
                                            @if($customer->deleted_account == 1)
                                            	Deactivated
                                            @else
                                            Active
                                            @endif
                                                
                                            
                                        </td>
                                        
                                        @if (userCan('customer.update') || userCan('customer.delete'))
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        {{ __('action') }}
                                                    </button>
                                                    <ul class="dropdown-menu" x-placement="bottom-start">
                                                      @if($customer->deleted_account == 0)
                                                        @if (userCan('customer.view'))
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('module.customer.show', $customer->id) }}"><i
                                                                        class="fas fa-eye text-info"></i>
                                                                    {{ __('details') }}
                                                                </a>
                                                            </li>
                                                        @endif
                                                        @if (userCan('customer.update'))
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('module.customer.edit', $customer->id) }}"><i
                                                                        class="fas fa-edit text-info"></i>
                                                                    {{ __('edit') }}
                                                                </a>
                                                            </li>
                                                        @endif
                                                        @if (userCan('customer.delete'))
                                                            <li>
                                                                <form
                                                                    action="{{ route('module.customer.destroy', $customer->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');">
                                                                        <i class="fas fa-trash text-danger"></i>
                                                                        {{ __('delete') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                        
                                                        <li>
                                                            
                                                                <button  class="dropdown-item"
                                                                    onclick="show_notes({{$customer->id}},'{{$customer->note}}')">
                                                                        <i class="fas fa-sticky-note"></i>
                                                                    Note
                                                                </button>
                                                            
                                                        </li>
                                                        <li>
                                                            
                                                            <button  class="dropdown-item"
                                                                onclick="show_mail('{{$customer->email}}')">
                                                                <i class="fas fa-envelope"></i>
                                                                Mail
                                                            </button>
                                                        
                                                        </li>
                                                    @else
                                                        @if (userCan('customer.view'))
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('module.customer.show', $customer->id) }}"><i
                                                                        class="fas fa-eye text-info"></i>
                                                                    {{ __('details') }}
                                                                </a>
                                                            </li>
                                                        @endif
                                                        @if (userCan('customer.delete'))
                                                            <li>
                                                                <form
                                                                    action="{{ route('module.customer.destroy', $customer->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');">
                                                                        <i class="fas fa-trash text-danger"></i>
                                                                        {{ __('delete') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                    @endif
                                                    </ul>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="8">
                                            <x-admin.not-found word="customer" />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if (request('perpage') != 'all')
                        <div class="mt-3 d-flex justify-content-center">
                            {{ $customers->links() }}
                        </div>
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
      	
        <div class="col-sm-12">
            <div class="form-group">
               
                 <textarea class="form-control" id="notes" row="10">  </textarea>
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

<div class="modal fade" id="mailbox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="col-sm-12">
      <label for="html">To:</label><br>
            <div class="form-group">
                 <input type="text" id="to_email" class="form-control" value="" placeholder="To Email" disabled>
            </div>
        </div>
        <div class="col-sm-12">
        <label for="html">From:</label><br>
            <div class="form-group">
            <input type="text" id="from_email" class="form-control" value="" placeholder="From Email" disabled>
            </div>
        </div>
        <div class="col-sm-12">
        <label for="html">Message:</label><br>
            <div class="form-group">
                 <textarea class="form-control" id="message" row="10">  </textarea>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="send_mail();">Send Mail</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('style')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 35px;
            height: 19px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            display: none;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 15px;
            left: 3px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input.success:checked+.slider {
            background-color: #28a745;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(15px);
            -ms-transform: translateX(15px);
            transform: translateX(15px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection

@section('script')

    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    
    <script>
    
    	var user_id = 0;
    
        function show_notes(id,notes){
       
       	$("#notes").val(notes);
       
       	$("#staticBackdrop").modal("toggle");
       	
       	user_id = id;
	
       }
    
       
       function show_mail(email){
        $("#to_email").val(email);
        $("#from_email").val("anjaneyulumanga@gmail.com");
       $("#mailbox").modal("toggle");

   }
       function send_mail(){

        var formData = {
         "_token": "{{ csrf_token() }}",
           user_id: user_id,
           email:$("#to_email").val(),
           message:$("#message").val(),
           
       };
       
       var type = "POST";
       var ajaxurl = "{{URL::to('/admin/customer/send-mail')}}";
       $.ajax({
           type: type,
           url: ajaxurl,
           data:formData,
           dataType: 'json',
           success: function (data) {
           
		   $('#mailbox').modal('toggle');
		   $("#message").val('');
           setTimeout(function() {
        alert("Mail send to customer successfully!");
    }, 2000);
    
		   
           },
           error: function (data) {
               console.log(data);
           }
       });

       }
       
    function add_note(){
   	
       var formData = {
         "_token": "{{ csrf_token() }}",
           user_id: user_id,
           note:$("#notes").val(),
           
       };
       
       var type = "POST";
       var ajaxurl = "{{URL::to('/admin/customer/update-note')}}";
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
       
    
    
        $('.toggle-switch').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('module.customer.status.change') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });
        });

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
    </script>
    <script>
        function toggleShowFilter() {
            $('#filter').toggleClass('d-none');
        }
    </script>
@endsection
