@extends('frontend.layouts.main')
@section('meta_data')
@php
    $data = metaData('login');
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
    .popins_family {
        font-family: 'Poppins' !important;
        font-size: 13px !important;
    }
    .content {
        padding: 0px;
    }

    .content img {
        margin-bottom: 11px;
    }

    .content button {
        margin-bottom: 30px;;
    }

    .vertical-center {
        display: flex;
        align-items: center;
        min-height: 100vh;
    }

    .login_css {
        color: #5668d5;
        font-size: 3vw;
        opacity: 1;
        margin-bottom: -50%;
    }

    .login_email {
        border-radius: 0px !important;
        height: 60px !important;
        padding-left: 24px !important;
    }

    .login_email::placeholder {
        color: #9F9F9F !important;
        font-family: "Poppins", Arial, sans-serif !important;
        font-size: small;
        padding-left: -10px;
    }

    .login_button {
        width: 100%;
        height: 60px;
    }

    .login_form i {
        cursor: pointer;
        float: right;
        margin-top: -41px;
        margin-right: 13px;
    }

    .form_h1_heading {
        font-size: 70px;
    }
    
     @media screen and (max-width: 1350px) {
	  #center_with{
		width: 70%;
		}
		 .swal2-popup {
			font-size: 0.7rem!important;
		}
	}
	
	 @media screen and (max-width: 400px) {
	  #center_with{
		width: 99%;
		}
		
	.modal {

  position: absolute;
  float: left;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
}
		
	}
	
	 .swal2-popup {
		font-size: 1rem;
	}
	 @media screen and (max-width: 1100px) {
		.text-danger{
			font-size:15px!important;
		}
	}
</style>
@endsection
@section('content')
<div class=" d-flex justify-content-center " style="margin-top: 3%;margin-bottom: 6%;">
	<div class="col-md-5 p-5  bg-white" id="center_with">
	    <h1 class="text-center mb-4 fw-bold display-3 text-uppercase" style="color: #5668D5 !important;">LOG IN</h1>
	    @if ($errors->any())
		    <div class="alert alert-danger">
			<ul>
			    @foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			    @endforeach
			</ul>
		    </div>
		@endif
	    <form class="login_form popins_family d-flex flex-column" onsubmit="return validateForm()" action="{{route('user_login')}}" method="POST">
	    @csrf
		<div class="mb-3">
		    <input type="email" class="form-control border border-dark login_email" name="email" placeholder="Email" id="email">
		    <span id="email_error" class="text-danger"></span>
		</div>
		<div class="mb-3">
		    <input type="password" class="form-control border border-dark login_email" name="password" placeholder="Password" id="password">
		    <i class="bi bi-eye-slash"  id="password_show" onclick="show_password();"></i> <i class="bi bi-eye d-none"  id="password_hide" onclick="hide_password();"></i>
		     <span id="password_error" class="text-danger"></span>
		</div>
		<div class="small w-full mt-3 mb-3">
		    <a class="text-dark font-sm" href="{{route('forgot_password')}}" style="float: right;">Forgot
		    password?</a>
		</div>
		<div class="d-grid mt-2">
		    <button class="btn btn-primary login_button text-uppercase fw-bold" type="submit"  style="font-family: 'Oxanium';">Log In</button>
		</div>
	    </form>
	    <div class="mt-4 text-center font-ui font-sm">
		Don't have an account? <a href="{{route('signup')}}" class="text-primary text-decoration-underline">Sign Up</a>
	    </div>
	</div>
</div>

@endsection
@section('javascript')
<script>
    function validateForm(){
        var email = $("#email").val();
        var password = $("#password").val();
        $("#email_error").html("");
        var i = 1;
        $("#password_error").html("");
        
        if(email == ""){
        	$("#email_error").html("Please enter email!");
        	i = 0;
        }
        
        if(password == ""){
        	$("#password_error").html("PLease enter password");
        	i = 0;
        }
        if(i == 0){
        	return false;
        }else{
        	
        }
    }
    
    function show_password(){
    $("#password").attr("type","text");
      $('#password_show').addClass('d-none');
      $('#password_hide').removeClass('d-none');
    }
    
    function hide_password(){
    $('#password_show').removeClass('d-none');
      $('#password_hide').addClass('d-none');
    	$("#password").attr("type","password");
    }
    
</script>
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
