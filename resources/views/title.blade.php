@extends('layout/header')
@push('meta')
    <meta name="keywords" content=" منتدي الخلاصه {{$AllTitles[0]->title_name}}" />
    <meta name="description" content="{{$AllTitles[0]->title_name}}" />
@endpush
@push('styles')

    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/style/home.css')}}">
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/style/title.css')}}">

@endpush
@section('title', env('APP_NAME') . $AllTitles[0]->title_name )

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
                <a href="/title/{{$AllTitles[0]->id}}">
                        {{$AllTitles[0]->title_name}}
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


                @foreach($AllTitles as $Title)

                <div class="forum">
                    <div class="forum-title">
                        <p class="title-text">
                            <span>  <a href="">{{$Title->title_name}}</a>  <i class="ri-star-line"></i> </span>
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
                                        <a href="/forum/{{$Category->id}}/{{str_replace(' ','-',$Category->name)}}">
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
                                        <a href="">
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


            </div>


            {{-- END FORUM CONTENT --}}





        </div>
    </div>
</div>


@endsection



@push('scripts')

@endpush
