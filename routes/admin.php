<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NewsController;
Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){

    Route::get('kk', function () {
        return view('welcome');
    });
    
    Route::get('test1/{id}',function($id){
        return $id;
    }) -> name("a");
    
    Route::get('test2/{id?}',function(){
        return 'welcome';
    }) -> name("b")->middleware('auth');

    
});
Route::resource('news',NewsController::class);
Route::get('test1',function(){
    return view('landing');
}) -> name("a");
