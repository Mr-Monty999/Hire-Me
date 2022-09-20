<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
            "content" => "required",
            "photo" => "image|nullable",
        ];
    }

    public function messages()
    {
        return [
            "content.required" => "الرجاء كتابة محتوي المنشور !",
            "photo.image" => "الرجاء إختيار صورة فقط !"
        ];
    }
}
