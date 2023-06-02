@extends('admin.settings.setting-layout')
@section('title')
    {{ __('social_login_setting') }}
@endsection

@section('website-settings')
    <div class="row">
        <div class="col-sm-6">
            {{-- Google Login Credential Setting --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title line-height-36">{{ __('google_login_credential') }}</h3>
                        <div class="form-group row">
                            <input {{ config('zakirsoft.google_active') ? 'checked' : '' }} type="checkbox" name="google"
                                data-bootstrap-switch value="1">
                        </div>
                    </div>
                </div>
                @if (config('zakirsoft.google_active'))
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('settings.social.login.update') }}" method="POST"
                            id="google-social-form">
                            @method('PUT')
                            @csrf
                            <input type="hidden" value="google" name="type">
                            <input type="hidden" value="{{ config('zakirsoft.google_active') }}" name="status">
                            <div class="form-group row">
                                <x-forms.label name="google_client_id" labelclass="col-sm-5" />
                                <div class="col-sm-7">
                                    <input
                                        onkeyup="ButtonDisabled('buttonOne', 'google_client_id' , '{{ config('zakirsoft.google_id') }}')"
                                        value="{{ config('zakirsoft.google_id') }}" name="google_client_id" type="text"
                                        class="form-control @error('google_client_id') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('google_client_id')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="google_client_secret" labelclass="col-sm-5" />
                                <div class="col-sm-7">
                                    <input
                                        onkeyup="ButtonDisabled('buttonOne', 'google_client_secret' , '{{ config('zakirsoft.google_secret') }}')"
                                        value="{{ config('zakirsoft.google_secret') }}" name="google_client_secret"
                                        type="text" class="form-control @error('google_client_secret') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('google_client_secret')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            @if (userCan('setting.update'))
                                <div class="form-group row">
                                    <div class="offset-sm-5 col-sm-7">
                                        <button id="buttonOne" type="submit" class="btn btn-success"><i
                                                class="fas fa-sync"></i>
                                            {{ __('update') }}</button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                @endif
            </div>

            {{-- Facebook Login Credential Setting --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title line-height-36">{{ __('facebook_login_credential') }}</h3>
                        <div class="form-group row">
                            <input {{ config('zakirsoft.facebook_active') ? 'checked' : '' }} type="checkbox"
                                name="facebook" data-bootstrap-switch value="1">
                        </div>
                    </div>
                </div>
                @if (config('zakirsoft.facebook_active'))
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('settings.social.login.update') }}" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" value="facebook" name="type">
                            <div class="form-group row">
                                <x-forms.label name="facebook_client_id" labelclass="col-sm-5" />
                                <div class="col-sm-7">
                                    <input
                                        onkeyup="ButtonDisabled('buttonTwo', 'facebook_client_id' , '{{ config('zakirsoft.facebook_id') }}')"
                                        value="{{ config('zakirsoft.facebook_id') }}" name="facebook_client_id"
                                        type="text" class="form-control @error('facebook_client_id') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('facebook_client_id')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="facebook_client_secret" labelclass="col-sm-5" />
                                <div class="col-sm-7">
                                    <input
                                        onkeyup="ButtonDisabled('buttonTwo', 'facebook_client_secret' , '{{ config('zakirsoft.facebook_secret') }}')"
                                        value="{{ config('zakirsoft.facebook_secret') }}" name="facebook_client_secret"
                                        type="text"
                                        class="form-control @error('facebook_client_secret') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('facebook_client_secret')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            @if (userCan('setting.update'))
                                <div class="form-group row">
                                    <div class="offset-sm-5 col-sm-7">
                                        <button id="buttonTwo" type="submit" class="btn btn-success"><i
                                                class="fas fa-sync"></i>
                                            {{ __('update') }}</button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                @endif
            </div>
            {{-- Twitter Login Credential Setting --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title line-height-36">{{ __('twitter_login_credential') }}</h3>
                        <div class="form-group row">
                            <input {{ config('zakirsoft.twitter_active') ? 'checked' : '' }} type="checkbox"
                                name="twitter" data-bootstrap-switch value="1">
                        </div>
                    </div>
                </div>
                @if (config('zakirsoft.twitter_active'))
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('settings.social.login.update') }}" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" value="twitter" name="type">
                            <div class="form-group row">
                                <x-forms.label name="twitter_client_id" labelclass="col-sm-5" />
                                <div class="col-sm-7">
                                    <input
                                        onkeyup="ButtonDisabled('buttonThree', 'twitter_client_id' , '{{ config('zakirsoft.twitter_id') }}')"
                                        value="{{ config('zakirsoft.twitter_id') }}" name="twitter_client_id" type="text"
                                        class="form-control @error('twitter_client_id') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('twitter_client_id')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="twitter_client_secret" labelclass="col-sm-5" />
                                <div class="col-sm-7">
                                    <input
                                        onkeyup="ButtonDisabled('buttonThree', 'twitter_client_secret' , '{{ config('zakirsoft.twitter_secret') }}')"
                                        value="{{ config('zakirsoft.twitter_secret') }}" name="twitter_client_secret"
                                        type="text"
                                        class="form-control @error('twitter_client_secret') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('twitter_client_secret')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            @if (userCan('setting.update'))
                                <div class="form-group row">
                                    <div class="offset-sm-5 col-sm-7">
                                        <button id="buttonThree" type="submit" class="btn btn-success"><i
                                                class="fas fa-sync"></i>
                                            {{ __('update') }}</button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-sm-6">
            {{-- Linkedin Login Credential Setting --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title line-height-36">{{ __('linkedin_login_credential') }}</h3>
                        <div class="form-group row">
                            <input {{ config('zakirsoft.linkedin_active') ? 'checked' : '' }} type="checkbox"
                                name="linkedin" data-bootstrap-switch value="1">
                        </div>
                    </div>
                </div>
                @if (config('zakirsoft.linkedin_active'))
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('settings.social.login.update') }}" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" value="linkedin" name="type">
                            <div class="form-group row">
                                <x-forms.label name="linkedin_client_id" labelclass="col-sm-5"
                                    for="linkedin_client_id" />
                                <div class="col-sm-7">
                                    <input
                                        onkeyup="ButtonDisabled('buttonFour', 'linkedin_client_id' , '{{ config('zakirsoft.linkedin_id') }}')"
                                        value="{{ config('zakirsoft.linkedin_id') }}" name="linkedin_client_id"
                                        type="text" class="form-control @error('linkedin_client_id') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('linkedin_client_id')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="linkedin_client_secret" labelclass="col-sm-5"
                                    for="linkedin_client_secret" />
                                <div class="col-sm-7">
                                    <input
                                        onkeyup="ButtonDisabled('buttonFour', 'linkedin_client_secret' , '{{ config('zakirsoft.linkedin_secret') }}')"
                                        value="{{ config('zakirsoft.linkedin_secret') }}" name="linkedin_client_secret"
                                        type="text"
                                        class="form-control @error('linkedin_client_secret') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('linkedin_client_secret')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            @if (userCan('setting.update'))
                                <div class="form-group row">
                                    <div class="offset-sm-5 col-sm-7">
                                        <button id="buttonFour" type="submit" class="btn btn-success"><i
                                                class="fas fa-sync"></i>
                                            {{ __('update') }}</button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                @endif
            </div>

            {{-- Github Login Credential Setting --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title line-height-36">{{ __('github_login_credential') }}</h3>
                        <div class="form-group row">
                            <input {{ config('zakirsoft.github_active') ? 'checked' : '' }} type="checkbox" name="github"
                                data-bootstrap-switch value="1">
                        </div>
                    </div>
                </div>
                @if (config('zakirsoft.github_active'))
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('settings.social.login.update') }}" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" value="github" name="type">
                            <div class="form-group row">
                                <x-forms.label name="github_client_id" for="github_client_id" labelclass="col-sm-5" />
                                <div class="col-sm-7">
                                    <input
                                        onkeyup="ButtonDisabled('buttonFive', 'github_client_id' , '{{ config('zakirsoft.github_id') }}')"
                                        value="{{ config('zakirsoft.github_id') }}" name="github_client_id" type="text"
                                        class="form-control @error('github_client_id') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('github_client_id')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="github_client_secret" for="github_client_secret"
                                    labelclass="col-sm-5" />
                                <div class="col-sm-7">
                                    <input
                                        onkeyup="ButtonDisabled('buttonFive', 'github_client_secret' , '{{ config('zakirsoft.github_secret') }}')"
                                        value="{{ config('zakirsoft.github_secret') }}" name="github_client_secret"
                                        type="text"
                                        class="form-control @error('github_client_secret') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('github_client_secret')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            @if (userCan('setting.update'))
                                <div class="form-group row">
                                    <div class="offset-sm-5 col-sm-7">
                                        <button id="buttonFive" type="submit" class="btn btn-success"><i
                                                class="fas fa-sync"></i>
                                            {{ __('update') }}</button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                @endif
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
            let input = $(this).attr('name');
            let status = state ? 1 : 0;
            $("input[name=" + input + "]").val(status);

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('settings.social.login.status.update') }}",
                data: {
                    'type': input,
                    'status': status
                },
                success: function(response) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                }
            });
        });
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection
