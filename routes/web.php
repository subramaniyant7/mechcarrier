<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WebpageContent\BannerContentController;
use App\Http\Controllers\Admin\WebpageContent\CompanyManagementController;
use App\Http\Controllers\Admin\WebpageContent\HomePageTrainingCenterController;
use App\Http\Controllers\Admin\WebpageContent\WhyWeController;
use App\Http\Controllers\Admin\WebpageContent\CareerBuildController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\AjaxController as FAjaxController;
use App\Http\Controllers\Frontend\JobseekerController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\AjaxController;

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

    Route::get('/jobsdetails', [FrontendController::class, 'JobsDetails'])->name('jobsdetails');
    Route::get('/job_search', [FrontendController::class, 'JobSearch'])->name('jobsearch');
    Route::get('/mycourse_services', [FrontendController::class, 'MyCourseandService'])->name('mycourseservice');
    Route::get('/mycourse_video', [FrontendController::class, 'MyCourseandVideo'])->name('mycoursevideo');

    Route::get('/sendemail', [JobseekerController::class, 'SendEmail'])->name('sendemail');
    Route::get('/sendsms', [JobseekerController::class, 'SendSMS'])->name('sendsms');

    Route::middleware(['userlogin'])->group(function () {
        Route::get('/jobseeker_login', function () { return view('frontend.jobseeker.login'); })->name('jobseekerlogin');
        Route::post('/jobseeker_loginvalidate', [JobseekerController::class, 'JobseekerValidate'])->name('jobseekervalidate');
        Route::get('/jobseeker_register', function () { return view('frontend.jobseeker.register'); })->name('jobseekerregister');
        Route::post('/jobseeker_registration', [JobseekerController::class, 'JobseekerRegister'])->name('jobseekerregistration');

        Route::get('/email_verification/{id}', [JobseekerController::class, 'EmailVerification'])->name('emailverification');
        Route::post('/email_verification_success', [JobseekerController::class, 'EmailVerificationSuccess'])->name('emailverificationsuccess');

        Route::post('/resendemailotp', [FAjaxController::class, 'ResendEmailOTP'])->name('resendemailotp');
        Route::post('/updateemail', [FAjaxController::class, 'UpdateEmailAddress'])->name('updateuseremail');

        Route::post('/mobile_verification', [JobseekerController::class, 'MobileVerification'])->name('mobileverification');
        Route::get('/mobile_otpverification/{id}', [JobseekerController::class, 'MobileOTPVerification'])->name('mobileotpverification');

        Route::post('/resendmobileotp', [FAjaxController::class, 'ResendMobileOTP'])->name('resendmobileotp');
        Route::post('/updatemobile', [FAjaxController::class, 'UpdateMobileAddress'])->name('updateusermobile');

        Route::post('/mobile_verification_success', [JobseekerController::class, 'MobileVerificationSuccess'])->name('mobileverificationsuccess');

        Route::post('/redirecttodashboard', [FAjaxController::class, 'RedirectToDashboard'])->name('redirecttodashboard');

        Route::get('/login', function () { return view('frontend.login'); })->name('login');
        Route::get('/register', function () { return view('frontend.register'); })->name('register');
    });


    Route::middleware(['userloginvalidate'])->group(function () {
        Route::get('/user_dashboard', [FrontendController::class, 'UserDashboard'])->name('userdashboard');
        Route::get('/user_logout', [FrontendController::class, 'UserLogout'])->name('userlogout');
    });

    Route::get('/login/{social}',[SocialMediaController::class, 'SocialMedia'])->where('social','google|linkedin');
    Route::get('/login/{social}/callback',[SocialMediaController::class, 'handleProviderCallback'])->where('social','google|linkedin');

    Route::prefix(ADMINURL)->group(function () {
        Route::middleware(['adminlogin'])->group(function () {
            Route::get('/', function () { return view('admin.signin'); });
            Route::post('/admin_authenticate', [AdminController::class, 'AdminAuthenticate']);
            Route::get('/login/{social}',[AdminController::class, 'SocialMedia'])->where('social','google|linkedin');
        });
         Route::middleware(['adminloginvalidate'])->group(function () {
            Route::get('/analysisdashboard', [AdminController::class, 'AnalysisDashboard'])->name('analysisdashboard');
            Route::get('/salesdashboard', [AdminController::class, 'SalesDashboard'])->name('saledashboard');

            Route::get('/change_password', [AdminController::class, 'ChangePassword'])->name('changepassword');
            Route::post('/update_password', [AdminController::class, 'UpdatePassword'])->name('updatepassword');

            Route::get('/view_users', [UserController::class, 'ViewUser'])->name('viewusers');
            Route::get('/create_user', [UserController::class, 'ManageUser'])->name('manageuser');
            Route::get('/action_user/{option}/{id}', [UserController::class, 'ActionUser'])->name('actionuser');
            Route::post('/save_user', [UserController::class, 'SaveUserDetails'])->name('saveuser');


            Route::get('/view_admin', [AdminController::class, 'ViewAdmin'])->name('admin');
            Route::get('/create_admin', [AdminController::class, 'ManageAdmin'])->name('manageadmin');
            Route::get('/action_admin/{option}/{id}', [AdminController::class, 'ActionAdmin'])->name('actionadmin');
            Route::post('/save_admin', [AdminController::class, 'SaveAdminDetails'])->name('saveadmin');

            // Mixed Content Save
            Route::post('/save_mixed_content', [AdminController::class, 'SaveMixedContent'])->name('savemixedcontent');

            // Website Banner Content
            Route::get('/banner_content', [BannerContentController::class, 'GetBannerContent'])->name('bannnercontent');
            Route::post('/save_banner_content', [BannerContentController::class, 'SaveBannerContent'])->name('savebannnercontent');

            // Website Company Content
            Route::get('/view_mapped_company', [CompanyManagementController::class, 'GetCompanyDetails'])->name('viewcompany');
            Route::get('/create_company_mapping', [CompanyManagementController::class, 'ManageCompanyMapping'])->name('managecompanymapping');
            Route::get('/get_company_mapping_content', [AjaxController::class, 'CompanyHtmlRender'])->name('getcompanyhtml');
            Route::get('/action_company_mapping/{option}/{id}', [CompanyManagementController::class, 'ActionCompanyMapping'])->name('actioncompanymapping');
            Route::post('/save_company_mapping', [CompanyManagementController::class, 'SaveCompanyMapping'])->name('savecompanymapping');

            // Website Career Build
            Route::get('/view_careerbuild', [CareerBuildController::class, 'ViewCareerBuild'])->name('viewcareerbuild');
            Route::get('/create_careerbuild', [CareerBuildController::class, 'ManageCareerBuild'])->name('managecareerbuild');
            Route::get('/action_careerbuild/{option}/{id}', [CareerBuildController::class, 'ActionCareerBuild'])->name('actioncareerbuild');
            Route::post('/save_careerbuild', [CareerBuildController::class, 'SaveCareerBuild'])->name('savecareerbuild');
            Route::post('/save_careerbuildmain', [CareerBuildController::class, 'SaveCareerBuildMain'])->name('savecareerbuildmain');

            // Website Why We Content
            Route::get('/view_whywe', [WhyWeController::class, 'ViewWhyWe'])->name('viewwhywe');
            Route::get('/create_whywe', [WhyWeController::class, 'ManageWhyWe'])->name('managewhywe');
            Route::get('/action_whywe/{option}/{id}', [WhyWeController::class, 'ActionWhyWe'])->name('actionwhywe');
            Route::post('/save_whywe', [WhyWeController::class, 'SaveWhyWe'])->name('savewhywe');

            // Website Training Center
            Route::get('/view_home_training_center', [HomePageTrainingCenterController::class, 'GetTrainingCenters'])->name('viewtrainingcenter');
            Route::get('/create_home_training_center', [HomePageTrainingCenterController::class, 'ManageTrainingCenter'])->name('managetrainingcenter');
            Route::get('/action_home_training_center/{option}/{id}', [HomePageTrainingCenterController::class, 'ActionTrainingCenter'])->name('actiontrainingcenter');
            Route::post('/save_home_training_center', [HomePageTrainingCenterController::class, 'SaveTrainingCenter'])->name('savetrainingcenter');

            // Website Training Center Content
            Route::get('/view_training_center_contents/{id}', [HomePageTrainingCenterController::class, 'ViewSpecificTraning'])->name('viewspecifictrainingcentercontent');
            Route::get('/create_home_training_center_content/{id}', [HomePageTrainingCenterController::class, 'ManageTrainingCenterContent'])->name('managetrainingcentercontent');
            Route::get('/action_home_training_center_content/{centerid}/{option}/{id}', [HomePageTrainingCenterController::class, 'ActionTrainingCenterContent'])->name('actiontrainingcentercontent');
            Route::post('/save_home_training_center_content', [HomePageTrainingCenterController::class, 'SaveTrainingCenterContent'])->name('savetrainingcentercontent');

            // Website Social Media Links
            Route::get('/social_media_links', [AdminController::class, 'SocialMediaLinks'])->name('socialmedia');
            Route::post('/save_social_media_links', [AdminController::class, 'SaveSocialMediaLinks'])->name('savesocialmedia');

            Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('logout');

         });
    });

});
