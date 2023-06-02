@extends('frontend.layouts.main')
@section('css')
<style type="text/css">

#selected_service i {
    float: right;
    margin-left: auto;
    margin-right: -52px;
    display: block;
    margin-top: -16px;
}
   .textWrapper .fa-solid, .textWrapper .fa-star {
   font-size: 25px;
   }
   .fa-empty {
   color: white;
   border: black;
   }
   .fa-solid {
   color: #FFBE2C;
   }
   #footer {
   background: black;
   padding: 0 0 30px 0;
   color: #fff;
   font-size: 14px;
   }
   .authorDetails .avatar {
   display: inline-block;
   width: 80px;
   height: 72px;
   margin: 0 0 0 5px;
   font-size: 53px;
   }
   .textWrapper {
   display: inline-block;
   vertical-align: middle;
   text-align: left;
   line-height: 11px;
   margin-top: -18px;
   }
   .progress-bar.bg-info{
   background-color: #FFBE2C !important;
   }
   .css-3zzxgd {
   width: 50%;
   list-style-type: none;
   padding: 0;
   font-size: 30px;
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
   flex: 0 0 50px;
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
   background: #EAEAEA;
   border-radius: 20px;
   }
   .css-1byssb4 {
   content: "";
   top: 0;
   left: 0;
   position: absolute;
   height: 10px;
   background: #FFC057;
   display: block;
   width: 73%;
   border-radius: 20px;
   }
   .css-3jjbm0 {
   content: "";
   top: 0;
   left: 0;
   position: absolute;
   height: 10px;
   background: #FFC057;
   display: block;
   width: 60%;
   border-radius: 20px;
   }
   .css-1uhwjbx {
   content: "";
   top: 0;
   left: 0;
   position: absolute;
   height: 10px;
   background: #FFC057;
   display: block;
   width: 40%;
   border-radius: 20px;
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
   @media only screen and (max-width: 600px) {
   .review_user {
   width: 26% !important;
   }
   .quantity {
   width: 15% !important;
   }
   }
   @media screen and (max-width: 1350px) {
   .swal2-popup {
   font-size: 0.7rem!important;
   }
   }
   .swal2-popup {
   font-size: 1rem;
   }
   #selected_service i{
   float:right;
   }
   #selected_service i:hover{
   cursor:pointer;	
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
   <div class="container clearfix">
      <div class="common-breadcrumbs gap-2 d-flex flex-column">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb h7">
               <li class="text-uppercase"><a href="#">HOME</a></li>
               <li class="text-uppercase px-4">|</li>
               <li class="text-uppercase" aria-current="page">Service Details</li>
            </ol>
         </nav>
         <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">Service Details</h1>
      </div>
   </div>
