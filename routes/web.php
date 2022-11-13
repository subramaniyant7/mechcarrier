<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EducationInfoController;
use App\Http\Controllers\Admin\CourseBoardController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\EmployerController as AdminEmployerController;
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
use App\Http\Controllers\Frontend\EmployerController;

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
    Route::get('/home', function () {
        return view('frontend.home');
    });

    Route::get('/jobsdetails', [FrontendController::class, 'JobsDetails'])->name('jobsdetails');
    Route::get('/job_search', [FrontendController::class, 'JobSearch'])->name('jobsearch');
    Route::get('/job_search1', [FrontendController::class, 'JobSearch1'])->name('jobsearch1');
    Route::get('/job_search2', [FrontendController::class, 'JobSearch2'])->name('jobsearch2');

    Route::get('/mycourse_services', [FrontendController::class, 'MyCourseandService'])->name('mycourseservice');
    Route::get('/mycourse_video', [FrontendController::class, 'MyCourseandVideo'])->name('mycoursevideo');

    Route::get('/sendemail', [JobseekerController::class, 'SendEmail'])->name('sendemail');
    Route::get('/sendsms', [JobseekerController::class, 'SendSMS'])->name('sendsms');

    Route::middleware(['userlogin'])->group(function () {
        Route::get('/jobseeker_login', function () {
            return view('frontend.jobseeker.login');
        })->name('jobseekerlogin');
        Route::post('/jobseeker_loginvalidate', [JobseekerController::class, 'JobseekerValidate'])->name('jobseekervalidate');
        Route::get('/jobseeker_register', function () {
            return view('frontend.jobseeker.register');
        })->name('jobseekerregister');
        Route::post('/jobseeker_registration', [JobseekerController::class, 'JobseekerRegister'])->name('jobseekerregistration');

        Route::get('/email_verification/{id}', [JobseekerController::class, 'EmailVerification'])->name('emailverification');
        Route::post('/email_verification_success', [JobseekerController::class, 'EmailVerificationSuccess'])->name('emailverificationsuccess');

        Route::post('/resendemailotp', [FAjaxController::class, 'ResendEmailOTP'])->name('resendemailotp');
        Route::post('/updateemail', [FAjaxController::class, 'UpdateEmailAddress'])->name('updateuseremail');

        Route::get('/mobile_number/{id}', [JobseekerController::class, 'MobileNumber'])->name('mobilenumber');
        Route::post('/updatemobile_number', [JobseekerController::class, 'UpdateMobileNumber'])->name('updatemobilenumber');

        Route::get('/mobile_verification_redirect/{id}', [JobseekerController::class, 'MobileVerificationRedirect'])->name('mobileverificationredirect');
        Route::post('/mobile_verification', [JobseekerController::class, 'MobileVerification'])->name('mobileverification');
        Route::get('/mobile_otpverification/{id}', [JobseekerController::class, 'MobileOTPVerification'])->name('mobileotpverification');

        Route::post('/resendmobileotp', [FAjaxController::class, 'ResendMobileOTP'])->name('resendmobileotp');
        Route::post('/updatemobile', [FAjaxController::class, 'UpdateMobileAddress'])->name('updateusermobile');

        Route::post('/mobile_verification_success', [JobseekerController::class, 'MobileVerificationSuccess'])->name('mobileverificationsuccess');

        Route::post('/redirecttodashboard', [FAjaxController::class, 'RedirectToDashboard'])->name('redirecttodashboard');

        Route::get('/login', function () {
            return view('frontend.login');
        })->name('login');
        Route::get('/register', function () {
            return view('frontend.register');
        })->name('register');
    });

    Route::post('/getcity', [FAjaxController::class, 'GetCity'])->name('getcity');

    Route::middleware(['userloginvalidate'])->group(function () {
        Route::get('/user_dashboard', [FrontendController::class, 'UserDashboard'])->name('userdashboard');
        Route::get('/profile_creation', [FrontendController::class, 'ProfileCreation'])->name('profilecreation');
        Route::post('/upload_profile_picture', [FAjaxController::class, 'UpdateProfilePicture'])->name('uploadprofilepicture');
        Route::post('/upload_resume', [FAjaxController::class, 'UpdateResume'])->name('updateresume');

        Route::get('/download_resume', [FrontendController::class, 'DownloadResume'])->name('downloadresume');
        Route::post('/delete_resume', [FAjaxController::class, 'DeleteResume'])->name('deleteresume');
        Route::get('/getemploymenthtml', [FAjaxController::class, 'GetEmploymentHtml'])->name('getemploymenthtml');
        Route::get('/geteducationhtml', [FAjaxController::class, 'GetEducationHtml'])->name('geteducationhtml');
        Route::get('/getitskillhtml', [FAjaxController::class, 'GetItSkillHtml'])->name('getitskillhtml');
        Route::get('/getcertificationhtml', [FAjaxController::class, 'GetCertificationHtml'])->name('getcertificationhtml');
        Route::get('/getpersonaldetailhtml', [FAjaxController::class, 'GetPersonalDetailHtml'])->name('getpersonaldetailhtml');
        Route::post('/action_personaldetails_data', [FAjaxController::class, 'ActionPersonalData'])->name('actionpersonaldetailsdata');

        Route::get('/newlanguagehtml', [FAjaxController::class, 'GetNewLanguage'])->name('newlanguagehtml');

        Route::post('/action_education', [FAjaxController::class, 'ActionEducation'])->name('actioneducation');
        Route::get('/delete_education/{id}', [FrontendController::class, 'DeleteEducation'])->name('deleteeducation');

        Route::post('/action_itskill', [FAjaxController::class, 'ActionItSkill'])->name('actionitskill');
        Route::get('/delete_itskill/{id}', [FrontendController::class, 'DeleteITSkill'])->name('deleteitskill');


        Route::post('/action_certification', [FAjaxController::class, 'ActionCertification'])->name('actioncertification');
        Route::get('/delete_certification/{id}', [FrontendController::class, 'DeleteCertification'])->name('deletecertification');

        Route::post('/actioncurrentlocation', [FAjaxController::class, 'ActionCurrentLocation'])->name('actioncurrentlocation');
        Route::post('/getcompany', [FAjaxController::class, 'GetCompany'])->name('getcompany');
        Route::post('/getdesignation', [FAjaxController::class, 'GetDesignation'])->name('getdesignation');
        Route::post('/getspecialization', [FAjaxController::class, 'GetSpecialization'])->name('getspecialization');


        Route::post('/getuniversity', [FAjaxController::class, 'GetUniversity'])->name('getuniversity');

        Route::post('/action_employment', [FAjaxController::class, 'ActionEmployment'])->name('actionemployment');
        Route::get('/delete_employment/{id}', [FrontendController::class, 'DeleteEmployment'])->name('deleteemployment');

        Route::post('/update_resume_headline', [FAjaxController::class, 'UpdateResumeHeadline'])->name('updateresumeheadline');
        Route::post('/update_profile_summary', [FAjaxController::class, 'UpdateProfileSummary'])->name('updateprofilesummary');

        Route::post('/create_keyskils', [FAjaxController::class, 'CreateKeySkils'])->name('createkeyskils');
        Route::post('/delete_keyskils', [FAjaxController::class, 'DeleteKeySkils'])->name('deletekeyskils');

        Route::get('/user_logout', [FrontendController::class, 'UserLogout'])->name('userlogout');
    });

    // Employer
    Route::middleware(['employerNologgedIn'])->group(function () {
        Route::get('/employer_home', [EmployerController::class, 'EmployerHome'])->name('employerhome');
        Route::get('/employer_login', [EmployerController::class, 'EmployerLogin'])->name('employerlogin');
        Route::post('/employer_login_validate', [EmployerController::class, 'EmployerLoginValidate'])->name('employerloginvalidate');
        Route::get('/employer_register', [EmployerController::class, 'EmployerRegister'])->name('employerregister');
        Route::post('/employer_register', [EmployerController::class, 'EmployerRegisterProcess'])->name('employerregistersubmit');
        Route::get('/employer_verification', [EmployerController::class, 'EmployerVerification'])->name('employerverification');
    });

    Route::middleware(['employerloggedIn'])->group(function () {
        Route::get('/employer_dashboard', [EmployerController::class, 'EmployerDashboard'])->name('employerdashboard');
        Route::get('/employer_company', [EmployerController::class, 'EmployerCompanyAction'])->name('employercompany');
        Route::post('/save_employer_company', [EmployerController::class, 'SaveEmployerCompany'])->name('saveemployercompany');
        Route::middleware(['employerProfileValidate'])->group(function () {
            Route::get('/employer_jobpost', [EmployerController::class, 'EmployerJobPost'])->name('employerjobpost');
            Route::get('/save_employer_jobpost', [EmployerController::class, 'SaveEmployerJobPost'])->name('saveemployerjobpost');
        });
        Route::get('/employer_logout', [EmployerController::class, 'EmployerLogout'])->name('employerlogout');
    });

    // Social Media
    Route::get('/login/{social}', [SocialMediaController::class, 'SocialMedia'])->where('social', 'google|linkedin');
    Route::get('/login/{social}/callback', [SocialMediaController::class, 'handleProviderCallback'])->where('social', 'google|linkedin');


    // Admin
    Route::prefix(ADMINURL)->group(function () {
        Route::middleware(['adminlogin'])->group(function () {
            Route::get('/', function () {
                return view('admin.signin');
            });
            Route::post('/admin_authenticate', [AdminController::class, 'AdminAuthenticate']);
            Route::get('/login/{social}', [AdminController::class, 'SocialMedia'])->where('social', 'google|linkedin');
        });
        Route::middleware(['adminloginvalidate'])->group(function () {
            Route::get('/analysisdashboard', [AdminController::class, 'AnalysisDashboard'])->name('analysisdashboard');
            Route::get('/salesdashboard', [AdminController::class, 'SalesDashboard'])->name('saledashboard');

            Route::get('/change_password', [AdminController::class, 'ChangePassword'])->name('changepassword');
            Route::post('/update_password', [AdminController::class, 'UpdatePassword'])->name('updatepassword');

            // Education Info
            Route::get('/view_education', [EducationInfoController::class, 'ViewEducation'])->name('education');
            Route::get('/create_education', [EducationInfoController::class, 'ManageEducation'])->name('manageeducation');
            Route::get('/action_education/{option}/{id}', [EducationInfoController::class, 'ActionEducation'])->name('actioneducation');
            Route::post('/save_education', [EducationInfoController::class, 'SaveEducationDetails'])->name('saveeducation');

            // Course Board
            Route::get('/view_courseboard', [CourseBoardController::class, 'ViewCourseBoard'])->name('courseboard');
            Route::get('/create_courseboard', [CourseBoardController::class, 'ManageCourseBoard'])->name('managecourseboard');
            Route::get('/action_courseboard/{option}/{id}', [CourseBoardController::class, 'ActionCourseBoard'])->name('actioncourseboard');
            Route::post('/save_courseboard', [CourseBoardController::class, 'SaveCourseBoardDetails'])->name('savecourseboard');

            // Specialization
            Route::get('/view_specialization', [SpecializationController::class, 'ViewSpecialization'])->name('specialization');
            Route::get('/create_specialization', [SpecializationController::class, 'ManageSpecialization'])->name('managespecialization');
            Route::get('/action_specialization/{option}/{id}', [SpecializationController::class, 'ActionSpecialization'])->name('actionspecialization');
            Route::post('/save_specialization', [SpecializationController::class, 'SaveSpecializationDetails'])->name('savespecialization');

            // University
            Route::get('/view_university', [UniversityController::class, 'ViewUniversity'])->name('university');
            Route::get('/create_university', [UniversityController::class, 'ManageUniversity'])->name('manageuniversity');
            Route::get('/action_university/{option}/{id}', [UniversityController::class, 'ActionUniversity'])->name('actionuniversity');
            Route::post('/save_university', [UniversityController::class, 'SaveUniversityDetails'])->name('saveuniversity');

            // Grade
            Route::get('/view_grade', [GradeController::class, 'ViewGrade'])->name('grade');
            Route::get('/create_grade', [GradeController::class, 'ManageGrade'])->name('managegrade');
            Route::get('/action_grade/{option}/{id}', [GradeController::class, 'ActionGrade'])->name('actiongrade');
            Route::post('/save_grade', [GradeController::class, 'SaveGradeDetails'])->name('savegrade');

            // Country
            Route::get('/view_country', [CountryController::class, 'ViewCountry'])->name('country');
            Route::get('/create_country', [CountryController::class, 'ManageCountry'])->name('managecountry');
            Route::get('/action_country/{option}/{id}', [CountryController::class, 'ActionCountry'])->name('actioncountry');
            Route::post('/save_country', [CountryController::class, 'SaveCountryDetails'])->name('savecountry');

            // State
            Route::get('/view_state', [StateController::class, 'ViewState'])->name('state');
            Route::get('/create_state', [StateController::class, 'ManageState'])->name('managestate');
            Route::get('/action_state/{option}/{id}', [StateController::class, 'ActionState'])->name('actionstate');
            Route::post('/save_state', [StateController::class, 'SaveStateDetails'])->name('savestate');

            // City
            Route::get('/view_city', [CityController::class, 'ViewCity'])->name('city');
            Route::get('/create_city', [CityController::class, 'ManageCity'])->name('managecity');
            Route::get('/action_city/{option}/{id}', [CityController::class, 'ActionCity'])->name('actioncity');
            Route::post('/save_city', [CityController::class, 'SaveCityDetails'])->name('savecity');

            // Employers
            Route::get('/view_employers', [AdminEmployerController::class, 'ViewEmployers'])->name('viewemployers');
            Route::get('/create_employer', [AdminEmployerController::class, 'ManageEmployer'])->name('manageemployer');
            Route::get('/action_employer/{option}/{id}', [AdminEmployerController::class, 'ActionEmployer'])->name('actionemployer');
            Route::post('/save_employer', [AdminEmployerController::class, 'SaveEmployerDetails'])->name('saveemployer');


            // Users
            Route::get('/download_sample_file', [UserController::class, 'DownloadSampleFile'])->name('downloadsamplefile');
            Route::get('/import_users', [UserController::class, 'ImportUsers'])->name('importusers');
            Route::post('/import_users', [UserController::class, 'SaveImportUsers'])->name('saveimportusers');
            Route::get('/view_users', [UserController::class, 'ViewUser'])->name('viewusers');
            Route::get('/create_user', [UserController::class, 'ManageUser'])->name('manageuser');
            Route::get('/action_user/{option}/{id}', [UserController::class, 'ActionUser'])->name('actionuser');
            Route::post('/save_user', [UserController::class, 'SaveUserDetails'])->name('saveuser');

            // Admin
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



            // Industry
            Route::get('/view_industry', [IndustryController::class, 'ViewIndustry'])->name('viewindustry');
            Route::get('/create_industry', [IndustryController::class, 'ManageIndustry'])->name('manageindustry');
            Route::get('/action_industry/{option}/{id}', [IndustryController::class, 'ActionIndustry'])->name('actionindustry');
            Route::post('/save_industry', [IndustryController::class, 'SaveIndustry'])->name('saveindustry');

            // Department
            Route::get('/view_department', [DepartmentController::class, 'ViewDepartment'])->name('viewdepartment');
            Route::get('/create_department', [DepartmentController::class, 'ManageDepartment'])->name('managedepartment');
            Route::get('/action_department/{option}/{id}', [DepartmentController::class, 'ActionDepartment'])->name('actiondepartment');
            Route::post('/save_department', [DepartmentController::class, 'SaveDepartment'])->name('savedepartment');

            // Department
            Route::get('/view_designation', [DesignationController::class, 'ViewDesignation'])->name('viewdesignation');
            Route::get('/create_designation', [DesignationController::class, 'ManageDesignation'])->name('managedesignation');
            Route::get('/action_designation/{option}/{id}', [DesignationController::class, 'ActionDesignation'])->name('actiondesignation');
            Route::post('/save_designation', [DesignationController::class, 'SaveDesignation'])->name('savedesignation');


            // Website Social Media Links
            Route::get('/social_media_links', [AdminController::class, 'SocialMediaLinks'])->name('socialmedia');
            Route::post('/save_social_media_links', [AdminController::class, 'SaveSocialMediaLinks'])->name('savesocialmedia');

            Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('logout');
        });
    });
});
