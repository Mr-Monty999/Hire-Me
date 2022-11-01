<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            "post_id" => "required",
        ];
    }
    public function messages()
    {
        return [
            "content.required" => "الرجاء كتابة محتوى التعليق !",
            "photo.image" => "الرجاء رفع صورة فقط !",

        ];
    }
}
