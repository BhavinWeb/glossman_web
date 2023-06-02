<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Modules\Brand\Entities\Brand;
use Modules\Location\Entities\City;
use Modules\Location\Entities\State;
use App\Models\Slider;
use App\Models\Package;
use App\Models\Setting;
use App\Models\Favourite_product;
use App\Models\Service_booking;
use App\Models\User;
use App\Models\ReviewRating;
use App\Models\Contactus;
use App\Models\purchesd_packages;
use App\Models\User_package;
use App\Models\Faq;
use Carbon\Carbon;
use Modules\Coupon\Entities\Coupon;
use URL;
use DB;

class HomeController extends BaseController
{
    public function Promotions()
    {
        $coupon = Coupon::orderBy('created_at', 'desc')->get();

        foreach ($coupon as $c_data) {
            $c_data["image"] =
                "https://glossman.bigbyte.app/uploads/promotions.png";
            $c_data["description"] = "Car cleaning Products";
        }

        if ($coupon->count() > 0) {
            $data["promotions"] = $coupon;
        } else {
            $data["promotions"] = [];
        }

        return $this->sendResponse($data, "App Config Data");
    }

    public function FAQ()
    {
        $faq = Faq::where("status", 1)->get();
        $data["faq_list"] = $faq;
        return $this->sendResponse($data, "Faq list!");
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

    public function Config(Request $request)
    {
        //brands
        
        $setting = Setting::first();
         $config_data["accountSid"] = $setting->accountSid;
         $config_data["serviceSid"] = $setting->serviceSid;
          $config_data["authToken"] = $setting->authtoken;
          
        //$config_data["accountSid"] = "AC414d266553294244690db272cf80049f";
         //$config_data["serviceSid"] = "VAe961a5ad81e08e37ca47322ea9dc5376";
          //$config_data["authToken"] = "4b6a5507e4072894714ff4de99f67c4e";
          
           $config_data["squareSandboxAppId"] = $setting->square_appid;
         $config_data["squareSandboxAccessToken"] = $setting->square_accesstoken;
         
          
       // $config_data['country'] = DB::table('countries')->get();
        $config_data['state'] = State::where('country_id',38)->get();
        $state_ids = State::where('country_id',38)->pluck('id')->toArray();
          $config_data['state'] = State::where('country_id',38)->get();
        $config_data['city'] = City::whereIn('state_id', $state_ids)->get();
        
        $brands_data = Brand::get();
        $brands = [];
        $brand_i = 0;
        foreach ($brands_data as $data) {
            $brands[$brand_i]["brand_id"] = $data->id;
            $brands[$brand_i]["name"] = $data->name;
            $brand_i++;
        }
        $config_data["brands"] = $brands;
        //city optional
        $state_id = 12;
        if (isset($request->state_name)) {
            $state = State::where("slug", $request->state_name)->first();
            if ($state) {
                $state_id = $state->id;
            } else {
                $state_id = 12;
            }
        }

        $states_id = State::where('country_id',38)->pluck('id')->toArray();
        $city = City::whereIn("state_id", $states_id)->get();
        $cities = [];
        $city_i = 0;

        foreach ($city as $city_data) {
            $cities[$city_i]["city_id"] = $city_data->id;
            $cities[$city_i]["city_name"] = $city_data->name;
            $city_i++;
        }

        $config_data["cities"] = $cities;

        $start_time = strtotime("10:00:00");
        $end_time = strtotime("20:30:00");
        $slot = strtotime(date("Y-m-d H:i:s", $start_time) . " +30 minutes");

        $data = [];

        for ($i = 0; $slot <= $end_time; $i++) {
            $data[$i] = [
                "start" =>
                    date("h:i A", $start_time),"end"=>date("h:i A", $slot)
            ];

            $start_time = $slot;
            $slot = strtotime(
                date("Y-m-d H:i:s", $start_time) . " +30 minutes"
            );
        }

        $config_data["slots"] = $data;

        return $this->sendResponse($config_data, "App Config Data");
    }

    public function Contact_us(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "full_name" => "required",
            "email" => "required",
            "message" => "required",
        ]);

