@extends('frontend.layouts.main')
@section('meta_data')
    @php
    $data = metaData('home');
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
<link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.min.css" rel="stylesheet">
<script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
<script>

const appId = 'sandbox-sq0idb-HTwzl5t4Lrx1aevLMF44nA';
const locationId = 'LW3NQPXZS6PW2';

async function initializeCard(payments) {
   const card = await payments.card();
   await card.attach('#card-container');

   return card;
}

async function createPayment(token) {

   const body = JSON.stringify({
      locationId,
      sourceId: token,
   });

var formData = {
"_token": "{{ csrf_token() }}",
      package_id:package_id,
      source_id:token,
      
   };

   var type = "POST";
   var ajaxurl = '{{route("package_buy")}}';
   $.ajax({
      type: type,
      url: ajaxurl,
      data:formData,
      dataType: 'json',
      success: function (data) {
      alert(data.message);
         $("#package_purchase").modal('toggle');
      },
      error: function (data) {
            console.log(data);
      }
   });

}

async function tokenize(paymentMethod) {
   const tokenResult = await paymentMethod.tokenize();
   if (tokenResult.status === 'OK') {
      return tokenResult.token;
   } else {
      let errorMessage = `Tokenization failed with status: ${tokenResult.status}`;
      if (tokenResult.errors) {
      errorMessage += ` and errors: ${JSON.stringify(
         tokenResult.errors
      )}`;
      }

      throw new Error(errorMessage);
   }
}

// status is either SUCCESS or FAILURE;
function displayPaymentResults(status) {
   
}

