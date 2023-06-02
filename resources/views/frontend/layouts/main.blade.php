<html lang="en">
    @include('frontend.layouts.head')
    @yield('css')
    <style>
    	.common-breadcrumbs {
    padding-top: 100px !important;
    padding-bottom: 80px !important;
}
        body#section_1 {
    padding-right: 0!important;
    overflow-x: hidden!important;
}

body#section_1 {
    padding-right: 0!important;
    overflow-x: hidden!important;
    padding: 0!important;
    overflow: auto;
}

#search_data{
    max-height: 250px;
    overflow-y: scroll;
}


body.modal-open {
  height: 100vh !important;
  overflow-y: hidden !important;
}

    </style>

    <body id="section_1" >
        @include('frontend.layouts.header')
        @include('frontend.layouts.navbar')
        <main>
            @yield('content')
        </main>
        @include('frontend.layouts.footer')
        <div id="modalCenter" class="modal modal-profile fade text-dark popins_family" tabindex="-1">
    <div class="modal-dialog modal-dialog-right rounded-0" style="width: 280px !important;">
        <div class="modal-content px-4 rounded-0">
        @if(Auth::check())
            <div class="modal-header d-flex flex-column gap-2 align-items-start ">
                <span class="modal-title fw-light text-primary h6">{{Auth::user()->name}} </span>
                <p class="text-black fw-light h6">#{{Auth::user()->id}}</p>


            </div>
            <div class="modal-body">

                <ul class="h6 d-flex flex-column gap-3 font-sm">
                    <li style="list-style: disc"><a href="{{route('my_booking')}}" class="text-dark"> My Bookings </a></li>
                    <li style="list-style: disc"><a href="{{route('order_list')}}" class="text-dark"> My Orders </a></li>
                    <li style="list-style: disc"><a href="{{route('Package_visit')}}" class="text-dark"> My Package </a></li>
                    <li style="list-style: disc"><a href="{{route('user_profile')}}" class="text-dark"> My Profile </a></li>
                    <li style="list-style: disc"><a href="{{route('shopping_cart')}}" class="text-dark"> Shopping Cart </a></li>
                    <li style="list-style: disc"><a href="{{route('user_setting')}}" class="text-dark"> Settings </a></li>
                    <li style="list-style: disc" class="mt-4"><a href="{{route('logout')}}" class="text-dark"> Logout </a></li>
                </ul>
                </div>
		@else
		<div class="modal-body">
		<ul class="h6 d-flex flex-column gap-3 font-sm">
                    <li style="list-style: disc"><a href="{{route('signin')}}" class="text-dark"> Login </a></li>
                    <li style="list-style: disc"><a href="{{route('signup')}}" class="text-dark"> Register </a></li>

                </ul>
                </div>
		@endif
            </div>
        </div>
    </div>
</div>


<div id="modalcart" class="modal modal-cart  modal-cart-csutom fade text-dark" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content px-3 rounded-0" style=""  style="top:140px!important;">
            <div class="modal-header modal-cart-header">
                <h5 class="modal-title text-uppercase">My Shopping cart</h5>
            </div>
            <div class="modal-body text-sm"id="nav_cart_list">

            </div>
        </div>
    </div>
</div>

<div id="search_modal" class="modal modal-cart fade text-dark" tabindex="-1">
    <div class="modal-dialog modal-md   ">
        <div class="modal-content px-3 rounded-0" >
            <div class="modal-header modal-cart-header">
                <h5 class="modal-title text-uppercase">Search</h5>
            </div>
            <div class="modal-body text-sm"id="nav_cart_list">
		<input class="form-control" id="search_value" onkeyup="search_product();" placeholder="search">
		<div class="row" id="search_data">
			
		</div>
            </div>
            
        </div>
    </div>
