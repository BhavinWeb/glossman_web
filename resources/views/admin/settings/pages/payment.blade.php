@extends('admin.settings.setting-layout')
@section('title')
    {{ __('payment_gateway_setting') }}
@endsection

@section('website-settings')

    <div class="row">
        <div class="col-sm-6">
            {{-- paypal settings --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title line-height-36">{{ __('paypal_settings') }}</h3>
                        <div class="form-group row">
                            <input {{ config('paypal.active') ? 'checked' : '' }} type="checkbox" name="paypal"
                                data-bootstrap-switch value="1">
                        </div>
                    </div>
                </div>
                @if (config('paypal.active'))
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('settings.payment.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" value="paypal" name="type">
                            <div class="form-group row">
                                <x-forms.label name="live_mode" labelclass="col-sm-3" />
                                <div class="col-sm-9">
                                    <input id="paylive" {{ config('paypal.mode') == 'live' ? 'checked' : '' }}
                                        type="checkbox" name="paypal_live_mode" button="button1"
                                        oldvalue="{{ config('paypal.mode') }}" data-bootstrap-switch value="1">
                                </div>
                            </div>
                            @if (config('paypal.mode') == 'sandbox')
                                <div class="form-group row">
                                    <x-forms.label name="client_id" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input
                                            onkeyup="ButtonDisabled('button1', 'paypal_client_id' , '{{ config('paypal.sandbox.client_id') }}')"
                                            value="{{ config('paypal.sandbox.client_id') }}" name="paypal_client_id"
                                            type="text"
                                            class="form-control @error('paypal_client_id') is-invalid @enderror"
                                            autocomplete="off">
                                        @error('paypal_client_id')
                                            <span class="invalid-feedback"
                                                role="alert"><span>{{ $message }}</span></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="client_secret" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input
                                            onkeyup="ButtonDisabled('button1', 'paypal_client_secret' , '{{ config('paypal.sandbox.client_secret') }}')"
                                            value="{{ config('paypal.sandbox.client_secret') }}"
                                            name="paypal_client_secret" type="text"
                                            class="form-control @error('paypal_client_secret') is-invalid @enderror"
                                            autocomplete="off">
                                        @error('paypal_client_secret')
                                            <span class="invalid-feedback"
                                                role="alert"><span>{{ $message }}</span></span>
                                        @enderror
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <x-forms.label name="client_id" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input
                                            onkeyup="ButtonDisabled('button1', 'paypal_client_id' , '{{ config('paypal.live.client_id') }}')"
                                            value="{{ config('paypal.live.client_id') }}" name="paypal_client_id"
                                            type="text"
                                            class="form-control @error('paypal_client_id') is-invalid @enderror"
                                            autocomplete="off">
                                        @error('paypal_client_id')
                                            <span class="invalid-feedback"
                                                role="alert"><span>{{ $message }}</span></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="client_secret" labelclass="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input
                                            onkeyup="ButtonDisabled('button1', 'paypal_client_secret' , '{{ config('paypal.sandbox.client_secret') }}')"
                                            value="{{ config('paypal.sandbox.client_secret') }}"
                                            name="paypal_client_secret" type="text"
                                            class="form-control @error('paypal_client_secret') is-invalid @enderror"
                                            autocomplete="off">
                                        @error('paypal_client_secret')
                                            <span class="invalid-feedback"
                                                role="alert"><span>{{ $message }}</span></span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if (userCan('setting.update'))
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button id="button1" type="submit" class="btn btn-success"><i
                                                class="fas fa-sync"></i>
                                            {{ __('update') }}</button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                @endif
            </div>

            {{-- Flutterwave Setting --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title line-height-36">{{ __('flutterwave_settings') }}</h3>
                        <div class="form-group row">
                            <input {{ config('zakirsoft.flw_active') ? 'checked' : '' }} type="checkbox" name="flutterwave"
                                data-bootstrap-switch value="1">
                        </div>
                    </div>
                </div>
                @if (config('zakirsoft.flw_active'))
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('settings.payment.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" value="flutterwave" name="type">

                            <div class="form-group row">
                                <x-forms.label name="public_key" labelclass="col-sm-3" />
                                <div class="col-sm-9">
                                    <input
                                        onkeyup="ButtonDisabled('button6', 'flw_public_key' , '{{ config('zakirsoft.flw_public_key') }}')"
                                        value="{{ config('zakirsoft.flw_public_key') }}" name="flw_public_key"
                                        type="text" class="form-control @error('flw_public_key') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('flw_public_key')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="secret_key" labelclass="col-sm-3" />
                                <div class="col-sm-9">
                                    <input
                                        onkeyup="ButtonDisabled('button6', 'flw_secret_key' , '{{ config('zakirsoft.flw_secret') }}')"
                                        value="{{ config('zakirsoft.flw_secret') }}" name="flw_secret_key"
                                        type="text" class="form-control @error('flw_secret_key') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('flw_secret_key')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="secret_hash" labelclass="col-sm-3" />
                                <div class="col-sm-9">
                                    <input
                                        onkeyup="ButtonDisabled('button6', 'flw_secret_hash' , '{{ config('zakirsoft.flw_secret_hash') }}')"
                                        value="{{ config('zakirsoft.flw_secret_hash') }}" name="flw_secret_hash"
                                        type="text" class="form-control @error('flw_secret_hash') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('flw_secret_hash')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            @if (userCan('setting.update'))
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button id="button6" type="submit" class="btn btn-success"><i
                                                class="fas fa-sync"></i>
                                            {{ __('update') }}</button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                @endif

            </div>

            {{-- Mollie Setting --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title line-height-36">{{ __('mollie_setting') }}</h3>
                        <div class="form-group row">
                            <input {{ config('zakirsoft.mollie_active') ? 'checked' : '' }} type="checkbox"
                                name="mollie" data-bootstrap-switch value="1">
                        </div>
                    </div>
                </div>
                @if (config('zakirsoft.mollie_active'))
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('settings.payment.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" value="mollie" name="type">

                            <div class="form-group row">
                                <x-forms.label name="mollie_key" labelclass="col-sm-3" />
                                <div class="col-sm-9">
                                    <input
                                        onkeyup="ButtonDisabled('button8', 'mollie_key' , '{{ config('zakirsoft.mollie_key') }}')"
                                        value="{{ config('zakirsoft.mollie_key') }}" name="mollie_key" type="text"
                                        class="form-control @error('mollie_key') is-invalid @enderror" autocomplete="off">
                                    @error('mollie_key')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            @if (userCan('setting.update'))
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button id="button8" type="submit" class="btn btn-success"><i
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
            {{-- Stripe Setting --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title line-height-36">{{ __('stripe_settings') }}</h3>
                        <div class="form-group row">
                            <input {{ config('zakirsoft.stripe_active') ? 'checked' : '' }} type="checkbox"
                                name="stripe" data-bootstrap-switch value="1">
                        </div>
                    </div>
                </div>
                @if (config('zakirsoft.stripe_active'))
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('settings.payment.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" value="stripe" name="type">
                            <div class="form-group row">
                                <x-forms.label name="secret_key" labelclass="col-sm-3" />
                                <div class="col-sm-9">
                                    <input
                                        onkeyup="ButtonDisabled('button3', 'stripe_key' , '{{ config('zakirsoft.stripe_key') }}')"
                                        value="{{ config('zakirsoft.stripe_key') }}" name="stripe_key" type="text"
                                        class="form-control @error('stripe_key') is-invalid @enderror" autocomplete="off">
                                    @error('stripe_key')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="publisher_key" labelclass="col-sm-3" />
                                <div class="col-sm-9">
                                    <input
                                        onkeyup="ButtonDisabled('button3', 'stripe_secret' , '{{ config('zakirsoft.stripe_secret') }}')"
                                        value="{{ config('zakirsoft.stripe_secret') }}" name="stripe_secret"
                                        type="text" class="form-control @error('stripe_secret') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('stripe_secret')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            @if (userCan('setting.update'))
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button id="button3" type="submit" class="btn btn-success"><i
                                                class="fas fa-sync"></i>
                                            {{ __('update') }}</button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                @endif
            </div>

            {{-- Razorpay Setting --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title line-height-36">{{ __('razorpay_settings') }}</h3>
                        <div class="form-group row">
                            <input {{ config('zakirsoft.razorpay_active') ? 'checked' : '' }} type="checkbox"
                                name="razorpay" data-bootstrap-switch value="1">
                        </div>
                    </div>
                </div>
                @if (config('zakirsoft.razorpay_active'))
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('settings.payment.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" value="razorpay" name="type">
                            <div class="form-group row">
                                <x-forms.label name="secret_key" labelclass="col-sm-3" />
                                <div class="col-sm-9">
                                    <input
                                        onkeyup="ButtonDisabled('button4', 'razorpay_key' , '{{ config('zakirsoft.razorpay_key') }}')"
                                        value="{{ config('zakirsoft.razorpay_key') }}" name="razorpay_key"
                                        type="text" class="form-control @error('razorpay_key') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('razorpay_key')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="publisher_key" labelclass="col-sm-3" />
                                <div class="col-sm-9">
                                    <input
                                        onkeyup="ButtonDisabled('button4', 'razorpay_secret' , '{{ config('zakirsoft.razorpay_secret') }}')"
                                        value="{{ config('zakirsoft.razorpay_secret') }}" name="razorpay_secret"
                                        type="text"
                                        class="form-control @error('razorpay_secret') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('razorpay_secret')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            @if (userCan('setting.update'))
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button id="button4" type="submit" class="btn btn-success"><i
                                                class="fas fa-sync"></i>
                                            {{ __('update') }}</button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                @endif
            </div>

            {{-- Paystack Setting --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title line-height-36">{{ __('paystack_settings') }}</h3>
                        <div class="form-group row">
                            <input {{ config('zakirsoft.paystack_active') ? 'checked' : '' }} type="checkbox"
                                name="paystack" data-bootstrap-switch value="1">
                        </div>
                    </div>
                </div>
                @if (config('zakirsoft.paystack_active'))
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('settings.payment.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" value="paystack" name="type">
                            <div class="form-group row">
                                <x-forms.label name="client_id" labelclass="col-sm-3" />
                                <div class="col-sm-9">
                                    <input
                                        onkeyup="ButtonDisabled('button5', 'paystack_public_key' , '{{ config('zakirsoft.paystack_key') }}')"
                                        value="{{ config('zakirsoft.paystack_key') }}" name="paystack_public_key"
                                        type="text"
                                        class="form-control @error('paystack_public_key') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('paystack_public_key')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="client_secret" labelclass="col-sm-3" />
                                <div class="col-sm-9">
                                    <input
                                        onkeyup="ButtonDisabled('button5', 'paystack_secret_key' , '{{ config('zakirsoft.paystack_secret') }}')"
                                        value="{{ config('zakirsoft.paystack_secret') }}" name="paystack_secret_key"
                                        type="text"
                                        class="form-control @error('paystack_secret_key') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('paystack_secret_key')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="merchant_email" labelclass="col-sm-3" />
                                <div class="col-sm-9">
                                    <input
                                        onkeyup="ButtonDisabled('button5', 'merchant_email' , '{{ config('zakirsoft.paystack_merchant') }}')"
                                        value="{{ config('zakirsoft.paystack_merchant') }}" name="merchant_email"
                                        type="text" class="form-control @error('merchant_email') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('merchant_email')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            @if (userCan('setting.update'))
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button id="button5" type="submit" class="btn btn-success"><i
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

        $('#button1').prop('disabled', true);
        $('#button2').prop('disabled', true);
        $('#button3').prop('disabled', true);
        $('#button4').prop('disabled', true);
        $('#button5').prop('disabled', true);
        $('#button6').prop('disabled', true);
        $('#button7').prop('disabled', true);
        $('#button8').prop('disabled', true);

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
            if (input !== 'cash_on_delivery') {
                if (input != 'paypal_live_mode' && input != 'ssl_live_mode') {
                    let status = state ? 1 : 0;
                    $("input[name=" + input + "]").val(status);
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('settings.payment.status.update') }}",
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
                }
            }
        });

        $("#paylive").on('switchChange.bootstrapSwitch', function(event, state) {

            let oldData = event.target.attributes.oldvalue.value;
            let newData = event.currentTarget.checked ? 'live' : 'sandbox';
            let button = event.target.attributes.button.value;

            if (oldData == newData) {
                $('#' + button).prop('disabled', true);
            } else {
                $('#' + button).prop('disabled', false);
            }
        });
        $("#ssl_live").on('switchChange.bootstrapSwitch', function(event, state) {
            let oldData = event.target.attributes.oldvalue.value;
            let newData = event.currentTarget.checked ? 'live' : 'sandbox';
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
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection
