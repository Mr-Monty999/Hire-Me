<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required",
            "description" => "required",
            "location" => "required",
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "الرجاء كتابة عنوان الوظيفة !",
            "description.required" => "الرجاء كتابة الوصف !",
            "location.required" => "الرجاء كتابة المنطقة !"
        ];
    }
}
