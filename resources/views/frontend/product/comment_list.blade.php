  @if($type == 1)
 @foreach($items as $datas)
 <div class="col-sm-1 col-12 mt-5">
 @if(file_exists($datas->image))
 <img src="{{$datas->image}}" style="border-radius: 30px;" class="avatar review_user"
                                alt="" width="100%" />@else <img src="{{asset('uploads/user_image/avatar.png')}}" style="border-radius: 30px;" class="avatar review_user"
                                alt="" width="100%" />@endif</div>
                        <div class="col-sm-11 col-12 mt-5" style="padding-left: 20px;">
                            <div><span style="font-size: 25px;"> {{$datas->user_name}} </span></div>
                            <br>
                             <div style="color: #5a6f80">by {{$datas->user_name}} on {{$datas->date}}</div>
                            <div class="mt-3">
                              <i class="{{$datas['star'] >= 1 ? 'fa-solid':'fa'}} fa-star"></i>
                                <i class="{{$datas['star'] >= 2 ? 'fa-solid':'fa'}} fa-star"></i>
                                 <i class="{{$datas['star'] >= 3 ? 'fa-solid':'fa'}} fa-star"></i>
                                  <i class="{{$datas['star'] >= 4 ? 'fa-solid':'fa'}} fa-star"></i>
                                   <i class="{{$datas['star'] >= 5 ? 'fa-solid':'fa'}} fa-star"></i>
                                      
                                
                            </div>
                            <p class="mt-3">
                               {{$datas->comment}}
                            </p>
                           
                            <div class="helpfull_review_button">
                                <i class="fa-regular fa-thumbs-up"></i>
                                <button style="margin-left: 10px; margin-right: 10px;    background: white;
    border: none;" onclick="helpAction(1,{{$datas->id}});"> Helpful ({{$datas->helpful}}) </button>
                                <i class="fa-regular fa-thumbs-up"></i>
                                <button style="margin-left: 10px;    background: white;
    border: none;" onclick="helpAction(2,{{$datas->id}});" > Unhelpful ({{$datas->unhelpful}}) </button>
                            </div>
                            
                        </div>
@endforeach

@else

 @foreach($items as $datas)
 <div class="col-sm-1 col-12 mt-5">
 @if(file_exists($datas->image))
 <img src="{{$datas->image}}" style="border-radius: 30px;" class="avatar review_user"
                                alt="" width="100%" />@else <img src="{{asset('uploads/user_image/avatar.png')}}" style="border-radius: 30px;" class="avatar review_user"
                                alt="" width="100%" />@endif</div>
                        <div class="col-sm-11 col-12 mt-5" style="padding-left: 20px;">
                        <div class="mt-3">
                              <i class="{{$datas['star'] >= 1 ? 'fa-solid':'fa'}} fa-star"></i>
                                <i class="{{$datas['star'] >= 2 ? 'fa-solid':'fa'}} fa-star"></i>
                                 <i class="{{$datas['star'] >= 3 ? 'fa-solid':'fa'}} fa-star"></i>
                                  <i class="{{$datas['star'] >= 4 ? 'fa-solid':'fa'}} fa-star"></i>
                                   <i class="{{$datas['star'] >= 5 ? 'fa-solid':'fa'}} fa-star"></i>
                                      
                                
                            </div>
                            <div><span style="font-size: 25px;"> {{$datas->title}} </span></div>
                           
                             <div style="color: #5a6f80">by {{$datas->user_name}} on {{$datas->date}}</div>
                            
                            <p class="mt-3">
                               {{$datas->comment}}
                            </p>
                           
                            
                        </div>
@endforeach

@endif
