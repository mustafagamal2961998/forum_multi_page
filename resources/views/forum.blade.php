@extends('layout/header')
@push('meta')
    <meta name="keywords" content=" منتدي الخلاصه {{$GetForumTopicsByCategoryId[0]->name}}" />
    <meta name="description" content="{{$GetForumTopicsByCategoryId[0]->name}}" />
@endpush

@push('styles')
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/style/home.css')}}">
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/style/forum.css')}}">
@endpush

@section('title', env('APP_NAME') . $GetForumTopicsByCategoryId[0]->name )

@section('direct')
    <div class="direct-container">
        <div class="direct-content">
            <div class="direct">
                <div>
                    <a href="/">
                        الرئيسية
                    </a>
                </div>
                @foreach($GetForumTopicsByCategoryId as $Titles)
                <div>
                    <a href="/title/{{$Titles->title->id}}">
                        {{$Titles->title->title_name}}
                    </a>
                </div>
                <div>
                    <a href="">
                        {{$Titles->name}}
                    </a>
                </div>
                @endforeach
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



             @foreach($GetForumTopicsByCategoryId as $FourmTitle)
               @if(auth()->check())
                <div class="forum-btn-control-container">
                    <div class="forum-btn-control-content">
                        <div class="forum-btn-control">
                            <a href="/newtopic/{{$FourmTitle->id}}"> <i class="ri-add-line"></i> إضافة موضوع</a>
                        </div>
                    </div>
                </div>
               @endif
                <div class="forum">
                    <div class="forum-title">
                        <p class="title-text">
                            <span>  <i class="ri-star-line"></i>    <b>مواضيع المنتدي : </b> <a href="">{{$FourmTitle->name}}</a>  </span>
                        </p>
                        <p class="title-icon" data-id="{{$FourmTitle->title->id}}">
                            <i class="ri-arrow-down-s-line"></i>
                        </p>

                    </div>




                    @if($GetPinTopics->count() > 0 )
                    <div class="pin-topics">
                     <div class="pin-topics-loop">
                         @foreach($GetPinTopics as $PinTopics)

                             <div class="topics-content"  data-id="{{$FourmTitle->title->id}}">
                                 <div class="topics-container">

                                     <div class="topics-title">
                                         <div class="direct-link">
                                             <img src="{{asset(env('APP_FILE').$PinTopics->user->avatar)}}" alt="Topic Icon" title="Topic Icon">
                                             <div>

                                                     <h4 class="pin-topic">
                                                         <span>
                                                             <i class="ri-pushpin-fill"></i>  مثبت : </span>

                                                         <a href="/topic/{{$PinTopics->category->id}}/{{$PinTopics->id}}/{{str_replace(' ','-',$PinTopics->title)}}">
                                                             {{$PinTopics->title}}
                                                         </a>

                                                     </h4>

                                                 <p>
                                                     <small>بواسطة</small> : {{$PinTopics->user->name}}</p>
                                             </div>
                                         </div>



                                     </div>


                                     <div class="topics-info">
                                         <div class="topics-count">
                                             <p>التقيم</p>
                                             @if($PinTopics->rates)
                                                 <span class="rate" data-title="تقيم الموضوع من 0 - 5">
                                                    @php $rating = 0;@endphp
                                                     @foreach($PinTopics->rates  as $PinRateNumber)
                                                         @php $rating += $PinRateNumber->rate   @endphp
                                                     @endforeach
                                                     @for($rate = 0; $rate < $rating / 5; $rate++)
                                                         <img src="{{asset(env('APP_FILE').'/images/d_icons/rate_icon.svg')}}">
                                                     @endfor
                                                </span>
                                                @else
                                                    <span class="rate" data-title="تقيم الموضوع من 0 - 5">
                                                        0
                                                   </span>
                                                @endif




                                         </div>

                                         <div class="topics-comments-count">
                                             <p>المشاركات</p>
                                             <span data-title="عدد التعليقات">{{$PinTopics->comments->count()}}</span>
                                         </div>
                                     </div>


                                     @if($PinTopics->count() > 0)



                                         <div class="topics-last-topic">
                                             <div class="auther-avatar-info">
                                                 <img src="{{asset(env('APP_FILE').$PinTopics->user->avatar)}}" alt="Topic Icon" title="Topic Icon">

                                                 <div class="auther-hiden-profile-info-container">
                                                     <div class="auther-hiden-profile-info-content" style="background-size : cover; background-image: url({{asset(env('APP_FILE').$PinTopics->user->cover)}})">

                                                         <div class="profile-avatar">
                                                             <img src="{{asset(env('APP_FILE').$PinTopics->user->avatar)}}" alt="Topic Icon" title="Topic Icon">
                                                         </div>

                                                         <div class="profile-data">
                                                             <p class="name">
                                                                 <a href="">
                                                                     {{$PinTopics->user->name}}
                                                                 </a>
                                                             </p>
                                                            @if($PinTopics->user->rank)
                                                             <span class="rank" style="background-color: {{$PinTopics->user->rank->rank_bg_color}}; color: {{$PinTopics->user->rank->rank_text_color}}; font-weight: {{$PinTopics->user->rank->rank_font_weight}};">
                                                                <img class="rank-icon" src="{{asset(env('APP_FILE').$PinTopics->user->rank->rank_icon)}}" alt="Rank Icon" title="{{$PinTopics->user->rank->rank_name}}"> {{$PinTopics->user->rank->rank_name}}
                                                             </span>
                                                             @endif
                                                             <p class="joined">
                                                                 <span> إنضم: </span>
                                                                 {{Carbon\Carbon::parse($PinTopics->user->created_at)->translatedFormat('d / M / Y')}}
                                                             </p>

                                                         </div>

                                                     </div>

                                                     <div class="profile-info-footer">
                                                         <ul class="profile-info-footer-list-items">
                                                             <li class="profile-info-footer-item">
                                                                 <p>عدد المواضيع</p>
                                                                 <span data-title="عدد مواضيع المستخدم">{{$PinTopics->user->topics->count()}}</span>
                                                             </li>
                                                             <li class="profile-info-footer-item">
                                                                 <p>عدد المشاركات</p>
                                                                 <span data-title="عدد التعليقات">{{$PinTopics->user->comments->count()}}</span>
                                                             </li>

                                                             <li class="profile-info-footer-item">
                                                                 <p>عدد المشاركات</p>
                                                                 <span>75</span>
                                                             </li>


                                                         </ul>
                                                     </div>
                                                 </div>



                                             </div>

                                             <div class="info">
                                                 <p>
                                                     <a href="">
                                                         {{$PinTopics->user->name}}
                                                     </a>
                                                 </p>

                                                 <p class="time">
                                                     {{ Carbon\Carbon::parse($PinTopics->created_at)->translatedFormat('d / M / Y')}}
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

                                     <div class="pin-topics-views">
                                         <div class="topics-count">
                                             <p>المشاهدات</p>
                                             <span data-title="عدد المشاهدات">{{$PinTopics->views}}</span>
                                         </div>


                                     </div>

                                 </div>
                             </div>

                         @endforeach
                     </div>
                    </div>
                    @endif








            @php
                $TopicsWithPagination = $FourmTitle->topics()->order()->paginate(10);
            @endphp
             @if($FourmTitle->topics->count() >0)

                @foreach($TopicsWithPagination as $Topics)

                     <div class="topics-content" data-id="{{$FourmTitle->title->id}}">
                        <div class="topics-container">

                        <div class="topics-title">


                                <div class="direct-link">
                                    <img src="{{asset(env('APP_FILE').$Topics->user->avatar)}}" alt="Topic Icon" title="Topic Icon">
                                    <div>
                                        <a href="/topic/{{$Topics->category->id}}/{{$Topics->id}}/{{str_replace(' ','-',$Topics->title)}}">

                                            <h4>
                                                {{$Topics->title}}
                                            </h4>
                                        </a>
                                        <p>
                                            <small>بواسطة</small> : {{$Topics->user->name}}
                                        </p>
                                    </div>
                                </div>

                        </div>


                        <div class="topics-info">
                            <div class="topics-count">
                                <p>التقيم</p>





                                    @if($Topics->rates)
                                      <span class="rate" data-title="تقيم الموضوع من 0 - 5">
                                        @php $rating = 0;@endphp
                                           @foreach($Topics->rates as $rateee)
                                               @php $rating += $rateee->rate   @endphp
                                          @endforeach
                                          @for($rate = 0; $rate < $rating / 5; $rate++)
                                              <img src="{{asset(env('APP_FILE').'/images/d_icons/rate_icon.svg')}}">
                                          @endfor
                                    </span>
                                    @else
                                  <span class="rate" data-title="تقيم الموضوع من 0 - 5">
                                        0
                                  </span>
                                @endif

                             </div>

                             <div class="topics-comments-count">
                                 <p>المشاركات</p>
                                 <span data-title="عدد التعليقات">{{$Topics->comments->count()}}</span>
                             </div>
                         </div>


                             @if($Topics->count() > 0)



                             <div class="topics-last-topic">
                                 <div class="auther-avatar-info">
                                     <img src="{{asset(env('APP_FILE').$Topics->user->avatar)}}" alt="Topic Icon" title="Topic Icon">

                                     <div class="auther-hiden-profile-info-container">
                                         <div class="auther-hiden-profile-info-content" style="  background-size : cover; background-image: url({{asset(env('APP_FILE').$Topics->user->cover)}})">

                                             <div class="profile-avatar">
                                                 <img src="{{asset(env('APP_FILE').$Topics->user->avatar)}}" alt="Topic Icon" title="Topic Icon">
                                             </div>

                                             <div class="profile-data">
                                                 <p class="name">
                                                     <a href="">
                                                         {{$Topics->user->name}}
                                                     </a>
                                                 </p>
                                                 @if($Topics->user->rank)
                                                 <span class="rank" style="background-color: {{$Topics->user->rank->rank_bg_color}}; color: {{$Topics->user->rank->rank_text_color}}; font-weight: {{$Topics->user->rank->rank_font_weight}};">
                                                     <img class="rank-icon" src="{{asset(env('APP_FILE').$Topics->user->rank->rank_icon)}}" alt="Rank Icon" title="{{$Topics->user->rank->rank_name}}"> {{$Topics->user->rank->rank_name}}
                                                 </span>
                                                 @endif


                                                 <p class="joined"><span>  إنضم: </span>{{Carbon\Carbon::parse($Topics->user->created_at)->translatedFormat('d / M / Y')}} </p>
                                             </div>

                                         </div>

                                         <div class="profile-info-footer">
                                             <ul class="profile-info-footer-list-items">
                                                 <li class="profile-info-footer-item">
                                                     <p>عدد المواضيع</p>
                                                     <span data-title="عدد مواضيع المستخدم">{{$Topics->user->topics->count()}}</span>
                                                 </li>
                                                 <li class="profile-info-footer-item">
                                                     <p>عدد المشاركات</p>
                                                     <span data-title="عدد التعليقات">{{$Topics->user->comments->count()}}</span>
                                                 </li>
                                                 <li class="profile-info-footer-item">
                                                     <p>عدد المشاركات</p>
                                                     <span>75</span>
                                                 </li>

                                             </ul>
                                         </div>
                                     </div>



                                 </div>

                                 <div class="info">
                                     <p>
                                         <a href="">
                                              {{$Topics->user->name}}
                                         </a>
                                     </p>

                                     <p class="time">
                                         {{ Carbon\Carbon::parse($Topics->created_at)->translatedFormat('d / M / Y')}}
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
                             <div class="topics-views">
                                 <div class="topics-count">
                                     <p>المشاهدات</p>
                                     <span data-title="عدد المشاهدات">{{$Topics->views}}</span>
                                 </div>
                             </div>
                     </div>
                     </div>

                    @endforeach
              @else
                  <div class="forum-empty-msg">
                      <div class="forum-empty-msg-content">
                          <i class="ri-article-line"></i>
                          لا يوجد مواضيع حاليا
                          ( <a href="/">الرئيسية</a> )
                      </div>
                  </div>

              @endif
                 </div>
                  {{$TopicsWithPagination->links()}}

              @endforeach











             </div>


             {{-- END FORUM CONTENT --}}



         {{-- START LEFT SECTION --}}

         {{-- END LEFT SECTION  --}}




         </div>
     </div>

 </div>

 @endsection


 @push('scripts')

 @endpush
