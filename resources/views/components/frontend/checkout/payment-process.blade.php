@props(['total'])
<input type="hidden" name="amount" value="{{ $total }}" class="order-pay-amount">
{{-- Paypal Form --}}
<form action="{{ route('paypal.post') }}" method="POST" class="d-none" id="paypal-form">
    @csrf
    <input type="hidden" name="amount" value="{{ $total }}" class="order_pay_amount">
</form>

{{-- Stripe Form --}}
<form action="{{ route('stripe.post') }}" method="POST" class="d-none">
    @csrf
    <input type="hidden" name="amount" value="{{ $total * 100 }}" id="stripe_pay_amount">

    <script id="stripe_script" src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="{{ env('STRIPE_KEY') }}" data-amount="{{ $total * 100 }}" data-name="{{ env('APP_NAME') }}"
        data-description="{{ __('money_pay_with_stripe') }}" data-locale="en" data-currency="{{ env('APP_CURRENCY') }}">
    </script>
</form>

{{-- Razorpay Form --}}
<form action="{{ route('razorpay.post') }}" method="POST" class="d-none">
    @csrf
    <input type="hidden" name="amount" value="{{ $total * 100 }}" id="razorpay_pay_amount">

    <script id="razor_script" src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}"
        data-amount="{{ $total * 100 }}" data-buttontext="Pay with Razorpay" data-name="{{ env('APP_NAME') }}"
        data-description="{{ __('money_pay_with_razorpay') }}" data-prefill.name="{{ auth('user')->check() ? auth('user')->user()->name:'guest' }}"
        data-prefill.email="{{ auth('user')->check() ? auth('user')->user()->email:'guest@mail.com' }}" data-theme.color="#2980b9"
        data-currency="{{ env('APP_CURRENCY') }}"></script>
</form>

{{-- paystack_btn Form --}}
<form action="{{ route('paystack.post') }}" method="POST" class="d-none" id="paystack-form">
    @csrf
    <input type="hidden" name="amount" value="{{ $total }}" class="order_pay_amount">
</form>

{{-- mollie Form --}}
<form action="{{ route('mollie.payment') }}" method="POST" class="d-none" id="mollie-form">
    @csrf
    <input type="hidden" name="amount" value="{{ $total }}" class="order_pay_amount">
</form>

{{-- flutterwave Form --}}
<form action="{{ route('flutterwave.pay') }}" method="POST" class="d-none" id="flutter-form">
    @csrf
    <input type="hidden" name="amount" value="{{ $total }}" class="order_pay_amount">
</form>