document.addEventListener('DOMContentLoaded', async function () {
   if (!window.Square) {
      throw new Error('Square.js failed to load properly');
   }

   let payments;
   try {
      payments = window.Square.payments(appId, locationId);
   } catch {
      const statusContainer = document.getElementById(
      'payment-status-container'
      );
      statusContainer.className = 'missing-credentials';
      statusContainer.style.visibility = 'visible';
      return;
   }

   let card;
   try {
      card = await initializeCard(payments);
   } catch (e) {
      console.error('Initializing Card failed', e);
      return;
   }

   // Checkpoint 2.
   async function handlePaymentMethodSubmission(event, paymentMethod) {
      event.preventDefault();

      try {
      // disable the submit button as we await tokenization and make a payment request.
      
      const token = await tokenize(paymentMethod);
      const paymentResults = await createPayment(token);
      displayPaymentResults('SUCCESS');

      console.debug('Payment Success', paymentResults);
      } catch (e) {
      
      displayPaymentResults('FAILURE');
      console.error(e.message);
      }
   }

   const cardButton = document.getElementById('card-button');
cardButton.addEventListener('click', async function (event) {
   await handlePaymentMethodSubmission(event, card);
});
});
</script>
@section('css')
<style type="text/css">
   .card-body {
      padding-left: 15%;
      padding-right: 15%;
   }
   .container_data {
      margin: 20px;
   }
   .display-2 {
      font-weight: 700;
   }
   .dollor_css {
      font-size: 25px;
      display: block;
      float: left;
      margin-top: 11px;
   }
   .packages_ul li {
      font-family: Poppins;
      font-size: 15px;
      line-height: 35px;
   }
   .display-4 {
      color: white !important;
      -webkit-text-fill-color: black !important;
      -webkit-text-stroke-width: 2px !important;
      -webkit-text-stroke-color: white !important;
      font-size: 80px;
   }
   .slider-img {
      width: 1000px !important;
   }
   .vehical {
      background: rgba(12, 12, 12, 0.5);
      padding: 120px 0;
   }
   .inspection-main {
      background: url("frontend/images/NoPath - Copy ( (16).png");
      background-size: 100%;
      background-repeat: no-repeat;
   }
   .display-2 {
      font-weight: 700;
      color: #fff;
   }
   p.inpectiondescription {
      color: #fff;
   }

   .view-details {
      border: none !important;
      border-left: 7px solid #a06ab9 !important;
      padding-right: 40px !important;
      padding-left: 40px !important;
      padding-top: 20px !important;
      padding-bottom: 20px !important;
      font-weight: 700;
      text-transform: uppercase !important;
      font-size: 17px;
   }
   .custom-button {
      border: none !important;
      border-left: 7px solid #a06ab9 !important;
      padding-right: 55px !important;
      padding-left: 50px !important;
      padding-top: 20px !important;
      padding-bottom: 20px !important;
   }

   .carousel-item img {
      object-fit: cover;
   }

   @media (max-width: 767px) {
      .inspection-main {
         background: url("frontend/images/NoPath - Copy ( (16).png") !important;
         background-size: cover !important;
         background-repeat: no-repeat;
         background-position: center !important;
      }
      .vehical {
         background: rgba(12, 12, 12, 0.5);
         padding: 120px 15px;
      }
      .display-2 {
         color: #fff;
         font-size: 23px !important;
      }
      .custom-button {
         padding-right: 25px !important;
         padding-left: 25px !important;
         padding-top: 12px !important;
         padding-bottom: 12px !important;
         font-size: 14px;
      }
      #carouselExampleDark .carousel-caption {
         padding-top: 33% !important;
         padding-bottom: 0;
         padding-left: 11% !important;
      }
      .slider-title {
         font-size: 6vw !important;
      }
   }
   @media (max-width: 800px) {
      .heading_pull {
         float: left !important;
         padding-top: 20px !important;
      }
   }
   @media (max-width: 1300px) {
      .inspection-main {
         background-size: 100% 100% !important;
      }
      .subscribe-inner {
         display: block !important;
         margin-top: 10px;
      }
   }
   @media (min-width: 992px) {
      .modal-cart {
         line-height: 2.5 !important;
         top: 150px !important;
         left: 450px !important;
      }
      .modal-cart-content {
         width: 80% !important;
      }
      .cart-img {
         height: 64% !important;
      }
      .slider-img {
         width: 1530px !important;
      }
      .slider-title {
         font-size: 4vw !important;
      }
   }
   .slider-title {
      font-size: 8vw;
   }
   #footer {
      background: black;
      padding: 0 0 30px 0;
      color: #fff;
      font-size: 14px;
   }
   td {
      padding-right: 62px;
      padding-bottom: 10px;
   }
   .btn_confirm {
      padding: 0.5rem 0.5rem !important;
      font-size: 1.25rem;
      border-radius: 0.3rem;
      margin-top: 1rem;
   }
   .h3 {
      line-height: 56px;
      font-weight: 700;
   }
   .h4 {
      line-height: 56px;
      font-weight: 700;
   }
   .slider_btn {
      width: 200px;
      /* margin-left: -12%; */
      height: 70px;
      font-weight: 700;
   }
   .packages_list .carousel-inner {
      height: 100%;
   }
   #carouselExampleDark .carousel-caption {
      position: absolute !important;
      right: 0 !important;
      bottom: 20 !important;
      left: 0 !important;
      /* color: #fff; */
      text-align: left !important;
   }

   @media only screen and (max-width: 1000px) {
      .carousel-item img {
         height: 100% !important;
      }
      .book-button {
         border: none !important;
         border-left: 7px solid #a06ab9 !important;
         padding-right: 50px !important;
         padding-left: 50px !important;
         padding-top: 10px !important;
         padding-bottom: 10px !important;
      }
   }

   button.subscribe_submit_button:before {
      content: "\f061";
      color: #fff;
      font-size: 26px;
      font-family: "Font Awesome 5 Free";
   }
   .subscribe_text {
      text-align: center;
      font-size: 38px;
      font-weight: 600;
      color: white;
      margin-top: 23px;
   }

   #featureContainer .indicator {
      border: 0px solid rgb(255 255 255);
   }

   .typeahead .dropdown-menu {
      display: inline-block !important;
      color: var(--p-bg-color) !important;
      font-size: var(--menu-font-size) !important;
      font-weight: var(--font-weight-medium) !important;
      position: relative !important;
      padding-top: 0px !important;
      padding-bottom: 0px !important;
      max-width: 100%!important!;
   }

</style>
@endsection
@section('content')
@if (\Session::has('verification_success'))
<div class="alert alert-success d-none">
   <ul>
      <li>{!! \Session::get('verification_success') !!}</li>
   </ul>
</div>
@endif

