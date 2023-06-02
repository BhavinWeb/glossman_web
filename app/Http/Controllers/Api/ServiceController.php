<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReviewRating;
use App\Models\Service_cart;
use App\Models\User_package;
use App\Models\User_package_service;
use App\Models\package_visit;
use App\Models\Service_booking;
use App\Models\Service_booked;
use App\Models\Setting;
use App\Models\Cards;
use Carbon\Carbon;
use Validator;
use DB;
use URL;

class ServiceController extends Controller
{
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

    public function my_booking()
    {
        $user = auth("sanctum")->user();

        $user_id = $user->id;

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

        // return $this->sendResponse($booking_data, "User Booking List");
        return response()->json(['success' => true, 'message' => "User Booking List", 'data' => $booking_data], 200);
    }

    public function booking_details(Request $request)
    {
        try {
            $Setting = Setting::first();

            $user = auth("sanctum")->user();

            $user_id = $user->id;

            $booking_id = $request->booking_id;
            $base_url = URL::to('/');

            $user_details = Service_booking::where("id", $request->booking_id)->first();

            $service = Service_booked::select("service_bookeds.*", "services.name","services.currency")
                ->leftJoin("services", "service_bookeds.service_id", "=", "services.id")
                ->where("service_bookeds.booking_id", $user_details->id)
                ->get();
            $img_paths = [];
            $before_img_path = [];
            if ($user_details->after_images != null && !empty($user_details->after_images)) {
                $after_image = json_decode($user_details->after_images);

                foreach ($after_image as $after_img) {
                    $img_paths[] = $base_url . "/uploads/service_images/" . $after_img;
                }
            } else {
                $img_paths = [];
            }
            if ($user_details->before_images != null && !empty($user_details->before_images)) {
                $before_image = json_decode($user_details->before_images);

                foreach ($before_image as $before_img) {
                    $before_img_path[] = $base_url . "/uploads/service_images/" . $before_img;
                }
            } else {
                $before_img_path = [];
            }

            $bookig_details["id"] = $user_details->id;
            $bookig_details["order_id"] = "#" . $user_details->booking_no;
            $bookig_details["user_name"] = $user->name;
            $bookig_details["date_time"] = $user_details->created_at->format('Y-m-d h:i A');
            $bookig_details["payment"] = $user_details->payment_method;
            $bookig_details["address"] = $user_details->address;
            $bookig_details["sp_status"] = $user_details->service_status;
            $bookig_details["service_type"] = $user_details->sp_status;
            $bookig_details["sub_total"] = $user_details->subtotal_price;
            $bookig_details["tax"] = $user_details->tax_price;
            $bookig_details["total_price"] = $user_details->total_price;
            $bookig_details["lattitude"] = $user_details->lattitude;
            $bookig_details["longitude"] = $user_details->longitude;
            $bookig_details["number_of_package_visit_pending"] = DB::table('user_package_services')
                ->where('user_id', $user_id)
                ->SUM('service_count');
            $bookig_details["service_date_time"] = $user_details->service_date . " " . $user_details->service_time;
            $bookig_details["after_images"] = $img_paths;
            $bookig_details["before_images"] = $before_img_path;
            $bookig_details["note"] = $user_details->note;
            $bookig_details["service_center_lattitude"] = $Setting['service_station_lat'];
            $bookig_details["service_center_longitude"] = $Setting['service_station_long'];
            $data["booking_details"] = $bookig_details;
            $data["service_list"] = $service;
            // $data['order_track'] = DB::table('status_record')
            //     ->where('order_id', $user_details->id)
            //     ->where('type', 2)
            //     ->select('status_record.status as order_status', DB::raw('DATE_FORMAT(status_record.updated_at, "%b %d,%Y  %h:%i %p") as date'))
            //     ->get();


            $success['pending'] = DB::table('status_record')->Where('status_record.status','pending')
            ->where('order_id',  $user_details->id)
            ->where('type', 2)
            ->select('status_record.status as order_status', DB::raw('DATE_FORMAT(status_record.created_at, "%b %d,%Y  %h:%i %p") as date'))->get();

            $success['accept'] = DB::table('status_record')->Where('status_record.status', 'like', '%' . "accept" . '%')
            ->where('order_id',  $user_details->id)
            ->where('type', 2)
            ->select('status_record.status as order_status', DB::raw('DATE_FORMAT(status_record.created_at, "%b %d,%Y  %h:%i %p") as date'))->get();

            $success['ontheway'] = DB::table('status_record')->Where('status_record.status', 'like', '%' . "ontheway" . '%')
            ->where('order_id',  $user_details->id)
            ->where('type', 2)
            ->select('status_record.status as order_status', DB::raw('DATE_FORMAT(status_record.created_at, "%b %d,%Y  %h:%i %p") as date'))->get();
            
            $success['completed '] = DB::table('status_record')->Where('status_record.status', 'like', '%' . "completed" . '%')
            ->where('order_id',  $user_details->id)
            ->where('type', 2)
            ->select('status_record.status as order_status', DB::raw('DATE_FORMAT(status_record.created_at, "%b %d,%Y  %h:%i %p") as date'))->get();

 	    $data['order_track']= $success;

            return response()->json(['success' => true, 'message' => "User Booking List", 'data' => $data], 200);

            // return $this->sendResponse($data, "User Booking List");
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Some this went wrong!"], 404);
        }
    }

