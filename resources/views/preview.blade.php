@extends('layout/header')

@push('styles')
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/style/home.css')}}">
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/style/topic.css')}}">

@endpush

@section('title', env('APP_NAME') . 'معاينة الموضوع')


@section('direct')
    <div class="direct-container">
        <div class="direct-content">
            <div class="direct">
                <div>
                    <a href="/">
                        الرئيسية
                    </a>
                </div>
                <div>
                    <a href="#">
                        معاينة الموضوع
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('content')

<div class="content-container">
    <div class="content">
        <div class="content-content">

{{--             START HEADER TOPIC--}}
            <div class="topic-header-container">
                <div class="topic-header-content">
                    <div class="topic-header">

                        <div class="topic-header-profile-data">

                            <div class="topic-header-profile-data-content">


                                <ul class="topic-header-profile-data-content-list-items">

                                    <li class="topic-header-profile-data-content-item">
                                        <i class="ri-user-6-fill"></i>
                                        <p>
                                            رقم العضوية
                                        </p>
                                        <small>{{auth()->user()->id}}</small>
                                    </li>
                                    <li class="topic-header-profile-data-content-item">
                                        <i class="ri-computer-line"></i>
                                        <p>
                                            نظام التشغيل
                                        </p>
                                        <small>{{auth()->user()->os}}</small>
                                    </li>
                                    @if(auth()->user()->country)
                                    <li class="topic-header-profile-data-content-item">
                                        <i class="ri-map-pin-line"></i>
                                        <p>
                                            الاقامة
                                        </p>
                                        <small>{{auth()->user()->country}}</small>
                                    </li>
                                    @endif
                                    <li class="topic-header-profile-data-content-item">
                                        <i class="ri-calendar-check-line"></i>
                                        <p>
                                            تاريخ التسجيل
                                        </p>
                                        <small>{{Carbon\Carbon::parse(auth()->user()->created_at)->translatedFormat('d / M ')}}</small>
                                    </li>
                                    <li class="topic-header-profile-data-content-item">
                                        <i class="ri-pulse-line"></i>
                                        <p>
                                            +التقييم
                                        </p>
                                        <small>0.05</small>
                                    </li>
                                    <li class="topic-header-profile-data-content-item">
                                        <i class="ri-article-line"></i>
                                        <p>
                                            المشاركات
                                        </p>
                                        <small>{{auth()->user()->topics->count()}}</small>
                                    </li>
                                </ul>

                            </div>

                        </div>


                        <div class="topic-header-profile-data">

                            <div class="data-content">
                                <div class="qr-code">
                                    {!! QrCode::color(225, 225, 225)->backgroundColor(27, 112, 177)->size(100)->generate(env('APP_URL').'/profile/'.auth()->user()->id) !!}
                                </div>

                                <div class="data-text">
                                    <h4>{{auth()->user()->name}}</h4>
                                    @if(auth()->user()->rank)
                                    <p class="rank" style="background-color: {{auth()->user()->rank->rank_bg_color}}; color: {{auth()->user()->rank->rank_text_color}}; font-weight: {{auth()->user()->rank->rank_font_weight}};">
                                        {{auth()->user()->rank->rank_name}}
                                        <img src="{{asset(auth()->user()->rank->rank_icon)}}">
                                    </p>
                                    @endif
                                    @if(auth()->user()->signature)
                                     <span class="signature" style=" font-family: '{{auth()->user()->signature->font_family}}'; color:{{auth()->user()->signature->text_color}};" >{{auth()->user()->signature->sign_name}}</span>
                                    @else
                                        <span class="signature" style="font-family: 'system-ui'; color:#1b70b1;">لا يوجد توقيع </span>
                                    @endif
                                </div>

                                <div class="avatar">
                                    <img src="{{asset(env('APP_FILE').auth()->user()->avatar)}}" alt="Profile Avatar" title="Profile Avatar">
                                </div>


                            </div>

                        </div>



                    </div>
                </div>
            </div>
{{--             END HEADER TOPIC --}}

            <div class="topic-content-container">
                <div class="topic-content-content">
                    <div class="topic-content">
                        @if(request()->page == 1 || request()->page =='')

                            <div class="topic-data-content-container">
                                <div class="topic-data-content-content">

                                        {!! $topic_content !!}

                                </div>
                            </div>

                        @endif

                    </div>
                </div>
            </div>





        </div>
    </div>

</div>


@endsection


@push('scripts')

    <script>

        tinymce.init({
            selector: '#comment',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: ' undo redo | blocks fontfamily fontsize | codesample bold italic underline strikethrough | link image media table mergetags | spellcheckdialog a11ycheck typography align |  lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ]
        });

    </script>
@endpush