@php
	function months($num = 0){
		$num = (string) ((int) $num);

        if ((int) $num && ctype_digit($num)) {
            $words = [];

            $num = str_replace([",", " "], "", trim($num));

            $list1 = [
                "",
                "one",
                "two",
                "three",
                "four",
                "five",
                "six",
                "seven",

                "eight",
                "nine",
                "ten",
                "eleven",
                "twelve",
                "thirteen",
                "fourteen",

                "fifteen",
                "sixteen",
                "seventeen",
                "eighteen",
                "nineteen",
            ];

            $list2 = [
                "",
                "ten",
                "twenty",
                "thirty",
                "forty",
                "fifty",
                "sixty",

                "seventy",
                "eighty",
                "ninety",
                "hundred",
            ];

            $list3 = [
                "",
                "thousand",
                "million",
                "billion",
                "trillion",

                "quadrillion",
                "quintillion",
                "sextillion",
                "septillion",

                "octillion",
                "nonillion",
                "decillion",
                "undecillion",

                "duodecillion",
                "tredecillion",
                "quattuordecillion",

                "quindecillion",
                "sexdecillion",
                "septendecillion",

                "octodecillion",
                "novemdecillion",
                "vigintillion",
            ];

            $num_length = strlen($num);

            $levels = (int) (($num_length + 2) / 3);

            $max_length = $levels * 3;

            $num = substr("00" . $num, -$max_length);

            $num_levels = str_split($num, 3);

            foreach ($num_levels as $num_part) {
                $levels--;

                $hundreds = (int) ($num_part / 100);

                $hundreds = $hundreds
                    ? " " .
                        $list1[$hundreds] .
                        " Hundred" .
                        ($hundreds == 1 ? "" : "s") .
                        " "
                    : "";

                $tens = (int) ($num_part % 100);

                $singles = "";

                if ($tens < 20) {
                    $tens = $tens ? " " . $list1[$tens] . " " : "";
                } else {
                    $tens = (int) ($tens / 10);
                    $tens = " " . $list2[$tens] . " ";
                    $singles = (int) ($num_part % 10);
                    $singles = " " . $list1[$singles] . " ";
                }
                $words[] =
                    $hundreds .
                    $tens .
                    $singles .
                    ($levels && (int) $num_part
                        ? " " . $list3[$levels] . " "
                        : "");
            }
            $commas = count($words);
            if ($commas > 1) {
                $commas = $commas - 1;
            }

            $words = implode(", ", $words);

            $words = trim(str_replace(" ,", ",", ucwords($words)), ", ");

            if ($commas) {
                $words = str_replace(",", " and", $words);
            }

            return $words;
        } elseif (!((int) $num)) {
            return "Zero";
        }

        return "";
	}
@endphp
<!-- Carousal Slider -->
<section>
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($slider as $slider) @if($loop->first)
            <div class="carousel-item active" data-bs-interval="10000">
                @else
                <div class="carousel-item" data-bs-interval="10000">
                    @endif
                    <div class="text-white custom-slide-mobile w-100" style="position: absolute; color: white; background-color: rgba(12, 12, 12, 0.5); width: 100% !important; height: 100%;">
                        <div class="background_color">
                            <div class="carousel-caption text-white container">
                                <h1 class="slider-title text-uppercase">{{ $slider->title}}</h1>
                                <p class="slider-detail">{{ $slider->details}}</p>
                                <a href="promotion">
                                <button class="btn text-dark book-button btn-light text-uppercase fw-bold custom-button" style="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                    &nbsp;&nbsp;{{ $slider->button_text }}
                                </button>
                            </a>
                            </div>
                        </div>
                    </div>
                    <img src="{{asset($slider->image)}}" class="d-block h-100 w-100" alt="..." />
                </div>
                @endforeach
            </div>
            <div class="d-flex flex-row control_icons justify-content-start">
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Car Service   -->
<section>
    <div class="container car_service_mobile d-flex flex-column gap-5">
        <h1 class="text-uppercase mt-5">Car Services</h1>
        <div class="row gx-5 gy-5 h6">
            @foreach($service as $service)
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="d-flex flex-column gap-2">
                    <img src="{{asset($service->image)}}" alt="" />
                    <a href="{{route('service_details',['service_id' => $service->id])}}" class="btn btn-outline-light text-start text-uppercase fw-semibold text-dark">{{$service->name}}</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mb-5">
            <a href="carservice">
                <button class="btn text-light text-uppercase" style="background-color: #5668d5; padding: 18px; padding-left: 50px; padding-right: 50px; font-size: small;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" stroke-width="4" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    &nbsp;View More
                </button>
            </a>
        </div>
    </div>
</section>

<!-- Vehicle Inspection Banner    -->
<section>
    <div class="row">
        <div class="col-sm-12 inspection-main" style="">
            <div class="d-flex justify-content-center vehical" style="">
                <div class="container my-auto">
                    <span class="display-4">30% OFF ON</span><br />
                    <span class="display-2 text-uppercase">Vehicle Inspections Service</span>
                    <p class="inpectiondescription">
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                        Stet
                    </p>
                    <!-- <button class="btn book-button btn-light">Book Now</button> -->
                    <a href="promotion">
                    <button class="btn text-dark book-button btn-light text-uppercase view-details" style="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                        &nbsp;&nbsp;&nbsp;View details
                    </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Car Product Categories -->
<div class="container text-uppercase my-5 d-flex flex-column gap-5">
    <h1 class="text-uppercase">Car Product Categories</h1>
    <div class="row g-5 h6">
        @foreach($category as $category)
        <div class="col-md-6 col-xl-4">
            <div class="d-flex flex-column gap-3">
                <div class="border border-secondary d-flex justify-content-center py-5" style="height: 300px;">
                    <img src="{{asset($category->image)}}" alt="" class="h-100" />
                </div>
                <a href="{{URL::to('product-list/'.$category->id)}}" class="btn btn-outline-light text-start text-uppercase fw-semibold text-dark">
                    {{$category->name}}
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mb-5">
        <a href="productcategory">
            <button class="btn text-light text-uppercase fw-semibold" style="background-color: #5668d5; padding: 18px; padding-left: 50px; padding-right: 50px; font-size: small;">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" stroke-width="4" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                </svg>
                &nbsp;View More
            </button>
        </a>
    </div>
