@extends('admin.layouts.app')
@section('title')
    {{ __('shipping_method_list') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title line-height-36">{{ __('shipping_method_list') }}
                                <span class="ml-1 badge bg-primary">
                                    {{ $methods->count() }}
                                </span>
                            </h3>
                            <div class="align-items-center ml-auto">
                                <a href="{{ route('module.pickup-point.index') }}" class="btn btn-primary">
                                    {{ __('pickup_point') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table
                                class="table table-hover responsive mb-0 {{ $methods->count() > 1 ? 'table-bordered' : '' }}">
                                <thead>
                                    <tr class="text-center">
                                        <th width="5%">#</th>
                                        <th>{{ __('name') }}</th>
                                        <th>{{ __('type') }}</th>
                                        <th>{{ __('amount') }}</th>
                                        @if (userCan('country.update') || userCan('country.delete'))
                                            <th>{{ __('action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($methods->count() > 0)
                                        @foreach ($methods as $method)
                                            <tr role="row" class="text-center items-center">
                                                <td class="text-center" tabindex="0">
                                                    {{ $method->id }}
                                                </td>
                                                <td>
                                                    {{ $method->name }}
                                                </td>
                                                <td class="text-center" tabindex="0">
                                                    {{ $method->shipping_type }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $method->amount }}
                                                </td>
                                                @if (userCan('country.update') || userCan('country.delete'))
                                                    <td class="d-flex align-items-center justify-content-center text-center"
                                                        tabindex="0">
                                                        <label class="switch mb-0 mr-4">
                                                            <input data-id="{{ $method->id }}" type="checkbox"
                                                                class="success toggle-switch"
                                                                {{ $method->status == 1 ? 'checked' : '' }} disabled>
                                                            <span class="slider round"></span>
                                                        </label>
                                                        @if (userCan('country.update'))
                                                            <a data-toggle="tooltip" data-placement="top"
                                                                title="{{ __('edit') }}"
                                                                href="{{ route('module.shippingmethod.edit', $method->id) }}"
                                                                class="btn bg-info"><i class="fas fa-edit"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="5">
                                                {{ __('no_data_found') }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
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
