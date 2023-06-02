@extends('admin.layouts.app')
@section('title')
    {{ __('product_variant') }}
@endsection
@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('module.product.index') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('product_variant') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-dark d-flex justify-content-between align-items-center">
                        <h5 class="d-inline mb-0">{{ __('product_information') }}</h5>
                        <div class="ml-auto">
                            <a href="{{ route('module.product.index') }}"
                                class="btn bg-info float-right d-flex align-items-center justify-content-center"><i
                                    class="fas fa-arrow-left"></i>&nbsp;{{ __('product_list') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered  text-center mb-3">
                            <thead class="text-dark">
                                <tr>
                                    <th width="45%">{{ __('title') }}</th>
                                    <th width="30%">{{ __('category') }}</th>
                                    <th width="25%">{{ __('price') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        <a href="{{ route('module.product.edit', $product->id) }}">
                                            {{ $product->title }}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('module.category.edit', $product->category->id) }}">
                                            {{ $product->category->name }}
                                        </a>
                                    </td>
                                    <td class="sorting_1 text-center" tabindex="0">
                                        @if ($product->sale_price)
                                            {{ multiCurrency($product->sale_price) }} <del>
                                                {{ multiCurrency($product->price) }}</del>
                                        @else
                                            {{ multiCurrency($product->price) }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ __('product_variant_value') }}</h5>
                    </div>
                    <div class="card-body">
                        @if ($product_attribute)
                            <form action="{{ route('product.attribute.update', $product_attribute->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div id="multiple_img_part">
                                    <div class="row justify-content-center mb-10">
                                        <div class="col-lg-6 col-md-3 col-6">
                                            <div class="form-group">
                                                <label>{{ __('product_variant') }} <span
                                                        class="text-danger">*</span></label>
                                                <select id="attribute_id" onchange="fetch_attribute_option()"
                                                    name="attribute_id"
                                                    class="select2bs4 @error('attribute_id') is-invalid @enderror w-100-p">
                                                    <option value="">{{ __('choose_variant') }}</option>
                                                    @foreach ($attributes as $attribute)
                                                        <option
                                                            {{ $product_attribute->attribute_id == $attribute->id ? 'selected' : '' }}
                                                            value="{{ $attribute->id }}">{{ $attribute->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('attribute_id')
                                                    <span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-3 col-6">
                                            @php
                                                $value = Modules\Attribute\Entities\AttributeValue::where('id', $product_attribute->value_id)->first();
                                            @endphp
                                            <div class="form-group">
                                                <label>{{ __('variant_options') }} <span
                                                        class="text-danger">*</span></label>
                                                <select id="attribute_option" name="value_id"
                                                    class="select2bs4 @error('value_id') is-invalid @enderror w-100-p">
                                                    <option value="{{ $value->id }}">{{ $value->value }}</option>
                                                </select>
                                                @error('value_id')
                                                    <span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>
                                            {{ __('update') }}</button>
                                        <a href="{{ route('product.attributes.index', $product_attribute->product_id) }}"
                                            class="btn btn-secondary"><i class="fas fa-times"></i>
                                            {{ __('cancel_edit') }} </a>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('product.attributes.store', $product->id) }}" method="POST">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div id="multiple_img_part">
                                    <div class="row justify-content-center mb-10">
                                        <div class="col-lg-6 col-md-3 col-6">
                                            <div class="form-group">
                                                <label>{{ __('product_variant') }} <span
                                                        class="text-danger">*</span></label>
                                                <select id="attribute_id" onchange="fetch_attribute_option()"
                                                    name="attribute_id"
                                                    class="select2bs4 @error('attribute_id') is-invalid @enderror w-100-p">
                                                    <option value="">{{ __('choose_variant') }}</option>
                                                    @foreach ($attributes as $attribute)
                                                        <option
                                                            {{ old('attribute_id') == $attribute->id ? 'selected' : '' }}
                                                            value="{{ $attribute->id }}">{{ $attribute->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('attribute_id')
                                                    <span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-3 col-6">
                                            <div class="form-group">
                                                <label>{{ __('variant_options') }} <span
                                                        class="text-danger">*</span></label>
                                                <select id="attribute_option" name="value_id"
                                                    class="select2bs4 @error('value_id') is-invalid @enderror w-100-p">
                                                    <option value="">{{ __('choose_option') }}</option>
                                                </select>
                                                @error('value_id')
                                                    <span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>
                                            {{ __('save_variant') }}</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ __('product_variant_list') }}</h5>
                            <a href="{{ route('module.attributes.index') }}" class="btn bg-primary">
                                <i class="fas fa-arrow-left"></i> {{ __('create_variant') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered mb-3">
                            <thead class="text-dark">
                                <tr class="text-center">
                                    <th width="10%">{{ __('id') }}</th>
                                    <th width="20%">{{ __('variant') }}</th>
                                    <th width="30%">{{ __('variant_option') }}</th>
                                    @if (userCan('product.update') || userCan('product.delete'))
                                        <th width="20%">{{ __('action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="sortable">
                                @if (count($product_attributes) != 0)
                                    @foreach ($product_attributes as $product_attribute)
                                        <tr>
                                            <td class="text-center">{{ $product_attribute->id }}</td>
                                            <td class="text-center">{{ $product_attribute->attribute->name }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-primary">{{ $product_attribute->value }}</span>
                                            </td>
                                            @if (userCan('product.update') || userCan('product.delete'))
                                                <td class="text-center">
                                                    @if (userCan('product.update'))
                                                        <a data-toggle="tooltip" data-placement="top"
                                                            title="Edit Product Variant"
                                                            href="{{ route('product.attributes.edit', $product_attribute->id) }}"
                                                            class="btn bg-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endif
                                                    @if (userCan('product.delete'))
                                                        <form
                                                            action="{{ route('product.attributes.destroy', $product_attribute->id) }}"
                                                            method="POST" class="d-inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button title="Delete Product Variant"
                                                                onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                                class="btn bg-danger"><i
                                                                    class="fas fa-trash text-light"></i></button>
                                                        </form>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center">{{ __('nothing_found') }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <style>
        .select2-results__option[aria-selected=true] {
            display: none;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            color: #fff;
            border: 1px solid #fff;
            background: #007bff;
            border-radius: 30px;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        function fetch_attribute_option() {
            var id = $('#attribute_id').val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ route('fetch.attributes.value') }}",
                data: {
                    id: id,
                },
                success: function(data) {
                    $('#attribute_option').empty();
                    $.each(data.options, function(index, option) {
                        $('#attribute_option').append('<option value="' + option.id + '">' + option
                            .value + '</option>');
                    });
                },
            })
        };
    </script>
@endsection
