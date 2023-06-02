@extends('frontend.layouts.main')
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

</style>
@endsection
@section('content')
<div class=" d-flex justify-content-center " style="margin-top: 3%;margin-bottom: 6%;">
	<div class="col-md-5 p-5  bg-white">
	    <h1 class="text-center mb-4 fw-bold display-3 text-uppercase" style="color: #5668D5 !important;">Change Password</h1>
	    
	    <form class="login_form popins_family d-flex flex-column" onsubmit="return validateForm()" action="{{route('change_password')}}" method="POST">
	    @csrf
		<div class="mb-3">
		    <input type="password" class="form-control border border-dark login_email password_field1" name="current_password" placeholder="Current Password" id="currentpassword">
		    <i class="bi bi-eye-slash"  id="password_show1" onclick="show_password(1);"></i> <i class="bi bi-eye d-none"  id="password_hide1" onclick="hide_password(1);"></i><br>
		     <span id="current_password_error" class="text-danger"></span>
		    	@error('current_password')
			<span class="text-danger">{{ $message }}</span>
			@enderror
		     
		</div>
		<div class="mb-3">
		    <input type="password" class="form-control border border-dark login_email password_field2" name="new_password" placeholder="New Password" id="newpassword">
		    <i class="bi bi-eye-slash"  id="password_show2" onclick="show_password(2);"></i> <i class="bi bi-eye d-none"  id="password_hide2" onclick="hide_password(2);"></i><br>
		     <span id="new_password_error" class="text-danger"></span>
		     @error('new_password')
			<span class="text-danger">{{ $message }}</span>
			@enderror
		</div>
		<div class="mb-3">
		    <input type="password" class="form-control border border-dark login_email password_field3" name="confirm_password" placeholder="Confirm Password" id="confirmpassword">
		    <i class="bi bi-eye-slash"  id="password_show3" onclick="show_password(3);"></i> <i class="bi bi-eye d-none"  id="password_hide3" onclick="hide_password(3);"></i><br>
		     <span id="confirm_password_error" class="text-danger"></span>
		      @error('confirm_password')
			<span class="text-danger">{{ $message }}</span>
			@enderror
		</div>
		<div class="d-grid mt-2">
		    <button class="btn btn-primary login_button text-uppercase fw-bold" type="submit"  style="font-family: 'Oxanium';">Change Password</button>
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

function show_password(id){
    $(".password_field"+id).attr("type","text");
      $('#password_show'+id).addClass('d-none');
      $('#password_hide'+id).removeClass('d-none');
    }
    
    function hide_password(id){
    $('#password_show'+id).removeClass('d-none');
      $('#password_hide'+id).addClass('d-none');
    	$(".password_field"+id).attr("type","password");
    }
    
function validateForm(){

	var currentpassword = $("#currentpassword").val();
	var newpassword = $("#newpassword").val();
	var confirmpassword = $("#confirmpassword").val();
	
	$("#current_password_error").html("");
	$("#new_password_error").html("");
	$("#confirm_password_error").html("");
	
	var i = 1;
	
	if(currentpassword == ""){
		$("#current_password_error").html("Enter your current password!.");
		i = 0;
	}
	
	if(newpassword == ""){
		$("#new_password_error").html("Enter your  new password!.");
		i = 0;
	}
	
	if(newpassword != "" && newpassword.length < 6){
		$("#new_password_error").html("Enter your  new password! min six digits.");
		i = 0;
	}
	
	if(confirmpassword == "" && newpassword != ""){
		$("#confirm_password_error").html("Enter your  confirm password!.");
		i = 0;
	}
	
	if(confirmpassword != "" && newpassword != ""){
		
		if(confirmpassword != newpassword){
			$("#confirm_password_error").html("Enter your  confirm password not match.");
			i = 0;
		}
	}
	
	if(i == 0){
		return false;
	}
	
}
</script>
@endsection
