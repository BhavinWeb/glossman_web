<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Modules\Wishlist\Entities\Wishlist;
use Modules\Category\Entities\Category;
use Illuminate\Http\Request;
use Modules\Brand\Entities\Brand;
use Modules\Product\Entities\Product;
use Modules\Location\Entities\City;
use App\Models\Favourite_product;
use App\Models\product_cart;
use App\Http\Traits\HasProduct;
use App\Http\Traits\PaymentTrait;
use App\Models\ReviewRating;
use App\Models\Setting;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\Address;
use App\Models\Service_cart;
use App\Models\package_visit;
use App\Models\Service_booking;
use App\Models\Service_booked;
use Carbon\Carbon;
use App\Models\User;
use Redirect;
use DB;
use View;
use URL;
use Auth;
use Validator;
use App\Models\User_package_service;

class ServiceController extends Controller
{
    use HasProduct, PaymentTrait;
    
      public function track_sp(Request $request, $id){

 

        $user_details = Service_booking::where(
            "id",
             $id
        )->first();

        $user = User::find($user_details->user_id);

        $user_id = $user->id;
        $service = Service_booked::select("service_bookeds.*", "services.name")
            ->leftJoin(
                "services",
                "service_bookeds.service_id",
                "=",
                "services.id"
            )
            ->where("service_bookeds.booking_id", $user_details->id)
            ->get();

        $bookig_details["address"] = $user_details->address;
        $bookig_details["lattitude"] = $user_details->lattitude;
        $bookig_details["longitude"] = $user_details->longitude;
 	$bookig_details["booking_id"] = $user_details->id;

        $data["booking_details"] = $bookig_details;
        $data["service_list"] = $service;




    	 $data['order_status'] = DB::table('status_record')->where('order_id',$request->id)->where('type',2)->get();

       $data['order_details'] = Service_booking::where(
            "id",
            $request->id
        )->first();
        
        $data['station_address'] = Setting::first();
       // $data['booking_id'] = $request->id;

    	return view("frontend.service.tracksp",['data'=>$data]);
    }



    public function my_booking(Request $request)
    {
    if ($request->ajax()) {
        $user = Auth::user();
     	$user_id = $user->id;
    if ($request->ajax()) {
        $service_booking = Service_booking::leftJoin('review_ratings AS c', function($join){
            $join->on('c.item_id', '=', 'service_bookings.id')
            ->where('c.type', '=', 2);
        })   
        // leftjoin('review_ratings', 'review_ratings.item_id', '=', 'service_bookings.id','type', '=', 2)
            ->groupBy('service_bookings.id')
            ->select(
                DB::raw('DATE_FORMAT(service_bookings.created_at, "%d-%m-%Y %H:%i %p") AS date'),
                'users.name as user_name',
                'service_bookings.id as booking_id',
                DB::Raw("CONCAT('#','', service_bookings.booking_no) AS booking_no"),
                'service_bookings.service_status as sp_status',
                'service_bookings.sp_status as service_type',
                'service_bookings.payment_method as payment_method',
                'service_bookings.after_images as image',
                'service_bookings.service_time as service_time',
                DB::raw("count(c.id) as review_rating_count")
            )
       
            ->join('users', 'users.id', '=', 'service_bookings.user_id')
            ->where("service_bookings.user_id", $user_id)
            ->orderBy('service_bookings.id', 'DESC')
            ->paginate(10);

        $i = 0;

        $booking_data["booking_list"] = $service_booking;

        $view=view::make('frontend.service.booking_data',['items'=>$service_booking, 'current_page' => $request->page])->render();
        return response()->json(['html'=>$view,'last_page'=>$service_booking->lastpage()]);	
    }
}
        return view("frontend.service.bookinglist");
        // return $this->sendResponse($booking_data, "User Booking List");
        // return response()->json(['success' => true, 'message' => "User Booking List", 'data' => $booking_data], 200);
    }



    
    public function booking_detail(Request $request,$id){
    	 

        $user = Auth::user();

        $user_id = $user->id;

        
        $base_url = URL::to('/');

        $user_details = Service_booking::where(
            "id",
             $id
        )->first();

        $service = Service_booked::select("service_bookeds.*", "services.name","services.currency")
            ->leftJoin(
                "services",
                "service_bookeds.service_id",
                "=",
                "services.id"
            )
            ->where("service_bookeds.booking_id", $user_details->id)
            ->get();
            
        $bookig_details["id"] = $user_details->id;
        $bookig_details["order_id"] = "#" . $user_details->booking_no;
        $bookig_details["user_name"] = $user->name;
        $bookig_details["date_time"] =
        $user_details->created_at->format('M d, Y h:i a');
        $bookig_details["payment"] = $user_details->payment_method;
        $bookig_details["address"] = $user_details->address;
        $bookig_details["sp_status"] = $user_details->service_status;
        $bookig_details["service_type"] = $user_details->sp_status;
        $bookig_details["sub_total"] = $user_details->subtotal_price;
        $bookig_details["tax"] = $user_details->tax_price;
        $bookig_details["total_price"] = $user_details->total_price;
        $bookig_details["lattitude"] = $user_details->lattitude;
        $bookig_details["longitude"] = $user_details->longitude;
        $bookig_details["number_of_package_visit_pending"] = DB::table('user_package_services')->where('user_id',$user_id)->SUM('service_count');
        $datess = date_create($user_details->service_date);
        $bookig_details["service_date_time"] =
        date_format($datess,"M d, Y") . " " . $user_details->service_time;
        
        $bookig_details["service_center_lattitude"] = "21.2049";
       $bookig_details["service_center_longitude"] = "72.8411";
        $data["booking_details"] = $bookig_details;
        $data["service_list"] = $service;
        $data['order_status'] = DB::table('status_record')->where('order_id',$user_details->id)->where('type',1)->get();
        
        

        return view("frontend.service.booking_details",['data'=>$data]);
        

 
    }