</div>
        @yield('models')
        <!-- JAVASCRIPT FILES -->

        <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
        <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('frontend/js/click-scroll.js')}}"></script>
        <script src="{{asset('frontend/js/counter.js')}}"></script>
        <script src="{{asset('frontend/js/custom.js')}}"></script>
        @yield('javascript')
        <script>

            $( document ).ready(function() {
                @if(Auth::check())
                cart_count();
                @endif
            });

            function addnavcart(id,type,max_q){

                var pq = $("#navcart_value"+id).val();              
                if(type == 2){

                     pq++;
                    
                }else{
			 if(pq == 0){
                        return false;
                    }
                    pq--;
                }
              
                if(max_q < pq){
                    return false;
                }

                var formData = {
                       quantity: pq,
                       product_id:id,
                };

                var type = "GET";


             var ajaxurl = "{{ route('add_nav_cart') }}";

               $.ajax({
               type: type,
               url: ajaxurl,
               data:formData,
               dataType: 'json',
               success: function (data) {
               $("#nav_quantit"+id).html(data.count);
                $("#nav_sub_total").html(data.sub_total);

                $("#navcart_value"+id).val(data.count);

               },
               error: function (data) {
                   console.log(data);
               }
           });
            }

            function show_cart(){
		if($("#cart_count_header").text() == 0){
			alert("Your cart is empty!");
			return false;
		}
           var type = "GET";

           var ajaxurl = "{{ route('get_nav_cart') }}";

           $.ajax({
           type: type,
           url: ajaxurl,
           dataType: 'json',
           success: function (data) {
	    
            $("#nav_cart_list").html(data.html);

           },
           error: function (data) {
               console.log(data);
           }
           });

                $("#modalcart").modal('toggle');


            }

        function navbar_cart_list(){

        	$('#headercart_list').click(function(){

		})

        };

	function addcart(user_q,product_id,type_cart = 1){


	   var formData = {
	        "_token": "{{ csrf_token() }}",
           quantity: user_q,
           product_id:product_id,

	       };

	       var type = "POST";

	       var ajaxurl = "{{ route('AddtoCart') }}";

	       $.ajax({
		   type: type,
		   url: ajaxurl,
		   data:formData,
		   dataType: 'json',
		   success: function (data) {

		  	if($("#cart_quantity"+product_id).val() == 0){
		  		  $("#fadin"+product_id).fadeOut();
		  	}

		  	if(!data.success){

		  		$("#cart_quantity"+product_id).val($("#cart_quantity"+product_id).val() - 1);
		  		alert("Product out of stock!");
		  	}

		  	$("#total_amount").html(data.data.total);

		  	$("#sub_total_amount").html(data.data.sub_total);

		  	$("#product_total"+product_id).html(data.data.total_product_price);
		  	
		if(type_cart == 1){
              		alert("Product update Successfully into Cart");
              }else{
              	 alert("Remove product quantity from cart");
              }

              cart_count();
		  	return false;

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
  
    
    $(document).delegate('#return-to-top', 'click', function () {
    window.scrollTo({
  top: 0,
  behavior: 'smooth'
});
});

	
	function show_search(){
	
		$("#search_modal").modal('toggle');
	}
	
	function search_product(){
		   var formData = {
	        "_token": "{{ csrf_token() }}",
           search: $("#search_value").val(),
           
	       };

	       var type = "POST";

	       var ajaxurl = "{{ route('search_data') }}";

	       $.ajax({
		   type: type,
		   url: ajaxurl,
		   data:formData,
		   dataType: 'json',
		   success: function (data) {

		  	$("#search_data").html(data.html);

		   },
		   error: function (data) {
		       console.log(data);
		   }
	       });
	}

    function cart_count(){
		   var formData = {
	        "_token": "{{ csrf_token() }}", 
	       };

	       var type = "GET";

	       var ajaxurl = "{{ route('cart_count') }}";

	       $.ajax({
		   type: type,
		   url: ajaxurl,
		   data:formData,
		   dataType: 'json',
		   success: function (data) {

		  	$("#cart_count_header").html(data);

		   },
		   error: function (data) {
		       console.log(data);
		   }
	       });
	}
	
	$('.quantity_count_validation').keypress(function (e) {    
    	
                var charCode = (e.which) ? e.which : event.keyCode    
    
                if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    
                    return false;                        
    
            });
            
           
           
function save_sub(){

    var formData = {
        "_token": "{{ csrf_token() }}",
       };

       var type = "Post";

       var ajaxurl = "{{ route('store_subscriber') }}";

       $.ajax({
       type: type,
       url: ajaxurl,
       data:formData,
       dataType: 'json',
       success: function (data) {
        alert("Product update Successfully into Cart");
       },
       error: function (data) {
           console.log(data);
       }
       });
}
</script>
</script>
</script>
@if(Session::has('success'))
<script>
    $( document ).ready(function() {

        Swal.fire({
        icon: 'success',
        title: "{{ Session::get('success') }}",
        showConfirmButton: false,
        timer: 1500
        });

});
</script>
@endif

@if(Session::has('email'))
<script>
    $( document ).ready(function() {

        Swal.fire({
        
        icon: 'error',
        title: "{{ Session::get('email') }}",
        showConfirmButton: false,
        timer: 1500
        });

});
</script>
@endif
    </body>
</html>
