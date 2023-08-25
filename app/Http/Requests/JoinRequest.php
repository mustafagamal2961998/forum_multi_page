<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JoinRequest extends FormRequest
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
            'join_email'=>['required','email','unique:users,email','regex:/(.+)@(.+)\.(.+)/i'],
            'name'=>['required','string'],
            'join_password'=>['required','min:8','max:255'],
            'password_confirmation'=>['required','same:join_password','min:8','max:255'],
            'signatures'=>['nullable','string','regex:/(^([a-zA-z- ]+)(\d+)?$)/u'],
            'signatures_font_family'=>['string'],
            'signatures_text_color'=>['string'],
            'role'=>['required'],
        ];
    }
    public function messages()
    {
        return [
            'join_email.required'=>'يرجي إملاء حقل البريد الالكتروني',
            'join_email.unique'=>'هذا البريد موجود مسبقا',
            'join_email.email'=>'صيغة البريد الالكتروني غير صحيحه',
            'join_email.regex'=>'صيغة البريد الالكتروني غير صحيحه',
            'join_password.required'=>'يرجي إملاء حقل كلمة المرور ',
            'join_password.min'=>'يجب ان يكون الحد الادني لعدد الاحرف 8 احرف الي 255 حرف',
            'name.required'=>'الاسم مطلوب',
            'name.string'=>'يرجي تعديل صيغة الاسم',
            'password_confirmation.same'=>'كلمة المرور غير متطابقه',
            'role.required'=>'يرجي الموافقه علي الشروط والاحكام',
            'password_confirmation.required'=>'إعادة كلمة المرور مطلوبه',
            'signatures.regex'=>'يرجي ادخال أسم التوقيع بصيغه صحيحه'
        ];
    }
}