</div>
<div class="mt-5">
   <div class="container">
      <div class="row mb-5">
         <h1 class="text-uppercase">{{$result->name}}</h1>
         <div class="col-sm-12">
            <img src="{{$result->image}}" alt="" style="height: 645px;width:100%">
         </div>
         <h1 class="mt-3 mb-2 text-uppercase">Description</h1>
         <div class="col-sm-12">
            {{$result->about_service}}
         </div>
         <h1 class="mt-3 mb-2 text-uppercase">Service Time</h1>
         <div class="col-sm-12 font-ui fw-bold">
            <p>{{$result->time}} Mins For Cleaning</p>
         </div>
         <h1 class="mt-3 mb-2 text-uppercase">Price</h1>
         <div class="col-sm-12 font-ui fw-bold">
            <p>{{$result->currency}}  {{$result->price}}</p>
         </div>
         <div class="col-sm-12 mt-3 mb-2">
            <h1 class="d-inline-block text-uppercase">Customer Reviews</h1>
            <button type="button" class="btn btn-xl pull-right common_submit_button" data-bs-toggle="modal"
               data-bs-target="#staticBackdrop"
               style="float:right;background-color: white!important;color: #5668D5!important;border: 1px solid #5668D5;">
            + WRITE COMMENT
            </button>
         </div>
         <div style="" class="col-sm-12 mt-3 mb-2 font-ui">
            <div class="authorDetails">
               <a href="/Profile/13113142" target="_blank" class="avatar fw-bold" style="
                  color: black;
                  font-size: 36px;float: left;
                  ">
               {{$result->avg_rating}}
               </a>
               <br/>
               <div class="textWrapper">
                    @if($result->avg_rating <> 1 && $result->avg_rating != 0)
                      <i class="fa-solid fa-star"></i>
		     @else
		      <i class="fa fa-star"></i>
		    @endif
		    @if($result->avg_rating > 1 )
                      <i class="fa-solid fa-star"></i>
		     @else
		      <i class="fa fa-star"></i>
		    @endif
		    @if($result->avg_rating > 2 )
                      <i class="fa-solid fa-star"></i>
		     @else
		      <i class="fa fa-star"></i>
		    @endif
		    @if($result->avg_rating > 3 )
                      <i class="fa-solid fa-star"></i>
		     @else
		      <i class="fa fa-star"></i>
		    @endif
		    @if($result->avg_rating > 4)
                      <i class="fa-solid fa-star"></i>
		     @else
		      <i class="fa fa-star"></i>
		    @endif
                  <span style="padding-left: 10px;font-size: 20px;">{{$result->total_count}} Reviews</span>
               </div>
            </div>
         </div>
         <div class="col-sm-12">
            <div class="d-flex flex-column gap-3 font-ui">
               <div class="d-flex flex-row gap-3 align-items-center" style="height: 45px;">
                  <div style="font-size: 18px;" class="">
                     5 Stars
                  </div>
                  <div class="w-50 h-auto">
                     <div class="progress" style="height: 10px;width: 400px">
                        <div class="progress-bar bg-info" role="progressbar" aria-label="Info example"
                           style="width: {{$result->star_5}}%" aria-valuenow="50" aria-valuemin="0"
                           aria-valuemax="100"></div>
                     </div>
                  </div>
               </div>
               <div class="d-flex flex-row gap-3 align-items-center"  style="height: 45px;">
                  <div  style="font-size: 18px;" class="">
                     4 Stars
                  </div>
                  <div class="w-50 h-auto">
                     <div class="progress" style="height: 10px;width: 400px;">
                        <div class="progress-bar bg-info" role="progressbar" aria-label="Info example"
                           style="width: {{$result->star_4}}%" aria-valuenow="50" aria-valuemin="0"
                           aria-valuemax="100"></div>
                     </div>
                  </div>
               </div>
               <div class="d-flex flex-row gap-3 align-items-center"  style="height: 45px;">
                  <div  style="font-size: 18px;" class="">
                     3 Stars
                  </div>
                  <div class="w-50 h-auto">
                     <div class="progress" style="height: 10px;width: 400px;">
                        <div class="progress-bar bg-info" role="progressbar" aria-label="Info example"
                           style="width: {{$result->star_3}}%" aria-valuenow="50" aria-valuemin="0"
                           aria-valuemax="100"></div>
                     </div>
                  </div>
               </div>
               <div class="d-flex flex-row gap-3 align-items-center"  style="height: 45px;">
                  <div  style="font-size: 18px;" class="">
                     2 Stars
                  </div>
                  <div class="w-50 h-auto">
                     <div class="progress" style="height: 10px;width: 400px;">
                        <div class="progress-bar bg-info" role="progressbar" aria-label="Info example"
                           style="width: {{$result->star_2}}%" aria-valuenow="50" aria-valuemin="0"
                           aria-valuemax="100"></div>
                     </div>
                  </div>
               </div>
               <div class="d-flex flex-row gap-3 align-items-center"  style="height: 45px;">
                  <div  style="font-size: 18px;" class="">
                     1 Stars
                  </div>
                  <div class="w-50 h-auto">
                     <div class="progress" style="height: 10px;width: 400px;">
                        <div class="progress-bar bg-info" role="progressbar" aria-label="Info example"
                           style="width: {{$result->star_1}}%" aria-valuenow="50" aria-valuemin="0"
                           aria-valuemax="100"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row review_1 mt-3 mb-5 comment_list" id="remove_list">
         </div>
         <div class="row review_1 mt-3 mb-5 empty_data" id="remove_list">
            <div class="col-sm-12 text-center">
               <h3>No Review Found!</h3>
            </div>
         </div>
         <div class="row review_1 mt-3 mb-5 " id="remove_list">
            <button class="btn btn-primary"  id="loadmore">Load More</button>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12 mt-3 mb-2">
            <h1 class="d-inline-block text-uppercase">Added services</h1>
            @php 
            
            	$d_none = "";
		@endphp
            @foreach($result->selected_service as $result_datas)
            @if($result_datas->id == $result->id)
            @php
            	$d_none = "d-none";
            @endphp
	    @endif
            @endforeach
            <button type="button" class="btn btn-xl pull-right common_submit_button text-uppercase mb-2 {{$d_none}}"   id="remove_button{{$result->id}}"
               style="float:right;background-color: white!important;color: #5668D5!important;border: 1px solid #5668D5;" onclick="addService(1);">
            + Add service
            </button>        
            <a href="{{URL::to('/carservice')}}" ><button type="button" class="btn btn-xl pull-right common_submit_button text-uppercase mb-2"
               style="float:right;background-color: white!important;color: #5668D5!important;border: 1px solid #5668D5;">
            + Add more service
            </button>
            </a>
         </div>
      </div>
      <br>
      <br>
      <div class="row">
         <div class="col col-sm-12 mt-3 mb-2">
            <div class="row" id="selected_service">
               @foreach($result->selected_service as $result_data)
               <div class="col col-sm-12 col-md-6 col-xl-3 mt-2" id="selected_service{{$result_data->id}}">
                 
                  <div class="btn btn-xl common_submit_button text-uppercase"
                     style="width:100%;background-color: white!important;color: gray!important;border: 1px solid gray;font-weight: normal !important;color: #000 !important;">
                      <i class="fa fa-times" aria-hidden="true" onclick="removeService({{$result_data->id}});"></i>
                  {{$result_data->name}}
                  </div>
               </div>
               @endforeach
            </div>
         </div>
      </div>
      <input type="hidden" id="selected_count" value="{{count($result->selected_service)}}">
      <div class="col-sm-12 mt-3 mb-5 mt-5">
         <button class="btn btn-xl common_submit_button" onclick="check_count();">SCHEDULE</button>
         <!-- location.href='{{route('schedule_booking')}} -->
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
                        <div class="rating rating2"><!--
		--><a href="#5" title="Give 5 stars" onclick="store_rating(5)">★</a><!--
		--><a href="#4" title="Give 4 stars" onclick="store_rating(4)">★</a><!--
		--><a href="#3" title="Give 3 stars" onclick="store_rating(3)">★</a><!--
		--><a href="#2" title="Give 2 stars" onclick="store_rating(2)">★</a><!--
		--><a href="#1" title="Give 1 star" onclick="store_rating(1)">★</a>
	</div>
                    </div>
                    
                    <form style="margin-top: -71px;">
                        <div class="col-sm-12 mt-4">
                        	<div class="form-group">
                                <label for="exampleFormControlTextarea1">Review Title</label>
                               <input type="text" id="review_title" class="form-control" value="" placeholder="Review title">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Write a Review</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" ></textarea>
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

