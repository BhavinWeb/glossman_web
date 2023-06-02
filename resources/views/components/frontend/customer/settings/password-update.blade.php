<div class="form">
    <form action="{{ route('website.customer.password.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label">{{ __('current_password') }} <span
                            class="text-danger">*</span></label>
                    <div class="pass-box">
                        <div>
                            <input class="form-control @error('current_password') is-invalid border-danger @enderror"
                                name="current_password" id="password-hide_show6" type="password"
                                placeholder="{{ __('current_password') }}">
                            <div class="pass-box--eye select-icon__six mr-4">
                                <i class="far fa-eye"></i>
                            </div>
                        </div>
                    </div>
                    @error('current_password')
                        <span class="text-danger-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label">{{ __('new_password') }} <span
                            class="text-danger">*</span></label>
                    <div class="pass-box">
                        <div>
                            <input name="password"
                                class="form-control @error('password') is-invalid border-danger @enderror"
                                id="password-hide_show7" type="password" placeholder="{{ __('password') }}">
                            <div class="pass-box--eye select-icon__seven mr-4">
                                <i class="far fa-eye"></i>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <span class="text-danger-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label">{{ __('confirm_password') }} <span
                            class="text-danger">*</span></label>
                    <div class="pass-box">
                        <div class="d-flex">
                            <input name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid border-danger @enderror"
                                id="password-hide_show8" type="password" placeholder="{{ __('confirm_password') }}">
                            <div class="pass-box--eye select-icon__eight mr-4" @error('password')  @enderror>
                                <i class="far fa-eye"></i>
                            </div>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <span class="text-danger-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-button">
                    <button class="btn btn-primary" type="submit">{{ __('change_password') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
