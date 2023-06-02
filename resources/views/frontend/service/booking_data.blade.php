   @foreach($items as $datas)
   <div class="row mb-4 border-bottom" id="remove_booking{{$datas->id}}">
        <div class="col-sm-12 col-md-6 mb-4 my-order-left">
            <img src="{{asset('frontend/assets/product/product-item.png')}}" alt="" style="width: 28%;">
            <div class="product-decription" style="">
                <a href="{{route('booking_detail',['id'=>$datas->booking_id])}}"><h4>{{$datas->booking_no}}</h4></a>
                <table>
                    <tr>
                        <td>Order No</td>
                        <td>:</td>
                        <td>{{$datas->booking_no}}</td>
                    </tr>
                    <tr>
                        <td>Date & Time</td>
                        <td>:</td>
                        <td>{{$datas->date}}</td>
                    </tr>
                    <tr>
                        <td>Order Status</td>
                        <td>:</td>
                        <td class="change_status{{$datas->booking_id}}">{{$datas->sp_status}}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 mb-4  my-order-product">
            <div class="product-right-side">
            <div> <h2 style="">{{$datas->service_type}}</h2> </div>
            <div class="removebutton{{$datas->booking_id}}">
            @if($datas->service_type != "instant")
            	@if($datas->sp_status != "cancelled" && $datas->sp_status != "completed")
            		<button  type="button"  class="btn common_submit_button cancel_button mt-2" onclick="cancel_bookig({{$datas->booking_id}});" >Cancle</button>
            	@endif
            		<!--@if($datas->sp_status != "completed")
            		<button class="btn common_submit_button complete_order_status mt-2" onclick="location.href='{{route('track_sp',['id'=>$datas->booking_id])}}'">Track Sp</button>
            		@endif
            		-->
                @if($datas->sp_status == "completed")

                @if ($datas->review_rating_count != 0)
                <button  type="button"  class="btn common_submit_button mt-2" onclick="giverating({{$datas->booking_id}})" style="display: none;">Give Rating</button>
               
                @else
                <button  type="button"  class="btn common_submit_button mt-2" onclick="giverating({{$datas->booking_id}})">Give Rating</button>
                @endif



                @if (!empty($datas->image))
                    <button  type="button"  class="btn common_submit_button mt-2" onclick="UploadImage({{$datas->booking_id}})" style="display: none;">Upload Image</button>
                
                @else
                
                <button  type="button"  class="btn common_submit_button mt-2"  onclick="UploadImage({{$datas->booking_id}})">Upload Image</button>
                @endif
                    
                @endif
            		
                @if($datas->sp_status != "cancelled")
                    <button class="btn common_submit_button complete_order_status mt-2" onclick="location.href='{{route('track_sp',['id'=>$datas->booking_id])}}'">Track Sp</button>
                @endif
            		
		 	
		@endif
		
		</div>
                
               
            </div>
        </div>
    </div>
    
    @endforeach
