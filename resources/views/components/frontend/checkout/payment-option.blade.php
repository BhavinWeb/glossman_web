@props(['manualPayments'])


<div class="check-out-body__form--payment-option">
    <div class="payment-option-block">
        <h6 class="title">{{ __('payment_option') }}</h6>
        <div class="card-body row">
            @if (config('paypal.active'))
            @php
                $mode = config('paypal.mode');
                $cliet_id = config('paypal.'.$mode.'.client_id');
                $cliet_secret = config('paypal.'.$mode.'.client_secret');
            @endphp
                @if ($cliet_id && $cliet_secret)
                    <div class="col-3 col-md-3">
                        <label class="aiz-megabox d-block mb-3">
                            <input value="paypal" class="payment-select" type="radio" name="payment_option" id="paypal_option">
                            <span class="d-block aiz-megabox-elem p-3">
                                <img src="{{ asset('frontend/image/payment/paypal.png') }}" class="img-fluid mb-2">
                                <span class="d-block text-center">
                                    <span class="d-block fw-600 fs-15">{{ __('paypal') }}</span>
                                </span>
                            </span>
                        </label>
                    </div>
                @endif
            @endif
            @if (config('zakirsoft.stripe_active') && config('zakirsoft.stripe_key') && config('zakirsoft.stripe_secret'))
            <div class="col-3 col-md-3">
                <label class="aiz-megabox d-block mb-3">
                    <input value="stripe" class="payment-select" type="radio" name="payment_option" id="stripe_option">
                    <span class="d-block aiz-megabox-elem p-3">
                        <img src="{{ asset('frontend/image/payment/stripe.png') }}" class="img-fluid mb-2">
                        <span class="d-block text-center">
                            <span class="d-block fw-600 fs-15">{{ __('stripe') }}</span>
                        </span>
                    </span>
                </label>
            </div>
            @endif
            @if (config('zakirsoft.razorpay_active') && config('zakirsoft.razorpay_key') && config('zakirsoft.razorpay_secret'))
            <div class="col-3 col-md-3">
                <label class="aiz-megabox d-block mb-3">
                    <input value="razorpay" class="payment-select" type="radio" name="payment_option"
                        id="razorpay_option">
                    <span class="d-block aiz-megabox-elem p-3">
                        <img src="{{ asset('frontend/image/payment/razorpay.png') }}" class="img-fluid mb-2">
                        <span class="d-block text-center">
                            <span class="d-block fw-600 fs-15">{{ __('razorpay') }}</span>
                        </span>
                    </span>
                </label>
            </div>
            @endif
            @if (config('zakirsoft.paystack_active') && config('zakirsoft.paystack_key') && config('zakirsoft.paystack_secret') && config('zakirsoft.paystack_merchant'))
            <div class="col-3 col-md-3">
                <label class="aiz-megabox d-block mb-3">
                    <input value="paystack" class="payment-select" type="radio" name="payment_option"
                        id="paystack_option">
                    <span class="d-block aiz-megabox-elem p-3">
                        <img src="{{ asset('frontend/image/payment/paystack.png') }}" class="img-fluid mb-2">
                        <span class="d-block text-center">
                            <span class="d-block fw-600 fs-15">{{ __('paystack') }}</span>
                        </span>
                    </span>
                </label>
            </div>
            @endif
            @if (config('zakirsoft.mollie_active') && config('zakirsoft.mollie_key'))
            <div class="col-3 col-md-3">
                <label class="aiz-megabox d-block mb-3">
                    <input value="mollie" class="payment-select" type="radio" name="payment_option" id="mollie_option">
                    <span class="d-block aiz-megabox-elem p-3">
                        <img src="{{ asset('frontend/image/payment/mollie.png') }}" class="img-fluid mb-2">
                        <span class="d-block text-center">
                            <span class="d-block fw-600 fs-15">{{ __('mollie') }}</span>
                        </span>
                    </span>
                </label>
            </div>
            @endif
            @if (config('zakirsoft.flw_active') && config('zakirsoft.flw_public_key') && config('zakirsoft.flw_secret') && config('zakirsoft.flw_secret_hash'))
            <div class="col-3 col-md-3">
                <label class="aiz-megabox d-block mb-3">
                    <input value="flutterwave" class="payment-select" type="radio" name="payment_option"
                        id="flutterwave_option">
                    <span class="d-block aiz-megabox-elem p-3">
                        <img src="{{ asset('frontend/image/payment/flutterwave.png') }}" class="img-fluid mb-2">
                        <span class="d-block text-center">
                            <span class="d-block fw-600 fs-15">{{ __('flutterwave') }}</span>
                        </span>
                    </span>
                </label>
            </div>
            @endif

            @foreach ($manualPayments as $manualPayment)
            <div class="col-3 col-md-3">
                <label class="aiz-megabox d-block mb-3">
                    <input value="{{ $manualPayment->name }}" class="payment-select" type="radio" name="payment_option"
                        id="cash_option">
                    <span class="d-block aiz-megabox-elem p-3">
                        <img src="{{ asset('frontend/image/payment/offline.jpg') }}" class="img-fluid mb-2">
                        <span class="d-block text-center">
                            <span class="d-block fw-600 fs-15">
                                {{ $manualPayment->name }}
                            </span>
                        </span>
                    </span>
                </label>
            </div>
            @endforeach

            <input type="text" name="payment_method" hidden>
            <input type="text" name="payment_type" hidden>

            <!-- Modal -->
            <div class="modal fade" id="manual_payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="manual_paymentLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="manual_paymentLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="manual_payment_description"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Done</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('frontend_styles')
<style>
    .aiz-megabox {
        position: relative;
        cursor: pointer;
    }

    .aiz-megabox input {
        position: absolute;
        z-index: -1;
        opacity: 0;
    }

    .aiz-megabox .aiz-megabox-elem {
        border: 1px solid #e2e5ec;
        border-radius: 0.25rem;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        border-radius: 0.25rem;
    }

    .aiz-megabox>input:checked~.aiz-megabox-elem,
    .aiz-megabox>input:checked~.aiz-megabox-elem {
        border-color: red;
    }
</style>
@endpush
