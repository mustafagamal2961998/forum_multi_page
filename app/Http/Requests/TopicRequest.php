<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
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
            'title'=>['required','string','min:10','max:255'],
            'topic_content'=>['required','string','min:50'],
            'topic_id'=>['nullable','int','exists:topics,id'],
            'tags'=>['nullable','string','min:4','max:255'],
            'signature_status'=>['in:0,1,2'],
            'owner_follow'=>['in:0,1,2'],
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'يرجي إملاء حقل العنوان',
            'topic_content.required'=>'يرجي كتابة محتوي الموضوع',
            'string'=>'يجب ان تكون البيانات نصيه',
            'title.min'=>'يجب ان يكون الحد الادني لعدد الاحرف 10 احرف الي 255 حرف',
            'title.regex'=>'لا يكمنك إرسال احرف مخصصه داخل العنوان',
            'tags.regex'=>'لا يكمنك إرسال احرف مخصصه داخل الكلمات الدلالية',
            'topic_content.min'=>'يجب ان يكون محتوي الموضوع يحتوي علي 50 حرف علي الاقل',
            'topic_id.exists'=>'رقم الموضوع غير موجود',
            'tags.min'=>'يجب ات يكون الحد الادني لعدد احرف الكلمات الدلالية هوه 10 الي 255 حرف',
            'in'=>'عفوا رقم غير موجود'
        ];
    }
}
