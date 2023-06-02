@extends('frontend.layouts.main')
@section('css')
<style type="text/css">
      #footer {
      background: black;
      padding: 0 0 30px 0;
      color: #fff;
      font-size: 14px;
      }
      @media (max-width: 767px)
        {
        .btn_top{
            margin-top: 6rem!important;
        }
    }
    .promotions-fontt {
    float: left!important;
    font-family: Poppins;
    font-weight: 400;
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
                        <li class="text-uppercase"><a href="index.html">Home</a></li>
                        <li class="text-uppercase px-4">|</li>
                        <li class="text-uppercase" aria-current="page">Promotions</li>
                    </ol>
                </nav>
                <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">Promotions</h1>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row my-3">
        @foreach($coupons as $coupon)
        <div class="col-12 col-md-6 mb-3">
            <div class="card">
                <img src="{{asset($coupon->image)}}" class="card-img-top" alt="..." />
                <div class="card-body">
                    <div class="float-start promotions-fontt">
                        <h5 class="card-title">{{$coupon->discount}} % OFF</h5>
                        <p class="card-text">
                            OFFER - Car Cleaning Products <br />
                            Offer Code: <span id="copycode{{$coupon->id}}">{{$coupon->code}}</span>
                        </p>
                    </div>
                    <div class="float-lg-end btn_top">
                        <button href="#" class="btn btn-primary px-5 py-2 px-5 py-2" onclick="copycode('{{$coupon->id}}');" title="Tooltip is visible!" data-toggle="tooltip">Copy code</button> <br>
                        <span class="copy_code_msg  d-none mt-3 text danger " id="code_msg{{$coupon->id}}">copied</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
@section('javascript')
<script>

	function copycode(id){
		 
		 navigator.clipboard.writeText($("#copycode"+id).html());
		 $("#code_msg"+id).removeClass('d-none');
		  setTimeout(function() {
			 $(".copy_code_msg").addClass('d-none');
		    }, 5000);
		
	}
	
	

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
        $("#featureCarousel").carousel({interval: false});
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
