@extends('frontend.layouts.main')
    @section('meta_data')
    @php
        $metadata = metaData('terms-condition');
        @endphp

        <meta name="title" content="{{ $metadata->title }}">
        <meta name="description" content="{{ $metadata->description }}">

        <meta property="og:image" content="{{ $metadata->image_url }}" />
        <meta property="og:site_name" content="{{ config('app.name') }}">
        <meta property="og:title" content="{{ $metadata->title }}">
        <meta property="og:url" content="{{url()->current()}}">
        <meta property="og:type" content="article">
        <meta property="og:description" content="{{ $metadata->description }}">

        <meta name=twitter:card content=summary_large_image />
        <meta name=twitter:site content="{{ config('app.name') }}" />
        <meta name=twitter:url content="{{url()->current()}}" />
        <meta name=twitter:title content="{{ $metadata->title }}" />
        <meta name=twitter:description content="{{ $metadata->description }}" />
        <meta name=twitter:image content="{{ $metadata->image_url }}" />
    @endsection
@section('css')
<style type="text/css">
   #footer {
      background: black;
      padding: 0 0 30px 0;
      color: #fff;
      font-size: 14px;
   }
   /* p{
      margin-bottom: 25px !important;
      font-size: 20px !important;
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
                    <li class="text-uppercase" aria-current="page">TERM AND CONDITIONS</li>
                </ol>
            </nav>
            <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">TERM AND CONDITIONS</h1>
        </div>
    </div>
</div>

<div class="container my-5">
<div class>{!! html_entity_decode($data) !!}</div>
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

