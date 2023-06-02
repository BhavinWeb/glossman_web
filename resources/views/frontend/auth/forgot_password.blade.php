@extends('frontend.layouts.main')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    
    @media screen and (max-width: 1300px) {
		  .display-3 {
		   font-size:48px!important;
		  }
		   .swal2-popup {
		font-size: 0.7rem!important;
		}
}
 .swal2-popup {
font-size: 1rem;
}

@media screen and (max-width: 1350px) {
	  #center_with{
		width: 70%;
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
</style>
@endsection
@section('content')
<div class=" d-flex justify-content-center forgot_password_box" id="email_section" style="margin-top: 3%;margin-bottom: 6%;">
	<div class="col-md-5 p-5  bg-white" id="center_with">
	    <h1 class="text-center mb-4 fw-bold display-3 text-uppercase title_heading" style="color: #5668D5 !important; " >FORGOT PASSWORD?</h1>
	  
		<div class="mb-3">
		    <input type="email" class="form-control border border-dark login_email" name="email" placeholder="Email" id="email">
		    <span id="email_error" class="text-danger"></span>
		</div>
		
		<div class="d-grid mt-2">
		    <button class="btn btn-primary login_button text-uppercase fw-bold" type="submit"  style="font-family: 'Oxanium';" id="sedn_otp">SEND OTP</button>
		</div>
	   
	    <div class="mt-4 text-center font-ui font-sm">
		Don't have an account? <a href="{{route('signup')}}" class="text-primary text-decoration-underline">Sign Up</a>
	    </div>
	</div>
</div>

<div class=" d-flex justify-content-center forgot_password_box d-none" id="otp_section" style="margin-top: 3%;margin-bottom: 6%;">
	<div class="col-md-5 p-5  bg-white">
	    <h1 class="text-center mb-4 fw-bold display-3 text-uppercas title_headinge" style="color:#5668D5!important;"> FORGOT PASSWORD?</h1>
	  	
		<div class="mb-3">
		    <input type="text" class="form-control border border-dark login_email" name="otp" placeholder="Enter OTP here.." id="otp">
		    <span id="otp_error" class="text-danger"></span>
		</div>
		
		<div class="d-grid mt-2">
		    <button class="btn btn-primary login_button text-uppercase fw-bold" type="submit"  style="font-family: 'Oxanium';" id="otp_verify">Verify</button>
		</div>
	   
	    <div class="mt-4 text-center font-ui font-sm">
		 Didnt't receive the code? <span class="text-primary" onclick="resendOTP();" style="cursor: pointer;">Resend Code</span>	
	    </div>
	</div>
</div>

<div class=" d-flex justify-content-center forgot_password_box d-none" id="change_section" style="margin-top: 3%;margin-bottom: 6%;">
	<div class="col-md-5 p-5  bg-white">
	    <h1 class="text-center mb-4 fw-bold display-3 text-uppercase title_heading" style="color: #5668D5 !important;">FORGOT PASSWORD?</h1>
	  	<p>Change your password</span>
	  	
		<div class="mb-3">
		    <input type="password" class="form-control border border-dark login_email" name="password" placeholder="Enter password" id="password">
		    <span id="password_error" class="text-danger"></span>
		</div>
		
		<div class="mb-3">
		    <input type="password" class="form-control border border-dark login_email" name="confirm_password" placeholder="Enter confirm password" id="confirm_password"><br>
		    <span id="confirm_password_error" class="text-danger"></span>
		</div>
		
		<div class="d-grid mt-2">
		    <button class="btn btn-primary login_button text-uppercase fw-bold" type="submit"  style="font-family: 'Oxanium';" id="change_password">Verify</button>
		</div>
	   
	    
	</div>
</div>

@endsection
@section('javascript')
<script>
	 	
</script>
<script>
   var email =  "";
var otp = "";
var password = "";




$("#sedn_otp").click(function(){
	 
	 email = $("#email").val();


        $("#email_error").html("");
        
        var i = 1;

        
        if(email == ""){
        	$("#email_error").html("Please enter email!");
        	i = 0;
        }
        
        
        if(i == 0){
        	return false;
        }
        
          var formData = {
            email: email,
            type: 1,
            
        };
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        var type = "POST";
        var ajaxurl = '{{route("forgotpassword")}}';
       var formData = {
            type: 1,	
            email: email,
            
        };
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
             $("#email_error").html("");
            if(data.success == true){
            
            
            
            Swal.fire(
		  'Success',
		  'send otp successfully',
		  'success'
		)
            	$(".forgot_password_box").addClass('d-none');
            	$("#otp_section").removeClass('d-none');
            	
            }else{
            	
            	$("#email_error").html("Email not found!");
		
            }
        },
            error: function (data) {
                console.log(data);
            }
        });

});



