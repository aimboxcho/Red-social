<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;


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

/*

    $images = Image::all(); 
    foreach($images as $image){
        echo $image->image_path."<br>";
        echo $image->description."<br>";
        echo $image->user->name."<br>";
        echo $image->user->surname."<hr>";
        if(count($image->comments) >= 1){
            echo '<strong>Comentarios</strong>';
            foreach($image->comments as $comment){
                echo $comment->user->name;
                echo $comment->content."<br>";
            }
        }

        echo 'LIKES: '.count($image->likes);
    }

*/

Route::get('/', function () {return view('/welcome');});
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('config', [UserController::class, 'config'])->name('config');
Route::post('user/update', [UserController::class, 'update'])->name('user.update');
Route::get('user/avatar/{filename}', [UserController::class, 'getImage'])->name('user.avatar');
Route::get('imagen/create',[ImageController::class, 'create'])->name('image.create');
Route::post('imagen/save',[ImageController::class,'save'])->name('image.save');
Route::get('image/file/{filename}', [ImageController::class, 'getImage'])->name('image.file');
Route::get('image/{id}', [ImageController::class, 'detail'])->name('image.detail');
Route::post('comment/save', [CommentController::class, 'save'])->name('comment.save');
Route::get('comment/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');
Route::get('like/{image_id}', [LikeController::class, 'like'])->name('like.save');
Route::get('dislike/{image_id}', [LikeController::class, 'dislike'])->name('dislike.delete');
