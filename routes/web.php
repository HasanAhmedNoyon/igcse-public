<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\SliderController;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/chapter', function () {
    return view('website.pages.chapter');
})->name('chapter');
Route::get('/lecture', function () {
    return view('website.pages.single_lecture');
})->name('lecture_page');
Route::get('/quiz', function () {
    return view('website.pages.quiz');
})->name('quiz');
Route::get('/about', function () {
    return view('website.pages.about');
})->name('about');
Route::get('/contact', function () {
    return view('website.pages.contact');
})->name('contact');
Route::get('/student-login', function () {
    return view('website.pages.student_login');
})->name('login');
Route::get('/registration_form', function () {
    return view('website.pages.registration_form');
})->name('registration_form');
Route::get('/student_dashboard', function () {
    return view('website.pages.student_dashboard');
})->name('student_dashboard');
Route::get('/student_profile_dashboard', function () {
    return view('website.pages.student_profile_dashboard');
})->name('student_profile_dashboard');


Route::get('/lecture', function () {
    return view('website.pages.single_lecture');
})->name('lecture_page');


Auth::routes();
Route::group(['as'=>'user.','prefix'=>'user','middleware'=>['auth','user']], function (){
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/', function() {
        return redirect()->route('admin.dashboard');
    });

});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/login', [AdminAuthController::class, 'admin_login'])->name('admin-login');
Route::post('/admin-login-check', [AdminAuthController::class, 'admin_login_check'])->name('admin-login-check');
Route::get('/admin/password/reset', [AdminAuthController::class, 'admin_password_reset'])->name('admin-password-reset');
Route::post('/admin/password/forgot',[AdminAuthController::class,'sendResetLink'])->name('admin.forgot.password.link');
Route::get('/admin/password/reset/{token}',[AdminAuthController::class,'showResetForm'])->name('admin.reset.password.form');
Route::post('/admin/password/reset',[AdminAuthController::class,'resetPassword'])->name('admin.reset.password');


Route::group(['as'=>'admin.','prefix'=>'admin','middleware'=>['auth:admin']], function (){
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/', function() {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    //-----------------------------SLIDER MANAGEMENT START----------------------------
    Route::resource('chapter', 'Admin\ChapterController');
    Route::get('chapter-list/{type}','Admin\ChapterController@index')->name('chapter-list.index');
    Route::get('chapter/status-change/{id}','Admin\ChapterController@status_change')->name('chapter.status.change');
    //-----------------------------SLIDER MANAGEMENT END-----------------------------

    //-----------------------------LECTURE MANAGEMENT START----------------------------
    Route::resource('lecture', 'Admin\LectureController');
    Route::get('lecture-list/{type}','Admin\LectureController@index')->name('lecture-list.index');
    Route::get('lecture/status-change/{id}','Admin\LectureController@status_change')->name('lecture.status.change');
    //-----------------------------LECTURE MANAGEMENT END-----------------------------

    //-----------------------------SLIDER MANAGEMENT START----------------------------
    Route::resource('slider-list', 'Admin\SliderController');
    Route::get('slider-list/inactive/{id}', [SliderController::class, 'inactive'])->name('slider-list.inactive');
    Route::get('slider-list/active/{id}', [SliderController::class, 'active'])->name('slider-list.active');
    //-----------------------------SLIDER MANAGEMENT END-----------------------------


    //-----------------------------System Settings START----------------------------
    Route::get('settings/system-info','Admin\SettingController@system_info')->name('system.settings');
    Route::post('settings/system-info-update','Admin\SettingController@system_info_update')->name('system.settings.store');

    Route::get('contact-us','Admin\SettingController@contact_us')->name('contact.us');
    //-----------------------------System Settings END-----------------------------


    //-----------------------------Subscriber MANAGEMENT START----------------------------
    Route::resource('subscriber', 'Admin\SubscriberController');
    //-----------------------------Subscriber MANAGEMENT END-----------------------------

});