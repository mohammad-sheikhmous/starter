<?php

use Illuminate\Support\Facades\Route0;

use App\Http\Controllers\PostController;

use App\Http\Controllers\CommentController;

Route::get('/blog/login',[PostController::class,'signIn']) -> name('login.signIn');

Route::get('/blog/login/check',[PostController::class,'check']) -> name('login.check');

Route::group(['prefix'=>LaravelLocalization::setlocale()],function(){
    
    Route::group(['prefix'=>'blog/{user_id}/posts','middleware' => ['localeSessionRedirect','localeViewPath','localizationRedirect']],function(){
        
        Route::get('',[PostController::class,'index'])-> name('posts.index');

        Route::get('/create',[PostController::class,'create']) -> name('posts.create');

        Route::get('/{post}/edit',[PostController::class,'edit']) -> name('posts.edit');

        Route::delete('/{post}',[PostController::class,'destroy']) -> name('posts.destroy');

        Route::get('/{post}',[PostController::class,'show']) -> name('posts.show');

        Route::post('/',[PostController::class,'store']) -> name('posts.store');

        Route::put('/{post}',[PostController::class,'update']) -> name('posts.update');

        Route::post('/comments/{post_id}',[CommentController::class,'store'])-> name('comments.store');
    });
});

Route::put('/blog/posts/comments/{comment}',[CommentController::class,'update'])->name('comments.update');

Route::delete('/blog/posts/comments/{comment}',[CommentController::class,'destroy']) -> name('comments.destroy');