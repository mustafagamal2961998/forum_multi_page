<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Models\Font;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





//Guest Routs
//*******************************************************************//
//Login and join
Route::post('login',[AuthController::class,'Login'])->name('login');
Route::post('join',[AuthController::class,'join'])->name('join');
//********//
Route::get('/',[UserController::class,'GetAllCategories'])->name('home');
Route::get('title/{id}',[UserController::class,'GetTitle']);

Route::get('forum/{id}/{name}',[UserController::class,'GetForumTopics']);
Route::get('topic/{cat}/{id}/{title}',[UserController::class,'GetTopic']);
Route::get('join',[UserController::class,function(){
    $fonts = Font::all();
    return view('join',compact('fonts'));
}]);

Route::get('verify/{id}/{verify_code}',[UserController::class,'VerifyAccount']);
Route::get('profile/{id}',[UserController::class,'ProfileViewMethod'])->name('profile');
Route::post('update/signature',[UserController::class,'UpdateSignatureMethod'])->name('update.signature');


//*******************************************************************//



//Auth Routs
//*******************************************************************//
Route::get('newtopic/{id}',[UserController::class,'AddNewTopic'])->middleware(['auth']); //not forget auth middleware
Route::post('postnewtopic/{id}',[UserController::class,'postNewTopicMethod'])->name('postNewTopic')->middleware(['auth']); //not forget auth middleware
Route::post('comment/{cat}/{id}',[UserController::class,'commentMethod'])->name('comment')->middleware(['auth']); //not forget auth middleware
Route::post('topic.rate/{id}',[UserController::class,'topicRateMethod'])->name('topic.rate')->middleware(['auth']); //not forget auth middleware
Route::get('logout',[UserController::class,'logoutMethod'])->name('logout');
Route::post('update/avatar/{id}',[UserController::class,'UpdateAvatarMethod'])->name('update.avatar')->middleware(['auth']); //not forget auth middleware
Route::post('update/cover/{id}',[UserController::class,'UpdateCoverMethod'])->name('update.cover')->middleware(['auth']); //not forget auth middleware

//edit topic
Route::get('edit_topic/{id}',[UserController::class,'EditTopicViewMethod'])->name('edit.topic');
Route::post('UpdateTopic/{id}',[UserController::class,'UpdateTopicMethod'])->name('update.topic');
//*******************************************************************//



//*******************************************************************//
//*******************************************************************//
//Admin Routes
//*******************************************************************//
//*******************************************************************//





//*******************************************************************//
Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
    Route::get('/',[DashboardController::class,'LoginViewMethod'])->name('login.view');
    Route::post('login',[DashboardController::class,'LoginMethod'])->name('login');

//inside dashboard
    Route::get('dashboard',[DashboardController::class,'IndexMethod'])->middleware(['auth:admin'])->name('dashboard.index');
    Route::post('dashboard/add/rank',[DashboardController::class,'AddRankMethod'])->middleware(['auth:admin'])->name('dashboard.add_rank');
    Route::post('dashboard/edit/rank/{id}',[DashboardController::class,'EditRankMethod'])->middleware(['auth:admin'])->name('dashboard.edit_rank');
    Route::post('dashboard/delete/rank/{id}',[DashboardController::class,'DeleteRankMethod'])->middleware(['auth:admin'])->name('dashboard.delete_rank');



    Route::post('dashboard/add/font',[DashboardController::class,'AddFontMethod'])->middleware(['auth:admin'])->name('dashboard.add_font');
    Route::post('dashboard/delete/font/{id}',[DashboardController::class,'DeleteFontMethod'])->middleware(['auth:admin'])->name('dashboard.delete_font');





    Route::get('dashboard/titles',[DashboardController::class,'TitlesViewMethod'])->middleware(['auth:admin'])->name('dashboard.titles');
    Route::post('dashboard/add/title',[DashboardController::class,'TitlesMethod'])->middleware(['auth:admin'])->name('dashboard.add.titles');
    Route::post('dashboard/update/title/{id}',[DashboardController::class,'UpdateTitleMethod'])->middleware(['auth:admin'])->name('dashboard.titles.update');



    Route::get('dashboard/categories',[DashboardController::class,'CategoriesViewMethod'])->middleware(['auth:admin'])->name('dashboard.categories');
    Route::post('dashboard/add/category',[DashboardController::class,'CategoryMethod'])->middleware(['auth:admin'])->name('dashboard.add.category');
    Route::post('dashboard/update/category/{id}',[DashboardController::class,'UpdateCategoryMethod'])->middleware(['auth:admin'])->name('dashboard.update.category');


    Route::get('dashboard/topics',[DashboardController::class,'TopicsViewMethod'])->middleware(['auth:admin'])->name('dashboard.topics');
    Route::post('dashboard/update/topic/{id}',[DashboardController::class,'UpdateTopicMethod'])->middleware(['auth:admin'])->name('dashboard.update.topic');



    Route::get('dashboard/users',[DashboardController::class,'UsersViewMethod'])->middleware(['auth:admin'])->name('dashboard.users');
    Route::post('dashboard/update/user/{id}',[DashboardController::class,'UpdateUserMethod'])->middleware(['auth:admin'])->name('dashboard.update.user');


});
//*******************************************************************//
