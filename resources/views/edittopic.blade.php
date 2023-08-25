@extends('layout/header')
@push('styles')
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/style/home.css')}}">
    <link rel="stylesheet" href="{{asset(env('APP_FILE').'/style/edittopic.css')}}">
@endpush

@section('title', env('APP_NAME') . $GetTopicsCategoryById->title)

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
                    <a href="/title/{{$GetTopicsCategoryById->category->title->id}}">
                        {{$GetTopicsCategoryById->category->title->title_name}}
                    </a>
                </div>
                <div>
                    <a href="/forum/{{$GetTopicsCategoryById->category->id}}">
                        {{$GetTopicsCategoryById->category->name}}
                    </a>
                </div>
                <div>
                    <a href="/topic/{{$GetTopicsCategoryById->category->id .'/'.$GetTopicsCategoryById->id}}">
                        {{$GetTopicsCategoryById->title}}
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
                <form action="{{route('update.topic',$GetTopicsCategoryById->id)}}" method="POST">
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
                                <label for="topic_title" data-title="عنوان الموضوع">عنوان الموضوع</label>
                                <input type="text" name="title" id="topic_title" @class(['border-error'=> $errors->has('title')]) value="{{$GetTopicsCategoryById->title}}" placeholder="عنوان الموضوع">
                            </div>

                            <div class="text-editor">

                                @error('topic_content')
                                <div class="error-list">
                                    @foreach($errors->get('topic_content') as $error)
                                        <p>{{$error}}</p>
                                    @endforeach
                                </div>
                                @enderror

                                <label for="editor" data-title="محتوي الموضوع">محتوي الموضوع</label>
                                <textarea id="editor" name="topic_content">{{$GetTopicsCategoryById->content}}</textarea>
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
                                @php

                                     $ExplodeTags = explode('|',$GetTopicsCategoryById->tag->tags);

                                @endphp

                                <textarea type="text" id="tags" name="tags">
                                    @foreach($ExplodeTags as $tags) {{$tags}}, @endforeach
                                </textarea>
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
                                    <input type="radio" name="signature_status" id="signature" value="1" @if(auth()->user()->signature_status == 1) checked @endif>
                                    <label for="signature">في هذا الموضوع فقط </label>
                                </div>

                                <div class="check">
                                    <input type="radio" name="signature_status" id="signature_ever" value="2" @if(auth()->user()->signature_status == 2) checked @endif>
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
                                    <input type="radio" name="owner_follow" id="owner_follow_one" value="0" @if($GetTopicsCategoryById->owner_follow == 0) checked @endif>   {{--Without Notification and Email--}}
                                    <label for="owner_follow_one">بدون اشعار</label>
                                </div>

                                <div class="owner-email-topic-follow">
                                    <input type="radio" name="owner_follow" id="owner_follow_tow" value="1"  @if($GetTopicsCategoryById->owner_follow== 1) checked @endif> {{--Notification Without Email--}}
                                    <label for="owner_follow_tow"> اشعار بدون بريد الكتروني</label>
                                </div>

                                <div class="owner-email-topic-follow">
                                    <input type="radio" name="owner_follow" id="owner_follow_three" value="2" @if($GetTopicsCategoryById->owner_follow == 2) checked @endif> {{--With Email Without EmNotificationail--}}
                                    <label for="owner_follow_three">بواسطة بريد الكتروني</label>
                                </div>
                            </div>


                        <div class="new-topic-btn-container">
                            <input type="submit" name="post" value="تعديل">
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
                $(".new-topic-btn-container input").prop('disabled', true);
            }
            $(".new-topic-btn-container input").click(function () {
                setTimeout(function () { disableButton(); }, 0);
            });

        });
    </script>

@endpush

