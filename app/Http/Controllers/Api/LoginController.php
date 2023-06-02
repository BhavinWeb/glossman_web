<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderShipped;
use Mail;
use App\Mail\SendMail;
use App\Models\verified;
use URL;
use SoftDeletes;

use App\Models\User;

class LoginController extends Controller
{
    public function check_user_details(Request $request)
    {
        $type = $request->type;
        $value = $request->value;

        if ($type == "email") {
            $user = User::where('email', $request->value)->count();

            if ($user > 0) {
                $success['result'] = true;
            } else {
                $success['result'] = false;
            }

            return response()->json(['success' => true, 'message' => "email!", 'data' => $success], 200);
        } else {
            $user = User::Where('phone', 'like', '%' . $request->value . '%')->count();

            if ($user > 0) {
                $success['result'] = true;
            } else {
                $success['result'] = false;
            }
            return response()->json(['success' => true, 'message' => "phone!", 'data' => $success], 200);
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
    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required||min:6',
          	
        ]);

        if ($validator->fails()) {
            $error = $this->error_msg($validator->errors());
            return $this->sendError($error, '');
        } else {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $authUser = Auth::user();

                if ($authUser->verification_status == 1 && $authUser->deleted_account == 0) {
                    $success['token'] = $authUser->createToken('MyAuthApp')->plainTextToken;
                    $success['user'] = $authUser;
                   
                    return $this->sendResponse($success, 'User signed in');
                }

                if ($authUser->deleted_account == 1 && $authUser->verification_status == 1) {
                    return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
                } else {
                    return $this->sendError('Need To verify account!.', ['error' => '']);
                }
            } else {
                return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
            }
        }
    }

    public function logout()
    {
        $user = auth("sanctum")->user();

        $user->tokens()->delete();
        return $this->sendResponse([], 'User logout sucessfully');
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'country_code' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required||min:6',
            'confirm_password' => 'required|same:password||min:6',
        ]);

        if ($validator->fails()) {
            $error = $this->error_msg($validator->errors());
            return $this->sendError($error, '');
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $userd['name'] = $input['fname'] . " " . $input['lname'];
        $userd['address'] = $input['address'];
        $userd['email'] = $input['email'];
        $userd['password'] = $input['password'];
        $userd['country_code'] = $input['country_code'];
        $userd['phone'] = str_replace($input['country_code'], "", $input['phone']);
        $userd['verification_status'] = 1;
        $userd['otp'] = null;
        $user = User::create($userd);
        $success['token'] = $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] = $user->name;
        $success['otp'] = $user->otp;
        $success['address'] = "surat";
        $success['city'] = 10;

        $user_datas = User::find($user->id);

        if ($user_datas->car_picture != "") {
            $user_datas->car_picture = URL::to('/') . "/uploads/user_image/" . $user_datas->car_picture;
        } else {
            $user_datas->car_picture = null;
        }
        if ($user_datas->image != "") {
            $user_datas->image = URL::to('/') . "/uploads/user_image/" . $user_datas->image;
        } else {
            $user_datas->image = null;
        }
        $success['user'] = $user_datas;
        //$this->sendmail($input['email'],$otp_1,$input['fname']);
        return $this->sendResponse($success, 'User created successfully. Please Verify Your Account');
    }

    public function otp_verification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'email' => 'required',
            // 'otp' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $this->error_msg($validator->errors());
            return $this->sendError($error, '');
        } else {
            if ($request->get('type') == 1) {
                $validator = Validator::make($request->all(), [
                    'otp' => 'required',
                ]);

                if ($validator->fails()) {
                    $error = $this->error_msg($validator->errors());
                    return $this->sendError($error, '');
                }

                $otp_g = random_int(100000, 999999);
                $email = $request->get('email');
                $user_data = User::where('email', $email)->first();
                $user = verified::where('email', $email)
                    ->latest()
                    ->first();

                if ($user) {
                    if ($user->otp == $request->get('otp')) {
                        $user_data->verification_status = 1;
                        $user_data->save();
                        $success['token'] = $user_data->createToken('MyAuthApp')->plainTextToken;
                        $success['user'] = $user_data;
                        return $this->sendResponse($success, 'User created successfully.');
                    } else {
                        //return $this->sendError('Authentication Error','Invalid OTP!');
                        return $this->sendError('Invalid OTP!', 'Invalid OTP!');
                    }
                } else {
                    // return $this->sendError('Error validation','Email Address not found!');
                    return $this->sendError('Email Address not found!', 'Email Address not found!');
                }
            } else {
                $otp_g = random_int(100000, 999999);
                $email = $request->get('email');

                $testMailData = [
                    'title' => 'Glossman',
                    'body' => 'You are succesfully registered Here your OTP for a verification' . $otp_g,
                ];

                Mail::to($request->email)->send(new SendMail($testMailData));
                $result = $otp_g;

                $user = verified::updateOrCreate(['email' => $request['email']], ['otp' => $otp_g]);

                $success['otp'] = $otp_g;
                return $this->sendResponse($success, 'Successfully Send OTP');

                //$this->sendmail($input['email']);
            }
        }
    }

    public function forgotpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $this->error_msg($validator->errors());
            return $this->sendError($error, '');
        }

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

            // $email = $request->get('email');
            // $user = User::where('email', $email)->first();
            // $otp_g = random_int(100000, 999999);

            $otp_g = random_int(100000, 999999);
            $email = $request->get('email');
            $user = User::where('email', $email)->first();

            if ($user) {
                $testMailData = [
                    'title' => 'Glossman',
                    'body' => 'Here your OTP for a change password' . $otp_g,
                ];

                Mail::to($user->email)->send(new SendMail($testMailData));
                $success['otp'] = $otp_g;
                $user = verified::updateOrCreate(['email' => $request['email']], ['otp' => $otp_g]);

                //$this->sendmail($input['email'],$otp_g,$user->name);

                return $this->sendResponse($success, 'Successfully send OTP');
            } else {
                return $this->sendError('Email Not Found!', "Email Not Found!");
            }
        }

        if ($type == 2) {
            $user = verified::where('email', $input['email'])
                ->latest()
                ->first();

            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'otp' => 'required',
            ]);

            if ($validator->fails()) {
                $error = $this->error_msg($validator->errors());
                return $this->sendError($error, '');
            }

            // $user = User::where('email', $input['email'])->first();

            if ($user->otp == $input['otp']) {
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
                    'body' => 'Here your OTP for a change password ' . $otp_g,
                ];

                Mail::to($user->email)->send(new SendMail($testMailData));
                $result = $otp_g;

                $user = verified::updateOrCreate(['email' => $request['email']], ['otp' => $otp_g]);
                //$this->sendmail($input['email'],$otp_g,$user->name);
                return $this->sendResponse($otp_g, 'Successfully Re-send OTP');
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

    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
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

    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required||min:6',
            'confirm_password' => 'required|same:new_password||min:6',
        ]);

        if ($validator->fails()) {
            $error = $this->error_msg($validator->errors());
            return $this->sendError($error, '');
        } else {
            $user_id_data = auth('sanctum')->user();

            $user_id = $user_id_data->id;

            $user = User::findOrFail($user_id);

            if (Hash::check($request->current_password, $user->password)) {
                if ($request->confirm_password == $request->new_password) {
                    $user
                        ->fill([
                            'password' => Hash::make($request->confirm_password),
                        ])
                        ->save();

                    return $this->sendResponse('Success', 'Successfully Password changed!');
                } else {
                    return $this->sendError('Confirm password  does not match', 'confirm password  does not match');
                }
            } else {
                return $this->sendError('Current password does not match', 'Current Password does not match');
            }
        }
    }

    public function get_user(Request $request)
    {
        $user_id = auth('sanctum')->user();
        $user = User::find($user_id->id);

        if ($user->car_picture != "") {
            $user->car_picture = URL::to('/') . "/uploads/user_image/" . $user->car_picture;
        } else {
            $user->car_picture = null;
        }
        if ($user->image != "") {
            $user->image = URL::to('/') . "/uploads/user_image/" . $user->image;
        } else {
            $user->image = null;
        }

        if ($user) {
            $data['user'] = $user;

            return $this->sendResponse($user, 'User Details');
        } else {
            return $this->sendError('Error', 'User Not Found!');
        }
    }

    public function sendmail($email, $otp, $name)
    {
        $data = ['name' => $name, 'otp' => $otp, 'email' => $email];
        Mail::send('mail', $data, function ($message) use ($data) {
            $message->to($data['email'], 'OTP')->subject('Glossman OTP');
            $message->from('bhavin@freshcodes.in', $data['name']);
        });
        return true;
    }
}

