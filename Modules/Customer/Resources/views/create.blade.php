@extends('admin.layouts.app')
@section('title')
    {{ __('create') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('create') }}</h3>
                        <div class="align-items-center  ml-auto">
                            <a href="{{ route('module.customer.index') }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                <i class="fas fa-arrow-left"></i>
                                &nbsp; {{ __('back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('module.customer.store') }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-8">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <x-forms.label name="first_name" required="true" />
                                            <input value="{{ old('first_name') }}" name="first_name" type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                placeholder="{{ __('first_name') }}">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <x-forms.label name="last_name" required="true" />
                                            <input value="{{ old('last_name') }}" name="last_name" type="text"
                                                class="form-control @error('last_name') is-invalid @enderror"
                                                placeholder="{{ __('last_name') }}">
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <x-forms.label name="email" required="true" />
                                            <input value="{{ old('email') }}" name="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="{{ __('email') }}">
                                            @error('email')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <x-forms.label name="phone" required="true" />
                                            <input value="{{ old('phone') }}" name="phone" type="text"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="{{ __('phone') }}">
                                            @error('phone')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                   
                                    <div class="col-md-6">
                                        <div class="">
                                            <div id="map"></div>
                                            <x-forms.label name="address" required="true" />
                                            <input id="address" value="{{ $customer->address ?? old('address') }}" name="address" class="form-control border border-dark login_email" type="text" placeholder="Enter a location" />
                                            <!-- <input type="text" name="autocomplete" id="autocomplete" class="form-control border border-dark login_email" placeholder="Choose Location"> -->
                                            <span class="text-danger" id="address_error"></span>
                                            @if($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                     
                                    </div>
                                    <div class="col-md-6">
                                    <x-forms.label name="password" required="true" />
                                            <input value="{{ old('password') }}" name="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="{{ __('password') }}">
                                            @error('password')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                    </div>
                                
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-4 col-sm-4">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>
                                                {{ __('create') }}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <x-forms.label name="image" required="true" />
                                            <input name="image" type="file" accept="image/png, image/jpg, image/jpeg"
                                                class="form-control dropify @error('image') is-invalid @enderror"
                                                data-max-file-size="3M"
                                                data-show-errors="true"
                                                data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                                            @error('image')
                                                <span class="invalid-feedback d-block"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/css/dropify.min.css" />
    <style>
        .select2-results__option[aria-selected=true] {
            display: none;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            color: #fff;
            border: 1px solid #fff;
            background: #007bff;
            border-radius: 30px;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }

    </style>
@endsection

@section('script')
<script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
<script src="{{ asset('backend') }}/js/dropify.min.js"></script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5wiiyExnsmv3Drg_dRs4oTyU8Ww7iihQ&libraries=places&callback=initMap&v=weekly" async > </script>
    <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcDBClAh4Eduw34eDkVeXVKELu2dFnFn4&libraries=places&callback=initMap&v=weekly" async></script> -->
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
@endsection
