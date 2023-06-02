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
                <div id="map_canvas"></div>
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
                                    Order and Approved</h5>
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
                                    Picked for shipping</h5>
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
                                    Delivery</h5>
                                <p class="text-muted px-4 mb-2 font-ui fw-light"
                                   style="font-size: 25px;color: #2A2A2A!important;letter-spacing: 1px;">
                                   @if(!empty($data['order_status'][2]))
                                   {{date('M d, Y h:i A', strtotime($data['order_status'][2]->created_at))}}
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
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5wiiyExnsmv3Drg_dRs4oTyU8Ww7iihQ&libraries=places&callback=initMap&v=weekly" async > </script>
<!-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeOXqenQxwC7O_hguMgo8FzlE2Hn-CTy8&callback=initMap&v=weekly"
      defer
    ></script> -->
<script>
function initMap() {
const map = new google.maps.Map(document.getElementById("map"), {
    center: new google.maps.LatLng(21.2049, 72.8411),
    zoom: 15,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
});

const directionsService = new google.maps.DirectionsService();

directionsService.route(
    {
            origin: "{{$data['address']->address}}",
            destination: "{{$data['station_address']->service_station_address}}",
            travelMode: "DRIVING",
    },
    (response, status) => {
        if (status === "OK") {

            new google.maps.DirectionsRenderer({
                suppressMarkers: true,
                directions: response,
                map: map,
              });
        }
    }
)
}

window.initMap = initMap;

</script>
@endsection
