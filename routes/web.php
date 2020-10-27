<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuthor;

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

Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::get('/logout', function(){
        \Auth::logout();
        return redirect(route('login'));
    })->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::get('/profile/edit', [App\Http\Controllers\UserController::class,'edit'])->name('profile.edit');
Route::post('/profile/edit', [App\Http\Controllers\UserController::class,'editRequest'])->name('editRequest');

Route::get('/admin', [App\Http\Controllers\Admin\AccountController::class, 'index'])->name('admin.panel');
Route::get('/admin/articles', [App\Http\Controllers\Admin\ArticlesController::class, 'index'])->name('articles')->middleware(CheckAuthor::class);
Route::get('/admin/articles/add', [App\Http\Controllers\Admin\ArticlesController::class,'addArticle'])->name('articles.add');
Route::post('/admin/articles/add', [App\Http\Controllers\Admin\ArticlesController::class,'addRequestArticle']);
Route::get('/admin/articles/edit/{id}', [App\Http\Controllers\Admin\ArticlesController::class,'editArticle'])->where('id', '\d+')->name('articles.edit');
Route::post('/admin/articles/edit/{id}', [App\Http\Controllers\Admin\ArticlesController::class,'editRequestArticle'])->where('id', '\d+');
Route::delete('/admin/articles/delete', [App\Http\Controllers\Admin\ArticlesController::class,'deleteArticle'])->name('articles.delete');

Route::get('/article/{id}/{slug}.html', [App\Http\Controllers\HomeController::class,'showArticle'])->name('blog.show');
Route::get('/resize', [App\Http\Controllers\ResizeController::class, 'index'])->name('resize');
Route::post('/resize', [App\Http\Controllers\ResizeController::class, 'resize_image']);
});
