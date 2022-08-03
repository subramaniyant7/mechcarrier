<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Frontend\FrontendController;
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
    Route::get('/home', function () { return view('frontend.home'); });

    Route::get('/login/{social}',[FrontendController::class, 'SocialMedia'])
        ->where('social','google|linkedin');
    Route::get('/login/{social}/callback',[FrontendController::class, 'handleProviderCallback'])
        ->where('social','google|linkedin');

    Route::prefix(ADMINURL)->group(function () {
        Route::middleware(['adminlogin'])->group(function () {
            Route::get('/', function () { return view('admin.login'); });
        });
        // Route::middleware(['adminloginvalidate'])->group(function () {
            Route::get('/analysisdashboard', [AdminController::class, 'AnalysisDashboard']);
            Route::get('/salesdashboard', [AdminController::class, 'SalesDashboard']);
        // });
    });

});
