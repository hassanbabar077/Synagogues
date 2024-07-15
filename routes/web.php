<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SynagogueController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\TodayTimeController;
use App\Http\Controllers\Admin\LessonCategoryController;
use App\Http\Controllers\Admin\SessionDetailController;
use App\Http\Controllers\Admin\PrayerCategoryController;
use App\Http\Controllers\Admin\PrayerTimeController;
use App\Http\Controllers\Admin\TextEditorController;
use App\Http\Controllers\Admin\VersionController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\SessionVideoController;
use App\Http\Controllers\Admin\ManagersController;
use App\Http\Controllers\Admin\PryarSubCategoryController;
use Illuminate\Support\Facades\Session;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/locale/{locale}', function (Request $request, $locale) {
    // Session::flush(); 
    session()->forget('locale');
    Session::put('locale', $locale);
    return redirect()->back();
})->name('locale');
 Route::get('/', function (Request $request) {
    return view('locale');
});


Route::middleware(['guest'])->group(function () {

    Route::get('/', function () {
        
        if(!session()->has('locale')){
             Session::put('locale', 'hb');
             return redirect()->route('welcome');
        }
       
        return view('auth.passwords.login');
    })->name('welcome');

    Route::post('/login',[LoginController::class,'Login'] )->name('login');
});


Route::middleware(['authenticated'])->group(function () {

    Route::get('/home',[UserController::class,'Home'])->name('home');

    // my profile
    Route::get('/profile-edit',[UserController::class,'ProfileEdit'])->name('profile-edit');
    Route::post('/update-profile',[UserController::class,'UpdateProfile'])->name('update-profile');
    // users account settings
    Route::get('/account-settings',[UserController::class,'AccountSettings'])->name('account-settings');
    // city
    Route::get('/cities',[CityController::class, 'show'])->name('cities');
    Route::post('/cities/store',[CityController::class,'store'])->name('cities.store');
    Route::post('/cities/update/{id}',[CityController::class,'UpdateCity'])->name('cities.update');
    Route::get('/cities/delete/{id}',[CityController::class,'delete'])->name('cities.delete');
    //synagogues
    Route::get('/synagogues',[SynagogueController::class,'show'])->name('synagogues');
    Route::get('/synagogues/create',[SynagogueController::class,'create'])->name('synagogues.create');
    Route::post('/synagogues/store',[SynagogueController::class,'store'])->name('synagogues.store');
    Route::get('/synagogues/edit/{id}',[SynagogueController::class,'edit'])->name('synagogues.edit');
    Route::post('/synagogues/update/{id}',[SynagogueController::class,'update'])->name('synagogues.update');
    Route::get('/synagogues/delete/{id}',[SynagogueController::class,'delete'])->name('synagogues.delete');

    //today time
    Route::get('/todaytime' ,[TodayTimeController::class , 'show'])->name('todaytime');
    Route::post('/todaytime/store',[TodayTimeController::class,'store'])->name('todaytime.store');
    Route::post('/todaytime/update/{id}',[TodayTimeController::class,'update'])->name('todaytime.update');
    Route::get('/todaytime/delete/{id}',[TodayTimeController::class,'delete'])->name('todaytime.delete');

    //lesson category
    Route::get('/torah-lesson-category',[LessonCategoryController::class,'show'])->name('lesson-category');
    Route::post('/torah-lesson-category/store',[LessonCategoryController::class,'store'])->name('lesson-category.store');
    Route::post('/torah-lesson-category/update/{id}',[LessonCategoryController::class,'update'])->name('lesson-category.update');
    Route::get('/torah-lesson-category/delete/{id}',[LessonCategoryController::class,'delete'])->name('lesson-category.delete');
    //session details
    Route::get('/torah-lesson-details',[SessionDetailController::class,'show'])->name('session-details');
    Route::get('/torah-lesson-details/create',[SessionDetailController::class,'create'])->name('session-details.create');
    Route::post('/torah-lesson-details/store',[SessionDetailController::class,'store'])->name('session-details.store');
    Route::get('/torah-lesson-details/edit/{id}',[SessionDetailController::class,'edit'])->name('session-details.edit');
    Route::post('/torah-lesson-details/update/{id}',[SessionDetailController::class,'update'])->name('session-details.update');
    Route::get('/torah-lesson-details/delete/{id}',[SessionDetailController::class,'delete'])->name('session-details.delete');

    //prayer category
    Route::get('/prayer-category',[PrayerCategoryController::class,'show'])->name('prayer-category');
    Route::post('/prayer-category/store',[PrayerCategoryController::class,'store'])->name('prayer-category.store');
    Route::post('/prayer-category/update/{id}',[PrayerCategoryController::class,'update'])->name('prayer-category.update');
    Route::get('/prayer-category/delete/{id}',[PrayerCategoryController::class,'delete'])->name('prayer-category.delete');
    
    Route::get('/prayer-sub-category',[PryarSubCategoryController::class,'show'])->name('prayer-sub-category');
    Route::post('/prayer-sub-category/store',[PryarSubCategoryController::class,'store'])->name('prayer-sub-category.store');
    Route::post('/prayer-sub-category/update/{id}',[PryarSubCategoryController::class,'update'])->name('prayer-sub-categories.update');

    Route::get('/prayer-sub-category/delete/{id}',[PryarSubCategoryController::class,'delete'])->name('prayer-sub-category.delete');


    //prayer time
    Route::get('/prayer-time',[PrayerTimeController::class,'show'])->name('prayer-time');
    Route::get('/prayer-time/create',[PrayerTimeController::class,'create'])->name('prayer-time.create');
    Route::post('/prayer-time/store',[PrayerTimeController::class,'store'])->name('prayer-time.store');
    Route::get('/prayer-time/edit/{id}',[PrayerTimeController::class,'edit'])->name('prayer-time.edit');
    Route::post('/prayer-time/update/{id}',[PrayerTimeController::class,'update'])->name('prayer-time.update');
    Route::get('/prayer-time/delete/{id}',[PrayerTimeController::class,'delete'])->name('prayer-time.delete');


    //text editor
    Route::get('/editor',[TextEditorController::class, 'show'])->name('editor');
    Route::post('/editor-text',[TextEditorController::class, 'Data']);

    //version
    Route::get('/version',[VersionController::class,'show'])->name('version');
    Route::post('/version/store',[VersionController::class,'store'])->name('version.store');
    Route::post('/version/update/{id}',[VersionController::class,'update'])->name('version.update');
    Route::get('/version/delete/{id}',[VersionController::class,'delete'])->name('version.delete');

    //contact us
    Route::get('/contact-us',[ContactUsController::class,'show'])->name('contact-us');
    Route::post('/contact-us/store',[ContactUsController::class,'store'])->name('contact-us.store');
    Route::post('/contact-us/update/{id}',[ContactUsController::class,'update'])->name('contact-us.update');
    Route::get('/contact-us/delete/{id}',[ContactUsController::class,'delete'])->name('contact-us.delete');

    //about
    Route::get('/about',[AboutController::class,'show'])->name('about');
    Route::post('/about/store',[AboutController::class,'store'])->name('about.store');
    Route::post('/about/update/{id}',[AboutController::class,'update'])->name('about.update');
    Route::get('/about/delete/{id}',[AboutController::class,'delete'])->name('about.delete');

    // Route::get('/logout',[LoginController::class,'logout'])->name('logout');

    // session videos
    Route::get('/session-videos',[SessionVideoController::class,'show'])->name('session-videos');
    Route::post('/session-videos/store',[SessionVideoController::class,'store'])->name('session-videos.store');
    Route::post('/session-videos/update/{id}',[SessionVideoController::class,'update'])->name('session-videos.update');
    Route::get('/session-videos/delete/{id}',[SessionVideoController::class,'delete'])->name('session-videos.delete');
    
    
    //Synagogues Mangers
    Route::get('/synagogues-managers',[ManagersController::class,'show'])->name('synagogues.managers');
    Route::post('/synagogues-managers-store',[ManagersController::class,'store'])->name('synagogues.manager.store');
    Route::get('/synagogues-managers-delete/{id}',[ManagersController::class,'delete'])->name('synagogues.manager.delete');

    
    
    

});




Route::get('/check', function () {
    return view('web');
});

Auth::routes();

