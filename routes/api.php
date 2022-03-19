<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//users list nd store api
Route::get("/users-list", [UsersController::class, 'userlist'])->name('users');
Route::post('/register', [UsersController::class, 'registeruser'])->name('register');

//next api
Route::controller(UsersController::class)->group(function(){
    Route::group(['prefix'=>'products'], function(){
        Route::group(['prefix'=>'product'], function(){
            Route::get('/','products');
        });
    });      
});