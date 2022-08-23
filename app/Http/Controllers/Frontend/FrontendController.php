<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Admin\Helper\CommonHelperController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Helper\HelperController;
use Illuminate\Http\Request;
use Socialite;
use Exception;

class FrontendController extends Controller
{
    public function HomePage(){
        $whyWe = getActiveRecord('whywe');
        $trainingCenter = HelperController::GetHomeTrainingCenter();
        $main = CommonHelperController::getHomeCareerBuildMain();
        $careerBuild = CommonHelperController::getHomeCareerBuild();
        if(count($trainingCenter)){
            foreach ($trainingCenter as $k => $training){
                $trainingContent = HelperController::GetHomeTrainingCenterContent($training->training_center_id);
                if(count($trainingContent)){
                    $training->content = $trainingContent;
                }else{
                    unset($trainingCenter[$k]);
                }
            }
        }
//        echo '<pre>';
//        print_r($trainingCenter);
//        exit;
        return view('frontend.home', compact('trainingCenter','whyWe','main','careerBuild'));
    }

    public function UserDashboard(Request $request){
        return view('frontend.users.userdashboard');
    }

    public function SocialMedia($social){
        return Socialite::driver($social)->redirect();
    }

    public function EmailVerification(){
        return view('frontend.email_verification');
    }

    public function EmailVerificationSuccess(){
        return view('frontend.email_verification_success');
    }

    public function MobileVerification(){
        return view('frontend.mobile_verification');
    }

    public function MobileVerificationSuccess(){
        return view('frontend.mobile_verification_success');
    }

    public function JobsDetails(Request $request){
        return view('frontend.jobsdetails');
    }

    public function MyCourseandService(Request $request){
        return view('frontend.mycourse_service');
    }

    public function UserLogout(Request $request)
    {
        $request->session()->forget('frontend_useremail');
        $request->session()->forget('frontend_userid');
        return redirect(FRONTENDURL);
    }
}
