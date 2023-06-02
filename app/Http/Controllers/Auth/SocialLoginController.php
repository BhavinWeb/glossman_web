<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SocialSetting;
use Modules\Order\Entities\Address;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialiteUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong. Please try again.');
            return redirect()->route('login');
        }

        $socialiteUserId = $socialiteUser->getId();
        $socialiteUserName = $socialiteUser->getName();
        $socialiteUseremail = $socialiteUser->getEmail();

        $user = User::where([
            'provider' => $provider,
            'provider_id' =>  $socialiteUserId,
        ])->first();

        if (!$user) {

            $validator = Validator::make(
                ['email' => $socialiteUseremail],
                ['email' => ['unique:users,email']],
                ['email.unique' => 'Couldn\'t login. Maybe you used a different login method?'],
            );

            if ($validator->fails()) {
                return redirect()->route('login')->withErrors($validator);
            }

            $splitName = explode(' ', $socialiteUserName, 2);
            $first_name = $splitName[0];
            $last_name = !empty($splitName[1]) ? $splitName[1] : 'last name';

            $user = User::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $socialiteUseremail,
                'provider' => $provider,
                'provider_id' =>  $socialiteUserId,
            ]);
        }

        Auth::guard('user')->login($user);

        return redirect()->route('website.customer.dashboard');
    }
}
