@extends('admin.settings.setting-layout')
@section('title')
    {{ __('google_recaptcha') }}
@endsection
@section('website-settings')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('google_recaptcha') }}</h3>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('settings.recaptcha.update') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <x-forms.label name="your_site_key" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input type="text" name="key" id="key"
                                            class="form-control @error('key') is-invalid @enderror"
                                            value="{{ env('NOCAPTCHA_SITEKEY') }}"
                                            placeholder="6Lf1CiYfAAAAAJ8gl8IzLfNixe5tRgplgkyXwqNv">
                                        @error('key')
                                            <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="your_site_secret" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input type="text" name="secret" id="secret"
                                            class="form-control @error('secret') is-invalid @enderror"
                                            value="{{ env('NOCAPTCHA_SECRET') }}"
                                            placeholder="6Lf1CiYfAAAAACmi0blsxudWjsxdQbGCNRLT9ngN">
                                        @error('secret')
                                            <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="active" labelclass="col-sm-3" :required="false" />
                                    <div class="col-sm-9">
                                        <x-forms.switch-input button="buttonOne" oldvalue="oldalue" name="active"
                                            onText="{{ __('active') }}" offText="{{ __('off') }}" value="true"
                                            :checked="env('NOCAPTCHA_ACTIVE')" />
                                    </div>
                                </div>
                                @if (userCan('setting.view'))
                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-4">
                                            <button type="submit" class="btn btn-success"><i
                                                    class="fas fa-plus"></i>&nbsp;
                                                {{ __('update') }}</button>
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

        $("input[name=symbol_position]").on('switchChange.bootstrapSwitch', function(event, state) {
            let val = event.currentTarget.checked ? 'left' : 'right';
            $('input[name=symbol_position]').val(val);
        });
    </script>
@endsection
