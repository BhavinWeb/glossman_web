@extends('frontend.layouts.main')
@section('css')
<style>
    .btn{
        border-color: #6c757d !important;
    }
    .btn:hover{
        border-color: #6c757d !important;
    }
    #date{
        max-width: 75%;
        height: 50px;
        margin-top: 10px;
    }
    .button {
        float: left;
        margin-bottom: 10px;
        padding-left: 102%;
        width: 200px;
        height: 40px;
        position: relative;
    }

    .button label,
    .button input {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    .button input[type="radio"] {
        opacity: 0.011;
        z-index: 100;
    }

    .button input[type="radio"]:checked + label {

        border-radius: 4px;
    }

    .button label {
        cursor: pointer;
        z-index: 90;
        line-height: 1.8em;
        border: 1px solid;
    }
    #map {
        height: 500px;
        width: 100%;
        background: url("images/map1.png");
        background-size: contain;
        background-repeat: no-repeat;
    }

    .vertical-center {
        display: flex;
        align-items: center;
        min-height: 100vh;
    }
    .timeslots .active .button{
    	    background: #97e7eb!important;
    }
    
    #searchInput{
		
	top:11px!important;
	width: 39%;
	
	}
	
	.h1{
		font-size: 2.2rem;
	}
	
	
	
</style>
@endsection
@section('content')
 <div id="footer" style="padding-bottom: 0;">
    <div id="">
        <div class="container clearfix">
            <div class="common-breadcrumbs gap-2 d-flex flex-column">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb h7">
                        <li class="text-uppercase"><a href="#">HOME</a></li>
                        <li class="text-uppercase px-4">|</li>
                        <li class="text-uppercase" aria-current="page">Schedule Booking</li>
                    </ol>
                </nav>
                <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">Schedule Booking</h1>
            </div>
        </div>
    </div>
</div>


    <div class="container">
        <div class="row my-5">
            <div class="col-sm-12 text-uppercase">
                <h1 style="font-weight: 500;">Service Location</h1>
                

                <!-- Google map -->
                <div id="map"></div>

                <!--<div id="map"></div>-->
            </div>
        <div>
            
              <input id="searchInput" class="controls form-control" type="text" placeholder="Enter a location" style="top: 11px;">
                <div class="mt-5 col-xl-3 col-12">
                    <span class="h1 text-uppercase">Address</span>
                    <p class="font-ui mt-2" id="google_address">200 Champlain St. Suite 210, Dieppe, New-Brunswick, E1A1P1,</p>
                </div>

                <div class="my-5">
                    
                        <label for="date" class="">
                                    <span class="text-uppercase h1" style="font-weight: 500">
                                        Schedule Booking
                                    </span>
                        </label>
                        <div class="col-5">
                            <div class="input-group date" id="datepicker">
                                <input type="date" class="form-control text-muted" id="date" onchange="select_date();" />
                                
                                
                                <!-- <span class="input-group-append">
                                    <span class="input-group-text bg-light d-block">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </span> -->
                            </div>
                            <span id="date_errror" class="text-danger"></span>
                        </div>
                        <?php
                            $timezone = date_default_timezone_get();
                            $date = date('h:i A', time());
                        ?>
                        <div class="row" id="slot"></div>
                        <form method="POST" action="{{route('service_book')}}" onsubmit="return validation();" enctype="multipart/form-data">
                        
                            @csrf
                            <input type="hidden" value="72.7924497" id="lattitude_value" name="lattitude">
                            <input type="hidden" value="21.1843631" id="longitude_value" name="longitude">
                            <input type="hidden" value="5QMR+QX9, Adajan Gam, Adajan, Surat, Gujarat 395009, India" id="address_value" name="address">
                            <input type="hidden" value="" id="note_value" name="note">
                            <input type="hidden" value="" id="selected_date" name="date">
                            <input type="hidden" value="" id="selected_time" name="time">
                            
                            <div class="mt-5 col-xl-3 col-12">
                                <span class="h1 text-uppercase">Before Car Image</span>
                                <input type="file" class="form-control" multiple name="before_images[]"  accept="image/png, image/gif, image/jpeg" ><br>
                                <span id="image_errror" class="text-danger"></span>
                            </div>
                            
                            <div class="mt-5 col-xl-3 col-12">
                                <span class="h1 text-uppercase">notes</span>
                                <textarea class="form-control" id="note" name="note" placeholder="Write note..."></textarea>
                            </div>
                                        
                                        <div class="col-xl-3 col-sm-12 col-md-12 mt-5">
                                            <button class="btn btn-primary px-5 py-3"  type="submit">Book Now</button>
                                        </div>
                                        
                        </form>
                            
                </div>
                    
            </div>
            </div>
        </div>
    </div>


      
