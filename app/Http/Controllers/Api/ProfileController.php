<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Package;
use App\Models\Setting;
use App\Models\User;
use App\Models\Favourite_product;
use App\Models\ReviewRating;
use App\Models\product_cart;
use App\Models\Notification;
use App\Models\Cards;
use App\Models\User_package;
use App\Models\package_visit;
use Modules\Product\Entities\Product;
use Modules\Wishlist\Entities\Wishlist;
use Validator;
use URL;

use DB;

class ProfileController extends BaseController
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

    public function purchase_package_details(){

        try {


        $user = auth("sanctum")->user();

        $user_id = $user->id;

        $purchesd_packages = User_package::where('user_id',$user_id)->first();

        if($purchesd_packages){

            $packages_all = Package::where("status", 1)->with('package_service')->where('id',$purchesd_packages->package_id)->first();
            
            $package_data['duration'] =  $this->numberToWord($packages_all['duration']) . " ".$packages_all['duration_type'];
            $package_data['start_date'] = $purchesd_packages->start_date;
            $package_data['end_date'] = $purchesd_packages->expired_date;
            $package_data['package_price'] = $packages_all->price;
            $package_data['package_service'] = $packages_all->package_service;

            $data['package_details'] = $package_data;

            $package_visit = package_visit::where('user_id',$user_id)->where('purchesd_package_id',$purchesd_packages->package_id)->get();

            $data['package_visit'] = $package_visit;

            // return $this->sendResponse($data, "User updated");

            return response()->json(['success'=>true,'message'=>"Package Details",'data'=>$data],200);
        }else{
            return response()->json(['success'=>true,'message'=>"Package Details",'data'=>[]],200);
        }

    } catch (\Exception $e) {

        return response()->json(['success'=>false,'message'=>"Some this went wrong!"],404);
        
    	}
	

    }

    public function error_msg($errors)
    {
        $msg = $errors;
        $ii = 0;
        $i = [];
        foreach ($msg->all() as $ermsg) {
            $i[$ii] = $ermsg;
            $ii++;
        }
        return $i;
    }

    public function update_profile(Request $request)
    {
        try {
	$request_all = $request->all();
        $user_id = auth("sanctum")->user();
        $user = User::find($user_id->id);

        if ($user) {
            $user_email = User::where("email", $request->email)
                ->Where("id", "!=", $user->id)
                ->count();

            if ($user_email == 0) {
                $user->name = $request->name;

                $user->email = $request->email;

                $user->phone = $request->phone;
                
                $user->country_code = $request->country_code;
                	
                $user->city_id = $request->city_id;

                $user->address = $request->address;

                if ($request->file("image")) {
                
                    $file = $request->file("image");
                    $filename = date("YmdHi") . ".png";
                    $file->move(public_path("uploads/user_image"), $filename);
                    $user->image = $filename;
                    
                }
                
                //// if(isset($request->image) && $request->file('image') == null){
                	//$user->image = null;
                //}
                
               
                
                 if ($request->file("car_picture")) {
                 
                    $file_1 = $request->file("car_picture");
                    $filename_1 = date("YmdHi") ."1". ".png";
                    $file_1->move(public_path("uploads/user_image"), $filename_1);
                    $user->car_picture = $filename_1;
                    
                }
                
                if(isset($request_all["image"])){
		    if($request->image == "remove"){
		    	$user->image = null;
		    }
		}
		
		 if(isset($request_all["car_picture"])){
		
		    if($request->car_picture == "remove"){
		    	$user->car_picture = NULL;
		    }
		}
		
               

                $user->save();
                $updated_data = User::find($user_id->id);
                if($updated_data->image != null){
                $updated_data->image =
                    URL::to("/") .
                    "/uploads/user_image/" .
                    $updated_data->image;
                    }else{
                    	$updated_data->image = null;
                    }
                    if($updated_data->car_picture != null){
                     $updated_data->car_picture =
                    URL::to("/") .
                    "/uploads/user_image/" .
                    $updated_data->car_picture;
                    }else{
                    	 $updated_data->car_picture = null;
                    }
                $data["user"] = $updated_data;

                // return $this->sendResponse($data, "User updated");
                return response()->json(['success'=>true,'message'=>"User updated!",'data'=>$data],200);

            } else {
		$data = [];
                return response()->json(['success'=>false,'message'=>"This email already in used!",'data'=>$data],200);

            }

        } else {

            return response()->json(['success'=>true,'message'=>"User Not Found",'data'=>$data],200);
        }

        } catch (\Exception $e) {

        return response()->json(['success'=>false,'message'=>"Some this went wrong!"],404);
        
    	}

    }

    public function favourite_product_action(Request $request)
    {
        try {


        $user = auth("sanctum")->user();

        if ($request->type == 1) {
           $Wishlist = new Wishlist();
            $Wishlist->user_id =  $user->id;
            $Wishlist->product_id =  $request->product_id;
            $Wishlist->save();

            // return $this->sendResponse(
            //     "Success",
            //     "Product added as favourite "
            // );

            return response()->json(['success'=>true,'message'=>"Product added as favourite"],200);
        }

        if ($request->type == 2) {
            $favourite_product = Wishlist::where("user_id", $user->id)
                ->where("product_id", $request->product_id)
                ->delete();
            // return $this->sendError(
            //     "Success",
            //     "Product remove from favourit list"
            // );
            return response()->json(['success'=>true,'message'=>"Product remove from favourit list"],200);
            
        }

    } catch (\Exception $e) {

        return response()->json(['success'=>false,'message'=>"Some this went wrong!"],404);
        
    	}
    }

    public function get_favourite_product_list()
    {
        try {

        $user = auth("sanctum")->user();

        $user_id = $user->id;

        $favourite_product = Wishlist::where("user_id", $user_id)
            ->pluck("product_id")
            ->toArray();

          $result = Product::groupBy('products.id')->select('products.stock as max_quantity','products.currency as currency','products.id as product_id','products.image as image',DB::raw('ROUND(avg(review_ratings.star)) as product_rating'),'products.title as product_name','products.price as price','products.sale_price as sale_price')
         ->whereIn('products.id',$favourite_product)
        ->withCount(['favorites as liked' => function ($q) {
                $q->where('user_id', auth()->id());
            }])->with('reviews')->leftjoin('review_ratings','products.id','=','review_ratings.item_id')
            ->withCasts(['liked' => 'boolean'])
            ->paginate(10);
	$data['product_list'] = $result;
	if( $result){
            return response()->json(['success'=>true,'message'=>"Favourite Product List!",'data'=>$data],200);

            // return $this->sendResponse($data, "Favourite Product List!");

        } else {
           
            return response()->json(['success'=>true,'message'=>"Favourite Product List Not Found"]);
        }

    } catch (\Exception $e) {

        return response()->json(['success'=>false,'message'=>"Some this went wrong!"],404);
        
    	}
    }

    public function review_rating(Request $request)
    {
        $user = auth("sanctum")->user();

        $user_id = $user->id;
        if (
            $request->type != "" &&
            $request->item_id != "" &&
            $request->star != "" &&
            $request->comment != ""
        ) {
            $reviewRating = new ReviewRating();
            $reviewRating->user_id = $user_id;
            $reviewRating->type = $request->type;
            $reviewRating->item_id = $request->item_id;
            $reviewRating->star = $request->star;
            $reviewRating->comment = $request->comment;
            $reviewRating->save();

            return $this->sendResponse("Success", "added ratings ");
        } else {
            return $this->sendError("Error", "All fileds required!");
        }
    }

    public function get_reviews_ratings(Request $request)
    {

        $reviewRating = ReviewRating::where("type", $request->type)
            ->where("item_id", $request->item_id)
            ->paginate(10);

        $re_ratings = [];

        foreach ($reviewRating as $data) {
            $user_data = User::find($data->user_id);
            $set_data = [
                "image" =>
                    URL::to("/") . "/uploads/user_image/" . $user_data->image,
                "user_name" => $user_data->name,
                "date" => $user_data->created_at->format("d M Y"),
                "star" => $data->star,
                "comment" => $data->comment,
            ];

            $re_ratings[] = $set_data;
        }

        if ($reviewRating->currentpage() == $reviewRating->lastpage()) {
            $result_data["is_last"] = 1;
        } else {
            $result_data["is_last"] = 0;
        }

        $result_data["ratings"] = $re_ratings;

        if ($reviewRating->count() <= 0) {
            return $this->sendError('error', "Review and Rating list");
        } else {
            return $this->sendResponse("success", "List not found!");
        }
    }

    public function add_to_cart(Request $request)
    {

        try {
         $empty_data = [];


        $user = auth("sanctum")->user();

        $user_id = $user->id;

        $validator = Validator::make($request->all(), [
            "quantity" => "required",
            "product_id" => "required",
        ]);

	$product_stock = Product::where('id',$request->product_id)->first();
	if(!$product_stock){
	 return response()->json(['success'=>true,'message'=>"This product Not found!",'data'=> []],200);
	}
	if($product_stock->stock < $request->quantity){
	$data["product_price"] = 0;

       $data["total_cart_price"] = 0;
	//return $this->sendResponse($data,"This product out of stock!");
	 return response()->json(['success'=>true,'message'=>"This product out of stock!",'data'=> $data],200);
	} 
	

        if ($validator->fails()) {
            $error = $this->error_msg($validator->errors());
            return $this->sendError($error, "");
        } else {
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


                    $data["product_price"] = $single_product->sale_price ;

                    $data["total_product_price"] = $single_product->sale_price * $quantity;

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


                    $data["product_price"] = $single_product->sale_price ;

                    $data["total_product_price"] =$single_product->sale_price * $quantity;

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
    } catch (\Exception $e) {

        return response()->json(['success'=>false,'message'=>"Some this went wrong!"],404);
        
        }
        
    }

 public function get_cart_list(Request $request){
    
    try {

        $user = auth("sanctum")->user();

        $base_url = URL::to('/');

        $user_id = $user->id;
        
        $address = DB::table('addresses')->where('user_id',$user_id)->first();
	
        if(isset($request->repeat_order_id) && $request->repeat_order_id != ""){

            $total_cart_product = DB::table('order_products')->where('repeat_order_id',$request->order_id)->get();

            // $total_cart_product = product_cart::where("user_id",$user_id)->get();

        }else{
            // $total_cart_product = product_cart::where("user_id",$user_id)->get();
           // $total_cart_product = product_cart::where("user_id",$user_id)->join('products','products.id','=','product_carts.product_id')->groupBy('products.id')->select('product_carts.quantity as product_quantity','products.id as product_id','products.title as product_name','products.sale_price as product_price',DB::raw('product_carts.quantity*MAX(products.sale_price) AS total_price','products.id as  product_id'))->get();

	$total_cart_product = product_cart::where("user_id",$user_id)->join('products','products.id','=','product_carts.product_id')->groupBy('products.id')->select(DB::raw("CONCAT('$base_url','/',products.image) AS image_url"),'products.stock as max_quantity','products.currency as currency','product_carts.quantity as product_quantity','products.id as product_id','products.title as product_name','products.sale_price as sale_price','products.price as price','products.id as  product_id',DB::raw('product_carts.quantity*MAX(products.sale_price) AS total_price'))->where("products.status", 1)->get();
	
        }

	$discount = DB::table('used_coupons')->where('user_id',$user_id)->where('status',"0")->first();
        
        if($discount){
        
        	$apply_coupon_discount = $discount->amount;
        	
        }else{
        
        	$apply_coupon_discount = 0;
        	
        }
        // echo $total_cart_product->SUM('total_price');
        // print_r($total_cart_product);
        // die;
        if($total_cart_product->count() > 0){
        // $product_list = [];

        // $i = 0;

        // $total_price = 0;

        // foreach ($total_cart_product as  $value) {

        //     $single_product = Product::where("id",$value->product_id)->first();
        //     $total_price  += $single_product->sale_price * $value->quantity;
        //     $product_list[$i]['product_id'] = $single_product->id;
        //     $product_list[$i]['product_price'] = $single_product->sale_price * $value->quantity;
        //     $product_list[$i]['product_name'] = $single_product->title;
        //     $product_list[$i]['product_quantity'] = $value->quantity;

        //     $i++;
        // }

        // $data['item_count'] = $i;
        
        if($address){
        	$shipping_charge = round($address->shipping_charge);
        }else{
        	$shipping_charge = 0;
        }
        
        $dc = Setting::select('Delivery_charges')->first();

	$data['discount'] = $apply_coupon_discount;

        $data['sub_total'] = $total_cart_product->SUM('total_price');

        $data['delivery_charges'] = $shipping_charge;

        $data['total'] =  $total_cart_product->SUM('total_price') - $apply_coupon_discount +$shipping_charge;

        $data['product_list'] = $total_cart_product;
	
	
	
        return response()->json(['success'=>true,'message'=>"Cart list!",'data'=>$data],202);

        // return $this->sendResponse($data, "Cart list!");
    }else{
    
        $dc = Setting::select('Delivery_charges')->first();

        $data['sub_total'] = 0;

        $data['delivery_charges'] = 0;

        $data['total'] = 0;

        $data['product_list'] = [];
        
        return response()->json(['success'=>true,'message'=>"Your Cart list is empty!",'data'=>$data],202);
        
        // return $this->sendResponse($data, "Your Cart list is empty!");
    }


    } catch (\Exception $e) {

    return response()->json(['success'=>false,'message'=>"Some this went wrong!"],404);
    
    }

    }
    public function card_action(Request $request){
        $user = auth("sanctum")->user();

        $user_id = $user->id;
      
        
    	$card = Cards::where('user_id', $user_id)->get();
    	$data['card'] = $card;
    	return $this->sendResponse($data, "card list");
        
    }

    public function Get_Notification(){

        try {
	
	

        $user = auth("sanctum")->user();

        $user_id = $user->id;
        
        

      $notification = Notification::select(DB::raw('DATE_FORMAT(notifications.created_at, "%h:%i %p") as time'),DB::raw('DATE_FORMAT(notifications.created_at, "%M %d %Y") as date'),'notifications.data as message')->where('user_id',$user_id)->orWhere("user_id",0)->paginate(10);

        // $noti_data = [];

        // $i = 0;

        // foreach($notification as $not_data){
        //     $noti_data[$i]['time'] = $not_data->id;
        //     $noti_data[$i]['msg'] = $not_data->message;
        //     $noti_data[$i]['time'] = "5:09";
        //     $i++;
        // }

        // if ($notification->currentpage() == $notification->lastpage()) {
        //     $data["is_last"] = 1;
        // } else {
        //     $data["is_last"] = 0;
        // }
       

        $data['notification'] = $notification;

        // return $this->sendResponse($data, "Notification list");
        return response()->json(['success'=>true,'message'=>"Notification list!",'data'=>$data],200);

    } catch (\Exception $e) {

        return response()->json(['success'=>false,'message'=>"Some this went wrong!"],404);
        
    	}

    }
    
    public function Notification_setting(Request $request){
    
     try {
     
     $validator = Validator::make($request->all(), [
            "type" => "required",
            
        ]);
        
        if ($validator->fails()) {
            $error = $this->error_msg($validator->errors());
            return $this->sendError($error, "");
        }
        
     		$type = $request->type;
    		$user = auth("sanctum")->user();
		$users = User::find($user->id);
		$users->notification = $type;
		
        	$users->save();
        	
        	if($type == 0){
        	
        		return response()->json(['success'=>true,'message'=>"Notification off"],200);
        		
        	}else{
        	
        		return response()->json(['success'=>true,'message'=>"Notification On!"],200);
        		
        	}
        	
	 } catch (\Exception $e) {

	return response()->json(['success'=>false,'message'=>"Some this went wrong!"],404);

	}
        
    }
    
    public function DeleteAccount(){
    	
    	$user = auth("sanctum")->user();
	$users = User::find($user->id);
	$users->deleted_account = 1;
	$users->save();
	
	return response()->json(['success'=>true,'message'=>" Account deleted"],200);
    	
    }
  
}


