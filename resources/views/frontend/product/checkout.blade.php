@extends('frontend.layouts.main')
   <script
      type="text/javascript"
      src="https://sandbox.web.squarecdn.com/v1/square.js"
    ></script>
 <script>
    
      const appId = 'sandbox-sq0idb-HTwzl5t4Lrx1aevLMF44nA';
      const locationId = 'LW3NQPXZS6PW2';

      async function initializeCard(payments) {
        const card = await payments.card();
        await card.attach('#card-container');

        return card;
      }

      async function createPayment(token) {
        const body = JSON.stringify({
          locationId,
          sourceId: token,
        });
        

	
	$(".loading").removeClass('d-none');
	var fname = $("#fname").val();
		var lname = $("#lname").val();
		var area = $("#area").val();
		var phone = $("#phone").val();
		var email = $("#email").val();
	
	  var formData = {
	  "_token": "{{ csrf_token() }}",
            type: $("input[name=type]").val(),
            first_name:fname,
            last_name:lname,
            area:area,
            phone:phone,
            email:email,
            source_id:token,
        };

        
        var type = "POST";
        var ajaxurl = '{{route("place_order")}}';
        $.ajax({
            type: type,
            url: ajaxurl,
            data:formData,
            dataType: 'json',
            success: function (data) {
           	$(".loading").addClass('d-none');
            	if(data.success == true){
            		window.location.href = '/order-confirmation/'+data.data;
            		
            	}
            	else{
            	console.log(data)
	    		 Swal.fire({
		            icon: "error",
		            title: "Oops...",
		            text: "Payment cancel!",
		        });
    		}
            },
            error: function (data) {
                console.log(data);
            }
        });
      
      }

      async function tokenize(paymentMethod) {
        const tokenResult = await paymentMethod.tokenize();
        if (tokenResult.status === 'OK') {
          return tokenResult.token;
        } else {
          let errorMessage = `Tokenization failed with status: ${tokenResult.status}`;
          if (tokenResult.errors) {
            errorMessage += ` and errors: ${JSON.stringify(
              tokenResult.errors
            )}`;
          }

          throw new Error(errorMessage);
        }
      }

      // status is either SUCCESS or FAILURE;
      function displayPaymentResults(status) {
        
      }

      document.addEventListener('DOMContentLoaded', async function () {
        if (!window.Square) {
          throw new Error('Square.js failed to load properly');
        }

        let payments;
        try {
          payments = window.Square.payments(appId, locationId);
        } catch {
          const statusContainer = document.getElementById(
            'payment-status-container'
          );
          
          return;
        }

        let card;
        try {
          card = await initializeCard(payments);
        } catch (e) {
          console.error('Initializing Card failed', e);
          return;
        }

        // Checkpoint 2.
        async function handlePaymentMethodSubmission(event, paymentMethod) {
          event.preventDefault();

          try {
            // disable the submit button as we await tokenization and make a payment request.
           
            const token = await tokenize(paymentMethod);
            const paymentResults = await createPayment(token);
            displayPaymentResults('SUCCESS');

            console.debug('Payment Success', paymentResults);
          } catch (e) {
            
            displayPaymentResults('FAILURE');
            console.error(e.message);
          }
        }

        const cardButton = document.getElementById('card-button');
        cardButton.addEventListener('click', async function (event) {
         var chks = $("input[name='terms_condition']:checkbox");

   
        $("#fname_error").html("");
		$("#lname_error").html("");
		$("#area_error").html("");
		$("#phone_error").html("");
		$("#email_error").html("");
		 $("#terms_checkbox_error").html("");
		
		var fname = $("#fname").val();
		var lname = $("#lname").val();
		var area = $("#area").val();
		var phone = $("#phone").val();
		var email = $("#email").val();
	
		var i = 1;
      var regex =
   /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		
		
		
		if(fname == ""){
		
			$("#fname_error").html("Please enter first name!");
			i = 0;
		}
		
		if(lname == ""){
			$("#lname_error").html("Please enter last name!");
			i = 0;
		}
		
		if(area == ""){
			$("#area_error").html("Please enter area ");
			i = 0;
		}

		if(phone == ""){
			$("#phone_error").html("Please enter phone number");
			i = 0;
		}else{
			if(phone.length != 10){
			$("#phone_error").html("Please enter valid phone number");
			i = 0;
			}
		}
		if(email == ""){
			$("#email_error").html("Please enter email");
			i = 0;
		}

      if(email != "" && !email.match(regex)){
         $("#email_error").html("Please enter correct email");
			i = 0;
      }
      
       if (chks.not(":checked").length > 0)  {
       $("#terms_checkbox_error").html("Please checked check box of term & conditions.");
       i = 0;
    }
		
		if(i == 0){
		
			return false;
		}else{
			
			await handlePaymentMethodSubmission(event, card);
			
		}
          
        });
      });
    </script>
