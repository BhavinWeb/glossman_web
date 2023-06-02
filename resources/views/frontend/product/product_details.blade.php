@extends('frontend.layouts.main')
@section('css')
<style type="text/css">
         .rate {
         float: left;
         height: 46px;
         padding: 0 10px;
         }
         .rate:not(:checked) > input {
         position:absolute;
         display: none;
         }
         .rate:not(:checked) > label {
         float:right;
         width:1em;
         overflow:hidden;
         white-space:nowrap;
         cursor:pointer;
         font-size:30px;
         color:#ccc;
         }
         .rated:not(:checked) > label {
         float:right;
         width:1em;
         overflow:hidden;
         white-space:nowrap;
         cursor:pointer;
         font-size:30px;
         color:#ccc;
         }
         .rate:not(:checked) > label:before {
         content: '★ ';
         }
         .rate > input:checked ~ label {
         color: #ffc700;
         }
         .rate:not(:checked) > label:hover,
         .rate:not(:checked) > label:hover ~ label {
         color: #deb217;
         }
         .rate > input:checked + label:hover,
         .rate > input:checked + label:hover ~ label,
         .rate > input:checked ~ label:hover,
         .rate > input:checked ~ label:hover ~ label,
         .rate > label:hover ~ input:checked ~ label {
         color: #c59b08;
         }
         .star-rating-complete{
            color: #c59b08;
         }
         .rating-container .form-control:hover, .rating-container .form-control:focus{
         background: #fff;
         border: 1px solid #ced4da;
         }
         .rating-container textarea:focus, .rating-container input:focus {
         color: #000;
         }
         .rated {
         float: left;
         height: 46px;
         padding: 0 10px;
         }
         .rated:not(:checked) > input {
         position:absolute;
         display: none;
         }
         .rated:not(:checked) > label {
         float:right;
         width:1em;
         overflow:hidden;
         white-space:nowrap;
         cursor:pointer;
         font-size:30px;
         color:#ffc700;
         }
         .rated:not(:checked) > label:before {
         content: '★ ';
         }
         .rated > input:checked ~ label {
         color: #ffc700;
         }
         .rated:not(:checked) > label:hover,
         .rated:not(:checked) > label:hover ~ label {
         color: #deb217;
         }
         .rated > input:checked + label:hover,
         .rated > input:checked + label:hover ~ label,
         .rated > input:checked ~ label:hover,
         .rated > input:checked ~ label:hover ~ label,
         .rated > label:hover ~ input:checked ~ label {
         color: #c59b08;
         }
    ul li {
        padding-left: 10px;
    }
    .pd_image {
        width: 30%;
    }
    .carousel-control-prev {
        position: relative;
        width: 8% !important;
    }
    .carousel-control-prev {
        left: 84%;
    }
    .carousel-control-next {
        position: relative;
        width: 8% !important;
    }
    .carousel-control-next {
        left: 84%;
    }
    @media (max-width: 767px) {
        .carousel-control-prev {
            position: relative;
        }
        .carousel-control-prev {
            left: 64%;
        }
        .carousel-control-next {
            position: relative;
        }
        .carousel-control-next {
            left: 66%;
        }
    }
    .carousel-control-next-icon {
        font-family: FontAwesome;
        content: "\f061";
        color: #110202;
        font-weight: 900;
    }
    .carousel-control-prev-icon {
        font-family: FontAwesome;
        content: "\f060";
        color: #110202;
        font-weight: 900;
    }
    @media (max-width: 767px) {
        .carousel-inner .carousel-item > div {
            display: none;
        }
        .carousel-inner .carousel-item > div:first-child {
            display: block;
        }
    }
    .carousel-inner .carousel-item.active,
    .carousel-inner .carousel-item-next,
    .carousel-inner .carousel-item-prev {
        display: flex;
        color: #080606;
    }
    /* medium and up screens */
    @media (min-width: 768px) {
        .carousel-inner .carousel-item-end.active,
        .carousel-inner .carousel-item-next {
            transform: translateX(25%);
        }
        .carousel-inner .carousel-item-start.active,
        .carousel-inner .carousel-item-prev {
            transform: translateX(-25%);
        }
    }
    .carousel-inner .carousel-item-end,
    .carousel-inner .carousel-item-start {
        transform: translateX(0);
    }
    /* smiliar_slider */
    .products-card .active svg {
        margin: 7px;
        color: #ffffff !important;
        margin-top: 8px;
    }
    .products-card svg {
        margin: 7px;
        color: #110202;
        margin-top: 8px;
    }
    .products-card {
        padding: 10px !important;
        position: relative;
    }
    .products-card img {
        width: 100%;
        border: 2px solid #c3b4b4;
        margin-bottom: 14px;
    }
    .products-card .active {
        background: #a06ab9;
    }
    .heart_icon {
        border: 0px solid black;

        border-radius: 50px;
        position: absolute;
        right: 0;
        margin-right: 7%;
        margin-top: 3%;

        padding: 8px;
        font-size: 17px;

        background: #a06ab9;
    }

    .heart_icon i {
        -webkit-text-stroke-color: #fffdfd !important;
        -webkit-text-stroke-width: 1px !important;
        color: #a06ab9 !important;
    }
    .heart_icon:hover {
        cursor: pointer;
    }
    .products-card .active svg {
        margin: 7px;
        color: #ffffff !important;
        margin-top: 8px;
    }
    .products-card svg {
        margin: 7px;
        color: #110202;
        margin-top: 8px;
    }
    .products-card .active {
        background: #a06ab9;
    }
    /* endsimilar_slider */
    .car_service .content {
        /* width: 100px; */
        padding: 6%;
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
    }
    .product_category_css button {
        margin-top: 17px !important;
        margin-bottom: 26px;
    }
    .normal_box_padding {
        padding: 20px;
    }
    .slider_image {
        /* padding: 20px; */
        padding-top: 20px;
    }
    .slider_image img {
        width: 100%;
        border: 1px solid rgb(14, 1, 1);
    }
    .boostrap_toggle button {
        border: white;
        background: white;
        font-size: 39px;
        color: #a9a9a9;
        font-weight: 600;
    }
    .button_heading {
        border: white;
        background: white;
        font-size: 39px;
    }
    .authorDetails .avatar {
        display: inline-block;
        width: 80px;
        height: 72px;
        margin: 0 0 0 5px;
        font-size: 50px;
    }
    .textWrapper {
        display: inline-block;
        vertical-align: middle;
        text-align: left;
        line-height: 11px;
        margin-top: -18px;
    }
    .recommended_css {
        font-size: 30px;
        font-weight: 500;
    }
    .review_filter li {
        float: left;
        padding-right: 20px;
        margin-bottom: 15px;
    }
    .review_filter li button {
        /* border: 1px solid; */
        padding: 7px 40px 7px 40px;
        border-radius: 0px;
    }
    .review_filter li .activate {
        padding: 7px 40px 7px 40px !important;
        border-radius: 0px !important;
        background-color: #5668d5 !important;
        color: white !important;
    }
    .review_text {
        padding-left: 20px;
        padding-top: 40px;
    }
    .helpfull_review_button svg:hover {
        cursor: pointer;
    }
    @media only screen and (max-width: 600px) {
        .review_user {
            width: 26% !important;
        }
        .quantity {
            width: 15% !important;
        }
    }
    .css-3zzxgd {
        width: 50%;
        list-style-type: none;
        padding: 0;
    }
    .css-s6g0ch {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-align-items: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        margin-top: 4px;
    }
    .css-rhg0qe {
        -webkit-flex: 0 0 50px;
        -ms-flex: 0 0 50px;
        flex: 0 0 106px;
        margin-right: 8px;
    }
    .css-15muezf {
        -webkit-flex: 0 0 170px;
        -ms-flex: 0 0 170px;
        flex: 0 0 170px;
        height: 12px;
        position: relative;
        margin-right: 16px;
        margin-top: 4px;
    }
    .css-44ae0f {
        content: "";
        top: 0;
        left: 0;
        width: 100%;
        position: absolute;
        height: 10px;
        background: #eaeaea;
    }
    .css-1byssb4 {
        content: "";
        top: 0;
        left: 0;
        position: absolute;
        height: 10px;
        background: #ffc057;
        display: block;
        width: {{$product_details['star_5']}}%;
    }
    .css-9zd2pu {
        -webkit-flex: 0px 0px 112px;
        -ms-flex: 0px 0px 112px;
        flex: 0px 0px 112px;
        margin-top: -2px;
        margin-left: -5px;
    }
    .css-1j071wf {
        color: #1f1f1f;
        letter-spacing: 0;
        font-size: 1rem;
        line-height: 1.5rem;
        font-family: "Source Sans Pro", Arial, sans-serif;
        font-weight: 400;
    }
    .button_cursor:hover {
        cursor: pointer !important;
    }
    /* Position the image container (needed to position the left and right arrows) */
    .container {
        position: relative;
    }
    /* Hide the images by default */
    .mySlides {
        display: none;
    }
    /* Add a pointer when hovering over the thumbnail images */
    .cursor {
        cursor: pointer;
    }
    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 40%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }
    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }
    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }
    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
    }
    /* Container for image text */
    .caption-container {
        text-align: center;
        background-color: #222;
        padding: 2px 16px;
        color: white;
    }
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
    /* Six columns side by side */
    .column {
        float: left;
        width: auto;
        margin-bottom: 15px;
    }
    /* Add a transparency effect for thumnbail images */
    .demo {
        opacity: 0.6;
    }
    .active,
    .demo:hover {
        opacity: 1;
    }
    .filter-css .cursor {
        border: 1px solid black !important;
        text-align: center;
        height: 74px;
    }
    .filter-css .active {
        background: linear-gradient(to right, #5668d5 0%, #a06ab9 100%) !important;
    }
    .product-image {
        margin: 0 auto;
        text-align: center;
        display: block;
    }
    .show_details {
        font-weight: 800;
        color: black !important;
    }
    .bg-info {
        background-color: yellow !important;
    }

    .liked_product {
        color: red !important;
        -webkit-text-stroke-color: #ffffff !important;
    }
    .heart_icons {
        -webkit-text-stroke-color: #000000;
        -webkit-text-stroke-width: 1px;
        color: #ffffff;
    }
    .heart_icon .active {
        border: white !important;
        color: white !important;
    }
    .heart_icon i {
        -webkit-text-stroke-color: #fffdfd !important;
        -webkit-text-stroke-width: 1px !important;
        color: #a06ab9 !important;
    }

    .rating {
        width: 226px;
        margin: 0 auto 1em;
        font-size: 45px;
        overflow: hidden;
    }
    .rating input {
        float: right;
        opacity: 0;
        position: absolute;
    }
    .rating a,
    .rating label {
        float: right;
        color: #aaa;
        text-decoration: none;
        -webkit-transition: color 0.4s;
        -moz-transition: color 0.4s;
        -o-transition: color 0.4s;
        transition: color 0.4s;
    }
    .rating label:hover ~ label,
    .rating input:focus ~ label,
    .rating label:hover,
    .rating a:hover,
    .rating a:hover ~ a,
    .rating a:focus,
    .rating a:focus ~ a {
        color: orange;
        cursor: pointer;
    }
    .rating2 {
        direction: rtl;
    }
    .rating2 a {
        float: none;
    }

    .fa-solid {
        color: rgb(255, 208, 66) !important;
    }

    .fa-star {
        color: #767272;
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
                    <li class="text-uppercase" aria-current="page">Details</li>
                </ol>
                </nav>
                <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">Details</h1>
            </div>
        </div>
    </div>
</div>
<div class="mt-5">
   <div class="container">
      <div class="row mt-3 filter-css mb-3">
         <div class="col-sm-12 col-md-12 col-xl-6">
            <div class="main-product" style="height: 51%;">
               @if (!empty($product_details['galleries']))
               @foreach ($product_details['galleries'] as $galleries)
               <div class="mySlides" style="display: block; border: 2px solid #000; margin-bottom: 13px;"
                  style="height: 51%;">
                  <div class="numbertext">1 / 6</div>
                  <img class="mx-auto product-image" src="{{ $galleries['image_url'] }}"
                     style="width:100%;" />
               </div>
               @endforeach
               @endif
               <!-- <div class="caption-container">
                  <p id="caption"></p>
                  </div> -->
               <div class="row">
                  @php
                  $i = 1;
                  @endphp
                  @if (!empty($product_details['galleries']))
                  @foreach ($product_details['galleries'] as $galleries_data)
                  <div class="column">
                     <img class="demo cursor" src="{{ $galleries_data['image_url'] }}"
                        style="width: 100%;" onclick="currentSlide({{ $i }})"
                        alt="The Woods" />
                  </div>
                  @php
                  $i++;
                  @endphp
                  @endforeach
                  @endif
               </div>
            </div>
         </div>
         <div class="col-sm-12 col-md-12 col-xl-6 mt-4 pr-5" style="padding-left:40px;">
            <div style="float: right;">
            @php
            	if($product_details['liked']){
            		$liked = "liked_product";
            	}else{
            		$liked = "";
            	}
            @endphp
            
           <i class="fa fa-heart {{$liked}} heart_icons" style="font-size:48px;" id="product_like" onclick="favourite_actions({{ $product_details['product_id'] }})"></i>
              <a class="fbtn share facebook" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}"> <i class="fa fa-share-alt" style="font-size:48px;-webkit-text-stroke-color: #000000;
    -webkit-text-stroke-width: 1px;
    color:#ffffff;"></i></a> 
               
            </div>
            <div class="" style="">
               <h1 class="h1-title-head">{{ $product_details['title'] }}</h1>
            </div>
            <div class="mt-2 d-flex align-items-center" style="font-family:Poppins; padding-top: 20px;
               padding-bottom: 20px;">
               <svg xmlns="http://www.w3.org/2000/svg" width="21.505" height="21.505"
                  viewBox="281.905 1968 21.505 21.505">
                  <path
                     d="M286.311 1989.505c-.093 0-.187 0-.28-.1-.188-.1-.188-.298-.188-.497l1.875-7.368-5.625-4.878c-.188-.1-.188-.299-.188-.498a.512.512 0 0 1 .469-.299l7.312-.398 2.625-7.168c.094-.399.75-.399.844 0l2.625 7.168 7.219.398c.187 0 .375.1.375.299.093.2 0 .398-.188.498l-5.719 4.779 1.875 7.367c.094.2 0 .398-.187.498-.188.1-.375.1-.563 0l-5.906-4.082-6.093 4.181c-.094 0-.188.1-.282.1Z"
                     fill="#ffd042" fill-rule="evenodd" data-name="Path 19" />
               </svg>
               <span style="font-size: 20px; padding-left:20px;">{{$product_details['avg_rating']}}
               ({{ $product_details['total_ratings'] }})</span>
            </div>
            <div class="mt-4"><span style="font-size: 20px; font-family:Poppins;">Availability</span>
               @if ($product_details['in_stock'] == 0)
               <button class="btn"
                  style="border: 1px solid red; margin-left: 20px; color: red;  border-radius: 0px; font-family:'Poppins'; padding: 10px 40px;  line-height: 24px;">Out
               of stock</button>
            </div>
            @else
            <button class="btn"
               style="border: 1px solid #5668d5; margin-left: 20px; color: #5668d5;  border-radius: 0px; font-family:'Poppins'; padding: 10px 40px;  line-height: 24px;">In
            stock</button>
         </div>
         @endif
         <div class="mt-4">
            <span
               style="font-weight:600; letter-spacing: 2.6px; font-size: 50px;">{{$product_details['currency']}} {{$product_details['price']}}</span>
         </div>
         
          @if ($product_details['in_stock'] != 0)
          @php
		if($product_details['product_quantity'] == 0){
		$product_qua = 1;	
		}else{
			$product_qua = $product_details['product_quantity'];
		}
	

	  @endphp
         <div class="mt-4">
            <div class="col-sm-12 center-block">
               <br />
               <p style="font-family:Poppins;">
                  Qty.
                  <span class="">
                  <input type="text" class="quantity" id="quantity" value="{{$product_qua}}" placeholder="0" onkeyup="cartCheck();" />
                  <button type="button" class=" cart" onclick="addToCart();"
                     name="submit" id="submit"
                     style="font-family: 'Oxanium';
                     letter-spacing: 2.2px;">
                  	ADD TO CART
                  </button>
                  </span>
                  <br>
                  <span id="quantity_error" class="d-none">Out of stock</span>
               </p>
               <br />
            </div>
            
         </div>
         @endif
      </div>
      <div class="col-sm-12 mt-5 boostrap_toggle "><button onclick="showProductDetail(1);" id="description_toggle"
         class="show_details">Description</button>
         <button onclick="showProductDetail(0);" id="customer_review_toggle">Customer Reviews</button>
      </div>
      <div class="col-sm-12 mt-2 " id="multiCollapseExample1">
         {!! $product_details['details'] !!}
         <button class="button_heading" style="font-weight:700;">Features</button>
         {!! $product_details['features'] !!}
      </div>
      <div class="col-sm-12 mt-2 d-none" id="multiCollapseExample2">
         <div class="row">
            <div class="col-sm-12 col-md-6">
               <div class="authorDetails">
                  <a href="/Profile/13113142" target="_blank" class="avatar text-dark">
                  {{ $product_details['avg_rating'] }}
                  </a>
                  <div class="textWrapper">
                     <p class="date" data-date="3/16/2019 3:29:37 PM">Average Rating</p>
                     @if($product_details['avg_rating'] >= 1)
                      <i class="fa-solid fa-star"></i>
		     @else
		      <i class="fa fa-star"></i>
		    @endif
		    @if($product_details['avg_rating'] > 1 )
                      <i class="fa-solid fa-star"></i>
		     @else
		      <i class="fa fa-star"></i>
		    @endif
		    @if($product_details['avg_rating'] > 2 )
                      <i class="fa-solid fa-star"></i>
		     @else
		      <i class="fa fa-star"></i>
		    @endif
		    @if($product_details['avg_rating'] > 3 )
                      <i class="fa-solid fa-star"></i>
		     @else
		      <i class="fa fa-star"></i>
		    @endif
		    @if($product_details['avg_rating'] > 4)
                      <i class="fa-solid fa-star"></i>
		     @else
		      <i class="fa fa-star"></i>
		    @endif
                 
                    
                     <span style="padding-left: 10px;">( {{$product_details['total_ratings']}} Reviews )</span>
                  </div>
               </div>
            </div>
            @if(Auth::check())
            
            	<div class="col-sm-12 col-md-6" style="line-height: 11px;">
               <button class="btn btn-primary"  type="button"  class="btn common_submit_button text-uppercase" style="font-size: 14px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add reviews</button>
            </div>
            @else
            
            <div class="col-sm-12 col-md-6" style="line-height: 11px;">
               <div style="padding-top: 19px;">
                  <p>Submit Your Review</p>
               </div>
               <div>
                  <p>You must be <a href="{{route('signin')}}" class="text-white">logged</a> in to post a review.</p>
               </div>
            </div>
            @endif
            <div class="col-sm-12 mt-4 recommended_css"><span style="font-weight: 700;">{{$product_details['avg_rating']}}</span><span
               style="padding-left: 31px; font-size: 22px;">Recommended (0 of 1)</span></div>
                <div class="col-sm-12">

                    <div class="d-flex flex-column gap-3 font-ui">

                        <div class="d-flex flex-row gap-3 align-items-center" style="height: 45px;">
                            <div style="font-size: 18px;" class="">
                                <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="w-50 h-auto">
                                <div class="progress" style="height: 10px;width: 400px">
                                    <div class="progress-bar bg-info" role="progressbar" aria-label="Info example"
                                         style="width: {{$product_details['star_5']}}%" aria-valuenow="50" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row gap-3 align-items-center"  style="height: 45px;">
                            <div  style="font-size: 18px;" class="">
                                 <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa fa-star"></i>
                            </div>
                            <div class="w-50 h-auto">
                                <div class="progress" style="height: 10px;width: 400px;">
                                    <div class="progress-bar bg-info" role="progressbar" aria-label="Info example"
                                         style="width: {{$product_details['star_4']}}%" aria-valuenow="50" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row gap-3 align-items-center"  style="height: 45px;">
                            <div  style="font-size: 18px;" class="">
                                <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </div>
                            <div class="w-50 h-auto">
                                <div class="progress" style="height: 10px;width: 400px;">
                                    <div class="progress-bar bg-info" role="progressbar" aria-label="Info example"
                                         style="width: {{$product_details['star_3']}}%" aria-valuenow="50" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row gap-3 align-items-center"  style="height: 45px;">
                            <div  style="font-size: 18px;" class="">
                                 <i class="fa-solid fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </div>
                            <div class="w-50 h-auto">
                                <div class="progress" style="height: 10px;width: 400px;">
                                    <div class="progress-bar bg-info" role="progressbar" aria-label="Info example"
                                         style="width: {{$product_details['star_2']}}%" aria-valuenow="50" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row gap-3 align-items-center"  style="height: 45px;">
                            <div  style="font-size: 18px;" class="">
                                 <i class="fa-solid fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </div>
                            <div class="w-50 h-auto">
                                <div class="progress" style="height: 10px;width: 400px;">
                                    <div class="progress-bar bg-info" role="progressbar" aria-label="Info example"
                                         style="width: {{$product_details['star_1']}}%" aria-valuenow="50" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <div class="col-sm-12 mt-4">
               <ul class="review_filter">
                  <li><button class="btn btn-sm activate" id="active_1" onclick="Set_filter(1);">Show
                     All</button>
                  </li>
                  <li><button class="btn btn-sm" id="active_2" onclick="Set_filter(2);">Most Helpful
                     Positive</button>
                  </li>
                  <li><button class="btn btn-sm" id="active_3" onclick="Set_filter(3);">Most Helpful
                     Negative</button>
                  </li>
                  <li><button class="btn btn-sm" id="active_4" onclick="Set_filter(4);">Highest
                     Rating</button>
                  </li>
                  <li><button class="btn btn-sm" id="active_5" onclick="Set_filter(5);">Lowest Rating</button>
                  </li>
               </ul>
            </div>
            <div class="row review_1 mt-3 mb-5 comment_list" id="remove_list">
            </div>
            <div class="row review_1 mt-3 mb-5 empty_data" id="remove_list">
            <div class="col-sm-12 text-center"><h3>No Review Found!</h3></div>
            </div>
            <div class="row review_1 mt-3 mb-5 " id="remove_list">
            <button class="btn btn-primary d-none"  id="loadmore">Load More</button>
            </div>
            
         </div>
      </div>
   </div>
   <button class="button_heading" style="font-weight:700;">SIMILAR PRODUCTS</button>
   <div class="row mx-auto my-auto justify-content-center pb-5">
      <div id="recipeCarousel" class="carousel slide custom-details" data-bs-ride="carousel">
         <div class="row">
            <a class="carousel-control-prev w-aut" href="#recipeCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true">
            <i style="font-size: 24px;" class="fas">&#xf060;</i>
            </span>
            </a>
            <a class="carousel-control-next w-aut" href="#recipeCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true">
            <i style="font-size: 24px; margin-right: 27px;" class="fas">&#xf061;</i>
            </span>
            </a>
         </div>
         <div class="carousel-inner" role="listbox">
		@php $sr = 1; $count = $similar_products->count(); @endphp
            @foreach ($similar_products as $sim_data)
            <div class="carousel-item {{ $sr == 1 ? 'active' : '' }}">
               <div class="col-sm-12 col-md-6 col-xl-3">
                  <div class="products-card">
                 <div class="heart_icon "  onclick="favourite_action({{$sim_data->product_id}});">
                    @if($sim_data->liked)
                        <i class="fa fa-heart active active_{{$sim_data->product_id}}" id="active_{{$sim_data->product_id}}"></i></button>
                        @else
                         <i class="fa fa-heart active_{{$sim_data->product_id}}" id="active_{{$sim_data->product_id}}"></i></button>
                       @endif
                    </div>
                     <a href="{{ route('product_details', ['id' => $sim_data->product_id]) }}"  class="text-dark popins_family">
                     <img src="{{ $sim_data->image_url }}" alt="" style="height: 68%;" />
                     </a>
                     <span
                        style="font-family:'Poppins';font-size: 16px;"> <a href="{{ route('product_details', ['id' => $sim_data->product_id]) }}"  class="text-dark popins_family">{{ \Illuminate\Support\Str::limit($sim_data->product_name, $limit = 25, $end = '...') }}</a></span>
                     <div style="font-size: 26px;">
                        <span style="float: left; color: #5668d5; ">{{ $sim_data->currency }} {{ $sim_data->sale_price }}</span>
                         @if($sim_data->product_rating > "0")
                        <span style="float: right;">
                           <svg style="margin-top: 1px; color: #ffc400;"
                              xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                              fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                              <path
                                 d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                           </svg>
                            {{ $sim_data->product_rating }}
                        </span>
                         
                        @endif
                     </div>
                  </div>
               </div>
            </div>
            @php
            $sr++;
            @endphp
            @endforeach
         </div>
      </div>
   </div>
</div>
</div>


<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content give-rating-model-main">
            <div class="modal-header" style="border-bottom-color: white!important;">
                <h5 class="modal-title" id="staticBackdropLabel"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></h5>

            </div>
            <div class="modal-body give-rating-model" style="">
                <div class="row" style="">
                    <div class="col-sm-12 text-center" style="">
                    <h2>Give Rating</h2>
                    <div class="form-group row">
                        <div class="col">
                            <div class="rate">
                                <input type="radio" id="star5" class="rate" onclick="store_rating(5)"/>
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio"  id="star4" class="rate" onclick="store_rating(4)"/>
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" class="rate"onclick="store_rating(3)"/>
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" class="rate"onclick="store_rating(2)"/>
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" class="rate" onclick="store_rating(1)"/>
                                <label for="star1" title="text">1 star</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <div class="col">
                        
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" ></textarea>
                            
                        </div>
                    </div>
                    <div class="col-sm-12 mt-4 text-center">
                            <button class="btn common_submit_button" type="button" onclick="add_reviews();">+ SUBMIT</button>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('javascript')
<script>



$('#quantity').keypress(function (e) {    
    
                var charCode = (e.which) ? e.which : event.keyCode    
    
                if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    
                    return false;                        
    
            });

function helpfunction(e){

	var review_id = e.getAttribute('data-id');
	var type = 1;
	var pro_id = "{{$product_details['product_id']}}";
	var review_type = e.getAttribute('data-type');
	   var formData = {
            product_id: pro_id,
            type:type,
            review_id:review_id,
            review_type:review_type,
        };
        
        var type = "GET";
        var ajaxurl = '{{route("review_action")}}';
        
        $.ajax({
            type: type,
            url: ajaxurl,
            data:formData,
            dataType: 'json',
            success: function (data) {
            
            	 $('#staticBackdrop').modal('toggle');
            	
            },
            error: function (data) {
                console.log(data);
            }
        });
        
    
}

function cartCheck(){
	var max_q = "{{$product_details['max_quantity']}}";
	
	var user_q = $("#quantity").val();
	
	
	
}
var user_rating = 0;
function store_rating(star_rating){
	user_rating = star_rating;
}

        function favourite_actions(id){
	if($("#product_like").hasClass('liked_product')){
		$("#product_like").removeClass('liked_product');
		favourite_type = 2;
	}else{
		$("#product_like").addClass('liked_product');
		favourite_type = 1;
	}
	
        
        var formData = {
            product_id: id,
            type:favourite_type,
        };
        var type = "GET";
        var ajaxurl = '{{route("favourite_action")}}';
        $.ajax({
            type: type,
            url: ajaxurl,
            data:formData,
            dataType: 'json',
            success: function (data) {
            
            	
            },
            error: function (data) {
                console.log(data);
            }
        });
	
	
}


 var product_id = "{{$product_details['product_id']}}";

function addToCart(){

	
	var user_q= $("#quantity").val();
	if(user_q == 0 || user_q == ""){
		alert("Please Add Product quantity!");
		return false;
	}
	
	var max_q = "{{$product_details['max_quantity']}}";
	
	
	
	if(max_q < user_q ){
		alert("cant add product into cart!")
			
	}else{
	
	addcart(user_q,product_id);
		
	}

}


   var comment_page = 1;
  
   var review_filter = 1;
   $( document ).ready(function() {
    	get_list();
   });
   
   function Set_filter(id) {
   $(".comment_list").html("");
           $(".review_filter li button").removeClass("activate");
           $(".active_" + id).addClass("activate");
           review_filter= id;
           comment_page = 1;
           get_list();
           
           // alert(id);
       }
   
   
   
   
   $("#loadmore").click(function(){
   	comment_page++;
   	get_list();
   });
   
   
    function add_reviews(){
   	
       var formData = {
         "_token": "{{ csrf_token() }}",
           product_id: "{{$product_details['product_id']}}",
           rating:user_rating,
           comment:$("#exampleFormControlTextarea1").val(),
           
       };
       
       var type = "POST";
       var ajaxurl = "{{route('addreview')}}";
       $.ajax({
           type: type,
           url: ajaxurl,
           data:formData,
           dataType: 'json',
           success: function (data) {
           
		   page = 1;
		   $('#staticBackdrop').modal('toggle');
		   $(".comment_list").html("");
		   get_list();
		   location.reload();
           },
           error: function (data) {
               console.log(data);
           }
       });
       
       
       }
   
   function get_list(){
   
       
       var formData = {
           page: comment_page,
           product_id:product_id,
           filters:review_filter,
           
       };
       
       var type = "GET";
       var ajaxurl = "{{ route('product_details', ['id' => $product_details['product_id']]) }}";
       $.ajax({
           type: type,
           url: ajaxurl,
           data:formData,
           dataType: 'json',
           success: function (data) {
          	$(".comment_list").append(data.html);
          	if(data.last_page == 1 && data.html == ""){
          		$(".empty_data").removeClass('d-none');
          		$("#loadmore").addClass('d-none');
          	}else{
          		$(".empty_data").addClass('d-none');
          	}
          	
           	if(comment_page == data.last_page){
           		$("#loadmore").addClass('d-none');
           	}else{
           	
           	$("#loadmore").removeClass('d-none');
           	}
           },
           error: function (data) {
               console.log(data);
           }
       });
       
       }
       
       
       function favourite_action(id) {
           if ($(".active_" + id).hasClass('active')) {
               $(".active_" + id).removeClass('active');
               favourite_type = 2;
           } else {
               $(".active_" + id).addClass('active');
               favourite_type = 1;
           }
   
   
   
           var formData = {
               product_id: id,
               type: favourite_type,
           };
           var type = "GET";
           var ajaxurl = '{{ route('favourite_action') }}';
           $.ajax({
               type: type,
               url: ajaxurl,
               data: formData,
               dataType: 'json',
               success: function(data) {
   
                  // $("#list_data").append(data.html);
   
                  // if (page == data.last_page) {
   
                   //    $("#loadmore_data").addClass('d-none');
                 //  }
               },
               error: function(data) {
                   console.log(data);
               }
           });
   
   
       }
   
   
       
       function showProductDetail(id) {
   
           $(".boostrap_toggle button").removeClass('show_details');
   
           if (id == 1) {
   
               $("#description_toggle").addClass('show_details');
   
               $(".boostrap_toggle").removeClass('show_details');
               $("#multiCollapseExample2").addClass("d-none");
               $("#multiCollapseExample2").removeClass("show");
               $("#multiCollapseExample1").removeClass("d-none");
               $("#multiCollapseExample1").addClass("show");
   
           } else {
   
               $("#customer_review_toggle").addClass('show_details');
   
               $("#multiCollapseExample2").removeClass("d-none");
               $("#multiCollapseExample2").addClass("show");
               $("#multiCollapseExample1").addClass("d-none");
               $("#multiCollapseExample1").removeClass("show");
   
           }
   
       }
   
       let slideIndex = 1;
       showSlides(slideIndex);
   
       // Next/previous controls
       function plusSlides(n) {
           showSlides((slideIndex += n));
       }
   
       // Thumbnail image controls
       function currentSlide(n) {
           showSlides((slideIndex = n));
       }
   
       function showSlides(n) {
           let i;
           let slides = document.getElementsByClassName("mySlides");
           let dots = document.getElementsByClassName("demo");
           let captionText = document.getElementById("caption");
           if (n > slides.length) {
               slideIndex = 1;
           }
           if (n < 1) {
               slideIndex = slides.length;
           }
           for (i = 0; i < slides.length; i++) {
               slides[i].style.display = "none";
           }
           for (i = 0; i < dots.length; i++) {
               dots[i].className = dots[i].className.replace(" active", "");
           }
           slides[slideIndex - 1].style.display = "block";
           dots[slideIndex - 1].className += " active";
           captionText.innerHTML = dots[slideIndex - 1].alt;
       }
</script>
<script>
   let items = document.querySelectorAll(".carousel .carousel-item");
   
   items.forEach((el) => {
       const minPerSlide = {{$count}};
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
   
   
   
   
   function helpAction(type,review_id){
   	
   	    var formData = {
               review_id: review_id,
               review_type: type,
               product_id: product_id,
           };
         
        
        var type = "GET";
        var ajaxurl = '{{route("review_action")}}';
        
        $.ajax({
            type: type,
            url: ajaxurl,
            data:formData,
            dataType: 'json',
            success: function (data) {
            
            },
            error: function (data) {
                console.log(data);
            }
        });
           
           
   }
   
</script>
@endsection

