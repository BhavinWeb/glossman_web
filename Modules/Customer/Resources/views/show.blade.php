@extends('admin.layouts.app')
@section('title')
    {{ __('customer') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36"> <img  src="{{asset('uploads/user_image/'.$customer->image) }}" alt="image"
                                class="img-circle img-size-32 mr-2">
                            {{ ucfirst($customer->full_name) }}
                            (<a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a>)</h3>
                        <div class="align-items-center  ml-auto">
                            <a href="{{ route('module.customer.index') }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                <i class="fas fa-arrow-left"></i>
                                &nbsp; {{ __('back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <div class="row m-2">
                            <div class="col-12">
                                <i class="fas fa-user"></i> {{ __('customer_was_created') }}
                                <br>
                                <span class="pl-3">{{ formatDate($customer->created_at, 'F d, Y H:i A') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36"> {{ __('details') }}</h3>
                         @if($customer->deleted_account == 0)
                        <div class="align-items-center  ml-auto">
                            <a href="{{ route('module.customer.edit', $customer->id) }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                <i class="fas fa-sync"></i>
                                &nbsp; {{ __('update') }}
                            </a>
                        </div>
                         @endif
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <table class="table no-border no-gutters">
                                <thead>
                                    <th>
                                        {{ __('account_information') }}
                                    </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th width="20%">{{ __('first_name') }}</th>
                                        <td width="80%">{{ $customer->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th width="20%">{{ __('email') }}</th>
                                        <td width="80%">{{ $customer->email ?? '-' }}</td>
                                    </tr>
                                   
                                    @if ($customer->phone)
                                        <tr>
                                            <th width="20%">{{ __('phone') }}</th>
                                            <td width="80%">{{ $customer->phone ?? '-' }}
                                            </td>
                                        </tr>
                                    @endif
                                    
                                    <tr>
                                        <th width="20%">{{ __('created_at') }}</th>
                                        <td width="80%">{{ formatDate($customer->created_at, 'F d, Y H:i A') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="20%">{{ __('updated_at') }}</th>
                                        <td width="80%">{{ formatDate($customer->updated_at, 'F d, Y H:i A') }}
                                        </td>
                                    </tr>
                                     <tr>
                                        <th width="20%">Note</th>
                                        <td width="80%">{{ $customer->note ?? '-' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                       
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            {{ __('wishlist') }}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <table class="ml-1 table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                width="100%">
                                <tr class="text-center">
                                <tr role="row" class="text-center">
                                    <th>{{ __('sl') }}</th>
                                    <th>{{ __('image') }}</th>
                                    <th>{{ __('title') }}</th>
                                    <th>{{ __('total_orders') }}</th>
                                    <th>{{ __('price') }}</th>
                                    <th>{{ __('category') }}</th>
                                    <th>{{ __('status') }}</th>
                                    <th>{{ __('action') }}</th>
                                </tr>
                                </tr>
                                <tbody>
                                    @forelse ($customer->wishlists as $product)
                                        <tr id="category_id{{ $product->id }}" role="row" class="odd">
                                            <td class="sorting_1 text-center">{{ $loop->index + 1 }}</td>
                                            <td class="sorting_1 text-center" tabindex="0">
                                                <img width="60px" height="60px" src="{{ asset($product->image) }}"
                                                    class="rounded" alt="Product Image">
                                            </td>
                                            <td class="sorting_1 text-center" tabindex="0">
                                                {{ Str::limit($product->title, 30, '...') }}
                                            </td>
                                            <td class="sorting_1 text-center" tabindex="0">
                                                {{ $product->total_orders }}</td>
                                            <td class="sorting_1 text-center" tabindex="0">
                                                @if ($product->sale_price)
                                                    {{ multiCurrency($product->sale_price) }}
                                                    <del>{{ multiCurrency($product->price) }}</del>
                                                @else
                                                    {{ multiCurrency($product->price) }}
                                                @endif
                                            </td>
                                            <td class="sorting_1 text-center" tabindex="0"><a
                                                    href="{{ route('category.wise.product', $product->category_id) }}">{{ $product->category->name }}</a>
                                            </td>
                                            <td class="text-center">
                                                <div>
                                                    <label class="switch ">
                                                        <input data-id="{{ $product->id }}" type="checkbox"
                                                            class="success toggle-switch"
                                                            {{ $product->status == 1 ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-groupa">
                                                    <button type="button" class="btn btn-info dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        {{ __('options') }}
                                                    </button>
                                                    <ul class="dropdown-menu" x-placement="bottom-start">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('module.product.show', $product->id) }}">
                                                                <i class="fas fa-eye text-success"></i>
                                                                {{ __('details') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('module.product.edit', $product->id) }}"><i
                                                                    class="fas fa-edit text-info"></i>
                                                                {{ __('edit') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form
                                                                action="{{ route('module.product.destroy', $product->id) }}"
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
                                                    </ul>
                                                </div>
                                            </td>
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
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            {{ __('orders') }}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <table class="ml-1 table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">{{ __('sl') }}</th>
                                        <th>{{ __('no') }}</th>
                                        <th>{{ __('total_price') }}</th>
                                        <th>{{ __('payment') }}</th>
                                        <th>{{ __('status') }}</th>
                                        <th width="10%">{{ __('action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($customer->orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ route('module.order.show', $order->order_no) }}">
                                                    #{{ $order->order_no }}
                                                </a>
                                            </td>
                                            <td>{{ multiCurrency($order->total_price) }}</td>
                                            <td>
                                                <span>
                                                    {{ ucfirst($order->payment_method) }}
                                                </span>/
                                                <span
                                                    class="badge badge-pill badge-{{ $order->payment_status == 'paid' ? 'success' : 'danger' }}">
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button"
                                                        class="btn
                                                @if ($order->order_status == 'pending') btn-warning @endif
                                                @if ($order->order_status == 'processing') btn-info @endif
                                                @if ($order->order_status == 'on_the_way') btn-secondary @endif
                                                @if ($order->order_status == 'delivered') btn-success @endif
                                                @if ($order->order_status == 'cancelled') btn-danger @endif
                                                dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        {{ str_ireplace(['_'], ' ', ucfirst($order->order_status)) }}
                                                    </button>
                                                    @if($order->order_status != "cancelled")
                                                    <ul class="dropdown-menu" x-placement="bottom-start">
                                                     @if($order->order_status != "delivered")
                                                      <!--  @if ($order->order_status != 'pending')
                                                            <li style="display:none">
                                                                <form
                                                                    action="{{ route('module.order.status.change', $order->order_no) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" value="pending" name="status">
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i
                                                                            class="fas fa-exchange-alt text-warning mr-1"></i>
                                                                        {{ __('pending') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                        -->
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
                                            <td>
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
                                    @empty
                                        <tr>
                                            <td colspan="7">
                                                <div class="empty py-5">
                                                    <div class="empty-img">
                                                        <img src="{{ asset('backend/image') }}/not-found.svg"
                                                            height="128" alt="">
                                                    </div>
                                                    <h5 class="mt-4">{{ __('no_results_found') }}</h5>
                                                    <p class="empty-subtitle text-muted">
                                                        {{ __('there_is_no') }} {{ __('found_in_this_page') }}
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if ($customer->orders()->count())
                            <div class="mt-3 d-flex justify-content-center">
                                {{ $customer->orders()->paginate(10)->links() }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet"
        href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        $("#category_checkall").on("click", function() {
            if ($("input:checkbox").prop("checked")) {
                $("input:checkbox[name='single_category_checkbox']").prop("checked", true);
                $("#selected_item_delete").attr("disabled", false);
            } else {
                $("input:checkbox[name='single_category_checkbox']").prop("checked", false);
                $("#selected_item_delete").attr("disabled", true);
            }
        });

        $('.toggle-switch').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('product.status.change') }}',
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
@endsection
