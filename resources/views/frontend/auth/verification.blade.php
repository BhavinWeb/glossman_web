@extends('frontend.layouts.main')
@section('css')
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
        padding-left: 40px !important;
    }

    .login_email::placeholder {
        color: #9F9F9F !important;
        font-family: "Poppins", Arial, sans-serif !important;
        font-size: small;
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
    
     @media screen and (max-width: 1100px) {
		.text-danger{
			font-size:15px!important;
		}
	}
</style>
@endsection
@section('content')
<div class=" d-flex justify-content-center " style="margin-top: 3%;margin-bottom: 6%;">
        <div class="col-md-5 p-5  bg-white">
            <h1 class="text-center mb-4 fw-bold display-3 text-uppercase" style="color: #5668D5 !important;">OTP Verification</h1>
            
            <span>An OTP has been send  to your registered mobile number {{$user->phone}} </span>
            <br><br>
            
            <span id="otp_show">{{$user->otp}}</span>
            
            <form class="login_form popins_family d-flex flex-column gap-4" onsubmit="return validateForm()"  action="{{route('user_verification_otp')}}"  method="POST">
             @csrf
                <div class="">
                    <input type="text" class="form-control border border-dark login_email" name="otp" placeholder="Enter OTP Here" id="otp"><br>
			<span class="text-danger" id="otp_error"></span>
			 @if($errors->has('otp'))
			    <span class="text-danger">{{ $errors->first('otp') }}</span>
			@endif
                </div>
                <div class="d-grid mt-2">
                    <button class="btn btn-primary login_button text-uppercase fw-bold" type="submit">Verify</button>
                </div>
            </form>

           <div class="mt-4 text-center font-ui font-sm">
              Didnt't receive the code? <span class="text-primary" onclick="resendOTP();" style="cursor: pointer;">Resend Code</span>
           </div>
        </div>
    </div>

@endsection
@section('javascript')
<script>

function validateForm(){
	$("#otp_error").html("");
	var i = 0;
	 var otp = $("#otp").val();
	 if(otp == ""){
	 	$("#otp_error").html("Please enter OTP!");
	 	i = 1;
	 }
	 
	 if(otp != ""){
	 	if(otp.length != 6 ){
	 		$("#otp_error").html("Please enter valida OTP!");
	 		i = 1;
	 	}
	 	
	 }
	 
	if(i == 1){
	return false
	}
}
  
  function resendOTP(){
     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var formData = {
            title: jQuery('#title').val(),
            description: jQuery('#description').val(),
        };
        var type = "GET";
        var ajaxurl = '{{route("resend-otp")}}';
        $.ajax({
            type: type,
            url: ajaxurl,
            dataType: 'json',
            success: function (data) {
            if(data.success == true){
            	Swal.fire(
		  'Success',
		  'Resend otp successfully',
		  'success'
		)
               $("#otp_show").html(data.data);
               }else{
               Swal.fire({
		  icon: 'error',
		  title: 'Oops...',
		  text: 'Something went wrong!',
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

