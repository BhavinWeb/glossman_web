@extends('frontend.layouts.main')
@section('meta_data')
    @php
    $data = metaData('register');
    @endphp

    <meta name="title" content="{{ $data->title }}">
    <meta name="description" content="{{ $data->description }}">

    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $data->description }}">

    <meta name=twitter:card content=summary_large_image />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{url()->current()}}" />
    <meta name=twitter:title content="{{ $data->title }}" />
    <meta name=twitter:description content="{{ $data->description }}" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
@section('css')
<style type="text/css">
    .content {
        padding: 0px;
    }

    .content img {
        margin-bottom: 11px;
    }

    .content button {
        margin-bottom: 30px;
    }

    .vertical-center {
        display: flex;
        align-items: center;
        min-height: 100vh;
    }

    .login_css {
        color: #5668d5;
        font-size: 3vw;
        opacity: 1;
        margin-bottom: -50%;
    }

    .login_email {
        border-radius: 0px !important;
        height: 60px !important;
        padding-left: 40px !important;
    }

    .login_email::placeholder {
        color: #9f9f9f !important;
        font-family: "Poppins", Arial, sans-serif !important;
        font-size: small;
    }

    .login_button {
        width: 100%;
        height: 60px;
    }

    .login_form i {
        cursor: pointer;
        float: right;
        margin-top: -41px;
        margin-right: 13px;
    }

    .form_h1_heading {
        font-size: 70px;
    }

    @media screen and (max-width: 1350px) {
        #center_with {
            width: 70%;
        }
    }

    @media screen and (max-width: 500px) {
        #center_with {
            width: 99%;
        }

        .modal {
            position: absolute;
            float: left;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
    }

    @media screen and (max-width: 1100px) {
        .text-danger {
            font-size: 15px !important;
        }
    }

    .iti {
        display: flex !important;
    }
