@extends('attribute::layouts.tab')

@section('title')
    {{ __('edit') }}
@endsection
@section('tab-nav')
    <a href="{{ route('module.attributes.edit', $attribute->id) }}" class="nav-link bg-primary text-white">
        {{ __('general') }}
    </a>
    <a href="{{ route('module.attribute.value.index', $attribute->id) }}" class="nav-link">
        {{ __('variant_value') }}
    </a>
@endsection

@section('tab-content')
    <div class="card shadow-sm card-primary">
        <div class="card-header">
            {{ __('variant_information') }}
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="{{ route('module.attributes.update', $attribute->id) }}" method="POST"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{ __('variant_name') }}</label>
                    <div class="col-sm-9">
                        <input value="{{ $attribute->name }}" name="name" type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="{{ __('variant_name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{ __('code') }}</label>
                    <div class="col-sm-9">
                        <input value="{{ $attribute->code }}" name="code" type="text"
                            class="form-control @error('code') is-invalid @enderror"
                            placeholder="{{ __('code') }}">
                        @error('code')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{ __('frontend_type') }}</label>
                    <div class="col-sm-9">
                        <select name="frontend_type" id="frontend_type"
                            class="form-control @error('frontend_type') is-invalid @enderror">
                            <option value="select" @if ($attribute->frontend_type == 'select') selected @endif>
                                {{ __('select_box') }}</option>
                            <option value="radio" @if ($attribute->frontend_type == 'radio') selected @endif>
                                {{ __('radio_button') }}</option>
                        </select>
                        @error('frontend_type')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-3 col-sm-4">
                        <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>&nbsp;
                            {{ __('update') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection
