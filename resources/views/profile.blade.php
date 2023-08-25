@extends('layout/header')
@push('meta')
    <meta name="keywords" content="منتدي الخلاصىه | الرئيسية " />
    <meta name="description" content=" منتدي الخلاصه |{{$GetUserProfileDataById->name}} الملف الشخصي " />
@endpush
@push('styles')
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/style/profile.css')}}">
@endpush
@section('title', env('APP_NAME') . $GetUserProfileDataById->name )


@section('content')


    <div class="profile-container">
        <div class="profile-content">
            <div class="profile">


                {{-- Head--}}
                <div class="profile-head-content">
                    <div class="profile-head">
                        <div class="profile-cover-content">
                            <div class="profile-cover">
                                <img src="{{asset(env('APP_FILE').$GetUserProfileDataById->cover)}}" alt="الغلاف">
                            </div>

                            <form action="{{route('update.cover',$GetUserProfileDataById->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="profile-cover-form">
                                    @if(auth()->check())
                                        @if(auth()->id() == $GetUserProfileDataById->id)
                                            <div class="input-style">
                                                <label for="cover_file">
                                                    <i class="ri-camera-line"></i>
                                                    <input type="file" id="cover_file" name="cover" accept=".jpg,.png">
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                            </div>

                            <div class="cover-preview-content">
                                    <div class="close-cover-preview">
                                        <i class="ri-close-circle-line"></i>
                                    </div>
                                    <div class="cover-preview">

                                            <img class="preview-cover-img" src="" alt="معينة الغلاف">
                                            <div class="input-style">
                                                <button type="submit">
                                                    حفظ التعديلات
                                                </button>
                                            </div>

                                    </div>
                            </div>
                            </form>

                        </div>




                        <div class="profile-avatar-content">

                            <div class="profile-avatar">
                                <img src="{{asset(env('APP_FILE').$GetUserProfileDataById->avatar)}}" alt="الغلاف">
                            </div>
                            <form action="{{route('update.avatar',$GetUserProfileDataById->id)}}" method="POST" enctype="multipart/form-data">

                                <div class="profile-avatar-form">
                                    @if(auth()->check())
                                        @if(auth()->id() == $GetUserProfileDataById->id)
                                            <div class="input-style">
                                                <label for="avatar_file">
                                                    <i class="ri-camera-line"></i>
                                                    <input type="file" id="avatar_file" name="avatar" accept=".jpg,.png,.gif">
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                </div>


                                <div class="avatar-preview-content">
                                    <div class="close-avatar-preview">
                                        <i class="ri-close-circle-line"></i>
                                    </div>
                                    <div class="avatar-preview">
                                            @csrf
                                            <img class="preview-avatar-img" src="" alt="معينة الصورة الشخصيه">
                                            <div class="input-style">
                                                <button type="submit">
                                                    حفظ التعديلات
                                                </button>
                                            </div>

                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                {{-- Body --}}
                <div class="profile-body-content">
                    <div class="profile-body">

                    <div class="info-list">
                        <ul class="info-list-items">
                            <li class="info-item">
                                <p>
                                    <i class="ri-article-line"></i> المواضيع
                                </p>
                                <b>
                                    {{$GetUserProfileDataById->topics->count()}}
                                </b>
                            </li>
                            <li class="info-item">
                                <p><i class="ri-question-answer-line"></i> المشاركات</p>
                                <b>
                                    {{$GetUserProfileDataById->comments->count()}}
                                </b>
                            </li>
                            <li class="info-item">
                                <p><i class="ri-user-follow-line"></i> الاصدقاء</p>
                                <b>
                                    0
                                </b>
                            </li>
                        </ul>
                    </div>


                    <div class="user-data-control-content">
                        <div class="user-data-control">

                            <ul class="user-data-control-list-items">
                                <h5 class="user-data-control-list-items-head-text">
                                    <a href="">
                                        <i class="ri-line-chart-line"></i>
                                        احصائيات المتسخدم
                                    </a>
                                    <i class="ri-arrow-down-s-line first-item"></i>
                                </h5>

                                <div class="first">
                                    <li class="user-data-control-item">
                                        <p class="text"><i class="ri-user-6-fill"></i> رقم العضوية</p>
                                        <p class="really-data">
                                            {{$GetUserProfileDataById->id}}
                                        </p>
                                    </li>
                                    <li class="user-data-control-item">
                                        <p class="text"><i class="ri-computer-line"></i> نظام التشغيل</p>
                                        <p class="really-data">
                                            {{$GetUserProfileDataById->os}}
                                        </p>
                                    </li>
                                    <li class="user-data-control-item">
                                        <p class="text"><i class="ri-calendar-check-line"></i> تاريخ التسجيل</p>
                                        <p class="really-data">
                                            {{Carbon\Carbon::parse($GetUserProfileDataById->created_at)->translatedFormat('d / M / Y')}}
                                        </p>
                                    </li>
                                    <li class="user-data-control-item">
                                        <p class="text"><i class="ri-pulse-line"></i> التقيم+ </p>
                                        <p class="really-data">2</p>
                                    </li>
                                </div>
                            </ul>


                        </div>
                    </div>


                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection



@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
    $(document).ready(function() {

        //hide and show user data and control

        $('.user-data-control-list-items-head-text i.first-item').click(function (){
            $('.first').toggle();
        });

        // cover preview
        $('#cover_file').change(function (){
            $('.cover-preview-content').toggle();
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.preview-cover-img').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });
        $('.close-cover-preview').click(function (){
            $('.cover-preview-content').toggle();
        });

        // avatar preview
        $('#avatar_file').change(function (){
            $('.avatar-preview-content').toggle();
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.preview-avatar-img').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });
        $('.close-avatar-preview').click(function (){
            $('.avatar-preview-content').toggle();
        });


    });


</script>
@endpush
