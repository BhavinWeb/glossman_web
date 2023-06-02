@props(['address', 'countries', 'billingstates', 'shippingstates', 'billingcities', 'shippingcities', 'billingaddress', 'shippingaddress', 'shippingmethods', 'pickuppoints', 'total'])

<div class="check-out-body__form--billing-info">
    <div class="billing-info-block mb-5">
        <h6 class="title mb-2">{{ __('shipping_method') }}</h6>
        <div class="row gx-3">
            <div class="col-sm-8 d-flex justify-content-between">
                <input type="hidden" name="shipping_method" value="">
                @foreach ($shippingmethods as $shippingmethod)
                    <div class="content">
                        <div class="form-check">
                            <label for="{{ $shippingmethod->shipping_type }}">{{ $shippingmethod->name }}</label>
                            <input
                                onclick="shippingMethodSelection({{ $shippingmethod }}, {{ $shippingmethod->amount }},{{ $total }})"
                                id="{{ $shippingmethod->shipping_type }}" class="form-check-input" type="radio"
                                name="shipping_method_select"
                                {{ old('shipping_method_select') == $shippingmethod->shipping_type ? 'checked' : '' }}
                                value="{{ $shippingmethod->shipping_type }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row mt-5 d-none" id="shipping_pickup_point">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="form-label">{{ __('pickup_point') }}</label>
                    <select name="pickup_point_id" id="" class="form-control">
                        @foreach ($pickuppoints as $pickpoint)
                            <option {{ old('pickup_point_id') == $pickpoint->id ? 'selected' : '' }}
                                value="{{ $pickpoint->id }}">{{ $pickpoint->name }} ==>
                                {{ $pickpoint->address }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    @if (!auth('user')->check())
        <div class="billing-info-block mb-5">
            <h6 class="title mb-2">{{ __('guest_information') }}</h6>
            <div class="billing-info-block__form">
                <div class="row gx-3">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <x-forms.label name="guest_email" labelclass="form-label">
                                <span>({{ __('it_will_help_you_to_track_your_order') }})</span>
                            </x-forms.label>
                            <input type="text" id="guest_email" class="form-control" value="{{ old('guest_email') ?? '' }}" name="guest_email" placeholder="{{ __('email_address') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="billing-info-block">
        <h6 class="title">{{ __('billing_information') }}</h6>
        <div class="billing-info-block__form">
            <div class="row gx-3">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="row gx-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-forms.label name="first_name" labelclass="form-label" />
                                    <input type="text" class="form-control" id="billing_first_name"
                                        placeholder="{{ __('first_name') }}"
                                        value="{{ $address->billingAddress->first_name ?? old('billing_first_name') }}"
                                        name="billing_first_name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-forms.label name="last_name" labelclass="form-label" />
                                    <input type="text" class="form-control" id="last-name"
                                        placeholder="{{ __('last_name') }}"
                                        value="{{ $address->billingAddress->last_name ?? old('billing_last_name') }}"
                                        name="billing_last_name">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-forms.label name="company_name" labelclass="form-label">
                            <span>({{ __('optional') }})</span>
                        </x-forms.label>
                        <input type="text" id="company-name" class="form-control"
                            value="{{ $address->billingAddress->company_name ?? old('billing_company_name') }}" name="billing_company_name">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <x-forms.label name="full_address_with_flat_apartment_number" labelclass="form-label" />
                        <input type="text" class="form-control"
                            value="{{ $address->billingAddress->address ?? old('billing_address') }}" name="billing_address">
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <x-forms.label name="country" labelclass="form-label" />
                                <select name="billing_country" id="billibgcountry"
                                    class="select2-selector {{ error('billing_country') }}">
                                    @foreach ($countries as $country)
                                        <option
                                            {{ $billingaddress && $billingaddress->country_id == $country->id ? 'selected' : '' }}
                                            value="{{ $country->id }}" data-display="{{ $country->name }}">
                                            {{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <x-forms.error name="billing_country" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <x-forms.label name="state" labelclass="form-label" :required="false" />
                                <select name="billing_state" id="billibgstate"
                                    class="select2-selector {{ error('billing_state') }}">
                                    <option value="">{{ __('select_one') }}</option>
                                    @foreach ($billingstates as $state)
                                        <option
                                            {{ $billingaddress && $billingaddress->state_id == $state->id ? 'selected' : '' }}
                                            value="{{ $state->id }}" data-display="{{ $state->name }}">
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-forms.error name="billing_state" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <x-forms.label name="city" labelclass="form-label" :required="false" />
                                <select name="billing_city" id="billibgcity"
                                    class="select2-selector {{ error('billing_city') }}">
                                    <option value="">{{ __('select_one') }}</option>
                                    @foreach ($billingcities as $city)
                                        <option
                                            {{ $billingaddress && $billingaddress->city_id == $city->id ? 'selected' : '' }}
                                            value="{{ $city->id }}" data-display="{{ $city->name }}">
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-forms.error name="billing_city" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <x-forms.label name="zip_code" labelclass="form-label" />
                                <input type="text" id="zipcode" class="form-control" name="billing_zip"
                                    value="{{ $address->billingAddress->zip_code ?? old('billing_zip') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <x-forms.label name="email" labelclass="form-label" />
                                <input type="text" id="email" class="form-control" name="billing_email"
                                    value="{{ $address->billingAddress->email ?? old('billing_email') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <x-forms.label name="phone_number" labelclass="form-label" />
                                <input type="text" id="phonenum" class="form-control" name="billing_phone"
                                    value="{{ $address->billingAddress->phone ?? old('billing_phone') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input type="hidden" name="is_same_address" value="0">
                        <input class="form-check-input" type="checkbox" name="is_same_address" value="1"
                            id="ship_checkbox">
                        <label class="form-check-label" for="ship_checkbox">
                            {{ __('ship_into_different_address') }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="row gx-3 mt-3 d-none" id="ship_info">
                <h6 class="title">{{ __('shipping_information') }}</h6>
                <div class="col-sm-6">
                    <div class="form-group">

                        <div class="row gx-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-forms.label name="first_name" labelclass="form-label" />
                                    <input type="text" class="form-control" id="first-name"
                                        placeholder="{{ __('first_name') }}"
                                        value="{{ $address->shippingAddress->first_name ?? old('shipping_first_name') }}"
                                        name="shipping_first_name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-forms.label name="last_name" labelclass="form-label" />
                                    <input type="text" class="form-control" id="last-name"
                                        placeholder="{{ __('last_name') }}"
                                        value="{{ $address->shippingAddress->last_name ?? old('shipping_last_name') }}"
                                        name="shipping_last_name">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <x-forms.label name="company_name" labelclass="form-label">
                            <span>({{ __('optional') }})</span>
                        </x-forms.label>
                        <input type="text" id="company-name" class="form-control"
                            value="{{ $address->shippingAddress->company_name ?? old('shipping_company_name') }}" name="shipping_company_name">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <x-forms.label name="full_address_with_flat_apartment_number" labelclass="form-label" />
                        <input type="text" class="form-control"
                            value="{{ $address->shippingAddress->address ?? old('shipping_address') }}" name="shipping_address">
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <x-forms.label name="country" labelclass="form-label" />
                                <select name="shipping_country" id="shippingcountry"
                                    class="select2-selector {{ error('shipping_country') }}">
                                    @foreach ($countries as $country)
                                        <option
                                            {{ $shippingaddress && $shippingaddress->country_id == $country->id ? 'selected' : '' }}
                                            value="{{ $country->id }}" data-display="{{ $country->name }}">
                                            {{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <x-forms.error name="shipping_country" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <x-forms.label name="state" labelclass="form-label" :required="false" />
                                <select name="shipping_state" id="shippingstate"
                                    class="select2-selector {{ error('shipping_state') }}">
                                    <option value="">{{ __('select_one') }}</option>
                                    @foreach ($shippingstates as $state)
                                        <option
                                            {{ $shippingaddress && $shippingaddress->state_id == $state->id ? 'selected' : '' }}
                                            value="{{ $state->id }}" data-display="{{ $state->name }}">
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-forms.error name="shipping_state" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <x-forms.label name="city" labelclass="form-label" :required="false" />
                                <select name="shipping_city" id="shippingcity"
                                    class="select2-selector {{ error('shipping_city') }}">
                                    <option value="">{{ __('select_one') }}</option>
                                    @foreach ($shippingcities as $city)
                                        <option
                                            {{ $shippingaddress && $shippingaddress->city_id == $city->id ? 'selected' : '' }}
                                            value="{{ $city->id }}" data-display="{{ $city->name }}">
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-forms.error name="shipping_city" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <x-forms.label name="zip_code" labelclass="form-label" />
                                <input type="text" id="zipcode" class="form-control" name="shipping_zip"
                                    value="{{ $address->shippingAddress->zip_code ?? old('shipping_zip') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <x-forms.label name="email" labelclass="form-label" />
                                <input type="text" id="email" class="form-control" name="shipping_email"
                                    value="{{ $address->shippingAddress->email ?? old('shipping_email') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <x-forms.label name="phone_number" labelclass="form-label" />
                                <input type="text" id="phonenum" class="form-control" name="shipping_phone"
                                    value="{{ $address->shippingAddress->phone ?? old('shipping_phone') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
