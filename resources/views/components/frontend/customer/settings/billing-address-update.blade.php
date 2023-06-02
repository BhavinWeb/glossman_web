@props([
    'countries' => $countries,
    'states' => $states,
    'cities' => $cities,
    'billingaddress' => $billingaddress,
])

<div class="form">
    <form action="{{ route('website.customer.billing.address.update') }}" method="POST">
        @csrf
        <input type="hidden" name="billing_type" value="billing">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="form-label">{{ __('first_name') }} <span class="text-danger">*</span></label>
                    <input name="billing_first_name"
                        class="form-control @error('billing_first_name') is-invalid border-danger @enderror" type="text"
                        value="{{ $billingaddress ? $billingaddress->first_name : '' }}">
                    @error('billing_first_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="form-label">{{ __('last_name') }} <span class="text-danger">*</span></label>
                    <input name="billing_last_name"
                        class="form-control @error('billing_last_name') is-invalid border-danger @enderror" type="text"
                        value="{{ $billingaddress ? $billingaddress->last_name : '' }}">
                    @error('billing_last_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label">{{ __('company_name') }} <span
                            class=" text-gray-600">({{ __('optional') }})</span></label>
                    <input name="billing_company_name"
                        class="form-control @error('billing_company_name') is-invalid border-danger @enderror"
                        type="text" value="{{ $billingaddress ? $billingaddress->company_name : '' }}">
                    @error('billing_company_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="address">{{ __('address') }} <span
                            class="text-danger">*</span></label>
                    <input name="billing_address" id="address"
                        class="form-control @error('billing_address') is-invalid border-danger @enderror" type="text"
                        value="{{ $billingaddress ? $billingaddress->address : '' }}">
                    @error('billing_address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="address">{{ __('country') }} <span
                            class="text-danger">*</span></label>
                    <select name="billing_country" id="billibgcountry"
                        class="select2-selector @error('billing_country') is-invalid @enderror form-select">
                        @foreach ($countries as $country)
                            <option
                                @if ($billingaddress) {{ $billingaddress->country_id == $country->id ? 'selected' : '' }} @endif
                                value="{{ $country->id }}" data-display="{{ $country->name }}">
                                {{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('billing_country')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label">{{ __('state') }} <span class="text-danger">*</span></label>
                    <select name="billing_state" id="billibgstate"
                        class="select2-selector @error('billing_state') is-invalid @enderror w-100-p">
                        <option value="">{{ __('select_one') }}</option>
                        @foreach ($states as $state)
                            <option
                                @if ($billingaddress) {{ $billingaddress->state_id == $state->id ? 'selected' : '' }} @endif
                                value="{{ $state->id }}" data-display="{{ $state->name }}">{{ $state->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('billing_state')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="form-label">{{ __('city') }} <span class="text-danger">*</span></label>
                    <select name="billing_city" id="billibgcity"
                        class="select2-selector @error('billing_city') is-invalid @enderror">
                        <option value="">{{ __('select_one') }}</option>
                        @foreach ($cities as $city)
                            <option
                                @if ($billingaddress) {{ $billingaddress->city_id == $city->id ? 'selected' : '' }} @endif
                                value="{{ $city->id }}" data-display="{{ $city->name }}">{{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('billing_city')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="form-label">{{ __('zip_code') }} <span class="text-danger">*</span></label>
                    <input name="billing_zip" type="text"
                        class="form-control @error('billing_zip') is-invalid border-danger @enderror"
                        value="{{ $billingaddress ? $billingaddress->zip_code : '' }}">
                    @error('billing_zip')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label">{{ __('email') }} <span class="text-danger">*</span></label>
                    <input name="billing_email" type="email"
                        class="form-control @error('billing_email') is-invalid border-danger @enderror"
                        value="{{ $billingaddress ? $billingaddress->email : '' }}">
                    @error('billing_email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label">{{ __('phone') }} <span class="text-danger">*</span></label>
                    <input name="billing_phone" type="text"
                        class="form-control @error('billing_phone') is-invalid border-danger @enderror"
                        value="{{ $billingaddress ? $billingaddress->phone : '' }}">
                    @error('billing_phone')
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
