<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            "birthdate" => "date",
            "gender" => "required",
            "email" => "email|unique:users,email",
            "password" => "required",
            "repassword" => "same:password"
        ];
    }

    public function messages()
    {
        return [
            "firstname.required" => "الرجاء كتابة الإسم الأول !",
            "lastname.required" => "الرجاء كتابة إسم العائلة !",
            "email.unique" => "هذا البريد موجود بالفعل !",
            "email.email" => "البريد الإلكتروني غير صالح !",
            "password.required" => "الرجاء كتابة كلمة السر !",
            "repassword.same" => "كلمة السر لاتتطابق !",
            "birthdate.date" => "الرجاء إدخال تاريخ فقط !",
            "gender.required" => "الرجاء إختيار النوع !"



        ];
    }
}
