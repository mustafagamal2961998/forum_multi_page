<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar">
<head>
    <meta  charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/style/globle.css')}}">
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/gihtue9izg6v8ot4fcykggbxide88zxnlx0jztke3fgnaxcg/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.4.0/remixicon.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_FILE').'/style/jquery.tagsinput.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset(env('APP_FILE').'/style/prism.css')}}">
    @stack('meta')
    @stack('styles')
    <title>@yield('title','Unknow')</title>
</head>
<body>

@section('header')
{{--    @if(!auth()->check())  @endif--}}
    <header>

        {{-- START HEADER --}}
        <div class="header-cotainer">
            <div class="header-content">
                <div class="header">
                    <ul class="header-list-items">
                        <div class="header-info">

                            <li class="header-item">
                                <i class="ri-phone-line"></i> 01095675674
                            </li>
                            <li class="header-item">
                                <i class="ri-facebook-box-line"></i> /mustafa.gamal.5688
                            </li>
                            <li class="header-item">
                                <i class="ri-mail-send-fill"></i> email@email.com
                            </li>
                        </div>

                        @if(!auth()->check())
                        <div class="header-link">
                            <li class="header-item login" onclick="showLoginFormContainer()">
                                <a href="javascript:void(0)" onclick="showLoginFormContainer()">
                                    <i class="ri-login-circle-line"></i> تسجيل الدخول
                                </a>
                            </li>

                            <li class="header-item">
                                <a href="/join">
                                    <i class="ri-user-add-line"></i> تسجيل عضويه
                                </a>
                            </li>
                        </div>
                        @else
                            <div class="header-link profile-data">
                                <li class="header-item">
                                    <div class="profile">
                                       <img src="{{asset(env('APP_FILE').auth()->user()->avatar)}}" alt="User Avatar" title="User Avatar">
                                        {{auth()->user()->name}}
                                    </div>

                                </li>
                             </div>

                        @endif



                    </ul>
                </div>
            </div>
        </div>
        {{-- END HEADER --}}

        {{-- START NAVBAR --}}
         <nav>
            <div class="mobile-nav-menu-icon">
                <i class="ri-menu-fill"></i>
            </div>
        {{-- START MOBILE NAVBAR --}}
            <div class="mobile-nav-content">
                <div class="close-menu">
                    <i class="ri-close-line"></i>
                </div>
                <div class="mobile-nav">
                    <ul class="mobile-nav-list-items">

                        <li class="mobile-nav-item logo">
                            <a href="/">
                                <h3>
                                    <img class="logo" src="{{asset(env('APP_FILE').'/images/logo/logo.svg')}}" alt="Logo Image" title="Logo">
                                    {{trim(env('APP_NAME'),' | ')}}
                                </h3>
                            </a>
                        </li>

                        <a href="/">
                            <li class="mobile-nav-item">
                                <i class="ri-home-7-line"></i>  الرئيسية
                            </li>
                        </a>
                        <a href="">
                            <li class="mobile-nav-item">
                                <i class="ri-hashtag"></i> عرض الأقسام
                            </li>
                        </a>
                        <a href="">
                            <li class="mobile-nav-item">
                                <i class="ri-calendar-event-line"></i>   مشاركات اليوم
                            </li>
                        </a>
                        <a href="">
                            <li class="mobile-nav-item">
                                <i class="ri-user-3-line"></i>  الأعضاء
                            </li>
                        </a>
                        <a href="">
                            <li class="mobile-nav-item">
                                <i class="ri-group-2-line"></i> الكلانات
                            </li>
                        </a>
                        <li class="mobile-nav-item">
                            <form>
                                <input type="text" placeholder="بحث"> <button type="submit"><i class="ri-search-2-line"></i></button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        {{-- END MOBILE NAVBAR --}}

            <div class="nav-content">
                <div class="nav">
                    <ul class="nav-list-items">

                        <div class="navbar-logo">
                            <li class="nav-item">
                                <a href="/">
                                    <h3><img class="logo" src="{{asset(env('APP_FILE').'/images/logo/logo.svg')}}" alt="Logo Image" title="Logo">
                                        {{trim(env('APP_NAME'),' | ')}}
                                    </h3>
                                </a>
                            </li>
                        </div>


                        <div class="navbar-link">
                            <a href="/">
                                <li class="nav-item">
                                    <i class="ri-home-7-line"></i>  الرئيسية
                                </li>
                            </a>
                            <a href="">
                                <li class="nav-item">
                                    <i class="ri-hashtag"></i> عرض الأقسام
                                </li>
                            </a>
                            <a href="">
                                <li class="nav-item">
                                    <i class="ri-calendar-event-line"></i>   مشاركات اليوم
                                </li>
                            </a>
                            <a href="">
                                <li class="nav-item">
                                    <i class="ri-user-3-line"></i>  الأعضاء
                                </li>
                            </a>
                            <a href="">
                                <li class="nav-item">
                                    <i class="ri-group-2-line"></i>  الكلانات
                                </li>
                            </a>


                        </div>


                        <div class="navbar-search">
                            <li class="nav-item">
                                <form>
                                    <input type="text" placeholder="بحث"> <button type="submit"><i class="ri-search-2-line"></i></button>
                                </form>

                            </li>
                        </div>




                    </ul>

                </div>
            </div>
        </nav>
        {{-- END NAVBAR --}}
    </header>
    @if(session()->has('SignatureSuccess'))
        <div class="SignatureSuccess-msg">
            تم تعديل التوقيع بنجاح
        </div>
    @endif
    <div class="login-form-container" @error('email') style="display: block;" @enderror @error('PasswordError') style="display: block;" @enderror  @error('password') style="display: block;" @enderror style="display: none;">

        <div class="login-form-content">

            <div class="login-form">

                    <form action="{{route('login')}}" method="POST">
                        @csrf
                        <div class="close">
                            <i class="ri-close-circle-line"></i>
                        </div>

                        <div class="login-avatar-image-content">
                            <div class="login-avatar-image">
                                  <img src="{{asset(env('APP_FILE').'/images/d_icons/login_avatar.svg')}}" alt="Image avatar" title="Image Avatar">
                            </div>
                        </div>


                        <div class="login-head">
                            <h3> <i class="ri-login-circle-line"></i> تسجيل الدخول </h3>
                        </div>

                        @error('email')
                        <div class="login-error-list-content">
                            <div class="login-error-list">
                                @foreach($errors->get('email') as $error)
                                    <p>{{$error}}</p>
                                @endforeach
                            </div>
                        </div>
                        @enderror

                        <div class="email-input-container">
                            <input type="text" id="email" name="email" placeholder="البريد الالكتروني" value="{{old('email')}}" required>
                        </div>

                        @error('password')
                        <div class="login-error-list-content">
                            <div class="login-error-list">
                                @foreach($errors->get('password') as $error)
                                    <p>{{$error}}</p>
                                @endforeach
                            </div>
                        </div>
                        @enderror
                        @error('PasswordError')
                        <p>كلمة المرور خطاء</p>
                        @enderror
                        <div class="password-input-container">
                            <input type="password" id="password" name="password" placeholder="كلمة المرور"  required>
                        </div>

                        <div class="btn-input-container">
                            <button type="submit" name="login" ><i class="ri-login-circle-line"></i> تسجيل الدخول </button>
                        </div>
                        <div class="login-footer-content">
                            <div class="login-footer">
                                <a href="">هل نسيت كلمة السر ؟</a>
                                <p><b>منتدي الخلاصة يرحب بكم</b></p>
                            </div>
                        </div>
                    </form>
            </div>
        </div>

    </div>

