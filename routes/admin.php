<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Middleware;
use App\Models\User;
Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){

    Route::get('kk', function () {
        return view('welcome');
    });
    
   
    Route::get('test2/{id?}',function(){
        return 'welcome';
    }) -> name("b")->middleware('auth');

    
});
Route::get('test1/{id}',function($id){
    // Auth::logout($id);
    return $id;
    
}) -> name('a')->middleware(['auth']);

Route::resource('news',NewsController::class);
Route::get('test1',function(){
    $user = User::find(5);
    Auth::login($user);
    return to_route('a',$user->id);
}) -> name("v");
