@extends('../dashboard/layout/header')

@push('style')
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/dashboard/css/topics.css')}}">
@endpush

@section('title','إدارة المواضيع')

@section('content')

    <section class="topics-content-container">
        <div class="topics-content-content">
            <div class="topics-content">


                    {{--head--}}
                   <div class="head-msg-container">
                       <div class="head-msg-content">
                           <div class="head-msg">

                               @if(session()->has('update'))
                                   <div class="alert alert-success" role="alert">
                                       تم تعديل الموضوع بنجاح
                                   </div>
                               @endif

                               @error('edit_topic_name')
                                   <div class="alert alert-danger" role="alert">
                                       {{$message}}
                                   </div>
                               @enderror
                               @error('edit_cat')
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
                     <a href="{{route('admin.dashboard.index')}}">
                         <button class="btn btn-info add-category-btn">
                             <i class="ri-home-line"></i> الرئيسية
                         </button>
                     </a>
                    </div>
                    <table class="table titles">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">أسم الموضوع</th>
                                <th scope="col">عدد التعليقات</th>
                                <th scope="col"> القسم </th>
                                <th scope="col">تاريخ الانشاء</th>
                                <th scope="col">الحالة </th>
                                <th scope="col">اداره</th>
                            </tr>
                        </thead>
                        <tbody>

                          @foreach($AllTopics as $Topics)
                            <tr>
                                <td>
                                    {{$Topics->title}}
                                </td>
                                <td>
                                    {{$Topics->comments->count()}}

                                </td>
                                <td>
                                    {{$Topics->category->name}}

                                </td>
                                <td>
                                    {{Carbon\Carbon::parse($Topics->created_at)->translatedFormat('d / M / Y')}}
                                </td>

                                <td>
                                    @if($Topics->status =='active')
                                        <span class="active">
                                          <i class="ri-signal-wifi-line"></i>
                                            مفعل
                                        </span>
                                    @elseif($Topics->status =='pin')
                                        <span class="pin">
                                           <i class="ri-signal-wifi-fill"></i>
                                            مثبت
                                        </span>
                                    @else
                                        <span class="archive">
                                         <i class="ri-signal-wifi-off-line"></i>
                                            غير مفعل
                                        </span>
                                    @endif
                                </td>


                                <td>
                                   <div class="edit-form-container" data-id="{{$Topics->id}}">
                                        <div class="edit-form-content">
                                            <div class="edit-form">
                                                <p>
                                                    تعديل اعدادات الموضوع
                                                    <div class="close-edit-category-box" data-id="{{$Topics->id}}">
                                                        <i class="ri-close-circle-line"></i>
                                                    </div>
                                                </p>
                                                <form action="{{route('admin.dashboard.update.topic',$Topics->id)}}" method="POST">
                                                    @csrf

                                                    <div class="input-style">
                                                        <input type="text" name="edit_topic_name"  class="form-control @error('edit_topic_name') error @enderror "  value="{{$Topics->title}}" placeholder="عنوان الموضوع">
                                                    </div>


                                                    <div class="input-style">
                                                        <select class="form-control" name="edit_cat">

                                                            @foreach($AllCategories as $Categories)
                                                                <option value="{{$Categories->id}}" @if($Categories->id == $Topics->id) selected @endif>{{$Categories->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>


                                                    <div class="input-style">

                                                        <div class="status-title">
                                                            <i class="ri-bar-chart-grouped-line"></i> الحالة
                                                        </div>

                                                        <div class="switch-field">
                                                            <input type="radio" id="edit-radio-one[{{$Topics->id}}]" name="edit_status" value="active" @if($Topics->status =='active') checked @endif />
                                                            <label for="edit-radio-one[{{$Topics->id}}]" class="@error('edit_status') error @enderror" >مفعل</label>

                                                            <input type="radio" id="edit-radio-two[{{$Topics->id}}]" name="edit_status" value="archive"  @if($Topics->status =='archive') checked @endif />
                                                            <label for="edit-radio-two[{{$Topics->id}}]" class="@error('edit_status') error @enderror" >غير مفعل</label>

                                                            <input type="radio" id="edit-radio-three[{{$Topics->id}}]" name="edit_status" value="pin"  @if($Topics->status =='pin') checked @endif />
                                                            <label for="edit-radio-three[{{$Topics->id}}]" class="@error('edit_status') error @enderror" > مثبت </label>
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
                                   <button class="btn btn-primary edit-category-btn" data-id="{{$Topics->id}}">
                                       <i class="ri-edit-box-line"></i>
                                   </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $AllTopics->links() }}
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

         });

    </script>
@endpush

