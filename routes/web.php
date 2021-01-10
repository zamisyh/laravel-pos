<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsersController;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

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
    return view('welcome');
});



Route::group(['prefix' => 'admin'], function () {
    Route::name('admin.')->group(function() {
        Route::group(['prefix' => 'auth'], function () {
            Route::get('login', [AuthController::class, 'logView'])->name('auth.logView');
            Route::get('register', [AuthController::class, 'regView'])->name('auth.regView');
            Route::post('process-login', [AuthController::class, 'actionLogin'])->name('auth.action');

        });

        Route::group(['middleware' => 'auth'], function () {
           Route::get('/', [HomeController::class, 'index'])->name('home');
           Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

           Route::resource('category', CategoryController::class);
           Route::resource('users', UsersController::class);

           //Settings
           Route::group(['prefix' => 'setting'], function () {
                Route::name('setting.')->group(function() {
                    Route::get("password/{id}", [SettingsController::class, 'homeChangePassword'])->name('home.password');
                    Route::patch("password/{id}", [SettingsController::class, 'postChangePassword'])->name('post.password');
                });
            });
        });
    });


});

