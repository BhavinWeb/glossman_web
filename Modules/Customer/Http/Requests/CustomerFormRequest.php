<?php

namespace Modules\Customer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() == 'POST') {
            return [
                'first_name' => "required",
                'last_name' => "required",
                'phone' => "required|numeric|digits:10",
                'address' => "required",
                'email' => "required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email",
                'password' => "required|min:6",
                'image'     =>  ['required','image','max:1024']
            ];
        } else {
            return [
                'first_name' => "required",
                'last_name' => "required",
                'phone' => "required|numeric|digits:10",
                'address' => "required",
                'email' => "required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email,{$this->id}",
                'password' => "nullable|min:6",
                'image'     =>  ['nullable','image','max:1024']
            ];
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}