    public function book_now()
    {
        try {
            $Setting = Setting::first();

            $user = auth("sanctum")->user();

            $user_id = $user->id;

            $service_cart = DB::table("service_carts")
                ->where("user_id", $user_id)
                ->join("services", "service_carts.service_product_id", "=", "services.id")
                ->select("services.id", "services.name")
                ->sum("services.price");
            $pkg = DB::table('user_packages')
                ->where('user_id', $user_id)
                ->count();
            $data["package_details"] = $pkg;
            $data["sub_total"] = $service_cart;
            $data["tax"] = $Setting->tax;

            $new_width = ($Setting->tax / 100) * $service_cart;

            $data["total"] = round($new_width) + $service_cart;

            // return $this->sendResponse($data, "Total Amount of services");
            return response()->json(['success' => true, 'message' => "Total Amount of services", 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Some this went wrong!"], 404);
        }
    }

    public function checkout_using_pay(Request $request)
    {
        $user = auth("sanctum")->user();

        $user_id = $user->id;
        if ($request->card_id == 0) {
            $validator = Validator::make($request->all(), [
                'booking_date' => 'required',
                'booking_time' => 'required',
                'lattitude' => 'required',
                'longitude' => 'required',
                'address' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'booking_date' => 'required',
                'booking_time' => 'required',
                'lattitude' => 'required',
                'longitude' => 'required',
                'address' => 'required',
            ]);
        }

        if ($validator->fails()) {
            $error = $this->error_msg($validator->errors());
            return $this->sendError($error, '');
        }

        $Setting = Setting::first();

        $service_carts = Service_cart::where("user_id", $user_id)
            ->pluck("service_product_id")
            ->toArray();

        if ($service_carts) {
            //  $payment_total = filter_var($request->amount, FILTER_SANITIZE_NUMBER_INT);
            $payment_total = intval($request->amount);
            // dd($)

            $source_id = $request->source_id;

            $seed = str_split('abcdefghijklmnopqrstuvwxyz' . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . '0123456789-='); // and any other characters
            shuffle($seed); // probably optional since array_is randomized; this may be redundant
            $rand = '';
            foreach (array_rand($seed, 25) as $k) {
                $rand .= $seed[$k];
            }

            $random_id = $rand . "-" . $user_id;

            $payment_data = [
                'idempotency_key' => $random_id,
                'amount_money' => [
                    'amount' => $payment_total,
                    'currency' => 'USD',
                ],
                'source_id' => $source_id,
            ];
            
           // dd($payment_data);

            $payment_json_data = json_encode($payment_data);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json', 'Authorization:Bearer EAAAECmaiOY69xKEPhTkMYbjum-sTLg57idXiHctuxyPsJO817dQb_UiclLuHtJv']);
            curl_setopt($ch, CURLOPT_URL, 'https://connect.squareupsandbox.com/v2/payments');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payment_json_data);
            $result_payment = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);

            $result_payment = json_decode($result_payment, true);
            // dd($result_payment);
            if (isset($result_payment['errors'])) {
                $success_data = [];
                return response()->json(['success' => false, 'message' => "payment cancel!", 'data' => $success_data], 200);
            } else {
                if ($result_payment['payment']['status'] == "COMPLETED") {
                    if ($request->payment_with_package == 1) {
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
                                $user_package_details_info = DB::table("user_package_services")
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
                        foreach ($with_package_service_id as $update_user_package_service) {
                            $service_name = DB::table("services")
                                ->where("id", $update_user_package_service)
                                ->first();

                            $service_names[] = $service_name->name;

                            $user_package_details_info = DB::table("user_package_services")
                                ->where("package_service_id", $update_user_package_service)
                                ->where("user_id", $user_id)
                                ->first();

                            $total_s = $user_package_details_info->service_count - 1;
                            User_package_service::where("package_service_id", $update_user_package_service)
                                ->where("user_id", $user_id)
                                ->update(["service_count" => $total_s]);
                        }
                        // die("zcxzxc");

                        $package_visit = new package_visit();
                        $package_visit->purchesd_package_id = $user_package_id->id;
                        $package_visit->user_id = $user_id;
                        $package_visit->date = $request->booking_date;
                        $package_visit->time = $request->booking_time;
                        $package_visit->service_name = implode(", ", $service_names);
                        $package_visit->save();

                        // print_r($package_visit);
                        // die;
                    }

                    $service_cart_total = DB::table("service_carts")
                        ->where("user_id", $user_id)
                        ->join("services", "service_carts.service_product_id", "=", "services.id")
                        ->select("services.id", "services.name", DB::raw('SUM(services.price) AS total_price'))
                        ->first();

                    $new_width = ($Setting->tax / 100) * $service_cart_total->total_price;

                    $before_images = [];

                    if ($request->file("before_images_1")) {
                        $file = $request->file("before_images_1");
                        $filename = date("YmdHi") . "1.png";
                        $file->move(public_path("uploads/service_images"), $filename);
                        $before_images[] = $filename;
                    }

                    if ($request->file("before_images_2")) {
                        $file = $request->file("before_images_2");
                        $filename = date("YmdHi") . "2.png";
                        $file->move(public_path("uploads/service_images"), $filename);
                        $before_images[] = $filename;
                    }

                    if ($request->file("before_images_3")) {
                        $file = $request->file("before_images_3");
                        $filename = date("YmdHi") . "3.png";
                        $file->move(public_path("uploads/service_images"), $filename);
                        $before_images[] = $filename;
                    }

                    if ($request->file("before_images_4")) {
                        $file = $request->file("before_images_4");
                        $filename = date("YmdHi") . "4.png";
                        $file->move(public_path("uploads/service_images"), $filename);
                        $before_images[] = $filename;
                    }

                    $total_amount_price = round($new_width) + $service_cart_total->total_price;
                    date_default_timezone_set('Asia/Kolkata');
                    $save_booking = new Service_booking();
                    $save_booking->user_id = $user_id;
                    $save_booking->subtotal_price = $service_cart_total->total_price;
                    $save_booking->tax_price = $Setting->tax;
                    $save_booking->total_price = $total_amount_price;
                    $save_booking->payment_status = "paid";
                    $save_booking->order_status = "paid";
                    $save_booking->payment_method = "card";
                    $save_booking->service_status = "pending";
                    $save_booking->service_date = $request->booking_date;
                    $save_booking->service_time = $request->booking_time;
                    $save_booking->lattitude = $request->lattitude;
                    $save_booking->longitude = $request->longitude;
                    $save_booking->address = $request->address;
                    $save_booking->before_images = json_encode($before_images);
                    $save_booking->address = $request->address;
                    $save_booking->note = $request->note;
                    $save_booking->transaction_id = $request->transaction_id;
                    $save_booking->created_at = Carbon::now()->setTimezone('Asia/Kolkata');
                    $save_booking->updated_at = Carbon::now()->setTimezone('Asia/Kolkata');

                    $save_booking->save();

                    DB::table('status_record')->insert([
                        'order_id' => $save_booking->id,
                        'status' => "pending",
                        'type' => 2,
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata'),
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata'),
                    ]);

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
                    $empty_data = $save_booking;
                    return response()->json(['success' => true, 'message' => "service book successfully!", 'data' => $empty_data], 200);
                } else {
                    return response()->json(['success' => false, 'message' => "Your service cart empty!", 'data' => []], 200);
                }
            }
        } else {
            return response()->json(['success' => false, 'message' => "Your service cart empty!", 'data' => []], 200);
        }

        // return $this->sendResponse($result_data, "service book successfully!");
    }

