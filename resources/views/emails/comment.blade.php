<x-mail::message>

هناك تعليق جديد لك بخصوص موضوعك

<x-mail::message>
<p>اسم الموضوع </p>
<p>
    <a href="{{env('APP_URL').'/forum/'.$topic_id}}">{{$topic_title}}</a></p>
    <h4>  من ::{{$comment_owner_name}} </h4>
</x-mail::message>

Thanks,<br>
{{trim(env('APP_NAME'),' | ')}}

</x-mail::message>
