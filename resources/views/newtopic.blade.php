@extends('layout/header')
@push('styles')
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/style/home.css')}}">
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/style/newtopic.css')}}">
@endpush

@section('title', env('APP_NAME') . $GetTopicsCategoryById[0]->name . ' | موضوع جديد')

@section('direct')

    <div class="direct-container">
        <div class="direct-content">
            <div class="direct">
                <div>
                    <a href="/">
                        الرئيسية
                    </a>
                </div>
                @foreach($GetTopicsCategoryById as $Titles)
                <div>
                    <a href="/forum/{{$Titles->id}}/{{$Titles->name}}">
                        {{$Titles->name}}
                    </a>
                </div>
                <div>
                    <a href="">
                        موضوع جديد
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('content')
<div class="content-container">
    <div class="content">
        <div class="content-content">


                <form action="{{route('postNewTopic',$id)}}" method="POST">
                    @csrf

                    <div class="new-topic-top-content">

                        <div class="new-topic-top-content-header">
                            <div class="topic-title-input">
                                @error('title')
                                <div class="error-list">
                                    @foreach($errors->get('title') as $error)
                                        <p>{{$error}}</p>
                                    @endforeach
                                </div>
                                @enderror
                                <label for="topic_title" data-title="إجباري">*</label>
                                <input type="text" name="title" id="topic_title" @class(['border-error'=> $errors->has('title')]) value="{{old('title')}}" placeholder="عنوان الموضوع">
                            </div>

                            <div class="text-editor">

                                @error('topic_content')
                                <div class="error-list">
                                    @foreach($errors->get('topic_content') as $error)
                                        <p>{{$error}}</p>
                                    @endforeach
                                </div>
                                @enderror

                                <label for="editor" data-title="إجباري">*</label>
                                <textarea id="editor"  name="topic_content">{{old('topic_content')}}</textarea>
                            </div>
                        </div>



                        <div class="topic-tags-input">
                            <p class="topic-tags-input-content-title">الكلمات الدلالية (Tags) الحد الادني لعدد الاحرف 4 حروف الي 255 </p>



                            <div class="tags-input">

                                @error('tags')
                                <div class="error-list">
                                    @foreach($errors->get('tags') as $error)
                                        <p>{{$error}}</p>
                                    @endforeach
                                </div>
                                @enderror

                                <label for="tags">
                                    <p class="topic-tags-input-notices">
                                        <i class="ri-error-warning-line"></i>
                                        الكلمات الدلالية تساعد علي ايجاد الموضوع بشكل اكبر من خلال محركات البحث
                                    </p>
                                </label>

                                <textarea type="text" id="tags" name="tags">{{old('tags')}}</textarea>
                            </div>


                        </div>

                        @if(auth()->user()->signature && auth()->user()->signature_status < 2)
                            <div class="show-signature">
                                <p>عرض توقيع </p>
                                @error('signature_status')
                                <div class="error-list">
                                    @foreach($errors->get('signature_status') as $error)
                                        <div>{{$error}}</div>
                                    @endforeach
                                </div>
                                @enderror
                                <div class="check">
                                    <input type="radio" name="signature_status" id="signature" value="1" @if(old('signature_status') == 1) checked @endif>
                                    <label for="signature">في هذا الموضوع فقط </label>
                                </div>

                                <div class="check">
                                    <input type="radio" name="signature_status" id="signature_ever" value="2" @if(old('signature_status') == 2) checked @endif>
                                    <label for="signature_ever">عرض توقيعك دائما</label>
                                </div>
                            </div>
                        @endif







                            <div class="owner-email-topic-follow-container">
                                <p> الاشتراك في موضوعك </p>
                                @error('owner_follow')
                                <div class="error-list">
                                    @foreach($errors->get('owner_follow') as $error)
                                        <div>{{$error}}</div>
                                    @endforeach
                                </div>
                                @enderror
                                <div class="owner-email-topic-follow">
                                    <input type="radio" name="owner_follow" id="owner_follow_one" value="0" @if(old('owner_follow') == 0) checked @endif>   {{--Without Notification and Email--}}
                                    <label for="owner_follow_one">بدون اشعار</label>
                                </div>

                                <div class="owner-email-topic-follow">
                                    <input type="radio" name="owner_follow" id="owner_follow_tow" value="1"  @if(old('owner_follow') == 1) checked @endif> {{--Notification Without Email--}}
                                    <label for="owner_follow_tow"> اشعار بدون بريد الكتروني</label>
                                </div>

                                <div class="owner-email-topic-follow">
                                    <input type="radio" name="owner_follow" id="owner_follow_three" value="2" @if(old('owner_follow') == 2) checked @endif> {{--With Email Without EmNotificationail--}}
                                    <label for="owner_follow_three">بواسطة بريد الكتروني</label>
                                </div>
                            </div>


                        <div class="new-topic-btn-container">
                            <input type="submit" name="post" class="add-topic" value="نشر الموضوع">
                            <input type="submit" name="preview" value="معاينة الموضوع">
                        </div>

                    </div>
                </form>







        </div>
    </div>

</div>

@endsection



@push('scripts')
    <script>
        tinymce.init({
            selector: '#editor',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: ' undo redo | blocks fontfamily fontsize | codesample bold italic underline strikethrough | link image media table mergetags | spellcheckdialog a11ycheck typography align |  lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ]
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            function disableButton() {
                $(".add-topic").prop('disabled', true);
            }
            $(".add-topic").click(function () {
                setTimeout(function () { disableButton(); }, 0);
            });

        });
    </script>

@endpush

