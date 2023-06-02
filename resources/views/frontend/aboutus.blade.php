@extends('frontend.layouts.main')
@section('meta_data')
    @php
    $data = metaData('about');
    @endphp

    <meta name="title" content="{{ $data->title }}">
    <meta name="description" content="{{ $data->description }}">

    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $data->description }}">

    <meta name=twitter:card content=summary_large_image />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{url()->current()}}" />
    <meta name=twitter:title content="{{ $data->title }}" />
    <meta name=twitter:description content="{{ $data->description }}" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection
@section('css')
<style>
    .font_family {
        font-family: "Oxanium" !important;
    }
    .img_opacity_box {
        background-color: black;
    }
    #footer .footer-top .footer-newsletter form {
        background-color: #161616 !important;
    }
    .subscribe_button_footer {
        background-color: #5668d5 !important;
        border: #5668d5 !important;
        color: white !important;
        border-radius: 0px !important;
        padding: 10px 20px 10px 20px !important;
    }
    #footer {
        background: black;
        padding: 0 0 30px 0;
        color: #fff;
        font-size: 14px;
    }
    @media (max-width: 767px) {
        .btn_top {
            margin-top: 6rem !important;
        }

        .blackbox {
            width: 90% !important;
        }

        .book_now_button {
            width: 100% !important;
        }
    }

    .blackbox {
        width: 20%;
        margin-left: 20px;
        background: black;
    }

    .book_now_button {
        padding: 20px 40px 20px 40px;
        font-size: 20px;
        font-weight: 700;
        background-color: white;
        color: black;
        border-left: 8px solid #a06ab9;
    }

    .how_work_css .count {
        background: #a06ab9;
        padding: 19px;
        border-radius: 24px;
        color: white;
        position: absolute;
        width: 25px;
        height: 29px;
        font-weight: 700;
    }
    .how_work_css img {
        margin-top: 44px;
        margin-left: 30px;
    }
    .how_work_css .count p {
        margin-top: -11px;
        margin-left: -5px;
    }

    #bloc1,
    #bloc2 {
        display: inline;
    }

    .bottom-right {
        position: absolute;
        bottom: 1px;
        right: 12px;
        width: 40%;
        background: #5668d5;
        color: white;
        font-size: 1vw;
        font-weight: 600;
        padding: 20px;
    }
    .who-we-are-main {
        padding-bottom: 50px;
    }
    .who-we-left-side {
        padding-left: 40px;
    }

    .static_text {
        font-size: 26px;
        font-weight: 800;
    }

    @media screen and (max-width: 1400px) {
        .static_text {
            font-size: 19px;
            font-weight: 600;
        }
    }
    @media screen and (max-width: 1100px) {
        .bottom-right {
            position: relative;
            right: 0px;
            width: 100%;
        }
    }

    @media screen and (max-width: 1000px) {
        .count_text {
            margin-left: 22px;
        }
    }

    .book_now_button:hover {
        color: red !important;
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
                    <li class="text-uppercase" aria-current="page">About Us</li>
                </ol>
            </nav>
            <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">About Us</h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-5 who-we-are-main">
        <div class="col-sm-12 col-md-5 mb-2"><img src="frontend/assets/625598875104.png" alt="" style="width: 100%;" /></div>
        <div class="col-sm-12 col-md-7 who-we-left-side">
            <h2 class="text-dark font-h">WHO WE ARE?</h2>
           <div>
           <div style="overflow: auto; height:450px; width:100%;">{!! html_entity_decode($about) !!}</div>
           </div>
            
    </div>

    <div class="row">
        <div class="col-xl-6 col-md-12 col-sm-12 border " style="background-color: #e6e6e6; padding: 77px;    margin-top: 7px;
    padding-bottom: 25px;">
            <span style="" class="font-h static_text">We’re a car wash service and detailing team aiminng to get your car look the best ever. Get to know us and see why we’re the best choice for you.</span>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-6 mt-2">
            <div class="img_opacity_box"><img src="frontend/assets/about_3.png" alt="" style="width: 100%;" /></div>
        </div>
        <div class="col-xl-3 col-sm-6 mt-2">
            <div class="img_opacity_box"></div>
            <img src="frontend/assets/about_1.png" alt="" style="width: 100%;" />
        </div>
    </div>
</div>
<div class="row justify-content-md-center mt-4">
    <div class="col col-lg-2">
        <div class="img_opacity_box">
            <img src="frontend/assets/about_4.png" alt="" style="width: 100%;" />
        </div>
    </div>

    <div class="col col-lg-2">
        <div class="img_opacity_box">
            <img src="frontend/assets/about_2.png" alt="" style="width: 100%;" />
        </div>
    </div>
</div>

<!-- <div class="row justify-content-md-center mt-5 mb-5" style="margin-left: 8px;">
                    <div class="col-sm-12 col-lg-3 mb-5">
                        <img src="frontend/assets/625598875104.png" alt="" style="width: 100%;" />
                    </div>
                    <div class="col-sm-12 col-lg-3">
                        <img src="frontend/assets/625598875104.png" alt="" style="width: 100%;" />
                    </div>
                </div> -->
<!-- 
               
                   
                </div> -->

<div class="container-fluid">
    <div class="row mb-5 mt-5" style="background-color: #5668d5;">
        <div class="col-sm-12 col-md-12 col-xl-6">
            <img src="frontend/assets/interior-detail.png" alt="" width="100%" style="margin-left: -12px; width: 103.5%;height: 100%;" />
        </div>
        <div class="col-sm-12 col-md-12 col-xl-6 text-white" style="padding: 83px;">
            <h1 style="font-weight: 700; font-size: 60px;" class="font_family text-uppercase font-h">Professional Technicians</h1>
            <span class="font-ui" style="font-size: 15px; font-weight: normal;">
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita
                kasd gubergren, no sea takimata
            </span>
            <br />
          <a href="{{route("carservice")}}">
            <button class="btn mt-4 book_now_button" style="font-weight: 500;padding: 20px 40px 20px 40px;
    font-size: 20px;
    font-weight: 700;
    background-color: white;
    color: black;
    border-left: 8px solid #a06ab9;">+ BOOK NOW</button>
          </a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-5 mb-5 mt-5 text-center how_work_css">
        <div class="col-sm-12 mt-5">
            <h1 class="oxanium_family" style="font-size: 60px;">HOW IT WORKS</h1>
        </div>
        <div class="col-sm-12 col-md-4 col-xl-4 mt-5 mb-5">
            <div class="row">
                <div class="col-sm-4">
                    <span class="count"><p>1</p></span><img src="frontend/assets/Group 10384.png" alt="" />
                </div>
                <div style="text-align: left;" class="col-sm-8 mt-5 ml-0 count_text">
                    <span style="text-align: left; font-weight: bold; font-size: 25px;" class="text_bottom mt-5">Easy to register Schedule Booking</span>
                </div>
            </div>

            <!-- <div id="block_container">
                            <div id="bloc2"> <span class="count"><p>1</p></span><img src="frontend/assets/Group 10384.png" alt=""></div>
                            <div id="bloc1"> <span class="text_bottom">All Rights Reserved</span></div>  
                        </div> -->
        </div>
        <div class="col-sm-12 col-md-4 col-xl-4 mt-5 mb-5">
            <div class="row">
                <div class="col-sm-4">
                    <span class="count"><p>2</p></span><img src="frontend/assets/Group 10386.png" alt="" />
                </div>
                <div style="text-align: left;" class="col-sm-8 mt-5 ml-0 count_text">
                    <span style="text-align: left; font-weight: bold; font-size: 25px;" class="text_bottom mt-5">We will pick up your vehicle</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-xl-4 mt-5 mb-5">
            <div class="row">
                <div class="col-sm-4">
                    <span class="count"><p>3</p></span><img src="frontend/assets/Group 10387.png" alt="" />
                </div>
                <div style="text-align: left;" class="col-sm-8 mt-5 ml-0 count_text">
                    <span style="text-align: left; font-weight: bold; font-size: 25px;" class="text_bottom mt-5">Your vehicle gets serviced</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-5 mb-5">
    <div class="col-sm-12" style="position: relative; color: red;">
        <img src="frontend/assets/autonoleggio-or.png" alt="" width="100%" />
        <div class="bottom-right p-5">
            <div>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="50.136" height="57.715" viewBox="1069 4261.989 78.136 57.715">
                        <g data-name="Group 10389">
                            <path
                                d="M1069 4291.912c.102-1.341.19-2.683.308-4.023.45-5.108 1.194-10.15 3.48-14.827 2.356-4.82 6.173-7.906 11.274-9.473 3.68-1.13 7.47-1.41 11.332-1.6.02.27.048.49.048.71.003 4.58-.006 9.16.013 13.74.003.56-.123.78-.732.85-1.31.15-2.633.322-3.9.668-2.356.643-3.715 2.382-4.56 4.569-1.067 2.763-1.349 5.674-1.528 8.597-.041.68-.006 1.363-.006 2.112h18.573v26.47H1069v-27.793Z"
                                fill="#fff"
                                fill-rule="evenodd"
                                data-name="Path 38687"
                            />
                            <path
                                d="M1139.276 4262.01v2.444c0 3.995-.01 7.99.011 11.985.003.563-.12.81-.738.84-.886.044-1.768.196-2.648.327-2.966.44-4.92 2.12-6.008 4.886-.914 2.323-1.268 4.756-1.476 7.218-.097 1.138-.137 2.281-.209 3.514h18.928v26.431H1112.9c-.025-.082-.063-.152-.063-.221.026-9.314-.008-18.627.11-27.939.062-4.838.657-9.63 2.011-14.308 2.299-7.94 7.441-12.789 15.596-14.266 2.619-.474 5.297-.619 7.948-.909.223-.024.449-.003.775-.003Z"
                                fill="#fff"
                                fill-rule="evenodd"
                                data-name="Path 38688"
                            />
                        </g>
                    </svg>
                </span>
                <br />
                <div class="font-ui">
                    <span style="    font-size: 22px;
    font-weight: 400;
    letter-spacing: 1px;
    font-style: italic;">
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                        Stet clita kasd gubergren, no sea takimata
                    </span>
                    <br />
                    <span style="font-weight: normal; font-size: 25px;">Jonathon Doe</span> <br />
                    <span style="font-weight: normal; font-size: 14px;">Engineer</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

