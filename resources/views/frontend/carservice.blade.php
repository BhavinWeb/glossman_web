@extends('frontend.layouts.main')
@section('css')
<style type="text/css">
       #footer {
      background: black;
      padding: 0 0 30px 0;
      color: #fff;
      font-size: 14px;
   }

   #navbarNav .active_header {
      border-bottom: 7px solid #A06AB9;
      margin-bottom: -35px;
      color: black !important;
   }
   .car_img{
    height: 285px;
   }
   @media only screen and (max-width: 600px) {
      .test_1 {
         padding-top: 38px;
      }
   }

   @media only screen and (max-width: 1200px) {
      #navbarNav .active_header {
         border-bottom: 7px solid #A06AB9;
         margin-bottom: -18px !important;
         color: black !important;
      }
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
                        <li class="text-uppercase" aria-current="page">Car Services</li>
                    </ol>
                </nav>
                <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">Car Services</h1>
            </div>
        </div>
    </div>
</div>

<section>
    <div class="container car_service_mobile d-flex flex-column gap-5">
        <h1 class="text-uppercase mt-5">Car Services</h1>
        <div class="row gx-5 gy-5 h6 mb-5">
            @foreach($services as $service)
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="d-flex flex-column gap-2">
                    <img src="{{asset($service->image)}}" class="car_img" alt="" />
                    <a href="{{route('service_details',['service_id' => $service->id])}}" class="btn btn-outline-light text-start text-uppercase fw-semibold text-dark">{{$service->name}}</a>
                </div>
            </div>
            @endforeach
        </div>
       
    </div>
</section>

@endsection
@section('javascript')
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
       // $("#featureCarousel").carousel({interval: false});
        //$("#featureCarousel").carousel("pause");
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
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(200);    // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200);   // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function() {      // When arrow is clicked
        $('body,html').animate({
            scrollTop : 0                       // Scroll to top of body
        }, 500);
    });
</script>
@endsection
