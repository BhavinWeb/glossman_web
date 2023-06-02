<div class="w-full d-flex justify-content-end">
                    <button type="button" class="btn bg-white p-0 btn-sm border-0 mr-5" data-bs-dismiss="modal">X</button>
                </div>
                @foreach($data['product_list'] as $datas)
                <div class="row my-2 custom-cart-product">
                    <div class="col-sm-12 col-md-4 pl-0">
                        <img src="{{$datas->image_url}}" alt="" class="img-fluid" />
                    </div>
                    <div class="col-sm-12 col-md-8 d-flex flex-column justify-content-between" style="line-height: 29px;">
                        <p>{{$datas->product_name}}</p>
                        <div class="d-flex flex-row-reverse justify-content-between">
                            <div >
                                <div class="number">
                                    <span class="minus  cart_hover" onclick="addnavcart('{{$datas->product_id}}',1,'{{$datas->max_quantity}}');">-</span>
                                    <input type="text" value="{{$datas->product_quantity}}" id="navcart_value{{$datas->product_id}}" class="quantity_count_validations">
                                    <span class="plus  cart_hover" onclick="addnavcart('{{$datas->product_id}}',2,'{{$datas->max_quantity}}');">+</span>
                                </div>
                            </div>
                            <div >
                                <span><span  id="nav_quantit{{$datas->product_id}}">{{$datas->product_quantity}} </span> X {{$datas->currency}} {{$datas->sale_price}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <div class="d-flex justify-content-between mt-5 text-sm ">
                    <div class="">
                        <p>Subtotal</p>
                    </div>
                    <div class="" id="nav_sub_total">
                        <p >{{$data['sub_total']}}</p>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-12">
                        <div class="d-grid gap-2 d-flex text-uppercase">
                            <button class="btn bg-white w-50 text-uppercase fw-bold" onclick="window.location='{{ URL::to('productcategory') }}'" type="button" style="border: 1px solid #5668d5; font-size: 20px;color:#5668d5 ">
                                Add items
                            </button>
                            <a href="{{route('shopping_cart')}}"  class="btn btn-primary w-50 text-uppercase fw-bold" type="button"
                               style="border: 1px solid #5668d5;background:  #5668d5;font-size: 20px;color: white">
                                Checkout
                            </a>
                        </div>
                    </div>
                </div>
                
                <script>
                	$('.quantity_count_validations').keypress(function (e) {    
    	
                var charCode = (e.which) ? e.which : event.keyCode    
    
                if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    
                    return false;                        
    
            });
                </script>
