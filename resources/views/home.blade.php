@extends('layout/header')
@push('meta')
    <meta name="keywords" content="منتدي الخلاصىه | الرئيسية " />
    <meta name="description" content="منتدي الخلاصه اقوي وافضل منتدي عربي للاخبار والالعاب الاونلاين والبرامج و الشروحات" />
@endpush
@push('styles')
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/style/home.css')}}">
@endpush
@section('title', env('APP_NAME') . "الرئيسية" )

@section('direct')
<div class="direct-container">
    <div class="direct-content">
        <div class="direct">
            <div>
                <a href="/">
                    الرئيسية
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


       {{-- START FORUM CONTENT --}}

            <div class="forum-content">

                @if($AllTitles->count() > 0)
                    @foreach($AllTitles as $Title)

                    <div class="forum">
                        <div class="forum-title">
                            <p class="title-text">
                                <span>
                                    <a href="/title/{{$Title->id}}">{{$Title->title_name}}</a>
                                    <i class="ri-star-line"></i> </span>
                            </p>

                            <p class="title-icon" data-id="{{$Title->id}}">
                                <i class="ri-arrow-down-s-line"></i>
                            </p>
                        </div>

                         @foreach($Title->categories as $Category)

                             <div class="topics-content" data-id="{{$Category->title->id}}">
                                 <div class="topics-container">

                                <div class="topics-title">
                                        <div class="direct-link">
                                            <img src="{{asset(env('APP_FILE').'/images/logo/logo.svg')}}" alt="Topic Icon" title="Topic Icon">

                                        <div>
                                            <a href="forum/{{$Category->id}}/{{str_replace(' ','_',$Category->name)}}">
                                                <h4>
                                                    {{$Category->name}}
                                                </h4>
                                            </a>
                                            <p>
                                                {{$Category->description}}
                                            </p>
                                        </div>
                                        </div>
                                </div>


                                <div class="topics-info">
                                    <div class="topics-count">
                                        <p>المواضيع</p>
                                        <span>{{$Category->topics->count()}}</span>

                                    </div>

                                    <div class="topics-comments-count">
                                        <p>المشاركات</p>
                                        <span>{{$Category->comments->count()}}</span>
                                    </div>

                                </div>



                                @if($Category->topics->count() > 0)



                                <div class="topics-last-topic">

                                    <div class="auther-avatar-info">
                                        <img src="{{asset(env('APP_FILE').$Category->topics->first()->user->avatar)}}" alt="Topic Icon" title="Topic Icon">

                                        <div class="auther-hiden-profile-info-container">
                                            <div class="auther-hiden-profile-info-content" style="  background-size : cover; background-image: url({{asset(env('APP_FILE').$Category->topics->first()->user->cover)}})">

                                                <div class="profile-avatar">
                                                    <img src="{{asset(env('APP_FILE').$Category->topics->first()->user->avatar)}}" alt="Topic Icon" title="Topic Icon">
                                                </div>

                                                <div class="profile-data">
                                                    <p class="name">
                                                        <a href="">
                                                            {{$Category->topics->first()->user->name}}
                                                        </a>
                                                    </p>
                                                    @if($Category->topics->first()->user->rank)
                                                    <span class="rank" style="background-color: {{$Category->topics->first()->user->rank->rank_bg_color}}; color: {{$Category->topics->first()->user->rank->rank_text_color}}; font-weight: {{$Category->topics->first()->user->rank->rank_font_weight}};">
                                                        <img class="rank-icon" src="{{asset(env('APP_FILE').$Category->topics->first()->user->rank->rank_icon)}}" alt="Rank Icon" title="{{$Category->topics->first()->user->rank->rank_name}}"> {{$Category->topics->first()->user->rank->rank_name}}
                                                    </span>
                                                    @else
                                                    <span class="rank" style="background-color: #3c87c5; color:#ffffff; font-weight: bold;">
                                                        لا يوجد حتي الان
                                                    </span>
                                                    @endif


                                                    <p class="joined"><span> إنضم: </span>{{Carbon\Carbon::parse($Category->topics->first()->user->created_at)->translatedFormat('d / M / Y')}} </p>
                                                </div>

                                            </div>

                                            <div class="profile-info-footer">
                                                <ul class="profile-info-footer-list-items">
                                                    <li class="profile-info-footer-item">
                                                        <p>عدد المواضيع</p>
                                                        <span data-title="عدد مواضيع المستخدم">{{$Category->topics->first()->user->topics->count()}}</span>
                                                    </li>
                                                    <li class="profile-info-footer-item">
                                                        <p>عدد المشاركات</p>
                                                        <span>{{$Category->topics->first()->user->comments->count()}}</span>
                                                    </li>
                                                    <li class="profile-info-footer-item">
                                                        <p>عدد المشاركات</p>
                                                        <span data-title="عدد التعليقات">75</span>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>


                                    </div>


                                    <div class="info">
                                        <p>
                                            <a href="/topic/{{$Category->title->id}}/{{$Category->id}}/{{str_replace(' ','_',$Category->topics->first()->title)}}">
                                                 {{$Category->topics->first()->title}}
                                            </a>
                                        </p>

                                        <p class="time">
                                            {{ Carbon\Carbon::parse($Category->topics->first()->created_at)->translatedFormat('d / M / Y')}}
                                        </p>
                                    </div>
                                </div>

                                @else

                                    <div class="topics-last-topic">


                                        <div class="info">
                                            <p>
                                                <a href="">
                                                    لا يوجد مواضيع هنا
                                                </a>
                                            </p>

                                            <p class="time">
                                                لا يوجد اي مواضيع حاليا
                                            </p>
                                        </div>
                                    </div>


                                @endif
                            </div>
                             </div>
                        @endforeach


                    </div>

                    @endforeach
                @else
                    <h3>لايوجد اي عنوان</h3>
                @endif




            </div>


            {{-- END FORUM CONTENT --}}



        {{-- START LEFT SECTION --}}
        <div class="left-section-container">
            <div class="left-section-content">
                <div class="left-section">
                    {{-- START GET LAST 10 JOINED MEMEBERS --}}
                    <div class="last-member-container">
                        <div class="last-member-content">

                            <h5 class="last-member-title-text">
                                <a href="">
                                    <i class="ri-user-line"></i>
                                    الاعضاء الجدد
                                </a>
                                <i class="ri-arrow-down-s-line"></i>
                            </h5>

                            @if($GetLastUsers)
                            <div class="last-member">
                                @foreach($GetLastUsers as $LastUsers)
                                <div class="last-member-data">
                                    <a href="/profile/{{$LastUsers->id}}">
                                        <img src="{{asset(env('APP_FILE').$LastUsers->avatar)}}" alt="Avatar" title="{{$LastUsers->name}}">

                                    </a>
                                </div>

                                @endforeach
                            </div>
                            @else
                                <div class="last-member">
                                        <div class="last-member-data">
                                            لا يوجد حاليا
                                        </div>
                                </div>
                            @endif


                        </div>
                    </div>
                    {{-- END GET LAST 10 JOINED MEMEBERS --}}



                    {{-- START GET LAST 15 TOPICS --}}

                    <div class="last-topics-container">
                        <div class="last-topics-content">
                            <h5 class="last-topic-title-text">
                                <a href="">
                                    <i class="ri-article-line"></i>
                                    المواضيع الجديده
                                </a>
                                <i class="ri-arrow-down-s-line"></i>
                            </h5>

                            <ul class="last-topics-content-list-items">
                                @if($LastTopics->count() > 0)
                                    @foreach($LastTopics as $Last_Topics)
                                            <li class="last-topics-content-item">
                                                <div class="topic-auther-data">
                                                    <img src="{{asset(env('APP_FILE').$Last_Topics->user->avatar)}}" alt="Topic Icon" title="Topic Icon">

                                                    <div class="topic-auther-profile-data-container">
                                                        <div class="topic-auther-profile-data-content"  style="background-size: cover; background-image: url({{asset(env('APP_FILE').$Last_Topics->user->cover)}})">

                                                            <div class="topic-auther-profile-data-avatar">
                                                                <img src="{{asset(env('APP_FILE').$Last_Topics->user->avatar)}}" alt="Topic Icon" title="Topic Icon">
                                                            </div>

                                                            <div class="topic-auther-profile-data-info">
                                                                <p class="name">
                                                                    <a href="">
                                                                        {{$Last_Topics->user->name}}
                                                                    </a>
                                                                </p>
                                                                @if($Last_Topics->user->rank_id > 0)
                                                                    <span class="rank" style="background-color: {{$Last_Topics->user->rank->rank_bg_color}}; color: {{$Last_Topics->user->rank->rank_text_color}}; font-weight: {{$Last_Topics->user->rank->rank_font_weight}};">
                                                                           <img class="rank-icon" src="{{asset(env('APP_FILE').$Last_Topics->user->rank->rank_icon)}}" alt="Rank Icon" title="{{$Last_Topics->user->rank->rank_name}}"> {{$Last_Topics->user->rank->rank_name}}
                                                                    </span>
                                                                @else
                                                                    <span class="rank" style="background-color: #3c87c5; color:#ffffff; font-weight: bold;">
                                                                     لا يوجد حتي الان
                                                                    </span>
                                                                @endif
                                                                <p class="joined">
                                                                    <span> إنضم:</span> {{Carbon\Carbon::parse($Last_Topics->user->created_at)->translatedFormat('d / M / Y')}}
                                                                </p>
                                                            </div>


                                                        </div>

                                                        <div class="topic-auther-profile-footer">
                                                            <ul class="topic-auther-profile-footer-list-items">
                                                                <li class="topic-auther-profile-footer-item">
                                                                    <p>
                                                                        عدد المواضيع
                                                                    </p>
                                                                    <span data-title="عدد مواضيع المستخدم">{{$Last_Topics->user->topics->count()}}</span>
                                                                </li>
                                                                <li class="topic-auther-profile-footer-item">
                                                                    <p>
                                                                        عدد المشاركات
                                                                    </p>
                                                                    <span>{{$Last_Topics->user->comments->count()}}</span>
                                                                </li>
                                                                <li class="topic-auther-profile-footer-item">
                                                                    <p>
                                                                        عدد المشاركات
                                                                    </p>
                                                                    <span data-title="عدد التعليقات">65</span>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="topic-title">
                                                    <a href="/topic/{{$Last_Topics->category->id}}/{{$Last_Topics->id}}/{{str_replace(' ','-',$Last_Topics->title)}}">
                                                        <p>

                                                            {{$Last_Topics->title}}
                                                        </p>
                                                     </a>

                                                    <div class="last-topics-footer">
                                                        <p>{{$Last_Topics->user->name}}  <i class="ri-user-line"></i></p>
                                                        <p>
                                                            {{Carbon\Carbon::parse($Last_Topics->created_at)->translatedFormat('d / M ')}}  <i class="ri-alarm-line"></i>
                                                        </p>
{{--                                                        <p class="last-topic-date-time" data-title="{{$Last_Topics->created_at}}">--}}
{{--                                                             <i class="ri-alarm-line"></i>--}}
{{--                                                        </p>--}}
                                                    </div>
                                                </div>

                                            </li>
                                    @endforeach
                                    @else
                                    <li class="last-topics-content-item">

                                        <div class="topic-title">
                                            <a href="">
                                                <p>
                                                   لا يوجد مواضيع حاليا
                                                </p>
                                            </a>
                                        </div>

                                    </li>
                                @endif


                            </ul>

                        </div>
                    </div>
                    {{-- END GET LAST 15 TOPICS --}}


                    {{-- START GET FORUM ANALYSIS --}}
                    <div class="forum-analysis-container">
                        <div class="forum-analysis-content">
                            <h5 class="forum-analysis-title-text">
                                <a href="">
                                    <i class="ri-line-chart-line"></i>
                                     إحصائيات المنتدى
                                </a>
                                <i class="ri-arrow-down-s-line"></i>
                            </h5>
                            <div class="forum-analysis">

                              <div style="border-bottom: 1px solid #f1f1f1">
                                  <p class="show-text">المواضيع:</p>
                                  <p class="analysis">{{$AllTopics}}</p>
                              </div>
                                <div style="border-bottom: 1px solid #f1f1f1">
                                    <p class="show-text">المشاركات:</p>
                                    <p class="analysis">{{$AllComments}}</p>
                                </div>
                                <div style="border-bottom: 1px solid #f1f1f1">
                                    <p class="show-text">الأعضاء:</p>
                                    <p class="analysis">{{$AllUsers}}</p>
                                </div>
                                <div style="border-bottom: 1px solid #f1f1f1">
                                    <p class="show-text">الكلانات:</p>
                                    <p class="analysis">43</p>
                                </div>
                                @if($GetLastUsers->first())
                                <div>
                                    <p class="show-text">آخر عضو مسجل:</p>
                                    <p class="analysis">
                                        <a href="">
                                            {{$GetLastUsers->first()->name}}
                                        </a>
                                    </p>
                                </div>
                                @else
                                    <div>
                                        <p class="show-text">آخر عضو مسجل:</p>
                                        <p class="analysis">
                                            <a href="">
                                               لا يوجد اعضاء حاليا
                                            </a>
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- END GET FORUM ANALYSIS --}}






                </div>
            </div>
        </div>
        {{-- END LEFT SECTION  --}}




        </div>
    </div>
</div>


@endsection



@push('scripts')

@endpush