@section('css')
<style type="text/css">
   #footer {
   background: black;
   padding: 0 0 30px 0;
   color: #fff;
   font-size: 14px;
   }
   .btn-primary {
   background-color: #5668d5 !important;
   }
   .text-primary {
   color: #5668d5 !important;
   }
   .ul_main {
   list-style-type: none;
   margin: 0;
   padding: 0;
   border-bottom: 1px solid #555;
   }
   .li_main {
   display: inline;
   margin-left: 10%;
   }
   .cart_btn {
   border-color: #0d6efd !important;
   padding-top: 1rem !important;
   padding-bottom: 1rem !important;
   padding-right: 3rem !important;
   padding-left: 3rem !important;
   margin: 0.5rem !important;
   border-radius: 0 !important;
   }
   .body_li {
   list-style: none !important;
   margin-bottom: 50%;
   }
   .form-control-xl {
   width: 100%;
   padding-top: 1rem !important;
   padding-bottom: 1rem !important;
   }
   .checkout-first-box {
   padding: 25px;
   }
   .checkout-first-box h5 {
   font-size: 20px;
   line-height: 6px!important;
   vertical-align: middle;
   margin: 0;
   letter-spacing: 0.5px;
   }
   .checkout-first-box a {
   font-size: 20px;
   line-height: 6px!important;
   vertical-align: middle;
   margin: 0;
   letter-spacing: 0.5px;
   color: #000;
   padding-left: 8px;
   text-decoration: underline;
   }
   .billing-main h1,.your-order-main h1 {
   color: #000;
   font-size: 40px;
   letter-spacing: 0.6px;
   padding-bottom: 20px;
   }
   .billing-main span {
   font-size: 16px;
   font-family: 'Poppins';
   color: #000;
   font-weight: 500;
   }
   .billing-main label.form-check-label {
   font-family: 'Poppins';
   color: #000;
   font-size: 18px;
   }
   .billing-main .form-check-input:checked {
   background-color: #000;
   border-color: #000;
   }
   .billing-main label {
   font-size: 16px;
   font-family: 'Poppins';
   color: #000;
   padding-bottom: 10px;
   }
   .billing-main select.form-select.form-select-lg {
   padding: 0 15px!important;
   font-size: 17px;
   border: 2px solid #ced4da!important;
   }
   .billing-main input.form-control.form-control-xl {
   border: 2px solid #ced4da!important;
   border-radius: 0px;
   }
   .billing-main h4 {
   font-size: 20px;
   font-family: 'Poppins';
   letter-spacing: 0.2px;
   padding-top: 10px;
   }
   .billing-main {
   padding-right: 40px;
   }
   .your-order-main h4 {
   color: #000;
   font-size: 35px;
   letter-spacing: 0.6px;
   }
   .your-order-main h2.my-4.text-primary.text_link_color {
   font-size: 35px;
   letter-spacing: 0.4px;
   }
   .your-order-main .form-check-input:checked {
   background-color: #000;
   border-color: #000;
   }
   .your-order-main label {
   display: inline-block;
   font-family: 'Poppins';
   font-size: 16px;
   }
   .your-order-main span {
   font-family: 'Poppins';
   font-size: 25px;
   }
   .your-order-main span.h4 {
   font-size: 20px;
   color: #000;
   }
   .your-order-main input#typeText {
   font-family: 'Poppins';
   margin-right: 12px;
   }
   .your-order-main button.btn.btn-lg.btn-primary.cart_btn {
   letter-spacing: 5px;
   font-size: 18px;
   font-weight: 600;
   }
   
   
   /* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

  background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 150ms infinite linear;
  -moz-animation: spinner 150ms infinite linear;
  -ms-animation: spinner 150ms infinite linear;
  -o-animation: spinner 150ms infinite linear;
  animation: spinner 150ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>
@endsection
@section('content')

@php
   $address = $data['address'];
   $user_email = isset($address->email) ? $address->email : '';
   $user_phone = isset($address->phone) ? $address->phone : '';
   $user_fname = isset($address->fname) ? $address->fname : '';
   $user_lname = isset($address->lname) ? $address->lname : '';
@endphp

<div class="loading d-none" >Loading&#8230;</div>

<div id="footer" style="padding-bottom: 0;">
   <div class="container clearfix">
      <div class="common-breadcrumbs gap-2 d-flex flex-column">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb h7">
               <li class="text-uppercase"><a href="#">HOME</a></li>
               <li class="text-uppercase px-4">|</li>
               <li class="text-uppercase" aria-current="page">Checkout</li>
            </ol>
         </nav>
         <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">Checkout</h1>
      </div>
   </div>
</div>
<div class="my-5 px-5 container-fluid clearfix d-none">
   <div class="container checkout-first-box" style="background-color: #ebebeb;">
      <h5>Returning customer? <a href="login.html">Click here to login</a></h5>
   </div>
</div>
<div class="my-5 container-fluid">
      <div class="container">
         <div class="row">
            <div class="col-xl-6 col-md-6 col-sm-12 billing-main">
               <h1>Billing Details</h1>
               <span class="d-none"> Select the address that matches your card or payment method.</span>
               <div class="form-check my-3 ">
                  <input type="radio" class="form-check-input" id="radio1" name="type" value="home" checked />
                  <label class="form-check-label" for="radio1">Home</label>
               </div>
               <div class="form-check mb-3 ">
                  <input type="radio" class="form-check-input" id="radio2" name="type" value="work" />
                  <label class="form-check-label" for="radio2">Work</label>
               </div>
               <div class="form-check mb-3 ">
                  <input type="radio" class="form-check-input" id="radio3" name="type" value="other" />
                  <label class="form-check-label" for="radio3">Other</label>
               </div>
                <div class="row">
                  <div class="col mb-3">
                     <label for="First Name">First Name</label>
                     <input type="text" class="form-control form-control-xl" value="{{$user_fname}}" name="first_name" id="fname" placeholder="First Name" />
                     <span class="text-danger" id="fname_error"></span>
                  </div>
                  <div class="col mb-3">
                     <label for="Last Name">Last Name</label>
                     <input type="text" class="form-control form-control-xl" value="{{$user_lname}}" name="last_name" id="lname" placeholder="Last Name" />
                      <span class="text-danger" id="lname_error"></span>
                  </div>
               </div>
               
               <div id="map">

               </div>
               <div class="col mb-3">
               <label for="address"> Address</label>
               <input id="address" class="form-control form-control-xl" type="text" placeholder="Enter a location" style="top: 11px;"  value="{{$data['shipping_address']}}">
                  <!-- <input type="text" name="autocomplete" id="autocomplete" class="form-control border border-dark login_email" placeholder="Choose Location"> -->
                  <span class="text-danger" id="address_error"></span>
                  @if($errors->has('address'))
                  <span class="text-danger">{{ $errors->first('address') }}</span>
                  @endif
               </div>
               <div class="form-group" id="latitudeArea">
                  <label>Latitude</label>
                  <input type="text" id="latitude" name="latitude" class="form-control">
               </div>

               <div class="form-group" id="longtitudeArea">
                  <label>Longitude</label>
                  <input type="text" name="longitude" id="longitude" class="form-control">
               </div>

               <div class="col mb-3">
                  <label for="Company">Area</label>
                  <input type="text" class="form-control form-control-xl" placeholder="Add Area ..." name="area" id="area" />
                  <span class="text-danger" id="area_error"></span>
               </div>
               
               
               <div class="col mb-3">
                  <label for="Company">Postcode / ZIP</label>
                  <input type="text" class="form-control form-control-xl quantity_count_validation" value="{{$data['shipping_post_code']}}" placeholder="PINCODE" name="pincode" id="pincode" readonly />
                  <span class="text-danger" id="pincode_error"></span>
               </div>
               <div class="row">
                  <div class="col mb-3">
                     <label for="email">Email address</label>
                     <input type="email" class="form-control form-control-xl" placeholder="Email Address" value="{{$user_email}}" name="email" id="email" />
                     <span class="text-danger" id="email_error"></span>
                  </div>
                  <div class="col mb-3">
                     <label for="phoneno">Phone</label>
                     <input type="text" class="form-control form-control-xl quantity_count_validation" value="{{$user_phone}}" placeholder="Phone" name="phone" id="phone" />
                     <span class="text-danger" id="phone_error"></span>
                  </div>
               </div>
               <h4>Remember me</h4>
               <div class="form-check my-4">
                  <input type="checkbox" class="form-check-input" id="check2" name="option2" value="something" />
                  <label class="form-check-label" for="check2">Save my information for a faster checkout</label>
               </div>
            </div>
            <div class="col-xl-6 col-md-6 col-sm-12 your-order-main">
               <h1>Your Order</h1>
               <div class="row border p-3 popins_family">
                  <div>
                     <ul>
                        <div class="float-start">
                           <li class="body_li bold_class">Products</li>
                        </div>
                        <div class="float-end">
                           <li class="body_li bold_class">Price</li>
                        </div>
                     </ul>
                  </div>
                  <ul>
                     <!-- <li><div><span>sadas</span><span>jdskfj</span></div></li> -->
                  </ul>
                  <div class="">
                     @foreach($data['product_list'] as $p_list)
                     <div class="checkout-product">
                        <img src="{{$p_list->image_url}}" alt="" style="width: 20%;" /> <span style="margin-left: 6%;">{{\Illuminate\Support\Str::limit($p_list->product_name, $limit = 7, $end = '...')}}</span> <span style="margin-left: 23%;" class="bold_class"> X{{$p_list->product_quantity}} </span>
                        <span class="float-end" style="margin-top: 7%;">{{$p_list->currency}} {{$p_list->total_price}}</span>
                     </div>
                     <div class="border-bottom my-3"></div>
                     @endforeach
                  </div>
                  <div>
		
                     <ul>
                        <div class="float-start">
                           <li class="body_li bold_class">Subtotal</li>
                           <li class="body_li">Shipping</li>
                           <li class="body_li bold_class">Discount</li>
                           <li class="body_li bold_class">Total</li>
                        </div>
                        <div class="float-end">
                           <li class="body_li">${{$data['sub_total']}}</li>
                           <li class="body_li">${{$data['delivery_charges']}}</li>
                           <li class="body_li">{{$data['discount']}} %</li>
                           <li class="body_li bold_class">$ {{$data['total']}}</li>
                        </div>
                     </ul>
                  </div>
                  <div class="form-check ps-5">
                     <input type="checkbox" class="form-check-input" id="check5" name="option2" value="something" />
                     <label class="form-check-label" for="check5">Save my information for a faster checkout</label>
                  </div>
               </div>
               <h2 class="my-4 text-primary text_link_color">Payment</h2>
               <div class="row border p-3">
                  <div class="form-check my-3 d-none">
                     <input type="radio" class="form-check-input" id="radio1" name="optradio" value="option1" checked />
                     <label class="form-check-label" for="radio1">Paypal</label>
                  </div>
                  <div class="form-check mb-3 d-none">
                     <input type="radio" class="form-check-input" id="radio2" name="optradio" value="option2" />
                     <label class="form-check-label" for="radio2">Credit card</label>
                  </div>
                  <div class="border p-4 m-1">
                     <span class="h3">Payment with card</span><br />
                     <br />
                     <span class="h4">Enter your card details</span>
                  	<br>
                  	 <div id="card-container" class="mt-3"></div>
                  </div>
                  <div class="form-check mb-3">
                     <input type="checkbox" class="form-check-input p-2 me-2" id="check4" name="terms_condition" value="something" />
                     <label class="form-check-label" for="check4">I have read and agree to the <a href="{{URL::to('terms-condition')}}" class="text-primary"> terms and conditions*</a></label>
                     <br>
                     <span class="text-danger" id="terms_checkbox_error" style="font-size: 16px;"></span>
                  </div>
                  <div>

                     <input type="submit" class="btn btn-lg btn-primary cart_btn" id="card-button" value="+ PLACE ORDER">
                  </div>
               </div>
               <div class="p-3">
                  <span style="font-size: 18px;">Note: After the payment confirmation, the invoice will be sent directly via email.</span>
               </div>
            </div>
         </div>
      </div>
   
</div>
@endsection
@section('javascript')
	<script>

  
	$('#pincode').keypress(function (e) {    
    
                var charCode = (e.which) ? e.which : event.keyCode    
    
                if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    
                    return false;                        
    
            });
            
            $('#phone').keypress(function (e) {    
    
                var charCode = (e.which) ? e.which : event.keyCode    
    
                if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    
                    return false;                        
    
            });
            
	$('form').submit(function () {
		
		$("#fname_error").html("");
		$("#lname_error").html("");
		$("#area_error").html("");
		$("#address_error").html("");
	
		$("#phone_error").html("");
		$("#email_error").html("");
		
		var fname = $("#fname").val();
		var lname = $("#lname").val();
	
		var area = $("#area").val();
		var address = $("#address").val();
	
		var phone = $("#phone").val();
		var email = $("#email").val();
	
		var i = 1;

      var regex = "/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/";
		
		
		
		
		if(fname == ""){
		
			$("#fname_error").html("Please enter first name!");
			i = 0;
		}
		
		if(lname == ""){
			$("#lname_error").html("Please enter last name!");
			i = 0;
		}
		
	
		if(area == ""){
			$("#area_error").html("Please enter area ");
			i = 0;
		}
		if(address == ""){
			$("#address_error").html("Please enter address ");
			i = 0;
		}
		
		if(phone == ""){
			$("#phone_error").html("Please enter phone number");
			i = 0;
		}else{
			if(phone.length != 10){
			$("#phone_error").html("Please enter valid phone number");
			i = 0;
			}
		}
		if(email == ""){
			$("#email_error").html("Please enter email");
			i = 0;
		}
      if(!email.match(regex)){
         $("#email_error").html("Please enter correct email");
			i = 0;
      }
		
		if(i == 0){
		
			return false;
		}else{
			return true;
		}
	  
	});
	
	</script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5wiiyExnsmv3Drg_dRs4oTyU8Ww7iihQ&libraries=places&callback=initMap&v=weekly" async > </script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5wiiyExnsmv3Drg_dRs4oTyU8Ww7iihQ&libraries=places&callback=initMap&v=weekly" async></script> -->
    
    <script>
        $(document).ready(function () {
            $("#latitudeArea").addClass("d-none");
            $("#longtitudeArea").addClass("d-none");
            $("#postcode");
        });
    </script>
   <script>
    
    navigator.geolocation.getCurrentPosition(
       function (position) {
          initMap(position.coords.latitude, position.coords.longitude)
       },
       function errorCallback(error) {
          console.log(error)
       }
    );
    
    function initMap(lat_map,log_map) {
     var geocoder = new google.maps.Geocoder();
           var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: lat_map, lng: log_map},
          zoom: 16
        });
        
        var latlng = new google.maps.LatLng(lat_map, log_map);
                geocoder.geocode({'latLng': latlng}, function(results, status) {
                    if(status == google.maps.GeocoderStatus.OK) {
                      
                        
               $("#google_address").html(results[0]['formatted_address']);
               $("#address_value").val(results[0]['formatted_address']);
               $("#longitude_value").val(log_map);
               $("#lattitude_value").val(lat_map);
                    };
                });
        var input = document.getElementById('address');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
    
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });
    
        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
            
            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
        
            var address = '';
            
            if (place.address_components) {
                address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
        
            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            
            infowindow.open(map, marker);
          
            // Location details
            //for (var i = 0; i < place.address_components.length; i++) {
           //     if(place.address_components[i].types[0] == 'postal_code'){
             //       document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
            //    }
              //  if(place.address_components[i].types[0] == 'country'){
            //        document.getElementById('country').innerHTML = place.address_components[i].long_name;
            //    }
          //  }
            
              $("#google_address").html(place.formatted_address);
              $("#address_value").val(place.formatted_address);
              $("#longitude_value").val(place.geometry.location.lat());
              $("#lattitude_value").val(place.geometry.location.lng());
           
        });
    }
   </script>
@endsection