$("#otp_verify").click(function(){
 	otp = $("#otp").val();

        $("#otp_error").html("");
        
        var i = 1;

        if(otp == ""){
        	$("#otp_error").html("Please enter OTP!");
        	i = 0;
        }
        
       
        
        if(i == 0){
        	return false;
        }
        
         var type = "POST";
        var ajaxurl = '{{route("forgotpassword")}}';
          var formData = {
            email: email,
            type: 2,
            otp:otp,

        };
        
         $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
             $("#email_error").html("");
            if(data.success == true){
            console.log(data);
            Swal.fire(
		  'Success',
		  'Now you can chnage your password',
		  'success'
		)
            	$(".forgot_password_box").addClass('d-none');
            	$("#change_section").removeClass('d-none');
            	
            }else{
            	
            	$("#otp_error").html("Please enter valid OTP!");
            }
        },
            error: function (data) {
                console.log(data);
            }
        });

});

$("#change_password").click(function(){

	password = $("#password").val();
	
	var c_password = $("#confirm_password").val();

        $("#password_error").html("");
         $("#confirm_password_error").html("");
        
        var i = 1;

        if(password == ""){
        	$("#password_error").html("Please enter password!");
        	i = 0;
        }
        
        
        if(password.length < 6){
        	$("#password_error").html("Please enter min six character!");
        	i = 0;
        }
        
        
        if(password != ""){
        
        
        	if(c_password == ""){
        		$("#confirm_password_error").html("Please enter confirm password!");
			i = 0;
		}
        }
        
        if(password != c_password){
        	$("#confirm_password_error").html("Please enter confirm password not as passsword!");
		i = 0;
        }
        
        
        
        if(i == 0){
        	return false;
        }
         var type = "POST";
        var ajaxurl = '{{route("forgotpassword")}}';
          var formData = {
            email: email,
            type: 4,
            password:password,
            confirm_password:c_password,

        };	
        
          $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
             $("#email_error").html("");
            if(data.success == true){
            console.log(data);
            Swal.fire(
		  'Success',
		  'change password successfully',
		  'success'
		).then(function() {
    window.location = "{{route('signin')}}";
});
            		
            	
            }else{
            	
            	 Swal.fire({
		  icon: 'error',
		  title: 'Oops...',
		  text: 'Please Check your Email!',
		})
            }
        },
            error: function (data) {
                console.log(data);
            }
        });
	
});

function resendOTP(){

	   var formData = {
            email: email,
            type: 3,
            
        };
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        var type = "POST";
        var ajaxurl = '{{route("forgotpassword")}}';
       var formData = {
            type: 1,	
            email: email,
            
        };
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
             $("#email_error").html("");
            if(data.success == true){
            
            Swal.fire(
		  'Success',
		  'Resend otp successfully',
		  'success'
		);
            	$(".forgot_password_box").addClass('d-none');
            	$("#otp_section").removeClass('d-none');
            	
            }else{
            	
            	 Swal.fire({
		  icon: 'error',
		  title: 'Oops...',
		  text: 'Please Check your Email!',
		})
		
            }
        },
            error: function (data) {
                console.log(data);
            }
        });
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
