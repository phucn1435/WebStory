<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DanhMucTruyenController;
use App\Http\Controllers\TruyenController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\SachController;



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

Route::get('/admin', function () {
    return view('auth.login');
    // return view('layout');
});

Auth::routes();

Route::get('/', [IndexController::class, 'home'])->name('website');
Route::get('/doc-truyen/5', [IndexController::class, 'doctruyen'])->name('doctruyen');
Route::get('/danh-muc/{slug}', [IndexController::class, 'danhmuc']);
Route::get('/xem-truyen/{slug}', [IndexController::class, 'doctruyen']);
Route::get('/xem-chapter/{slug}/{slug_chapter}', [IndexController::class, 'xemchapter']);
Route::get('/the-loai/{slug}', [IndexController::class, 'theloai']);
Route::get('/tag/{tag}', [IndexController::class, 'tag']);
Route::post('/top-panel', [IndexController::class, 'topPanel']);


Route::post('/tim-kiem', [IndexController::class, 'timkiem'])->name('timkiem');

Route::post('/timkiem_ajax', [IndexController::class, 'timkiem_ajax']);
Route::post('/loai-truyen', [TruyenController::class, 'loaitruyen']);

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::resource('/danhmuc', DanhMucTruyenController::class);
Route::resource('/truyen', TruyenController::class);
Route::resource('/chapter', ChapterController::class);
Route::resource('/theloai', TheLoaiController::class);
Route::resource('/sach', SachController::class);


Route::get('/custom_error', function(){
    return Artisan::call('php artisan vendor:publish --tag=laravel-errors');
});






