<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Mail\CommentNotifictionMail;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Rate;
use App\Models\Scopes\TopicScope;
use App\Models\Signature;
use App\Models\Tag;
use App\Models\Title;
use App\Models\Topic;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use function Sodium\increment;
use App\Helpers\UserSystemInfoHelper;

//withoutGlobleScope
class UserController extends Controller
{

// Home Method
    public function GetAllCategories(Request $request){
//        Auth::logout();
//         Auth::user()->notify(new UserNotification(Auth::user()->id));
        //Get All Titles With Categories With All Topics
        $AllTitles = Title::with(['categories.topics'=>function ($q){
            $q->order();
        }])->with('categories.topics.comments')->latest()->get();
//*********************************************************************//
//Get Last Users
        $GetLastUsers = User::order()->take(10)->get();
//*********************************************************************//
//Get Last Topics With Category
        $LastTopics = Topic::with('category')->take(10)->order()->get();
//*********************************************************************//
//Get All Topisc Count
        $AllTopics = Topic::all()->count(); // Get all topics count
//*********************************************************************//
        //*********************************************************************//
//Get All Comments Count
        $AllComments = Comment::all()->count(); // Get all comments count
//Get All Users Count
        $AllUsers  = User::all()->count(); // Get all users count
//*********************************************************************//


        return view('home',compact('AllTitles','LastTopics','GetLastUsers','AllTopics','AllComments','AllUsers'));
    }
// Get Title Method
    public function GetTitle($id){

        //Get All Titles With Categories With All Topics
        $AllTitles = Title::where('id',$id)->with(['categories.topics'=>function ($q){
            $q->order();
        }])->with('categories.topics.comments')->get();
//*********************************************************************//
//Get Last Users
        $GetLastUsers = User::order()->take(10)->get();
//*********************************************************************//
//Get Last Topics With Category
        $LastTopics = Topic::with('category')->take(10)->order()->get();
//*********************************************************************//
//Get All Topisc Count
        $AllTopics = Topic::all()->count(); // Get all topics count
//*********************************************************************//
        //*********************************************************************//
//Get All Comments Count
        $AllComments = Comment::all()->count(); // Get all comments count
//Get All Users Count
        $AllUsers  = User::all()->count(); // Get all users count
//*********************************************************************//


        return view('title',compact('AllTitles','LastTopics','GetLastUsers','AllTopics','AllComments','AllUsers'));
    }


//Get Form Topics
    public function GetForumTopics($id){

        $GetForumTopicsByCategoryId = Category::where('id',$id)->with(['topics'=>function($query){
            $query->with('user.rank')->with('rates');
        }])->with('title')->get();

        $GetPinTopics = Topic::withoutGlobalScope('WhereActive')->order()->with('user.rank')->with('rates')->where('status','pin')->where('category_id',$id)->take(5)->get();

//        Topic::where('category_id',$id)->increment('views',1);

//        dd($GetForumTopicsByCategoryId);
        return view('forum',compact('GetForumTopicsByCategoryId','GetPinTopics'));
    }




//Store new topic view
    public function AddNewTopic($id){
        $GetTopicsCategoryById =Category::where('id',$id)->get();
        return view('newtopic',compact('GetTopicsCategoryById','id'));
    }


// Store new topic method
   public function postNewTopicMethod (TopicRequest $request,$id){
        if($request->preview){
            return view('preview',$request->all());
        }

        if($request->signature_status > 1 && $request->signature_status < 3){
            Auth::user()->update([
                'signature_status'=>$request->signature_status
            ]);
        }
       $signature_status = $request->signature_status ?? '0';
       $StoreTopic = Topic::create([
           'title'=> $request->title,
           'content'=>$request->topic_content,
           'category_id'=>$id,
           'user_id'=>auth()->user()->id,
           'signature_status'=>$signature_status,
           'owner_follow'=>$request->owner_follow
       ]);

       if(!empty($request->tags)){

           $Tags = explode(',',$request->tags);
           $StoreTopicTags = Tag::create([
               'topic_id'=>$StoreTopic->id,
               'tags'=>implode('|',$Tags)
           ]);
       }
       $topicSeoUrlTitle = str_replace(' ','-',$StoreTopic->title);

       return Redirect('/topic/'.$id.'/'.$StoreTopic->id.'/'.$topicSeoUrlTitle);
   }

// Get topic by id method
   public function GetTopic($cat,$id){
        $GetTopicByid = Topic::where('id',$id)->with('comments.user')->with('category.title')->with(['user.rank','user.signature'])->first();
        if($GetTopicByid){
            Topic::where('id',$id)->increment('views',1);
        }
        $GetTopicRate = Rate::where('topic_id',$id)->avg('rate');
       $CheckIfUserRateTopic =null;
        if (Auth::check()){
            $test = Rate::where('topic_id',$id)->where('user_id',Auth::user()->id)->first();
            $CheckIfUserRateTopic = $test;
        }
        $GetTopicIdTags = Tag::where('topic_id',$id)->first();
        if ($GetTopicIdTags){
            $ExplodeTags = explode('|',$GetTopicIdTags->tags);
            $tags =  implode(',',$ExplodeTags);
        } else {
            $tags = '';
        }

        return view('topic',compact('GetTopicByid','GetTopicRate','CheckIfUserRateTopic','tags'));
   }


//Add new comment method
    public function commentMethod(Request $request,$cat,$id){

        $request->validate([
            'comment'=>'required'
        ],[
            'required'=>'يرجي كتابة تعليق'
        ]);

        $StoreNewComment = Comment::create([
            'content'=>$request->comment,
            'topic_id'=>$id,
            'user_id'=>auth()->user()->id,
            'category_id'=>$cat,
        ]);
        $GetTopicAuther = Topic::where('id',$id)->with('user')->first();

        if ($StoreNewComment->topic->owner_follow > 1){
            Mail::to($GetTopicAuther->user->email)->send(new CommentNotifictionMail($StoreNewComment->topic->id,$StoreNewComment->topic->title,auth()->user()->name));
        }

        $topicSeoUrlTitle = str_replace(' ','-',$GetTopicAuther->title);


        return Redirect('/topic/'.$cat.'/'.$id.'/'.$topicSeoUrlTitle);
    }
// Verify Account Method
    public function VerifyAccount($id,$verify_code){
        $Decrypt_verify_code = decrypt($verify_code);

        $VerifyAccount = User::where('id',$id)->where('verify_code',$Decrypt_verify_code)->update([
            'status'=>'active'
        ]);
        if($VerifyAccount && Auth::loginUsingId($id)){
            return Redirect()->to('/');
        }

    }


// Topic rate method
    public function topicRateMethod(Request $request,$id){
        $FindTopicById = Rate::create([
            'rate'=>$request->rate,
            'user_id'=>auth()->user()->id,
            'topic_id'=>$id
        ]);
    }

// Edit topic view method
  public function EditTopicViewMethod($id){
        $GetTopicsCategoryById = Topic::where('id',$id)->first();
        return view('edittopic',compact('GetTopicsCategoryById'));
  }
// Update Topic Method
  public function UpdateTopicMethod(TopicRequest $request,$id){

      if($request->signature_status > 1 && $request->signature_status < 3){
          Auth::user()->update([
              'signature_status'=>$request->signature_status
          ]);
      }
      $signature_status = $request->signature_status ?? '0';
      $StoreTopic = Topic::where('id',$id)->update([
          'title'=> $request->title,
          'content'=>$request->topic_content,
          'signature_status'=>$signature_status,
          'owner_follow'=>$request->owner_follow
      ]);


      $Tags = explode(',',$request->tags);
      $StoreTopicTags = Tag::where('topic_id',$id)->update([
          'tags'=>implode('|',$Tags)
      ]);

      $GetTopicById = Topic::where('id',$id)->with('category')->first();
      $topicSeoUrlTitle = str_replace(' ','-',$GetTopicById->title);

      return Redirect('/topic/'.$GetTopicById->category->id.'/'.$GetTopicById->id.'/'.$topicSeoUrlTitle);



  }

