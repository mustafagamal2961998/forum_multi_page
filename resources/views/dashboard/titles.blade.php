@extends('../dashboard/layout/header')

@push('style')
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/dashboard/css/titles.css')}}">
@endpush

@section('title','إدارة العناوين')

@section('content')

    <section class="titles-content-container">
        <div class="titles-content-content">
            <div class="titles-content">


                 {{--head--}}
                   <div class="head-msg-container">
                       <div class="head-msg-content">
                           <div class="head-msg">

                               @if(session()->has('success'))
                                   <div class="alert alert-success" role="alert">
                                       تم الاضافة بنجاح
                                   </div>
                               @endif

                               @if(session()->has('update'))
                                   <div class="alert alert-success" role="alert">
                                       تم التعديل بنجاح
                                   </div>
                               @endif

                               @error('edit_title_name')
                                   <div class="alert alert-danger" role="alert">
                                       {{$message}}
                                   </div>
                               @enderror
                               @error('edit_status')
                                   <div class="alert alert-danger" role="alert">
                                       {{$message}}
                                   </div>
                               @enderror
                           </div>
                       </div>
                   </div>



                {{-- body --}}


                <div class="titles-list">
                    <div class="add-title">
                        <button class="btn btn-info add-title-btn">
                            <i class="ri-file-add-line"></i> إضافة عنوان
                        </button>
                    </div>
                    <table class="table titles">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">أسم العنوان</th>
                                <th scope="col">عدد الاقسام</th>
                                <th scope="col"> اجمالي عدد المواضيع</th>
                                <th scope="col">تاريخ الانشاء</th>
                                <th scope="col">الحالة </th>

                                <th scope="col">اداره</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($AllTitles as $Titles)
                            <tr>
                                <td>
                                    {{$Titles->title_name}}
                                </td>
                                <td>
                                    {{$Titles->categories->count()}}
                                </td>

                                <td>
                                    @foreach($Titles->categories as $TitleTopics)
                                            {{$TitleTopics->topics->count()}}
                                    @endforeach
                                </td>

                                <td>
                                    {{Carbon\Carbon::parse($Titles->created_at)->translatedFormat('d / M / Y')}}
                                </td>

                                <td>
                                    @if($Titles->status =='active')
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
                                   <div class="edit-form-container" data-id="{{$Titles->id}}">
                                        <div class="edit-form-content">
                                            <div class="edit-form">
                                                <p>
                                                    تعديل العنوان
                                                    <div class="close-edit-title-box" data-id="{{$Titles->id}}">
                                                        <i class="ri-close-circle-line"></i>
                                                    </div>
                                                </p>
                                                <form action="{{route('admin.dashboard.titles.update',$Titles->id)}}" method="POST">
                                                    @csrf
                                                    <div class="input-style">
                                                        <input type="text" name="edit_title_name"  class="form-control @error('edit_title_name') error @enderror "  value="{{$Titles->title_name}}" placeholder="أسم العنوان">
                                                    </div>
                                                    <div class="input-style">

                                                        <div class="status-title">
                                                            <i class="ri-bar-chart-grouped-line"></i> الحالة
                                                        </div>

                                                        <div class="switch-field">
                                                            <input type="radio" id="edit-radio-one[{{$Titles->id}}]" name="edit_status" value="active" @if($Titles->status =='active') checked @endif />
                                                            <label for="edit-radio-one[{{$Titles->id}}]" class="@error('edit_status') error @enderror" >مفعل</label>

                                                            <input type="radio" id="edit-radio-two[{{$Titles->id}}]" name="edit_status" value="archive"  @if($Titles->status =='archive') checked @endif />
                                                            <label for="edit-radio-two[{{$Titles->id}}]" class="@error('edit_status') error @enderror" >غير مفعل</label>
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
                                    </div>
                                   <button class="btn btn-primary edit-title-btn" data-id="{{$Titles->id}}">
                                       <i class="ri-edit-box-line"></i>
                                   </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $AllTitles->links() }}
                </div>



                <div class="add-title-container" @error('title_name') style="display: block" @enderror>
                    <div class="add-title-content">

                        <div class="add-title"  @error('title_name') style="opacity: 1" @enderror   @error('status') style="opacity: 1" @enderror >
                            <p>إضافة عنوان
                                <div class="close-add-title-box">
                                <i class="ri-close-circle-line"></i>
                                </div>
                            </p>
                            <form action="{{route('admin.dashboard.add.titles')}}" method="POST">

                                @csrf
                                <div class="input-style">
                                    @error('title_name')
                                    <span>{{$message}}</span>
                                    @enderror
                                    <input type="text" name="title_name"  class="form-control @error('title_name') error @enderror " placeholder="أسم العنوان">
                                </div>
                                <div class="input-style">
                                    @error('status')
                                    <span>{{$message}}</span>
                                    @enderror
                                    <div class="status-title">
                                         <i class="ri-bar-chart-grouped-line"></i> الحالة
                                    </div>

                                    <div class="switch-field">
                                        <input type="radio" id="radio-one" name="status" value="active" checked />
                                        <label for="radio-one" class="@error('status') error @enderror" >مفعل</label>
                                        <input type="radio" id="radio-two" name="status" value="archive" />
                                        <label for="radio-two" class="@error('status') error @enderror" >غير مفعل</label>
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
            $('.edit-title-btn').click(function (){
                $('.edit-form-container[data-id='+$(this).attr("data-id")+']').toggle();
                const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                audio.play();
            });

            $('.close-edit-title-box').click(function (){
                const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                audio.play();
                $('.edit-form-container[data-id='+$(this).attr("data-id")+']').toggle();

            });



            // create form

            $('.close-add-title-box').click(function (){
                const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                audio.play();
                $('.add-title-container').toggle();
            });

            $('.add-title-btn').click(function (){
                    const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                    audio.play();

                    $('.add-title-container').toggle(
                        function(){
                            $('.add-title').animate({
                                opacity:1
                            },200);
                        },
                    );
                });

            });


    </script>
@endpush

