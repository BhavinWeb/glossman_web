@extends('frontend.layouts.main')
@section('css')
<style type="text/css">
    .content{
        padding: 0px;
    }
    .content img{
        margin-bottom: 11px;
    }
    .content button{
        margin-bottom: 30px;;
    }
    .vertical-center {
        display: flex;
        align-items: center;
        min-height: 100vh;
    }
    .login_css{
        color: #5668d5;
        font-size: 3vw;
        opacity: 1;
        margin-bottom: -50%;
    }
    form.login_form input{
        border-radius: 0px !important;
        height: 60px !important;
        padding-left: 40px !important;
    }
    form.login_form button{
        width: 100%;
        height: 60px;
    }
    .login_form i {
        cursor: pointer;
        float: right;
        margin-top: -41px;
        margin-right: 13px;
    }
    .form_h1_heading{
        font-size: 70px;
    }
    .form-label{
        margin-left: 10px;
        font-size: 18px;
        font-weight: bold;
    }
    
    #car_picture{ visibility: hidden; }
    #profile_picture{ visibility: hidden; }
    
    #image_edit_icon{
    
        font-size: 20px;
    background: red;
    padding: 8px;
    border-radius: 28px;
    position: absolute;
    margin-top: 6%;
    margin-left: 6%;
    color: white;
    }
    
    @media screen and (max-width: 1350px) {
        #center_with {
        width: 100%!important;
    }
	}
	
 @media screen and (max-width: 1100px) {
	.text-danger{
		font-size:15px!important;
	}
}
.iti{
	display: flex!important;
}

.select2-container--default .select2-selection--single {
   background-color: #fff!important;
    border: 1px solid #040404!important;
    border-radius: 0px!important;
    height: 56px!important;
    padding-top: 13px!important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow b{
	    margin-top: 11px!important;
}

</style>
 <link rel="stylesheet" href="{{asset('frontend/css/intlTelInput.css')}}">
@endsection
@section('content')

 <div class=" d-flex justify-content-center " style="margin-top: 3%;margin-bottom: 6%;">
        <div class="col-md-5 p-5  bg-white" id="center_with">
            <h1 style="color: #5668D5!important;" class="text-center mb-4 text-primary form_h1_heading text-uppercase">My Profile</h1>
            <form class="login_form popins_family" onsubmit="return validation();" action="{{route('update_profile')}}" method="post" enctype="multipart/form-data">
             @csrf
                <div class="text-center">
                  <i style='font-size:24px' class='d-none fas' id="image_edit_icon" >&#xf304;</i>
                  @if($user->image != "")
                    <img src="{{asset('uploads/user_image/'.$user->image)}}" alt="" width="150" style="border-radius: 100px;border: 1px solid #dfd5d5;height: 145px;" id="profile_img" onclick="document.getElementById('profile_picture').click()">
                    @else
                      <img src="{{asset('user_1.png')}}" alt="" width="150" style="border-radius: 100px;border: 1px solid #dfd5d5;height: 145px;" id="profile_img" onclick="document.getElementById('profile_picture').click()">
@endif
                    <h3 style="margin-top: 18px;font-size: 20px;">{{$user->name}}</h3>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"> Name</label>
                    <input type="text" class="form-control border border-dark" value="{{$user->name}}" placeholder=" Name" id="name" name="name">
                    <span class="text-danger" id="fname_error"></span>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control border border-dark" placeholder="Email" value="{{$user->email}}" id="email" name="email">
                     <span class="text-danger" id="email_error"></span>
                     @error('error_msg')
                     	 <span class="text-danger" id="">{{$message}}</span>
                     @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                    
                    <div class="d-flex" >
 <div class="d-inline-block mr-2" style="width:20%; margin-right:10px;"> <input type="tel" class="form-control border border-dark login_email" placeholder="Country code" id="phones" value="{{$user->country_code}} " name="country_code"></div>
 <div class="d-inline-block" style="width:80%"> <input type="number" class="form-control border border-dark" placeholder="Phone Number"  onkeypress="return onlyNumberKey(event)" value="{{$user->phone}}" id="phone" name="phone" min="10"> </div>
</div>
                    
                     <span class="text-danger" id="phone_error"></span>
                </div> 
                <input type="hidden" id="city_id" name="city_id" value="0">
                

                <div id="map"></div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">My Address</label>
            <input id="searchInput" name="address"  class="controls form-control border border-dark" type="text" placeholder="My Address" value="{{$user->address}}" style="top: 11px;">
               
            </div>
            <div class="form-group" id="latitudeArea">
                <label>Latitude</label>
                <input type="text" id="latitude" name="latitude" class="form-control">
            </div>
    
            <div class="form-group" id="longtitudeArea">
                <label>Longitude</label>
                <input type="text" name="longitude" id="longitude" class="form-control">
            </div>




                
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Car Picture</label>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6" >
                          @if($user->car_picture != "")
                          <img src="{{asset('uploads/user_image/'.$user->car_picture)}}" id="car_img" alt="" width="300" heigth="300">
                          @else
                          <img src="{{asset('noimg.jpg')}}" id="car_img" alt="" width="300" heigth="300">
                          @endif
                          </div>

                        <div class="col-sm-12 col-md-12 col-lg-6"><button onclick="document.getElementById('car_picture').click()" type="button" class="text-uppercase" style="float: right;width: 173px;font-size: 16px!important;
                                    height: 50px;
                                    background: #5668D5;
                                    color: white;
                                    border: 1px solid #006dff;">Upload</button></div>
                    </div>
                </div>
                <br>
                
                @if(count($cards) != 0)
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Saved Cards</label>
                </div>
                <div class="mb-3">
                	@foreach($cards as $card_data)
                	
                	<div class="cards_css mt-3">
                        <div class="border border-secondary p-2">
@php
	$card_number = (string)$card_data->card_number;
@endphp
                        	@if($card_number[0] == 5)
                        	<img src="{{asset('visa.png')}}" width="80" height="80">
				@else
				<img src="{{asset('master.png')}}" width="80" height="80">
				@endif
                            <span>**** **** **** {{substr ($card_data->card_number, -4)}}</span></div>
                       </div>
			@endforeach
                    <div class="cards_css mt-3 d-none">
                        <div class="border border-secondary p-2">
                            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="64.771" height="43.534"><path fill="#ff9800" d="M32 10A14 14 0 1 0 32 38A14 14 0 1 0 32 10Z"/><path fill="#d50000" d="M16 10A14 14 0 1 0 16 38A14 14 0 1 0 16 10Z"/><path fill="#ff3d00" d="M18,24c0,4.755,2.376,8.95,6,11.48c3.624-2.53,6-6.725,6-11.48s-2.376-8.95-6-11.48 C20.376,15.05,18,19.245,18,24z"/></svg>                        <span>**** **** **** 2233</span>
                           </div>
                    </div>
                </div>
                @endif
		<input type="file" id="profile_picture" value="Select Files" name="image" class="d-none"  accept="image/*" onchange="profileImage(this);">
		<input type="file" id="car_picture" value="Select Files" name="car_picture" class="d-none"  accept="image/*" onchange="carImage(this);">

                <div class="d-grid">
                    <button style="font-size: 20px;" class="btn btn-primary font-h text-uppercase mt-3" type="submit">Edit Profile</button>
                </div>
            </form>
        </div>
    </div>
     <script src="{{asset('frontend/js/intlTelInput.js')}}"></script>
     <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script>
    // Vanilla Javascript
    var input = document.querySelector("#phones");
    window.intlTelInput(input,({
      // options here
    }));
 
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
        $('.iti__flag-container').click(function() { 
          var countryCode = $('.iti__selected-flag').attr('title');
          var countryCode = countryCode.replace(/[^0-9]/g,'')
          $('#phones').val("");
          $('#phones').val("+"+countryCode+" "+ $('#phones').val());
       });
    });
  </script>
