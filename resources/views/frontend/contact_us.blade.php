@extends('frontend.layouts.main')
  @section('meta_data')
    @php
        $data = metaData('contact');
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
   <style type="text/css">

.poppins_family{
    font-family: "Poppins";
}
.oxanium_family{
    font-family: "Oxanium";
}

      #footer .footer-top .footer-newsletter form {
         background-color: #161616 !important;
      }

      .subscribe_button_footer{
         background-color: #5668D5 !important;
         border: #5668D5 !important;
         color: white !important;
         border-radius: 0px !important;
         padding: 10px 20px 10px 20px !important;
      }

      #footer .footer-top .footer-newsletter form {
         background-color: #161616 !important;
      }

      .subscribe_button_footer{
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

      #map {
         height: 400px;
         width: 100%;
      }

      .social_list a{
         margin-right: 10px;
      }

      .vertical-center {
         display: flex;
         align-items: center;
         min-height: 100vh;
      }

      .login_css{
         color: #5668d5;
         font-size: 3vw;
         opacity: 1;
         margin-bottom: -50%;
      }

      form input{
         border-radius: 0px !important;
         height: 60px !important;
         padding-left: 40px !important;
      }

      form button{
         /* width: 100%; */
         height: 60px;
      }

      .login_form i {
         cursor: pointer;
         float: right;
         margin-top: -41px;
         margin-right: 13px;
      }

      .form_h1_heading {
        font-size: 40px;
        font-weight: 800;
    }
      ul{
         list-style-type: none;
      }

      textarea{
        padding-left: 42px Im !important;
        color: #0c0a0a85 Im !important;
      }
      .contact-send-us input, .contact-send-us textarea {
        font-family: 'Poppins';
        }
        .get-in-touch {
        margin-top: 7rem;
        }
        .get-in-touch ul {
        padding-left: 15px;
        }
        @media only screen and (max-width: 600px) {
            .get-in-touch {
             margin-top: 28px;
            }
        .get-in-touch ul span,.get-in-touch ul p{
            font-size: 20px!important;
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
                                <li class="text-uppercase" aria-current="page">Contact us</li>
                            </ol>
                        </nav>
                        <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">contact us</h1>
                    </div>
                </div>
            </div>
        </div>
                    @if(session()->has('message'))
<div class="alert alert-success">
{{ session()->get('message') }}
</div>
@endif
            <div class="row">
                <div class="col-sm-12">
                    <img src="frontend/images/contact_map.png" style="height:auto; width: 100%" alt="">
                </div>
            </div>
            

            <div class="container mb-5">
                <div class="row ">
                    <div class="col-sm-12 col-md-6 col-xl-6 get-in-touch" style="">
                        <ul>

                            <li>
                                <h1 class="oxanium_family form_h1_heading" >GET IN TOUCH <br>
                                 WITH US</h1>
                            </li>

                            <li class="mt-3">
                                <span style="font-size:20px;font-weight: 300;" class="popins_family">Support center 24/7</span>
                                <p class="dark text-bold" style="font-weight: 700;font-size: 30px;">+ 3 123 456-7890</p>
                            </li>

                            <li class="mt-3">
                                <span style="font-size:20px;"  class="popins_family">Get in touch with us</span>
                            </li>

                            <li class="mt-3">
                                <span style="font-size:25px;font-weight: 700;">+ 94 ROA MALAKA,
                                   <br> WEST JAKARTA CITY <br>
                                    CANADA</span>
                            </li>

                            <li class="mt-3">
                                <span style="font-size:20px;"  class="popins_family">Get in touch with us</span>
                            </li>

                            <li class="mt-3"><span style="font-size:25px;font-weight: 700;">info@glossman.com</span></li>

                            <li class="mt-3 social_list" >
                                <a href="https://www.facebook.com/" target="blank"> <img src="assets/icon/facebookk.png" alt=""></a>
                                <a href="https://twitter.com/" target="blank"> <img src="assets/icon/twitter.png" alt=""></a>
                                <a href="https://www.google.com/" target="blank"> <img src="assets/icon/google.png" alt=""></a>
                                <a href="https://www.instagram.com/" target="blank"> <img src="assets/icon/instagram.png" alt=""></a>
                                
                            </li>

                        </ul>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6 contact-send-us" style="margin-top: 7rem!important;">
                        <h1 class="mb-4 text-dark form_h1_heading mb-5 oxanium_family " >SEND US A MESSAGE</h1>
                        <form class="login_form" action="{{route('Store_contact_us')}}" method="POST" onsubmit="return submitform();">
				@csrf
                            <div class="mb-5">
                                <input type="text" class="form-control border border-dark" placeholder="Name*" name="name" id="name">
                                <span class="text-danger" id="name_error"></span>
                            </div>
                           
                            <div class="mb-5">
                                <input type="text" onkeypress="return onlyNumberKey(event)"  class="form-control border border-dark" pattern="[1-9]{1}[0-9]{9}" placeholder="Phone" name="phone" id="phone" maxlength="10" minlength="10">
                                <span class="text-danger" id="phone_error"></span>
                            </div>

                            <div class="mb-5">
                                <input type="email" class="form-control border border-dark" placeholder="Email" name="email" id="email">
                                <span  class="text-danger" id="email_error"></span>
                            </div>
                            <div class="mb-5">
                                <textarea  class="form-control border border-dark" cols="30" rows="5" name="message" id="message" placeholder="Message*" style="    padding-left: 40px;
                                color: #8b8383;"></textarea>
                                <span class="text-danger" id="message_error"></span>
                            </div>
                            
                            <div class="d-grid">
                                <button class="btn btn-primary" style="width: 40%;
                                padding: 29px 10px 51px 10px;
                                font-weight: 700;" type="submit" > + SUBMIT</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
@endsection
@section('javascript')
<script>

  function onlyNumberKey(evt) {
              
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }
	function submitform(){
		var i = 1;
		var name = $("#name").val();
		var phone = $("#phone").val();
		var email = $("#email").val();
		var content = $("#message").val();
		$("#name_error").html("");
		$("#phone_error").html("");
		$("#email_error").html("");
		$("#message_error").html("");
		if(name ==""){
			$("#name_error").html("Please enter name!");
			i =0;
		}
		if(phone ==""){
			$("#phone_error").html("Please enter phone!");
			i =0;
		}
		if(email ==""){
			$("#email_error").html("Please enter email!");
			i =0;
		}
		if(content ==""){
			$("#message_error").html("Please enter message!");
			i =0;
		}
		if(i == 0){
			return false;
		}
	}
</script>
@endsection
