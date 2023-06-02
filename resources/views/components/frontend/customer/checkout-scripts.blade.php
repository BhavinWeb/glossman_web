<script>
    // Billing shipping
    function shippingMethodSelection(shipping, amount, total) {
        var total_amount = parseInt(total) + parseInt(amount)

        axios.get(`api/currency/position/${total_amount}`).then((response => {
            $('.total-ammount').html(response.data);
        }))

        axios.get(`api/currency/position/shipping/${amount}`).then((response => {
            $('#checkout_shipping_amount').html(response.data);
        }))

        if (shipping.shipping_type == 'local_pickup') {
            $('#shipping_pickup_point').removeClass('d-none');
        } else {
            $('#shipping_pickup_point').addClass('d-none');
        }

        $('input[name=shipping_method]').val(shipping.shipping_type);
        $('#checkout_shipping_type').html(shipping.name);
        $('#checkout_shipping_method').removeClass('d-none');
        $('.order_pay_amount').val(total_amount);
        $('#stripe_pay_amount').val(total_amount * 100);
        $('#razorpay_pay_amount').val(total_amount * 100);
        $("#stripe_script").attr('data-amount', total_amount * 100);
        $("#razor_script").attr('data-amount', total_amount * 100);

    }

    $('#ship_checkbox').on('click', function() {
        if ($(this).is(":checked")) {
            $('#is_same_address').val(0)
            $('#ship_info').removeClass('d-none')
        } else if ($(this).is(":not(:checked)")) {
            $('#is_same_address').val(1)
            $('#ship_info').addClass('d-none')
        }
    });


    // Payment
    $('.payment-select').on('click', function() {
        $('#order-checkout-buttons').removeClass('d-none');
        $('#order-processing-button').addClass('d-none');

        switch ($(this).val()) {
            case 'paypal':
                $('input[name=payment_method]').val('paypal')
                $('input[name=payment_type]').val('online')
                break;
            case 'stripe':
                $('input[name=payment_method]').val('stripe')
                $('input[name=payment_type]').val('online')
                break;
            case 'razorpay':
                $('input[name=payment_method]').val('razorpay')
                $('input[name=payment_type]').val('online')
                break;
            case 'paystack':
                $('input[name=payment_method]').val('paystack')
                $('input[name=payment_type]').val('online')
                break;
            case 'mollie':
                $('input[name=payment_method]').val('mollie')
                $('input[name=payment_type]').val('online')
                break;
            case 'flutterwave':
                $('input[name=payment_method]').val('flutterwave')
                $('input[name=payment_type]').val('online')
                break;
            case 'midtrans':
                $('input[name=payment_method]').val('midtrans')
                $('input[name=payment_type]').val('online')
                break;
            case 'sslcommerz':
                $('input[name=payment_method]').val('sslcommerz')
                $('input[name=payment_type]').val('online')
                break;
            default:
                $('#manual_payment').modal('show');
                axios.get("{{ route('manual.payment.details') }}", {
                    params: {
                        name: $(this).val(),
                    }
                }).then((res => {
                    $('#manual_paymentLabel').html(res.data.name);
                    $('#manual_payment_description').html(res.data.description);
                })).catch((err => {
                    toastr.error('Something went wrong', 'Error');
                }));

                $('input[name=payment_method]').val($(this).val())
                $('input[name=payment_type]').val('offline')
                break;
        }

        if ($('input[name=payment_type]').val() == 'offline') {
            $('#checkout-button-cashon').removeClass('d-none');
            $('#checkout-button').hide();
        } else {
            $('#checkout-button-cashon').addClass('d-none');
            $('#checkout-button').show();
        }
    });

    $('#checkout-button').on('click', function(e) {
        $('#order-checkout-buttons').addClass('d-none');
        $('#order-processing-button').removeClass('d-none');

        e.preventDefault()

        axios.post("{{ route('website.checkout') }}", {
            _token: '{{ csrf_token() }}',
            guest_email: $('input[name=guest_email]').val(),
            billing_first_name: $('input[name=billing_first_name]').val(),
            billing_last_name: $('input[name=billing_last_name]').val(),
            billing_company_name: $('input[name=billing_company_name]').val(),
            billing_address: $('input[name=billing_address]').val(),
            billing_country: $('select[name=billing_country]').val(),
            billing_state: $('select[name=billing_state]').val(),
            billing_city: $('select[name=billing_city]').val(),
            billing_zip: $('input[name=billing_zip]').val(),
            billing_email: $('input[name=billing_email]').val(),
            billing_phone: $('input[name=billing_phone]').val(),
            shipping_first_name: $('input[name=shipping_first_name]').val(),
            shipping_last_name: $('input[name=shipping_last_name]').val(),
            shipping_company_name: $('input[name=shipping_company_name]').val(),
            shipping_address: $('input[name=shipping_address]').val(),
            shipping_country: $('select[name=shipping_country]').val(),
            shipping_state: $('select[name=shipping_state]').val(),
            shipping_city: $('select[name=shipping_city]').val(),
            shipping_zip: $('input[name=shipping_zip]').val(),
            shipping_email: $('input[name=shipping_email]').val(),
            shipping_phone: $('input[name=shipping_phone]').val(),
            is_same_address: $('#ship_checkbox').prop('checked') ? 0 : 1,
            payment_method: $('input[name=payment_method]').val(),
            payment_type: $('input[name=payment_type]').val(),
            notes: $('textarea[name=notes]').val(),
            shipping_method: $('input[name=shipping_method]').val(),
            pickup_point_id: $('select[name=pickup_point_id]').val(),
        }).then((res => {
            if (res.status == 200) {
                $('.print-error-msg').addClass('d-none');
                processToPayment()
            }
        })).catch((err => {
            toastr.error(err.response.data.message, 'Error');
            $('#order-checkout-buttons').removeClass('d-none');
            $('#order-processing-button').addClass('d-none');
            printErrorMsg(err.response.data.errors)
        }));
    });

    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").removeClass('d-none');
        $.each(msg, function(key, value) {
            $(".print-error-msg").find("ul").append('<li class="text-danger">' + value + '</li>');
        });
    }

    $('#checkout-button-cashon').on('click', function() {
        $('#order-checkout-buttons').addClass('d-none');
        $('#order-processing-button').removeClass('d-none');
    });
</script>

<script>
    function processToPayment() {
        switch ($('input[name=payment_method]').val()) {
            case 'paypal':
                document.getElementById("paypal-form").submit();
                break;
            case 'stripe':
                document.querySelector('.stripe-button-el').click();
                break;
            case 'razorpay':
                document.querySelector(".razorpay-payment-button").click();
                break;
            case 'paystack':
                document.getElementById("paystack-form").submit();
                break;
            case 'mollie':
                document.getElementById("mollie-form").submit();
                break;
            case 'flutterwave':
                document.getElementById("flutter-form").submit();
                break;
            case 'midtrans':
                document.getElementById("sslczPayBtn").click();
                break;
            default:
                $('#checkout-form').submit();
                break;
        }
    }
</script>
