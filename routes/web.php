<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
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

Route::middleware(['globalvalidate'])->group(function () {
    Route::get('/', function () { return view('welcome'); });

    Route::prefix(ADMINURL)->group(function () {
        Route::middleware(['adminlogin'])->group(function () {
            Route::get('/', function () { return view('admin.login'); });
        });
        Route::middleware(['adminloginvalidate  '])->group(function () {
            Route::get('/dashboard', [AdminController::class, 'Dashboard']);
        });
    });

});
