@extends('frontend.layouts.main') @section('css')
<style>
    input {
        padding-left: 30px !important;
    }

    #footer {
        background: black;
        padding: 0 0 30px 0;
        color: #fff;
        font-size: 14px;
    }

    .poppins_family {
        font-family: "Poppins";
    }

    .oxanium_family {
        font-family: "Oxanium";
    }

    .form-control,
    .form-select {
        border-radius: 0 !important;
    }

    .form-control-xl {
        width: 100%;
    }

    .btn-primary {
        background-color: #5668d5;
    }

    .cart_btn {
        border-color: #0d6efd !important;
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
        padding-right: 3rem !important;
        padding-left: 3rem !important;
        margin: 0.5rem !important;
        border-radius: 0 !important;
    }

    thead {
        background-color: #ebebeb;
    }

    .table,
    td,
    th,
    tr,
    thead,
    .card {
        border-style: none;
    }

    input {
        border: 1px solid #0c0c0c !important;
    }

    select option {
        font-family: Poppins !important;
    }
    tr th,
    tr td {
        text-align: center;
    }
    .image_style {
        border: 1px solid #c7bcbc;
        padding: 20px;
    }
    .cursore_hover:hover {
        cursor: pointer;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>
@endsection @section('content')

<div id="footer" style="padding-bottom: 0;">
    <div id="">
        <div class="container clearfix">
            <div class="common-breadcrumbs gap-2 d-flex flex-column">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb h7">
                        <li class="text-uppercase"><a href="#">HOME</a></li>
                        <li class="text-uppercase px-4">|</li>
                        <li class="text-uppercase" aria-current="page">Shopping Cart</li>
                    </ol>
                </nav>
                <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">Shopping Cart</h1>
            </div>
        </div>
    </div>
</div>

<section class="">
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col">
                <div class="table-responsive poppins_family">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="p-2">Image</th>

                                <th class="p-2" scope="col">Product</th>
                                <th class="p-2" scope="col">Price</th>
                                <th class="p-2" scope="col">Quantity</th>
                                <th class="p-2" scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['product_list'] as $p_data)
                            <tr style="border-bottom: 1px solid #5a6f80;" id="fadin{{$p_data->id}}">
                                <td class="align-middle">
                                    <div class="flex-column ms-4 cursore_hover" onclick="removeCart({{$p_data->id}});">
                                        X
                                    </div>
                                </td>
                                <td>
                                    <div class="align-items-center">
                                        <img src="{{$p_data->image_url}}" class="img-fluid image_style" style="width: 120px;" alt="Book" />
                                    </div>
                                </td>

                                <td class="align-middle">
                                    <div class="flex-column ms-4">
                                        <p class="mb-2">{{$p_data->product_name}}</p>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <p class="mb-0" style="font-weight: 500;">{{$p_data->currency}} {{$p_data->sale_price}}</p>
                                </td>
                                <td class="align-middle">
                                    <div class="d-inline-flex flex-row" style="border: 1px solid #ebebeb;">
                                        <button class="btn btn-link px-2 remove_cart" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" data-id="{{$p_data->product_id}}">
                                            <i style="color: #0c0c0c;" class="fas fa-minus"></i>
                                        </button>

                                        <input
                                            min="0"
                                            name="quantity"
                                            id="cart_quantity{{$p_data->product_id}}"
                                            readonly
                                            value="{{$p_data->product_quantity}}"
                                            type="number"
                                            class="form-control form-control-sm quantity_count_validation"
                                            style="width: 50px; padding-left: 0 !important; text-align: center; border: none !important; color: #0c0c0c; font-weight: 400; color: red;"
                                        />

                                        <button class="btn btn-link px-2 update_cart" data-id="{{$p_data->product_id}}" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                            <i style="color: #0c0c0c;" class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <p class="mb-0" style="font-weight: 500;" id="product_total{{$p_data->product_id}}">${{$p_data->total_price}}</p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-end">
                        <a href="{{route('productcategory')}}">
                            <button style="font-size: 15px;" class="btn btn_confirm btn-primary text-uppercase px-5 py-3 oxanium_family fw-bold"><i class="fas fa-plus pe-3" style="font-size: small;"></i> Continue Shopping</button>
                        </a>
                        <button style="font-size: 15px;" class="btn btn-lg text-primary cart_btn text-uppercase oxanium_family fw-bold d-none"><i class="fas fa-plus pe-3" style="font-size: small;"></i>Update Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="h-custom">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col">
                <div class="">
                    <div class="p-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="py-3 ps-4 oxanium_family" style="background-color: #ebebeb; font-weight: 500 !important;">CART TOTALS</h5>

                                @if($data['discount'] == 0)

                                <h5 class="popins_family fw-normal mt-5" style="font-size: 15px; letter-spacing: 1px;">Enter your coupon code if you have one.</h5>
                                <div class="row mb-4">
                                    <div class="custome_cart_buttton">
                                        <div class="form-outline form-white" style="margin-top: 0.5rem;">
                                            <input type="text" class="form-control form-control-xl" style="line-height: 2.5;" name="coupon_number" id="coupon_number" />
                                            <span class="text-danger" id="coupon_error"></span>
                                        </div>

                                        <div class="form-outline form-white">
                                            <button style="font-size: 15px; " class="btn btn-primary cart_btn text-uppercase oxanium_family fw-bold" onclick="applay_coupon();">
                                                Apply Coupon
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <h5 class="popins_family fw-normal mt-5" style="font-size: 15px; letter-spacing: 1px;">Enter your coupon code if you have one.</h5>
                                <div class="col-md-5">
                                    <div class="form-outline form-white">
                                        <button style="font-size: 15px;" class="btn btn-primary cart_btn text-uppercase oxanium_family fw-bold" onClick="removeCoupon();">
                                            Click to remove Coupon!
                                        </button>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-lg-6 popins_family fw-normal" style="font-size: 15px; letter-spacing: 1px;">
                                <h5 class="py-3 ps-4 oxanium_family" style="background-color: #ebebeb; font-weight: 500 !important;">CART TOTALS</h5>
                                <div class="btext-white rounded-3">
                                    <div class="">
                                        <form class="mt-4" action="{{route('checkouts')}}" onsubmit="return validateForm()">
                                            <div class="row mb-4 mt-5">
                                                <div class="col-md-2">
                                                    <div class="form-outline form-white">
                                                        <label class="form-label fw-bold" for="typeText">Subtotal</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-outline form-white">
                                                        <label for="form-label" id="sub_total_amount">${{$data['sub_total']}}</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-md-2">
                                                    <div class="form-outline form-white">
                                                        <label class="form-label fw-bold" for="typeText">Shipping</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="form-outline form-white">
                                                        <label for="form-label">Enter your address to view shipping options Calculate shipping</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="map"></div>
                                            <div class="">
                                                <input id="address" class="form-control border border-dark login_email" type="text" placeholder="Enter a location*" name="address" style="top: 11px;" />
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

                                            <div class="row mb-4">
                                                <div class="col-md-2">
                                                    <div class="form-outline form-white"></div>
                                                </div>
                                                <div class="mt-3">
                                                    <div class="">
                                                        <input type="text" class="form-control border border-dark login_email" placeholder="Postal code *" id="post_code" />
                                                        <span class="text-danger" id="post_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-2">
                                                    <div class="form-outline form-white"></div>
                                                </div>
                                                <div class="col-md-10 mt-2">
                                                    <div class="form-outline form-white">
                                                        <span
                                                            class="btn btn-lg btn-primary border-primary border checkout_right_button fw-bold rounded-0 py-3 px-5 mt-2 text-uppercase oxanium_family"
                                                            style="font-size: 15px;"
                                                            onclick="get_shipping_rate();"
                                                        >
                                                            <i class="fas fa-plus pe-3" style="font-size: small;"></i>Update
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4 border-bottom border-top border-secondary" style="font-size: 15px;">
                                                <div class="col-md-2 my-2">
                                                    <div class="form-outline form-white">
                                                        <label class="form-label fw-bold" for="typeText">Total</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-10 my-2">
                                                    <div class="form-outline form-white">
                                                        <label for="form-label" id="total_amount">$<span id="shipping_amount_1">{{$data['total']}}</span> </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-lg btn-primary border-primary border checkout_right_button rounded-0 fw-bold py-3 px-5 mt-2 text-uppercase oxanium_family" style="font-size: 15px;">
                                                <i class="fas fa-plus pe-3" style="font-size: small;"></i>PROCEED TO CHECKOUT
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection @section('javascript')

