<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\purchesd_packages;
use App\Models\package_visit;
use App\Models\Package;
use App\Models\User_package;
use App\Models\User_package_service;
use App\Models\Package_service;
use DB;
use Carbon\Carbon;
class PackageController extends Controller
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



    public function sendResponse($result, $message)
    {
        $response = [
            "success" => true,
            "data" => $result,
            "message" => $message,
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
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

    public function Package_buy(Request $request)
    {
        try {

        // die("XCvxcv");
        $user = auth("sanctum")->user();

        $user_id = $user->id;

        $currentDateTime = Carbon::now();
        

        $packages = Package::where("id", $request->package_id)->first();
        if($packages){
        $expired_date = Carbon::now()->addMonths($packages->duration);
	
        $check = User_package::where("user_id", $user_id)->first();

        if ($check && $check->status != 2) {
            return $this->sendResponse(
                "Package already Purchased",
                "Package already Purchased!"
            );
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
		if( $result_payment['payment']['status'] == "COMPLETED") {	
        
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

    public function Package_buy_demo(Request $request)
    {
        // die("XCvxcv");
        $user = auth("sanctum")->user();

        $user_id = $user->id;
        $check = purchesd_packages::where("user_id", $user_id)->first();

        if ($check) {
            $purchesd_packages = purchesd_packages::find($check->id);
        } else {
            $purchesd_packages = new purchesd_packages();
        }

        $packages = DB::table("packages")
            ->where("id", $request->package_id)
            ->first();

        $currentDateTime = Carbon::now();

        $expired_date = Carbon::now()->addMonths($packages->duration);

        $purchesd_packages->user_id = $user_id;
        $purchesd_packages->package_id = $request->package_id;
        $purchesd_packages->expired_date = $expired_date->format("d-m-y");
        $purchesd_packages->start_date = $currentDateTime->format("d-m-y");
        $purchesd_packages->price = $packages->price;
        $purchesd_packages->payment_type = $request->payment_type;

        if (isset($request->payment_id) && $request->payment_id != "") {
            $purchesd_packages->payment_id = $request->payment_id;
        } else {
            $purchesd_packages->payment_id = 0000;
        }

        $purchesd_packages->payment_status = $request->payment_status;
        $purchesd_packages->save();

        return $this->sendResponse("Package Purchased", "Package Purchased!");
    }

    public function Details_of_purchased_package()
    {
       

        $user = auth("sanctum")->user();

        $user_id = $user->id;

        $packages = User_package::where("user_id", $user_id)->count();
	if($packages){
        if ($packages > 0) {
        
        
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
        }

        $data["packages_visit"] = package_visit::where(
            "purchesd_package_id",
            $packages->id
        )->get();
	}
        // return $this->sendResponse("package visit", $data);

        if($packages){

            return response()->json(['success'=>true,'message'=>"Details Of Purchased!",'data'=>$data],200);

        }else{

		$data = [];
            return response()->json(['success'=>false,'message'=>"Details Of Purchased Not Found!",'data'=>$data],200);
            
        }

       

   
    }
}


