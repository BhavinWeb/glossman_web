@extends('frontend.layouts.main')
@section('css')
<style type="text/css">
    html, body {
        overflow-x: hidden !important;
    }
   
    #footer {
        background: black;
        padding: 0 0 30px 0;
        color: #fff;
        font-size: 14px;
    }

    .product-img-height {
        width: 294px;
        height: 270px;
        margin-left: auto;
        margin-right: auto;
    }

    .font-30px-semibold {
        font-size: 25px;
        font-weight: 500;
    }

    .car_service .content {
        /* width: 100px; */
        padding: 6%;
    }

    .text-left {
        text-align: left !important;
    }

    .car_service .content img {
        width: 100%;
    }

    .product_category_css img {
        border: 1px solid rgb(14, 1, 1);
        width: 95%;
        height: 270px;
    }

    .btn-outline-light {
        border-left: 3px solid rgb(160, 106, 185) !important;
        margin-top: 0px !important;
    }

    .product_category_css button {
        margin-top: 17px !important;
        margin-bottom: 26px;
    }

    .product_category_css a {
        color: black !important;
    }


</style>
@endsection
@section('content')
<div id="footer" style="padding-bottom: 0;">
    <div class="container clearfix">
        <div class="common-breadcrumbs gap-2 d-flex flex-column">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb h7">
                    <li class="text-uppercase">
                        <a href="#">HOME</a>
                    </li>
                    <li class="text-uppercase px-4">|</li>
                    <li class="text-uppercase" aria-current="page">Product Categories</li>
                </ol>
            </nav>
            <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">Product Categories</h1>
        </div>
    </div>
</div>

<div class="container text-uppercase my-5 d-flex flex-column gap-5">
    <h1 class="text-uppercase" style="font-weight: 600; margin-bottom: -20px; margin-top: 20px;">CHOOSE PRODUCT CATEGORIES</h1>
    <div class="row g-5 h6">
        @foreach($products as $product)
        <div class="col-md-6 col-xl-4">
            <div class="d-flex flex-column gap-3">
                <div class="border border-secondary d-flex justify-content-center py-5" style="height: 300px;">
                    <img src="{{asset($product->image)}}" alt="" class="h-100" />
                </div>
                <a href="{{URL::to('product-list/'.$product->id)}}" class="btn btn-outline-light text-start text-uppercase fw-semibold text-dark">
                    {{$product->name}}
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>


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
        //$("#featureCarousel").carousel({interval: false});
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
