@extends('admin.settings.setting-layout')
@section('title')
    {{ __('website_settings') }}
@endsection
@section('website-settings')
    <div class="row">
       <div class="col-xl-6 col-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    {{ __('basic_setting') }}
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('settings.general.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="type" value="1" >
                        <div class="row ">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="" for="application_name"> {{ __('application_name') }}
                                    </label>
                                    <input value="{{ old('app_name', env('APP_NAME')) }}" name="app_name" type="text"
                                        class="form-control " placeholder="{{ __('site_name') }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="" for="owner_email"> {{ __('owner_email') }} </label>
                                    <input value="{{ old('owner_email', $setting->owner_email) }}" name="owner_email"
                                        type="email" class="form-control " placeholder="{{ __('owner_email') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col">
                                <div class="form-group">
                                    <label class="" for="service_station_address"> {{ __('Service Station Address') }}
                                    </label>
                                    <input value="{{old('service_station_address', $setting->service_station_address) }}" name="service_station_address" type="text"
                                        class="form-control " placeholder="{{ __('service_address') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="" for="service_station_lat"> {{ __('Service Station Lattitude') }} </label>
                                    <input value="{{old('service_station_lat', $setting->service_station_lat) }}" name="service_station_lat"
                                        type="text" class="form-control " placeholder="{{ __('service_station_lat') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="" for="service_station_long"> {{ __('Service Station Longitude') }} </label>
                                    <input value="{{old('service_station_long', $setting->service_station_long) }}" name="service_station_long"
                                        type="text" class="form-control " placeholder="{{ __('service_station_long') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-4">
                                <x-forms.label name="dark_logo" />
                                <input type="file" class="form-control dropify"
                                    data-default-file="{{ $setting->logo_image_url }}" name="logo_image"
                                    data-allowed-file-extensions='["jpg", "jpeg","png","svg"]'
                                    accept="image/png, image/jpg,image/svg image/jpeg" data-max-file-size="3M">
                            </div>
                            <div class="col-sm-4">
                                <x-forms.label name="light_logo" />
                                <input type="file" class="form-control dropify"
                                    data-default-file="{{ $setting->logo_image2_url }}" name="logo_image2"
                                    data-allowed-file-extensions='["jpg", "jpeg","png","svg"]'
                                    accept="image/png, image/jpg,image/svg image/jpeg" data-max-file-size="1M">

                            </div>
                            <div class="col-sm-4">
                                <x-forms.label name="favicon" />
                                <input type="file" class="form-control dropify"
                                    data-default-file="{{ $setting->favicon_image_url }}" name="favicon_image"
                                    data-allowed-file-extensions='["ico","png"]' accept="image/png, image/ico"
                                    data-max-file-size="1M">
                            </div>
                            <div class="row mt-3 mx-auto">
                                @if (userCan('setting.update'))
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-sync"></i>
                                        {{ __('update') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    Social icons
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('settings.general.social_links') }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="type" value="1" >
                        <div class="row ">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="" for="facebook"> {{ __('facebook') }}
                                    </label>
                                    <input value="{{ old('facebook',$setting->facebook) }}" name="facebook" type="text"
                                        class="form-control " placeholder="{{ __('facebook') }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="" for="youtube"> {{ __('youtube') }} </label>
                                    <input value="{{ old('youtube', $setting->youtube) }}" name="youtube"
                                        type="text" class="form-control " placeholder="{{ __('youtube') }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="" for="twitter"> {{ __('twitter') }} </label>
                                    <input value="{{ old('twitter', $setting->twitter) }}" name="twitter"
                                        type="text" class="form-control " placeholder="{{ __('twitter') }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="" for="google"> {{ __('google') }} </label>
                                    <input value="{{ old('google', $setting->google) }}" name="google"
                                        type="text" class="form-control " placeholder="{{ __('google') }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="" for="instagram"> {{ __('instagram') }} </label>
                                    <input value="{{ old('instagram', $setting->instagram) }}" name="instagram"
                                        type="text" class="form-control " placeholder="{{ __('instagram') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row mt-3 mx-auto">
                                @if (userCan('setting.update'))
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-sync"></i>
                                        {{ __('update') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
           <div class="col-xl-6 col-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    Payments 
                </div>
                <div class="card-body">
                     <form class="form-horizontal" action="{{ route('settings.general.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="type" value="2" >
                        <div class="row ">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="" for="application_name"> Square Sandbox AppId 
                                    </label>
                                    <input value="{{ $setting->square_appid }}" name="square_appid" type="text"
                                        class="form-control " placeholder="Square Sandbox AppId">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="" for="application_name"> Square Sandbox accesstoken 
                                    </label>
                                    <input value="{{ $setting->square_accesstoken }}" name="square_accesstoken" type="text"
                                        class="form-control " placeholder="accesstoken">
                                </div>
                            </div>
                         
                        </div>
                       <div class="row ">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="" for="application_name"> Twillio Account Sid 
                                    </label>
                                    <input value="{{ $setting->accountSid }}" name="accountSid" type="text"
                                        class="form-control " placeholder="account Sid">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="" for="application_name"> Square Sandbox service Sid 
                                    </label>
                                    <input value="{{ $setting->serviceSid }}" name="serviceSid" type="text"
                                        class="form-control " placeholder="service Sid">
                                </div>
                            </div>
                             <div class="col-6">
                                <div class="form-group">
                                    <label class="" for="application_name"> Square Sandbox Auth Token
                                    </label>
                                    <input value="{{ $setting->authtoken }}" name="authToken" type="text"
                                        class="form-control " placeholder="auth Token">
                                </div>
                            </div>
                         
                        </div>
                         <div class="row mt-3 mx-auto">
                                @if (userCan('setting.update'))
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-sync"></i>
                                        {{ __('update') }}
                                    </button>
                                @endif
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('app_configuration') }}
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.system.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6 mb-3">
                                <x-forms.label name="time_zone" />
                                <select name="timezone"
                                    class="select2bs4 @error('timezone') is-invalid @enderror timezone-select form-control">
                                    @foreach ($timezones as $timezone)
                                        <option {{ config('app.timezone') == $timezone->value ? 'selected' : '' }}
                                            value="{{ $timezone->value }}">
                                            {{ $timezone->value }}
                                        </option>
                                    @endforeach
                                    @error('timezone')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <x-forms.label name="app_debug" />
                                <div>
                                    <input type="hidden" name="app_debug" value="0" />
                                    <input type="checkbox" id="app_debug" {{ config('app.debug') ? 'checked' : '' }}
                                        name="app_debug" data-bootstrap-switch data-on-color="success"
                                        data-on-text="{{ __('on') }}" data-off-color="default"
                                        data-off-text="{{ __('off') }}" data-size="small" value="1">
                                    <x-forms.error name="app_debug" />
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <x-forms.label name="set_default_language" />
                                <select class="select2bs4 form-control @error('code') is-invalid @enderror" name="code"
                                    id="default_language">
                                    @foreach ($languages as $language)
                                        <option
                                            {{ $language->code == config('zakirsoft.default_language') ? 'selected' : '' }}
                                            value="{{ $language->code }}">
                                            {{ $language->name }}({{ $language->code }})
                                        </option>
                                    @endforeach
                                    @error('code')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <x-forms.label name="frontend_language_changing" :required="true" />
                                <div>
                                    <input type="hidden" name="language_changing" value="0" />
                                    <input type="checkbox" id="language_changing"
                                        {{ $setting->language_changing ? 'checked' : '' }} name="language_changing"
                                        data-on-color="success" data-bootstrap-switch data-on-text="{{ __('on') }}"
                                        data-off-color="default" data-off-text="{{ __('off') }}" data-size="small"
                                        value="1">
                                    <x-forms.error name="language_changing" />
                                </div>
                            </div>
                            <div class="col-6">
                                <x-forms.label name="set_default_currency" for="inlineFormCustomSelect" />
                                <select name="currency" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option value="" disabled selected>{{ __('currency') }}
                                    </option>
                                    @foreach ($currencies as $key => $currency)
                                        <option {{ config('zakirsoft.currency') == $currency->code ? 'selected' : '' }}
                                            value="{{ $currency->id }}">
                                            {{ $currency->name }} ( {{ $currency->code }} )
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <x-forms.label name="app_url" for="app_url_field" />
                                <input value="{{ old('app_url', config('app.url')) }}" name="app_url" type="text"
                                    class="form-control @error('app_url') is-invalid @enderror" autocomplete="off"
                                    id="app_url_field">
                                @error('app_url')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if (userCan('setting.view'))
                            <div class="w-full mt-4 mb-2 ml-2 d-flex justify-content-center items-center">
                                <button type="submit" class="btn btn-success" id="setting_button">
                                    <span><i class="fas fa-sync"></i> {{ __('update') }}</span>
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card mb-3">
                    <div class="card-header">
                        {{ __('about_us') }}
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('settings.general.static') }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="" for="application_name"> {{ __('about_us') }}
                                        </label>
                                    <textarea name="about_us" id="editor1" cols="30" class="form-control" rows="5">{{$setting->about_us}}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-3 mx-auto">
                                @if (userCan('setting.update'))
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-sync"></i>
                                        {{ __('update') }}
                                    </button>
                                @endif
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card mb-3">
                    <div class="card-header">
                        {{ __('privacy_policy') }}
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('settings.general.static') }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="" for="application_name"> {{ __('privacy_policy') }}
                                        </label>
                                    <textarea name="privacy_policy" id="editor2" cols="30" class="form-control" rows="5">{{$setting->privacy_policy}}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-3 mx-auto">
                                @if (userCan('setting.update'))
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-sync"></i>
                                        {{ __('update') }}
                                    </button>
                                @endif
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card mb-3">
                    <div class="card-header">
                        {{ __('terms_condition') }}
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('settings.general.static') }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="" for="application_name"> {{ __('terms_condition') }}
                                        </label>
                                    <textarea name="terms_condition" id="editor3" class="form-control" rows="5">{{$setting->terms_condition}}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-3 mx-auto">
                                @if (userCan('setting.update'))
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-sync"></i>
                                        {{ __('update') }}
                                    </button>
                                @endif
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            {{-- Google recaptcha Setting --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title line-height-36">{{ __('recaptcha_configuration') }}
                        </h3>
                        <div class="form-group row">
                            <input id="recaptcha_switch" {{ config('captcha.active') ? 'checked' : '' }} type="checkbox"
                                name="status" data-bootstrap-switch value="1">
                        </div>
                    </div>
                </div>
                @if (config('captcha.active'))
                    <form class="form-horizontal" action="{{ route('settings.recaptcha.update') }}" method="POST"
                        id="recaptch_form">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <x-forms.label name="nocaptcha_secret" labelclass="col-sm-4" />
                                <div class="col-sm-8">
                                    <input value="{{ old('nocaptcha_key', config('captcha.sitekey')) }}"
                                        name="nocaptcha_key" type="text"
                                        class="form-control @error('nocaptcha_key') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('nocaptcha_key')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="nocaptcha_sitekey" labelclass="col-sm-4" />
                                <div class="col-sm-8">
                                    <input value="{{ old('nocaptcha_secret', config('captcha.secret')) }}"
                                        name="nocaptcha_secret" type="text"
                                        class="form-control @error('nocaptcha_secret') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('nocaptcha_secret')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            @if (userCan('setting.update'))
                                <div class="form-group row">
                                    <div class="offset-sm-4 col-sm-7">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                            {{ __('update') }}</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection

@section('script')
    <script src="{{ asset('backend/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="{{ asset('backend') }}/dist/js/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.js" data-turbolinks-track="true"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
    <script>
    
     ClassicEditor
            .create(document.querySelector('#editor1'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor3'))
            .catch(error => {
                console.error(error);
            });
        $('.dropify').dropify();
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        $("#recaptcha_switch").on('switchChange.bootstrapSwitch', function(event, state) {
            let status = state ? 1 : 0;
            $("input[name=status]").val(status);

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('settings.recaptcha.status.update') }}",
                data: {
                    'status': status
                },
                success: function(response) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                }
            });
        });

        ClassicEditor
            .create(document.querySelector('#editor1'))
            .catch(error => {
                console.error(error);
            });
            ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
            ClassicEditor
            .create(document.querySelector('#editor3'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
@endsection

