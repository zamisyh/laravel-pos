<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Client\HomeController as HomeClient;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Client\CustomerController;
use App\Http\Controllers\Admin\CustomerController as CustomerAdmin;
use App\Http\Controllers\Admin\OrderController AS OrderAdmin;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Order;


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

//client route

Route::name('client.')->group(function() {
    Route::get('/', [HomeClient::class, 'index'])->name('home')->middleware('auth');


    Route::group(['prefix' => 'order'], function () {
        Route::get('product/{id}', [OrderController::class, 'orderDetails'])->name('order')->middleware('auth');

        Route::group(['middleware' => ['role:cashier', 'auth']], function () {
           Route::get('/{id}/checkout', [OrderController::class, 'checkout'])->name('checkout');
           Route::post('customer/add', [OrderController::class, 'addCustomer'])->name('add.customer');
           Route::post('checkout', [OrderController::class, 'storeOrder'])->name('store.order');

           Route::group(['prefix' => 'customer'], function () {
               Route::get('/', [CustomerController::class, 'index'])->name('customer');
               Route::get('import/pdf/{id}', [CustomerController::class, 'invoicePdf'])->name('import.pdf');
               Route::get('import/excel/{id}', [CustomerController::class, 'invoiceExcel'])->name('import.excel');
            });
        });
    });
});


//end client


//admin route
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

            Route::resource('customer', CustomerAdmin::class);

            Route::group(['middleware' => ['role:cashier|admin']], function () {
                Route::resource('category', CategoryController::class);
                Route::resource('product', ProductController::class);
                Route::resource('order', OrderAdmin::class);
            });

           //Role Manajemen
           Route::group(['middleware' => ['role:admin']], function () {
                Route::resource('users', UsersController::class);
                Route::resource('/role', RoleController::class)->except([
                    'create', 'show', 'edit', 'update',
                ]);

                Route::group(['prefix' => 'role'], function () {
                    Route::get('role-permission', [UsersController::class, 'rolePermission'])->name('role_permission');
                    Route::post('add_permission', [UsersController::class, 'addPermission'])->name('add_permission');
                    Route::patch('permission/{role}', [UsersController::class, 'setRolePermission'])->name('set_role_permission');
                    Route::get('set/{id}', [UsersController::class, 'roles'])->name('role_set');
                    Route::patch('set/{id}', [UsersController::class, 'setRole'])->name('setRole');
                });
           });

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

