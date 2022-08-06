<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\SocialMediaController;
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
    Route::get('/login', function () { return view('frontend.login'); })->name('login');
    Route::get('/register', function () { return view('frontend.register'); })->name('register');

    Route::get('/login/{social}',[FrontendController::class, 'SocialMedia'])
        ->where('social','google|linkedin');
    Route::get('/login/{social}/callback',[SocialMediaController::class, 'handleProviderCallback'])
        ->where('social','google|linkedin');

    Route::prefix(ADMINURL)->group(function () {
        Route::middleware(['adminlogin'])->group(function () {
            Route::get('/', function () { return view('admin.signin'); });
            Route::post('/admin_authenticate', [AdminController::class, 'AdminAuthenticate']);
            Route::get('/login/{social}',[AdminController::class, 'SocialMedia'])
                ->where('social','google|linkedin');
        });
         Route::middleware(['adminloginvalidate'])->group(function () {
            Route::get('/analysisdashboard', [AdminController::class, 'AnalysisDashboard'])->name('analysisdashboard');
            Route::get('/salesdashboard', [AdminController::class, 'SalesDashboard'])->name('saledashboard');
            Route::get('/social_media_links', [AdminController::class, 'SocialMediaLinks'])->name('socialmedia');
            Route::post('/save_social_media_links', [AdminController::class, 'SaveSocialMediaLinks'])->name('savesocialmedia');
            Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('logout');

         });
    });

});
