<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <link rel="stylesheet" href="https://cdn.usebootstrap.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.4.0/remixicon.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/dashboard/css/login.css')}}">

    <title>تسجيل الدخول</title>
</head>
    <body>

        <div class="login-container">
            <div class="login-content">

                <div class="login">


                    <div class="login-box form">
                        <div>
                            <img src="{{asset(env('APP_FILE').'/dashboard/images/login_icon.svg')}}" alt="Login Icon">
                        </div>
                        <h4>تسجيل الدخول</h4>
                        <form action="{{route('admin.login')}}" method="POST">
                            @csrf

                            @if(session()->has('LoginError'))
                            <div class="alert alert-danger">
                                خطاء في كلمة المرور او البريد الالكتروني
                            </div>
                            @endif
                            <div class="input-style">
                                @error('email')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                                <input type="text" name="email" class="form-control"  value="{{old('email')}}"placeholder="البريد الالكتروني">
                            </div>
                            <div class="input-style">
                                @error('password')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                                <input type="password" class="form-control" name="password" value="{{old('password')}}" placeholder="كلمة السر">
                            </div>
                            <div class="input-style">
                                <button type="submit" class="btn btn-dark">
                                    <i class="ri-login-box-line"></i>
                                    تسجيل الدخول
                                </button>
                            </div>
                        </form>
                    </div>






                    <div class="login-box slide" id="slide">

                    </div>




                </div>

            </div>
        </div>
    <script>

        //Initializing
        var i = 0;
        var images = []; //array
        var time = 1500; // time in millie seconds

        //images

        images[0] = 'url(public/dashboard/images/slide/0.jpg)';
        images[1] = 'url(public/dashboard/images/slide/2.jpg)';
        images[2] = 'url(public/dashboard/images/slide/3.jpg)';
        images[3] = 'url(public/dashboard/images/slide/3.jpg)';

        //function

        function changeImage() {
            var el = document.getElementById('slide');

            el.style.backgroundImage = images[i];
            if (i < images.length - 1) {
                i++;
            } else {
                i = 0;
            }
            setTimeout('changeImage()', time);
        }

        window.onload = changeImage;



    </script>
    </body>
</html>
