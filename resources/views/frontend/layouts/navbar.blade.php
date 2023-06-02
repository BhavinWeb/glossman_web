   <style>
    	@media screen and (max-width: 1000px) {
	.navbar a.nav-link.click-scroll.active:before{
		display:none;
	}
}

.select2-container{
	width:100%!important;
}

.select2-search__field{

	
}

.typeahead .dropdown-menu{

	max-width:100%!important;

}

.typeahead .dropdown-menu{
  
      display: inline-block!important;
    color: var(--p-bg-color)!important;
    font-size: var(--menu-font-size)!important;
    font-weight: var(--font-weight-medium)!important;
    position: relative!important;
    padding-top: 0px!important;
    padding-bottom: 0px!important;
    max-width:100%!important!;

    }
    
    #search_form ul{
    
    width:100%!important;	
    	
    }

    .cart_hover:hover{
        cursor: pointer;
    }


    </style>
<nav class="navbar navbar-expand-xl bg-white text-uppercase">
    <div class="container-lg d-flex gap-5 justify-content-around">
       <!-- <a class="navbar-brand" href="/"> -->
       <a class="" href="/">
            <img src="{{asset('frontend/images/logo.png')}}" class="logo img-fluid" style="width: 100%;    height: 100px;" alt="Kind Heart Charity" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="collapse navbar-collapse fw-semibold navbar-nav d-lg-none h-full d-flex justify-content-between mb-2 mb-lg-0" style="width: 100%;">
                <li class="nav-item h-full">
                    <a class="nav-link click-scroll {{ request()->is('/') ? 'active' : '' }} " href="{{route('web.home')}}">Home</a>
                </li>
                <li class="nav-item h-full">
                    <a class="nav-link click-scroll {{ request()->is('carservice') ? 'active' : '' }}" href="{{route('carservice')}}">Service</a>
                </li>
                <li class="nav-item h-full">
                    <a class="nav-link click-scroll {{ request()->is('productcategory') ? 'active' : '' }}" href="{{route('productcategory')}}">Products</a>
                </li>
                <li class="nav-item h-full">
                    <a class="nav-link click-scroll text-nowrap {{ request()->is('about-us') ? 'active' : '' }}" href="{{route('about_us')}}">About Us</a>
                </li>
                <li class="nav-item h-full">
                    <a class="nav-link click-scroll text-nowrap {{ request()->is('contact-us') ? 'active' : '' }}" href="{{route('contact_us')}}">Contact Us</a>
                </li>
                <li>
                    <a class="nav-link click-scroll text-nowrap" href="#" onclick="show_search();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                    </a>
                </li>
               
                <li class="nav-item cart_hover">
                	@if(Auth::check())
                    <a class="nav-link click-scroll text-nowrap" onclick="show_cart();" style="font-weight: 700 !important; color: black !important;">
                        Cart <span class="badge bg-primary rounded-0 pl-2" id="cart_count_header">0</span>
                    </a>
                    @else
                    <a class="nav-link click-scroll text-nowrap" href="{{route('signin')}}"  role="button" style="font-weight: 700 !important; color: black !important;">
                        Cart <span class="badge bg-primary rounded-0 pl-2">0</span>
                    </a>
                    @endif
                </li>
             
                @if(Request::is('/'))
                <li class="nav-item">
                  <a  href={{route("carservice")}}>
                    <button class="comn_btn_design btn mt-2 text-nowrap py-2" style="background-color: #5668d5;">Book Now</button>
                  </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="row d-none">
<div class="col-sm-12">
<form class="form" id="search_form">
<input class="typeahead form-control" style="margin:0px auto;width:100%;" type="text">
</form>
</div>
</div>
