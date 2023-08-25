@extends('../dashboard/layout/header')

@push('style')
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/dashboard/css/index.css')}}">
@endpush

@section('title','الرئيسية')

@section('content')

    <section class="index-content-container">
        <div class="index-content-content">
            <div class="index-content">


                <div class="forms-error-msg-content">
                        <div class="forms-error-msg">
                            @error('edit_rank_name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                            @error('edit_rank_bg_color')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror

                            @error('edit_rank_text_color')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                            @error('edit_rank_font_weight')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                            @error('edit_rank_icon')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror

                        </div>
                    </div>

                <div class="forms-success-msg-content">
                    <div class="forms-success-msg">


                       {{--  Font Msg--}}
                        @if(session()->has('FontSuccess'))
                            <div class="alert alert-success" role="alert">
                                تم إضافة الخط بنجاح
                            </div>
                        @endif
                        @if(session()->has('FontDeleteError'))
                            <div class="alert alert-success" role="alert">
                                عفوا الخط غير موجود
                            </div>
                        @endif
                        @if(session()->has('FontDeleteSuccess'))
                            <div class="alert alert-success" role="alert">
                                تم حذف الخط بنجاح
                            </div>
                        @endif



                        {{-- Rank Msg--}}
                        @if(session()->has('RankSuccess'))
                            <div class="alert alert-success" role="alert">
                                تم إضافة الرتبة بنجاح
                            </div>
                        @endif
                        @if(session()->has('RankDeleteError'))
                            <div class="alert alert-success" role="alert">
                                عفوا الرتبة غير موجوده
                            </div>
                        @endif
                        @if(session()->has('RankDeleteSuccess'))
                            <div class="alert alert-success" role="alert">
                                تم حذف الرتبة بنجاح
                            </div>
                        @endif

                        @if(session()->has('RankUpdateSuccess'))
                            <div class="alert alert-success" role="alert">
                                تم تعديل الرتبة بنجاح
                            </div>
                        @endif
                        @if(session()->has('RankUpdateError'))
                            <div class="alert alert-success" role="alert">
                                عفوا الرتبة غير موجوده
                            </div>
                        @endif



                    </div>
                </div>


                {{-- head --}}
                <div class="index-head">
                    <div class="index-head-list">
                        <ul class="index-head-list-items">
                            <a href="">
                                <li class="index-head-item users">
                                    <div class="icon">
                                        <img src="{{asset(env('APP_FILE').'/dashboard/images/icons/users.svg')}}">
                                    </div>
                                    <div class="data-info">
                                        <h3>المستخدمين</h3>
                                        <p>{{$AllUsers->count()}}</p>
                                    </div>
                                </li>
                            </a>

                            <a href="">
                                <li class="index-head-item titles">
                                    <div class="icon">
                                        <img src="{{asset(env('APP_FILE').'/dashboard/images/icons/title.svg')}}">
                                    </div>
                                    <div class="data-info">
                                        <h3>العناوين</h3>
                                        <p>{{$AllTitles->count()}}</p>
                                    </div>
                                </li>
                            </a>

                            <a href="">
                                <li class="index-head-item categories">
                                    <div class="icon">
                                        <img src="{{asset(env('APP_FILE').'/dashboard/images/icons/category.svg')}}">

                                    </div>
                                    <div class="data-info">
                                        <h3>الاقسام</h3>
                                        <p>{{$AllCategories->count()}}</p>
                                    </div>
                                </li>
                            </a>

                            <a href="">
                                <li class="index-head-item topics">
                                    <div class="icon">
                                        <img src="{{asset(env('APP_FILE').'/dashboard/images/icons/topic.svg')}}">

                                    </div>
                                    <div class="data-info">
                                        <h3>المواضيع</h3>
                                        <p>{{$AllTopics->count()}}</p>
                                    </div>
                                </li>
                            </a>

                        </ul>
                    </div>
                </div>











                {{-- body --}}
                <div class="index-body">

                    <div class="index-body-list">


                        <div class="index-body-ads-list">
                            <div class="index-body-ads-head">
                                <a href=""  class="btn btn-info">
                                    إدارة  الإعلانات
                                </a>
                                <p>الاعلانات الحالية</p>

                            </div>
                            <div class="index-body-ads">

                                <div class="index-body-ad">
                                  <a href="">
                                      <img src="https://cdn.discordapp.com/attachments/487985654945415178/1064497090828439652/dragon-new-text.gif">
                                  </a>
                               </div>

                                <div class="index-body-ad">
                                    <a href="">
                                        <img src="https://cdn.discordapp.com/attachments/487985654945415178/1064497090828439652/dragon-new-text.gif">
                                    </a>
                                </div>

                                <div class="index-body-ad">
                                    <a href="">
                                        <img src="https://cdn.discordapp.com/attachments/487985654945415178/1064497090828439652/dragon-new-text.gif">
                                    </a>
                                </div>

                                <div class="index-body-ad">
                                    <a href="">
                                        <img src="https://cdn.discordapp.com/attachments/487985654945415178/1064497090828439652/dragon-new-text.gif">
                                    </a>
                                </div>

                            </div>
                        </div>


                        <ul class="index-body-list-items">
                            <li class="index-body-item">
                                <div class="index-body-item-head">
                                    <h6>اخر 5 مستخدمين</h6>
                                </div>


                                <table class="table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">رقم المعرف</th>
                                        <th scope="col">الاسم</th>
                                        <th scope="col">البلد</th>
                                        <th scope="col">رقم العنوان</th>

                                        <th scope="col">الحالة</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @foreach($LastUsers as $Users)
                                        <tr>
                                            <td>{{$Users->id}}</td>
                                            <td>
                                                <img src="{{asset(env('APP_FILE').$Users->avatar)}}">
                                                {{$Users->name}}
                                            </td>
                                            <td>{{$Users->country}}</td>
                                            <td>{{$Users->ip}}</td>

                                            <td>
                                                @if($Users->status =='active')
                                                    <span class="active">
                                                    <i class="ri-signal-wifi-line"></i> مفعل
                                                    </span>
                                                @else
                                                    <span class="archive">
                                                        <i class="ri-signal-wifi-off-line"></i>  غير مفعل

                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </li>
                            <li class="index-body-item">
                                <div class="index-body-item-head">
                                    <h6>اخر 5 تعليقات</h6>
                                </div>

                                <table class="table last-comments">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">رقم المعرف</th>
                                        <th scope="col">الاسم</th>
                                        <th scope="col">البلد</th>
                                        <th scope="col">محتوي التعليق</th>
                                        <th scope="col">الوقت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($LastComments as $Comment)
                                        <tr>

                                            <td>{{$Comment->user->id}}</td>
                                            <td>
                                                <img src="{{asset(env('APP_FILE').$Comment->user->avatar)}}">
                                                {{$Comment->user->name}}
                                            </td>
                                            <td>{{$Comment->user->country}}</td>
                                            <td  class="show-comment-content" data-id="{{$Comment->id}}">
                                                <i class="ri-eye-line"></i>

                                                <div class="comment-content-hidden" data-id="{{$Comment->id}}">
                                                    <div class="comment-content-style">
                                                        <div class="comment-content">
                                                            {!! $Comment->content !!}
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>
                                                {{Carbon\Carbon::parse($Comment->created_at)->format('d / m ')}}</small>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </li>
                        </ul>




                        <ul class="index-body-list-items">
                          <li class="index-body-item">

                              <div class="add-rank-form-content" @error('rank_name') style="display: block;" @enderror @error('rank_icon') style="display: block;" @enderror>
                                  <div class="add-rank-form">
                                      <form action="{{route('admin.dashboard.add_rank')}}" method="POST" enctype="multipart/form-data">
                                          @csrf
                                          <p>إضافة رتبة </p>
                                          <div class="close-rank-box">
                                              <i class="ri-close-circle-line"></i>
                                          </div>

                                          <div class="input-style">
                                              @error('rank_name')
                                                  <div class="alert alert-danger" role="alert">
                                                         {{$message}}
                                                  </div>
                                              @enderror
                                              <label for="rank_name">أسم الرتبة</label>
                                              <input type="text" id="rank_name" name="rank_name" class="form-control"  value="{{old('rank_name')}}">
                                          </div>

                                          <div class="input-style">
                                              @error('rank_bg_color')
                                                  <div class="alert alert-danger" role="alert">
                                                      {{$message}}
                                                  </div>
                                              @enderror
                                              <label for="rank_bg_color">لون الخلفية</label>
                                              <input type="color" name="rank_bg_color" id="rank_bg_color" class="form-control" value="{{old('rank_bg_color')}}">
                                          </div>

                                          <div class="input-style">
                                              @error('rank_text_color')
                                                  <div class="alert alert-danger" role="alert">
                                                      {{$message}}
                                                  </div>
                                              @enderror
                                              <label for="rank_text_color">لون النص </label>

                                              <input type="color" name="rank_text_color" id="rank_text_color" class="form-control" value="{{old('rank_text_color')}}">
                                          </div>

                                          <div class="input-style">
                                              @error('rank_font_weight')
                                              <div class="alert alert-danger" role="alert">
                                                  {{$message}}
                                              </div>
                                              @enderror
                                              <label for="rank_font_weight">نوع الخط</label>
                                              <select name="rank_font_weight" id="rank_font_weight" class="form-control">
                                                  <option value="bold" @if(old('rank_font_weight')=='bold')  selected @endif>bold</option>
                                                  <option value="lighter" @if(old('rank_font_weight')=='lighter')  selected @endif>lighter</option>
                                                  <option value="normal" @if(old('rank_font_weight')=='normal')  selected @endif>normal</option>
                                              </select>
                                          </div>






                                          <div class="input-style">
                                              @error('rank_icon')
                                                  <div class="alert alert-danger" role="alert">
                                                      {{$message}}
                                                  </div>
                                              @enderror

                                              <div class="file-input">
                                                 <input type="file"  id="file-rank_icon" class="file-input__input" name="rank_icon" accept=".svg">
                                                  <label class="file-input__label" for="file-rank_icon">
                                                      <i class="ri-upload-line"></i>
                                                      <span>اختيار الملف</span>
                                                  </label>
                                              </div>
                                          </div>

                                          <div class="input-style">
                                              <button type="submit" class="btn btn-success">
                                                  <i class="ri-file-add-line"></i>
                                                  إضافة
                                              </button>
                                          </div>
                                      </form>
                                  </div>
                              </div>


                              <div class="add-btn-content">
                                  <div class="add-btn add-rank">
                                      <button class="btn btn-info add-rank"><i class="ri-file-add-line"></i> إضافة رتبة </button>
                                  </div>
                              </div>
                              <div class="index-body-item-head">
                                  <h6>الرتب الحالية</h6>
                              </div>


                              <table class="table ranks">
                                  <thead class="thead-light">
                                      <tr>
                                          <th scope="col">رقم المعرف</th>
                                          <th scope="col">أسم الرتبة</th>
                                          <th scope="col">الأيقون</th>
                                          <th scope="col">لون الخلفيه</th>
                                          <th scope="col">لون النص</th>
                                          <th scope="col">تاريخ الانشاء</th>
                                          <th scope="col">اداره</th>
                                      </tr>
                                  </thead>
                                  <tbody>


                                  @foreach($AllRanks as $Ranks)
                                      <tr>
                                          <td>{{$Ranks->id}}</td>
                                          <td>
                                              {{$Ranks->rank_name}}
                                          </td>
                                          <td>
                                               <img src="{{asset(env('APP_FILE').$Ranks->rank_icon)}}">
                                          </td>

                                          <td>
                                              @if($Ranks->rank_bg_color)
                                              <div style="width: 100px; height: 30px; padding: 10px; border-radius:20px;  background-color: {{$Ranks->rank_bg_color}}"></div>
                                              @else
                                                  فارغ
                                              @endif
                                          </td>
                                          <td>
                                              <div style="width: 20px; height: 20px; padding: 2px; border-radius: 2px; box-shadow: 0 0 10px #a2a2a2; background-color: {{$Ranks->rank_text_color}}"></div>
                                          </td>

                                          <td>
                                              {{Carbon\Carbon::parse($Ranks->created_at)->format('d / m ')}}
                                          </td>
                                          <td class="rank-control">
                                              <button class="btn btn-primary edit-rank-btn" data-id="{{$Ranks->id}}">
                                                  <i class="ri-edit-box-line"></i>
                                              </button>

                                              <form action="{{route('admin.dashboard.delete_rank',$Ranks->id)}}" method="POST">
                                                  @csrf
                                                  <button type="submit" class="btn btn-danger">
                                                      <i class="ri-delete-bin-line"></i>
                                                  </button>
                                              </form>


                                              <div class="edit-rank-form-content" data-id="{{$Ranks->id}}">
                                                  <div class="edit-rank-form">
                                                      <form action="{{route('admin.dashboard.edit_rank',$Ranks->id)}}" method="POST" enctype="multipart/form-data">
                                                          @csrf

                                                          <p> تعديل الرتبة </p>

                                                          <div class="edit-rank-old-icon">
                                                              <img src="{{asset(env('APP_FILE').$Ranks->rank_icon)}}" alt="Edit Rank Icon">
                                                          </div>
                                                          <div class="close-edit-rank-box" data-id="{{$Ranks->id}}">
                                                              <i class="ri-close-circle-line"></i>
                                                          </div>

                                                          <div class="input-style">
                                                              <label for="edit_rank_name">أسم الرتبة</label>
                                                              <input type="text" id="edit_rank_name" name="edit_rank_name" class="form-control" value="{{$Ranks->rank_name}}">
                                                          </div>

                                                          <div class="input-style">

                                                              <label for="edit_rank_bg_color">لون الخلفية</label>
                                                              <input type="color" name="edit_rank_bg_color" id="edit_rank_bg_color" class="form-control" value="{{$Ranks->rank_bg_color}}">
                                                          </div>

                                                          <div class="input-style">

                                                              <label for="edit_rank_text_color">لون النص </label>

                                                              <input type="color" name="edit_rank_text_color" id="edit_rank_text_color" class="form-control" value="{{$Ranks->rank_text_color}}">
                                                          </div>

                                                          <div class="input-style">
                                                              <label for="edit_rank_font_weight">نوع الخط</label>
                                                              <select name="edit_rank_font_weight" id="edit_rank_font_weight" class="form-control">
                                                                  <option value="bold" @if($Ranks->rank_font_weight =='bold') selected @endif>bold</option>
                                                                  <option value="lighter" @if($Ranks->rank_font_weight =='lighter') selected @endif>lighter</option>
                                                                  <option value="normal" @if($Ranks->rank_font_weight =='normal') selected @endif >normal</option>
                                                              </select>
                                                          </div>


                                                          <div class="input-style">
                                                              <div class="file-input">
                                                                  <input type="file" value="{{$Ranks->rank_icon}}"  id="file_edit_rank_icon" class="file-input__input" name="edit_rank_icon" accept=".svg">
                                                                  <label class="file-input__label" for="file_edit_rank_icon">
                                                                      <i class="ri-upload-line"></i>
                                                                      <span>اختيار الملف </span>
                                                                  </label>
                                                              </div>

                                                          </div>



                                                          <div class="input-style">
                                                              <button type="submit" class="btn btn-primary">
                                                                  <i class="ri-save-line"></i>
                                                                  حفظ التعديلات
                                                              </button>
                                                          </div>
                                                      </form>
                                                  </div>
                                              </div>



                                          </td>
                                      </tr>
                                  @endforeach
                                  </tbody>
                              </table>
                              {{ $AllRanks->links() }}
                          </li>


                          <li class="index-body-item">

                                <div class="add-font-form-content" @error('font_file') style="display: block;" @enderror>
                                    <div class="add-font-form">
                                        <form action="{{route('admin.dashboard.add_font')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <p>إضافة خط جديد </p>
                                            <div class="close-font-box">
                                                <i class="ri-close-circle-line"></i>
                                            </div>
                                            <div class="input-style">
                                                @error('font_file')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                                <div class="file-input">
                                                    <input type="file" id="file_rank_icon" class="file-input__input" name="font_file" accept=".otf,.ttf,.woff,.woff2">
                                                    <label class="file-input__label" for="file_rank_icon">
                                                        <i class="ri-upload-line"></i>
                                                        <span>اختيار الملف </span>
                                                    </label>
                                                </div>

                                            </div>
                                            <div class="input-style">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="ri-folder-add-line"></i>
                                                    إضافة
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                              <div class="add-btn-content">
                                 <div class="add-btn add-font">
                                     <button class="btn btn-info add-font"><i class="ri-file-add-line"></i>
                                         إضافة خط
                                     </button>
                                 </div>
                              </div>

                                <div class="index-body-item-head">
                                    <h6>الخطوط الحالية</h6>
                                </div>

                                <table class="table fonts">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">رقم المعرف</th>
                                            <th scope="col">أسم الخط</th>
                                            <th scope="col"> <i class="ri-font-size-2"></i>شكل الخط </th>
                                            <th scope="col">الصيغة</th>
                                            <th scope="col">تاريخ الانشاء</th>
                                            <th scope="col">اداره</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($AllFonts as $Fonts)
                                        <tr>

                                            <td>
                                                {{$Fonts->id}}
                                            </td>

                                            <td>
                                                {{$Fonts->name}}
                                            </td>

                                            <td style="font-family: {{$Fonts->name}}">{{$Fonts->name}}</td>
                                            <td>
                                                {{$Fonts->extension}}
                                            </td>
                                            <td>
                                                {{Carbon\Carbon::parse($Fonts->created_at)->format('d / m ')}}
                                            </td>

                                            <td>
                                                <form action="{{route('admin.dashboard.delete_font',$Fonts->id)}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                              {{ $AllFonts->links() }}
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.show-comment-content').click(function (){
                $('.comment-content-hidden[data-id='+$(this).attr("data-id")+']').toggle();

            });

            // create rank
            $('.add-btn.add-rank').click(function (){
                const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                audio.play();
                $('.add-rank-form-content').toggle();
            });

            $('.close-rank-box').click(function (){
                const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                audio.play();
                $('.add-rank-form-content').toggle();

            });

            // edit rank
            $('.edit-rank-btn').click(function (){
                const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                audio.play();
                $('.edit-rank-form-content[data-id='+$(this).attr("data-id")+']').toggle();
            });

            $('.close-edit-rank-box').click(function (){
                const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                audio.play();
                $('.edit-rank-form-content[data-id='+$(this).attr("data-id")+']').toggle();

            });










            // create font
            $('.add-btn.add-font').click(function (){
                const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                audio.play();
                $('.add-font-form-content').toggle();
            });

            $('.close-font-box').click(function (){
                const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                audio.play();
                $('.add-font-form-content').toggle();

            });


        });


    </script>
@endpush

