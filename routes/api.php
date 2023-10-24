<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::post('register', 'UserAuthController@register');
    Route::post('login', 'UserAuthController@login');
    Route::post('update_pass', 'UserAuthController@updatePassword');
    Route::post('request_otp', 'UserAuthController@requestOtp');
    Route::post('verify_otp', 'EmailVerificationController@verifyOtp');
    Route::get('admin_values', 'UserAuthController@adminValuesList');
    Route::apiResource('transfer_methods_values', TransferMethodsValuesController::class);
    });
    Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers', 'middleware' => 'auth:sanctum'], function(){
     
        Route::get('transactions_list', 'TransactionsController@list');
        Route::post('add_transaction', 'TransactionsController@add');

        Route::get('user_info', 'UserController@getUserInfo');
        Route::post('logout', 'UserAuthController@logout');
    });