{{-- profile side bar--}}
    @if(auth()->check())

        {{--edit signature--}}
        @if(auth()->user()->signature)
         <div class="edit-signature-content" @error('signature') style="display: block;" @enderror>
             <div class="edit-signature">
                 <form action="{{route('update.signature')}}" method="POST">
                     @csrf
                     <p>تعديل التوقيع</p>
                     <div class="close-edit-signature-box">
                         <i class="ri-close-circle-line"></i>
                     </div>
                     <div class="input-style">
                         @error('signature')
                            <div class="error-msg">{{$message}}</div>
                         @enderror
                         <input type="text" name="signature" value="{{auth()->user()->signature->sign_name}}" placeholder="التوقيع">
                     </div>
                     <div class="input-style">
                         <button type="submit">حفظ التعديلات</button>
                     </div>
                 </form>
             </div>
         </div>
        @endif

        <div class="profile-side-list-container">
            <div class="profile-side-list-content">
                <div class="profile-side-list">

                      <div class="profile-side-head-content">
                          <div class="profile-side-head" style="background-image: url({{auth()->user()->cover}}); background-repeat: no-repeat; background-size: cover">
                              <img src="{{asset(env('APP_FILE').auth()->user()->avatar)}}" alt="الصورة الرمزية">
                              <p>{{auth()->user()->name}}</p>
                              <a href="{{route('profile',auth()->user()->id)}}"><i class="ri-profile-line"></i> الملف الشخصي</a>
                          </div>
                      </div>
                      <ul class="profile-side-list-items">
                             <a href="{{route('profile',auth()->user()->id)}}">
                                 <li class="profile-side-item">
                                     <i class="ri-image-line"></i> تعديل الصورة الرمزية
                                 </li>
                             </a>
                          @if(auth()->user()->signature)
                             <a href="javascript:void(0)">
                                 <li class="profile-side-item edit-signature">
                                     <i class="ri-pencil-ruler-line"></i>  تعديل التوقيع
                                 </li>
                             </a>
                          @endif
                             <a href="">
                                 <li class="profile-side-item">
                                     <i class="ri-calendar-event-line"></i>  مشاركات اليوم
                                 </li>
                             </a>
                             <a href="">
                                 <li class="profile-side-item">
                                     <i class="ri-pencil-line"></i> تعديل بياناتك
                                 </li>
                             </a>

                             <div class="footer">
                                 <a href="">
                                     <li class="profile-side-item">
                                         <i class="ri-git-repository-private-line"></i> قفل الملف الشخصي
                                     </li>
                                 </a>
                                 <a href="{{route('logout')}}">
                                     <li class="profile-side-item logout">
                                         <i class="ri-logout-circle-r-line"></i> تسجيل الخروج
                                     </li>
                                 </a>
                             </div>
                         </ul>

                </div>
            </div>
        </div>

    @endif
{{--end profile side bar--}}

    @if(session()->has('success'))
{{--        @php--}}
{{--            header("refresh:5;url=/" );--}}
{{--        @endphp--}}
        <div class="success-login-welcome-msg-container">
        <div class="success-login-welcome-msg-content">

            <div class="success-login-welcome-msg">
                <div class="close" onclick="closeWelcomeMsg()">
                    <i class="ri-close-circle-line"></i>
                </div>
                   <h2>
                        <img src="{{asset(env('APP_FILE').'/images/logo/logo.svg')}}" alt="User Avatar" title="User Avatar">
                         منتدي الخلاصة
                   </h2>
                   <h4> <i class="ri-heart-fill"></i>  مرحباً بك في منتدانا!  </h4>
                   <p> نحن نقدر تواجدك هنا ونرحب بك كعضو جديد في مجتمعنا. </p>
                   <p> نحن نسعى دائماً لتوفير بيئة صديقة ومفيدة لجميع أعضائنا، حيث يمكنك طرح الأسئلة ومناقشة المواضيع المختلفة مع الأعضاء الآخرين.</p>
                   <p>إذا كان لديك أي أسئلة أو استفسارات، فلا تتردد في طرحها في المنتدى وسنسعى دائماً لتقديم الدعم اللازم للإجابة عليها. </p>
                   <p>نحن سعداء جداً لانضمامك إلى مجتمعنا، ونأمل أن تجد هنا ما يفيدك ويساعدك في تحقيق أهدافك.</p>
                   <h5>شكراً لانضمامك إلينا، ونتطلع إلى تفاعلك ومشاركتك في المنتدى.</h5>
            </div>

        </div>
    </div>

 @endif

    @if($errors->has('StatusError'))
       <div class="member-not-active-container">
           <div class="member-not-active-content">
               <div class="member-not-active-msg">

                    <div class="member-not-active-msg-close" onclick="closeMemberNotActiveErrorMsg()">
                        <i class="ri-close-circle-line"></i>
                    </div>

                    <h4> <i class="ri-chat-delete-line"></i> حسابك غير مفعل </h4>
                    <p>لمعرفة كيفية تفعيل الحساب <a href="">إضغط هنا</a></p>
               </div>
           </div>
       </div>
    @endif

