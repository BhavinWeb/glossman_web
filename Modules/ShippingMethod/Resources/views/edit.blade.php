@extends('admin.layouts.app')
@section('title')
    {{ __('edit') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title line-height-36">{{ __('edit') }}</h3>
                            <a href="{{ route('module.shippingmethod.index') }}"
                                class="btn bg-primary d-flex align-items-center justify-content-center">
                                <i class="fas fa-arrow-left mr-1"></i> {{ __('back') }}
                            </a>
                        </div>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal"
                                action="{{ route('module.shippingmethod.update', $method->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group row">
                                    <x-forms.label name="{{ __('shipping_type') }}" :required="false"
                                        labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input class="form-control" value="{{ $method->shipping_type }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="{{ __('name') }}" :required="true"
                                        labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ $method->name }}" name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    @if ($method->shipping_type == 'free')
                                        <x-forms.label name="{{ __('minimum_amount') }}" :required="false"
                                            labelclass="col-sm-3" />
                                    @else
                                        <x-forms.label name="{{ __('amount') }}" :required="true"
                                            labelclass="col-sm-3" />
                                    @endif
                                    <div class="col-sm-9">
                                        <input value="{{ $method->amount }}" name="amount" step="0.1" type="number"
                                            class="form-control @error('amount') is-invalid @enderror"
                                            placeholder="{{ __('amount') }}">
                                        @error('amount')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="{{ __('status') }}" :required="true"
                                        labelclass="col-sm-3" />
                                    <div class="col-sm-9 d-flex align-items-center">
                                        <label class="switch mb-0 mr-3">
                                            <input id="input{{ $method->id }}" data-id="{{ $method->id }}"
                                                type="checkbox" class="success toggle-switch" name="status"
                                                {{ $method->status == 1 ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                        <label class="mb-0"
                                            for="input{{ $method->id }}">{{ __('enable') }}</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-sync"></i>&nbsp; {{ __('update') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
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
