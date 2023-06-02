@extends('frontend.layouts.main')

@section('css')
<style type="text/css">
     .content{
            padding: 0px;
        }
        .content img{
            margin-bottom: 11px;
        }
        .content button{
            margin-bottom: 30px;;
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
        form.login_form input{
            border-radius: 0px !important;
            height: 60px !important;
            padding-left: 40px !important;
        }
        form.login_form button{
            width: 100%;
            height: 60px;
        }
        .login_form i {
            cursor: pointer;
            float: right;
            margin-top: -41px;
            margin-right: 13px;
        }
        .form_h1_heading{
            font-size: 70px;
        }
        .track_info{
            text-align: center;
            margin-left: -20%;
            margin-right: -22%;
            font-size: 20px;
            font-family: 'Oxanium';
            color: #545151;
        }
     .poppins_family{
        font-family: "Poppins";
     }
</style>
@endsection
@section('content')
<div class="tracking_form">
   <div class=" d-flex justify-content-center " style="margin-top: 3%;margin-bottom: 6%;">
                <div class="col-md-5 p-5  bg-white">
                    <h1 class="text-center mb-4 text-primary text-uppercase fw-bold " style="font-weight: 800;
                    color: black!important;">Track my Order</h1>
                    <p class="justify-content-center track_info poppins_family m-5" style=" text-align: center; font-size: 16px;">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit repellat dicta mollitia minus necessitatibus. Nobis nemo asperiores pariatur, excepturi culpa accusamus magnam maxime ipsam minus quis dolorem vero voluptatibus harum.</p>
                    <form class="login_form popins_family mt-5">
                        <div class="mb-3">
                            <label for="" style="font-size: 16px;" class="mb-3">Order # or PO #</label>
                            <input type="text" class="form-control border border-dark" id="track_number" placeholder="Tracking Number" required>
                            <span class="text-danger" id="track_error"></span>
                        </div>
                        <div class="mb-3 mt-4">
                            <label for="" style="font-size: 16px;"  class="mb-3"> Shipping Postal Code</label>
                            <input type="text" class="form-control border border-dark" placeholder="Postal Code" id="post_code">
                           
                        </div>
                        <div class="d-grid mt-3">
                            <span class="btn btn-primary mt-4 text-uppercase" style="    font-size: 24px;
                            font-weight: 500;
                            font-family: 'Oxanium'; "  onclick="track_order();">Track My Order</span>
                        </div>
                    </form>
                    
                </div>
            </div>
            </div>
            
            <div class="tracking_details d-none">
            </div>
@endsection
@section('javascript')
<script>
	
	function track_order(){
	$("#track_error").html("");
	
		var track_number = $("#track_number").val();
		var post_code = $("#post_code").val();
		
		if(track_number == ""){
			$("#track_error").html("Please enter your tracking number");
		}else{
			alert("zxczx");
		}
		
		
		
	}

</script>
@endsection
