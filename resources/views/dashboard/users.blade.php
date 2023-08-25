@extends('../dashboard/layout/header')

@push('style')
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/dashboard/css/users.css')}}">
@endpush

@section('title','إدارة المستخدمين')

@section('content')

    <section class="users-content-container">
        <div class="users-content-content">
            <div class="users-content">


                {{--head--}}
                <div class="form-msg-content">
                    <div class="dorm-msg">

                        @if(session()->has('update'))
                            <div class="alert alert-success" role="alert">
                                تم تعديل المستخدم بنجاح
                            </div>
                        @endif


                        @error('edit_name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                        @error('edit_email')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                        @error('edit_rank')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                        @error('status')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror

                    </div>
                </div>

                {{--body--}}
                <div class="users-body">
                    <div class="active-users">

                        <table class="table titles">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">أسم المستخدم</th>
                                <th scope="col">البريد الالكتروني</th>
                                <th scope="col">رقم العنوان	</th>
                                <th scope="col">البلد</th>
                                <th scope="col">نظام التشغيل</th>
                                <th scope="col"> الرتبه </th>
                                <th scope="col">الحالة </th>
                                <th scope="col">اداره</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($AllUsers as $Users)
                                <tr>
                                    <td>{{$Users->name}}</td>
                                    <td>{{$Users->email}}</td>
                                    <td>{{$Users->ip}}</td>
                                    <td>{{$Users->country}}</td>
                                    <td>
                                        @php
                                            $os = \Illuminate\Support\Str::limit($Users->os,3,'');
                                        @endphp
                                        @if($os == 'Win')
                                            <img class="os-icon" src="{{asset(env('APP_FILE').'/dashboard/images/os_icon/windows.svg')}}" alt="OS Icon">
                                        @elseif($os == 'Mac')
                                            <img class="os-icon" src="{{asset(env('APP_FILE').'/dashboard/images/os_icon/mac.svg')}}" alt="OS Icon">
                                        @elseif($os == 'Lin')
                                            <img class="os-icon" src="{{asset(env('APP_FILE').'/dashboard/images/os_icon/linux.svg')}}" alt="OS Icon">
                                        @elseif($os == 'Ubu')
                                            <img class="os-icon" src="{{asset(env('APP_FILE').'/dashboard/images/os_icon/ubuntu.svg')}}" alt="OS Icon">
                                        @elseif($os == 'iPh' || $os == 'iPo' )
                                            <img class="os-icon" src="{{asset(env('APP_FILE').'/dashboard/images/os_icon/iphone.svg')}}" alt="OS Icon">
                                        @elseif($os == 'And')
                                            <img class="os-icon" src="{{asset(env('APP_FILE').'/dashboard/images/os_icon/android.svg')}}" alt="OS Icon">
                                        @else
                                            <img class="os-icon" src="{{asset(env('APP_FILE').'/dashboard/images/os_icon/unknow.svg')}}" alt="OS Icon">
                                        @endif
                                    </td>

                                    <td>
                                        @if($Users->rank)
                                        <img class="rank_icon" src="{{asset(env('APP_FILE').$Users->rank->rank_icon)}}" alt="User Rank Icon">
                                        {{$Users->rank->rank_name}}
                                        @endif
                                    </td>

                                    <td>
                                        @if($Users->status =='active')
                                            <span class="active">
                                                  <i class="ri-signal-wifi-line"></i>
                                                    مفعل
                                            </span>
                                        @else
                                            <span class="archive">
                                                 <i class="ri-signal-wifi-off-line"></i>
                                                  غير مفعل
                                             </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="edit-user-content" data-id="{{$Users->id}}">
                                            <div class="edit-user">
                                                    <form action="{{route('admin.dashboard.update.user',$Users->id)}}" method="POST">
                                                        @csrf
                                                        <p>تعديل بيانات المستخدم</p>

                                                        <div class="close-edit-user-box" data-id="{{$Users->id}}">
                                                            <i class="ri-close-circle-line"></i>
                                                        </div>
                                                         @if($Users->rank)
                                                            <div class="current-rank" style="background-color:{{$Users->rank->rank_bg_color}}; color: {{$Users->rank->rank_text_color}}">
                                                                <h5>
                                                                    <img src="{{asset(env('APP_FILE').$Users->rank->rank_icon)}}" alt="User Rank Icon">
                                                                    {{$Users->rank->rank_name}}
                                                                </h5>
                                                            </div>
                                                         @endif

                                                        <div class="input-style">
                                                             <label for="edit_name">أسم المستخدم</label>
                                                            <input type="text" name="edit_name" id="edit_name" class="form-control" value="{{$Users->name}}" placeholder="أسم المستخدم">
                                                        </div>
                                                        <div class="input-style">
                                                            <label for="edit_email"> البريد الالكتروني</label>
                                                            <input type="email" name="edit_email" id="edit_email" class="form-control" value="{{$Users->email}}" placeholder="البريد الالكتروني">
                                                        </div>


                                                        <div class="input-style">
                                                            <label for="edit_rank">الرتبه الحاليه</label>
                                                            <select name="edit_rank" id="edit_rank" class="form-control">
                                                                @foreach($AllRanks as $Ranks)
                                                                    <option value="{{$Ranks->id}}" @if($Users->rank_id == $Ranks->id) selected @endif>
                                                                        {{$Ranks->rank_name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                      <div class="input-style">
                                                          <div class="status-title">
                                                              <i class="ri-bar-chart-grouped-line"></i> الحالة
                                                          </div>
                                                          <div class="switch-field">
                                                              <input type="radio" id="radio_one[{{$Users->id}}]" name="status" value="active" @if($Users->status =='active') checked @endif />
                                                              <label for="radio_one[{{$Users->id}}]">
                                                                  مفعل
                                                              </label>
                                                              <input type="radio" id="radio_two[{{$Users->id}}]" name="status" value="archive" @if($Users->status =='archive') checked @endif/>
                                                              <label for="radio_two[{{$Users->id}}]">
                                                                  غير مفعل
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


                                        <button class="btn btn-primary edit-user-btn" data-id="{{$Users->id}}">
                                            <i class="ri-edit-box-line"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$AllUsers->links()}}
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
            // edit form
            $('.edit-user-btn').click(function (){
                $('.edit-user-content[data-id='+$(this).attr("data-id")+']').toggle();
                const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                audio.play();
            });

            $('.close-edit-user-box').click(function (){
                const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                audio.play();
                $('.edit-user-content[data-id='+$(this).attr("data-id")+']').toggle();
            });



        });


    </script>
@endpush