</style>
<link rel="stylesheet" href="{{asset('frontend/css/intlTelInput.css')}}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@endsection @section('content')
<div class="d-flex justify-content-center" id="register_form" style="margin-top: 3%; margin-bottom: 6%;">
    <div class="col-md-5 p-5 bg-white" id="center_with">
        <h1 class="text-center mb-4 fw-bold display-3 text-uppercase" style="color: #5668d5 !important;">Sign Up</h1>
        <div class="login_form popins_family d-flex flex-column gap-4">
            @csrf
            <div class="">
                <input type="text" class="form-control border border-dark login_email" name="fname" value="{{ old('fname') }}" placeholder="First Name" id="f_name" />
                <span class="text-danger" id="fname_error"></span>
                @if($errors->has('fname'))
                <span class="text-danger">{{ $errors->first('fname') }}</span>
                @endif
            </div>
            <div class="">
                <input type="text" class="form-control border border-dark login_email" value="{{ old('lname') }}" name="lname" placeholder="Last Name" id="l_name" />
                <span class="text-danger" id="lname_error"></span>
                @if($errors->has('lname'))
                <span class="text-danger">{{ $errors->first('lname') }}</span>
                @endif
            </div>

            <div class="">
                <div id="map"></div>
                <input id="address" name="address" class="form-control border border-dark login_email" type="text" placeholder="Enter a location" style="top: 11px;" />
                <!-- <input type="text" name="autocomplete" id="autocomplete" class="form-control border border-dark login_email" placeholder="Choose Location"> -->
                <span class="text-danger" id="address_error"></span>
                @if($errors->has('address'))
                <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
            </div>
            <div class="form-group" id="latitudeArea">
                <label>Latitude</label>
                <input type="text" id="latitude" name="latitude" class="form-control" />
            </div>

            <div class="form-group" id="longtitudeArea">
                <label>Longitude</label>
                <input type="text" name="longitude" id="longitude" class="form-control" />
            </div>
            <div class="">
                <input type="email" class="form-control border border-dark login_email" placeholder="Email" id="email" name="email" value="{{ old('email') }}" />
                <span class="text-danger" id="email_error"></span>
                @if($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="d-flex">
                <div class="d-inline-block mr-2" style="width: 15%; margin-right: 10px;">
                    <input type="tel" class="form-control border border-dark login_email" placeholder="Country code" onkeydown="return false;" id="phones" value="" name="country_code" />
                </div>
                <div class="d-inline-block" style="width: 85%;">
                    <input type="number" class="form-control border border-dark" placeholder="Phone Number"  style="height: 60px; border-radius: 0px;" value="" id="phone" name="phone" min="10" />
                    <span class="text-danger" id="phone_error"></span>
                </div>
            </div>

            <div class="">
                <input type="password" class="form-control border border-dark login_email" placeholder="Password" id="password" name="password" />
                <i class="bi bi-eye-slash" id="password_show" onclick="show_password();"></i> <i class="bi bi-eye d-none" id="password_hide" onclick="hide_password();"></i>

                <span class="text-danger" id="password_error"></span>
                @if($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="">
                <input type="password" class="form-control border border-dark login_email" placeholder="Confirm Password" id="confirm_password" name="confirm_password" />
                <i class="bi bi-eye-slash" id="confirm_password_show" onclick="show_confirm_password();"></i> <i class="bi bi-eye d-none" id="confirm_password_hide" onclick="hide_confirm_password();"></i>

                <span class="text-danger" id="confirm_password_error"></span>
                @if($errors->has('confirmpassword'))
                <span class="text-danger">{{ $errors->first('confirmpassword') }}</span>
                @endif
            </div>

            <div class="d-grid mt-2">
                <button class="btn btn-primary login_button text-uppercase fw-bold" type="button" onclick="return validateForm()">Sign Up</button>
            </div>
        </div>

        <div class="mt-4 text-center font-ui font-sm">Already Have an Account? <a href="{{route('signin')}}" class="text-primary text-decoration-underline">Log In</a></div>
    </div>
</div>

<div class="d-flex justify-content-center d-none" id="verification_form" style="margin-top: 3%; margin-bottom: 6%;">
    <div class="col-md-5 p-5 bg-white">
        <h1 class="text-center mb-4 fw-bold display-3 text-uppercase" style="color: #5668d5 !important;">OTP Verification</h1>

        <span>An OTP has been send to your registered email <span class="d_email"></span> </span>
        <br />
        <br />

        <span id="otp_show"></span>

        <div class="login_form popins_family d-flex flex-column gap-4">
            @csrf
            <div class="">
                <input type="text" class="form-control border border-dark login_email" name="otp" placeholder="Enter OTP Here" id="otp" /><br />
                <span class="text-danger" id="otp_error"></span>
                @if($errors->has('otp'))
                <span class="text-danger">{{ $errors->first('otp') }}</span>
                @endif
            </div>
            <div class="d-grid mt-2">
                <button class="btn btn-primary login_button text-uppercase fw-bold" onclick="checkOTP()" type="button">Verify</button>
            </div>
        </div>

        <div class="mt-4 text-center font-ui font-sm">Didnt't receive the code? <span class="text-primary" onclick="return validateForm()" style="cursor: pointer;">Resend Code</span></div>
    </div>
</div>

@endsection @section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5wiiyExnsmv3Drg_dRs4oTyU8Ww7iihQ&libraries=places&callback=initMap&v=weekly" async > </script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5wiiyExnsmv3Drg_dRs4oTyU8Ww7iihQ&libraries=places&callback=initMap&v=weekly" async></script>-->
<script>
    $(document).ready(function () {
        $("#latitudeArea").addClass("d-none");
        $("#longtitudeArea").addClass("d-none");
    });
</script>
<script>
    navigator.geolocation.getCurrentPosition(
        function (position) {
            initMap(position.coords.latitude, position.coords.longitude);
        },
        function errorCallback(error) {
            console.log(error);
        }
    );

    function initMap(lat_map, log_map) {
        var geocoder = new google.maps.Geocoder();
        var map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: lat_map, lng: log_map },
            zoom: 16,
        });

        var latlng = new google.maps.LatLng(lat_map, log_map);
        geocoder.geocode({ latLng: latlng }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                $("#google_address").html(results[0]["formatted_address"]);
                $("#address_value").val(results[0]["formatted_address"]);
                $("#longitude_value").val(log_map);
                $("#lattitude_value").val(lat_map);
            }
        });
        var input = document.getElementById("address");
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo("bounds", map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
        });

        autocomplete.addListener("place_changed", function () {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35),
            });
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = "";

            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name) || "",
                    (place.address_components[1] && place.address_components[1].short_name) || "",
                    (place.address_components[2] && place.address_components[2].short_name) || "",
                ].join(" ");
            }

            infowindow.setContent("<div><strong>" + place.name + "</strong><br>" + address);

            infowindow.open(map, marker);

            // Location details
            //for (var i = 0; i < place.address_components.length; i++) {
            //     if(place.address_components[i].types[0] == 'postal_code'){
            //       document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
            //    }
            //  if(place.address_components[i].types[0] == 'country'){
            //        document.getElementById('country').innerHTML = place.address_components[i].long_name;
            //    }
            //  }

            $("#google_address").html(place.formatted_address);
            $("#address_value").val(place.formatted_address);
            $("#longitude_value").val(place.geometry.location.lat());
            $("#lattitude_value").val(place.geometry.location.lng());
        });
    }
