<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Modules\Coupon\Entities\Coupon;
use App\Http\Controllers\Controller;
use Darryldecode\Cart\CartCondition;
use Modules\Attribute\Entities\AttributeValue;
use Modules\Product\Entities\Product;
use Modules\Location\Entities\City;
use Modules\Location\Entities\State;
use Modules\Wishlist\Entities\Wishlist;
use Illuminate\Support\Facades\Validator;
use App\Models\Contactus;
use Auth;
use Response;
use App\Models\User;
use App\Models\Setting;
use App\Models\Cards;
use App\Models\product_cart;
use App\Models\purchesd_packages;
use App\Models\package_visit;
use Redirect;
use Input;
use Session;
use Hash;
use DB;
use View;
use Carbon\Carbon;
use App\Models\Package;
use App\Models\User_package;
use App\Models\User_package_service;
use App\Models\Package_service;
use URL;



class ProfileController extends Controller
{


 private function numberToWord($num = "")
    {
        $num = (string) ((int) $num);

        if ((int) $num && ctype_digit($num)) {
            $words = [];

            $num = str_replace([",", " "], "", trim($num));

            $list1 = [
                "",
                "one",
                "two",
                "three",
                "four",
                "five",
                "six",
                "seven",

                "eight",
                "nine",
                "ten",
                "eleven",
                "twelve",
                "thirteen",
                "fourteen",

                "fifteen",
                "sixteen",
                "seventeen",
                "eighteen",
                "nineteen",
            ];

            $list2 = [
                "",
                "ten",
                "twenty",
                "thirty",
                "forty",
                "fifty",
                "sixty",

                "seventy",
                "eighty",
                "ninety",
                "hundred",
            ];

            $list3 = [
                "",
                "thousand",
                "million",
                "billion",
                "trillion",

                "quadrillion",
                "quintillion",
                "sextillion",
                "septillion",

                "octillion",
                "nonillion",
                "decillion",
                "undecillion",

                "duodecillion",
                "tredecillion",
                "quattuordecillion",

                "quindecillion",
                "sexdecillion",
                "septendecillion",

                "octodecillion",
                "novemdecillion",
                "vigintillion",
            ];

            $num_length = strlen($num);

            $levels = (int) (($num_length + 2) / 3);

            $max_length = $levels * 3;

            $num = substr("00" . $num, -$max_length);

            $num_levels = str_split($num, 3);

            foreach ($num_levels as $num_part) {
                $levels--;

                $hundreds = (int) ($num_part / 100);

                $hundreds = $hundreds
                    ? " " .
                        $list1[$hundreds] .
                        " Hundred" .
                        ($hundreds == 1 ? "" : "s") .
                        " "
                    : "";

                $tens = (int) ($num_part % 100);

                $singles = "";

                if ($tens < 20) {
                    $tens = $tens ? " " . $list1[$tens] . " " : "";
                } else {
                    $tens = (int) ($tens / 10);
                    $tens = " " . $list2[$tens] . " ";
                    $singles = (int) ($num_part % 10);
                    $singles = " " . $list1[$singles] . " ";
                }
                $words[] =
                    $hundreds .
                    $tens .
                    $singles .
                    ($levels && (int) $num_part
                        ? " " . $list3[$levels] . " "
                        : "");
            }
            $commas = count($words);
            if ($commas > 1) {
                $commas = $commas - 1;
            }

            $words = implode(", ", $words);

            $words = trim(str_replace(" ,", ",", ucwords($words)), ", ");

            if ($commas) {
                $words = str_replace(",", " and", $words);
            }

            return $words;
        } elseif (!((int) $num)) {
            return "Zero";
        }

        return "";
    }
    
    
public function package_visit(){
	$user = Auth::User();
	        

        

              $user_id = $user->id;

        $packages_C = User_package::where("user_id", $user_id)->count();
	
        if ($packages_C > 0) {
        
        
            $packages = User_package::where("user_id", $user_id)->first();
            $packages_data = Package::where("id",  $packages->package_id)
                ->with("package_service")
                ->where("id", $packages->package_id)
                ->first();
            $packages_data["start_date"] = $packages->start_date;
            $packages_data["end_date"] = $packages->expired_date;
            $packages_data["duration"] =  $this->numberToWord($packages_data->duration) . " " . $packages_data->duration_type;
            $packages_data["is_purchased"] = 1;

            $data["packages"] = $packages_data;
        

        $data["packages_visit"] = package_visit::where(
            "purchesd_package_id",
            $packages->id
        )->get();
        
	
	}else{
	
		$data = [];
	}
        // return $this->sendResponse("package visit", $data);

     	
	return view('frontend.user_package_details',['data'=>$data]);
}

public function add_nav_cart(Request $request){
	
	
	
	$user = Auth::user();
	$user_id = $user->id;
	
	if($request->quantity == 0){
		
	 $update_cart = product_cart::where("user_id", $user_id)
            ->where("product_id", $request->product_id)
            ->delete();
            }else{

	$update_cart = product_cart::where("user_id", $user_id)
                        ->where("product_id", $request->product_id)
                        ->first();

    	$update_cart->quantity = $request->quantity;

    	$update_cart->save();
    
    }

    $base_url = URL::to('/');
	$total_cart_product = product_cart::where("user_id",$user_id)->join('products','products.id','=','product_carts.product_id')->groupBy('products.id')->select(DB::raw("CONCAT('$base_url','/',products.image) AS image_url"),'products.stock as max_quantity','product_carts.quantity as product_quantity','products.id as product_id','products.title as product_name','products.sale_price as sale_price','products.price as price','products.id as  product_id',DB::raw('product_carts.quantity*MAX(products.sale_price) AS total_price'))->where('products.status',1)->get();

	$sub_total = "$".$total_cart_product->SUM('total_price');
	

	 return response()->json(['sub_total'=>$sub_total,'count'=>$request->quantity]);

}
public function get_cart_nav(){
	$user = Auth::user();
	$user_id = $user->id;
	$base_url = URL::to('/');
	$total_cart_product = product_cart::where("user_id",$user_id)->join('products','products.id','=','product_carts.product_id')->groupBy('products.id')->select(DB::raw("CONCAT('$base_url','/',products.image) AS image_url"),'products.stock as max_quantity','product_carts.quantity as product_quantity','products.id as product_id','products.currency as currency','products.title as product_name','products.sale_price as sale_price','products.price as price','products.id as  product_id',DB::raw('product_carts.quantity*MAX(products.sale_price) AS total_price'))->where('products.status',1)->get();
	
        

	$discount = DB::table('used_coupons')->where('user_id',$user_id)->where('status',0)->first();
        
        if($discount){
        
        	$apply_coupon_discount = $discount->amount;
        	
        }else{
        
        	$apply_coupon_discount = 0;
        	
        }
        
        if($total_cart_product->count() > 0){
      
        
        $dc = Setting::select('Delivery_charges')->first();

	$data['discount'] = "$".$apply_coupon_discount;
	 $data['product_list'] = $total_cart_product;

        $data['sub_total'] = "$".$total_cart_product->SUM('total_price');

        $data['delivery_charges'] = "$".$dc->Delivery_charges;

        $data['total'] = "$".$total_cart_product->SUM('total_price') + $dc->Delivery_charges;

}else{
	$data['discount'] = "$0";
	 $data['product_list'] =[];

        $data['sub_total'] = "$0";

        $data['delivery_charges'] = "$0";

        $data['total'] = "$0";
}

        $view=view::make('frontend.nav_cart',['data'=>$data])->render();
        return response()->json(['html'=>$view]);

}

