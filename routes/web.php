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
    Route::get('/', [FrontendController::class, 'HomePage'])->name('home');
    Route::get('/home', function () { return view('frontend.home'); });
    Route::get('/jobseeker_login', function () { return view('frontend.jobseeker.login'); })->name('jobseekerlogin');
    Route::get('/jobseeker_register', function () { return view('frontend.jobseeker.register'); })->name('jobseekerregister');
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

            Route::get('/change_password', [AdminController::class, 'ChangePassword'])->name('changepassword');
            Route::post('/update_password', [AdminController::class, 'UpdatePassword'])->name('updatepassword');

            Route::get('/view_admin', [AdminController::class, 'ViewAdmin'])->name('admin');
            Route::get('/create_admin', [AdminController::class, 'ManageAdmin'])->name('manageadmin');
            Route::get('/action_admin/{option}/{id}', [AdminController::class, 'ActionAdmin'])->name('actionadmin');
            Route::post('/save_admin', [AdminController::class, 'SaveAdminDetails'])->name('saveadmin');

            Route::get('/social_media_links', [AdminController::class, 'SocialMediaLinks'])->name('socialmedia');
            Route::post('/save_social_media_links', [AdminController::class, 'SaveSocialMediaLinks'])->name('savesocialmedia');
            Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('logout');

         });
    });

});
