    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $('.select2-selector').select2({
            theme: 'bootstrap4',
            width: '100%'
        });
        
        // states
        $(document).ready(function() {
            $('#country').on('change', function() {
                var idCountry = this.value;
                Profile(idCountry);
            });
        });

        function Profile(idCountry) {
            $.ajax({
                url: "{{ route('website.customer.states') }}",
                type: "POST",
                data: {
                    country_id: idCountry,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(states) {

                    $("#state").empty();
                    if (states.length > 0) {
                        $.each(states, function(key, value) {
                            $("#state").append(
                                `<option value="${ value.id }">${ value.name }</option>`);
                        });
                    } else {
                        $('#state').append(`<option value="">No State Available !</option>`);
                    }

                }
            });
        }
        // cities
        $(document).ready(function() {
            $('#state').on('change', function() {
                var idState = $(this).val();
                ProfileCity(idState);
            });
        });

        function ProfileCity(idState) {
            $.ajax({
                url: "{{ route('website.customer.cities') }}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(cities) {

                    $("#city").empty();
                    if (cities.length > 0) {
                        $.each(cities, function(key, value) {
                            $("#city").append(`<option value="${ value.id }">${ value.name }</option>`);
                        });
                    } else {
                        $('#city').append(`<option value="">No City Available !</option>`);
                    }
                }
            });
        }
    </script>
    <script>
        // states
        $(document).ready(function() {
            $('#billibgcountry').on('change', function() {
                var billibg = this.value;
                BillingState(billibg);
            });
        });

        function BillingState(billibg) {
            $.ajax({
                url: "{{ route('website.customer.states') }}",
                type: "POST",
                data: {
                    country_id: billibg,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(states) {

                    $("#billibgstate").empty();
                    if (states.length > 0) {
                        $.each(states, function(key, value) {
                            $("#billibgstate").append(
                                `<option value="${ value.id }">${ value.name }</option>`);
                        });
                    } else {
                        $('#billibgstate').append(`<option value="">No State Available !</option>`);
                    }

                }
            });
        }
        // cities
        $(document).ready(function() {
            $('#billibgstate').on('change', function() {
                var billibg = this.value;
                BillingCity(billibg);
            });
        });

        function BillingCity(billibg) {
            $.ajax({
                url: "{{ route('website.customer.cities') }}",
                type: "POST",
                data: {
                    state_id: billibg,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(cities) {

                    $("#billibgcity").empty();
                    if (cities.length > 0) {
                        $.each(cities, function(key, value) {
                            $("#billibgcity").append(
                                `<option value="${ value.id }">${ value.name }</option>`);
                        });
                    } else {
                        $('#billibgcity').append(`<option value="">No City Available !</option>`);
                    }
                }
            });
        }
    </script>
    <script>
        // states
        $(document).ready(function() {
            $('#shippingcountry').on('change', function() {
                var shipping = this.value;
                ShippingState(shipping);
            });
        });

        function ShippingState(shipping) {
            $.ajax({
                url: "{{ route('website.customer.states') }}",
                type: "POST",
                data: {
                    country_id: shipping,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(states) {

                    $("#shippingstate").empty();
                    if (states.length > 0) {
                        $.each(states, function(key, value) {
                            $("#shippingstate").append(
                                `<option value="${ value.id }">${ value.name }</option>`);
                        });
                    } else {
                        $('#shippingstate').append(`<option value="">No City Available !</option>`);
                    }
                }
            });
        }
        // cities
        $(document).ready(function() {
            $('#shippingstate').on('change', function() {

                var shippingstate = this.value;
                ShippingCity(shippingstate);
            });
        });

        function ShippingCity(shippingstate) {
            $.ajax({
                url: "{{ route('website.customer.cities') }}",
                type: "POST",
                data: {
                    state_id: shippingstate,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(cities) {

                    $("#shippingcity").empty();
                    if (cities.length > 0) {
                        $.each(cities, function(key, value) {
                            $("#shippingcity").append(
                                `<option value="${ value.id }">${ value.name }</option>`);
                        });
                    } else {
                        $('#shippingcity').append(`<option value="">No City Available !</option>`);
                    }
                }
            });
        }
    </script>
