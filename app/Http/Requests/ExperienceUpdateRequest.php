<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceUpdateRequest extends FormRequest
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
            "start" => "date",
            "end" => "date|after:start",
            "position" => "required",
            "company_name" => "required",
            "profile_id" => "required"
        ];
    }

    public function messages()
    {
        return [
            "start.date" => "الرجاء إدخال تاريخ فقط !",
            "end.date" => "الرجاء إدخال تاريخ فقط !",
            "end.after" => "يجب أن يكون بداية المنصب أقل من النهاية !",
            "position.required" => "الرجاء إدخال المنصب !",
            "company_name.required" => "الرجاء إدخال إسم الشركة !"
        ];
    }
}
