<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Modules\Service\Entities\Service;
use Modules\Category\Entities\Category;
use Modules\Brand\Entities\Brand;
use Modules\Location\Entities\City;
use Modules\Location\Entities\State;
use App\Models\User;
use App\Models\Slider;
use App\Models\Package;
use App\Models\Setting;
use App\Models\Favourite_product;
use App\Models\ReviewRating;
use App\Models\Contactus;
use App\Models\purchesd_packages;
use App\Models\User_package;
use App\Models\Faq;
use Carbon\Carbon;
use Modules\Coupon\Entities\Coupon;
use Modules\Product\Entities\Product;
use URL;
use DB;
use Auth;
use View;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     
     public function search_data(Request $request){
     	$search = $request->search;
    
     	$products = Product::Where('title', 'like', '%' . $search . '%')->get();
     	$categories = Category::Where('name', 'like', '%' . $search . '%')->get();
     	$Services = Service::Where('name', 'like', '%' . $search . '%')->get();
     	
	$view=view::make('frontend.search_data',['products'=>$products,'services'=>$Services,'categories'=>$categories])->render();
        return response()->json(['html'=>$view]);
     	
     }
    public function index()
    {
        if(\Auth::check()) {
            $user = auth()->user();

            $user_id = $user->id;
        }else{
            $user_id = '';
        }

        $slider = Slider::get();

        $service = Service::where('status',1)->limit(6)->get();

        $category = Category::limit(6)->get();

        foreach ($slider as $slider_1) {
            $slider_1["image"] = URL::to("/") . "/" . $slider_1->image;
        }

        $purchesd_packages = User_package::where("user_id", $user_id)->first();

       // $packages = Package::where("status", 1)->get();
	$packages_all = Package::where("status", 1)
                ->with("package_service")
                ->get();
                
      
        $data["packages"] = $packages_all;
        $data["slider"] = $slider;
        $data['service'] = $service;
        $data['category'] = $category;
        $data["package"] = $purchesd_packages;

        return view('frontend.welcome',$data);
    }


    // car service index
    public function serviceIndex()
    {
        $services = Service::where('status',1)->get();
        $data['services'] = $services;
        return view('frontend.carservice',$data);
    }


    public function productIndex(){
        $products = Category::where('status',1)->get();
        $data['products'] = $products;

        return view('frontend.productcategory' , $data);
    }

    public function couponIndex(){
        $coupons = Coupon::get();
        $data['coupons'] = $coupons;

        return view('frontend.promotions',$data);
    }
    
    public function faq_list(){
    	
    	 $faq = Faq::get();
         $data['faq'] = $faq;

        return view('frontend.faq_list',$data);
    
    }
    
    public function payment_checkout(){
   	
   	
   
   	$random_generate = rand(0000,9999);	
   	
    	// Generated @ codebeautify.org
 
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://connect.squareupsandbox.com/v2/online-checkout/payment-links');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n    \"idempotency_key\": \"sdjfhisfhisdufhidfuh\",\n    \"quick_pay\": {\n      \"name\": \"Auto Detailing\",\n      \"price_money\": {\n        \"amount\": 12500,\n        \"currency\": \"USD\"\n      },\n      \"location_id\": \"{\"\n LW3NQPXZS6PW2   }\n  }");
	
	$headers[] = 'Square-Version: 2022-11-16';
	$headers[] = 'Authorization: Bearer EAAAEGzZBBo7PQxLSgL_iImLqgwnSx5u3FeIBkFzQO0FB52jvCxg5DtqCYx';
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
	    echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
	
    	print_r($result);
    	die;
    }

    public function get_state(Request $request){
        $state = DB::table('states')->where('country_id',$request->country_id)->get();
        return  $state;
    }
    public function get_city(Request $request){
        $state = DB::table('cities')->where('state_id',$request->state_id)->get();
        return  $state;
    }
    
    public function track_order(Request $request){
    
    	return view('frontend.product.track_order');
    }
    
   


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
