<?php

use Illuminate\Support\Facades\Route0;

use App\Http\Controllers\PostController;

use App\Http\Controllers\CommentController;

// Load the admin route file
require base_path('routes/admin.php');

require base_path('routes/blog.php');

Route::get('/', function () {
    return view('welcome');
});


//there are two operation on database : 
//1- structure change for database (create table, edit column , remove column)
//2- operations on database (insert record , edit record , delete record) 

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
