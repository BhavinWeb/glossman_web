    <div class="row" >
    @forelse($items as $item)
	
	   <div class="col-sm-12 col-md-6 col-xl-4  custom-product">
            <div class="">
                <div class="products-card"">
                <div class="heart_icon "  onclick="favourite_action({{$item->product_id}});">
                    @if($item->liked)
                        <i class="fa fa-heart active" id="active_{{$item->product_id}}"></i></button>
                        @else
                         <i class="fa fa-heart" id="active_{{$item->product_id}}"></i></button>
                       @endif
                    </div>

                    <img src="{{$item->image_url}}" alt=""/ width="100%" height="302px";>
                </div>
                <div style="padding-left: 10px; padding-right: 10px; margin-top:12px;">
                    <!-- <span> <a href="{{ route('product_details', ['id' => $item->product_id]) }}"  class="text-dark popins_family"> {{\Illuminate\Support\Str::limit($item->product_name, $limit = 18, $end = '...')}} </a></span> -->
                    <span> <a href="{{ route('product_details', ['id' => $item->product_id]) }}"  class="text-dark popins_family"> {{$item->product_name}} </a></span> 
                    <div style="font-size: 26px;">
                        <span style="float: left; color: #5668d5;" class="popins_family">{{$item->currency}} {{$item->sale_price}}</span>
                        @if($item->rating_counts > 0)
                        <span style="float: right;" class="roboto_family">
                                    <svg style="margin-top: 1px; color: #ffc400;"
                                         xmlns="http://www.w3.org/2000/svg" width="16"
                                         height="16" fill="currentColor" class="bi bi-star-fill"
                                         viewBox="0 0 16 16">
                                        <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                        />
                                    </svg>
                                    {{$item->rating_counts}}
                                </span>
                                @endif
                    </div>
                </div>
            </div>
        </div>

	@empty
	<span class="text-center"> Data Not Found! <span>
                            @endforelse
                            
                              
                                
                            </div>
                            
                            @php 
                            
                            $data = $items->links();
                            $page_link = null;
                            foreach($data->elements as $d){
                            	$page_link = $d;
                            }

                            
                            @endphp

            @if(count($items) > 0)
                            
                            
                            <div class="col-sm-12 mt-5" style="margin-bottom: 10rem !important;">
                                <ul class="right" style="float: left; list-style-type: none; padding-left: 1rem;" id="pages">
                                
                                	 @foreach($page_link as $i => $d_page)
		                            <li class=""><span class="pagination_active {{ $i == $current_page ? 'active' : '' }}" id="pagination{{$i}}" onclick="pagination({{$i}})">{{$i}}</span></li>
		                        @endforeach
                                   @if(count( $page_link) != $current_page)
                                    <li class="" onclick="pagination({{$current_page + 1}})"; style="cursor: pointer;">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                         fill="currentColor" class="bi bi-chevron-right"
                                                         viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                              d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </span>
                                    </li>
                                    @endif
                                </ul>
                            </div>

                @endif
