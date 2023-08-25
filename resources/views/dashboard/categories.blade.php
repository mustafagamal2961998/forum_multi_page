@extends('../dashboard/layout/header')

@push('style')
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/dashboard/css/categories.css')}}">
@endpush

@section('title','إدارة العناوين')

@section('content')

    <section class="categories-content-container">
        <div class="categories-content-content">
            <div class="categories-content">


                    {{--head--}}
                   <div class="head-msg-container">
                       <div class="head-msg-content">
                           <div class="head-msg">

                               @if(session()->has('success'))
                                   <div class="alert alert-success" role="alert">
                                       تم إضافة القسم بنجاح
                                   </div>
                               @endif

                               @if(session()->has('update'))
                                   <div class="alert alert-success" role="alert">
                                       تم تعديل القسم بنجاح
                                   </div>
                               @endif




                               @error('edit_cat_name')
                                   <div class="alert alert-danger" role="alert">
                                       {{$message}}
                                   </div>
                               @enderror
                               @error('edit_cat_description')
                               <div class="alert alert-danger" role="alert">
                                   {{$message}}
                               </div>
                               @enderror
                               @error('edit_title')
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

                  {{--body--}}


                <div class="categories-list">
                    <div class="add-category">
                        <button class="btn btn-info add-category-btn">
                            <i class="ri-file-add-line"></i> إضافة قسم
                        </button>
                    </div>
                    <table class="table titles">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">أسم العنوان</th>
                                <th scope="col">عدد المواضيع</th>
                                <th scope="col">العنوان</th>
                                <th scope="col">تاريخ الانشاء</th>
                                <th scope="col">الحالة </th>
                                <th scope="col">اداره</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($AllCategories as $Categories)
                            <tr>
                                <td>
                                    {{$Categories->name}}
                                </td>
                                <td>
                                    {{$Categories->topics->count()}}
                                </td>

                                <td>
                                    {{$Categories->title->title_name}}
                                </td>
                                <td>
                                    {{Carbon\Carbon::parse($Categories->created_at)->translatedFormat('d / M / Y')}}
                                </td>

                                <td>
                                    @if($Categories->status =='active')
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
                                   <div class="edit-form-container" data-id="{{$Categories->id}}">
                                        <div class="edit-form-content">
                                            <div class="edit-form">
                                                <p>
                                                    تعديل العنوان
                                                    <div class="close-edit-category-box" data-id="{{$Categories->id}}">
                                                        <i class="ri-close-circle-line"></i>
                                                    </div>
                                                </p>
                                                <form action="{{route('admin.dashboard.update.category',$Categories->id)}}" method="POST">
                                                    @csrf

                                                    <div class="input-style">
                                                        <input type="text" name="edit_cat_name"  class="form-control @error('edit_cat_name') error @enderror "  value="{{$Categories->name}}" placeholder="أسم العنوان">
                                                    </div>


                                                    <div class="input-style">
                                                        <select class="form-control" name="edit_title">
                                                            @foreach($AlTitles as $Title)
                                                                <option value="{{$Title->id}}" @if($Categories->title->id == $Title->id) selected @endif>{{$Title->title_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>


                                                    <div class="input-style">
                                                        <textarea name="edit_cat_description" class="form-control">{{$Categories->description}}</textarea>
                                                    </div>



                                                    <div class="input-style">

                                                        <div class="status-title">
                                                            <i class="ri-bar-chart-grouped-line"></i> الحالة
                                                        </div>

                                                        <div class="switch-field">
                                                            <input type="radio" id="edit-radio-one[{{$Categories->id}}]" name="edit_status" value="active" @if($Categories->status =='active') checked @endif />
                                                            <label for="edit-radio-one[{{$Categories->id}}]" class="@error('edit_status') error @enderror" >مفعل</label>

                                                            <input type="radio" id="edit-radio-two[{{$Categories->id}}]" name="edit_status" value="archive"  @if($Categories->status =='archive') checked @endif />
                                                            <label for="edit-radio-two[{{$Categories->id}}]" class="@error('edit_status') error @enderror" >غير مفعل</label>
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
                                   <button class="btn btn-primary edit-category-btn" data-id="{{$Categories->id}}">
                                       <i class="ri-edit-box-line"></i>
                                   </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $AllCategories->links() }}
                </div>



                <div class="add-title-container"  @error('title') style="display: block" @enderror @error('cat_name') style="display: block" @enderror>
                    <div class="add-title-content">

                        <div class="add-title" @error('title')  style="opacity: 1" @enderror @error('cat_name') style="opacity: 1" @enderror   @error('status') style="opacity: 1" @enderror >
                            <p>إضافة قسم
                                <div class="close-add-category-box">
                                <i class="ri-close-circle-line"></i>
                                </div>
                            </p>
                            <form action="{{route('admin.dashboard.add.category')}}" method="POST">

                                @csrf
                                <div class="input-style">
                                    @error('cat_name')
                                    <span>{{$message}}</span>
                                    @enderror
                                    <input type="text" name="cat_name"  class="form-control @error('cat_name') error @enderror" placeholder="أسم العنوان">
                                </div>
                                <div class="input-style">
                                    @error('title')
                                    <span>{{$message}}</span>
                                    @enderror
                                    <select class="form-control @error('title') error @enderror" name="title">
                                        @foreach($AlTitles as $Title)
                                            <option value="{{$Title->id}}">{{$Title->title_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-style">
                                    @error('cat_description')
                                    <span>{{$message}}</span>
                                    @enderror
                                    <textarea name="cat_description" class="form-control  @error('cat_description') error @enderror"></textarea>
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

            $('.edit-category-btn').click(function (){
                $('.edit-form-container[data-id='+$(this).attr("data-id")+']').toggle();
                const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                audio.play();
            });

            $('.close-edit-category-box').click(function (){
                const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                audio.play();
                $('.edit-form-container[data-id='+$(this).attr("data-id")+']').toggle();

            });





            // create form

            $('.close-add-category-box').click(function (){
                const audio = new Audio("{{asset(env('APP_FILE').'/dashboard/sounds/add-notification.mp3')}}");
                audio.play();
                $('.add-title-container').toggle();
            });

            $('.add-category-btn').click(function (){
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

