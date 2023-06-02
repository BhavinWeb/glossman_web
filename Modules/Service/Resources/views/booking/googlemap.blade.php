      @extends('admin.layouts.app')
      @section('title')
          {{ __('details') }}
      @endsection
      <style>
     #map {
              height: 500px;
              width: 100%;
          }
      </style>
      @section('content')
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-header">
                              <h3 class="card-title line-height-36">Google Map</h3>
                              <a href="{{ route('module.service.booking') }}"
                                  class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                      class="fas fa-arrow-left"></i>&nbsp;Back
                              </a>
                          </div>
                      </div>
                  </div>
              </div>  
              <div class="row">
                  <div class="card" style="width:100%">
                      <div class="col-sm-12" id="google_map" style="width:100%">
                      <div id="map"></div>
                      <div id="msg"></div>
                      </div>
                  </div>
              </div>   
          </div>
          <input type="hidden" id="current_address">

      @endsection

      @section('script')
      <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
      <script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap&key=AIzaSyA5wiiyExnsmv3Drg_dRs4oTyU8Ww7iihQ">
  </script>
          
       
      <script>

          var user_lattitude = {{$data['booking_details']['lattitude']}};
          var user_longitude = {{$data['booking_details']['longitude']}};
          var admin_lattitude = {{$data['address']->service_station_lat}};
          var admin_longitude = {{$data['address']->service_station_long}};
  		
        console.log(user_lattitude);
         console.log(user_longitude);
         console.log(admin_lattitude);
         console.log(admin_longitude);


    var routeDisplay = new function() {
      var self = this;
      // Variables
      self.directionsService;
      self.directionsRenderer;
      self.map;
      self.origin;
      self.destination;

      // Functions
      self.setup = function() {
        self.directionsService = new google.maps.DirectionsService();
        self.directionsRenderer = new google.maps.DirectionsRenderer({
          preserveViewport: true,
          suppressMarkers: true
        });
      }

      self.setMap = function(map) {
        self.map = map;
        self.directionsRenderer.setMap(map);
      }

      self.setPoints = function(origin, destination) {
        self.origin = origin;
        self.destination = destination;
      }

      self.render = function() {
        if (self.directionsRenderer.getMap() == null)
          self.directionsRenderer.setMap(self.map);

        self.directionsService.route({
          origin: self.origin,
          destination: self.destination,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            self.directionsRenderer.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }

      self.hide = function() {
        self.directionsRenderer.setMap(null);
      }

      self.show = function() {
        self.directionsRenderer.setMap(self.map);
      }

      self.toggleShow = function() {
        self.directionsRenderer.map = (self.directionsRenderer.getMap() == null) ?
          self.map : null;
      }

      self.isAlreadyRendered = function(origin, destination) {
        if (origin == self.origin && destination == self.destination) return true;
        return false;
      }
    }

        var map;
      let markers = [];
          
      function setMapOnAll(map) {
      console.log("marker",markers);
        for (let i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }


    function initMap() {
      var myLatLng = {
        lat:admin_lattitude,
        lng:admin_longitude
      };

      map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: myLatLng
      });
      
      var start = new google.maps.Marker({
        position: myLatLng,
        map: map,
        label: 'Driver Location'
      });

      var end = new google.maps.Marker({
        position: {
          lat: user_lattitude,
          lng: user_longitude
        },
        map: map,
        label: 'User location'
      });
      
        setTimeout(
      function() {

          var a = start.position;
        var b = end.position;
        if (routeDisplay.isAlreadyRendered(a, b)) routeDisplay.toggleShow();
        else {
          routeDisplay.setPoints(a, b);
          routeDisplay.render();
        }

      }, 1000);
      markers.push(start);

      const pusher = new Pusher("b127bea293c1e970540d", {
                      cluster: "ap2",
              });

              var channel = pusher.subscribe('current_location');
              var event_id = 'driver_location_'+'{{$data["booking_details"]["booking_id"]}}';
  			console.log(event_id);

      channel.bind(event_id, function (data) {
        	console.log("xcvxcvxcv");
          console.log(data);
        console.log(data.latitude);
        console.log(data.longitude);
        setMapOnAll(null);
          var latlng = new google.maps.LatLng(data.latitude, data.longitude);
          	var geocoder = new google.maps.Geocoder();
                  geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                      if (status == google.maps.GeocoderStatus.OK) {
                          if (results[1]) { 
                              //map.clear();
                               var start = new google.maps.Marker({
                          position: {
                              lat: Number(data.latitude),
                              lng: Number(data.longitude)
                          },
                          map: map,
                          label: 'Driver Location'
                          });
                           markers.push(start);

                          var a = start.position;
                          var b = end.position;
                         if (routeDisplay.isAlreadyRendered(a, b)) routeDisplay.toggleShow();
                          else {
                              routeDisplay.setPoints(a, b);
                              routeDisplay.render();
                          }
                      }
                  }
                  });

                  //const myLatLngs = { lat:parseInt(data.latitude), lng:parseInt(data.longitude) };
                  
        			//console.log(myLatLngs);
                  //marker=new google.maps.Marker({
                    //  position: myLatLngs,
                    //  map,
                    //  title: origin,
                  //});
                  //markers.push(marker);

      });

     // setInterval(myFunction, 5000);

      function myFunction(){
          console.log("asdasdasd");
          var getPosition = {
          enableHighAccuracy: false,
          timeout: 9000,
          maximumAge: 0
          };
          
          function success(gotPosition) {
          var uLat = gotPosition.coords.latitude;
          var uLon = gotPosition.coords.longitude;
          console.log(`${uLat}`, `${uLon}`);
          
          };

          function error(err) {
          console.warn(`ERROR(${err.code}): ${err.message}`);
          };

          navigator.geolocation.getCurrentPosition(success, error, getPosition)


      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function (p) {

              var LatLng = new google.maps.LatLng(p.coords.latitude, p.coords.longitude);

              latitude = p.coords.latitude;
              longitude = p.coords.longitude;
      
              var req_data = {
                      "longitude" :longitude,
                      "latitude" :latitude,
                      "event_name" :'{{$data['booking_details']['booking_id']}}',
                      "address" :"",
                  }

                  var myLatLng = {
                      lat:latitude,
                      lng:longitude
                  };
                  
                  
                  var start = new google.maps.Marker({
                      position: myLatLng,
                      map: map,
                      label: 'Driver Location'
                  });

              $.ajax({
              type:'GET',
              url:'/map_data',
              data:req_data,
              success:function(data) {
                  //   $("#msg").html(data.msg);
              }
              });
      
          });
          
      
      } else {
          alert('Geo Location feature is not supported in this browser.');
      }
      }

      routeDisplay.setup();
      routeDisplay.setMap(map);
    }

    

  </script>

      @endsection


