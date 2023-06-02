@extends('frontend.layouts.main')
@section('css')
<style type="text/css">
    .setting_css {
        list-style-type: none;
    }

    form label {

        padding-left: 35px !important;

    }

    .cards_css svg {

        margin-right: 30px;

    }

    .setting_css li {

        height: 49px;
        /* border-bottom: 1px solid #020202; */
        margin-bottom: 31px;
        margin-top: 43px;
        font-size: 20px;

    }

    .setting_css li span {

        height: 49px;

    }

    .setting_css svg {

        width: 20px !important;
        margin-left: 25px;
        margin-right: 25px;

    }

    .setting_css a {

        color: black;

    }

    .border-secondary {
    border-color: #AFAFAF!important;
    }
    .custom-icon svg {
    width: 4%;
    }
	
	
	.button_hover:hover{
		cursor:pointer;
	} 
</style>
@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
      
        <strong>Success !</strong> {{ session('success') }}
    </div>
@endif</div>
</div> 
<div class="d-flex justify-content-center" style="margin-top: 3%;margin-bottom: 6%;">

        <div class="col-md-5 p-5 bg-white">
            <h1 class="text-center mb-4 fw-bold display-3 text-uppercase" style="color: #5668D5 !important;">Settings</h1>
            <div class="mt-5 d-flex flex-column gap-2">

                <div class="d-flex flex-row gap-3  w-full py-4 text-sm align-items-center border-bottom border-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="29.959" height="41.462"
                         viewBox="11.144 6.429 29.959 41.462">
                        <g data-name="notification">
                            <path d="M36.609 40.402H15.637a4.494 4.494 0 0 1-4.493-4.494V22.277c.016-7.362 5.984-13.324 13.346-13.332h3.266c7.368.008 13.339 5.979 13.347 13.347v13.616a4.494 4.494 0 0 1-4.494 4.494ZM24.49 11.941c-5.713.008-10.342 4.638-10.35 10.35v13.617c0 .827.67 1.498 1.497 1.498H36.61c.827 0 1.498-.67 1.498-1.498V22.277c-.017-5.708-4.644-10.328-10.351-10.336H24.49Z"
                                  fill="#212121" fill-rule="evenodd" data-name="Path 5844"/>
                            <path d="M29.938 47.892h-7.63a1.498 1.498 0 1 1 0-2.996h7.63a1.498 1.498 0 1 1 0 2.996Z"
                                  fill="#212121" fill-rule="evenodd" data-name="Path 5845"/>
                            <path d="M28.287 8.26v1.344a1.83 1.83 0 0 1-3.662 0V8.26a1.83 1.83 0 0 1 3.662 0Z"
                                  fill="#212121" fill-rule="evenodd" data-name="Path 16331"/>
                        </g>
                    </svg>
                    <div class="d-flex flex-fill justify-content-between  custom-icon">
                        <span style="font-family: 'Poppins';">Notifications</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
<!--                            <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>-->
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-row gap-3 py-4 text-sm align-items-center border-bottom border-secondary  custom-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="33" height="43" viewBox="0 0 33 43">
                        <g id="Icon_feather-lock" data-name="Icon feather-lock" transform="translate(1.5 1.5)">
                            <path id="Path_16410" data-name="Path 16410" d="M7.955,16.5H32.136a3.455,3.455,0,0,1,3.455,3.455V32.045A3.455,3.455,0,0,1,32.136,35.5H7.955A3.455,3.455,0,0,1,4.5,32.045V19.955A3.455,3.455,0,0,1,7.955,16.5Z" transform="translate(-4.5 -0.955)" fill="none" stroke="#212121" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                            <path id="Path_16411" data-name="Path 16411" d="M10.5,18.545V11.636a8.636,8.636,0,1,1,17.273,0v6.909" transform="translate(-3.591 -3)" fill="none" stroke="#212121" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                        </g>
                    </svg>
                    <div class="d-flex justify-content-between">
                        <a href="{{route('change_password')}}" class="text-dark"><span style="font-family: 'Poppins';">Change Password</span></a>
                    </div>
                </div>

                <div class="d-flex flex-row gap-3 py-4 text-sm align-items-center border-bottom border-secondary  custom-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27.605" height="28.799"
                         viewBox="12.322 11.726 27.605 28.799">
                        <path d="M38.394 40.524H13.856c-.847 0-1.534-.644-1.534-1.44V13.166c0-.796.687-1.44 1.534-1.44h24.538c.847 0 1.534.644 1.534 1.44v25.918c0 .796-.687 1.44-1.534 1.44Zm-1.534-2.88V14.606H15.39v23.04h21.47ZM19.99 18.926h12.27v2.88H19.99v-2.88Zm0 5.76h12.27v2.88H19.99v-2.88Zm0 5.76h7.669v2.88H19.99v-2.88Z"
                              fill-rule="evenodd" data-name="Path 38673"/>
                    </svg>
                    <div class="d-flex justify-content-between">
                        <span style="font-family: 'Poppins';" class="button_hover"  onclick="location.href = '{{route('Package_visit')}}';">Package Details</span>
                    </div>
                </div>

                <div class="d-flex flex-row gap-3 py-4 text-sm align-items-center border-bottom border-secondary custom-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27.262" height="27.262" viewBox="0 0 27.262 27.262">
                        <path id="Path_38606" data-name="Path 38606" d="M3,6.022A3.021,3.021,0,0,1,6.022,3H27.24a3.021,3.021,0,0,1,3.022,3.022V27.24a3.022,3.022,0,0,1-3.022,3.022H6.022A3.022,3.022,0,0,1,3,27.24Zm3.029.008v21.2h21.2V6.029Zm4.5,19.962a15.12,15.12,0,0,1-2.652-1.481,10.6,10.6,0,0,1,17.658-.235,15.138,15.138,0,0,1-2.611,1.552,7.576,7.576,0,0,0-12.395.164Zm6.1-7.845a5.3,5.3,0,1,1,5.3-5.3,5.3,5.3,0,0,1-5.3,5.3Zm0-3.029a2.272,2.272,0,1,0-2.272-2.272A2.272,2.272,0,0,0,16.631,15.116Z" transform="translate(-3 -3)"/>
                    </svg>
                    <div class="d-flex justify-content-between">
                        <span style="font-family: 'Poppins';" class="button_hover"  onclick="location.href = '{{route('delete_account')}}';">Delete Account</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('javascript')


@endsection
