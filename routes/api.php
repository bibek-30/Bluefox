<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SubCategoryCotroller;
use App\Http\Controllers\CategoryController;
use GuzzleHttp\Promise\Create;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::controller(OrderController::class)->group(function (){
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/order', 'create');
    Route::get('/{user_id}/order', 'show');
    Route::get('/list',  'index');
    Route::delete('/order/{id}/delete/}', 'destroy');
    Route::put('/order/{id}','update');

});
});

Route::controller(UserController::class)->group(function () {
    // Signup and Login
    Route::post('/admin/signup', 'createAdmin');
    Route::post('/signup', 'create');
    Route::post('/login', 'login')->name('login');
    // Forgot Password
    // Route::post('/password/forgot', 'sendResetLink');
    // after clicking button in mail
    // Route::get('/password/forgot/form/{token}', 'resetForm')->name('passwordResetForm');
    // Route::post('/password/reset/{token}', 'resetPassword')->name('rPassword');
    // Route::get('/resetSuccess', 'resetSuccess')->name('resetSuccess');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/admin/user', 'index');
        Route::get('/admin/user/{id}', 'show');
        Route::put('/admin/user/{id}/update', 'update');
        Route::delete('/admin/user/{id}/delete', 'destroy');
        Route::get('/profile', 'profile');
        Route::put('/profile/update', 'updateProfile');
        Route::delete('/profile/delete', 'profileDelete');
        Route::post('/profile/change-password', 'changepassword');
    });
});

Route::controller(SettingController::class)->group(function () {
    Route::group(['middleware' => 'auth:sanctum'], function () {
        // Setting Section
        Route::get('/about', 'create');
        Route::get('/about/show','index');
        Route::put('/about/{id}/update',  'update');
    });
});

Route::controller(CategoryController::class)->group( function(){

    Route::get('/category/add','create')->name('category.create');
    Route::get('/cat','index');
    Route::get('/cat/sub','subcategory');
    Route::delete('/cat/delete/{id}','destroy');

    // Route::get('/cat/show','show')->name('category.store');
    Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/admin/category/{id}', 'editCategory');
    Route::post('/admin/sub/{id}', 'update');

    //     // Route::get('/category/add','create')->name('category.create');
    });
});

// Route::controller(SubCategoryCotroller::class)->group( function(){
//     Route::group(['middleware' => 'auth:sanctum'], function () {
//         Route::get('/addSubCat','create');
//         Route::get('/cat/show','index');
//     });
// });
