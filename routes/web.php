<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\User;


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

Route::get('save',  function() {
    return User::create([
        'email' => 'zam@gmail.com',
        'name' => 'zam',
        'password' => bcrypt('secret')
    ]);
});


Route::group(['prefix' => 'admin'], function () {
    Route::name('admin.')->group(function() {
        Route::group(['prefix' => 'auth'], function () {
            Route::get('login', [AuthController::class, 'logView'])->name('auth.logView');
            Route::get('register', [AuthController::class, 'regView'])->name('auth.regView');
            Route::post('process-login', [AuthController::class, 'actionLogin'])->name('auth.action');
            Route::post('process-signup', [AuthController::class, 'actionSignup'])->name('auth.action.signup');
        });
    });
});

