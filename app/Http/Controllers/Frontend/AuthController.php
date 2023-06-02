<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Modules\Coupon\Entities\Coupon;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use Darryldecode\Cart\CartCondition;
use Modules\Attribute\Entities\AttributeValue;
use Modules\Product\Entities\Product;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Mail\SendMail;
use Auth;
use Response;
use App\Models\User;
use App\Models\verified;
use Redirect;
use Input;
use Session;
use Hash;

class AuthController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 200)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
    public function index(Request $request)
    {
        return view("frontend.welcome");
    }

    public function signin(Request $request)
    {
        if (Auth::check()) {
            return Redirect::to("/");
        }

        return view("frontend.auth.signin");
    }

    public function signup(Request $request)
    {
        if (Auth::check()) {
            return Redirect::to("/");
        }

        return view("frontend.auth.signup");
    }

    public function user_signup(Request $request)
    {
        // Generated @ codebeautify.org

        $setting = Setting::first();

        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required||min:6',
            'confirm_password' => 'required|same:password||min:8',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput($request->all())
                ->withErrors($validator);
        }

        $otp_1 = random_int(100000, 999999);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $userd['name'] = $input['fname'] . " " . $input['lname'];
        $userd['address'] = $input['address'];
        $userd['email'] = $input['email'];
        $userd['password'] = $input['password'];
        $userd['phone'] = $input['phone'];
        $userd['country_code'] = $input['code'];
        $userd['otp'] = $otp_1;
        $user = User::create($userd);
        $success['token'] = $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] = $user->name;
        $success['otp'] = $user->otp;
        $success['address'] = "surat";
        $success['city'] = 10;

        Session::put('user_id', $user->id);

        return Response::json([
            'success' => true,
        ]);
    }

    public function user_verification_otp(Request $request)
    {
        $user = verified::where('email', $request->email)
            ->latest()
            ->first();

        // $validator = Validator::make($request->all(), [
        //     'otp' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return Redirect::back()
        //         ->withInput($request->all())
        //         ->withErrors($validator);
        // }

        // dd($user->otp == $request->otp);

        if (intval($user->otp) == intval($request->otp)) {
            $otp_1 = random_int(100000, 999999);
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $userd['name'] = $input['fname'] . " " . $input['lname'];
            $userd['address'] = $input['address'];
            $userd['email'] = $input['email'];
            $userd['password'] = $input['password'];
            $userd['phone'] = $input['phone'];
            $userd['country_code'] = $input['code'];
            $userd['otp'] = " ";
            $user = User::create($userd);
            $success['token'] = $user->createToken('MyAuthApp')->plainTextToken;
            $success['name'] = $user->name;
            $success['otp'] = $user->otp;
            $success['address'] = "surat";
            $success['city'] = 10;

            Auth::login($user);

            return Response::json([
                'success' => true,
            ]);

            // return Redirect::to("/")->with('verification_success', 'your message,here');
        } else {
            return Response::json([
                'success' => false,
            ]);

            // return Redirect::back()->withErrors(["otp" => "Please check OTP! OTP Invalid"]);
        }
    }

    public function resend_otp(Request $request)
    {
        $setting = Setting::first();
        $otp_g = random_int(100000, 999999);
        $testMailData = [
            'title' => 'Glossman',
            'body' => 'You are succesfully registered Here your OTP for varification ' . $otp_g,
        ];

        Mail::to($request->email)->send(new SendMail($testMailData));

        $result = $otp_g;

        $request->validate([
            'email' => 'required|email',
        ]);

        $user = verified::updateOrCreate(['email' => $request['email']], ['otp' => $otp_g]);

        return Response::json([
            'success' => true,
        ]);
    }

    public function user_verification(Request $request)
    {
        if (Auth::check()) {
            return Redirect::to("/");
        }

        $user_id = $request->session()->get('user_id');
        if ($user_id == "") {
            return Redirect::to("/");
        }
        $user = User::find($user_id);
        $otp_1 = random_int(100000, 999999);
        $user->otp = $otp_1;
        $user->save();

        return view("frontend.auth.verification", ['user' => $user]);
    }

    public function user_login(Request $request)
    {
        // Creating Rules for Email and Password
        $rules = [
            "email" => "required|email", // make sure the email is an actual email
            "password" => "required|min:6",
        ];
        // password has to be greater than 3 characters and can only be alphanumeric and);
        // checking all field
        $validator = Validator::make($request->all(), $rules);
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to("signin")->withErrors($validator); // send back all errors to the login form
            // send back the input (not the password) so that we can repopulate the form
        } else {
            // create our user data for the authentication
            $userdata = [
                "email" => $request->email,
                "password" => $request->password,
            ];

            $user_check = User::where('email', $request->email)->first();
            if ($user_check) {
                if ($user_check->deleted_account == 1) {
                    return Redirect::to("signin")->withErrors([
                        "msg" => "Your account has been deleted!",
                    ]);
                }
            }
            // attempt to do the login
            if (Auth::attempt($userdata)) {
                return Redirect::to("/");
            } else {
                // validation not successful, send back to form
                return Redirect::to("signin")->withErrors([
                    "msg" => "email password not match!",
                ]);
            }
        }
    }

    public function forgot_password(Request $request)
    {
        if (Auth::check()) {
            return Redirect::to("/");
        }

        return view("frontend.auth.forgot_password");
    }

    public function forgotpassword(Request $request)
    {
        $setting = Setting::first();

        $input = $request->all();
        $type = $input['type'];
        $error = 0;

        if ($type == 1) {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
            ]);

            if ($validator->fails()) {
                $error = $this->error_msg($validator->errors());
                return $this->sendError($error, '');
            }

            $otp_g = random_int(100000, 999999);
            $email = $request->get('email');
            $user = User::where('email', $email)->first();

            if ($user) {
                $testMailData = [
                    'title' => 'Glossman',
                    'body' => 'You are succesfully registered Here your OTP for varification' . $otp_g,
                ];

                Mail::to($user->email)->send(new SendMail($testMailData));
                $result = $otp_g;

                $user = new verified();
                $user->email = $request['email'];
                $user->otp = $otp_g;
                $user->save();

                //$this->sendmail($input['email'],$otp_g,$user->name);

                return $this->sendResponse($otp_g, 'Successfully send OTP');
            } else {
                return $this->sendError('Email Not Found!', "Email Not Found!");
            }
        }
        if ($type == 2) {
            // $user = User::where('email', $input['email'])->first();
            $user = verified::where('email', $input['email'])
                ->latest()
                ->first();

            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'otp' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                $error = $this->error_msg($validator->errors());
                return $this->sendError($error, '');
            }

            if ($user->otp == $request->otp) {
                $otp_g = random_int(100000, 999999);
                $email = $request->get('email');
                $user = User::where('email', $email)->first();

                return $this->sendResponse('Success', 'Successfully Verify User.');
            } else {
                return $this->sendError('Error', "Incorrect OTP. Please check your OTP!");
            }
        }

        if ($type == 3) {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
            ]);

            if ($validator->fails()) {
                $error = $this->error_msg($validator->errors());
                return $this->sendError($error, '');
            }

            $otp_g = random_int(100000, 999999);
            $email = $request->get('email');
            $user = User::where('email', $email)->first();

            if ($user) {
                $testMailData = [
                    'title' => 'Glossman',
                    'body' => 'You are succesfully registered Here your OTP for varification' . $otp_g,
                ];

                Mail::to($user->email)->send(new SendMail($testMailData));
                $result = $otp_g;

                $user = new verified();
                $user->email = $request['email'];
                $user->otp = $otp_g;
                $user->save();

                //$this->sendmail($input['email'],$otp_g,$user->name);

                return $this->sendResponse($otp_g, 'Successfully send OTP');
            } else {
                return $this->sendError('Email Not Found!', "Email Not Found!");
            }
        }

        if ($type == 4) {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required||min:6',
                'confirm_password' => 'required|same:password||min:6',
            ]);

            if ($validator->fails()) {
                $error = $this->error_msg($validator->errors());
                return $this->sendError($error, '');
            }

            $user = User::where('email', $input['email'])->first();
            $user->password = Hash::make($input['password']);
            $user->otp = null;
            $user->save();

            return $this->sendResponse('Success', 'Successfully change password!');
        }

        if ($error == 1) {
            return $this->sendError('Error', 'something wrong!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect("/signin");
    }

    public function check_user_details(Request $request)
    {
        $email = User::where('email', $request->email)->count();

        if ($email > 0) {
            $data['email'] = true;
        } else {
            $data['email'] = false;
        }

        $phone = User::where('phone', $request->phone)->count();

        if ($phone > 0) {
            $data['phone'] = true;
        } else {
            $data['phone'] = false;
        }

        return Response::json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function email_otp(Request $request)
    {
        $setting = Setting::first();

        $otp_g = random_int(100000, 999999);
        $email = $request->get('email');
        $user = User::where('email', $email)->first();

        $testMailData = [
            'title' => 'Glossman',
            'body' => 'You are succesfully registered Here your OTP for varification' . $otp_g,
        ];

        Mail::to($user->email)->send(new SendMail($testMailData));

        die();
    }
}