<script>
    var shipping_charge = 0;

    function get_shipping_rate() {
        $("#post_error").html("");
        $("#address_error").html("");
       
        sp = 0;

        var post_code = $("#post_code").val();
        var address = $("#address").val();

        if (post_code == "") {
            sp = 1;
            $("#post_error").html("Enter your post code!");
        }

        if (post_code.length != 6) {
            sp = 1;
            $("#post_error").html("Enter valid post code!");
        }
        if (address == "") {
            sp = 1;
            $("#address_error").html("Enter your address!");
        }

        if (sp == 1) {
            return false;
        } else {
            var formData = {
                post_code: post_code,
                address: address,
               
            };
            var type = "GET";
            var ajaxurl = '{{route("get_shipping_rate")}}';
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: "json",
                success: function (data) {
                    alert("added shipping charge successfully");
                    $("#shipping_amount_1").html(data);
                    shipping_charge = data;
                },
                error: function (data) {
                    console.log(data);
                },
            });
        }
    }

    function removeCart(id) {
        var formData = {
            id: id,
        };
        var type = "GET";
        var ajaxurl = '{{ route("delete_cart") }}';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: "json",
            success: function (data) {
                location.reload();
                removeCoupon();
            },
            error: function (data) {
                console.log(data);
            },
        });
    }

    function removeCoupon() {
        var formData = {
            id: 0,
        };
        var type = "GET";
        var ajaxurl = '{{ route("remove_coupon") }}';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: "json",
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                console.log(data);
            },
        });
    }

    $(".update_cart").click(function () {
        var p_id = $(this).data("id");
        var quantity = $("#cart_quantity" + p_id).val();
        addcart(quantity, p_id, 1);
    });

    $(".remove_cart").click(function () {
        var p_id = $(this).data("id");
        var quantity = $("#cart_quantity" + p_id).val();
        if (quantity == 0) {
            var quantity = $("#cart_quantity" + p_id).val(1);
            return false;
        }
        addcart(quantity, p_id, 2);
    });

    function applay_coupon() {
        var coupon = $("#coupon_number").val();
        if (coupon == "") {
            $("#coupon_error").html("Please enter coupon!");
        } else {
            var formData = {
                coupon: coupon,
            };
            var type = "GET";
            var ajaxurl = '{{ route("applay_coupon") }}';
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: "json",
                success: function (data) {
                    alert(data.message);
                        location.reload();
                },
                error: function (data) {
                    console.log(data);
                },
            });
        }
    }

    function validateForm() {
        if (shipping_charge == 0) {
            alert("select address");
            return false;
        }
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5wiiyExnsmv3Drg_dRs4oTyU8Ww7iihQ&libraries=places&callback=initMap&v=weekly" async > </script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcDBClAh4Eduw34eDkVeXVKELu2dFnFn4&libraries=places&callback=initMap&v=weekly" async></script> -->
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

   function initMap(lat_map,log_map) {
     var geocoder = new google.maps.Geocoder();
           var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: lat_map, lng: log_map},
          zoom: 16
        });
        
        var latlng = new google.maps.LatLng(lat_map, log_map);
                geocoder.geocode({'latLng': latlng}, function(results, status) {
                    if(status == google.maps.GeocoderStatus.OK) {
                      
                        
               $("#google_address").html(results[0]['formatted_address']);
               $("#address_value").val(results[0]['formatted_address']);
               $("#longitude_value").val(log_map);
               $("#lattitude_value").val(lat_map);
                    };
                });
        var input = document.getElementById('address');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
    
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
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
            let postcode = "";
           for (var i = 0; i < place.address_components.length; i++) {
                // console.log(place.address_components);
                
                for (var j = 0; j < place.address_components[i].types.length; j++) {
                    if (place.address_components[i].types[j] == "postal_code") {
                    console.log(place.address_components[i]);
                    postcode = place.address_components[i].long_name;

                    }
                }
            }
			$("#post_code").val(postcode);
            var address = place.formatted_address;


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

@endsection

