<?php

namespace Modules\Slider\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() === 'POST') {
            return [
                'title' => "required|unique:sliders,title",
                'sub_title' => "required|unique:sliders,sub_title",
                "details" => "nullable|max:500",
                "button_text" => "nullable|string",
                "button_url" => "nullable|url",
                "price" => "nullable|numeric",
                'image' => "required|image|max:3072|mimes:jpeg,png,jpg",
            ];
        } else {
            return [
                'title' => "required|unique:sliders,title,{$this->slider->id}",
                'sub_title' => "required|unique:sliders,sub_title,{$this->slider->id}",
                "details" => "nullable|max:500",
                "button_text" => "nullable|string",
                "button_url" => "nullable|url",
                "price" => "nullable|numeric",
                'image' => "image|max:3072|mimes:jpeg,png,jpg",
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
