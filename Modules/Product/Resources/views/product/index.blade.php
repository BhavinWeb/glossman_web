@extends('admin.layouts.app')
@section('title')
    {{ __('product_list') }}
@endsection

@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('product_list') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('products') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="">
        <div class="row mb-3 justify-content-center flex-wrap">
            <div class="col min-w-250">
                <div class="card rounded-0">
                    <div class="card-body text-center">
                        <i class="fab fa-product-hunt text-muted font-size-24"></i>
                        <h3><span>{{ $stats['total'] }}</span></h3>
                        <p class="text-muted font-15 mb-0">{{ __('total_products') }}</p>
                    </div>
                </div>
            </div>
            <div class="col min-w-250">
                <div class="card rounded-0">
                    <div class="card-body text-center">
                        <i class="fas fa-star text-muted font-size-24"></i>
                        <h3><span>{{ $stats['featured'] }}</span></h3>
                        <p class="text-muted font-15 mb-0">{{ __('featured') }}</p>
                    </div>
                </div>
            </div>
            <div class="col min-w-250">
                <div class="card rounded-0">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle text-muted font-size-24"></i>
                        <h3><span>{{ $stats['active'] }}</span></h3>
                        <p class="text-muted font-15 mb-0">{{ __('active') }}</p>
                    </div>
                </div>
            </div>
            <div class="col min-w-250">
                <div class="card rounded-0">
                    <div class="card-body text-center">
                        <i class="fas fa-times text-muted font-size-24"></i>
                        <h3><span>{{ $stats['inActive'] }}</span></h3>
                        <p class="text-muted font-15 mb-0">{{ __('inactive') }}</p>
                    </div>
                </div>
            </div>
            <div class="col min-w-250">
                <div class="card rounded-0">
                    <div class="card-body text-center">
                        <i class="fas fa-battery-empty text-muted font-size-24"></i>
                        <h3><span>{{ $stats['outOfStock'] }}</span></h3>
                        <p class="text-muted font-15 mb-0">{{ __('out_of_stock') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('product_list') }}</h3>
                        @if (userCan('product.create'))
                            <div class="align-items-center  ml-auto">
                                <a href="{{ route('module.product.create') }}"
                                    class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                    <i class="fas fa-plus"></i>
                                    &nbsp; {{ __('add_product') }}
                                </a>
                            </div>
                        @endif
                    </div>
                    <form class="row ml-3 mr-3 mt-3 justify-content-center" id="formSubmit"
                        action="{{ route('module.product.index') }}" method="GET">
                        <div class="col-sm-12 col-md-2 p-1">
                            <select name="category" class="form-control">
                                <option value="" {{ !request('category') ? 'selected' : '' }}>{{ __('all_category') }}
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}"
                                        {{ request('category') == $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-2 p-1">
                            <select name="brand" class="form-control">
                                <option value="" {{ !request('brand') ? 'selected' : '' }}>{{ __('all_brands') }}
                                </option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->slug }}"
                                        {{ request('brand') == $brand->slug ? 'selected' : '' }}>{{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-2 p-1">
                            <select name="status" class="form-control w-100-p">
                                <option value="" class="d-none">
                                    {{ __('status') }}
                                </option>
                                <option {{ request('status') == 'active' ? 'selected' : '' }} value="active">
                                    {{ __('active') }}
                                </option>
                                <option {{ request('status') == 'inactive' ? 'selected' : '' }} value="inactive">
                                    {{ __('inactive') }}
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-2 p-1">
                            <div class="input-group mb-3">
                                <input name="title" id="title" value="{{ request('title') ? request('title') : '' }}"
                                    type="text" placeholder="Search..." class="form-control font-size-13">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-1 p-1">
                            <div class="input-group mb-3">
                                <a href="{{ route('module.product.index') }}" id="crossB" class="d-none btn btn-danger">
                                    {{ __('clear') }}
                                </a>
                            </div>
                        </div>
                    </form>
                    <div class="border-top card-body text-center table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr class="text-center">
                                <tr role="row" class="text-center">
                                    <th>{{ __('sl') }}</th>
                                    <th>{{ __('image') }}</th>
                                    <th>{{ __('title') }}</th>
                                    <th>{{ __('total_orders') }}</th>
                                    <th>{{ __('stock') }}</th>
                                    <th>{{ __('price') }}</th>
                                    <th>{{ __('category') }}</th>
                                    @if (userCan('product.update'))
                                        <th>{{ __('status') }}</th>
                                    @endif
                                    @if (userCan('product.update') || userCan('product.delete'))
                                        <th>{{ __('action') }}</th>
                                    @endif
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr id="category_id{{ $product->id }}" role="row" class="odd">
                                        <td class="sorting_1 text-center">{{ $loop->index + 1 }}</td>
                                        <td class="sorting_1 text-center" tabindex="0">
                                            <img width="60px" height="60px" src="{{ asset($product->image) }}"
                                                class="rounded" alt="Product Image">
                                        </td>
                                        <td class="sorting_1 text-center" tabindex="0">
                                            <a
                                                href="{{ route('module.product.show', $product->id) }}">{{ Str::limit($product->title, 30, '...') }}</a>
                                        </td>
                                        <td class="sorting_1 text-center" tabindex="0">
                                            {{ $product->total_orders }}</td>
                                        <td class="sorting_1 text-center" tabindex="0">
                                            {{ $product->stock }}</td>
                                        <td class="sorting_1 text-center" tabindex="0">
                                            @if ($product->sale_price)
                                                {{$product->currency}} {{ $product->sale_price }}
                                                <del>{{$product->currency}} {{ $product->price }}</del>
                                            @else
                                                {{$product->currency}} {{ $product->price }}
                                            @endif
                                        </td>
                                        <td class="sorting_1 text-center" tabindex="0">
                                            <a
                                                href="{{ route('category.wise.product', $product->category_id) }}">{{ $product->category->name }}</a>
                                        </td>

                                        @if (userCan('product.update'))
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
                                        @endif
                                        @if (userCan('product.update') || userCan('product.delete'))
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
                                                        
                                                        @if (userCan('product.create') && userCan('product.update'))
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('product.attributes.index', $product->id) }}">
                                                                    <i class="fas fa-plus text-primary"></i>
                                                                    {{ __('variant') }}
                                                                </a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('module.product.gallery.index', $product->id) }}"><i
                                                                        class="fas fa-image text-info"></i>
                                                                    {{ __('gallery') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a data-toggle="modal" data-target="#highlightModal"
                                                                    class="dropdown-item" href="#"
                                                                    onclick="PushHighlightData('{{ $product }}')">
                                                                    <i class="fas fa-star text-warning"></i>
                                                                    {{ __('highlight') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('module.product.edit', $product->id) }}"><i
                                                                        class="fas fa-edit text-info"></i>
                                                                    {{ __('edit') }}
                                                                </a>
                                                            </li>
                                                        @endif
                                                        @if (userCan('product.delete'))
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
                                                        @endif
                                                    </ul>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="20">
                                            <x-admin.not-found route="module.product.create" word="product" />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if (request('perpage') != 'all' && $products->total() > $products->count())
                        <div class="mt-3 d-flex justify-content-center">
                            {{ $products->onEachSide(1)->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @include('product::product.highlight')
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

        function PushHighlightData(value) {

            let product = JSON.parse(value);
            $('#product-for-highlight').val(product.id);
            if (product.featured == true) {
                $('input[name=featured]').bootstrapSwitch('state', true);
            }
            if (product.hot == true) {
                $('input[name=hot]').bootstrapSwitch('state', true);
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            validate();
            $('#title').keyup(validate);
        });

        function validate() {
            if (
                $('#title').val().length > 0) {
                $('#crossB').removeClass('d-none');
            } else {
                $('#crossB').addClass('d-none');
            }
        }

        $('#formSubmit').on('change', function() {
            $(this).submit();
        });

        function RemoveFilter(id) {
            $('#' + id).val('');
            $('#formSubmit').submit();
        }
    </script>
@endsection
