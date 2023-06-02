@props([
    'countries' => $countries,
    'states' => $states,
    'cities' => $cities,
    'shippingaddress' => $shippingaddress,
])

<div class="form">
    <form action="{{ route('website.customer.shipping.address.update') }}" method="POST">
        @csrf
        <input type="hidden" name="shpping_type" value="shipping">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="form-label">{{ __('first_name') }} <span
                       class="text-danger">*</span></label>
                    <input name="shpping_first_name"
                        class="form-control @error('shpping_first_name') is-invalid border-danger @enderror" type="text"
                        value="{{ $shippingaddress ? $shippingaddress->first_name : '' }}">
                    @error('shpping_first_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="form-label">{{ __('last_name') }} <span
                       class="text-danger">*</span></label>
                    <input name="shpping_last_name"
                        class="form-control @error('shpping_last_name') is-invalid border-danger @enderror" type="text"
                        value="{{ $shippingaddress ? $shippingaddress->last_name : '' }}">
                    @error('shpping_last_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label">{{ __('company_name') }} <span class=" text-gray-600">(Optional)</span></label>
                    <input name="shpping_company_name"
                        class="form-control @error('shpping_company_name') is-invalid border-danger @enderror"
                        type="text" value="{{ $shippingaddress ? $shippingaddress->company_name : '' }}">
                    @error('shpping_company_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="address">{{ __('address') }} <span
                       class="text-danger">*</span></label>
                    <input name="shpping_address"
                        class="form-control @error('shpping_address') is-invalid border-danger @enderror" type="text"
                        value="{{ $shippingaddress ? $shippingaddress->address : '' }}">
                    @error('shpping_address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="address">{{ __('country') }} <span
                       class="text-danger">*</span></label>
                    <select name="shpping_country" id="shippingcountry"
                        class="select2-selector @error('country') is-invalid @enderror">
                        @foreach ($countries as $country)
                            <option
                                @if ($shippingaddress) {{ $shippingaddress->country_id == $country->id ? 'selected' : '' }} @endif
                                value="{{ $country->id }}" data-display="{{ $country->name }}">
                                {{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('shpping_country')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label">{{ __('state') }} <span
                       class="text-danger">*</span></label>
                    <select name="shpping_state" id="shippingstate"
                        class="select2-selector @error('state') is-invalid @enderror">
                        <option value="">{{ __('select_one') }}</option>
                        @foreach ($states as $state)
                            <option
                                @if ($shippingaddress) {{ $shippingaddress->state_id == $state->id ? 'selected' : '' }} @endif
                                value="{{ $state->id }}" data-display="{{ $state->name }}">{{ $state->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('shpping_state')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="form-label">{{ __('city') }} <span
                       class="text-danger">*</span></label>
                    <select name="shpping_city" id="shippingcity"
                        class="select2-selector @error('city') is-invalid @enderror">
                        <option value="">{{ __('select_one') }}</option>
                        @foreach ($cities as $city)
                            <option
                                @if ($shippingaddress) {{ $shippingaddress->city_id == $city->id ? 'selected' : '' }} @endif
                                value="{{ $city->id }}" data-display="{{ $city->name }}">{{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('shpping_city')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="form-label">{{ __('zip_code') }} <span
                       class="text-danger">*</span></label>
                    <input name="shpping_zip" type="text"
                        class="form-control @error('shpping_zip') is-invalid border-danger @enderror"
                        value="{{ $shippingaddress ? $shippingaddress->zip_code : '' }}">
                    @error('shpping_zip')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label">{{ __('email') }} <span
                       class="text-danger">*</span></label>
                    <input name="shpping_email" type="email"
                        class="form-control @error('shpping_email') is-invalid border-danger @enderror"
                        value="{{ $shippingaddress ? $shippingaddress->email : '' }}">
                    @error('shpping_email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label">{{ __('phone') }} <span
                       class="text-danger">*</span></label>
                    <input name="shpping_phone" type="text"
                        class="form-control @error('shpping_phone') is-invalid border-danger @enderror"
                        value="{{ $shippingaddress ? $shippingaddress->phone : '' }}">
                    @error('shpping_phone')
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