  // profile view method
  public function ProfileViewMethod($id){
        $GetUserProfileDataById = User::where('id',$id)->with('topics')->with('comments')->first();
        return view('profile',compact('GetUserProfileDataById'));
  }


  //update profile avatar
  public function UpdateAvatarMethod(Request $request,$id){
          $request->validate([
              'avatar' => 'required|file|mimes:,png,jpg,gif|max:2048',
          ],
          [
              'required'=>'الصوره مطلوبة',
              'mimes'=>'يجب ان يكون صيغة الملف  PNG او JPG او GIF فقط',
              'file'=>'الملف غير معروف'
          ]);
        if (Auth::id() == $id){
            if ($request->hasFile('avatar')) {
                if ($request->file('avatar')) {
                    $file = $request->file('avatar');
                    $GetExtension = $request->file('avatar')->getClientOriginalExtension();
                    $fileName = time() . '_'.'.'. $file->getClientOriginalExtension();
                    $publicPath = public_path('images/profile');
                    $Avatar = $file->move($publicPath, $fileName);
                    User::where('id',Auth::id())->update([
                        'avatar'=>'/images/profile/'.$fileName
                    ]);
                }
            }
        }
      return Redirect()->route('profile',Auth::id());

  }


    //update profile cover
    public function UpdateCoverMethod(Request $request,$id){
      $request->validate([
          'cover' => 'required|file|mimes:,png,jpg|max:2048',
      ],
      [
          'required'=>'الصوره مطلوبة',
          'mimes'=>'يجب ان يكون صيغة الملف  PNG او JPG  فقط',
          'file'=>'الملف غير معروف'
      ]);
        if (Auth::id() == $id){

            if ($request->hasFile('cover')) {
                if ($request->file('cover')) {
                    $file = $request->file('cover');
                    $GetExtension = $request->file('cover')->getClientOriginalExtension();
                    $fileName = time() . '_' .'.'. $file->getClientOriginalExtension();
                    $publicPath = public_path('images/profile');
                    $Cover = $file->move($publicPath, $fileName);
                    User::where('id',Auth::id())->update([
                        'cover'=>'/images/profile/'.$fileName
                    ]);
                }
            }
        }
        return Redirect()->route('profile',Auth::id());

    }

  //update signature method
    public function UpdateSignatureMethod(Request $request){
      $request->validate([
          'signature'=>['required','string','regex:/(^([a-zA-z- ]+)(\d+)?$)/u'],
      ],
      [
          'required'=>'التوقيع مطلوب',
          'string'=>'يجب ان يكون التوقيع نص فقط',
          'regex'=>'لايمكنك استخدام الاحرف المخصصه'
      ]);

       Signature::where('user_id',Auth::id())->update([
            'sign_name'=>$request->signature
       ]);
       return redirect()->route('home')->with('SignatureSuccess','تم تعديل التوقيع بنجاح');
    }
  //logout method
  public function logoutMethod(){
    Auth::logout();
      return redirect()->route('home');

  }
}