<script>
$('#phones').keydown(function(e) {
   e.preventDefault();
   return false;
});

$('#phone').keypress(function (e) {    
    
                var charCode = (e.which) ? e.which : event.keyCode    
    
                if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    
                    return false;                        
    
            });


function onlyNumberKey(evt) {
              
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }

function profileImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById('profile_img').src =  e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function carImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById('car_img').src =  e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}
	function validation(){
		var i = 1;
		var f_name = $("#name").val();
		var email = $("#email").val();
		var phone = $("#phone").val();
		
		$("#fname_error").html("");
		$("#email_error").html("");
		//$("#phone_error").html("");
		
		if(f_name == ""){
			$("#fname_error").html("Enter your first name!.");
			i = 0;
		}
		if(f_name != "" && f_name.length < 3){
			$("#fname_error").html("Enter your valid first name!.");
			i = 0;
		}
		if(email == ""){
			$("#email_error").html("Enter your email!.");
			i = 0;
		}
		if(phone == ""){
			$("#phone_error").html("Enter your phone number!.");
			i = 0;
		}
		
		if(phone.length != 10){
			$("#phone_error").html("Enter valid phone number!.");
			i = 0;
		}
		
		
		
		//if(phone !=){
		//	$("#phone_error").html("Enter your valid phone number!.");
		//	i = 0;
		//}
		
		if(i == 0){
		return false;
		}
	}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5wiiyExnsmv3Drg_dRs4oTyU8Ww7iihQ&libraries=places&callback=initMap&v=weekly" async > </script>
   <!-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcDBClAh4Eduw34eDkVeXVKELu2dFnFn4&libraries=places&callback=initMap&v=weekly" async
    ></script> -->
    <script>
        $(document).ready(function () {
            $("#latitudeArea").addClass("d-none");
            $("#longtitudeArea").addClass("d-none");
        });
    </script>
    <script>
    
    navigator.geolocation.getCurrentPosition(
       function (position) {
          initMap(position.coords.latitude, position.coords.longitude)
       },
       function errorCallback(error) {
          console.log(error)
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
        var input = document.getElementById('searchInput');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
    
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });
    
        autocomplete.addListener('place_changed', function() {
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
            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
        
            var address = '';
            
            if (place.address_components) {
                address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
        
            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            
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
