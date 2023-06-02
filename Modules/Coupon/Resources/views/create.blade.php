@extends('admin.layouts.app')
@section('title')
    {{ __('create') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if (session()->has('message'))
                        <p class="alert alert-success">{{ session()->get('message') }} <button class="close"
                                data-dismiss="alert">&times;</button></p>
                    @endif
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('create_coupon') }}</h3>
                        <a href="{{ route('coupon.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}
                        </a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('coupon.store') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <x-forms.label labelclass="col-sm-3 col-form-label" name="coupon_code" />
                                    <div class="col-sm-9">
                                        <a href="#" onclick="randCode()">{{ __('generate_random_code') }}</a>

                                        <input value="{{ old('code') }}" name="code" type="text"
                                            class="form-control @error('code') is-invalid @enderror"
                                            placeholder="{{ __('coupon_code') }}">
                                        @error('code')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label labelclass="col-sm-3 col-form-label" name="max_use" />
                                    <div class="col-sm-9">
                                        <input value="{{ old('max_use') }}" name="max_use" type="number"
                                            class="form-control @error('max_use') is-invalid @enderror"
                                            placeholder="{{ __('max_use') }}">
                                        @error('max_use')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <x-forms.label labelclass="col-sm-3 col-form-label" name="amount_type" />
                                    <div class="col-sm-9 d-flex items-align-center">
                                        <div class="icheck-success d-inline">
                                            <input name="type" type="radio" id="parcentage" value="Percentage"
                                                {{ old('type') == 'Percentage' ? 'checked' : '' }}>
                                            <label for="parcentage">
                                                {{ __('percentage') }}
                                            </label>
                                        </div>
                                        &nbsp;
                                        &nbsp;
                                        <div class="icheck-success d-inline">
                                            <input name="type" type="radio" id="number" value="Number"
                                                {{ old('type') == 'Number' ? 'checked' : '' }}>
                                            <label for="number">
                                                {{ __('number') }}
                                            </label>
                                        </div>
                                        @error('type')
                                            <span class="invalid-feedback d-block"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label labelclass="col-sm-3 col-form-label" name="amount" />
                                    <div class="col-sm-9">
                                        <input value="{{ old('discount') }}" name="discount" type="number"
                                            class="form-control @error('discount') is-invalid @enderror"
                                            placeholder="{{ __('amount') }}">
                                        @error('discount')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label labelclass="col-sm-3 col-form-label" name="expire_date" />
                                    <div class="col-sm-9 input-group date datepicker">
                                        <input type="text" class="form-control @error('expire_date') is-invalid @enderror"
                                            name="expire_date" value="{{ old('expire_date') }}" id="date"
                                            placeholder="dd/mm/yyyy" class="" />
                                        @error('expire_date')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                        <div class="input-group-append" data-target="#reservationdate"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;
                                            {{ __('create') }}</button>
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

@section('script')
    <script src="{{ asset('backend/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script>
        //init datepicker
        $("#date").attr("autocomplete", "off");
        //init datepicker
        $('.datepicker').off('focus').datepicker({
            format: 'yyyy-mm-dd',
        }).on('click', function() {
            $(this).datepicker('show');
        });
    </script>
    <script>
        function randCode() {
            let r = Math.random().toString(36).substring(7);
            $("input[name=code]").val(r);
        }
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection
