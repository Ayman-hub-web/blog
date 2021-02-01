<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;

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
});
Route::get('/template', function () {
    return view('backEnd.templateAdmin');
});



############### Admin ####################
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'submit_login'])->name('admin.submit_login');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
############### Categories ################
############### Usre ####################
Route::get('/admin/user', [AdminController::class, 'getUsers'])->name('admin.user');
Route::delete('/admin/user/{id}', [AdminController::class, 'destroy'])->name('admin.user.delete');
############### Categories ################
Route::resource('admin/category', CategoryController::class);
############### Posts #####################
Route::resource('admin/post', PostController::class);
################## Settings ###############
Route::get('/admin/setting', [SettingController::class, 'index'])->name('admin.setting');
Route::post('/admin/setting', [SettingController::class, 'save_settings']);
################## Comments ###############
Route::get('/admin/comment', [CommentController::class, 'index'])->name('admin.comment');
Route::get('admin/comment/{id}/delete', [CommentController::class, 'destroy'])->name('admin.comment.delete');
################# Home ####################
Route::get('/home', [HomeController::class, 'index']);
Route::post('/home', [HomeController::class, 'index'])->name('home');
Route::get('/detail/{slug}/{id}', [HomeController::class, 'detail'])->name('post.detail');
Route::post('/save_comment/{slug}/{id}', [HomeController::class, 'save_comment']);
Route::get('/category', [HomeController::class, 'showCategories'])->name('showCategories');
Route::get('/categoryPosts/{cat_id}', [HomeController::class, 'getCategoryPosts'])->name('getCategoryPosts');
Route::get('/savePost', [HomeController::class, 'savePostForm'])->name('savePostForm');
Route::post('/savePost', [HomeController::class, 'savePostData'])->name('savePostData');
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