    public function service_details(Request $request, $id)
    {
        $base_url = URL::to("/");
        $user = auth()->user();

        $user_id = $user->id;
        $result = DB::table("services")
            ->where("id", $id)
            ->first();

        $ReviewRating = ReviewRating::where("item_id", $id)
            ->where("type", 2)
            ->get();
        $one = 0;
        $two = 0;
        $three = 0;
        $four = 0;
        $five = 0;

        foreach ($ReviewRating as $data) {
            if ($data->star == 1) {
                $one++;
            }
            if ($data->star == 2) {
                $two++;
            }
            if ($data->star == 3) {
                $three++;
            }
            if ($data->star == 4) {
                $four++;
            }
            if ($data->star == 5) {
                $five++;
            }
        }
        $total_count = $one + $two + $three + $four + $five;
        $avg = ($total_count / 100) * $total_count;

        //    $service_cart =  Service_cart::where('user_id',$user_id)->get();
        $service_cart = DB::table("service_carts")
            ->where("user_id", $user_id)
            ->join(
                "services",
                "service_carts.service_product_id",
                "=",
                "services.id"
            )
            ->select(
                "services.id",
                "services.name",
                "services.price",
                DB::raw("CONCAT('$base_url','/',services.image) AS image")
            )
            ->get();

        $selected_service = $service_cart;

        $Setting = Setting::first();

        if ($result) {
            $result->image = URL::to("/") . "/" . $result->image;
            $result->star_1 = $one;
            $result->star_2 = $two;
            $result->star_3 = $three;
            $result->star_4 = $four;
            $result->star_5 = $five;
            $result->total_count = $total_count;
            $result->avg_rating = round($avg, 1);
            $result->total_price = $service_cart->sum("price") + $Setting->tax;

            $result->selected_service = $selected_service;

            $reviewRating = ReviewRating::select(
                "review_ratings.comment as comment",
                "review_ratings.star as star",
                DB::raw(
                    'DATE_FORMAT(review_ratings.created_at, "%d-%b-%Y") as date'
                ),
                DB::raw(
                    "CONCAT('$base_url','/uploads/user_image/',users.image) AS image"
                ),
                "users.name as user_name"
            )
                ->join("users", "users.id", "=", "review_ratings.user_id")
                ->where("type", 1)
                ->where("item_id", 10)
                ->paginate(3);

            $service_img = DB::table("product_galleries")
                ->where("product_id", 8)
                ->select(
                    DB::raw(
                        "CONCAT('$base_url','/',product_galleries.image) AS image"
                    ),
                    "product_galleries.id as id"
                )
                ->get();
            $result->galleries = $service_img;
            $result->review_rating = $reviewRating;
            $service_data["Service_details"] = $result;
        }

        if ($request->ajax()) {
            $reviewRating = ReviewRating::select(
                "review_ratings.comment as comment",
                "review_ratings.star as star",
                DB::raw(
                    'DATE_FORMAT(review_ratings.created_at, "%b %d, %Y") as date'
                ),
                DB::raw(
                    "CONCAT('$base_url','/uploads/user_image/',users.image) AS image"
                ),
                "users.name as user_name",
                "review_ratings.title as title"
            )
                ->join("users", "users.id", "=", "review_ratings.user_id")
                ->where("type", 2)
                ->where("item_id", $request->product_id);

            if ($request->filters == 2 || $request->filters == 4) {
                $reviewRating = $reviewRating->where("star", ">=", 3);
            }

            if ($request->filters == 3 || $request->filters == 5) {
                $reviewRating = $reviewRating->where("star", "<=", 3);
            }

            if ($request->filters == 1) {
                $reviewRating = $reviewRating->orderBy("star", "DESC");
            }

            $reviewRating = $reviewRating->paginate(3);

            $view = view::make("frontend.product.comment_list", [
                "items" => $reviewRating,
                "current_page" => $request->page,
                "type" => 2,
            ])->render();
            return response()->json([
                "html" => $view,
                "last_page" => $reviewRating->lastpage(),
            ]);
        }

        return view("frontend.service.service_details", ["result" => $result]);
    }