        if ($validate->fails()) {
            $error = $this->error_msg($validator->errors());
            return $this->sendError($error, "");
        } else {
            $contactus = new Contactus();
            $contactus->full_name = $request->full_name;
            $contactus->email = $request->email;
            $contactus->message = $request->message;
            $contactus->status = 1;
            $contactus->save();

            return $this->sendResponse(
                "Sucessfully added Contact us data!",
                "Sucessfully added Contact us data !."
            );
        }
    }
    public function homepage()
    {


        $user = auth("sanctum")->user();
        $user_id = $user->id;
        $service = Service_booking::where(
            "user_id",
             $user->id
        )->where("service_status","ontheway")->first();

       // $user = User::find($user_details->user_id);
       $service_station = Setting::select('service_station_address','service_station_lat','service_station_long')->first();
       

        $slider = Slider::get();

        foreach ($slider as $slider_1) {
            $slider_1["image"] = URL::to("/") . "/" . $slider_1->image;
        }

        $purchesd_packages = User_package::where("user_id", $user_id)->first();
        

        if ($purchesd_packages) {
            $packages_all = Package::where("status", 1)
                ->with("package_service")
                ->where("id", $purchesd_packages->package_id)
                ->get();
            //$packages_all = Package::where("status", 1)->with('package_service')->orderByRaw('IF(id = '.$purchesd_packages->package_id.', 0,1)')->orderBy('status', 'desc')->get();
        } else {
            $packages_all = Package::where("status", 1)
                ->with("package_service")
                ->get();
        }

        foreach ($packages_all as $package_data) {
            $package_data["duration"] =
                $this->numberToWord($package_data->duration) .
                " " .
                $package_data->duration_type;
            if (
                $purchesd_packages &&
                $purchesd_packages->package_id == $package_data->id
            ) {
                $package_data["start_date"] = $purchesd_packages->start_date;
                $package_data["end_date"] = $purchesd_packages->expired_date;
                $package_data["is_purchased"] = 1;
            } else {
                $package_data["is_purchased"] = 0;
            }
        }

        $data["slider"] = $slider;
        $data["packages"] = $packages_all;
        $data["service"] = $service;
        $data["service_station"] =$service_station;

        return $this->sendResponse($data, "Home page data");
    }


    public function packages()
    {
        // die("XCvxv");
        $packages = Package::where("status", 1)
            ->with("package_service")
            ->get();

        if ($packages->count() > 0) {
            foreach ($packages as $pack_data) {
                $pack_data["duration"] =
                    $this->numberToWord($pack_data->duration) .
                    " " .
                    $pack_data->duration_type;
            }
            $data["packages"] = $packages;

            return $this->sendResponse($data, "Home page data");
        } else {
            return $this->sendResponse("Packages Not Found!", "Home page data");
        }
    }

    public function products_list(Request $request)
    {
        $packages = Package::where("status", 1)->get();

        if ($packages->count() > 0) {
            foreach ($packages as $package_1) {
                $package_1["duration"] = $package_1["duration"] . " MOnth";
                $package_1["car_cleaning"] =
                    $package_1["car_cleaning"] . " Car Cleaning Visits";
                $package_1["interior_cleaning"] =
                    $package_1["interior_cleaning"] . " Interior Cleaning";
                $package_1["vehicle_inspections"] =
                    $package_1["vehicle_inspections"] . " Vehicle Inspections";
            }

            $data["packages"] = $packages;

            return $this->sendResponse($data, "Home page data");
        } else {
            return $this->sendResponse("Packages Not Found!", "Home page data");
        }
    }

    public function get_pages(Request $request)
    {
        $data = null;
        $setting = Setting::first();
        if ($request->get("type") == 1) {
            $data = $setting->about_us;
        }
        if ($request->get("type") == 2) {
            $data = $setting->privacy_policy;
        }
        if ($request->get("type") == 3) {
            $data = $setting->terms_condition;
        }

        return $this->sendResponse($data, " Static Page!");
    }
    
   
}
