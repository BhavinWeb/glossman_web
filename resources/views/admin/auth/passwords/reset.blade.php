@extends('admin.layouts.auth')
@section('content')
    <h3 class="mb-3">
        {{ __('reset_password') }}
    </h3>

    <form method="POST" action="{{ route('admin.password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group row">
            <x-forms.label name="email_address" for="password" labelclass="col-md-4 text-md-right" />
            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <x-forms.label name="password" for="password" labelclass="col-md-4 text-md-right" />
            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <x-forms.label name="confirm_password" for="password-confirm" labelclass="col-md-4 text-md-right" />
            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 d-block">
            {{ __('reset_password') }}
        </button>

    </form>
@endsection