 public function error_msg($errors){
        $msg = $errors;
        $ii = 0;
        $i = [];
        foreach($msg->all() as $ermsg){
            $i[$ii] = $ermsg;
            $ii++;
        }
        return $i;
    }
    
       public function sendError($error, $errorMessages = [], $code = 200)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
    
	public function profile(){
		$user_id =Auth::user()->id;
		$user = User::find($user_id);
		$cards = Cards::where('user_id',$user_id)->get();
		
		$states = State::where('country_id',38)->pluck('id')->toArray();
		
		$city = City::whereIn("state_id", $states)->get();
		return view('frontend.profile',['user'=>$user,'city'=>$city,'cards'=>$cards]);
	}
	
	public function update_profile(Request $request){
	
	$user_id = Auth::user()->id;
	
	$user = User::find($user_id);

		if ($user) {
		    $user_email = User::where("email", $request->email)
		        ->Where("id", "!=", $user->id)
		        ->count();

		    if ($user_email == 0) {
		        $user->name = $request->name;

		        $user->email = $request->email;

		        $user->phone = $request->phone;	

		        $user->city_id = $request->city_id;
		        
		         $user->country_code = $request->country_code;
		        

		        $user->address = $request->address;

		        if ($request->file("image")) {
		        
		            $file = $request->file("image");
		            $filename = date("YmdHi") . ".png";
		            $file->move(public_path("uploads/user_image"), $filename);
		            $user->image = $filename;
		            
		        }
		        
		         if ($request->file("car_picture")) {
		         
		            $file_1 = $request->file("car_picture");
		            $filename_1 = date("YmdHi") ."1". ".png";
		            $file_1->move(public_path("uploads/user_image"), $filename_1);
		            $user->car_picture = $filename_1;
	 
		        }

		        $user->save();
		        
		        return Redirect::back();
		        }else{
		        	return Redirect::back()->withErrors(['error_msg' => 'This Email all ready in use!']);
		        }
		}
	}
	