@show





@section('ads')
  <div class="ads-container">
    <div class="ads-content">

        <div class="channel-logo">
            <img class="channel-logo-image" src="{{asset(env('APP_FILE').'/images/channel_logo.png')}}" alt="Channel Logo" title="Chnnel Logo">
        </div>
        @yield('direct')
        <div class="all-ads">

            <div class="title">
                <h3>
                    <i class="ri-advertisement-line"></i>
                    لوحة إعلانات
                </h3>

            </div>

            <div class="ads">

               <div class="ads-banar">
               <a href="">
                <div class="banar">
                    <img class="banar-image"  src="https://cdn.discordapp.com/attachments/487985654945415178/1064497090828439652/dragon-new-text.gif">
                </div>
               </a>
               <a href="">
                <div class="banar">
                    <img class="banar-image" src="https://www.immortals-co.com/ImmortalsBanner.gif">
                </div>
               </a>
               <a href="">
                <div class="banar">
                    <img class="banar-image" src="https://client.jadeconquer.com/banner.gif">
                </div>
               </a>
               <a href="">
                <div class="banar">
                    <img class="banar-image" src="https://i.postimg.cc/PJDfnnkF/Darkness-Co.gif">
                </div>
               </a>
               </div>

            </div>

        </div>

        @if(auth()->guest())
            <div class="notices-container">
                <div class="notices-content">
                    <div class="notices">
                        <h4> <i class="ri-notification-badge-line"></i>  هام جدا </h4>

                        <p class="notice-text">
                            اذا كونت زائر يمكنك الاشتراك معانا بسهولة
                            <a href="">من هنا </a>
                            اما اذا كان لديك حساب يمكنك تسجيل الدخول <a href="">من هنا</a>
                        </p>

                    </div>

                </div>

            </div>
        @else
            <div class="notices-container">
                <div class="notices-content">
                    <div class="notices">
                        <h4> <i class="ri-notification-badge-line"></i> رساله إداريه </h4>

                        <p class="notice-text">
                          منتدي الخلاصة يرحب بكم
                        </p>

                    </div>

                </div>

            </div>
        @endif

    </div>
  </div>
