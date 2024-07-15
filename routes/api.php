<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\API\AboutUsController;
use App\Http\Controllers\Admin\API\PrayersController;
use App\Http\Controllers\Admin\API\ContactUsController;
use App\Http\Controllers\Admin\API\AppVersionController;
use App\Http\Controllers\Admin\API\ToraLessonsController;
use App\Http\Controllers\Admin\API\VideosController;
use App\Http\Controllers\Admin\API\SynagoguesController;
use App\Http\Controllers\Admin\API\TodayTimesController;
use App\Http\Controllers\Admin\API\AppSettingsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/torah-lessons',[ToraLessonsController::class,'SynagoguesList']);

Route::get('/torah-lessons',[ToraLessonsController::class,'torahLessons']);
Route::get('/prayers-details',[PrayersController::class,'Prayers']);
Route::get('/app-contact-us',[ContactUsController::class,'AppContactUs']);
Route::get('/app-about-us',[AboutUsController::class,'AboutUs']);
Route::get('/app-currunt-version',[AppVersionController::class,'CurruntAppVersion']);
Route::get('/session-videos',[VideosController::class,'SessionVideos']);
Route::get('/synagogues-list',[SynagoguesController::class,'SynagoguesList']);
Route::get('/today-times',[TodayTimesController::class,'TodayTimes']);
Route::get('/app-settings',[AppSettingsController::class,'AppSettings']);
Route::post('/synagogue-prayer-times',[TodayTimesController::class,'SynagoguePrayerTimes']);



