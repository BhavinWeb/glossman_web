<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryFormRequest extends FormRequest
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
                'parent_id' => "required",
                'name' => "required|unique:categories,name",
                'image' => "required|image|max:3072|mimes:jpeg,png,jpg",
            ];
        } else {
            return [
                'parent_id' => "required",
                'name' => "required|string|unique:categories,name,{$this->subcategory->id}",
                'image' => "image|max:3072|mimes:jpeg,png,jpg",
            ];
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'category_id.required' => "The category field is required.",
        ];
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
