<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return redirect('/post');
    //return view('welcome');

});

Route::get('/home', function () {
    return redirect('/post');
    //return view('welcome');

});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// User Index, Create, Store, ShowPost
Route::resource('user', UserController::class)->only([
    'index', 'store', 'create'
]);
Route::get('/user/{userId}/post', [UserController::class, 'showPost'])->name('user.show_post');

// Post Create, Store, ShowComment
Route::resource('/post', PostController::class)->only([
    'store', 'index'
]);
Route::get('/post/create/user/{userId}', [PostController::class, 'create'])->name('post.create');
Route::get('/post/{postId}/comment', [PostController::class, 'showComment'])->name('post.show_comment');

// Comment Create, Store
Route::resource('/comment', CommentController::class)->only([
    'store'
]);
Route::get('/comment/create/post/{postId}', [CommentController::class, 'create'])->name('comment.create');
Route::get('/comment/{id}/delete/post/{postId}', [CommentController::class, 'destroy'])->name('comment.delete');