	public function favourite_list(Request $request){
		$user_id = Auth::user()->id;
		$items = Wishlist::latest()->with('product', 'user')->get();
        	$data['items'] = $items;
        	if($request->ajax()){
        	
        	$favourite_product = Wishlist::where("user_id", $user_id)
            	->pluck("product_id")
            	->toArray();

		  $result = Product::groupBy('products.id')->select('products.stock as max_quantity','products.id as product_id','products.image as image',DB::raw('ROUND(avg(review_ratings.star)) as product_rating'),'products.title as product_name','products.price as price','products.sale_price as sale_price') ->whereIn('products.id',$favourite_product)
		->leftjoin('wishlists', function($join) use ($user_id)
        {
            $join->on('wishlists.product_id', '=', 'products.id');
            $join->where('wishlists.user_id','=', $user_id);
        })
		->withCount(['favorites as liked' => function ($q) {
		        $q->where('user_id', Auth::user()->id);
		    }])->with('reviews')->leftjoin('review_ratings','products.id','=','review_ratings.item_id')
		    ->withCasts(['liked' => 'boolean'])
		    ->paginate(10);
		   
        		 $view=view::make('frontend.wishlist_data',['items'=>$result])->render();
        		 return response()->json(['html'=>$view,'last_page'=>$result->lastpage()]);
        	}
        	return view('frontend.wishlist',$data);
	}
	
	public function favourite_action(Request $request){
		
		$user = Auth::user();
		if ($request->type == 1) {
		   $Wishlist = new Wishlist();
		    $Wishlist->user_id =  $user->id;
		    $Wishlist->product_id =  $request->product_id;
		    $Wishlist->save();

		    return response()->json(['success'=>true,'message'=>"Product added as favourite"],200);
		}

		if ($request->type == 2) {
		    $favourite_product = Wishlist::where("user_id", $user->id)
		        ->where("product_id", $request->product_id)
		        ->delete();
		    
		    return response()->json(['success'=>true,'message'=>"Product remove from favourit list"],200);
		    
		}
	
	}
	
	public function Setting(){
	
		return view('frontend.user_setting');
	
	}
	
	public function Change_password(){
	
		return view('frontend.change_password');
	
	}
	
