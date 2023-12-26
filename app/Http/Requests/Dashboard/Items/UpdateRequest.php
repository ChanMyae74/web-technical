<?php

namespace App\Http\Requests\Dashboard\Items;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->isMethod('POST');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => "required",
            'category_id' => 'required',
            'price' => "required",
            'description' => "required",
            'user_name' => "required",
            'phone' => "required|string|phone:AUTo",
            'address' => "required",
        ];
    }
}