</script>
<script src="{{asset('frontend/js/intlTelInput.js')}}"></script>
<script>
    // Vanilla Javascript
    // Vanilla Javascript
    var input = document.querySelector("#phones");
    window.intlTelInput(input, {
        // options here
    });

    $(document).ready(function () {
        $(".iti__flag-container").click(function () {
            var countryCode = $(".iti__selected-flag").attr("title");
            var countryCode = countryCode.replace(/[^0-9]/g, "");
            $("#phones").val("");
            $("#phones").val("+" + countryCode + " " + $("#phones").val());
        });
    });
</script>
<script>
    $("#phone").keypress(function (e) {
        var charCode = e.which ? e.which : event.keyCode;

        if (String.fromCharCode(charCode).match(/[^0-9]/g)) return false;
    });

    function validateForm() {
        var email = $("#email").val();
        var fname = $("#f_name").val();
        var lname = $("#l_name").val();
        var address = $("#address").val();
        var phone = $("#phone").val();
        var phones = $("#phones").val();
        var password = $("#password").val();
        var confirm_password = $("#confirm_password").val();

        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

        $("#email_error").html("");
        $("#fname_error").html("");
        $("#lname_error").html("");
        $("#address_error").html("");
        $("#phone_error").html("");
        $("#password_error").html("");
        $("#confirm_password_error").html("");

        var i = 1;

        if (email == "") {
            $("#email_error").html("Please enter email!");
            i = 0;
        } else {
            if (!testEmail.test(email)) {
                $("#email_error").html("Please enter valid email!");
                i = 0;
            }
        }

        if (phones == "") {
            $("#phone_error").html("Please select code!");
            i = 0;
        }

        if (address == "") {
            $("#address_error").html("Please enter address!");
            i = 0;
        }

        if (fname == "") {
            $("#fname_error").html("Please enter first name!");
            i = 0;
        }

        if (fname.length < 3) {
            $("#fname_error").html("Please enter minimum 3 letters");
            i = 0;
        }

        if (lname == "") {
            $("#lname_error").html("Please enter last name!");
            i = 0;
        }

        if (lname.length < 3) {
            $("#lname_error").html("Please enter minimum 3 letters");
            i = 0;
        }

        if (phone == "") {
            $("#phone_error").html("Please enter phone number!");
            i = 0;
        }

        if (phone != "") {
            if (phone.length != 10) {
                $("#phone_error").html("Please enter valid phone number!");
                i = 0;
            }
        }

        if (password == "") {
            $("#password_error").html("PLease enter password!");
            i = 0;
        }

        if (password != "" && password.length < 6) {
            $("#password_error").html("PLease enter min six characters!");
            i = 0;
        }

        if (password != "" && confirm_password == "") {
            $("#confirm_password_error").html("Please enter Confirm password!");
            i = 0;
        }

        if (confirm_password != "") {
            if (password != confirm_password) {
                $("#confirm_password_error").html("Confirm password not match with password!");
                i = 0;
            }
        }

        if (i == 0) {
        } else {
            var formData = {
                email: $("#email").val(),

                phone: $("#phone").val(),
            };

            var type = "GET";

            var ajaxurl = '{{route("check_user_details")}}';

            $.ajax({
                type: type,
                url: ajaxurl,
                dataType: "json",
                data: formData,
                success: function (data) {
                    var user_detail = 1;
                    if (data.data.email == true) {
                        user_detail = 0;
                        $("#email_error").html("This email already in use!");
                    }

                    if (data.data.phone == true) {
                        user_detail = 0;
                        $("#phone_error").html("This number already in user!");
                    }

                    if (user_detail == 1) {
                        resendOTP();
                        $(".d_email").html(email);
                        $("#register_form").addClass("d-none");
                        $("#verification_form").removeClass("d-none");
                    } else {
                        return false;
                    }
                },
                error: function (data) {
                    console.log(data);
                },
            });
        }
    }

    function checkOTP() {
        $("#otp_error").html("");
        var check_val = 1;
        if ($("#otp").val() == "") {
            $("#otp_error").html("Please enter valid OTP!");
            check_val = 0;
        } else {
            if ($("#otp").val().length != 6) {
                $("#otp_error").html("Please enter valid OTP!");
                check_val = 0;
            }
        }

        if (check_val == 1) {
            var formData = {
                _token: "{{ csrf_token() }}",
                otp: $("#otp").val(),
                email: $("#email").val(),
                fname: $("#f_name").val(),
                lname: $("#l_name").val(),
                address: $("#address").val(),
                phone: $("#phone").val(),
                code: $("#phones").val(),
                password: $("#password").val(),
                confirm_password: $("#confirm_password").val(),
            };

            // alert(phone);

            var type = "POST";

            var ajaxurl = '{{route("user_verification_otp")}}';

            $.ajax({
                type: type,
                url: ajaxurl,
                dataType: "json",
                data: formData,
                success: function (data) {
                    if (data.success == true) {
                        window.location.href = "{{route('signin')}}";
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Please check your otp!",
                        });
                    }
                },
                error: function (data) {
                    console.log(data);
                },
            });
        }
    }

    function resendOTP() {
        var email = $("#email").val();
        var code = $("#phones").val();

        var formData = {
            _token: "{{ csrf_token() }}",
            email: email,
            code: code,
        };

        var type = "GET";

        var ajaxurl = '{{route("resend-otp")}}';

        $.ajax({
            type: type,
            url: ajaxurl,
            dataType: "json",
            data: formData,
            success: function (data) {
                if (data.success == true) {
                    Swal.fire("Success", "OTP has been sent to your register email", "success");
                    $("#otp_show").html(data.data);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                }
            },
            error: function (data) {
                console.log(data);
            },
        });
    }

    function show_password() {
        $("#password").attr("type", "text");
        $("#password_show").addClass("d-none");
        $("#password_hide").removeClass("d-none");
    }

    function hide_password() {
        $("#password_show").removeClass("d-none");
        $("#password_hide").addClass("d-none");
        $("#password").attr("type", "password");
    }

    function show_confirm_password() {
        $("#confirm_password").attr("type", "text");
        $("#confirm_password_show").addClass("d-none");
        $("#confirm_password_hide").removeClass("d-none");
    }

    function hide_confirm_password() {
        $("#confirm_password_show").removeClass("d-none");
        $("#confirm_password_hide").addClass("d-none");
        $("#confirm_password").attr("type", "password");
    }
