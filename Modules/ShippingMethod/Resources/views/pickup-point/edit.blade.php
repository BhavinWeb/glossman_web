@extends('admin.layouts.app')
@section('title')
    {{ __('edit') }} {{ __('pickup_point') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('edit') }} {{ __('pickup_point') }}
                        </h3>
                        <a href="{{ route('module.pickup-point.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                            <i class="fas fa-arrow-left mr-1"></i>
                            {{ __('back') }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <form class="form-horizontal"
                                    action="{{ route('module.pickup-point.update', ['id' => $pickupPoint->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label class="col-form-label">{{ __('name') }}
                                            <small class="text-danger">*</small>
                                        </label>
                                        <input value="{{ old('name', $pickupPoint->name) }}" name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">
                                            {{ __('state_list') }}
                                            <small class="text-danger">*</small>
                                        </label>
                                        <select name="state_id" id="state_id"
                                            class="select2bs4 @error('state_id') is-invalid @enderror w-100-p">
                                            <option value="">{{ __('select_one') }}</option>
                                            @foreach ($states as $state)
                                                <option
                                                    {{ old('state_id', $pickupPoint->state_id) == $state->id ? 'selected' : '' }}
                                                    value="{{ $state->id }}">
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('state_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">
                                            {{ __('city_list') }}
                                            <small class="text-danger">*</small>
                                        </label>
                                        <select name="city_id" id="city_id"
                                            class="select2bs4 @error('city_id') is-invalid @enderror w-100-p">
                                            <option value="">{{ __('select_one') }}</option>
                                        </select>
                                        @error('city_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">
                                            {{ __('address') }}
                                            <small class="text-danger">*</small>
                                        </label>
                                        <textarea rows="5" type="text" class="form-control" name="address"
                                            placeholder="{{ __('address') }}">{{ old('address', $pickupPoint->address) }}</textarea>
                                        @error('address')
                                            <span class="text-danger font-size-13">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-plus mr-1"></i>
                                            {{ __('save') }} {{ __('pickup_point') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
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
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }

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
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#state_id').on('change', function() {
            var state_id = $(this).val();
            loadCities(state_id);
        });

        var pickupPoint = {!! json_encode($pickupPoint) !!};

        if (pickupPoint.state_id) {
            loadCities(pickupPoint.state_id);
        }

        function loadCities(idState) {
            $.ajax({
                url: "{{ route('module.city.state') }}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(cities) {
                    $('#city_id').html('');
                    if (cities.length > 0) {
                        $("#city_id").append('<option value="">{{ __('select_one') }}</option>');
                        $.each(cities, function(key, value) {
                            $("#city_id").append(
                                `<option id="city${value.id}" value="${value.id}"> ${value.name} </option>`
                            );
                        });

                        if (pickupPoint.city_id) {
                            $('#city_id').val(pickupPoint.city_id);
                        }
                    } else {
                        $('#city_id').html('<option value="">No City Available !</option>');
                    }
                }
            });
        }
    </script>
@endsection
