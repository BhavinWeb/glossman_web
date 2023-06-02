@props([
    'countries' => $countries,
    'states' => $states,
    'cities' => $cities,
])

<div class="account-setting__main">
    <div class="avatar">
        <img id="profile" onclick="document.getElementById('customFile').click()"
            src="{{ auth()->user()->image_url }}" alt="avatar" class="w-100 cursor-pointer border-r-100">
        @error('profile')
            <span class="text-sm text-danger-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="form w-100">
        <form action="{{ route('website.customer.setting.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="d-none">
                <input name="profile" autocomplete="profile"
                    onchange="document.getElementById('profile').src = window.URL.createObjectURL(this.files[0])"
                    type="file" class=" @error('profile') is-invalid  border-danger @enderror" id="customFile">
            </div>
            <div class="row gx-3">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">{{ __('first_name') }} <span
                                class="text-danger">*</span></label>
                        <input name="firstname" placeholder="{{ __('first_name') }}"
                            class="form-control @error('firstname') is-invalid  border-danger @enderror" type="text"
                            value="{{ auth()->user()->first_name }}">
                        @error('firstname')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">{{ __('last_name') }} <span
                                class="text-danger">*</span></label>
                        <input name="lastname" placeholder="{{ __('last_name') }}"
                            class="form-control @error('lastname') is-invalid  border-danger @enderror" type="text"
                            value="{{ auth()->user()->last_name }}">
                        @error('lastname')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label" for="email">{{ __('email') }} <span
                                class="text-danger">*</span></label>
                        <input id="email" name="email" placeholder="{{ __('email') }}"
                            class="form-control @error('email') is-invalid  border-danger @enderror" type="text"
                            value="{{ auth()->user()->email }}">
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class=" form-label" for="emailtwo">
                            {{ __('secondary_email') }}</label>
                        <input name="secondaryemail" placeholder="{{ __('secondary_email') }}" id="emailtwo"
                            class="form-control @error('secondaryemail') is-invalid  border-danger @enderror"
                            type="text" value="{{ auth()->user()->secondary_email }}">
                        @error('secondaryemail')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label" for="phoneNum">{{ __('phone_number') }}</label>
                        <input name="phone" id="phoneNum" placeholder="{{ __('phone_number') }}"
                            class="form-control @error('phone') is-invalid  border-danger @enderror" type="text"
                            value="{{ auth()->user()->phone }}">
                        @error('phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">{{ __('country') }} <span
                                class="text-danger">*</span></label>
                        <select name="country" id="country"
                            class="select2-selector form-control @error('country') is-invalid  border-danger @enderror">
                            <option value="">{{ __('select_country') }}</option>
                            @foreach ($countries as $country)
                                <option {{ auth()->user()->country_id == $country->id ? 'selected' : '' }}
                                    value="{{ $country->id }}" data-display="{{ $country->name }}">
                                    {{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label mb-0 pb-0">{{ __('state') }}</label>
                        <select name="state" id="state"
                            class="select2-selector @error('state') is-invalid  border-danger @enderror">
                            <option value="">{{ __('select_one') }}</option>
                            @foreach ($states as $state)
                                <option {{ auth()->user()->state_id == $state->id ? 'selected' : '' }}
                                    value="{{ $state->id }}" data-display="{{ $state->name }}">
                                    {{ $state->name }}</option>
                            @endforeach
                        </select>
                        @error('state')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label mb-0 pb-0">{{ __('city') }}</label>
                        <select name="city" id="city"
                            class="select2-selector @error('city') is-invalid  border-danger @enderror">
                            <option value="">{{ __('select_one') }}</option>
                            @foreach ($cities as $city)
                                <option {{ auth()->user()->city_id == $city->id ? 'selected' : '' }}
                                    value="{{ $city->id }}" data-display="{{ $city->name }}">
                                    {{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">{{ __('zip_code') }}</label>
                        <input name="zip" placeholder="{{ __('zip_code') }}"
                            class="form-control @error('zip') is-invalid border-danger @enderror" type="text"
                            value="{{ auth()->user()->zip_code }}">
                        @error('zip')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-button">
                        <button class="btn btn-primary" type="submit">{{ __('save_changes') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
