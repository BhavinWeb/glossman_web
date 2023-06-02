@extends('frontend.layouts.main')
@section('css')

   <style type="text/css">
      #footer {
      background: black;
      padding: 0 0 30px 0;
      color: #fff;
      font-size: 14px;
      }
           td{
            padding-right: 62px;
    padding-bottom: 10px
        }
    .btn_confirm {
  padding: 11px 50px 10px 50px;
    font-size: 1.25rem;
    border-radius: 0.3rem;
    margin-top: 1rem;

}
    .poppins_family{
       font-family: "Poppins";
    }
      
   </style>

@endsection
@section('content')
 <div id="footer" style="padding-bottom: 0;">
            <div class="container clearfix">
               <div class="common-breadcrumbs gap-2 d-flex flex-column">
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb h7">
                        <li class="text-uppercase"><a href="#">HOME</a></li>
                        <li class="text-uppercase px-4">|</li>
                        <li class="text-uppercase" aria-current="page">Confirmation</li>
                     </ol>
                  </nav>
                  <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">Confirmation</h1>
               </div>
            </div>
         </div>


            <div class="mt-5 mb-4 pt-3 container-fluid clearfix">
                <div class="container" style="background-color: #ebebeb;">
                    <h5 class="p-3 fw-semibold">Confirmation</h5>
                </div>
            </div>

            <div class="mb-5 pt-1 pb-6 container clearfix">
                <h1 class="" style="font-size: 45px;font-weight: 500">Your Order Has Been Placed</h1>
                <p class="poppins_family" style="letter-spacing: 1px;line-height: 25px;font-size: 14px;">Congratulation, {{$data['order_address']->first_name}} , {{$data['order_address']->last_name}}. your order has been placed with Glossman. You will shortly receive email on {{$data['order_address']->email}}. and also confirmation on your mobile {{$data['order_address']->phone}}. You have made the payment by using credit card of ${{$data['order_details']->total_price}}.</p>
                <table class="poppins_family my-3" style="font-size: 15px;">
                    <tr>
                        <td>Amount</td>
                        <td> : </td>
                        <td style="text-align: right;">${{$data['order_details']->total_price}}</td>
                    </tr>
                    <tr>
                        <td>Order ID</td>
                        <td> : </td>
                        <td  style="text-align: right;">#{{$data['order_details']->order_no}}</td>
                    </tr>
                    <tr>
                        <td>Payment Type</td>
                        <td> : </td>
                        <td  style="text-align: right;">Card</td>
                    </tr>
                    <tr>
                        <td>Transaction Time</td>
                        <td> : </td>
                        <td  style="text-align: right;">{{$data['order_details']->date}}</td>
                    </tr>
                </table>

                    <button style="font-size: 15px;" class="btn btn_confirm btn-primary text-uppercase px-5 py-3 fw-bold" onclick="location.href='{{route('productcategory')}}'"><i class="fas fa-plus pe-3 " style="font-size: small;"></i>Continue Shopping</button>

            </div>
@endsection
@section('javascript')
@endsection
