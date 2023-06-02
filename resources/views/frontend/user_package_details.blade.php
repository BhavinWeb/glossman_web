@extends('frontend.layouts.main')
@section('css')
<style type="text/css">

#navbarSupportedContent{
	    margin-top: 23px!important;
}
    .fa-check{
        margin-right: 10px;
    }
    .package-table td {
    padding-left: 0!important;
    padding-right: 0!important;
}
.custom-cells {
    border-bottom: 1px solid #6c757d;
    padding-bottom: 15px;
    width: 100%;
    display: block;
}
.package-visit-main {
    padding: 34px;
}
.cDate{
    color:#fff;
}
.new-cells {
    margin-left: 15%;
}
  

    .title{
        font-size: 60px;
        color: #5668d5;
        font-family: 'Oxanium';
        font-weight: 700;
    }

    .ctitle{
        font-size: 15px;
        font-family: 'Poppins';
    }

    .cDate{
        font-size: 17px;
        font-family: 'Poppins';
    }
    .visit{
        font-family: 'Poppins';
        font-size: 24px;
        font-weight: 200;
        color: #2a2a2a;
        letter-spacing: 0.5px;
    }
    .visitHead{
        font-family: 'Poppins';
        font-size: 18px;
        font-weight: 200;
        color: #5668d5;
        letter-spacing: 0.5px;
    }

.visit {
    font-family: 'Poppins';
    font-size: 24px;
    font-weight: 200;
    color: #2a2a2a;
    letter-spacing: 0.5px;
    padding-top: 30px;
}
.ctitle i.fa.fa-check.package:before {
    color: #fff;
}
.package::before {
    color: #fff;
}
.visitData{
font-family: 'Poppins';
font-size: 18px;
font-weight: 200;
color: #2a2a2a;
letter-spacing: 0.5px;
}
.my-package-title {
    margin-top: 60px;
}

    #footer {
        background: black;
        padding: 0 0 30px 0;
        color: #fff;
        font-size: 14px;
    }
    table thead tr th{
        border-style: none !important;
    }
    ul li {
        margin-bottom: 2%;
    }
    @media (min-width: 1000px) {
        .service_details{
            margin-top: 50px !important;
        }
        .time_slot{
            padding-left: 37px !important;
        }
    }
    .service_details{
        padding-bottom: 40px;
    }

</style>
@endsection
@section('content')

<div class="container">
        <div>
            <h1 class='title text-center my-package-title'>MY PACKAGE</h1>
        </div>
        @if(!empty($data))
        <div class="row bg py-4 my-4 text-light bg" style="background-size: cover; background-image: url('{{asset('frontend/images/my_package.png')}}')">
            <div class="col-sm-12 col-md-4 col-xl-3 ps-5">
                <p style="font-family: 'Poppins';">{{$data['packages']->duration}}</p>
                <h1 style="font-family:'Oxanium'; font-size: 40px; font-weight: 700;">{{$data['packages']->title}}</h1>
                <div>
                    <span style="font-family:'Oxanium'; font-size: 28px; font-weight: 700; vertical-align: top;">{{$data['packages']->currency}}</span>
                    <span class="h1" style="font-family:'Oxanium'; font-size: 60px; font-weight: 700;">{{$data['packages']->price}}</span>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-xl-6 p-3">
                <ul class="">
                @foreach($data['packages']->package_service as $service_data)
                    <li class="ctitle"><i class="fa fa-check package"></i>{{$service_data->service_count}}  {{$service_data->service_name}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-12 col-md-4 col-xl-3 sm-ml-4 time_slot text-white" style="padding-top: 10px; padding-left: 37px; color: white;">
                <table>
                    <tr>
                        <Td class="cDate">Starts</Td>
                        <Td class="cDate"></Td>
                        <Td class="cDate">:</Td>
                        <Td class="cDate"></Td>
                        <Td class="cDate">{{$data['packages']->start_date}}</Td>
                    </tr>
                    <tr>
                        <Td class="cDate">Expires</Td>
                        <Td class="cDate"></Td>
                        <Td class="cDate">:</Td>
                        <Td class="cDate"></Td>
                        <Td class="cDate">{{$data['packages']->end_date}}</Td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mb-5  package-visit-main" style="background: #F8EEFC;margin-top: -24px;" >
            <div class="col-sm-12 col-md-6 col-xl-6 my-3">
                <h1 class="font-ui fw-light" style="font-size: 40px;">Package Visits</h1>
            </div>
            <div class="col-sm-12 mb-5 desktop-view-pa">
            
                <div class="row">
                    <div class="col-sm-10">
                        <table class="table table-borderless package-table">
                        @foreach($data['packages_visit'] as $key => $visit_data)
                            <tr>
                                <td><h1 class="visit">Visit {{$key+1}}</h1></td>
                                
                            </tr>
                            <tr class="custom-new">
                                <td ><span class="visitHead">Date</span></td>
                                <td><span class="visitHead">Time</span></td>
                               
                                <td><span class="visitData new-cells">Service</span></td>
                            </tr>
                            <tr class="custom-services">
                                <td class=""><span class="visitData custom-cells">{{$visit_data->date}}</span></td>
                                <td class=""><span class="visitData custom-cells">{{$visit_data->time}}</span></td>
                               
                                <td class=""><span class="visitData custom-cells new-cells">{{$visit_data->service_name}}</span></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                
            </div>

            @foreach($data['packages_visit'] as $key => $visit_data)
             <div class="mobile-package-view">
                               <h1 class="visit">Visit {{$key+1}}</h1>
                               <div class="visit-main">
                         <div class="left-side">  
                                <span class="left-side-text">Date</span>
                                 <span class="left-side-text">Time</span>
                                 <span class="left-side-text">Service</span>
                        </div>  

                                <div class="right-side">
                                    <span class="right-side-text">{{$visit_data->date}}</span>
                                 <span class="right-side-text">{{$visit_data->time}}</span>
                                 <span class="right-side-text">{{$visit_data->service_name}}</span>
                            </div>
        </div>                   
        </div>            @endforeach
        </div>
        </div>
        @else
        <div class="row m-5">
        	<div class="col-sm-12 text-center"><h4>Package Not found!</h4></div>
        </div>
        @endif
    </div>

@endsection
@section('models')
@endsection
@section('javascript')
@endsection