@endsection
@section('javascript')


<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5wiiyExnsmv3Drg_dRs4oTyU8Ww7iihQ&libraries=places&callback=initMap&v=weekly" async > </script>
    
 <script>

$("#date").prop('min', new Date().toISOString().split("T")[0]);

function disable_slot(){
    var GivenDate = $("#selected_date").val();
    if(GivenDate){

        GivenDate = new Date(GivenDate);
    }else{

    GivenDate = new Date();
    }
    var CurrentDate = new Date();

    var givenYear = GivenDate.toLocaleString("default", { year: "numeric" });
    var givenMonth = GivenDate.toLocaleString("default", { month: "2-digit" });
    var givenDay = GivenDate.toLocaleString("default", { day: "2-digit" });

var currentYear = CurrentDate.toLocaleString("default", { year: "numeric" });
var currentMonth = CurrentDate.toLocaleString("default", { month: "2-digit" });
var currentDay = CurrentDate.toLocaleString("default", { day: "2-digit" });

var selectedDate = givenYear + "-" + givenMonth + "-" + givenDay;

var thisDate = currentYear + "-" + currentMonth + "-" + currentDay;

    console.log(selectedDate, thisDate);
    var html = "";
      
        html += '<div class="col-sm-12 col-xl-12 col-lg-12 col-md-12 my-5">';  
        html += '<span class="text-uppercase h1 font-h " style="font-weight: 500" >Select time slots</span>';
        html += '<div class="row font-ui  mt-3">';
        html += '<div class="col-lg-12">';
        html += '<div class="row timeslots">';

       
                        
        @foreach($data as $key=>$slot)
            
            if(selectedDate != thisDate) {

                html += '<div class="col-sm-12 col-md-6 col-lg-3 slots_list" id="selected{{$key}}">';
                html += '<div class="button">';
                html += '<label class="btn btn-default" for="a25" onclick="selected_slot(\'{{$slot['start']}}\',\'{{$key}}\');">{{$slot['start']}} - {{$slot['end']}}</label>';
                html += '</div>';
                html += '</div>';
            }else{

                @if((strtotime($slot['start']) - strtotime( date("h:i A"))  < 0)) 
                    html += '<div class="col-sm-12 col-md-6 col-lg-3 slots_list" id="selected{{$key}}">';
                    html += '<div class="button">';
                    html += '<label class="btn btn-default disabled" for="a25" >{{$slot['start']}} - {{$slot['end']}}</label>';
                    html += '</div>';
                    html += '</div>';
                @else 
                    html += '<div class="col-sm-12 col-md-6 col-lg-3 slots_list" id="selected{{$key}}">';
                    html += '<div class="button">';
                    html += '<label class="btn btn-default" for="a25" onclick="selected_slot(\'{{$slot['start']}}\',\'{{$key}}\');">{{$slot['start']}} - {{$slot['end']}}</label>';
                    html += '</div>';
                    html += '</div>';
                @endif
            }

        @endforeach
                            
        html += '</div>';
        html += '</div>';
        html += '<div class="col-sm-12">';
        html += '<span class="text-danger" id="time_errror"></span>';
        html += '</div>';
        html += '</div>';


        $('#slot').html(html);
}
    

    disable_slot();
    
    function validation(){
    

        var i = 1;
        $("#date_errror").html("");
        $("#time_errror").html("");
        $("#image_errror").html("");
        
        var $fileUpload = $("input[type='file']");
    
    	var GivenDate = $("#selected_date").val();
        var CurrentDate = new Date();
        GivenDate = new Date(GivenDate);
        
        if(new Date(GivenDate).toDateString() != new Date(CurrentDate).toDateString()){
        
            if(GivenDate < CurrentDate){
                i = 0;
                $("#date_errror").html("Please select curret date or above");
            }
        }
        
        if($("#selected_date").val() == ""){
        i = 0;
        $("#date_errror").html("please select date!");
        }
        
        if($("#selected_time").val() == ""){
            i = 0;
            $("#time_errror").html("please select time!");
        }
        
   	
        if (parseInt($fileUpload.get(0).files.length)>4){
        	
         	i = 0;
   		$("#image_errror").html("You can select max 4 images");
   		
        }
        
        if (parseInt($fileUpload.get(0).files.length) == 0){
        
         	i = 0;
   		$("#image_errror").html("Select images");
   		
        }
   	
   	
   	    if(i == 0){
    		return false;
    	}
    }
	
	function selected_slot(slot,id){
	
		$(".slots_list").removeClass('active');
		$("#selected_time").val(slot);
		$("#selected"+id).addClass('active');
		
	}
	
	function select_date(){
		$("#selected_date").val($("#date").val());    
        console.log($("#date").val());
        disable_slot();
	}


    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.

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

