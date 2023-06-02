    @forelse($items as $item)
                            <div class="col-sm-12 col-md-6 col-xl-3 mt-5 mb-5" id="remove_wishlist{{$item->product_id}}">
                                <div class="products-card" style="height: 100%;">
                                    <div class="heart_icon "  onclick="favourite_action({{$item->product_id}});">
                                    @if($item->liked)
                                        <i class="fa fa-heart active" id="active_{{$item->product_id}}"></i></button>
                                        @endif
                                    </div>
                                    <img src="{{$item->image_url}}" alt=""  style="height: 80%;" />
                                    <div style="padding-left: 10px; padding-right: 10px;">
                                    <div id="title_text">
                                        <span> <a href="{{ route('product_details', ['id' => $item->product_id]) }}" class="text-dark popins_family"> {{$item->product_name}} </a></span></div>
                                        <div style="font-size: 26px;">
                                            <span style="float: left; color: #5668d5;" class="popins_family">${{$item->sale_price}}</span>
                                            <span class="roboto_family" style="float: right;">
                                                <svg style="margin-top: 1px; color: #ffc400;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                                    />
                                                </svg>
                                                {{$item->avg_rating}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
	@empty
	<span class="text-center"> Data Not Found! <span>
                            @endforelse
                            
                            