@endsection
@section('javascript')
<script>

var selected_count = $("#selected_count").val();

function check_count(){
	
	if(selected_count <= 0){
		alert("Please select service");
		return false;
	}else{
		window.location.replace("{{route('schedule_booking')}}");

	}
	
}
var user_rating = 1;
function store_rating(star_rating){
	user_rating = star_rating;
}

    function add_reviews(){
   	
       var formData = {
         "_token": "{{ csrf_token() }}",
           product_id: "{{$result->id}}",
           rating:user_rating,
           review_title:$("#review_title").val(),
           comment:$("#exampleFormControlTextarea1").val(),
           type:2,
           
       };
       
       var type = "POST";
       var ajaxurl = "{{route('addreview')}}";
       $.ajax({
           type: type,
           url: ajaxurl,
           data:formData,
           dataType: 'json',
           success: function (data) {
           		$("#review_title").val("");
           		$("#exampleFormControlTextarea1").val("");
		   page = 1;
		   $('#staticBackdrop').modal('toggle');
		   $(".comment_list").html("");
		   get_list();
		   
           },
           error: function (data) {
               console.log(data);
           }
       });
       
       
       }
       
       
   var service_id = "{{$result->id}}";
   
   function removeService(id){
   		
          var formData = {
              service_product_id: id,
              type:2,
          };
          
          
          
          var type = "GET";
          var ajaxurl = "{{ route('addservice') }}";
          $.ajax({
              type: type,
              url: ajaxurl,	
              data:formData,
              dataType: 'json',
              success: function (data) {
             	$("#selected_count").val(selected_count--);
           	$("#remove_button"+service_id).removeClass('d-none');
             	 $("#selected_service"+id).addClass('d-none');
   		
              },
              error: function (data) {
                  console.log(data);
              }
          });
          
   	}
   	
   
   
   
   	function addService(type){
   		
          var formData = {
              service_product_id: service_id,
              type:type,
          };
          
          var type = "GET";
          var ajaxurl = "{{ route('addservice') }}";
          $.ajax({
              type: type,
              url: ajaxurl,
              data:formData,
              dataType: 'json',
              success: function (data) {
             	   Swal.fire(
   		  'Success',
   		  data.message,
   		  'success'
   		)
   		console.log(data.data);
   		if(data.action_status == 1){
   		$("#selected_count").val(selected_count++);
   		$("#remove_button"+service_id).addClass('d-none');
             var html = '';
   		html += '<div class="col col-sm-12 col-md-6 col-xl-3 mt-2"  id="selected_service'+service_id+'">';
   		
   		html += '<div class="btn btn-xl common_submit_button text-uppercase"style="width:100%;background-color: white!important;color: gray!important;border: 1px solid gray;font-weight: normal !important;color: #000 !important;">';
   		html += '  <i class="fa fa-times" aria-hidden="true" onclick="removeService('+service_id+');"></i>';
                      html +="{{$result->name}}";
                         html +='</div></div>';
   		$("#selected_service").append(html);
   		}
              },
              error: function (data) {
                  console.log(data);
              }
          });
          
   	
   		
   	}
   
   
</script>
<script>
   var product_id = "{{$result->id}}";
    var comment_page = 1;
    
     var review_filter = 1;
          $( document ).ready(function() {
      	get_list();
     });
     
     function Set_filter(id) {
     $(".comment_list").html("");
             $(".review_filter li button").removeClass("activate");
             $("#active_" + id).addClass("activate");
             review_filter= id;
             get_list();
             // alert(id);
         }
     
     
     
     
     $("#loadmore").click(function(){
     	comment_page++;
     	get_list();
     });
     
     function get_list(){
     
         
         var formData = {
             page: comment_page,
             product_id:product_id,
             filters:review_filter,
             
         };
         
         var type = "GET";
         var ajaxurl = "{{ route('service_details', ['service_id' => $result->id]) }}";
         $.ajax({
             type: type,
             url: ajaxurl,
             data:formData,
             dataType: 'json',
             success: function (data) {
            	$(".comment_list").append(data.html);
            	if(data.last_page == 1 && data.html == ""){
            		$(".empty_data").removeClass('d-none');
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
