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
    public function HomePage(Request $request)
    {
        if($request->session()->get('employer_id') != '') return redirect()->route('employerdashboard');
        if($request->session()->get('frontend_userid') != '') return redirect()->route('userdashboard');

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
        $data = [];
        $userInfo = HelperController::getUserInfo($request->session()->get('frontend_userid'));

        $userCurrentEmployment = HelperController::getUserCurrentEmployment($request->session()->get('frontend_userid'));

        $userProfile = HelperController::getUserProfile($request->session()->get('frontend_userid'));

        $userKeySkilInfo = HelperController::getUserKeySkilByUserId($request->session()->get('frontend_userid'));
        // echo '<pre>';
        // print_r($userKeySkilInfo);
        // Stop($filterRequest);
        $limit = 8;
        if(count($userKeySkilInfo)){
            foreach($userKeySkilInfo as $skil){
                $skilJob = HelperController::GetUserSkilBasedJobs($skil->user_key_skil_text, $limit);
                if(count($skilJob)){
                    $jobData = json_decode(json_encode($skilJob),true);
                    array_push($data,$jobData);
                }
            }
        }

        // echo '<pre>';
        // print_r($userCurrentEmployment);
        // print_r($data);

        // exit;

        // Stop($data);
        if(count($data)) $data = $data[0];
        return view('frontend.users.userdashboard', compact('userCurrentEmployment','userProfile','data','userInfo'));
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














    public function JobsDetails(Request $request, $id)
    {
        try{
            $postId = decryption($id);
            $postInfo = HelperController::getJobPostById($postId);
            if(count($postInfo)){
                return view('frontend.jobsdetails', compact('postInfo'));
            }
            return redirect()->route('jobsearch');
        }catch(\Exception $e){

        }

    }

    public function JobSearch(Request $request)
    {
        return view('frontend.jobseeker_job_search');
    }

    public function JobseekerHomeJobSearch(Request $request){
        $filterRequest = $request->all();
        if($filterRequest['current_city_id'] !=''){
            $filterRequest['location'] = $filterRequest['current_city_id'];
            unset($filterRequest['current_city_id']);
        }

        return redirect('job_search'.'?skil='.$filterRequest['skil'].'&location='.$filterRequest['location']);
        // Stop(json_encode($filterRequest));
        // Stop($filterRequest);

    }

    public function JobseekerSavesJobs(Request $request)
    {
        $savedJobs = HelperController::mySavedPostExist($request->session()->get('frontend_userid'));
        return view('frontend.jobseeker_saved_jobs', compact('savedJobs'));
    }



    public function SaveJob(Request $request)
    {
        try{
            $postId = decryption($request->input('post_id'));
            $checkPostExist = HelperController::checkUserSavedPostExist($request->session()->get('frontend_userid'),$postId);
            if(!count($checkPostExist)){
                $formData = ['user_id' => $request->session()->get('frontend_userid'), 'user_saved_post_id' => $postId,
                'user_saved_on' => date('Y-m-d')];
                $saveData = insertQuery('user_saved_jobs', $formData);
                $notify = notification($saveData);
                return redirect()->route('mysavedjobs')->with($notify['type'], $notify['msg']);
            }
        }catch(\Exception $e){
            return redirect()->route('jobsearch')->with('error','Something went wrong');
        }

    }

    public function JobseekerJobSearch(Request $request)
    {
        $data = [];
        $filterRequest = $request->all();
        $userKeySkilInfo = HelperController::getUserKeySkilByUserId($request->session()->get('frontend_userid'));
        // echo '<pre>';
        // print_r($userKeySkilInfo);
        // Stop($filterRequest);

        $limit = 8;
        if(!count($filterRequest)){
            if(count($userKeySkilInfo)){
                foreach($userKeySkilInfo as $skil){
                    $skilJob = HelperController::GetUserSkilBasedJobs($skil->user_key_skil_text, $limit);
                    if(count($skilJob)){
                        $jobData = json_decode(json_encode($skilJob),true);
                        array_push($data,$jobData);
                    }
                }
            }
        }else{
            $filterRequest = $request->all();

            if(isset($filterRequest['current_city_id']) && $filterRequest['current_city_id'] !=''){
                $filterRequest['location'] = $filterRequest['current_city_id'];
                unset($filterRequest['current_city_id']);
            }

            if(array_key_exists('skil',$filterRequest) && $filterRequest['skil'] != ''){
                $filterQuery['employer_post_key_skils'] = $filterRequest['skil'];
            }

            if(array_key_exists('location',$filterRequest) && $filterRequest['location'] != '' ){
                $filterQuery['employer_post_location_city'] = $filterRequest['location'];
            }

            if(array_key_exists('jobtype',$filterRequest) && $filterRequest['jobtype'] != ''){
                $filterQuery['employer_post_job_type'] = $filterRequest['jobtype'];
            }

            if(array_key_exists('emptype',$filterRequest) && $filterRequest['emptype'] != ''){
                $filterQuery['employer_post_employement_type'] = $filterRequest['emptype'];
            }

            if(array_key_exists('walkin',$filterRequest) && $filterRequest['walkin'] == 1){
                $filterQuery['employer_post_walkin'] = $filterRequest['walkin'];
            }

            if(array_key_exists('post_range',$filterRequest) && $filterRequest['post_range'] != ''){
                $from = date('Y-m-d', strtotime('-'.$filterRequest['post_range'].' days'));
                $filterQuery['employer_post_published_on'] = ['from' => $from, 'to' => date('Y-m-d')];
            }

            if(array_key_exists('type',$filterRequest) && $filterRequest['type'] != ''){
                $filterQuery['employer_post_employmenttype'] = $filterRequest['type'];
            }

            if(array_key_exists('salary',$filterRequest) && $filterRequest['salary'] != ''){
                $from = $to = '';
                $salaryRange = salaryRange()[$filterRequest['salary']-1];
                if($salaryRange != '') {
                    $range = explode("-", $salaryRange);
                    if(count($range) == 2){
                        $from = trim($range[0]);
                        $to = trim($range[1]);
                    }
                }
                $filterQuery['employer_post_salary_range'] = ['from' => $from, 'to' => $to];
            }

            if(array_key_exists('experience',$filterRequest) && $filterRequest['experience'] != ''){
                $from = $to = '';
                $experienceRange = experienceGap()[$filterRequest['experience']-1];
                if($experienceRange != '') {
                    $range = explode("-", $experienceRange);
                    if(count($range) == 2){
                        $from = trim($range[0]);
                        $to = trim($range[1]);
                    }
                }
                $filterQuery['employer_post_experience_range'] = ['from' => $from, 'to' => $to];
            }

            if(array_key_exists('education',$filterRequest) && $filterRequest['education'] != ''){
                $filterQuery['employer_post_qualification'] = $filterRequest['education'];
            }

            if(array_key_exists('industry',$filterRequest) && $filterRequest['industry'] != ''){
                $filterQuery['employer_post_industry_type'] = $filterRequest['industry'];
            }

            if(array_key_exists('department',$filterRequest) && $filterRequest['department'] != ''){
                $filterQuery['employer_post_department'] = $filterRequest['department'];
            }


            // Stop($filterRequest);
            $searchSkil = HelperController::getFilterJob($filterQuery, 10);

            // Stop($searchSkil);
            if(count($searchSkil)){
                array_push($data,json_decode(json_encode($searchSkil),true));
            }

        }

        // $data = json_decode(json_encode($data), FALSE);

        // if($request->input('skil') != ''){
        //     $location = $request->input('location');
        //     $searchSkil = HelperController::GetUserSearchJobs($request->input('skil'),$request->input('location'),$request->input('experience'), $limit);
        //     if(count($searchSkil)){
        //         array_push($data,json_decode(json_encode($searchSkil),true));
        //     }
        // }

        if(count($data)) $data = $data[0];

        // Stop($data);
        return view('frontend.jobseeker.job_search', compact('data'));
    }

    public function JobSearch2(Request $request)
    {
        return view('frontend.jobseeker_saved_jobs');
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
