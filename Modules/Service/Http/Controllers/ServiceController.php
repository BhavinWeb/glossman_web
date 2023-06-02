<?php

namespace Modules\Service\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Service\Entities\Service;
use Illuminate\Contracts\Support\Response;
use Modules\Service\Actions\UpdateCategory;
use Modules\Service\Actions\SortingCategory;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\Service\Actions\ServiceCategory;
use Illuminate\Support\Str;
use App\Models\Service_booking;
use App\Models\Service_booked;
use App\Models\User;
use Modules\Service\Http\Requests\ServiceFormRequest;
use Modules\Service\Repositories\ServiceRepositories;
use Modules\Order\Entities\Order;
use App\Models\Setting;
use App\Models\Driver;
use URL;
use DB;
use Carbon\Carbon;
use Pusher\Pusher;



class ServiceController extends Controller
{
     use ValidatesRequests;

    protected $category;
  
  public function booking_spstatus_change(Request $request){
	
	$booking = Service_booking::find($request->id);
	$booking->sp_status = $request->status;
  	$booking->save();
  	
  	date_default_timezone_set('Asia/Kolkata');
		        $ms = "Your Service #".$booking->booking_no." has been".$request->status. " !";
		        $order_address = DB::table('notifications')->insert(
           		['user_id' =>$booking->user_id,
           		'type' =>"App\Notifications\Frontend\OrderTrackNotification",
		        'notifiable_type' => "aasdsad",
		        'notifiable_id' => "adasdad",
		        'data' => $ms,
		        'read_at' =>1,
		        'created_at'=> Carbon::now()->setTimezone('Asia/Kolkata'),
		        'updated_at'=> Carbon::now()->setTimezone('Asia/Kolkata')]);
		        
		         DB::table('status_record')->insert(
		    [
		        'order_id' =>  $request->id,
		        'status' => $request->status,
		        'type' => 2,
		        'created_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
		        'updated_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
		      
		    ]
		);
  	
  	return back();
  	
    }

    public function __construct(ServiceRepositories $category)
    {
        $this->service = $category;
    }
    
    public function Booking_list(Request $request){
    	
    	         abort_if(!userCan('order.view'), 403);

        $allOrders = Service_booking::select('status')->get();
        $stats = $allOrders->groupBy('status')->map->count();
        $stats['total'] = $allOrders->count();

        $query = Service_booking::query();

        // ==============
        // |    Filter  |
        // ==============

        // <!-- for payment status -->
        if ($request->has('payment_status') && $request->payment_status != null) {
            if ($request->payment_status == 'unpaid') {

                $query->where('payment_status', 'unpaid');
            } else {
                $query->where('payment_status', 'paid');
            }
        }
        // <!-- for delivery status -->
        if ($request->has('service_status') && $request->service_status != null) {
	
            $query->where('service_status', $request->service_status);
        }
        // <!-- for keyword -->
        if ($request->has('keyword') && $request->keyword != null) {

           $query->where('booking_no','LIKE','%'. $request->keyword .'%');
        }

        $orders = $query->latest()->paginate(16);
        $orders->appends($request->all());
      

        return view('service::booking.index', compact('orders', 'stats'));
    	
    }
  
 	 public function AssignDriver(Request $request)
      {
          $booking = Service_booking::find($request->booking_id);
          $booking->driver_id = $request->driver_id;
          $booking->save();
          
          $driver = Driver::where('id',$request->driver_id)->first();
       	  $booking_id = Service_booking::where('id',$request->booking_id)->first();
              
    
        $serverKey = 'AAAA_80Kncc:APA91bHKU09sxH-JjyaO7hURUq5zNfBhrOz_6W6y7EMXncF4ufAhFhN8i45D5goN3CVDpF-jO4cf1lyfUqO4APjpp8mcrLDeFwdLbIydLutZjee2jS_lfpxj20aXxUtSrvRjTlCSWSzC';
      $url ="https://fcm.googleapis.com/fcm/send";
		$msg_data = " Hi ".$driver->name.", the glossman admin has assigned you the service & booking id #".$booking_id->booking_no;
       echo $msg_data;
       echo $driver->fcm_token;
    $fields=array(
        "to"=>$driver->fcm_token,
        "data"=>array(
            "body"=>$msg_data,
            "title"=>"Driver notification",
        )
    );
       
    $headers=array(
        'Authorization: key=AAAA_80Kncc:APA91bHKU09sxH-JjyaO7hURUq5zNfBhrOz_6W6y7EMXncF4ufAhFhN8i45D5goN3CVDpF-jO4cf1lyfUqO4APjpp8mcrLDeFwdLbIydLutZjee2jS_lfpxj20aXxUtSrvRjTlCSWSzC',
        'Content-Type:application/json'
    );

    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
    $result=curl_exec($ch);
    print_r($result);
    curl_close($ch);
        
          $options = array(
              'cluster' => 'ap2',
              'encrypted' => true
          );

          $pusher = new Pusher(
              env('PUSHER_APP_KEY'),
              env('PUSHER_APP_SECRET'),
              env('PUSHER_APP_ID'),
              $options
          );
            
            $data =  "  hi ".$driver->name.", the glossman admin has assigned you the service & booking id #".$booking_id->booking_no;
       
        	$event_name = "driver_$request->driver_id";
       
        	$pusher->trigger('location', $event_name, $data);
       
          	return response()->json(['success'=> true, 'message' => 'Driver Assigned']);
      }
    