    public function checkout_service(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_date' => 'required',
            'booking_time' => 'required',
            'lattitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $this->error_msg($validator->errors());
            return $this->sendError($error, '');
        }

        $Setting = Setting::first();

        $user = auth("sanctum")->user();

        $user_id = $user->id;

        $payment_type = $request->pay_with;
        $user_package_id = DB::table("user_packages")
            ->where("user_id", $user_id)
            ->first();

        if (!$user_package_id) {
            return response()->json(['success' => false, 'message' => "You have no package to buy service!", 'data' => []], 200);
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
                        $user_package_details_info = DB::table("user_package_services")
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
                        ->sum('price');

                    $result_data["payment"] = 1;

                    $result_data["sub_total"] = $service_price;

                    $result_data["tax"] = $Setting->tax;

                    $result_data["total"] = $service_price + $Setting->tax;

                    // return $this->sendResponse(
                    //     $result_data,
                    //     "Need To pay using card!"
                    // );

                    return response()->json(['success' => true, 'message' => "Need To pay using card!", 'data' => $result_data], 200);
                } else {
                    $service_name = DB::table("service_carts")
                        ->where("user_id", $user_id)
                        ->join("services", "service_carts.service_product_id", "=", "services.id")
                        ->pluck("services.name")
                        ->toArray();

                    foreach ($with_package_service_id as $update_user_package_service) {
                        $user_package_details_info = DB::table("user_package_services")
                            ->where("user_id", $user_id)
                            ->where("package_service_id", $upd)
                            ->first();
                        $total_s = $user_package_details_info->service_count - 1;
                        User_package_service::where("package_service_id", $update_user_package_service)
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
                        ->join("services", "service_carts.service_product_id", "=", "services.id")
                        ->select("services.id", "services.name")
                        ->sum("services.price");

                    $new_width = ($Setting->tax / 100) * $service_cart_total;

                    $before_images = [];


                    if ($request->file("before_images_1")) {
                        $file = $request->file("before_images_1");
                        $filename = date("YmdHi") . "1.png";
                        $file->move(public_path("uploads/service_images"), $filename);
                        $before_images[] = $filename;
                    }

                    if ($request->file("before_images_2")) {
                        $file = $request->file("before_images_2");
                        $filename = date("YmdHi") . "2.png";
                        $file->move(public_path("uploads/service_images"), $filename);
                        $before_images[] = $filename;
                    }

                    if ($request->file("before_images_3")) {
                        $file = $request->file("before_images_3");
                        $filename = date("YmdHi") . "3.png";
                        $file->move(public_path("uploads/service_images"), $filename);
                        $before_images[] = $filename;
                    }

                    if ($request->file("before_images_4")) {
                        $file = $request->file("before_images_4");
                        $filename = date("YmdHi") . "4.png";
                        $file->move(public_path("uploads/service_images"), $filename);
                        $before_images[] = $filename;
                    }

                    $total_amount_price = round($new_width) + $service_cart_total;

                    date_default_timezone_set('Asia/Kolkata');

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
                    $save_booking->before_images = json_encode($before_images);
                    $save_booking->created_at = Carbon::now()->setTimezone('Asia/Kolkata');
                    $save_booking->updated_at = Carbon::now()->setTimezone('Asia/Kolkata');
                    $save_booking->save();

                    DB::table('status_record')->insert([
                        'order_id' => $save_booking->id,
                        'status' => "pending",
                        'type' => 2,
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata'),
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata'),
                    ]);

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

                    $result_data["payment"] = 0;

                    $service_carts = Service_cart::where("user_id", $user_id)->delete();

                    // return $this->sendResponse(
                    //     $result_data,
                    //     "service book successfully!"
                    // );
                    return response()->json(['success' => true, 'message' => "service book successfully!", 'data' => $result_data], 200);
                }
            } else {
                return response()->json(['success' => false, 'message' => "Your service cart empty!", 'data' => []], 200);
            }
        }
    }

    public function add_service(Request $request)
    {
        try {
            $user = auth("sanctum")->user();

            $user_id = $user->id;

            if ($request->type == 1) {
                $service_count = Service_cart::where("service_product_id", $request->service_product_id)
                    ->where("user_id", $user_id)
                    ->count();
                if ($service_count > 0) {
                    return $this->sendResponse("already added this service in service cart.", "already added this service in service cart.");
                } else {
                    $service_cart = new Service_cart();
                    $service_cart->user_id = $user_id;
                    $service_cart->service_product_id = $request->service_product_id;
                    $service_cart->save();

                    // return $this->sendResponse(
                    //     "added service to service cart.",
                    //     "added service to service cart."
                    // );
                    $data_empty = [];
                    return response()->json(['success' => true, 'message' => "Added service to service cart", 'data' => $data_empty], 200);
                }
            } else {
                $delete = Service_cart::where("service_product_id", $request->service_product_id)
                    ->where("user_id", $user_id)
                    ->delete();

                // return $this->sendResponse(
                //     "remove service from service cart.",
                //     "remove service from service cart."
                // );
                return response()->json(['success' => true, 'message' => "Remove service from service cart"], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Some this went wrong!"], 404);
        }
    }

    public function sendResponse($result, $message)
    {
        $response = [
            "success" => true,
            "data" => $result,
            "message" => $message,
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 200)
    {
        $response = [
            "success" => false,
            "message" => $error,
        ];
        if (!empty($errorMessages)) {
            $response["data"] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    public function service_category_list()
    {
        try {
            $base_url = URL::to('/');
            $result = DB::table("services")
                ->select('services.*', DB::raw("CONCAT('$base_url','/',services.image) AS image"))
                ->where("status", 1)
                ->get();

            if ($result->count() > 0) {
                // foreach ($result as $data_1) {
                //     $data_1->image = URL::to("/") . "/" . $data_1->image;
                // }
                $data["Service_category"] = $result;

                // return $this->sendResponse($data, "Service Category List!");
                return response()->json(['success' => true, 'message' => "Service Category List!", 'data' => $data], 200);
            } else {
                // return $this->sendResponse(
                //     "Service category Not Found!",
                //     "Sevice category not found"
                // );
                $data = [];
                return response()->json(['success' => true, 'message' => "Service category Not Found!", 'data' => $data], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Some this went wrong!"], 404);
        }
    }

    public function get_service(Request $request)
    {
        $base_url = URL::to('/');
        $user = auth("sanctum")->user();

        $user_id = $user->id;
        $result = DB::table("services")
            ->where("id", $request->service_category_id)
            ->first();

        $ReviewRating = ReviewRating::where('item_id', 10)->get();
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
            ->join("services", "service_carts.service_product_id", "=", "services.id")
            ->select("services.id", "services.name", "services.price", DB::raw("CONCAT('$base_url','/',services.image) AS image"))
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

            $new_width = (10 / 100) * $service_cart->sum('price');
            $result->total_price = $service_cart->sum('price') + round($new_width);

            $result->selected_service = $selected_service;

            $reviewRating = ReviewRating::select(
                'review_ratings.comment as comment',
                'review_ratings.star as star',
                DB::raw('DATE_FORMAT(review_ratings.created_at, "%d-%b-%Y") as date'),
                DB::raw("CONCAT('$base_url','/uploads/user_image/',users.image) AS image"),
                'users.name as user_name'
            )
                ->join('users', 'users.id', '=', 'review_ratings.user_id')
                ->where("type", 1)
                ->where("item_id", 10)
                ->paginate(3);
            $service_img = DB::table('product_galleries')
                ->where('product_id', 8)
                ->select(DB::raw("CONCAT('$base_url','/',product_galleries.image) AS image"), 'product_galleries.id as id')
                ->get();
            $result->galleries = $service_img;
            $result->review_rating = $reviewRating;
            $service_data["Service_details"] = $result;

            // return $this->sendResponse($data, "Service Details!");

            return response()->json(['success' => true, 'message' => "Service Details !", 'data' => $service_data], 200);
        } else {
            // return $this->sendResponse(
            //     "Service Details Not Found!",
            //     "Sevice details Not Found"
            // );
            $data = [];

            return response()->json(['success' => false, 'message' => "Service Details Not Found!", 'data' => $data], 200);
        }
    }

    public function cancel_service(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $Service_booked = Service_booking::where('id', $request->booking_id)->update(['service_status' => "cancelled"]);
        // return $this->sendResponse(
        //     [],
        //     "Cancel booking successfully!"

        DB::table('status_record')->insert([
            'order_id' => $request->booking_id,
            'status' => "cancelled",
            'type' => 2,
            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata'),
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata'),
        ]);
        // );
        return response()->json(['success' => true, 'message' => "Cancel booking successfully!"], 200);
    }

    public function service_images(Request $request)
    {
        $save_booking = Service_booking::where('id', $request->service_id)->first();

        if ($save_booking->after_images != null) {
            $img_array = json_decode($save_booking->after_images, true);
        } else {
            $img_array = [];
        }

        $before_images = [];

        if ($request->file("images_1")) {
            $file = $request->file("images_1");
            $filename = date("YmdHi") . "1.png";
            $file->move(public_path("uploads/service_images"), $filename);
            $before_images[] = $filename;
        }

        if ($request->file("images_2")) {
            $file = $request->file("images_2");
            $filename = date("YmdHi") . "2.png";
            $file->move(public_path("uploads/service_images"), $filename);
            $before_images[] = $filename;
        }

        if ($request->file("images_3")) {
            $file = $request->file("images_3");
            $filename = date("YmdHi") . "3.png";
            $file->move(public_path("uploads/service_images"), $filename);
            $before_images[] = $filename;
        }

        if ($request->file("images_4")) {
            $file = $request->file("images_4");
            $filename = date("YmdHi") . "4.png";
            $file->move(public_path("uploads/service_images"), $filename);
            $before_images[] = $filename;
        }

        $save_booking = Service_booking::where('id', $request->service_id)->first();

        $save_booking->after_images = json_encode(array_merge($before_images, $img_array));

        $save_booking->save();

        return response()->json(['success' => true, 'message' => "update image successfully!"], 200);
    }
}
