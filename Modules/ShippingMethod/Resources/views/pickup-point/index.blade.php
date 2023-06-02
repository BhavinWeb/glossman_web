@extends('admin.layouts.app')
@section('title')
    {{ __('pickup_point_list') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title line-height-36">{{ __('pickup_point_list') }}
                                <span class="ml-1 badge bg-primary">
                                    {{ $addresses->count() }}
                                </span>
                            </h3>
                            <div class="align-items-center ml-auto">
                                <a href="{{ route('module.pickup-point.create') }}" class="btn btn-primary">
                                    {{ __('create') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table
                                class="table table-hover responsive mb-0 {{ $addresses->count() > 1 ? 'table-bordered' : '' }}">
                                <thead>
                                    <tr class="text-center">
                                        <th width="5%">#</th>
                                        <th>{{ __('name') }}</th>
                                        <th>{{ __('state') }}</th>
                                        <th>{{ __('city') }}</th>
                                        <th>{{ __('address') }}</th>
                                        @if (userCan('country.update') || userCan('country.delete'))
                                            <th>{{ __('action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($addresses->count() > 0)
                                        @foreach ($addresses as $method)
                                            <tr role="row" class="text-center items-center">
                                                <td class="text-center" tabindex="0">
                                                    {{ $method->id }}
                                                </td>
                                                <td>
                                                    {{ $method->name }}
                                                </td>
                                                <td class="text-center" tabindex="0">
                                                    {{ $method->state->name }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $method->city->name }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $method->address }}
                                                </td>
                                                @if (userCan('country.update') || userCan('country.delete'))
                                                    <td class="text-center" tabindex="0">
                                                        @if (userCan('country.update'))
                                                            <a data-toggle="tooltip" data-placement="top"
                                                                title="{{ __('edit') }}"
                                                                href="{{ route('module.pickup-point.edit', $method->id) }}"
                                                                class="btn bg-info"><i class="fas fa-edit"></i>
                                                            </a>
                                                        @endif
                                                        <form
                                                            action="{{ route('module.pickup-point.destroy', $method->id) }}"
                                                            method="POST" class="d-inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button data-toggle="tooltip" data-placement="top"
                                                                title="{{ __('delete') }} {{ __('pickup-point') }}"
                                                                onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                                class="btn bg-danger mr-1">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
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