	public function Update_password(Request $request){
	
		$user = Auth::user();
		 $validator = Validator::make($request->all(), [
		 'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
			if (!\Hash::check($value, $user->password)) {
			    return $fail(__('The current password is incorrect.'));
			}
		    }],
		    'new_password' => 'required|different:current_password',
		    'confirm_password' => 'required'
		]);
   
		if($validator->fails()){
		
		  return back()->withErrors($validator->errors());
		   
		}else{
			 $user
                        ->fill([
                            'password' => Hash::make($request->confirm_password),
                        ])
                        ->save();
                        
                         return Redirect('/user-setting')->with(['success'=>"password change"]);
		}
	}
	
	
	public function AddtoCart(Request $request){
		
         $empty_data = [];


        $user = auth::user();

        $user_id = $user->id;
		if($request->quantity == 0){
		
		 $update_cart = product_cart::where("user_id", $user_id)
                    ->where("product_id", $request->product_id)
                    ->delete();
                    
                    
                    $user =auth::user();

        $base_url = URL::to('/');

        $user_id = $user->id;

        if(isset($request->repeat_order_id) && $request->repeat_order_id != ""){

            $total_cart_product = DB::table('order_products')->where('repeat_order_id',$request->order_id)->get();

        }else{
            

	$total_cart_product = product_cart::where("user_id",$user_id)->join('products','products.id','=','product_carts.product_id')->groupBy('products.id')->select(DB::raw("CONCAT('$base_url','/',products.image) AS image_url"),'products.stock as max_quantity','product_carts.quantity as product_quantity','products.id as product_id','products.title as product_name','products.sale_price as sale_price','products.price as price','products.id as  product_id',DB::raw('product_carts.quantity*MAX(products.sale_price) AS total_price'))->where('products.status',1)->get();
	
        }

	$discount = DB::table('used_coupons')->where('user_id',$user_id)->where('status',0)->first();
        
        if($discount){
        
        	$apply_coupon_discount = $discount->amount;
        	
        }else{
        
        	$apply_coupon_discount = 0;
        	
        }
        
        if($total_cart_product->count() > 0){
      
        
        $dc = Setting::select('Delivery_charges')->first();

	$data['discount'] = "$".$apply_coupon_discount;

        $data['sub_total'] = "$".$total_cart_product->SUM('total_price');

        $data['delivery_charges'] = "$".$dc->Delivery_charges;

        $data['total'] = "$".$total_cart_product->SUM('total_price');



    }else{
    
        $dc = Setting::select('Delivery_charges')->first();

        $data['sub_total'] = 0;

        $data['delivery_charges'] = 0;

        $data['total'] = 0;

        
        
    }
    
		return response()->json(['success'=>true,'message'=>"remove card",'data'=> $data],200);
	}
       

	$product_stock = Product::where('id',$request->product_id)->first();
	
	if(!$product_stock){
	  return response()->json(['success'=>false,'message'=>"This product Not found!",'data'=> []],200);
	}

	
	
	if($product_stock->stock < $request->quantity){
	
	$user =auth::user();

        $base_url = URL::to('/');

        $user_id = $user->id;

        if(isset($request->repeat_order_id) && $request->repeat_order_id != ""){

            $total_cart_product = DB::table('order_products')->where('repeat_order_id',$request->order_id)->get();

        }else{
            

	$total_cart_product = product_cart::where("user_id",$user_id)->join('products','products.id','=','product_carts.product_id')->groupBy('products.id')->select(DB::raw("CONCAT('$base_url','/',products.image) AS image_url"),'products.stock as max_quantity','product_carts.quantity as product_quantity','products.id as product_id','products.title as product_name','products.sale_price as sale_price','products.price as price','products.id as  product_id',DB::raw('product_carts.quantity*MAX(products.sale_price) AS total_price'))->where('products.status',1)->get();
	
        }

	$discount = DB::table('used_coupons')->where('user_id',$user_id)->where('status',0)->first();
        
        if($discount){
        
        	$apply_coupon_discount = $discount->amount;
        	
        }else{
        
        	$apply_coupon_discount = 0;
        	
        }
        
        if($total_cart_product->count() > 0){
      
        
        
        $dc = Setting::select('Delivery_charges')->first();

	$data['discount'] = "$".$apply_coupon_discount;

        $data['sub_total'] = "$".$total_cart_product->SUM('total_price');

        $data['delivery_charges'] = "$".$dc->Delivery_charges;

        $data['total'] = "$".$total_cart_product->SUM('total_price');



    }else{
    
        $dc = Setting::select('Delivery_charges')->first();

        $data['sub_total'] = 0;

        $data['delivery_charges'] = 0;

        $data['total'] = 0;

        
        
    }
        
	//return $this->sendResponse($data,"This product out of stock!");
	 return response()->json(['success'=>false,'message'=>"This product out of stock!",'data'=> $data],200);
	} 
	

      
            $quantity = $request->quantity;

            $cart_product = product_cart::where("user_id", $user_id)
                ->where("product_id", $request->product_id)
                ->count();

            if ($quantity != 0) {
                if ($cart_product > 0) {
                    $update_cart = product_cart::where("user_id", $user_id)
                        ->where("product_id", $request->product_id)
                        ->first();

                    $update_cart->quantity = $quantity;

                    $update_cart->save();

                    $single_product = Product::where(
                        "id",
                        $request->product_id
                    )->first();
	
	 $data["total_product_price"] ="$".$single_product->sale_price * $quantity;

                   $user =auth::user();

        $base_url = URL::to('/');

        $user_id = $user->id;

        if(isset($request->repeat_order_id) && $request->repeat_order_id != ""){

            $total_cart_product = DB::table('order_products')->where('repeat_order_id',$request->order_id)->get();

        }else{
            

	$total_cart_product = product_cart::where("user_id",$user_id)->join('products','products.id','=','product_carts.product_id')->groupBy('products.id')->select(DB::raw("CONCAT('$base_url','/',products.image) AS image_url"),'products.stock as max_quantity','product_carts.quantity as product_quantity','products.id as product_id','products.title as product_name','products.sale_price as sale_price','products.price as price','products.id as  product_id',DB::raw('product_carts.quantity*MAX(products.sale_price) AS total_price'))->where('products.status',1)->get();
	
        }

	$discount = DB::table('used_coupons')->where('user_id',$user_id)->where('status',0)->first();
        
        if($discount){
        
        	$apply_coupon_discount = $discount->amount;
        	
        }else{
        
        	$apply_coupon_discount = 0;
        	
        }
        
        if($total_cart_product->count() > 0){
      
        
        $dc = Setting::select('Delivery_charges')->first();

	$data['discount'] = "$".$apply_coupon_discount;

        $data['sub_total'] = "$".$total_cart_product->SUM('total_price');

        $data['delivery_charges'] = "$".$dc->Delivery_charges;
	$t =$total_cart_product->SUM('total_price') ;
        $data['total'] = "$".$t;



    }else{
    
        $dc = Setting::select('Delivery_charges')->first();

        $data['sub_total'] = 0;

        $data['delivery_charges'] = 0;

        $data['total'] = 0;

       
    }
                    
                    

                    //return $this->sendResponse($data,"Updated Product Quantity!");
                   
                    return response()->json(['success'=>true,'message'=>"Updated Product Quantity!",'data'=>$data],200);
                } else {
                    $add_car = new product_cart();

                    $add_car->user_id = $user_id;

                    $add_car->product_id = $request->product_id;

                    $add_car->quantity = $quantity;

                    $add_car->save();

                    $single_product = Product::where(
                        "id",
                        $request->product_id
                    )->first();


                    $data["total_product_price"] ="$".$single_product->sale_price * $quantity;
                    
                    $user =auth::user();

        $base_url = URL::to('/');

        $user_id = $user->id;

        if(isset($request->repeat_order_id) && $request->repeat_order_id != ""){

            $total_cart_product = DB::table('order_products')->where('repeat_order_id',$request->order_id)->get();

        }else{
            

	$total_cart_product = product_cart::where("user_id",$user_id)->join('products','products.id','=','product_carts.product_id')->groupBy('products.id')->select(DB::raw("CONCAT('$base_url','/',products.image) AS image_url"),'products.stock as max_quantity','product_carts.quantity as product_quantity','products.id as product_id','products.title as product_name','products.sale_price as sale_price','products.price as price','products.id as  product_id',DB::raw('product_carts.quantity*MAX(products.sale_price) AS total_price'))->get();
	
        }

	$discount = DB::table('used_coupons')->where('user_id',$user_id)->where('status',0)->first();
        
        if($discount){
        
        	$apply_coupon_discount = $discount->amount;
        	
        }else{
        
        	$apply_coupon_discount = 0;
        	
        }
        
        if($total_cart_product->count() > 0){
      
        
        $dc = Setting::select('Delivery_charges')->first();

	$data['discount'] = "$".$apply_coupon_discount;

        $data['sub_total'] = "$".$total_cart_product->SUM('total_price');

        $data['delivery_charges'] = "$".$dc->Delivery_charges;
	$t= $total_cart_product->SUM('total_price') ;
        $data['total'] = "$".$t;



    }else{
    
        $dc = Setting::select('Delivery_charges')->first();

        $data['sub_total'] = 0;

        $data['delivery_charges'] = 0;

        $data['total'] = 0;

        
        
    }

                   // return $this->sendResponse(
                    //    $data,
                      //  "Added product into cart!"
                   // );
                    
                     return response()->json(['success'=>true,'message'=>"Added product into cart!",'data'=> $data],200);
                }
            } else {
                $update_cart = product_cart::where("user_id", $user_id)
                    ->where("product_id", $request->product_id)
                    ->delete();

     
                $data["product_price"] = 0;
                $data["total_product_price"] = 0;
                return response()->json(['success'=>true,'message'=>"Remove product from cart!",'data'=> $data],200);

                // return $this->sendResponse($data, "Remove product from cart!");
            }
        
	}
	
	  
    public function Contact_us(){
    	return view('frontend.contact_us');
    }
    
     public function Store_contact_us(Request $request){
    	 $validate = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            "message" => "required",
        ]);

        if ($validate->fails()) {
          return back()->withErrors($validate->errors());
        } else {
            $contactus = new Contactus();
            $contactus->full_name = $request->name;
            $contactus->email = $request->email;
            $contactus->message = $request->message;
            $contactus->status = 1;
            $contactus->save();

           return back()->with(['message'=>"Thank You!"]);
          }
    }
    
    public function buy_package(Request $request){
    	try {

        // die("XCvxcv");
        $user = Auth::user();

        $user_id = $user->id;

        $currentDateTime = Carbon::now();
        

        $packages = Package::where("id", $request->package_id)->first();
        if($packages){
        $expired_date = Carbon::now()->addMonths($packages->duration);
	
        $check = User_package::where("user_id", $user_id)->first();

        if ($check && $check->status != 2) {
          
            return response()->json(['success'=>false,'message'=>"Package already Purchased"],200);
        } else {
        
        
        
         $source_id = $request->source_id;
		
		$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                     .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                     .'0123456789-='); // and any other characters
		    shuffle($seed); // probably optional since array_is randomized; this may be redundant
		    $rand = '';
		    foreach (array_rand($seed, 25) as $k) $rand .= $seed[$k];
		 
		   $random_id = $rand."-".$user_id;
		   
		   $payment_data = array (
		
		  'idempotency_key' => $random_id,
		  'amount_money' => 
		  array (
		    'amount' => $packages->price,
		    'currency' => 'USD',
		  ),
		  'source_id' => $source_id,
		);
		
		$payment_json_data = json_encode($payment_data);
		
		   $ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
		    'Content-Type:application/json',
		    'Authorization:Bearer EAAAECmaiOY69xKEPhTkMYbjum-sTLg57idXiHctuxyPsJO817dQb_UiclLuHtJv'
		    
		]);
		curl_setopt($ch, CURLOPT_URL, 'https://connect.squareupsandbox.com/v2/payments');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payment_json_data);
		$result_payment = curl_exec($ch);
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		
		
		$result_payment = json_decode( $result_payment, true );
		
		if(isset($result_payment['errors'])){
			$success_data = [];
            	return response()->json(['success'=>true,'message'=>"payment cancel!",'data'=>$success_data],200);
		}else{
		if($result_payment['payment']['status'] == "COMPLETED") {	
        
            $purchesd_packages = new User_package();
            $purchesd_packages->user_id = $user_id;
            $purchesd_packages->package_id = $request->package_id;
            $purchesd_packages->expired_date = $expired_date->format("Y-m-d");
            $purchesd_packages->start_date = $currentDateTime->format("Y-m-d");
            $purchesd_packages->price = $packages->price;
            $purchesd_packages->payment_type = "card";

            if (isset($request->payment_id) && $request->payment_id != "") {
                $purchesd_packages->payment_id = "card";
            } else {
                $purchesd_packages->payment_id = "card";
            }

            $purchesd_packages->payment_status = 1;

            $purchesd_packages->save();

            $package_service_list = Package_service::where(
                "package_id",
                $request->package_id
            )->get();

            foreach ($package_service_list as $pack_service_details) {
                $user_package_service = new User_package_service();
                $user_package_service->user_id = $user_id;
                $user_package_service->user_package_id = $purchesd_packages->id;
                $user_package_service->package_service_id =
                    $pack_service_details->service_id;
                $user_package_service->service_name =
                    $pack_service_details->service_name;
                $user_package_service->service_count =
                    $pack_service_details->service_count;
                $user_package_service->save();
            }
        }
        }
        }
	$data = [];
        return response()->json(['success'=>true,'message'=>"Package buy successfully!"],200);
        }else{
        	 return response()->json(['success'=>false,'message'=>"Package not found!"],200);
        }

        } catch (\Exception $e) {

            return response()->json(['success'=>false,'message'=>"Some this went wrong!"],404);
        }
    }
    
   
   public function delete_account(){
   
   	$user = Auth::User();
   	
   	$u = User::find($user->id);
   	$u->deleted_account = 1;
   	$u->save();
   	Auth::logout();
   	return Redirect('/')->with(['success'=>"password_change"]);
   }

   public function cart_count(){
        $user = Auth::user();

        $user_id = $user->id;

        $update_cart = product_cart::where("user_id", $user_id)->count();

        return $update_cart;

   }
    
    
	
}

