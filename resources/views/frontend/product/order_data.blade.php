 @foreach($items as $item)
 <div class="row mb-4 border-bottom">
	<div class="col-sm-12 col-md-6 mb-4 my-order-left">
	    <img src="{{asset('frontend/assets/product/product-item.png')}}" alt="" style="width: 28%;">
	    <div class="product-decription" style="">
		<a href="{{route('orderdetails',['order_id'=>$item->order_id])}}">
		<table>
		    <tr>
		        <td>Order No 
		        
		  	
		        </td>
		        <td>:</td>
		        <td>{{$item->order_no}}</td>
		    </tr>
		    <tr>
		        <td>Date & Time</td>
		        <td>:</td>
		        <td>{{$item->date}}</td>
		    </tr>
		    <tr>
		        <td>Order Status</td>
		        <td>:</td>
		        @if($item->order_status == "pending")
		        <td id="order_status{{$item->id}}">Pending</td>
		        @elseif($item->order_status == "processing")
		        <td id="order_status{{$item->id}}">Processing</td>
		        @elseif($item->order_status == "on_the_way")
		        <td id="order_status{{$item->id}}">On The Way</td>
		         @elseif($item->order_status == "delivered")
		         <td id="order_status{{$item->id}}">Delivered</td>
		         @else
		         <td id="order_status{{$item->id}}">Cancelled</td>
		         @endif
		    </tr>
		</table>
		</a>
	    </div>
	</div>
	
	<div class="col-sm-12 col-md-6 mb-4  my-order-product">
	    <div class="product-right-side">
		<div> <h2 style="">${{$item->total_price}}</h2> </div>
		
		@if(in_array($item->order_status,['processing','pending','on_the_way']))
			<button style="font-size: 14px;" class="btn common_submit_button text-uppercase mb-2" id="cancel_button{{$item->id}}" onclick="cancelOrder({{$item->id}});">Cancel</button> 
		@endif
		
		@if(in_array($item->order_status,['processing','pending','on_the_way']))
			<a href="{{route('product_track',['id'=>$item->id])}}"><button style="font-size: 14px;" class="btn common_submit_button complete_order_status text-uppercase mb-2">Track Order</button></a>
		@endif
		
		@if(in_array($item->order_status,['delivered']))
			@if ($item->review_rating_count != 0)
                <button  type="button"  class="btn common_submit_button " onclick="giverating({{$item->id}})" style="visibility: hidden;">Give Rating</button>
               
			@else
				<button  type="button"  class="btn common_submit_button " onclick="giverating({{$item->id}})">Give Rating</button>
			@endif




			<!-- @if($item->review_rating_count != 0)
			<button  type="button"  class="btn common_submit_button text-uppercase mb-2" style="font-size: 14px;  visibility: hidden;" onclick="giverating({{$item->id}})">Give Rating</button>
			@else
             <button  type="button"  class="btn common_submit_button text-uppercase mt-2" style="font-size: 14px;" onclick="giverating({{$item->id}})" >Give Rating</button>

			@endif -->
			
			<button style="font-size: 16px;" class="btn common_submit_button complete_order_status text-uppercase"  onclick="repeat_order({{$item->id}})">Repeat order</button>
		@endif
		
	    </div>
	</div>
</div>  
@endforeach
