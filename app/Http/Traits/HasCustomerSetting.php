<?php

namespace App\Http\Traits;

use App\Models\User;
use Modules\Order\Entities\Address;

trait HasCustomerSetting
{

    protected function customerProfileUpdate($request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email'
        ]);
        if ($request->zip) {
            $request->validate([
                'zip' => 'integer',
            ]);
        }
        if ($request->phone) {
            $request->validate([
                'phone' => 'max:17',
            ]);
        }

        $user = User::FindOrFail(auth()->id());
        $user->update([
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'email' => $request->email,
            'secondary_email' => $request->secondaryemail,
            'phone' => $request->phone,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'zip_code' => $request->zip,
        ]);

        if ($request->hasFile('profile')) {

            $request->validate([
                'profile' =>  'image|mimes:jpeg,png,jpg,gif,svg'
            ]);
            $url = uploadImage($request->profile, 'user/profile');
            $user->update([
                'image' => $url
            ]);
        }

        return true;
    }

    protected function customerBillingUpdate($request)
    {
        $request->validate([
            'billing_first_name' => 'required',
            'billing_last_name' => 'required',
            'billing_address' => 'required',
            'billing_country' => 'required',
            'billing_state' => 'required',
            'billing_city' => 'required',
            'billing_zip' => 'required',
            'billing_email' => 'required',
            'billing_phone' => 'required'
        ]);

        $address = Address::where('type', $request->billing_type)->where('addressable_id', auth()->id())->first();
        if ($address) {
            $address->update([
                "first_name" => $request->billing_first_name,
                "last_name" => $request->billing_last_name,
                "company_name" => $request->billing_company_name,
                "address" => $request->billing_address,
                "country_id" => $request->billing_country,
                "state_id" => $request->billing_state,
                "city_id" => $request->billing_city,
                "zip_code" => $request->billing_zip,
                "email" => $request->billing_email,
                "phone" => $request->billing_phone,
                'addressable_type' => 'App\Models\User'
            ]);
            return 'updated';
        } else {
            Address::create([
                'addressable_id' => auth()->id(),
                "type" => $request->billing_type,
                "first_name" => $request->billing_first_name,
                "last_name" => $request->billing_last_name,
                "company_name" => $request->billing_company_name,
                "address" => $request->billing_address,
                "country_id" => $request->billing_country,
                "state_id" => $request->billing_state,
                "city_id" => $request->billing_city,
                "zip_code" => $request->billing_zip,
                "email" => $request->billing_email,
                "phone" => $request->billing_phone,
                'addressable_type' => 'App\Models\User'
            ]);
            return 'created';
        }
    }

    public function customerShippingUpdate($request)
    {

        $request->validate([
            'shpping_first_name' => 'required',
            'shpping_last_name' => 'required',
            'shpping_address' => 'required',
            'shpping_country' => 'required',
            'shpping_state' => 'required',
            'shpping_city' => 'required',
            'shpping_zip' => 'required',
            'shpping_email' => 'required',
            'shpping_phone' => 'required'
        ]);

        $address = Address::where('type', $request->shpping_type)->where('addressable_id', auth()->id())->first();
        if ($address) {
            $address->update([
                "first_name" => $request->shpping_first_name,
                "last_name" => $request->shpping_last_name,
                "company_name" => $request->shpping_company_name,
                "address" => $request->shpping_address,
                "country_id" => $request->shpping_country,
                "state_id" => $request->shpping_state,
                "city_id" => $request->shpping_city,
                "zip_code" => $request->shpping_zip,
                "email" => $request->shpping_email,
                "phone" => $request->shpping_phone,
                'addressable_type' => 'App\Models\User'
            ]);

            return 'updated';
        } else {
            Address::create([
                'addressable_id' => auth()->id(),
                "type" => $request->shpping_type,
                "first_name" => $request->shpping_first_name,
                "last_name" => $request->shpping_last_name,
                "company_name" => $request->shpping_company_name,
                "address" => $request->shpping_address,
                "country_id" => $request->shpping_country,
                "state_id" => $request->shpping_state,
                "city_id" => $request->shpping_city,
                "zip_code" => $request->shpping_zip,
                "email" => $request->shpping_email,
                "phone" => $request->shpping_phone,
                'addressable_type' => 'App\Models\User'
            ]);

            return 'created';
        }
    }
}