    public function addservice(Request $request)
    {
        $user_id = Auth::user()->id;

        if ($request->type == 1) {
            $service_count = Service_cart::where(
                "service_product_id",
                $request->service_product_id
            )
                ->where("user_id", $user_id)
                ->count();
            if ($service_count > 0) {
                return response()->json(
                    [
                        "success" => false,
                        "message" =>
                            "already added this service in service cart",
                    ],
                    200
                );
            } else {
                $service_cart = new Service_cart();
                $service_cart->user_id = $user_id;
                $service_cart->service_product_id =
                    $request->service_product_id;
                $service_cart->save();

                return response()->json(
                    [
                        "success" => true,
                        "message" => "Added service to service cart",
                        "action_status" => 1,
                    ],
                    200
                );
            }
        } else {
            $delete = Service_cart::where(
                "service_product_id",
                $request->service_product_id
            )
                ->where("user_id", $user_id)
                ->delete();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Remove service from service cart",
                ],
                200
            );
        }
    }

    public function schedule_booking()
    {
        $start_time = strtotime("10:00:00");
        $end_time = strtotime("20:30:00");
        $slot = strtotime(date("Y-m-d H:i:s", $start_time) . " +30 minutes");

        $data = [];

        for ($i = 0; $slot <= $end_time; $i++) {
            $data[$i] = [
                "start" => date("h:i A", $start_time),
                "end" => date("h:i A", $slot),
            ];

            $start_time = $slot;
            $slot = strtotime(
                date("Y-m-d H:i:s", $start_time) . " +30 minutes"
            );
        }
        

        return view("frontend.service.schedule_booking", ["data" => $data]);
    }

    public function service_book(Request $request)
    {
        $user_id = Auth::user()->id;
        $base_url = URL::to("/");
        $service_cart = DB::table("service_carts")
            ->where("user_id", $user_id)
            ->join(
                "services",
                "service_carts.service_product_id",
                "=",
                "services.id"
            )
            ->select(
                "services.id",
                "services.name",
                "services.price",
                DB::raw("CONCAT('$base_url','/',services.image) AS image")
            )
            ->get();
            
        $Setting = Setting::first();
        
        $before_images = [];
  
        if ($request->file("before_images")) {

	    $file = $request->file("before_images");

	    $bi = 0;
	    
	    foreach($file as $before_image){
	       
	        $filename = date("YmdHi")."_".$bi. ".png";
		$before_images[] = $filename; 
	        $before_image->move(public_path("uploads/service_images"), $filename);
	        $bi++;
	        
	    }
	               
	 }
      
        
     
        
        $total_amount = ($Setting->tax / 100) * $service_cart->sum("price") + $service_cart->sum("price");
        
        $data = $request->all();
        
   
        $data['before_images'] = implode(', ', $before_images);;
      
        return view("frontend.service.service_payment", [
            "data" => $data,
            "total_amount" => $total_amount,
        ]);
    }
    
    

    public function checkout_service(Request $request)
    {
    
  

        $validator = Validator::make($request->all(), [
            "booking_date" => "required",
            "booking_time" => "required",
            "lattitude" => "required",
            "longitude" => "required",
            "address" => "required",
            
        ]);

        if ($validator->fails()) {
            $error = $this->error_msg($validator->errors());
            return $this->sendError($error, "");
        }

        $Setting = Setting::first();

        $user = Auth::user();

        $user_id = $user->id;

        $payment_type = $request->pay_with;
        $user_package_id = DB::table("user_packages")
            ->where("user_id", $user_id)
            ->first();

        if (!$user_package_id) {
           return response()->json(
                        [
                            "success" => true,
                            "message" => "Need To pay using card!",
                            
                        ],
                        200
                    );
        }
        $payment_type = "package";
        if ($payment_type == "package") {
            $user = auth("sanctum")->user();

            $user_package_id = DB::table("user_packages")
                ->where("user_id", $user_id)
                ->first();

            $user_package_details = DB::table("user_package_services")
                ->where("user_package_id", $user_package_id->id)

                ->pluck("package_service_id")
                ->toArray();

            $service_carts = Service_cart::where("user_id", $user_id)
                ->pluck("service_product_id")
                ->toArray();

            if ($service_carts) {
                $with_package_service_id = [];

                $without_package_service_id = [];

                foreach ($service_carts as $upd) {
                    if (in_array($upd, $user_package_details)) {
                        $user_package_details_info = DB::table(
                            "user_package_services"
                        )
                            ->where("user_id", $user_id)
                            ->where("package_service_id", $upd)
                            ->first();

                        if ($user_package_details_info->service_count > 0) {
                            $with_package_service_id[] = $upd;
                        } else {
                            $without_package_service_id[] = $upd;
                        }
                    } else {
                        $without_package_service_id[] = $upd;
                    }
                }

                if (count($without_package_service_id) > 0) {
                    $service_price = DB::table("services")
                        ->whereIn("id", $without_package_service_id)
                        ->sum("price");

                    $result_data["payment"] = 1;

                    $result_data["sub_total"] = $service_price;

                    $result_data["tax"] = $Setting->tax;

                    $result_data["total"] =   ($Setting->tax / 100) * $service_price + $service_price;

                    return response()->json(
                        [
                            "success" => true,
                            "message" => "Need To pay using card!",
                            "data" => $result_data,
                        ],
                        200
                    );
                } else {
                    $service_name = DB::table("service_carts")
                        ->where("user_id", $user_id)
                        ->join(
                            "services",
                            "service_carts.service_product_id",
                            "=",
                            "services.id"
                        )
                        ->pluck("services.name")
                        ->toArray();

                    foreach (
                        $with_package_service_id
                        as $update_user_package_service
                    ) {
                        $user_package_details_info = DB::table(
                            "user_package_services"
                        )
                            ->where("user_id", $user_id)
                            ->where("package_service_id", $upd)
                            ->first();
                        $total_s =
                            $user_package_details_info->service_count - 1;
                        User_package_service::where(
                            "package_service_id",
                            $update_user_package_service
                        )
                            ->where("user_id", $user_id)
                            ->update(["service_count" => $total_s]);
                    }

                    $package_visit = new package_visit();
                    $package_visit->purchesd_package_id = $user_package_id->id;
                    $package_visit->date = $request->booking_date;
                    $package_visit->time = $request->booking_time;
                    $package_visit->service_name = implode(", ", $service_name);
                    $package_visit->save();

                    $service_cart_total = DB::table("service_carts")
                        ->where("user_id", $user_id)
                        ->join(
                            "services",
                            "service_carts.service_product_id",
                            "=",
                            "services.id"
                        )
                        ->select("services.id", "services.name")
                        ->sum("services.price");

                    $new_width = ($Setting->tax / 100) * $service_cart_total;

                    $total_amount_price =
                        round($new_width) + $service_cart_total;
			
			
			
		$bimage = explode (",", $request->before_images); 

                    $save_booking = new Service_booking();
                    $save_booking->user_id = $user_id;
                    $save_booking->subtotal_price = $service_cart_total;
                    $save_booking->tax_price = $Setting->tax;
                    $save_booking->total_price = $total_amount_price;
                    $save_booking->payment_status = "paid";
                    $save_booking->order_status = "paid";
                    $save_booking->payment_method = "package";
                    $save_booking->service_status = "pending";
                    $save_booking->service_date = $request->booking_date;
                    $save_booking->service_time = $request->booking_time;
                    $save_booking->lattitude = $request->lattitude;
                    $save_booking->longitude = $request->longitude;
                    $save_booking->address = $request->address;
                    $save_booking->note = $request->note;
                    $save_booking->before_images = json_encode($bimage);
                    $save_booking->created_at = Carbon::now()->setTimezone('Asia/Kolkata');
                    $save_booking->save();
                    
                    date_default_timezone_set('Asia/Kolkata');
                   $status_update = DB::table('status_record')->insert(['order_id'=>$save_booking->id,'type'=>2,'status'=>'pending', 'created_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
            'updated_at'=>Carbon::now()->setTimezone('Asia/Kolkata')]);

                    Service_booking::where("id", $save_booking->id)->update([
                        "booking_no" => str_pad(
                            $save_booking->id,
                            8,
                            "0",
                            STR_PAD_LEFT
                        ),
                    ]);

                    foreach ($service_carts as $service_carts_data) {
                        $service_detail = DB::table("services")
                            ->where("id", $service_carts_data)
                            ->first();
                        $save_booking_service = new Service_booked();
                        $save_booking_service->booking_id = $save_booking->id;
                        $save_booking_service->service_id = $service_carts_data;
                        $save_booking_service->price = $service_detail->price;
                        $save_booking_service->save();
                    }

                    $result_data["payment"] = 0;

                    $service_carts = Service_cart::where(
                        "user_id",
                        $user_id
                    )->delete();

                    return response()->json(
                        [
                            "success" => true,
                            "message" => "service book successfully!",
                            "data" => $result_data,
                        ],
                        200
                    );
                }
            } else {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Your service cart empty!",
                        "data" => [],
                    ],
                    200
                );
            }
        }
    }
    
    public function payment_checkout_service(Request $request){
    	date_default_timezone_set('Asia/Kolkata');
    	$user = Auth::user();
        $user_id = $user->id;
        if($request->card_id == 0){
	
        $validator = Validator::make($request->all(), [

           
             'booking_date'=>'required',
	'booking_time'=>'required'
	,'lattitude' => 'required',
	'longitude' => 'required',
	'address' => 'required',
	
	
        ]);
        
        }else{
        	$validator = Validator::make($request->all(), [

		    
		    'booking_date'=>'required',
		    'booking_time'=>'required',
		    'lattitude' => 'required',
			'longitude' => 'required',
			'address' => 'required',
			
		]);
        
        }
        
       

        if ($validator->fails()) {
            $error =  $this->error_msg($validator->errors());
            return $this->sendError($error,'');
        }
        
        $Setting = Setting::first();
            
         $service_carts = Service_cart::where("user_id", $user_id)
            ->pluck("service_product_id")
            ->toArray();
        
        if($service_carts){
       //  $payment_total = filter_var($request->amount, FILTER_SANITIZE_NUMBER_INT);
        $payment_total = intval($request->amount);
       
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
		    'amount' => $payment_total,
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
            		return response()->json(['success'=>false,'message'=>"payment cancel!",'data'=>$success_data],200);
            		
		}else{
		
		if($result_payment['payment']['status'] == "COMPLETED") {
        
	
        
        if($request->payment_with_package == 1){
            // die("xcvxcv");
            $user_package_id = DB::table("user_packages")
                ->where("user_id", $user_id)
                ->first();

            $user_package_details = DB::table("user_package_services")
                ->where("user_package_id", $user_package_id->id)
                ->pluck("package_service_id")
                ->toArray();

            $service_carts = Service_cart::where("user_id", $user_id)
                ->pluck("service_product_id")
                ->toArray();

            $with_package_service_id = [];

            $without_package_service_id = [];

            foreach ($service_carts as $upd) {
                if (in_array($upd, $user_package_details)) {
                    $user_package_details_info = DB::table(
                        "user_package_services"
                    )
                        ->where("package_service_id", $upd)
                        ->first();

                    if ($user_package_details_info->service_count > 0) {
                        $with_package_service_id[] = $upd;
                    } else {
                        $without_package_service_id[] = $upd;
                    }
                } else {
                    $without_package_service_id[] = $upd;
                }
            }

            
		 $service_names = [];
            foreach (
                $with_package_service_id
                as $update_user_package_service
            ) {
            
              $service_name =  DB::table("services")
                ->where("id", $update_user_package_service)->first();
               
               $service_names[] = $service_name->name;
               
                
                $user_package_details_info = DB::table(
                    "user_package_services"
                )
                    ->where("package_service_id", $update_user_package_service)
                    ->where("user_id", $user_id)
                    ->first();
                    
                $total_s = $user_package_details_info->service_count - 1;
                User_package_service::where(
                    "package_service_id",
                    $update_user_package_service
                )->where("user_id", $user_id)->update(["service_count" => $total_s]);
            }
            // die("zcxzxc");

            $package_visit = new package_visit();
            $package_visit->purchesd_package_id = $user_package_id->id;
            $package_visit->user_id = $user_id;
            $package_visit->date = $request->booking_date;
            $package_visit->time = $request->booking_time;
            $package_visit->service_name = implode(", ",$service_names);;
            $package_visit->save();
            
            // print_r($package_visit);
            // die;
        }

       
      
        $service_cart_total = DB::table("service_carts")
            ->where("user_id", $user_id)
            ->join(
                "services",
                "service_carts.service_product_id",
                "=",
                "services.id"
            )
            ->select("services.id", "services.name",DB::raw('SUM(services.price) AS total_price'))
            ->first(); 
            
	
	 $new_width = ($Setting->tax / 100) *  $service_cart_total->total_price;
        
      $total_amount_price = round($new_width) +   $service_cart_total->total_price;
	
	
	$bimage = explode (",", $request->before_images); 
	
        $save_booking = new Service_booking();
        $save_booking->user_id = $user_id;
        $save_booking->subtotal_price =  $service_cart_total->total_price;
        $save_booking->tax_price = $Setting->tax;
        $save_booking->total_price =$total_amount_price;
        $save_booking->payment_status = "paid";
        $save_booking->order_status = "paid";
        $save_booking->payment_method ="card";
        $save_booking->service_status = "pending";
        $save_booking->service_date = $request->booking_date;
        $save_booking->service_time = $request->booking_time;
        $save_booking->lattitude = $request->lattitude;
        $save_booking->longitude = $request->longitude;
        $save_booking->address = $request->address;
        $save_booking->note = $request->note;
        $save_booking->before_images = json_encode($bimage);
        $save_booking->transaction_id = $request->transaction_id;
        $save_booking->created_at = Carbon::now()->setTimezone('Asia/Kolkata');
          
        
        $save_booking->save();
        
        
        $status_update = DB::table('status_record')->insert(['order_id'=>$save_booking->id,'type'=>2,'status'=>'pending', 'created_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
            'updated_at'=>Carbon::now()->setTimezone('Asia/Kolkata')]);
	
        Service_booking::where("id", $save_booking->id)->update([
            "booking_no" => str_pad($save_booking->id, 8, "0", STR_PAD_LEFT),
        ]);

        foreach ($service_carts as $service_carts_data) {
            $service_detail = DB::table("services")
                ->where("id", $service_carts_data)
                ->first();
                
            $save_booking_service = new Service_booked();
            $save_booking_service->booking_id = $save_booking->id;
            $save_booking_service->service_id = $service_carts_data;
            $save_booking_service->price = $service_detail->price;
            $save_booking_service->save();
        }

        $result_data["payment"] = 1;

        $service_carts = Service_cart::where("user_id", $user_id)->delete();
	$empty_data =  $save_booking;
        return response()->json(['success'=>true,'message'=>"service book successfully!",'data'=>$empty_data],200);
        
	}else{
		return response()->json(['success'=>false,'message'=>"Your service cart empty!",'data'=>[]],200);
	}
	}
	}else{
		return response()->json(['success'=>false,'message'=>"Your service cart empty!",'data'=>[]],200);
	}
    	
    }
    
    public function booking_cancel(Request $request){
    	$order_id = $request->booking_id;
    	
    	$update_status = Service_booking::find($order_id);
    	$update_status->service_status = "cancelled";
    	$update_status->save();
    	return true;
    }
    
    
    public function after_image_upload(Request $request){
    	
    	
    	
    	    $before_images = [];
           
           if(count($request->file("files")) < 5){

	      if ($request->file("files")) {

		    $file = $request->file("files");

		    $bi = 0;
		    
		    foreach($file as $before_image){
		        
		        $filename = date("YmdHi")."_".$bi. ".png";
			 $before_images[] = $filename; 
		         $before_image->move(public_path("uploads/service_images"), $filename);
		         $bi++;
		        
		    }
		    
		     $save_booking = Service_booking::where('id',$request->service_id)->first();
		     
		     $save_booking->after_images = json_encode($before_images);
		     	
		     $save_booking->save();
		    
		    return response()->json(['success'=>true,'message'=>"images updated"],200);
		            
		}
		
        }else{
        
        	return response()->json(['success'=>false,'message'=>"image error"],200);
        	
        }
    	
    
    	
    }
    
}

