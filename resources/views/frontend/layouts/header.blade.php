<header class="site-header">
    <div class="container w-full">
        <div class="d-flex gap-2 gap-lg-0 justify-content-center justify-content-lg-around align-items-center align-items-lg-stretch">
            <div class="d-flex gap-3 flex-wrap">
                <p class="d-flex mb-0 social_link">
                <a href="{{$setting->facebook}}" target="blank">
                        <img src="{{asset('social_icon/facebook.png')}}" width="36" height="37" alt="" />
                    </a>
                    <a href="{{$setting->twitter}}" target="blank">
                        <img src="{{asset('social_icon/twitter.png')}}" width="36" height="37" alt="" />
                    </a>
                    <a href="{{$setting->google}}" target="blank">
                        <img src="{{asset('social_icon/google.png')}}" width="36" height="37" alt="" />
                    </a>
                    <a href="{{$setting->instagram}}" target="blank"> 
                        <img src="{{asset('social_icon/instagram.png')}}" width="36" height="37" alt="" />
                    </a>
                </p>
                <div class="p-0 m-0" style="border: 1px solid white; background-color: white;"></div>
                <a href="{{URL::to('track-orders')}}" class="d-flex my-auto">
                    <img src="{{asset('frontend/assets/img/home/Path 38649.png')}}" style="margin-right: 10px;" width="22" height="16" alt="" />
                    <div class="d-none d-lg-block" style="    margin-top: -4px;">
                        Track Your Order
                    </div>
                </a>
            </div>
            <div class="flex-lg-fill">
                <div class="float-lg-end d-flex gap-3">
		@if(Auth::check())
                    <a class="d-flex gap-2 align-self-center" href="{{route('favourite_list')}}">
                        <img src="{{asset('frontend/assets/img/home/heart-line.png')}}" width="20" height="18" alt="" />
                        <span class="text-white d-none d-lg-block"> WishList</span>
                    </a>
		@endif
                    <div class="p-0 m-0 d-none d-lg-block" style="border: 1px solid white; background-color: white;"></div>

                    <button type="button" class="btn text-light d-flex gap-2 border-0 px-0 open_data" data-bs-toggle="modal" data-bs-target="#modalCenter">
                        <img src="{{asset('frontend/assets/img/home/user-3-line.png')}}" width="20" height="18" alt="" />
                        <span class="d-none d-lg-block">
                            My Account
                        </span>
                    </button>
                    <ul class="social-icon d-none">
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-twitter"></a>
                        </li>
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-facebook"></a>
                        </li>
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-instagram"></a>
                        </li>
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-youtube"></a>
                        </li>
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-whatsapp"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