@show


@yield('content')


@section('footer')

<footer>
    <div class="footer-container">
        <div class="footer-content">

            <div class="content">
                <div class="footer-list-item">
                    <h4>روابط سريعه</h4>
                    <ul class="footer-list-items">

                            <li class="footer-item">
                                <a href="/">
                                <i class="ri-home-7-line"></i>   الرئيسية
                                </a>
                            </li>


                            <li class="footer-item">
                                <a href="">
                                <i class="ri-hashtag"></i> عرض الاقسام

                                </a>
                            </li>


                            <li class="footer-item">
                                <a href="">
                                <i class="ri-calendar-event-line"></i> مشاركات اليوم
                                </a>
                            </li>


                            <li class="footer-item">
                                <a href="">
                                 <i class="ri-user-3-line"></i> الأعضاء
                                </a>
                            </li>


                            <li class="footer-item">
                                <a href="">
                                 <i class="ri-group-2-line"></i> الكلانات
                                </a>
                            </li>
                        <li class="footer-item">
                            <div class="social-media">
                                <a href="https://www.facebook.com/groups/292743465720713">
                                    <i class="ri-facebook-circle-fill"></i>
                                </a>
                                <a href="https://www.youtube.com/channel/UC0qNe21B7K6imvPr8cLc97g">
                                    <i class="ri-youtube-fill"></i>
                                </a>
                                <a href="https://www.youtube.com/channel/UC0qNe21B7K6imvPr8cLc97g">
                                    <i class="ri-instagram-fill"></i>
                                </a>
                            </div>
                        </li>

                    </ul>
                </div>

                <div class="center">
                   <b>
                       منتدي الخلاصه يرحب بكم
                   </b>

                </div>

                <div class="footer-text">
                    <h3>منتدي الخلاصه</h3>
                    <p>هذا المنتدي انشاء لمساعدت الناس في مختلف المجالات</p>
                    <p>مجال الشبكات والانترنت</p>
                    <p>مجال برمجة الالعاب الالكترونيه</p>
                    <p>مجال البرمجه والتطبيقات</p>
                    <p>مجال التصميم والتخطيط للمشاريع</p>

                </div>
            </div>



            <div class="notice-copyright">

               <div>
                   <p class="first">
                       <span> <i class="ri-feedback-line"></i> رسالة مهمة</span>
                       ممنوع  مخالفة قوانين او ارشادات المنتدي باي شكل من الاشكال تجنبا للحظر
                   </p>
                   <p class="second">
                       <span>  <i class="ri-questionnaire-line"></i> لماذا منتدي الخلاصه </span>
                       منتدي مختلف ومراقب رقابة جيدة من قبل المسؤولين والمشرفين علي الأقسام
                   </p>

                   <p class="third">
                       <span> <i class="ri-copyright-line"></i> حقوق المنتدي   </span>
                       تم برمجة وتصميم هذا المنتدي بواسطة :   <a href="">Musataf Gamal</a> لمساعدة كل الاشخاص حول العالم
                   </p>
                   <p class="fourth">
                       Copyright © 2023 - 2024
                   </p>
               </div>

            </div>

        </div>
    </div>
</footer>

@show
@stack('scripts')
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
      <script src="{{asset(env('APP_FILE').'/js/jquery.tagsinput.min.js')}}"></script>
      <script src="{{asset(env('APP_FILE').'/js/globle_Jquery.js')}}"></script>
      <script src="{{asset(env('APP_FILE').'/js/new_topic_jquery.js')}}"></script>
      <script src="{{asset(env('APP_FILE').'/js/globle.js')}}"></script>
      <script src="{{asset(env('APP_FILE').'/js/prism.js')}}"></script>
      <script>
          const userID ="{{auth()->id()}}";
      </script>

      <script src="{{asset('js/app.js')}}"></script>

     <script>

         $(document).ready(function() {
             // edit form
             $('.header-link.profile-data .header-item').click(function (){
                 $('.profile-side-list-container').toggle();
                 const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                 audio.play();
             });



             //edit signature

             $('.profile-side-item.edit-signature').click(function (){
                 $('.edit-signature-content').toggle();
                 const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                 audio.play();
             });
             $('.close-edit-signature-box').click(function (){
                 $('.edit-signature-content').toggle();
                 const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                 audio.play();
             });

         });

     </script>
</body>
</html>

