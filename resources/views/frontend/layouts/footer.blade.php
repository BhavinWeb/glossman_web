@if (\Request::is('/'))
<section style="overflow-x: hidden">
        <div class="subscribe-main mt-5 bg" style="">
            <div class="container d-flex flex-column w-full justify-content-center">
                <div class="subscribe-inner">
                    <div class="px-lg-2 subscribe_text text-start text-uppercase">
                        <div style="font-size: smaller; line-height: 3rem; ">Subscribe to our&nbsp;</div>
                        <div style="font-size: larger; line-height: 3rem">newsletter</div>
                    </div>
                    <div class="px-lg-2 flex-fill my-lg-auto">
                    <form action="{{URL::to('/store-subscriber')}}"  method="POST" style="border-radius: 0 !important;">
                         @csrf
                        <button type="submit" value="" class="subscribe_submit_button" style=""></button>
                        <div style="overflow: hidden; padding-right: 0.5em;">
   
                            <input type="email" placeholder="Email Address" name="email" id="email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                <span  class="text-danger" id="email_error"></span>
                        </div>
                       	
                      </form>
                    </div>
                </div>
            </div>
        </div>
</section>
@endif
<footer id="footer" class="text-white ">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-info clearfix" style="    margin-top: -23%;">
                        <img src="{{asset('frontend/images/white_textlogo_.svg')}}" width="90%;">
                        <p style="margin-top: -30px;">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                            nonumy eirmod tempor invidunt ut labore et</p>
                        <p style="font-size: 22px;" class="mt-5">
                            <strong class=" text-secondary" style="line-height: 35px; color:#C0C0C0 !important;    font-weight: 300;">Support
                                center 24/7</strong><br/>
                            <strong style="font-family: 'Oxanium';">+ 3 123 456-7890</strong><br/>
                        </p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 footer-links text-uppercase">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('carservice')}}">Services</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('productcategory')}}">Products</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('about_us')}}">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('promotion')}}">Promotions</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('contact_us')}}">Contact us</a></li>
                         <li><i class="bx bx-chevron-right"></i> <a href="{{route('faq_list')}}">FAQ</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links text-uppercase">
                    <h4>My Account</h4>
                    <ul>
                    @if(Auth::check())

                        <li><i class="bx bx-chevron-right"></i> <a href="{{URL::to('Package-visit')}}">Package Details</a></li>
                        
                        @endif
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Delivery Information</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{URL::to('terms-condition')}}">Term and Conditions</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{URL::to('privacy')}}">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4 class="text-uppercase">Subscribe newsletter</h4>
                    <p>Sign up here to get the latest news, updates and special offers delivered directly to your
                        inbox</p>
                        <form action="{{URL::to('/store-subscriber')}}"  method="POST" style="border-radius: 0 !important;">
                         @csrf
                        <div class="input-group mb-2">
                       
                        <input type="email" class="form-control rounded-0 footer_email" placeholder="Email Address*"  aria-label="Recipient's username" aria-describedby="basic-addon2" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required style="font-family: 'Oxanium';">
                           
                           
                            <button class="input-group-text subscribe_button_footer" id="basic-addon2" type="submit">SUBSCRIBE
                            </button>

                            <a href="javascript:" id="return-to-top"><i class="fa-solid fa-arrow-up"></i></a>

                            <!-- Test the scroll -->
                        </div>
                       
		 </form>

                                        
                </div>
            </div>
        </div>
    </div>

    <div class="container clearfix">
        <div class="copyright float-start" style="font-family: 'Poppins', sans-serif !important;">
            &copy; Copyright <strong><span>Glossman</span></strong>. All Rights Reserved
        </div>
        <div class="float-end d-flex gap-2  align-self-center mt-3">
            <a href="{{$setting->facebook}}" target="blank" class="border border-secondary rounded-2 p-3">
                <i class="fa-brands fa-facebook-f text-white"></i>
            </a>
            <a href="{{$setting->twitter}}" target="blank" class="border border-secondary rounded-2 p-3">
                <i class="fa-brands fa-twitter text-white"></i>
            </a>
            <a href="{{$setting->youtube}}" target="blank" class="border border-secondary rounded-2 p-3">
                <i class="fa-brands fa-youtube text-white"></i>
            </a>
            <a href="{{$setting->instagram}}" target="blank" class="border border-secondary rounded-2 p-3"> 
                <i class="fa-brands fa-instagram text-white"></i>
            </a>
        </div>
        <div class="credits"></div>
    </div>
</footer>