</script>
<script>
    let items = document.querySelectorAll("#featureContainer .carousel .carousel-item");
    items.forEach((el) => {
        const minPerSlide = 3;
        let next = el.nextElementSibling;
        for (var i = 1; i < minPerSlide; i++) {
            if (!next) {
                // wrap carousel by using first child
                next = items[0];
            }
            let cloneChild = next.cloneNode(true);
            el.appendChild(cloneChild.children[0]);
            next = next.nextElementSibling;
        }
    });
    $(document).ready(function () {
        $("#featureCarousel").carousel({ interval: false });
        $("#featureCarousel").carousel("pause");
    });
</script>

<script>
    // var accountModal = document.getElementById('modalCenter')
    // // accountModal.addEventListener('shown.bs.modal', function (event) {
    // //     // Button that triggered the modal
    // //     document.getElementById('mainNav').style.zIndex = '0';
    // // })
    // accountModal.addEventListener('hide.bs.modal', function (event) {
    //     document.getElementById('mainNav').style.zIndex = 1;
    // })
</script>

<script>
    // ===== Scroll to Top ====
    $(window).scroll(function () {
        if ($(this).scrollTop() >= 50) {
            // If page is scrolled more than 50px
            $("#return-to-top").fadeIn(200); // Fade in the arrow
        } else {
            $("#return-to-top").fadeOut(200); // Else fade out the arrow
        }
    });
    $("#return-to-top").click(function () {
        // When arrow is clicked
        $("body,html").animate(
            {
                scrollTop: 0, // Scroll to top of body
            },
            500
        );
    });
</script>
@endsection

