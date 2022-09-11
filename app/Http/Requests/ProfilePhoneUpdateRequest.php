<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilePhoneUpdateRequest extends FormRequest
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
            "phone" => "required|unique:profile_phones,phone," . $this->route("profile_phone"),
            "profile_id" => "required"
        ];
    }
    public function messages()
    {
        return [
            "phone.required" => "رقم الهاتف مطلوب !",
            "phone.unique" => "هذا الرقم مستخدم بالفعل !"
        ];
    }
}
