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
    public function HomePage()
    {
        $whyWe = getActiveRecord('whywe');
        $trainingCenter = HelperController::GetHomeTrainingCenter();
        $main = CommonHelperController::getHomeCareerBuildMain();
        $careerBuild = CommonHelperController::getHomeCareerBuild();
        if (count($trainingCenter)) {
            foreach ($trainingCenter as $k => $training) {
                $trainingContent = HelperController::GetHomeTrainingCenterContent($training->training_center_id);
                if (count($trainingContent)) {
                    $training->content = $trainingContent;
                } else {
                    unset($trainingCenter[$k]);
                }
            }
        }
        //        echo '<pre>';
        //        print_r($trainingCenter);
        //        exit;
        return view('frontend.home', compact('trainingCenter', 'whyWe', 'main', 'careerBuild'));
    }

    public function UserDashboard(Request $request)
    {
        $userInfo = HelperController::getUserInfo($request->session()->get('frontend_userid'));
        return view('frontend.users.userdashboard', compact('userInfo'));
    }

    public function ProfileCreation(Request $request)
    {
        $userInfo = HelperController::getUserCompleteProfileInfo($request->session()->get('frontend_userid'));
        $currentEmployment = HelperController::getUserCurrentEmployment($request->session()->get('frontend_userid'));
        return view('frontend.users.profile_creation', compact('userInfo','currentEmployment'));
    }


    public function DownloadResume(Request $request)
    {
        try {
            $userId = $request->session()->get('frontend_userid');
            $userInfo = HelperController::getUserInfo($userId);
            $profileInfo = HelperController::getUserProfile($userId);
            if (count($profileInfo) && $profileInfo[0]->user_resume != '') {
                $file_path = public_path('uploads/users/resume/' . $profileInfo[0]->user_resume);
                $type = $profileInfo[0]->user_resume_format;
                $resumeName = $userInfo[0]->user_firstname.'_'.$userInfo[0]->user_lastname.'_MechCareer.'.$type;
                $headers = array('Content-Type' => 'application/' . $type);
                return response()->download($file_path, $resumeName, $headers);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again');
        }
        return back()->with('error', 'Something went wrong. Please try again');
    }

    public function DeleteEmployment($id)
    {
        try {
            $employmentId = decryption($id);
            $employmentInfo = HelperController::getEmployment($employmentId);
            if (count($employmentInfo)) {
                deleteQuery($employmentId, 'user_employment', 'user_employment_id');
                return back()->with('success', 'Employment Deleted Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again');
        }
    }

    public function DeleteEducation($id)
    {
        try {
            $educationId = decryption($id);
            $educationInfo = HelperController::getEducation($educationId);
            if (count($educationInfo)) {
                deleteQuery($educationId, 'user_education', 'user_education_id');
                return back()->with('success', 'Education Deleted Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again');
        }
    }

    public function DeleteITSkill($id)
    {
        try {
            $itskillId = decryption($id);
            $itSkillInfo = HelperController::getITSkill($itskillId);
            if (count($itSkillInfo)) {
                deleteQuery($itskillId, 'user_itskils', 'user_itskil_id');
                return back()->with('success', 'ITSkill Deleted Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again');
        }
    }

    public function DeleteCertification($id)
    {
        try {
            $certificationId = decryption($id);
            $data = HelperController::getCertification($certificationId);
            if (count($data)) {
                deleteQuery($certificationId, 'user_certification', 'user_certification_id');
                return back()->with('success', 'Certification Deleted Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again');
        }
    }







    public function EmailVerification()
    {
        return view('frontend.email_verification');
    }














    public function JobsDetails(Request $request)
    {
        return view('frontend.jobsdetails');
    }

    public function JobSearch(Request $request)
    {
        return view('frontend.jobseeker_job_search');
    }

    public function JobSearch1(Request $request)
    {
        return view('frontend.jobseeker_job_search1');
    }

    public function JobSearch2(Request $request)
    {
        return view('frontend.jobseeker_job_search2');
    }



    public function MyCourseandService(Request $request)
    {
        return view('frontend.mycourse_service');
    }

    public function MyCourseandVideo(Request $request)
    {
        return view('frontend.mycourse_video');
    }



    public function UserLogout(Request $request)
    {
        updateQuery('user_details', 'user_id', $request->session()->get('frontend_userid'), ['user_logged_in' => 2]);
        userLoginActivity(2);
        $request->session()->forget('frontend_useremail');
        $request->session()->forget('frontend_userid');
        return redirect(FRONTENDURL);
    }
}
