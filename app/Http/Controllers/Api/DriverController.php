<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Driver;
use App\Models\Service_booking;
use App\Models\Service_booked;
use Modules\Service\Entities\Service;
use Illuminate\Support\Str;
use Validator;
use Mail;
use DB;
use App\Mail\SendMail;
use Carbon\Carbon;
use Pusher\Pusher;

class DriverController extends Controller
{
    public function DirverLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
             'fcm_token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {

            $email = $request->input('email');
    	    $password = $request->input('password');

    	    $checkEmail = Driver::where('email', $email)->first();

            if($checkEmail){
                if($checkEmail->status > 0){
                    if($checkEmail->password == $password){
                        $success['token'] = hash('sha256', Str::random(40));

                        $update_token = Driver::find($checkEmail->id);
                        $update_token->token = $success['token'];
                        $update_token->fcm_token = $request->input('fcm_token');
                        $update_token->save();


                        $driverData = Driver::select('id', 'name', 'email', 'status', 'token', 'created_at', 'updated_at')->where('id', '=', $checkEmail->id)->first();

                        $response = [
                            'success' => true,
                            'status' => 200,
                            'data'    => $driverData,
                            'message' => 'Driver signed in',
                        ];
                        return response()->json($response);
                    }else{
                        $response = [
                            'success' => false,
                            'status' => 401,
                            'error' => 'Incorrect Password!',
                        ];
                        return response()->json($response);
                    }
                }else{
                    $response = [
                        'success' => false,
                        'status' => 401,
                        'error' => 'Unauthorised!',
                    ];
                    return response()->json($response);
                }
            }else{
                $response = [
                    'success' => false,
                    'status' => 553,
                    'error' => 'Invalid Email Address!',
                ];
                return response()->json($response);
            }

        }
    }


    public function DriverEmailVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } 

        $checkEmail = Driver::where('email', $request->email)->first();
        if ($checkEmail) {
            $otp = random_int(100000, 999999);

            $update_otp = Driver::find($checkEmail->id);
            $update_otp->otp = $otp;
            $update_otp->save();
    
            $data = ['name' => $checkEmail->name, 'otp' => $otp, 'email' => $checkEmail->email];
            Mail::send('mail', $data, function ($message) use ($data) {
                $message->to($data['email'], 'OTP')->subject('Glossman OTP');
                $message->from('bhavin@freshcodes.in', $data['name']);
            });
            return response()->json(['success' => true, 'status' => 200, 'message' => 'Reset password otp send on this email'.' '.$checkEmail->email]);
        }else{
            $response = [
                'success' => false,
                'status' => 404,
                'error' => 'Email not found!',
            ];
            return response()->json($response);
        }
    }

    public function DriverOtpVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'otp' => 'required|min:6|max:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } 

        $checkEmail = Driver::where('email', $request->email)
                                ->where('otp', $request->otp)
                                ->first();

        if ($checkEmail) {
            if($checkEmail->otp == $request->otp){
                return response()->json(['success' => true, 'status' => 200, 'message' => 'Otp Matched']);
            }
            return response()->json(['success' => false, 'status' => 400, 'message' => 'Otp Not Matched']);
        }else{
            $response = [
                'success' => false,
                'status' => 401,
                'error' => 'Unauthorised!',
            ];
            return response()->json($response);
        } 
    }

    public function DriverSetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } 

        $checkEmail = Driver::where('email', $request->email)->first();
        if ($checkEmail) {
            
            $update_pwd = Driver::find($checkEmail->id);
            $update_pwd->password = $request->password;
            $update_pwd->save();
            return response()->json(['success' => true, 'status' => 200, 'message' => 'Password Updated']);
        }else{
            $response = [
                'success' => false,
                'status' => 401,
                'error' => 'Unauthorised!',
            ];
            return response()->json($response);
        }       
    }

    public function DriverHomePage(Request $request)
    {
      	$driver_id = $request->driver_id;
        $data = Service_booking::select('id', 'booking_no', 'driver_id', 'service_date', 'service_time', 'service_status', 'lattitude', 'longitude', 'address', 'landmark', 'note', 'admin_note',  'created_at', 'updated_at')->where('driver_id', '=', $driver_id)->orderBy("id", "desc")->get();
        	
      	  foreach($data as $driver_data){
            $service_id = Service_booked::where('booking_id',$driver_data->id)->pluck("service_id");  
            $service_name = Service::whereIn('id',$service_id)->pluck("name");
            $driver_data["service_name"] = $service_name; 
        }

      	return response()->json(['success' => true, 'status' => 200, 'data' => $data]);        
    }

    public function DriverServiceStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required',
            'service_id' => 'required',
            'status' => 'required',
            'reason' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } 

        $msg = ' ';

      
        
        $status = (int)$request->status;

        $update = Service_booking::find($request->service_id);


        if($request->status == 1){
            $msg = "Service Accepted";
            $update->service_status = 'accept';
          
           DB::table('status_record')->insert(
                [
                    'order_id' =>  $request->service_id,
                    'status' => "accept",
                    'type' => 2,
                    'created_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
                    'updated_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
                
                ]
            );
        }
      
       if($request->status == 2){
            $msg = "Service ontheway";
            $update->service_status = 'ontheway';
          
           DB::table('status_record')->insert(
                [
                    'order_id' =>  $request->service_id,
                    'status' => "ontheway",
                    'type' => 2,
                    'created_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
                    'updated_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
                
                ]
            );
        }
      	
        if($request->status == 3){
            $msg = "Service completed";
            $update->service_status = 'completed';
          
           DB::table('status_record')->insert(
                [
                    'order_id' =>  $request->service_id,
                    'status' => "completed",
                    'type' => 2,
                    'created_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
                    'updated_at'=>Carbon::now()->setTimezone('Asia/Kolkata'),
                
                ]
            );
        }
      
      	 if($request->status == 0){
            $msg = "Service Rejected";
            $update->service_status = 'pending';
        }
      
        $update->driver_status = $status;
        $update->driver_reason = $request->reason;
        $update->save();

        return response()->json(['success' => true, 'status' => 200, 'message' => $msg]);        
    }

    public function DriverTracking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required',
            'service_id' => 'required',
            'service_status' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        } 

        $update = Service_booking::find($request->service_id);

        $update->service_status = $request->service_status;
        $update->save();

        return response()->json(['success' => true, 'status' => 200, 'message' => 'Service Status Updated']);        
    }
  
  	public function UpdateFcmtoken(Request $request){

        $validator = Validator::make($request->all(), [
            'fcm_token' => 'required',
            'driver_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        } 

        $update_pwd = Driver::find($request->driver_id);
        $update_pwd->fcm_token = $request->fcm_token;
        $update_pwd->save();

        return response()->json(['success' => true, 'status' => 200, 'message' => 'fcm token Updated']);

    }
  
  	
    public function shareDriverLocation(Request $request){
        
        $validator = Validator::make($request->all(), [
            'lattitude' => 'required',
            'longitude' => 'required',
            'order_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        } 

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
            
        $data = [];
      	$data["latitude"] = $request->lattitude;
      	$data["longitude"] = $request->longitude;
        $event_name = "driver_location_".$request->order_id;

        //Send a message to notify channel with an event name of notify-event
        $pusher->trigger('current_location', $event_name, $data);
        return response()->json(['success'=> true, 'message' => 'Driver location share']);
    }
}
