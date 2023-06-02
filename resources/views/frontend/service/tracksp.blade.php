	@extends('frontend.layouts.main')
@section('css')
<style type="text/css">
    #footer {
        background: black;
        padding: 0 0 30px 0;
        color: #fff;
        font-size: 14px;
    }

    .timeline-icon.border.bg-primary::before {
        background: url("images/current_location.png");
        content: "";
        height: 80px;
        width: 80px;
        background-repeat: no-repeat;
        position: absolute;
        background-size: contain;
    }

    .timeline-with-icons {
        border-left: 1px solid hsl(0, 0%, 90%);
        position: relative;
        list-style: none;
    }

    .timeline-with-icons .timeline-item {
        position: relative;
        margin-bottom: 10%;

    }

    .timeline-with-icons .timeline-item:after {
        position: absolute;
        display: block;
        top: 0;
    }

    .timeline-with-icons .timeline-icon {
        border: 2px solid #dee2e6 !important;
        left: -22px;
        /* background-color: hsl(217, 88.2%, 90%); */
        color: hsl(217, 88.8%, 35.1%);
        border-radius: 50%;
        height: 40px;
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    #map {
        height: 700px;
        width: 100%;
        background: url("images/map.png");
    }

    .vertical-center {
        display: flex;
        align-items: center;
        min-height: 100vh;
    }

</style>
@endsection
@section('content')

  <div id="footer" style="padding-bottom: 0;">
        <div class="container clearfix">
            <div class="common-breadcrumbs gap-2 d-flex flex-column">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb h7">
                        <li class="text-uppercase"><a href="#">HOME</a></li>
                        <li class="text-uppercase px-4">|</li>
                        <li class="text-uppercase" aria-current="page">Track SP</li>
                    </ol>
                </nav>
                <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">Track SP</h1>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row my-5">
            <div class="col-sm-12">
                <h1 class="mb-4" style="font-weight: 500!important">Billing Details</h1>
                <div id="map"></div>
            </div>
            <div>

                <div class="mt-5">
               
                    <span class="h1 fw-bold">Track SP</span>
                </div>
                <!-- Section: Timeline -->
                <section class="py-5 mx-5">
                    <ul class="timeline-with-icons">
                      <li class="timeline-item d-flex flex-row">
                            @if(!empty($data['order_status'][0]))
                                <span class="timeline-icon border sdf  bg-primary">
                                </span>
                                @else
                                
                                <span class="timeline-icon border sdff bg-white">
                                </span>
                                
                            @endif
                            <div class="d-flex gap-2 flex-column justify-content-start">
                                <h5 class="px-4 font-ui fw-light"
                                    style="font-size: 20px;color: #2A2A2A ;letter-spacing: 1px;">
                                    Service Order Pending</h5>
                                <p class="text-muted px-4 mb-2 font-ui fw-light"
                                   style="font-size: 25px;color: #2A2A2A!important;letter-spacing: 1px;">
                                   @if(!empty($data['order_status'][0]))
                                        {{date('M d, Y h:i A', strtotime($data['order_status'][0]->created_at))}}
                                    @endif</p>
                            </div>
                        </li>
                     <li class="timeline-item d-flex flex-row">
                            @if(!empty($data['order_status'][1]))
                                <span class="timeline-icon border sdf  bg-primary">
                                </span>
                                @else
                                
                                <span class="timeline-icon border sdff bg-white">
                                </span>
                                
                            @endif
                            <div class="d-flex gap-2 flex-column justify-content-start">
                                <h5 class="px-4 font-ui fw-light"
                                    style="font-size: 20px;color: #2A2A2A ;letter-spacing: 1px;">
                                    Service Order Accept</h5>
                                <p class="text-muted px-4 mb-2 font-ui fw-light"
                                   style="font-size: 25px;color: #2A2A2A!important;letter-spacing: 1px;">
                                   @if(!empty($data['order_status'][1]))
                                        {{date('M d, Y h:i A', strtotime($data['order_status'][1]->created_at))}}
                                    @endif</p>
                            </div>
                        </li>
                        
                          <li class="timeline-item d-flex flex-row">
                            @if(!empty($data['order_status'][2]))
                                <span class="timeline-icon border sdf  bg-primary">
                                </span>
                                @else
                                
                                <span class="timeline-icon border sdff bg-white">
                                </span>
                                
                            @endif
                            <div class="d-flex gap-2 flex-column justify-content-start">
                                <h5 class="px-4 font-ui fw-light"
                                    style="font-size: 20px;color: #2A2A2A ;letter-spacing: 1px;">
                                    SP On the way</h5>
                                <p class="text-muted px-4 mb-2 font-ui fw-light"
                                   style="font-size: 25px;color: #2A2A2A!important;letter-spacing: 1px;">
                                   @if(!empty($data['order_status'][2]))
                                        {{date('M d, Y h:i A', strtotime($data['order_status'][2]->created_at))}}
                                    @endif</p>
                            </div>
                        </li>
                        
                           
                        
                            <li class="timeline-item d-flex flex-row">
                            @if(!empty($data['order_status'][3]))
                                <span class="timeline-icon border sdf  bg-primary">
                                </span>
                                @else
                                
                                <span class="timeline-icon border sdff bg-white">
                                </span>
                                
                            @endif
                            <div class="d-flex gap-2 flex-column justify-content-start">
                                <h5 class="px-4 font-ui fw-light"
                                    style="font-size: 20px;color: #2A2A2A ;letter-spacing: 1px;">
                                   Work finished</h5>
                                <p class="text-muted px-4 mb-2 font-ui fw-light"
                                   style="font-size: 25px;color: #2A2A2A!important;letter-spacing: 1px;">
                                   @if(!empty($data['order_status'][3]))
                                        {{date('M d, Y h:i A', strtotime($data['order_status'][3]->created_at))}}
                                    @endif</p>
                            </div>
                        </li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
    
@endsection
@section('javascript')
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap&key=AIzaSyA5wiiyExnsmv3Drg_dRs4oTyU8Ww7iihQ">
</script>

    
<script>

        var user_lattitude = {{$data['booking_details']['lattitude']}};
        var user_longitude = {{$data['booking_details']['longitude']}};
        var admin_lattitude = {{$data['station_address']->service_station_lat}};
        var admin_longitude = {{$data['station_address']->service_station_long}};



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

    markers.push(start);


    const pusher = new Pusher("b127bea293c1e970540d", {
                    cluster: "ap2",
            });

            var channel = pusher.subscribe('current_location');
            var event_id = 'driver_location_'+'{{$data["booking_details"]["booking_id"]}}';

	console.log(event_id);
    channel.bind(event_id, function (data) {
        
        var latlng = new google.maps.LatLng(data.latitude, data.longitude);
         setMapOnAll(null);
        var geocoder = geocoder = new google.maps.Geocoder();
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

                const myLatLng = { lat:parseInt(data.latitude), lng:parseInt(data.longitude) };
                setMapOnAll(null);
                marker=new google.maps.Marker({
                    position: myLatLng,
                    map,
                    title: origin,
                });
                
                markers.push(marker);

    });

    routeDisplay.setup();
    routeDisplay.setMap(map);
  }
</script>

@endsection

