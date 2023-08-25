<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://cdn.usebootstrap.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.4.0/remixicon.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/dashboard/css/main.css')}}">
    @stack('style')
    <title>@yield('title','UnKnow')</title>
</head>
<body>

<div class="dashboard-container">
    <div class="dashboard-content">
        <div class="dashboard">

            {{--sidebar--}}
            @section('sidebar')
                <div class="sidebar-container">
                    <div class="sidebar-content">
                        <div class="sidebar">
                            {{-- head--}}
                            <div class="sidebar-head">
                                <div class="side-head-data">
                                    <img src="https://www.seekpng.com/png/full/428-4287240_no-avatar-user-circle-icon-png.png">
                                    <p>Mustafa Gamal</p>
                                </div>
                            </div>

                            {{-- list item--}}
                             <div class="sidebar-list">
                                 <ul class="sidebar-list-items">
                                 <div class="small-title">
                                     <small>الروابط</small>
                                 </div>
                                 <a href="{{route('admin.dashboard.index')}}">
                                     <li class="sidebar-item">
                                         <img src="{{asset(env('APP_FILE').'/dashboard/images/icons/home.svg')}}">
                                         الرئيسية
                                     </li>
                                 </a>

                                    <div class="small-title">
                                        <small>إدارة المنتدي</small>
                                    </div>

                                     <a href="{{route('admin.dashboard.titles')}}">
                                         <li class="sidebar-item">
                                             <img src="{{asset(env('APP_FILE').'/dashboard/images/icons/title.svg')}}">
                                             إدارة العناوين
                                         </li>
                                     </a>

                                     <a href="{{route('admin.dashboard.categories')}}">
                                         <li class="sidebar-item">
                                             <img src="{{asset(env('APP_FILE').'/dashboard/images/icons/category.svg')}}">
                                             إدارة الاقسام
                                         </li>
                                     </a>

                                     <a href="{{route('admin.dashboard.topics')}}">
                                         <li class="sidebar-item">
                                             <img src="{{asset(env('APP_FILE').'/dashboard/images/icons/topic.svg')}}">
                                             إدارة المواضيع
                                         </li>
                                     </a>

                                     <div class="small-title">
                                         <small>المستخدمين</small>
                                     </div>

                                     <a href="{{route('admin.dashboard.users')}}">
                                         <li class="sidebar-item">
                                             <img src="{{asset(env('APP_FILE').'/dashboard/images/icons/user.svg')}}">
                                             ادارة المستخدمين
                                         </li>
                                     </a>
                                     <div class="small-title">
                                         <small>احصائيات المنتدي </small>
                                     </div>

                                     <a href="{{route('admin.dashboard.index')}}">
                                         <li class="sidebar-item">
                                             <img src="{{asset(env('APP_FILE').'/dashboard/images/icons/analytics.svg')}}">
                                             الاحصائيات
                                         </li>
                                     </a>


                                     <div class="small-title">
                                         <small>الإبلاغات</small>
                                     </div>

                                     <a href="{{route('admin.dashboard.index')}}">
                                         <li class="sidebar-item">
                                             <img src="{{asset(env('APP_FILE').'/dashboard/images/icons/report.svg')}}">
                                             جميع الإبلاغات
                                         </li>
                                     </a>

                                 </ul>
                             </div>
                        </div>
                    </div>
                </div>

            @show





            @yield('content')
        </div>
    </div>
</div>

<!-- JS Files   -->
@stack('script')
</body>
</html>
