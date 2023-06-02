@extends('frontend.layouts.main')
    @section('meta_data')
    @php
        $data = metaData('products');
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
button {
        border-radius: 0px !important;
    }

    [slider] {
        width: 300px;
        position: relative;
        height: 5px;
        margin: 45px 0 10px 0;
    }

    [slider] > div {
        position: absolute;
        left: 13px;
        right: 15px;
        height: 5px;
    }

    [slider] > div > [inverse-left] {
        position: absolute;
        left: 0;
        height: 5px;
        border-radius: 10px;
        background-color: #ccc;
        margin: 0 7px;
    }

    [slider] > div > [inverse-right] {
        position: absolute;
        right: 0;
        height: 5px;
        border-radius: 10px;
        background-color: #ccc;
        margin: 0 7px;
    }

    [slider] > div > [range] {
        position: absolute;
        left: 0;
        height: 5px;
        border-radius: 14px;
        background-color: #9f9f9f;
    }

    [slider] > div > [thumb] {
        position: absolute;
        top: -7px;
        z-index: 2;
        height: 20px;
        width: 20px;
        text-align: left;
        margin-left: -11px;
        cursor: pointer;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.4);
        background-color: #fff;
        border-radius: 50%;
        outline: none;
    }

    [slider] > input[type="range"] {
        position: absolute;
        pointer-events: none;
        -webkit-appearance: none;
        z-index: 3;
        height: 14px;
        top: -2px;
        width: 100%;
        opacity: 0;
    }

    div[slider] > input[type="range"]:focus::-webkit-slider-runnable-track {
        background: transparent;
        border: transparent;
    }

    div[slider] > input[type="range"]:focus {
        outline: none;
    }

    div[slider] > input[type="range"]::-webkit-slider-thumb {
        pointer-events: all;
        width: 28px;
        height: 28px;
        border-radius: 0px;
        border: 0 none;
        background: #9f9f9f;
        -webkit-appearance: none;
    }

    div[slider] > input[type="range"]::-ms-fill-lower {
        background: transparent;
        border: 0 none;
    }

    div[slider] > input[type="range"]::-ms-fill-upper {
        background: transparent;
        border: 0 none;
    }

    div[slider] > input[type="range"]::-ms-tooltip {
        display: none;
    }

    [slider] > div > [sign] {
        opacity: 0;
        position: absolute;
        margin-left: -11px;
        top: -39px;
        z-index: 3;
        background-color: #9f9f9f;
        color: #fff;
        width: 28px;
        height: 28px;
        border-radius: 28px;
        -webkit-border-radius: 28px;
        align-items: center;
        -webkit-justify-content: center;
        justify-content: center;
        text-align: center;
    }

    [slider] > div > [sign]:after {
        position: absolute;
        content: "$";
        left: 0;
        border-radius: 16px;
        top: 19px;
        border-left: 14px solid transparent;
        border-right: 14px solid transparent;
        border-top-width: 16px;
        border-top-style: solid;
        border-top-color: #9f9f9f;
    }

    [slider] > div > [sign] > span {
        font-size: 12px;
        font-weight: 700;
        line-height: 28px;
    }

    [slider]:hover > div > [sign] {
        opacity: 1;
    }

    .dropdown-toggle::after {
        float: right;
        margin-top: 4px;
        margin-left: 7px;
    }

    .brand_filter_css .dropdown-toggle::after {
        margin-left: 182px;
    }

    .car_service .content {
        /* width: 100px; */
        padding: 6%;
    }

    .car_service .content img {
        width: 100%;
    }


    .heart_icon.active img {
        width: 100%;
        border: 2px solid #c3b4b4;
        margin-bottom: 14px;
    }

    

    .heart_icon:hover {
        cursor: pointer;
    }

    .heart_icon.active svg {
        margin: 7px;
        color: #ffffff !important;
        margin-top: 8px;
    }

    .heart_icon.active svg {
        margin: 7px;
        color: #110202;
        margin-top: 8px;
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

    .heading-6 {
        font-size: 20px;
        font-weight: bold;
    }

    .filter_button {
        text-align: left !important;
        width: 100%;
        background: white !important;
        height: 60px;
        color: #020202 !important;
    }

    .sort_filter_css ul {
        list-style-type: none;
    }

    .sort_filter_css ul li label {
        float: left;
        margin-left: -0px;
        font-size: 18px;
        line-height: 10px;
    }

    .sort_filter_css ul li input {
        float: right;
    }

    .sort_filter_css ul li {
        margin-top: 10px;
    }

    .right li {
        float: left;
        padding-right: 40px;
        font-size: 27px;
    }

    .right li .active {
        color: white;
        border: 1px solid #5668d5;
        padding: 15px;
        background: #5668d5 !important;
    }
    .custom-product {
    margin-bottom: 25px;
    }
    .custom-product a {
    font-size: 16px;
    }
    .custom-product span {
    font-size: 17px;
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
        .products-card .active{
            background: #A06AB9;
        }
        
        .pagination_active:hover{
        	 cursor: pointer;
        }
        
          .heart_icon .active{
        	border:white!important;
        	color:white!important;
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
                        <li class="text-uppercase" aria-current="page">Products</li>
                    </ol>
                </nav>
                <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">Product</h1>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="h1-title-head text-uppercase">Choose Product Categories</h1>
                </div>
            </div>
            <div class="row mt-3 filter-css">
            @foreach($category as $cat_data)
                <div class="col-sm-12 col-md-4 col-xl-3 mt-2" >
                	@if($category_id == $cat_data->id)
                    <div class="div active top_cat" id="top_cat{{$cat_data->id}}">
                        <button class="btn text-dark text-uppercase" onclick="top_category_filter({{$cat_data->id}});">{{$cat_data->name}}</button>
                    </div>
                    @else
                    <div class="div  top_cat" id="top_cat{{$cat_data->id}}">
                        <button class="btn text-dark text-uppercase" onclick="top_category_filter({{$cat_data->id}});">{{$cat_data->name}}</button>
                    </div>
                    @endif
                </div>
                @endforeach
              
            </div>
        </div>
    </div>
    <div class="mt-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-sm-12 col-md-12 col-xl-9 order-2 order-xl-1">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="h1-title-head text-uppercase">Products</h1>
                        </div>
                        <div class="col-sm-12" id="list_data">
                          
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-xl-3 order-1 order-xl-2">
                    <div class="col-sm-12">
                        <h1 class="h1-title-head  text-uppercase">Filters</h1>
                    </div>
                    <div class="col-sm-12 mt-4">
                        <h6 class="heading-6  text-uppercase">Category</h6>
                    </div>
                    <!-- Example single danger button -->
                   <select class="form-select" id="select_category" aria-label="Default select example" style="width: 100%;
padding: 15px;
background: transparent;
color: #000;
border: 2px solid #c3b4b4; text-align: left;">
			  <option selected>Category</option>
			  @foreach($category as $cat_data)
			  <option value="{{$cat_data->id}}">{{$cat_data->name}}</option>
			  @endforeach
			 
			</select>
           
                    <div class="col-sm-12 mt-5">
                        <h6 class="heading-6 text-uppercase">Brand Name</h6>
                    </div>
                       <select class="form-select d-none" multiple aria-label="Default select example" style="width: 100%;
padding: 15px;
background: transparent;
color: #000;
border: 2px solid #c3b4b4; text-align: left;">
			 @foreach($brand as $brand_data)
				
			  <option value="{{$brand_data->id}}">{{$brand_data->name}}</option>
			  @endforeach
			</select>
			
			<select class="js-example-basic-multiple" id="brand_filter" name="states[]" multiple="multiple" style="width: 100%">
			 @foreach($brand as $brand_data)
			  <option value="{{$brand_data->id}}">{{$brand_data->name}}</option>
			   @endforeach
			  
			</select>
                    <div class="col-sm-12 mt-5">
                        <h6 class="heading-6 text-uppercase">Price Range</h6>
                        
                        <div slider id="slider-distance">
                            <div>
                                <div inverse-left style="width: 70%;"></div>
                                <div inverse-right style="width: 70%;"></div>
                                <div range style="left: 0%; right: 0%;"></div>
                                <span thumb style="left: 0%;"></span>
                                <span thumb style="left: 100%;"></span>
                                <div sign style="left: 0%;">
                                    <span id="min_value">0</span>
                                </div>
                                <div sign style="left: 100%;">
                                    <span id="max_value">0</span>
                                </div>
                            </div>
                            <input
                                    type="range" id="min_value"
                                    value="0"
                                    max="1000"
                                    min="0"
                                    step="1"
                                    onchange="price_min()";
                                    oninput="
                                    this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
                                    let value = (this.value/parseInt(this.max))*100
                                    var children = this.parentNode.childNodes[1].childNodes;
                                    children[1].style.width=value+'%';
                                    children[5].style.left=value+'%';
                                    children[7].style.left=value+'%';children[11].style.left=value+'%';
                                    children[11].childNodes[1].innerHTML=this.value;"
                            />

                            <input
                                    type="range"
                                    value="1000"
                                    id="max_value"
                                    max="1000"
                                    min="0"
                                    step="1"
                                    onchange="price_max()";
                                    oninput="
                                    this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
                                    let value = (this.value/parseInt(this.max))*100
                                    var children = this.parentNode.childNodes[1].childNodes;
                                    children[3].style.width=(100-value)+'%';
                                    children[5].style.right=(100-value)+'%';
                                    children[9].style.left=value+'%';children[13].style.left=value+'%';
                                    children[13].childNodes[1].innerHTML=this.value;"
                            />
                        </div>
                    </div>
                    <div class="col-sm-12 mt-5">
                        <h6 class="heading-6 text-uppercase">Sort By</h6>
                    </div>
                    <div class="col-sm-12 sort_filter_css mb-5 roboto_family">
                        <ul style="padding-left: 0">
                            <li class="mt-4">
                                <label for="answer-1">Popularity</label>
                                <input type="radio" id="answer-1" name="question" selected onclick="sortBy(1)" value="answer-1"/>
                            </li>
                            <br/>
                            <li>
                                <label for="answer-2">Price from Low to High</label>
                                <input type="radio" id="answer-2" onclick="sortBy(2)" name="question" value="answer-2"/>
                            </li>
                            <br/>
                            <li>
                                <label for="answer-3">Price from High to Low</label>
                                <input type="radio" id="answer-3" onclick="sortBy(3)" name="question" value="answer-3"/>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
var max_price = 10000000;
var min_price = 1;

$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

function price_min(){
	min_price = $("#min_value").text();
       
        get_list();
}

function price_max(){
	max_price = $("#max_value").text();
        get_list();
}


	var category_id = "{{$category_id}}";
	var page = 1;
	var sortby = 1;
	var brand_id = 0;
	
	
	
	function sortBy(id){
		
		sortby = id;
		get_list();
	}
	
	function pagination(id){
		
		$(".pagination_active").removeClass('active');
		$("#pagination"+id).addClass('active');
		page = id;
		get_list();
	}
  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        
         $( document ).ready(function() {
	    get_list();
	});
	
	$("#select_category").change(function(){
	     var id = this.value;
	    top_category_filter(id);
	    page = 1;
	  });
	  
	  $("#brand_filter").change(function(){
	  
	  	brand_id =  $('#brand_filter').val(); 
	  	get_list();
	  
	  });
        
        function top_category_filter(id){
        	$(".top_cat").removeClass('active');
		$("#top_cat"+id).addClass('active');
		category_id = id;
		page = 1;
		get_list();
		
		
	}
        
          function get_list(){
   
        
        var formData = {
            page: page,
            category_id:category_id,
            sort_by:sortby,
            brand_id:brand_id,
            max_price:max_price,
            min_price:min_price,
        };
        
        var type = "GET";
        var ajaxurl = '{{route("get_product_name")}}';
        $.ajax({
            type: type,
            url: ajaxurl,
            data:formData,
            dataType: 'json',
            success: function (data) {
           
            	$("#min_value").val(data.min_price);
            	$("#max_value").val(data.max_price);
            	$("#list_data").html(data.html);
           
            	if(page == data.last_page){
            	
            	 $("#loadmore_data").addClass('d-none');
            	 
            	}
            },
            error: function (data) {
                console.log(data);
            }
        });
        }
        
        
        function favourite_action(id){
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
</script>
@endsection
