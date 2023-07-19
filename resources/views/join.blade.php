@extends('layout/header')
@push('styles')

    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/style/home.css')}}">
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/style/join.css')}}">

@endpush
@section('title', env('APP_NAME') . "تسجيل عضويه جديده" )

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
                    <a href="">
                        تسجيل عضويه جديده
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

            {{-- START JOIN FORM --}}
                <div class="join-form-container">
                    <div class="join-form-content">
                        <div class="join-form-title">
                            <h5>لا تنسي قراءة القوانين قبل التسجيل </h5>
                        </div>
                        <div class="join-form">
                                <form action="{{route('join')}}" method="POST">
                                    @csrf
                                    @if (Session::has('Join_success'))
                                       <div class="join-success-msg">
                                               <div class="alert alert-info">{{ Session::get('Join_success') }}</div>
                                       </div>
                                    @endif
                                    <div class="join-input-email">
                                        @error('join_email')
                                        <div class="join-error-list-content">
                                            <div class="join-error-list">
                                                @foreach($errors->get('join_email') as $error)
                                                    <p>{{$error}}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                        @enderror
                                        <p class="note">
                                            بريدك الالكتروني مهم جدا وهذا البريد سوف نراسلك عليه
                                        </p>
                                        <p><label for="email">البريد الالكتروني</label></p>
                                        <input type="email" id="email" name="join_email" value="{{old('join_email')}}">
                                    </div>

                                    <div class="join-input-name">

                                        <p class="note">
                                            هذا الاسم سوف يظهر في جميع مشاركاتك
                                        </p>
                                        @error('name')
                                        <div class="join-error-list-content">
                                            <div class="join-error-list">
                                                @foreach($errors->get('name') as $error)
                                                    <p>{{$error}}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                        @enderror
                                        <p><label for="name">الاسم</label></p>
                                        <input type="text" id="name" name="name" value="{{old('name')}}">
                                    </div>

                                    <div class="password-inputs-content">

                                        <p class="note">
                                            كلمة المرور محميه ومشفره ولايمكن لاي احد الاطلاع عليها
                                            <br>
                                            لا تشارك كلمة المرور معا اي شخص
                                        </p>

                                        <div class="password-inputs">
                                            <div class="join-input-password">
                                                @error('join_password')
                                                <div class="join-error-list-content">
                                                    <div class="join-error-list">
                                                        @foreach($errors->get('join_password') as $error)
                                                            <p>{{$error}}</p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @enderror
                                                <p><label for="password"> كلمة المرور : </label></p>
                                                <input type="password" id="password" name="join_password">
                                            </div>
                                            <div class="join-input-confirm-password">
                                                @error('password_confirmation')
                                                <div class="join-error-list-content">
                                                    <div class="join-error-list">
                                                        @foreach($errors->get('password_confirmation') as $error)
                                                            <p>{{$error}}</p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @enderror
                                                <p> <label for="confirm_password"> إعادة كتابة كلمة المرور : </label></p>
                                                <input type="password" id="confirm_password" name="password_confirmation">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="join-input-signatures">

                                        <p class="note">
                                           هذا التوقيع يظهر داخل المواضيع يجب ادخاله <span style="color:red;">بالانجليزي</span>
                                        </p>
                                        @error('signatures')
                                        <div class="join-error-list-content">
                                            <div class="join-error-list">
                                                @error('signatures')
                                                    <p>{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        @enderror
                                        <p><label for="signatures">التوقيع</label></p>
                                        <input type="text" id="signatures" name="signatures" value="{{old('signatures')}}">
                                    </div>

                                    <div class="join-input-signatures-font-family">

                                        <p class="note">
                                            اختار شكل خط التوقيع الخاص بك
                                        </p>
                                        @error('signatures_font_family')
                                        <div class="join-error-list-content">
                                            <div class="join-error-list">
                                                @foreach($errors->get('signatures_font_family') as $error)
                                                    <p>{{$error}}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                        @enderror
                                        <select name="signatures_font_family">
                                            @foreach($fonts as $font)
                                                <option style="font-family: {{$font->name}};" @if(old('signatures_font_family') == $font->name)  selected @endif value="{{$font->name}}">{{$font->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="join-input-signatures-text_color">

                                        <p class="note">
                                            اختار لون التوقيع الخاص بك
                                        </p>
                                        @error('signatures_text_color')
                                        <div class="join-error-list-content">
                                            <div class="join-error-list">
                                                @foreach($errors->get('signatures_text_color') as $error)
                                                    <p>{{$error}}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                        @enderror
                                        <p><label for="signatures_text_color">لون التوقيع</label></p>
                                        <input type="color" id="signatures_text_color" name="signatures_text_color"  value="{{old('signatures_text_color')}}">
                                    </div>




                                    <div class="join-roles">
                                            @error('role')
                                            <div class="join-error-list-content">
                                                <div class="join-error-list">
                                                    @foreach($errors->get('role') as $error)
                                                        <p>{{$error}}</p>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @enderror
                                            <input type="checkbox" id="role" name="role">
                                            <label for="role">أوافق علي الشروط والاحكام</label>
                                            <a href="">الشروط والاحكام</a>
                                        </div>

                                    <div class="join-input-btn">
                                       <button type="submit" name="join">سجل الأن</button>
                                    </div>

                                </form>
                        </div>
                    </div>
                </div>
            {{-- END JOIN FORM --}}


            </div>
        </div>
    </div>


@endsection



@push('scripts')

@endpush

<style>
    .join-form-container{
        width: 100%;
    }
    .join-form-container .join-form-content{
        width: 100%;
        border-right:1px solid #1b70b1;
        border-left:1px solid #1b70b1;
        border-bottom:1px solid #1b70b1;
        border-radius: 5px;
    }
    .join-form-container .join-form-content .join-form-title{
        width: 100%;
        background: linear-gradient(to left, #328bc1, #77c8fe);
        padding: 5px 10px;
    }
    .join-form-container .join-form-content .join-form-title h5{
        color: #FFFFFF;
    }
    .join-form-container .join-form-content .join-form{
        width: 100%;
    }
    .join-form-container .join-form-content .join-form form{
        width: 100%;
        padding: 10px 20px;
    }
    .join-form-container .join-form-content .join-form form .join-success-msg{
        width: 100%;
        text-align: center;
        padding: 10px;
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
    .join-form-container .join-form-content .join-form form .join-input-email{
        width: 100%;
    }
    .join-form-container .join-form-content .join-form form .join-input-email label{
        margin: 5px 0;
    }
    .join-form-container .join-form-content .join-form form input{
        padding: 2px 10px;
        font-size: 17px;
        font-weight: 500;
        outline: none;
        border: 1px solid #1b70b1;
        border-radius: 5px;
        font-family: system-ui;
    }
    .join-form-container .join-form-content .join-form form .password-inputs-content{
        width: 100%;
        margin: 10px 0;
    }
    .join-form-container .join-form-content .join-form form  .note{
        font-size: 13px;
        margin: 10px 0;
    }
    .join-form-container .join-form-content .join-form form .password-inputs-content .password-inputs{
        display: flex;
    }

    .join-form-container .join-form-content .join-form form .password-inputs-content .join-input-confirm-password{
        margin: 0 10px;
    }
    .join-form-container .join-form-content .join-form form .join-roles{
          margin: 10px 0;
    }
    .join-form-container .join-form-content .join-form form .join-input-btn{
        width: 100%;
        text-align: center;
        margin: 10px 0;
    }
    .join-form-container .join-form-content .join-form form .join-input-btn button{
        padding: 0 20px 5px 20px;
        height: 38px;
        background: #1b70b1;
        border: 1px solid #1b70b1;
        border-radius: 5px;
        font-weight: 500;
        font-size: 17px;
        color: #FFFFFF;
        font-family: system-ui;
        cursor: pointer;
    }
    .join-form-container .join-form-content .join-form form .join-input-btn button:hover{
        transition: 0.5s all;
        background-color: #105081;
        border: 1px solid #FFFFFF;
        color: #ffffff;
    }
    .join-form-container .join-form-content .join-form form .join-error-list-content{
        padding: 10px;
    }
    .join-form-container .join-form-content .join-form form .join-error-list-content .join-error-list{
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        padding: 0 20px;
    }
    .join-form-container .join-form-content .join-form form .join-input-signatures-font-family{
        width: 100%;
    }
    .join-form-container .join-form-content .join-form form .join-input-signatures-font-family select{
        padding: 2px 10px;
        font-size: 17px;
        font-weight: 500;
        outline: none;
        border: 1px solid #1b70b1;
        border-radius: 5px;
        font-family: system-ui;
    }


/* START RESPONSIVE */
    @media only screen and  (max-width:531px){
        .join-form-container .join-form-content .join-form form .password-inputs-content .password-inputs{
            display: block;
        }
        .join-form-container .join-form-content .join-form form .password-inputs-content .join-input-confirm-password{
            margin: 0;
        }
    }
/* END RESPONSIVE */
</style>
