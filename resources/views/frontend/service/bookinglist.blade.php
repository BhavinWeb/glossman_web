@extends('frontend.layouts.main')
@section('css')
<style type="text/css">
    #footer {
        background: black;
        padding: 0 0 30px 0;
        color: #fff;
        font-size: 14px;
    }

    .dropdown-toggle::after{
        float: right;
        margin-top: 10px;
    }

    .brand_filter_css .dropdown-toggle::after{
        margin-left: 182px;
    }

    .car_service .content{
        /* width: 100px; */
        padding: 6%;
    }

    .car_service .content img{
        width: 100%;
    }
    .products-card{
        padding: 10px !important;
        position: relative;
    }

    .products-card img{
        width: 100%;
        border: 2px solid #c3b4b4;
        margin-bottom: 14px;

    }

    .heart_icon{

        border: 0px solid black;
        width: 32px;
        border-radius: 50px;
        position: absolute;
        right: 0;
        margin-right: 7%;
        margin-top: 3%;

    }

    .heart_icon:hover{

        cursor: pointer;

    }

    .products-card .active svg{
        margin: 7px;
        color:#ffffff !important;
        margin-top: 8px;

    }
    .products-card svg{
        margin: 7px;
        color:#110202;
        margin-top: 8px;

    }

    .products-card .active{
        background: #A06AB9;
    }
    .heading-6{
        font-size: 20px;
        font-weight: bold;
    }
    .filter_button{
        text-align: left !important;
        width: 100%;background: white !important;
        height: 60px;color:#020202 !important;
    }
    .sort_filter_css ul{
        list-style-type: none;
    }
    .sort_filter_css ul li label{
        float: left;
        margin-left: -31px;
        font-size: 18px;
        line-height: 10px;;
    }
    .sort_filter_css ul li input{
        float: right;
    }
    .sort_filter_css ul li{
        margin-top: 10px;
    }
    .right li{
        float: left;
        padding-right: 27px;
        font-size: 27px;
    }

    .right li .active{

        border: 1px solid #5668d5;
        padding: 15px;
        background: #5668D5;
    }
    table tr td{
        padding-left: 10px;
    }
    table{
        margin-left: -7px;
    }
    .complete_order_status{
        background: #ffffff !important;
        color: #5668D5 !important;
        border: 1px solid #5668D5 !important;
    }
    .give-rating-model-main{
        margin-top: 90px;
    }
    .give-rating-model {
        padding: 0 70px 40px;
    }
    .give-rating-model h2 {
        color: #000;
    }
    .give-rating-model label {
        font-family:   Popins;
    }
    .my-order-product h2 {
        text-align: right;
        padding-bottom: 12px;
        color: #A06AB9;
        font-size: 21px;
    }
    .give-rating-model-main button.btn-close {
        opacity: 10;
    }
    .my-order-product {
        padding-bottom: 15px;
    }
    .my-order-product button.btn.common_submit_button {
        padding: 12px 35px!important;
        /* letter-spacing: 2.6px; */
        text-transform: uppercase;
        font-size: 14px;
    }
    .my-order-left h4 {
        font-family:Poppins;
        font-size: 20px;
    }
    .my-order-left td {
        font-family: 'Poppins';
        font-size: 16px;
    }
    .my-order-left {
        display: flex;
    }
    .product-right-side {
        float: right;
    }
    .product-decription {
        margin-left: 30px;
        margin-top: 10px;
    }
    .give-rating-model label {
        font-family:'Poppins';
    }

    @media only screen and (max-width: 767px) {

        .give-rating-model-main {
            margin-top: 0;
        }
        .my-order-product button.btn.common_submit_button {
            margin-bottom: 20px!important;
        }
        .my-order-left {
            display: block;
        }
        .my-order-product h2 {
            text-align: left;

        }
        .product-decription {
            margin-left: 0px;
            margin-top: 20px;
        }
        .product-right-side {
            float: left;
        }
    }
    
      #overlay{	

    top: 0;

    width: 100%;
    height:100%;
    display: none;

    }
    .cv-spinner {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;  
    }
    .spinner {
    width: 40px;
    height: 40px;
    border: 4px #ddd solid;
    border-top: 4px #2e93e6 solid;
    border-radius: 50%;
    animation: sp-anime 0.8s infinite linear;
    }
    @keyframes sp-anime {
    100% { 
        transform: rotate(360deg); 
    }
    }
    .is-hide{
    display:none;
    }


    .rating {
                width: 226px;
                margin: 0 auto 1em;
                font-size: 45px;
                overflow:hidden;
            }
    .rating input {
    float: right;
    opacity: 0;
    position: absolute;
    }
	.rating a,
    .rating label {
			float:right;
			color: #aaa;
			text-decoration: none;
			-webkit-transition: color .4s;
			-moz-transition: color .4s;
			-o-transition: color .4s;
			transition: color .4s;
		}
        .rating label:hover ~ label,
        .rating input:focus ~ label,
        .rating label:hover,
        .rating a:hover,
		.rating a:hover ~ a,
		.rating a:focus,
		.rating a:focus ~ a		{
			color: orange;
			cursor: pointer;
		}
		.rating2 {
			direction: rtl;
		}
		.rating2 a {
			float:none
		}
		
		.fa-solid{
			color:rgb(255, 208, 66)!important;
		}
		
		.fa-star{
			color:#767272;
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
                            <li class="text-uppercase" aria-current="page">My Booking</li>
                        </ol>
                    </nav>
                    <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">My Booking</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-sm-12 col-md-12">
                    <div class="row">
                        <div class="col-sm-12" id="list_data">
                 
                        </div>
                                  <div id="overlay" class="col-md-12">
			  <div class="cv-spinner">
			    <span class="spinner"></span>
			  </div>
			</div>
			 <div class="col-sm-12 mt-3 d-none" id="load_more">
                              <button class="col-sm-12 btn btn-primary" onclick="loadmore();">Load More</button>
                        </div>
                    </div>
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
            <div class="modal-body give-rating-model">
                <div class="row" style="">
                    <div class="col-sm-12 text-center">
                        <h2>Give Rating</h2>
                          <div class="rating rating2"><!--
		--><a href="#5" title="Give 5 stars" onclick="store_rating(5)">★</a><!--
		--><a href="#4" title="Give 4 stars" onclick="store_rating(4)">★</a><!--
		--><a href="#3" title="Give 3 stars" onclick="store_rating(3)">★</a><!--
		--><a href="#2" title="Give 2 stars" onclick="store_rating(2)">★</a><!--
		--><a href="#1" title="Give 1 star" onclick="store_rating(1)">★</a>
	</div>
                    </div>
                    </div>
                   
                    <form>
                        <div class="col-sm-12 mt-4">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Write a Review</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-4 text-center">
                            <button class="btn common_submit_button" type="button" onclick="add_reviews();">+ SUBMIT</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


        <div class="modal fade" id="upload_image" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content give-rating-model-main">
            <div class="modal-header" style="border-bottom-color: white!important;">
                <h5 class="modal-title" id="staticBackdropLabel"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></h5>
		
            </div>
            <div class="modal-body give-rating-model">
                <div class="row" style="">
                    <div class="col-sm-12 text-center">
                        <h2>Upload Images</h2>
                    <form>
                    
                     <div class="col-sm-12 mt-4">
                            <div class="form-group">
                               <input class="form-control" type="file" value="" id="files" name="image_upload[]" multiple  accept="image/png, image/gif, image/jpeg" 	>
                            </div><br>
				<span id="after_image_error" class="text-danger"></span>
                        </div>
                        <div class="col-sm-12 mt-4 text-center">
                            <button class="btn common_submit_button" type="button" onclick="add_afterimage();">+ SUBMIT</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
var service_booking_id = 0;

function UploadImage(id){
    service_booking_id = id;
	$("#upload_image").modal("toggle");
}

var order_id = 0;

function giverating(id){

	$("#staticBackdrop").modal("toggle");
	order_id = id;
   
}

var user_rating = 0;
function store_rating(star_rating){
	user_rating = star_rating;
   
}


function add_afterimage(){

	  var form_data = new FormData();
	  form_data.append("_token", '{{ csrf_token() }}');
	  form_data.append('service_id',service_booking_id)

   // Read selected files
   var totalfiles = document.getElementById('files').files.length;
   if(totalfiles != 0 && totalfiles < 5){
   for (var index = 0; index < totalfiles; index++) {
      form_data.append("files[]", document.getElementById('files').files[index]);
   }
    $.ajax({
        method: 'POST',
        url: '{{route("after_image_upload")}}',
        data: form_data,
        contentType: false,
        processData: false,
        success: function (data) {
        
            $("#upload_image").modal("toggle");
            alert("image uploaded successfully!");
            $("button.common_submit_button").hide();
            location.reload();
            
        },
        error: function () {
          console.log(`Failed`)
        }
    });
    }else{
    	$("#after_image_error").html("Please select image!");
    }


}

    function add_reviews(){
   	
       var formData = {
         "_token" : "{{ csrf_token() }}",
           product_id: order_id,
           rating:user_rating,
           type:2,
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
           
		   $('#staticBackdrop').modal('toggle');	 
            location.reload();
            
           },
           error: function (data) {
               console.log(data);
           }
       });
       
       
       }


	function cancel_bookig(id){
	
		 var formData = {
            booking_id: id,
           
        };
        
        
        var type = "GET";
        
        var ajaxurl = '{{route("booking_cancel")}}';
        
        $.ajax({
            type: type,
            url: ajaxurl,
            data:formData,
            dataType: 'json',
            success: function (data) {
            
           	$(".removebutton"+id).addClass('d-none');
           	$(".change_status"+id).html("cancelled");
           	$("#list_data").empty();
           	get_list();
            },
            error: function (data) {
                console.log(data);
            }
        });	
	}
	
    var page = 1;
         $( document ).ready(function() {
         
        $("#overlay").fadeIn(300);　
	    get_list();
	});

	function loadmore(){
	 	$("#overlay").fadeIn(300);　
		var prepage =  page + 1;
		page = prepage;
		get_list();
	}

	  function get_list(){
   
        
        var formData = {
            page: page,
           
        };
        
        var type = "GET";
        
        var ajaxurl = '{{route("my_booking")}}';
        
        $.ajax({
            type: type,
            url: ajaxurl,
            data:formData,
            dataType: 'json',
            success: function (data) {
            
           	 $("#overlay").fadeOut(300);　
           	 
            	 $("#list_data").append(data.html);
           
            	if(page == data.last_page){
            	
            	  $("#load_more").addClass('d-none');
            	 
            	}else{
            	  $("#load_more").removeClass('d-none');
            	}
            },
            error: function (data) {
                console.log(data);
            }
        });
        }
</script>
@endsection
