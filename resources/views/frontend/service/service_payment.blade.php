@extends('frontend.layouts.main')
@section('css')
   <style type="text/css">
      .poppins_family{
      font-family: "Poppins";
      }
      .oxanium_family{
      font-family: "Oxanium";
      }
      .active{
      border-color: #5769D5 !important;
      }
      .paynow_button{
      padding: 20px 30px 20px 20px !important;
      background-color: #5668D5 !important;
      padding-right: 100px !important;
      padding-left: 100px !important;
      padding-top: 20px !important;
      padding-bottom: 20px !important;
      margin-right: 10px;
      color: white !important;
      font-weight: 600 !important;
      }
      #footer {
      background: black;
      padding: 0 0 30px 0;
      color: #fff;
      font-size: 14px;
      }
      /* h1,h2{
      font-weight: 300 !important;
      } */
      .card_css{
      margin-left: 13px !important;
      border: 1px solid #ab9a9a;;
      margin-left: 24px;
      padding: 18px;
      border-radius: 20px;
      margin-top: 10px;;
      }
      .card_css span{
      margin-left: 25px;
      }
      .card_css span input{
      margin-top: 6px;
      width: 40px;
      height: 40px;
      margin-left: 24px;
      float: right;
      }
      .input-group-lg>.form-control{
      padding: 2.5rem 1rem;
      font-size: 1.25rem;
      border-radius: 0.5rem;
      height: 68px;
      border-radius: 0px;
      border: 1px solid black;
      }
      .required:after {
      content:" *";
      color: #ff8100e0;
      }
      .form-check-input:checked{
      outline: 2px solid black;
      background-color: #010202;
      border: 4px solid #f1f7f7;
      }
      .form-check-input:checked[type=radio]{
      background-image: none!important;
      }
      .package_radio:checked  {
      content: "\f00c" !important;
      font-family: 'FontAwesome' !important;
      background: rebeccapurple m !important;
      color: #fff !important;
      }
      .form-select {
      height: 60px !important;
      background-image: url('assets/icon/arrow-down-s-fi.png');
      background-size: auto;
      background-repeat: no-repeat;
      padding: 0 15px!important;
      }
      .form-control {
      height: 60px !important;
      }
      .securely_check:checked{
      background-color: #010202 !important;
      border: 4px solid #f1f7f7 !important;
      }
      label{
      font-size: 20px;
      }
      @media only screen and (max-width: 767px) {
      .payment-details {
      margin-left: 15px;
      margin-right: 15px;
      }
      .payment-details .card_css {
      margin-left: 0px !important;  
      padding: 12px;
      margin-bottom: 15px;
      }
      .last-checkbox {
      margin: 0 15px;
      }
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

<div class="loading d-none" >Loading&#8230;</div>

 <div id="footer" style="padding-bottom: 0;">
            <div id="">
               <div class="container clearfix">
                  <div class="common-breadcrumbs gap-2 d-flex flex-column">
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb h7">
                           <li class="text-uppercase"><a href="#">HOME</a></li>
                           <li class="text-uppercase px-4">|</li>
                           <li class="text-uppercase" aria-current="page">Payment</li>
                        </ol>
                     </nav>
                     <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">Payment</h1>
                  </div>
               </div>
            </div>
         </div>
         <div class="container my-5 popins_family">
            <h1 class="text-uppercase text-bold font-weight-bold oxanium_family" style="margin-top:104px; font-weight: 700; letter-spacing:1.2px; font-size:40px;">Payment Information</h1>
            <form action="" class="mb-4 ">
               <h5 class="" style="font-weight: 300; margin-top: 30px; font-size: 20px ; font-weight:700;">Total amount: $<span id="show_price">{{$total_amount}}</span> </h5>
               <div class="form-check form-check-inline mb-4 mt-3" onclick="payment_option(1)">
                  <input class="form-check-input" checked type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                  <label class="form-check-label" for="inlineRadio1">use Package</label>
               </div>
               <div class="form-check form-check-inline mb-4" onclick="payment_option(2)">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                  <label class="form-check-label" for="inlineRadio2">Pay with Card</label>
               </div>
            </form>
            
            <div class="row mt-4 d-none" id="paymentform">
               <h1 class="text-uppercase  font-weight-bold oxanium_family" style="margin-top: 20px; letter-spacing: 1.2px; font-size: 40px;">Payment Details</h1>
              	<div id="card-container"></div>
              		<div style="display: none;">
                  <div class="row payment-details " style="margin-top: 30px;">
                     <div class="col-md-5 card_css active">
                        <div>
                           <img src="{{asset('frontend/assets/Group 4842.png')}}" alt="" style="width: 84px;"> <span> **** **** **** 2233</span> <span>  <input class="form-check-input package_radio" style=" content: '\f00c' !important;
                              font-family: 'FontAwesome' !important;
                              background: rebeccapurple m !important;
                              color: #fff !important;" type="radio" checked name="inlineRadioOptions" id="inlineRadio1" value="option1"></span>
                        </div>
                     </div>
                     <div class="col-md-5 card_css ml-5">
                        <div>
                           <img src="{{asset('frontend/assets/mastercard.png')}}" alt="" style="width: 84px;"> <span>**** **** **** 4589</span> <span>  <input class="form-check-input package_radio" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-md-8 mt-3 mt-5">
                     <label class="mb-2 required" for="">Name of cardholder</label>
                     <div class="input-group mb-4 input-group-lg">
                        <input type="text" class="form-control" placeholder="Select a Card Type">
                     </div>
                  </div>
                  <div class="col-12 col-md-8 mt-5">
                     <label class="mb-2 required" for="">Card type</label>
                     <select class="form-select mb-4 form-select-lg">
                        <option class="text-muted">Select a Card Type</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                     </select>
                  </div>
                  <div class="col-12 col-md-8 mt-5">
                     <label class="mb-2 required" for="">Card Number</label>
                     <div class="input-group mb-4 input-group-lg">
                        <input type="text" class="form-control">
                     </div>
                  </div>
                  <div class="row mt-5">
                     <div class="col-md-4">
                        <label class="mb-2 required" for="">Card Expiry</label>
                        <div class="input-group mb-4 input-group-lg">
                           <input type="text" class="form-control">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <label class="mb-2 required" for="">CVV</label>
                        <div class="input-group mb-4 input-group-lg">
                           <input type="text" class="form-control">
                        </div>
                     </div>
                  </div>
                  </div>
                  <div class="col-md-12 mb-4 mt-5">
                     <button  type="button"  class="btn btn-primary paynow_button px-5" id="card-button">PAY NOW</button>
                  </div>
               
               <div class="form-check last-checkbox">
                  <input class="form-check-input securely_check" checkd type="checkbox" id="check1" name="option1" value="something" checked>
                  <label class="form-check-label">Securely Save my Card For  Future Use.</label>
               </div>
            </div>
            <div class="row" id="packageform">
            	<div class="col-md-12 mb-4 mt-5">
                     <button  type="button"  class="btn btn-primary paynow_button px-5" onclick="bookWithpackage();">Use Package</button>
                  </div>
            </div>
         </div>
         
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header d-none" style="border-bottom-color: white!important;">
                  <h5 class="modal-title" id="staticBackdropLabel"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></h5>
               </div>
               <div class="modal-body">
                  <div class="row" style="padding: 30px;">
                     <div class="col-sm-12 text-center">
                        <h2 class="text-uppercase font-weight-bold" style="font-weight: 900;color: black;">Payment Success</h2>
                     </div>
                     <div class="col-sm-12 text-center mt-4">
                        <img src="{{asset('frontend/assets/Group 8266.png')}}" alt="" style="width: 50%;">
                        <h5 style="font-weight: 300;" class="poppins_family">
                           Payment Completed Successfully
                        </h5>
                     </div>
                     <form>
                        <div class="col-sm-12 mt-4 text-center">
                           <button class="btn common_submit_button btn-primary text-uppercase" onclick="location.href = '{{route('my_booking')}}';" type="button">My Bookings</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
@endsection
@section('javascript')
 <script
      type="text/javascript"
      src="https://sandbox.web.squarecdn.com/v1/square.js"
    ></script>
    <script>
    var payment_with_package = 0;
      const appId = 'sandbox-sq0idb-HTwzl5t4Lrx1aevLMF44nA';
      const locationId = 'LW3NQPXZS6PW2';
      var amount = 0;

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
       // alert(payment_with_package);
	amount = "{{$total_amount}}";
	  var formData = {
		 "_token": "{{ csrf_token() }}",
		   booking_date: "{{$data['date']}}",
		   booking_time: "{{$data['time']}}",
		   lattitude: "{{$data['lattitude']}}",
		   longitude: "{{$data['longitude']}}",
		   address: "{{$data['address']}}",
		   note: "{{$data['note']}}",
		    before_images: "{{$data['before_images']}}",
		   amount:amount,
		   payment_with_package: payment_with_package,
		   source_id:token,
		   
	       };
	      //alert(token);
	      //return false;
	       var type = "POST";
	       var ajaxurl = "{{route('payment_checkout_service')}}";
	       $(".loading").removeClass('d-none');
	       $.ajax({
		   type: type,
		   url: ajaxurl,
		   data:formData,
		   dataType: 'json',
		   success: function (data) {
		   	
		   	if(data.success == false){
		   		alert("oops payment cancel!");
		   	}else{
		   	$(".loading").addClass('d-none');
		   		$('#staticBackdrop').modal('toggle');
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
          statusContainer.className = 'missing-credentials';
          statusContainer.style.visibility = 'visible';
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
        
      
			await handlePaymentMethodSubmission(event, card);
			
		
          
        });
      });
    </script>
<script>



	function bookWithpackage(){
		 
	       var formData = {
	        "_token": "{{ csrf_token() }}",
		 booking_date: "{{$data['date']}}",
		   booking_time: "{{$data['time']}}",
		   lattitude: "{{$data['lattitude']}}",
		   longitude: "{{$data['longitude']}}",
		   address: "{{$data['address']}}",
		   note: "{{$data['note']}}",
		    before_images: "{{$data['before_images']}}",
		   amount:amount,
		   
	       };
	       
	       var type = "POST";
	       var ajaxurl = "{{route('checkout_service')}}";
	       $(".loading").removeClass('d-none');
	       $.ajax({
		   type: type,
		   url: ajaxurl,
		   data:formData,
		   dataType: 'json',
		   success: function (data) {
		   	$(".loading").addClass('d-none');
		   	if(data.message == "Need To pay using card!"){
		   	
		   		alert("You have no package to buy service!");
		   		payment_with_package = 0;
		   		return false;
		   	}
		   	
			  if(data.data.payment == 1){
			  	$("#paymentform").removeClass('d-none');
				$("#packageform").addClass('d-none');
				$("#show_price").html(data.data.total);
				amount = data.data.total;
				payment_with_package = 1;
			  }else{
			  	$('#staticBackdrop').modal('toggle');
			  	payment_with_package = 0;
			  }
			  
			 
		   },
		   error: function (data) {
		       console.log(data);
		   }
	       });
	}
	
	function bookwithCard(){
	
		  var formData = {
		  
		   "_token": "{{ csrf_token() }}",
		   booking_date: "{{$data['date']}}",
		   booking_time: "{{$data['time']}}",
		   lattitude: "{{$data['lattitude']}}",
		   longitude: "{{$data['longitude']}}",
		   address: "{{$data['address']}}",
		   note: "{{$data['note']}}",
		   before_images: "{{$data['before_images']}}",
		   amount:amount,
		   payment_with_package: payment_with_package,
		   
	       };
	       
	       var type = "POST";
	       var ajaxurl = "{{route('payment_checkout_service')}}";
	       $.ajax({
		   type: type,
		   url: ajaxurl,
		   data:formData,
		   dataType: 'json',
		   success: function (data) {
		   
		   	
			  
		   },
		   error: function (data) {
		       console.log(data);
		   }
	       });
	       
	}
	
	function payment_option(id){
	
		if(id == 1){
			
			$("#paymentform").addClass('d-none');
			$("#packageform").removeClass('d-none');
		}else{
		
			$("#paymentform").removeClass('d-none');
			$("#packageform").addClass('d-none');
		
		}
		
	}

</script>

