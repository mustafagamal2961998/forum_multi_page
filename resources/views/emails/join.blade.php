<x-mail::message>

تفعيل حسابك امر مهم لتتمكن من المشاركه في المنتدي

<x-mail::message>
<div style="width:100%; margin:auto; text-align:center">
    <p>تفعيل حسابك </p>
    <p><a style=" padding: 5px 10px; background-color: #3c87c5; color: #FFFFFF; font-weight: bold;" href="{{env('APP_URL').'/verify/'.$user_id .'/'.encrypt($random_code)}}"> إضغط هنا </a></p>
    <h4>  بريدك الالكتروني :: {{$email}} </h4>
</div>
</x-mail::message>

Thanks,<br>
{{trim(env('APP_NAME'),' | ')}}

</x-mail::message>
