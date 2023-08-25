<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Font;
use App\Models\Rank;
use App\Models\Title;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    //login view method
    public function LoginViewMethod(){
        return view('dashboard/login');
    }
    //login post method
    public function LoginMethod(AdminRequest $request){

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('admin.dashboard.index');
        }else{
            return redirect()->route('admin.login.view')->with('LoginError','خطاء في كلمة المرور او البريد الالكتروني');
        }
    }

    //index method
    public function IndexMethod(){

        $AllUsers = User::all();
        $LastUsers = User::latest()->take(5)->with('rank')->get();
        $LastComments = Comment::latest()->take(5)->with('user')->get();

        $AllTitles = Title::withoutGlobalScope('WhereActive')->get();
        $AllCategories = Category::withoutGlobalScope('WhereActive')->get();
        $AllTopics = Topic::withoutGlobalScope('WhereActive')->get();

        $AllRanks = Rank::latest()->paginate(5,['*'],'ranks');
        $AllFonts = Font::latest()->paginate(5,['*'],'fonts');
        return view('dashboard/index',compact('AllUsers','AllTitles','AllCategories','AllTopics','LastUsers','LastComments','AllRanks','AllFonts'));
    }

    //add rank method
    public function AddRankMethod(Request $request){

        $request->validate([
            'rank_name'=>'required|string',
            'rank_bg_color'=>'required|regex:/^#[a-fA-F0-9]{6}$/',
            'rank_text_color'=>'required|regex:/^#[a-fA-F0-9]{6}$/',
            'rank_font_weight'=>'required|string',
            'rank_icon' => 'required|file|mimes:,svg|max:2048',
            ],
            [
                'required'=>'جميع الحقول مطلوبة',
                'rank_font_weight.string'=>'يجب أن يكون حقل نوع الخط نصي',
                'rank_name.string'=>'يجب أن يكون حقل الاسم نصي',
                'regex'=>'عفوا خطاء في البيانات',
                'mimes'=>'يجب ان يكون صيغة الملف SVG فقط',
                'file'=>'الملف غير معروف'
            ]);

        if ($request->hasFile('rank_icon')) {
            if ($request->file('rank_icon')) {

                    $files = $request->file('rank_icon');
                    $publicPath = public_path('images/d_icons');
                    $files->move($publicPath, $files->getClientOriginalName());
                    $RankName = $files->getClientOriginalName();

                    Rank::create([
                        'rank_name'=>$request->rank_name,
                        'rank_icon'=>'/images/d_icons/'.$RankName,
                        'rank_bg_color'=>$request->rank_bg_color,
                        'rank_text_color'=>$request->rank_text_color,
                        'rank_font_weight'=>$request->rank_font_weight
                    ]);

            }
        }
        return redirect()->route('admin.dashboard.index')->with('RankSuccess','تم إضافة الرتبة بنجاح');
    }


    // edit rank method
    public function EditRankMethod(Request $request,$id){
        $request->validate([
            'edit_rank_name'=>'required|string',
            'edit_rank_bg_color'=>'required|regex:/^#[a-fA-F0-9]{6}$/',
            'edit_rank_text_color'=>'required|regex:/^#[a-fA-F0-9]{6}$/',
            'edit_rank_font_weight'=>'required|string',
            'edit_rank_icon' => 'file|mimes:svg|max:2048',
        ],
        [
            'required'=>'جميع الحقول مطلوبة',
            'rank_font_weight.string'=>'يجب أن يكون حقل نوع الخط نصي',
            'rank_name.string'=>'يجب أن يكون حقل الاسم نصي',
            'regex'=>'عفوا خطاء في البيانات',
            'mimes'=>'يجب ان يكون صيغة الملف SVG فقط',
            'file'=>'الملف غير معروف'
        ]);
        $GetRankById = Rank::where('id',$id)->first();
        if ($GetRankById){
            $RankPath = public_path('/'.$GetRankById->rank_icon);
            if (File::exists($RankPath)) {
                 File::delete($RankPath);
                    if ($request->hasFile('edit_rank_icon')) {
                        if ($request->file('edit_rank_icon')) {
                            $files = $request->file('edit_rank_icon');
                            $publicPath = public_path('images/d_icons');
                            $files->move($publicPath, $files->getClientOriginalName());
                            $RankName = $files->getClientOriginalName();
                            $GetRankById->update([
                                'rank_name'=>$request->edit_rank_name,
                                'rank_bg_color'=>$request->edit_rank_bg_color,
                                'rank_text_color'=>$request->edit_rank_text_color,
                                'rank_font_weight'=>$request->edit_rank_font_weight,
                                'rank_icon'=>'/images/d_icons/'.$RankName
                            ]);

                        }
                    }
            } else if(!File::exists($RankPath)) {
                if ($request->hasFile('edit_rank_icon')) {
                    if ($request->file('edit_rank_icon')) {
                        $files = $request->file('edit_rank_icon');
                        $publicPath = public_path('images/d_icons');
                        $files->move($publicPath, $files->getClientOriginalName());
                        $RankName = $files->getClientOriginalName();
                        $GetRankById->update([
                            'rank_name'=>$request->edit_rank_name,
                            'rank_bg_color'=>$request->edit_rank_bg_color,
                            'rank_text_color'=>$request->edit_rank_text_color,
                            'rank_font_weight'=>$request->edit_rank_font_weight,
                            'rank_icon'=>'/images/d_icons/'.$RankName
                        ]);
                    }
                }
            }
        } else {
            return redirect()->route('admin.dashboard.index')->with('RankUpdateError','عفوا الرتبة غير موجودة');
        }
        return redirect()->route('admin.dashboard.index')->with('RankUpdateSuccess','تم تعديل الرتبة بنجاح');



    }
    // delete rank method
    public function DeleteRankMethod(Request $request,$id){
       $GetRankById= Rank::where('id',$id)->first();
        if ($GetRankById){
            $RankPath = public_path('/'.$GetRankById->rank_icon);
            if (File::exists($RankPath)) {
                $GetRankById->delete();
                File::delete($RankPath);
            }
        } else {
            return redirect()->route('admin.dashboard.index')->with('RankDeleteError','عفوا الرتبة غير موجودة');
        }
        return redirect()->route('admin.dashboard.index')->with('RankDeleteSuccess','تم حذف الرتبة بنجاح');



    }





    // add fonts method
    public function AddFontMethod(Request $request){
        $request->validate([
            'font_file' => 'required|file|mimes:,ttf,otf|max:2048',
        ],
        [
            'required'=>'ملف الخط مطلوب',
            'mimes'=>'يجب ان يكون صيغة الملف  OTF او TTF فقط',
            'file'=>'الملف غير معروف'
        ]);
        if ($request->hasFile('font_file')) {
            if ($request->file('font_file')) {
                $files = $request->file('font_file');
                $GetExtension = $request->file('font_file')->getClientOriginalExtension();
                $publicPath = public_path('fonts');
                $font = $files->move($publicPath, $files->getClientOriginalName());
                $FontNameWithoutExt = pathinfo($font, PATHINFO_FILENAME);

                Font::create([
                    'name'=>$FontNameWithoutExt,
                    'extension'=>$GetExtension,
                ]);
            }
        }

        return redirect()->route('admin.dashboard.index')->with('FontSuccess','تم إضافة الخط بنجاح');
    }

    //delete font file method
    public function DeleteFontMethod(Request $request,$id){

        $GetFontByID = Font::where('id',$id)->first();
        if ($GetFontByID){
            $FontPath = public_path('fonts/'.$GetFontByID->name.'.'.$GetFontByID->extension);
            if (File::exists($FontPath)) {
                $GetFontByID->delete();
                File::delete($FontPath);
            }
        } else {
            return redirect()->route('admin.dashboard.index')->with('FontDeleteError','عفوا الخط غير موجودة');
        }
        return redirect()->route('admin.dashboard.index')->with('FontDeleteSuccess','تم حذف الخط بنجاح');


    }







    // titles method
    public function TitlesViewMethod(){
        $AllTitles =Title::withoutGlobalScope('WhereActive')->with('categories.topics')->latest()->paginate(5);
        return view('dashboard.titles',compact('AllTitles'));
    }

    //add title method
    public function TitlesMethod(Request $request){
        $request->validate([
            'title_name'=>'required|string',
            'status'=>'required'
        ],
        [
            'required'=>'الحقل مطلوب',
            'string'=>'يرجي أن يكون الحقل يحتوي علي نص فقط'
        ]);

        Title::create([
            'title_name'=>$request->title_name,
            'status'=>$request->status
        ]);


        return redirect()->route('admin.dashboard.titles')->withSuccess('success','تم الاضافة بنجاح');
    }

    //update title method
    public function UpdateTitleMethod(Request $request, $id){

            $request->validate([
                'edit_title_name'=>'string|min:5',
                'edit_status'=>'required'
            ],
            [
                'required'=>'الحقل مطلوب',
                'string'=>'يرجي أن يكون الحقل يحتوي علي نص فقط',
                'min'=>'يجب ان يكون عدد الاحرف اكبر من 5'
            ]);
            Title::withoutGlobalScope('WhereActive')->where('id','=',$id)->update([
                'title_name'=>$request->edit_title_name,
                'status'=>$request->edit_status
            ]);

          return redirect()->route('admin.dashboard.titles')->with('update','تم التعديل بنجاح');
    }

    //categories method
    public function CategoriesViewMethod(){
        $AlTitles = Title::withoutGlobalScope('WhereActive')->get();
        $AllCategories = Category::withoutGlobalScope('WhereActive')->with('topics')->latest()->paginate(5);
        return view('dashboard.categories',compact('AllCategories','AlTitles'));
    }

    // add category method
    public function CategoryMethod(Request $request){
            $request->validate([
                'cat_name'=>'required|regex:/[a-zA-Zء-ي]/i',
                'title'=>'required|int|exists:titles,id',
                'cat_description'=>'required|string|regex:/[a-zA-Zء-ي]/i',
                'status'=>'required'
            ],
            [
                'required'=>'الحقل مطلوب',
                'int'=>'يجب ان يكون بيانات حقل (:attribute) ارقام فقط',
                'exists'=>'عفوا بيانات القسم غير موجودة',
                'string'=>'يرجي أن يكون الحقل يحتوي علي نص فقط',
                'regex'=>'عفوا لايمكنك كتابة حروف خاصه'
            ]);

            Category::create([
                'name'=>$request->cat_name,
                'description'=>$request->cat_description,
                'title_id'=>$request->title,
                'status'=>$request->status,
            ]);

        return redirect()->route('admin.dashboard.categories')->withSuccess('success','تم إضافة القسم بنجاح');

    }



    // update category method
    public function UpdateCategoryMethod(Request $request, $id){

        $request->validate([
            'edit_cat_name'=>'required|regex:/[a-zA-Zء-ي]/i',
            'edit_title'=>'required|int|exists:titles,id',
            'edit_cat_description'=>'required|string|regex:/[a-zA-Zء-ي]/i',
            'edit_status'=>'required'
        ],
        [
            'required'=>'الحقل مطلوب',
            'int'=>'يجب ان يكون بيانات حقل (:attribute) ارقام فقط',
            'exists'=>'عفوا بيانات القسم غير موجودة',
            'string'=>'يرجي أن يكون الحقل يحتوي علي نص فقط',
            'regex'=>'عفوا لايمكنك كتابة حروف خاصه'
        ]);

        Category::withoutGlobalScope('WhereActive')->where('id',$id)->update([
            'name'=>$request->edit_cat_name,
            'description'=>$request->edit_cat_description,
            'title_id'=>$request->edit_title,
            'status'=>$request->edit_status,
        ]);

        return redirect()->route('admin.dashboard.categories')->with('update','تم تعديل القسم بنجاح');

    }

   // topics view
    public function TopicsViewMethod(){
        $AllTopics = Topic::withoutGlobalScope('WhereActive')->with('category')->with('comments')->latest()->paginate(5);
        $AllCategories = Category::withoutGlobalScope('WhereActive')->get();
        return view('dashboard/topics',compact('AllTopics','AllCategories'));
    }

    // update topic method
    public function UpdateTopicMethod(Request $request,$id){

        $request->validate([
            'edit_topic_name'=>'required|regex:/[a-zA-Zء-ي]/i',
            'edit_cat'=>'required|int|exists:categories,id',
            'edit_status'=>'required'
        ],
        [
            'edit_topic_name.required'=>'حقل الاسم مطلوب',
            'edit_cat.required'=>'حقل القسم مطلوب',
            'edit_status.required'=>'حقل الحالة مطلوب',
            'exists'=>'عفوا القسم غير موجود',
            'regex'=>'عفوا لايمكنك كتابة حروف خاصه'
        ]);

        Topic::withoutGlobalScope('WhereActive')->where('id',$id)->update([
            'title'=>$request->edit_topic_name,
            'category_id'=>$request->edit_cat,
            'status'=>$request->edit_status
        ]);

        return redirect()->route('admin.dashboard.topics')->with('update','تم تعديل الموضوع بنجاح');
    }



    // users view method
    public function UsersViewMethod(){
        $AllUsers = User::latest()->paginate(10);
        $AllRanks = Rank::latest()->get();
        return view('dashboard.users',compact('AllUsers','AllRanks'));
    }
    // user update method
    public function UpdateUserMethod(Request $request,$id){

        $request->validate([
            'edit_name'=>'required|string|regex:/[a-zA-Zء-ي]/i',
            'edit_email'=>'required|email',
            'edit_rank'=>'nullable|int|exists:ranks,id',
            'status'=>'required|string'
        ],
        [
            'edit_name.required'=>'حقل الاسم مطلوب',
            'edit_email.required'=>'حقل البريد الالكتروني مطلوب',
            'edit_rank.required'=>'حقل الرتبه مطلوب',
            'status.required'=>'حقل الحاله مطلوب',
            'edit_name.string'=>'يرجي أن تكون بيانات الاسم نصيه',
            'edit_email.unique'=>'البريد الالكتروني موجود سابقا',
            'email.email'=>'صيغة البريد الالكتروني غير صحيحه',
            'edit_rank.exists'=>'الرتبه غير موجوده'
        ]);

        User::where('id',$id)->update([
            'name'=>$request->edit_name,
            'email'=>$request->edit_email,
            'rank_id'=>$request->edit_rank ?? 0,
            'status'=>$request->status
        ]);



        return redirect()->route('admin.dashboard.users')->with('update','تم تعديل بيانات المستخدم بنجاح');
    }
}