    /**
     * Display a listing of the categories.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // abort_if(!userCan('category.view'), 403);

        $categories = Service::latest()->paginate(10);
       
        return view('service::service.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     * @return \Illuminate\Http\Response
     */
    public function create($parent_id = null)
    {
        // abort_if(!userCan('service.create'), 403);

        $categories = Service::whereNull('parent_id')->with('subcategories.subcategories.subcategories.subcategories')->get();
        return view('service::service.create', compact('categories', 'parent_id'));
    }

    /**
     * Store a newly created category in storage.
     *
     * @param CategoryFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceFormRequest $request)
    {
    
    
        // abort_if(!userCan('service.create'), 403);
        // die("XCVxcv");
            $category_store = new Service();

            if ($request->hasFile('image')) {
               
                $url = $request->image->move('uploads/category', $request->image->hashName());
                $category_store->image = $url;

            }

           
             $category_store->parent_id = 0;
            $category_store->name = $request->name;
            $category_store->time = $request->time;
            $category_store->currency = $request->currency;
            $category_store->price = $request->price;
            $category_store->about_service = $request->about_service;
            $category_store->slug = Str::slug($request->slug);
            $category_store->save();

          
            $category_store ? flashSuccess('service Added Successfully') : flashError();

        return back();
    }
    

      public function booking_status_change(Request $request){
       
  
        

	date_default_timezone_set('Asia/Kolkata');

    $old_status = Service_booking::select('service_status')->where('id',$request->id)->first();

    if ($request->status == 'completed') {
    
        if($old_status->service_status == 'pending'){
            DB::table('status_record')->insert(
                [
                    'order_id' =>  $request->id,
                    'status' => "accept",
                    'type' => 2,
                    'created_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
                    'updated_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
                  
                ]
                
            );

            DB::table('status_record')->insert(
                [
                    'order_id' =>  $request->id,
                    'status' => "ontheway",
                    'type' => 2,
                    'created_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
                    'updated_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
                  
                ]
                
            );

        }
        
    } 


    if ($request->status == 'ontheway') {
    
        if($old_status->service_status == 'pending'){
            DB::table('status_record')->insert(
                [
                    'order_id' =>  $request->id,
                    'status' => "accept",
                    'type' => 2,
                    'created_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
                    'updated_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
                  
                ]
                
            );
        
    } 
    }


    DB::table('status_record')->insert(
        [
            'order_id' =>  $request->id,
            'status' => $request->status,
            'type' => 2,
            'created_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
            'updated_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
          
        ]
    );

	$booking = Service_booking::find($request->id);
	$booking->service_status = $request->status;
  	$booking->save();
  
  	
  	return back();
  	
    }
    
    public function show_googlemap($id)
    {

        $address = Setting::first();

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

        //$station["service_station_address"] = $address->service_station_address;

        $data["address"] = $address;
        $data["booking_details"] = $bookig_details;
        $data["service_list"] = $service;
     
        return view('service::booking.googlemap',['data'=>$data]);
    }

    public function booking_details($id){
    
        $base_url = URL::to('/');

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
            
        $bookig_details["id"] = $user_details->id;
        $bookig_details["order_id"] = "#" . $user_details->booking_no;
        $bookig_details["user_name"] = $user->name;
        $bookig_details["date_time"] =
        $user_details->service_date . " " . $user_details->service_time;
        $bookig_details["payment"] = $user_details->payment_method;
        $bookig_details["address"] = $user_details->address;
        $bookig_details["sp_status"] = $user_details->service_status;
        $bookig_details["service_type"] = $user_details->sp_status;
        $bookig_details["sub_total"] = $user_details->subtotal_price;
        $bookig_details["tax"] = $user_details->tax_price;
        $bookig_details["total_price"] = $user_details->total_price;
        $bookig_details["lattitude"] = $user_details->lattitude;
        $bookig_details["longitude"] = $user_details->longitude;
        $bookig_details["number_of_package_visit_pending"] = DB::table('user_package_services')->where('user_id',$user_id)->SUM('service_count');;
        $bookig_details["service_date_time"] =
        $user_details->service_date . " " . $user_details->service_time;
        
        $bookig_details["service_center_lattitude"] = "21.2049";
       
       $bookig_details["service_center_longitude"] = "72.8411";
        $bookig_details["note"] = $user_details->note;
         $bookig_details["admin_note"] = $user_details->admin_note;
        $bookig_details["after_image"] = json_decode($user_details->after_images);
         $bookig_details["before_image"] = json_decode($user_details->before_images);
        $data["booking_details"] = $bookig_details;
        $data["service_list"] = $service;
    	
    	 return view('service::booking.booking_details',['data'=>$data]);
    	
    	
    }


    /**
     * Show the form for editing the specified resource.
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $category,$id)
    {
        // die("xcvxcvxcv");
        // abort_if(!userCan('service.update'), 403);

        $category = Service::where('id',$id)->first();
        return view('service::service.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param CategoryFormRequest $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $category,$id)
    {
        $category_store = Service::find($id);
        // abort_if(!userCan('service.update'), 403);

      
        $category->update($request->except('image'));

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            deleteImage($category->image);
            $url = $request->image->move('uploads/category', $request->image->hashName());
            // $category->update(['image' => $url]);
            $category_store->image = $url;
        }
        
        $category_store->name = $request->name;
        $category_store->time = $request->time;
        $category_store->currency = $request->currency;
        $category_store->price = $request->price;
        $category_store->about_service = $request->about_service;

        $category_store->slug = Str::slug($request->slug);
        $category_store->save();
       


      
        flashSuccess('Category Updated Successfully');
        return redirect(route('module.service.index'));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $category,$id)
    {
        
        $category_store = Service::find($id);
        $category_store->delete();  
        // abort_if(!userCan('service.delete'), 403);

        try {
            $this->Service->destroy($id);
            flashSuccess('Service Deleted Successfully');
            return back();
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrder(Request $request)
    {
        // abort_if(!userCan('service.update'), 403);

        try {
            SortingService::sort($request);
            return response()->json(['message' => 'Category Sorted Successfully!']);
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    public function show($category)
    {
        $category = Service::whereSlug($category)->with('subcategories')->withCount('subcategories')->first();

        return view('category::category.show', compact('category'));
    }

    public function status_change(Request $request)
    {
       date_default_timezone_set('Asia/Kolkata');
        // abort_if(!userCan('service.update'), 403);
        $product = Service::find($request->id);
        $product->status = $request->status;
        $product->save();
        
         DB::table('status_record')->insert(
		    [
		        'order_id' =>  $request->id,
		        'status' => $request->status,
		        'type' => 2,
		        'created_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
		        'updated_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
		      
		    ]
		);

        if ($request->status == 1) {
            return response()->json(['message' => 'Category Activated Successfully']);
        } else {
            return response()->json(['message' => 'Category Inactivated Successfully']);
        }
    }
    
    public function update_note(Request $request){
    	$save_bookings = Service_booking::where('id',$request->service_id)->first();
    	
    	if($save_bookings->after_images != null){
    		$img_array = json_decode($save_bookings->after_images,true);
    	}else{
    		$img_array = [];
    	}
    	
    	   $before_images = [];
           
           

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
		     
		     $save_booking->after_images = json_encode(array_merge($before_images,$img_array));
		     
		      $save_booking->note =$request->service_note;
		     	
		     $save_booking->save();
		    
		    return response()->json(['success'=>true,'message'=>"images updated"],200);
		            
		}
    	
    }
}


