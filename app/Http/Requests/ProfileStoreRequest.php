<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileStoreRequest extends FormRequest
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
            "firstname" => "required",
            "lastname" => "required",
            "gender" => "required",
            "birthdate" => "date",
            "user_id" => "required"
        ];
    }

    public function messages()
    {
        return [
            "firstname.required" => "الرجاء كتابة الإسم الأول !",
            "lastname.required" => "الرجاء كتابة إسم العائلة !",
            "birthdate.date" => "الرجاء إدخال تاريخ فقط !",
            "gender.required" => "الرجاء إختيار النوع !"


        ];
    }
}
