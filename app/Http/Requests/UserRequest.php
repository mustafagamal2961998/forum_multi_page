<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'=>['required','email','exists:users,email','regex:/(.+)@(.+)\.(.+)/i'],
            'password'=>['required','min:8','max:255']
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'يرجي إملاء حقل البريد الالكتروني',
            'email.exists'=>'البريد الالكتروني غير موجود',
            'email.email'=>'صيغة البريد الالكتروني غير صحيحه',
            'email.regex'=>'صيغة البريد الالكتروني غير صحيحه',
            'password.required'=>'يرجي إملاء حقل كلمة المرور ',
            'password.min'=>'يجب ان يكون الحد الادني لعدد الاحرف 8 احرف الي 255 حرف',
        ];
    }
}

