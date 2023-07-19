@extends('layout/header')

@push('meta')
    <meta name="keywords" content=" منتدي {{trim(env('APP_NAME'),' | ')}} , {{$tags ?? ''}}" />
    <meta name="description" content="{{$GetTopicByid->title}}" />
@endpush
@push('styles')
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/style/home.css')}}">
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/style/topic.css')}}">
@endpush
@section('title', env('APP_NAME') . $GetTopicByid->title)


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
                    <a href="/title/{{$GetTopicByid->category->title->id}}">
                        {{$GetTopicByid->category->title->title_name}}
                    </a>
                </div>

                <div  class="none-direct">
                    <a href="/forum/{{$GetTopicByid->category->id}}/{{str_replace(' ','-',$GetTopicByid->category->name)}}">
                        {{$GetTopicByid->category->name}}
                    </a>
                </div>
                    <div class="none-direct">
                        <a href="">
                            {{$GetTopicByid->title}}
                        </a>
                    </div>
               
            </div>
        </div>
    </div>
@endsection
@section('content')

<div class="content-container">
    {{$GetTopicByid->comments()->paginate(5)}}
    <div class="content">
        <div class="content-content">

            {{-- START HEADER TOPIC --}}
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
                                        <small>{{$GetTopicByid->user->id}}</small>
                                    </li>
                                    @if($GetTopicByid->user->os)
                                    <li class="topic-header-profile-data-content-item">
                                        <i class="ri-computer-line"></i>
                                        <p>
                                            نظام التشغيل
                                        </p>
                                        <small>{{$GetTopicByid->user->os}}</small>
                                    </li>
                                    @endif
                                    @if($GetTopicByid->user->country)
                                    <li class="topic-header-profile-data-content-item">
                                        <i class="ri-map-pin-line"></i>
                                        <p>
                                            الاقامة
                                        </p>
                                        <small>{{$GetTopicByid->user->country}}</small>
                                    </li>
                                    @endif
                                    <li class="topic-header-profile-data-content-item">
                                        <i class="ri-calendar-check-line"></i>
                                        <p>
                                            تاريخ التسجيل
                                        </p>
                                        <small>
                                            {{Carbon\Carbon::parse($GetTopicByid->user->created_at)->translatedFormat('d / M ')}}</small>
                                    </li>

                                    <li class="topic-header-profile-data-content-item">
                                        <i class="ri-pulse-line"></i>
                                        <p>
                                            +التقييم
                                        </p>
                                        <small>{{(float)$GetTopicRate}}</small>
                                    </li>

                                    <li class="topic-header-profile-data-content-item">
                                        <i class="ri-article-line"></i>
                                        <p>
                                            المواضيع
                                        </p>
                                        <small>{{$GetTopicByid->user->topics->count()}}</small>
                                    </li>
                                </ul>


                                <div class="topic-header-profile-data-content-footer">

                                    @if(auth()->check())
                                        @if(auth()->user()->id != $GetTopicByid->user_id)

                                             @if(!$CheckIfUserRateTopic)
                                                <div class="topic-rate">
                                                  تقيم الموضوع   <i class="ri-pulse-line"></i>
                                                    <div class="topic-rate-form">
                                                        <form action="{{route('topic.rate',$GetTopicByid->id)}}" method="POST">
                                                            @csrf
                                                            <div class="input-rate">
                                                                <input type="radio" id="one" name="rate" value="1">
                                                                @for($rate = 0; $rate < 1; $rate++)
                                                                   <label for="one"><img src="{{asset(env('APP_FILE').'/images/d_icons/rate_icon.svg')}}"></label>
                                                                @endfor
                                                            </div>


                                                            <div class="input-rate">
                                                                <input type="radio" id="two" name="rate" value="2">
                                                                @for($rate = 0; $rate < 2; $rate++)
                                                                    <label for="two"><img src="{{asset(env('APP_FILE').'/images/d_icons/rate_icon.svg')}}"></label>
                                                                @endfor
                                                            </div>

                                                            <div class="input-rate">
                                                                <input type="radio" id="three" name="rate" value="3">
                                                                @for($rate = 0; $rate < 3; $rate++)
                                                                    <label for="three"><img src="{{asset(env('APP_FILE').'/images/d_icons/rate_icon.svg')}}"></label>
                                                                @endfor
                                                            </div>

                                                            <div class="input-rate">
                                                                <input type="radio" id="four" name="rate" value="4">
                                                                @for($rate = 0; $rate < 4; $rate++)
                                                                    <label for="four"><img src="{{asset(env('APP_FILE').'/images/d_icons/rate_icon.svg')}}"></label>
                                                                @endfor
                                                            </div>
                                                            <div class="input-rate">
                                                                <input type="radio" id="five" name="rate" value="5">
                                                                @for($rate = 0; $rate < 5; $rate++)
                                                                    <label for="five"><img src="{{asset(env('APP_FILE').'/images/d_icons/rate_icon.svg')}}"></label>
                                                                @endfor
                                                            </div>
                                                            <div class="input-rate">
                                                             <input type="submit" value="إرسال">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="topic-header-profile-data-content-social-topic">
                                                    <a href="https://www.facebook.com/groups/292743465720713" target="_blank">
                                                        <i class="ri-facebook-box-fill"></i>
                                                    </a>
                                                    <a href="https://www.facebook.com/groups/292743465720713" target="_blank">
                                                        <i class="ri-twitter-fill"></i>
                                                    </a>
                                                    <a href="https://www.facebook.com/groups/292743465720713" target="_blank">
                                                        <i class="ri-discord-fill"></i>
                                                    </a>
                                                    <a href="https://www.facebook.com/groups/292743465720713" target="_blank">
                                                        <i class="ri-linkedin-box-fill"></i>
                                                    </a>

                                                </div>
                                            @endif


                                        @else
                                            <div class="topic-header-profile-data-content-edit-topic">
                                                    <a href="{{route('edit.topic',$GetTopicByid->id)}}">
                                                        تعديل الموضوع
                                                    </a>
                                            </div>

                                        @endif

                                    @else
                                        <div class="topic-header-profile-data-content-social-topic">

                                            <a href="">
                                                <i class="ri-facebook-box-fill"></i>
                                            </a>
                                            <a href="">
                                                <i class="ri-twitter-fill"></i>
                                            </a>
                                            <a href="">
                                                <i class="ri-discord-fill"></i>
                                            </a>
                                            <a href="">
                                                <i class="ri-linkedin-box-fill"></i>
                                            </a>

                                        </div>
                                    @endif

                                    <div class="topic-date">
                                       <span> تاريخ الموضوع : </span> {{Carbon\Carbon::parse($GetTopicByid->created_at)->translatedFormat('d / M')}}
                                    </div>


                                </div>
                                
                            </div>

                        </div>

                        <div class="topic-header-profile-data">

                            <div class="data-content">
                                <div class="qr-code">
                                    {!! QrCode::color(0, 0, 0)->size(100)->generate(env('APP_URL').'/profile/'.$GetTopicByid->user->id) !!}
                                </div>

                                <div class="data-text">
                                    <h4>{{$GetTopicByid->user->name}}</h4>
                                    @if($GetTopicByid->user->rank)
                                    <p class="rank" style="background-color: {{$GetTopicByid->user->rank->rank_bg_color}}; color: {{$GetTopicByid->user->rank->rank_text_color}}; font-weight: {{$GetTopicByid->user->rank->rank_font_weight}};">
                                        {{$GetTopicByid->user->rank->rank_name}}
                                        <img src="{{asset(env('APP_FILE').$GetTopicByid->user->rank->rank_icon)}}">
                                    </p>
                                    @endif
                                    @if($GetTopicByid->user->signature)
                                     <span class="signature" style=" font-family: '{{$GetTopicByid->user->signature->font_family}}'; color:{{$GetTopicByid->user->signature->text_color}};" >{{$GetTopicByid->user->signature->sign_name}}</span>
                                    @else
                                        <span class="signature" style="font-family: 'system-ui'; color:#1b70b1;">لا يوجد توقيع </span>
                                    @endif
                                </div>

                                <div class="avatar">
                                    <img src="{{asset(env('APP_FILE').$GetTopicByid->user->avatar)}}" alt="Profile Avatar" title="Profile Avatar">
                                </div>


                            </div>

                        </div>

                    </div>
                </div>
            </div>
            {{-- END HEADER TOPIC --}}




            <div class="topic-content-container">
                <div class="topic-content-content">
                    <div class="topic-content">
                        @if(request()->page == 1 || request()->page =='')

                            <div class="topic-content-analysis-list-container">
                                <div class="topic-content-analysis-list-content">
                                    <div class="topic-content-analysis-list">

                                        <div class="topic-content-analysis-title">
                                            <p>احصائيات الموضوع</p>
                                        </div>
                                        
                                              <div class="topic-content-analysis-head">
                                                  <div>
                                                      <i class="ri-eye-line"></i>
                                                      <p>عدد المشاهدات</p>
                                                      <span>{{$GetTopicByid->views}}</span>
                                                  </div>

                                                  <div>
                                                      <i class="ri-reply-all-line"></i>
                                                      <p>عدد الردود</p>
                                                      <span>{{$GetTopicByid->comments->count()}}</span>
                                                  </div>
                                              </div>
                                       



                                          <div class="topic-content-analysis-body">

                                           
                                                  @if(auth()->check() &&  auth()->id() != $GetTopicByid->user_id)
                                                          <div data-title="الابلاغ عن الموضوع">
                                                              <i class="ri-error-warning-line"></i>
                                                          </div>
                                                          <div data-title="تقيم صاحب الموضوع">
                                                              <i class="ri-pulse-line"></i>
                                                          </div>
                                                          <div data-title="اضافة صديق">
                                                              <i class="ri-user-add-line"></i>
                                                          </div>
                                                     @else
                                                        <a href="https://www.facebook.com/groups/292743465720713" target="_blank">
                                                              <div data-title="فيس بوك">
                                                                     <i class="ri-facebook-circle-fill"></i>
                                                              </div>
                                                        </a>
                                                        <a href="https://www.youtube.com/channel/UC0qNe21B7K6imvPr8cLc97g" target="_blank">
                                                              <div data-title="يوتيوب">
                                                                  <i class="ri-youtube-fill"></i>
                                                              </div>
                                                        </a>
                                                        <a href="https://www.youtube.com/channel/UC0qNe21B7K6imvPr8cLc97g" target="_blank">
                                                              <div data-title="انستجرام">
                                                                  <i class="ri-instagram-fill"></i>
                                                              </div>
                                                         </a>
                                                    @endif
                                                

                                          </div>

                                           <div class="topic-content-analysis-footer">
                                               {{-- {!! QrCode::color(0, 0, 0)->size(130)->generate(env('APP_URL').'/topic/'.$TopicContent->category_id .'/' . $TopicContent->id .'/'.str_replace(' ','-',$TopicContent->title)) !!} --}}
                                           </div>
                                    </div>
                                </div>
                            </div>

                            <div class="topic-data-content-container">
                                <div class="topic-data-content-content">
                                   
                                        {!! $GetTopicByid->content !!}
                                  
                                </div>
                            </div>

                       @endif

                    </div>
                </div>
            </div>


            {{-- START TOPIC COMMENTS--}}
            
            <div class="topic-data-comments-container">

                <div class="topic-data-comments-content">

                    <div class="topic-data-comments">
                        @php
                            $TopicCommentsPage = $GetTopicByid->comments()->order()->paginate(5)
                        @endphp
                        <ul class="topic-data-comments-list-item">
                            @foreach($TopicCommentsPage as $Comments)
                            <li class="topic-data-comments-item">

                                <div class="topic-data-comments-item-header">
                                    <div class="topic-data-comments-item-header-comment-number">
                                        {{ Carbon\Carbon::parse($Comments->created_at)->format('H:i') }} : الساعة
                                    </div>
                                    <div class="topic-data-comments-reply">
                                       <span>{{$GetTopicByid->title}}</span>  <p class="text"> رد علي <i class="ri-reply-line"></i> </p>
                                    </div>
                                    <div class="topic-data-comments-item-header-comment-date">
                                        {{Carbon\Carbon::parse($Comments->created_at)->translatedFormat('d / M / Y')}}
                                    </div>

                                </div>



                                <div class="topic-data-comments-item-body">

                                    <div class="topic-data-comments-item-body-comment-content">
                                        {!! $Comments->content !!}
                                    </div>

                                    <div class="topic-data-comments-item-body-profile">
                                        <img src="{{asset(env('APP_FILE').$Comments->user->avatar)}}">
                                        <p class="name"><a href="">{{$Comments->user->name}}</a></p>
                                        @if($Comments->user->rank)
                                            <p class="rank"  style="background-color: {{$Comments->user->rank->rank_bg_color}}; color: {{$Comments->user->rank->rank_text_color}}; font-weight: {{$Comments->user->rank->rank_font_weight}};">
                                                <span>{{$Comments->user->rank->rank_name}}</span>
                                                <img src="{{asset(env('APP_FILE').$Comments->user->rank->rank_icon)}}" alt="Rank Icon" title="Rank Icon">
                                            </p>
                                        @endif
                                        <div class="topic-data-comments-item-body-profile-footer">
                                            <p>   <span> تاريخ الإنضمام : {{Carbon\Carbon::parse($Comments->user->created_at)->translatedFormat('d / M')}}</span> <i class="ri-calendar-check-line"></i></p>
                                            <p>   <span>  رقم العضوية : {{$Comments->user->id}}  </span> <i class="ri-calendar-check-line"></i></p>
                                            <p>   <span> عدد المواضيع : {{$Comments->user->topics->count()}}  </span> <i class="ri-calendar-check-line"></i></p>
                                        </div>
                                    </div>


                                </div>

                                <div class="topic-data-comments-item-footer">
                                    <div class="topic-data-comments-item-footer-report-to-comment">
                                        <i data-title="ابلاغ عن هذا التعليق" class="ri-error-warning-line"></i>
                                    </div>
                                    <div class="topic-data-comments-item-footer-reply-to-comment">
                                        <p>رد سريع</p>

                                    </div>

                                </div>

                            </li>

                            @endforeach
                        </ul>
                        {{$TopicCommentsPage->links()}}
                        @if(auth()->check())
                        <div class="add-comment-container">

                            <div class="add-comment-content">

                                    <div class="add-comment-content-header">
                                          <h4>.:: قال تعالي "وَمَا أُوتِيتُم مِّنَ الْعِلْمِ إِلَّا قَلِيلًا (85)" ::.</h4>
                                          <p> لا تنسي قراءة القوانين <a href="">من هنا</a> <i class="ri-question-line"></i> </p>
                                    </div>

                                        <form action="{{route('comment', ['cat' => $GetTopicByid->category->id, 'id' => $GetTopicByid->id]) }}" method="post">
                                            @csrf
                                            @error('comment')
                                            <div class="error-list">
                                                @foreach($errors->get('comment') as $error)
                                                    <p>{{$error}}</p>
                                                @endforeach
                                            </div>
                                            @enderror
                                            <p> كتابة تعليق <i class="ri-discuss-line"></i> </p>
                                                <textarea  id="comment" name="comment"></textarea>
                                            <div class="add-comment-content-form-btn">
                                                <button id="Add_comment" type="submit">اضافة تعليق</button>
                                            </div>
                                        </form>

                            </div>

                        </div>
                        @endif
                    </div>

                </div>
            </div>
         
            {{-- END TOPIC COMMENTS--}}

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            function disableButton() {
                $("#Add_comment").prop('disabled', true);
            }
            $("#Add_comment").click(function () {
                setTimeout(function () { disableButton(); }, 0);
            });

        });
    </script>
@endpush

