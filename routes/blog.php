<?php

use Illuminate\Support\Facades\Route0;

use App\Http\Controllers\PostController;

use App\Http\Controllers\CommentController;

Route::get('/blog/login',[PostController::class,'signIn']) -> name('login.signIn');

Route::get('/blog/login/check',[PostController::class,'check']) -> name('login.check');

Route::get('/blog/{user_id}/posts',[PostController::class,'index'])-> name('posts.index');

Route::get('/blog/{user_id}/posts/create',[PostController::class,'create']) -> name('posts.create');

Route::get('/blog/{user_id}/posts/{post}/edit',[PostController::class,'edit']) -> name('posts.edit');

Route::delete('/blog/{user_id}/posts/{post}',[PostController::class,'destroy']) -> name('posts.destroy');

Route::get('/blog/{user_id}/posts/{post}',[PostController::class,'show']) -> name('posts.show');

Route::post('/blog/{user_id}/posts',[PostController::class,'store']) -> name('posts.store');

Route::put('/blog/{user_id}/posts/{post}',[PostController::class,'update']) -> name('posts.update');

Route::post('/blog/{user_id}/posts/comments/{post_id}',[CommentController::class,'store'])-> name('comments.store');

Route::put('/blog/posts/comments/{comment}',[CommentController::class,'update'])->name('comments.update');

Route::delete('/blog/posts/comments/{comment}',[CommentController::class,'destroy']) -> name('comments.destroy');