@extends('frontend.layouts.main')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">

      #footer {
      background: black;
      padding: 0 0 30px 0;
      color: #fff!important;
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
            
            border-radius: 50px;
            position: absolute;
            right: 0;
            margin-right: 7%;
            margin-top: 3%;
            
            padding: 8px;
		    font-size: 17px;
		   
		     background: #A06AB9;
		     

        }
        
        .heart_icon i{
        	-webkit-text-stroke-color: #fffdfd!important;
    -webkit-text-stroke-width: 1px!important;
    color:#A06AB9!important;
        }
        


        .heart_icon:hover{

            cursor: pointer;

        }

        .products-card .active svg{
            margin: 8px;
            color:#ffffff !important;
            margin-top: 10px;

        }
        
        
        .products-card svg{
            margin: 7px;
            color:#110202;
            margin-top: 8px;

        }
       	.products-card{
       		background: white;
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
        .heart_icon .active{
        	border:white!important;
        	color:white!important;
        }
        
        #title_text{
        	height:60px
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
                    <li class="text-uppercase" aria-current="page">My Wishlist</li>
                </ol>
            </nav>
            <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">My Wishlist</h1>
        </div>
    </div>
</div>

<div class="mt-5 " style="margin-bottom:2%;">
    <div class="container">
        <div class="row " style="margin-bottom: 5rem!important;">
            <div class="col-sm-12 col-md-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row" id="list_data">
                        
                           
                        </div>
                        <div class="row">
                        	<div class="col-sm-12 text-center"><button class="btn btn-primary" id="loadmore_data" onclick="loadmore();">Load More</button></div>
                        </div>
                        <div class="col-sm-12 mt-5 mb-5 d-none">
                            <ul class="right" style="float: left; list-style-type: none;">
                                <li><span class="active">01</span></li>
                                <li><span>02</span></li>
                                <li><span>03</span></li>
                                <li><span>04</span></li>
                                <li><span>05</span></li>
                                <li>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>

  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
var favourite_type = 1;
function favourite_action(id){

$("#remove_wishlist"+id).fadeOut();
	if($("#active_"+id).hasClass('active')){
		$("#active_"+id).removeClass('active');
		favourite_type = 2;
	}else{
		$("#active_"+id).addClass('active');
		favourite_type = 1;
	}
	
	
        
        var formData = {
            product_id: id,
            type:favourite_type,
        };
        var type = "GET";
        var ajaxurl = '{{route("favourite_action")}}';
        $.ajax({
            type: type,
            url: ajaxurl,
            data:formData,
            dataType: 'json',
            success: function (data) {
            	
            	$("#list_data").append(data.html);
           
            	if(page == data.last_page){
            	
            		$("#loadmore_data").addClass('d-none');
            	}
            },
            error: function (data) {
                console.log(data);
            }
        });
	
	
	
}


	var page = 1;
	$( document ).ready(function() {
	    get_list();
	});

	function loadmore(){

	page = page + 1;
	
	get_list();

	}

  function get_list(){
   
        
        var formData = {
            page: page,
        };
        var type = "GET";
        var ajaxurl = '{{route("favourite_list")}}';
        $.ajax({
            type: type,
            url: ajaxurl,
            data:formData,
            dataType: 'json',
            success: function (data) {
            
            	$("#list_data").append(data.html);
           
            	if(page == data.last_page){
            	
            		$("#loadmore_data").addClass('d-none');
            	}
            },
            error: function (data) {
                console.log(data);
            }
        });
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
       // $("#featureCarousel").carousel({interval: false});
        //$("#featureCarousel").carousel("pause");
    });
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
