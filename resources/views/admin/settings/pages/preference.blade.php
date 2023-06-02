@extends('admin.settings.setting-layout')
@section('title')
    {{ __('preferences') }}
@endsection

@section('website-settings')
    <div class="card" id="mode_settings">
        <div class="card-header">
            <h3 class="card-title">
                {{ __('preferences') }}
            </h3>
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="{{ route('settings.website.preference.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row ">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <x-forms.label name="maintenance_mode" labelclass="col-sm-5" />
                            <div class="col-sm-7">
                                <input type="hidden" name="maintenance_mode" value="0" />
                                <input type="checkbox" id="maintenance_mode" name="maintenance_mode" data-on-color="success"
                                    data-on-text="ON" data-off-color="default" data-off-text="OFF" data-size="small"
                                    value="1" {{ config('app.mode') == 'maintenance' ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <x-forms.label name="coming_soon_mode" labelclass="col-sm-5" />
                            <div class="col-sm-7">
                                <input type="hidden" name="comingsoon_mode" value="0" />
                                <input {{ config('app.mode') == 'comingsoon' ? 'checked' : '' }} type="checkbox"
                                    id="comingsoon_mode" name="comingsoon_mode" data-on-color="success" data-on-text="ON"
                                    data-off-color="default" data-off-text="OFF" data-size="small" value="1">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        @if (userCan('setting.update'))
                            <div class="form-group row text-center justify-content-center">
                                <button type="submit" class="btn btn-success" id="setting_button">
                                    <i class="fas fa-sync"></i>
                                    {{ __('update') }}
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $("#app_debug").bootstrapSwitch();
        $("#facebook_pixel").bootstrapSwitch();
        $("#google_analytics").bootstrapSwitch();
        $("#language_changing").bootstrapSwitch();
        $("#search_engine_indexing").bootstrapSwitch();
        $("#maintenance_mode").bootstrapSwitch();
        $("#comingsoon_mode").bootstrapSwitch();
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#buttonOne').prop('disabled', true);
        $('#buttonTwo').prop('disabled', true);
        $('#buttonThree').prop('disabled', true);
        $('#buttonFour').prop('disabled', true);
        $('#buttonFive').prop('disabled', true);

        function ButtonDisabled(id, input, data) {
            let inputVal = $('[name=' + input + ']').val();
            if (inputVal == data) {
                $('#' + id).prop('disabled', true);
            } else {
                $('#' + id).prop('disabled', false);
            }
        }

        $("input[data-bootstrap-switch]").on('switchChange.bootstrapSwitch', function(event, state) {

            let oldData = event.target.attributes.oldvalue.value;
            let newData = event.currentTarget.checked ? 1 : 0;
            let button = event.target.attributes.button.value;

            if (oldData == newData) {
                $('#' + button).prop('disabled', true);
            } else {
                $('#' + button).prop('disabled', false);
            }
        });
    </script>
@endsection

@section('style')
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
