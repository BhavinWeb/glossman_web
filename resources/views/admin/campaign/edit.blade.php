@extends('admin.layouts.app')
@section('title')
    {{ __('campaign_edit') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('campaign_edit') }}</h3>
                        <a href="{{ route('campaigns.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-10 offset-md-1">
                            <form enctype="multipart/form-data" action="{{ route('campaigns.update', $campaign->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <x-forms.label name="title" :required="true" />
                                            <input value="{{ $campaign->title }}" name="title" type="text"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="{{ __('title') }}">
                                            @error('title')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <x-forms.label name="products" required="true" />
                                            <select name="products[]" multiple
                                                class="select2ds4 @error('products') is-invalid @enderror w-100-p">
                                                @foreach ($products as $product)
                                                    <option
                                                        @foreach ($campaign->campaignProducts as $old) {{ $old->product_id == $product->id ? 'selected' : '' }} @endforeach
                                                        value="{{ $product->id }}">{{ Str::ucfirst($product->title) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('products')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <x-forms.label name="start_date" required="true" />
                                                <div class="input-group date datepicker">
                                                    <input type="text"
                                                        class="form-control @error('start_date') is-invalid @enderror"
                                                        name="start_date"
                                                        value="{{ $campaign->start_date ? date('Y-m-d', strtotime($campaign->start_date)) : '' }}"
                                                        id="date" placeholder="dd/mm/yyyy" class="" />
                                                    @error('start_date')
                                                        <span class="invalid-feedback"
                                                            role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                    <div class="input-group-append" data-target="#reservationdate"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                                @error('start_date')
                                                    <span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <x-forms.label name="end_date" required="true" />
                                                <div class="input-group date datepicker">
                                                    <input type="text"
                                                        class="form-control @error('end_date') is-invalid @enderror"
                                                        name="end_date"
                                                        value="{{ $campaign->end_date ? date('Y-m-d', strtotime($campaign->end_date)) : '' }}"
                                                        id="date" placeholder="dd/mm/yyyy" class="" />
                                                    <div class="input-group-append" data-target="#reservationdate"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                    @error('end_date')
                                                        <span class="invalid-feedback"
                                                            role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                                @error('end_date')
                                                    <span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <x-forms.label name="discount_type" required="true" />
                                                <select name="discount_type"
                                                    class="select2ds4 @error('discount_type') is-invalid @enderror w-100-p">
                                                    <option selected
                                                        {{ $campaign->discount_type == 'amount' ? 'selected' : '' }}
                                                        value="amount">{{ __('amount') }}
                                                    </option>
                                                    <option
                                                        {{ $campaign->discount_type == 'percentage' ? 'selected' : '' }}
                                                        value="percentage">{{ __('percentage') }}
                                                    </option>
                                                </select>
                                                @error('discount_type')
                                                    <span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <x-forms.label name="discount_amount" required="true" />
                                                <input value="{{ $campaign->discount_value }}" name="discount_amount"
                                                    type="number"
                                                    class="form-control @error('discount_amount') is-invalid @enderror"
                                                    placeholder="{{ __('discount_amount') }}">
                                                @error('discount_amount')
                                                    <span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <x-forms.label name="status" required="true" />
                                        <div class="">
                                            <x-forms.switch-input button="button1" name="status"
                                                onText="{{ __('yes') }}" offText="{{ __('no') }}" oldvalue=""
                                                value="1" :checked="$campaign->status" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <x-forms.label name="image" required="true" />
                                            <input name="image" data-default-file="{{ $campaign->image }}" type="file"
                                                accept="image/png, image/jpg, image/jpeg"
                                                class="form-control dropify file-icon @error('image') is-invalid @enderror"
                                                data-max-file-size="3M" data-show-errors="true"
                                                data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                                            @error('image')
                                                <span class="invalid-feedback d-block"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-6 offset-3 text-center">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-sync"></i> {{ __('update') }}
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
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('backend/plugins/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend') }}/css/bootstrap-datepicker.min.css">
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

        .ck-editor__editable_inline {
            min-height: 80px;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="{{ asset('backend/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('backend') }}/dist/js/ckeditor.js"></script>
    <script src="{{ asset('backend/js/bootstrap-datepicker.min.js') }}"></script>
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
        //Initialize Select2 Elements
        $('.select2ds4').select2({
            theme: 'bootstrap4'
        })
        $(".tag").select2({
            tags: true,
            tokenSeparators: [',', ' '],
            theme: 'bootstrap4'
        })
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
        // dropify
        var drEvent = $('.dropify').dropify();

        drEvent.on('dropify.error.fileSize', function(event, element) {
            alert('Filesize error message!');
        });
        drEvent.on('dropify.error.imageFormat', function(event, element) {
            alert('Image format error message!');
        });

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
    </script>
@endsection