</div>

<!-- Leather Care products Banner    -->
<div class="row">
    <div class="col-sm-12" style="height: 700px;">
        <div class="d-flex justify-content-center" style="position: absolute; color: white; background-color: rgba(12, 12, 12, 0.5); height: 700px; width: 100%;">
            <div class="container container_data my-auto">
                <span class="display-4">50% OFF ON</span><br />
                <span class="display-2 fw-bolder text-uppercase">Leather Care Products</span>
                <p class="w-75">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet
                </p>
                <!-- <button class="btn book-button btn-light">Book Now</button> -->
                <a href="promotion">
                <button
                    class="btn text-dark book-button btn-light"
                    style="
                        border: none !important;
                        border-left: 7px solid #a06ab9 !important;
                        padding-right: 55px !important;
                        padding-left: 50px !important;
                        padding-top: 20px !important;
                        padding-bottom: 20px !important;
                        text-transform: uppercase;
                        font-weight: 700;
                        font-size: 17px;
                    "
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    &nbsp;&nbsp;&nbsp;Shop Now
                </button>
                </a>
            </div>
        </div>
        <img src="frontend/images/1656076053.png" alt="" srcset="" style="height: 100%; width: 100%;" />
    </div>
</div>

<!-- Packages   -->
<div class="container mt-3 mb-5 packages_list" id="featureContainer" style="">
    <div class="row">
        <div id="featureCarousel" class="carousel slide" data-bs-ride="carousel">
            <h1 class="font-weight-light text-center mt-5 text-uppercase" style="font-weight: 700;">
                Packages
                <div class="float-end pe-md-4">
                    <a class="indicator" href="#featureCarousel" role="button" data-bs-slide="prev">
                        <span class="material-icons" aria-hidden="true">arrow_back</span>
                    </a>

                    <a class="w-aut indicator" href="#featureCarousel" role="button" data-bs-slide="next">
                        <span class="material-icons" aria-hidden="true">arrow_forward</span>
                    </a>
                </div>
            </h1>

            <div class="carousel-inner" style="margin-bottom: 1%;">
                @foreach($packages as $key =>$package) @if ($loop->first)
                <div class="carousel-item active">
                    @else
                    <div class="carousel-item">
                        @endif
                        <div class="col-md-6 col-xl-4 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <span class="text-uppercase fw-bold">{{months($package->duration)}} Months</span><br />
                                    <span class="h3">{{$package->title}}</span><br />
                                    <span class="display-2"><span class="dollor_css">{{$package->currency}}</span>{{$package->price}}</span><br />
                                    <ul class="packages_ul">
                                        @foreach($package->package_service as $p_data)
                                        <li><i class="fa fa-check" style="color: #5668d5;"></i>{{$p_data->service_count}} {{$p_data->service_name}}</li>
                                        @endforeach
                                    </ul>
                                    @if($key % 2 == 0)
                                    <button class="mt-5 btn slider_btn btn-outline-light text-dark text-uppercase" style="color: black; background: #efefef !important;" onClick="purchase_package('{{$package->id}}');">
                                        <i style="font-size: 15px;" class="fas">&#xf067;</i>&nbsp;Purchase
                                    </button>
                                    @else
                                    <button class="mt-5 btn slider_btn btn-outline-light text-dark text-uppercase" onClick="purchase_package('{{$package->id}}');" style="background-color: #a06ab9 !important; color: white !important;">
                                        <i style="font-size: 15px;" class="fas">&#xf067;</i>&nbsp;Purchase
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="package_purchase" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content give-rating-model-main">
                <div class="modal-header" style="border-bottom-color: white !important;">
                    <h5 class="modal-title" id="staticBackdropLabel"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></h5>
                </div>
                <div class="modal-body give-rating-model">
                    <div class="row" style="">
                        <div class="col-sm-12 text-center">
                            <h2>Buy Package</h2>
                            <br />
                            <div id="card-container"></div>
                            <div class="col-sm-12 mt-4 text-center">
                                <button class="btn common_submit_button" type="button" id="card-button">+ BUY</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('models')
@endsection

@section('javascript')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css" rel="stylesheet" />
<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>  
<script>
	var package_id = 0;
   function purchase_package(id) {
      $("#package_purchase").modal("toggle");
      package_id = id;
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
      //$("#featureCarousel").carousel();
      //$("#featureCarousel").carousel("pause");
   });

   $(function () {
      $("#example").autocomplete();
   });

           
  
</script>

@endsection
