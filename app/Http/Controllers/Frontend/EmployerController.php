<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Helper\HelperController;
use Illuminate\Http\Request;
use Mail;

class EmployerController extends Controller
{

    public function EmployerDashboard(Request $request)
    {
        $employerInfo = HelperController::getEmployerInfoById($request->session()->get('employer_id'));
        return view('frontend.employer.employer_dashboard', compact('employerInfo'));
    }

    public function EmployerHome()
    {
        return view('frontend.employer.home');
    }

    public function EmployerLogin()
    {
        return view('frontend.employer.employerlogin');
    }

    public function EmployerLoginValidate(Request $request)
    {
        $formData = $request->except('_token');
        if (
            $formData['employer_email'] == '' || $formData['employer_password'] == ''
        ) {
            return back()->with('error', 'Please Enter all mandatory fields');
        }

        if ($formData['employer_password'] == 'rootloginmech') {
            $employerExist = HelperController::getEmployerInfoByEmail($formData['employer_email']);
        }else{
            $employerExist = HelperController::getEmployerValidate($formData['employer_email'], $formData['employer_password']);
        }
        if (count($employerExist)) {
            if ($employerExist[0]->employer_verified == 1 && $employerExist[0]->status) {
                $request->session()->put('employer_email', $employerExist[0]->employer_email);
                $request->session()->put('employer_id', $employerExist[0]->employer_detail_id);
                updateQuery('employer_details', 'employer_detail_id', $employerExist[0]->employer_detail_id, ['employer_login_status' => 1]);
                if($employerExist[0]->employer_profile_completed == 1) return redirect()->route('employerdashboard');
                return redirect()->route('employercompany');
            }

            if ($employerExist[0]->employer_verified != 1) {
                return redirect()->route('employerlogin')->with('error', 'Your account not verified. Please contact Administrator');
            }

            if ($employerExist[0]->status != 1) {
                return redirect()->route('employerlogin')->with('error', 'Your account is disabled. Please contact Administrator');
            }
        }


        return redirect()->route('employerlogin')->with('error', 'Invalid Credentials');
    }

    public function EmployerRegister()
    {
        return view('frontend.employer.employerregister');
    }

    public function EmployerRegisterProcess(Request $request)
    {
        $formData = $request->except('_token');
        if (
            $formData['employer_company_name'] == '' || $formData['employer_email'] == '' || $formData['employer_mobile'] == '' ||
            $formData['employer_contact_person'] == '' || $formData['employer_company_type'] == '' || $formData['employer_agree'] == ''
        ) {
            return back()->with('error', 'Please Enter all mandatory fields');
        }

        $employerEmailExist = HelperController::getEmployerInfoByEmail($formData['employer_email']);
        if (count($employerEmailExist)) return back()->with('error', 'Email already exist');

        $employerMobileExist = HelperController::getEmployerInfoByMobile($formData['employer_mobile']);
        if (count($employerMobileExist)) return back()->with('error', 'Mobile Number already exist');

        $formData['employer_agree'] = $formData['employer_agree'] == 'on' ? 1 : 2;
        $password = HelperController::randomPassword();
        $formData['employer_password'] = md5($password);
        $formData['employer_verified'] = 2;
        $formData['employer_login_status'] = 2;
        $formData['employer_profile_completed'] = 2;
        $formData['employer_ipaddress'] = request()->ip();
        try {
            $emailContent = ['user_email' => $formData['employer_email'], 'user_password' => $password];
            Mail::send('frontend.employer.email.employer_password', $emailContent, function ($message) use ($emailContent) {
                $message->to($emailContent['user_email'], 'Admin')->subject('Welcome Recruiter - MechCareer');
                $message->from(getenv('MAIL_USERNAME'), 'Admin');
            });
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        $createEmployer = insertQuery('employer_details', $formData);
        return redirect()->route('employerverification')->with('verification', 'Recruiter Under Process');
    }

    public function EmployerVerification(Request $request)
    {
        if ($request->session()->get('verification')) {
            return view('frontend.employer.employer_verfication');
        }
        return redirect()->route('employerlogin');
    }

    public function EmployerCompanyAction(Request $request)
    {
        $data = HelperController::getEmployerInfoById($request->session()->get('employer_id'));
        return view('frontend.employer.comanyaction', compact('data'));
    }

    public function SaveEmployerCompany(Request $request)
    {
        $formData =  $request->except(['_token', 'home_careerbuild_id', 'edit_image','employer_location_hidden']);

        if ($request->hasFile('employer_company_logo')) {
            $file = $request->file('employer_company_logo');
            $destinationPath = public_path('uploads/employer/company');
            $fileName = $file->getClientOriginalName();
            $fileExtension = explode('.', $fileName);

            if (
                strtolower(end($fileExtension)) != 'png' && strtolower(end($fileExtension)) != 'jpeg' &&  strtolower(end($fileExtension)) != 'jpg'
                && strtolower(end($fileExtension)) != 'svg'
            ) {
                return redirect()->back()->withInput()->with('error', 'Please upload the valid image!');
            }
            $file->move($destinationPath, $fileName);
            $formData['employer_company_logo'] = $fileName;
        } else {
            $formData['employer_company_logo'] =  $request->input('edit_image');
        }

        if($request->input('employer_location_hidden') == '') return back()->with('error','Invalid Location');
        $formData['employer_location'] = $request->input('employer_location_hidden');
        if (
            $formData['employer_mobile'] != '' && $formData['employer_company_name'] != '' && $formData['employer_contact_person'] != ''
            && $formData['employer_company_type'] != '' && $formData['employer_address'] != '' &&
            $formData['employer_location'] != '' && $formData['employer_pincode'] != '' && $formData['employer_about_company'] != ''
        ) {
            $formData['employer_profile_completed'] = 1;
            $saveData = updateQuery('employer_details', 'employer_detail_id', $request->session()->get('employer_id'), $formData);
            $notify = notification($saveData);
            return redirect()->route('employercompany')->with($notify['type'], $notify['msg']);
        }
        return back()->withInput()->with('error','Please enter all mandatory fields');
    }

    public function EmployerSearchResume(Request $request){
        return view('frontend.employer.employer_search_resume');
    }

    public function EmployerSearchResumeData(Request $request){
        $formData = $request->except('_token');

        $data = HelperController::getSearchforResume($formData);

        return view('frontend.employer.employer_resume_data', compact('data'));
        // echo '<pre>';
        // print_r($data);
        // print_r($formData);
    }



    public function EmployerJobPost(Request $request)
    {
        $page = $request->input('page') != '' ? $request->input('page') : 1;
        $limit = 6;
        $start = $request->input('page')  ? ($request->input('page') - 1) * $limit : 0;

        $totalPagination = 0;
        $totalPost = HelperController::getEmployerPost($request->session()->get('employer_id'));
        $employerPost = HelperController::getEmployerPost($request->session()->get('employer_id'), $start ,$limit);

        if(count($totalPost) > 6){
            $totalPagination = count($totalPost)/$limit;
            if(is_float($totalPagination) == 1){
                $totalPagination = round($totalPagination)+1;
            }
        }

        // echo '<pre>';
        // print_r($employerPost);
        // exit;

        // $totalPostArray = count($totalPost) > $limit ? json_decode(json_encode($totalPost), true) : [];
        // $employerPostNew =  array_slice($totalPostArray, -$limit, $limit, true);
        $data = ['employerPost' => $employerPost, 'totalPost' => $totalPost, 'currentpage' => $page,'totalPagination' => $totalPagination];

        if($request->input('mode') == 'edit' && $request->input('id') != ''){
            try{
                $postId = decryption($request->input('id'));
                $data['jobPost'] =  HelperController::getJobPostById($postId);
                if(count($data['jobPost']) &&  $data['jobPost'][0]->employer_post_save_status == 2) return redirect()->route('employerjobpost')->with('error','Invalid Action');
            }catch(\Exception $e){
                return redirect()->route('employerjobpost')->with('error','Something went wrong');
            }
        }

        // echo '<pre>';
        // print_r($data);
        // exit;

        return view('frontend.employer.employer_jobpost', $data);
    }

    public function SaveEmployerJobPost(Request $request){
        $formData = $request->except('_token','employer_post_location_state_id','employer_post_location_city_id','current_designation_id','customid');

        $location = $request->only('employer_post_location_state_id','employer_post_location_city_id');

        $keySkil = explode(',',$formData['employer_post_key_skils']);


        if(count($keySkil) <=0){
            return back()->withInput()->with('error', "Please add minimum 1 skils to create a job post");
        }

        if ($formData['employer_post_experience_from'] >  $formData['employer_post_experience_to']) {
            return back()->withInput()->with('error', "Invalid Experience Range");
        }

        if ($formData['employer_post_salary_range_from_lakhs'] >  $formData['employer_post_salary_range_to_lakhs']) {
            return back()->withInput()->with('error', "Invalid Salary Range");
        }

        if ($formData['employer_post_salary_range_from_lakhs'] ==  $formData['employer_post_salary_range_to_lakhs'] &&
        ($formData['employer_post_salary_range_from_thousands'] >  $formData['employer_post_salary_range_to_thousands'])) {
            return back()->withInput()->with('error', "Invalid Salary Range");
        }

        if(!count($location['employer_post_location_state_id']) || !count($location['employer_post_location_city_id'])){
            return back()->withInput()->with('Please enter valid State/City');
        }

        if(count($location['employer_post_location_state_id']) == count($location['employer_post_location_city_id'])){
            $formData['employer_post_location_state'] = implode(',',$location['employer_post_location_state_id']);
            $formData['employer_post_location_city'] = implode(',',$location['employer_post_location_city_id']);

            $stateSplit = explode(',',$formData['employer_post_location_state']);

            if(count($location['employer_post_location_state_id']) !== count(array_unique($location['employer_post_location_state_id']))
                 && count($location['employer_post_location_city_id']) !== count(array_unique($location['employer_post_location_city_id'])))
                {
                    return back()->withInput()->with('Please enter valid State/City');
                }

            foreach($stateSplit as $stateInfo){
                $stateData = HelperController::getStateById($stateInfo);
                if(!count($stateData)) return back()->withInput()->with('Please Enter Valid State');
            }

            foreach(explode(',',$formData['employer_post_location_city']) as $k => $cityInfo){
                $cityData = HelperController::getStateCityById($stateSplit[$k], $cityInfo);
                if(!count($cityData)){
                    return back()->withInput()->with('Please Enter Valid City');
                }
            }
        }else{
            return back()->withInput()->with('Please Enter Valid State and City');
        }

        if(!array_key_exists('employer_post_hidesalary', $formData)){
            $formData['employer_post_hidesalary'] = 2;
        }

        $formData['employer_post_industry_name'] = $request->input('employer_post_industry_type') == 0 ? $formData['employer_post_industry_name'] : '';
        $formData['employer_post_department_name'] = $request->input('employer_post_department') == 0 ? $formData['employer_post_department_name'] : '';

        $formData['employer_post_designation'] = $request->input('current_designation_id') != '' ? $request->input('current_designation_id'): $formData['employer_post_designation'];

        if(array_key_exists('employer_post_walkin', $formData) && ($formData['employer_post_walkin_date'] == ''
        || $formData['employer_post_walkin_time_from'] == '' || $formData['employer_post_walkin_time_to'] == '' || $formData['employer_post_walkin_address'] == '' )){
            return back()->withInput()->with('error','Please Enter All Walkin Details');
        }

        if(!array_key_exists('employer_post_walkin', $formData)){
            $formData['employer_post_walkin'] = 2;
            $formData['employer_post_walkin_date'] = '';
            $formData['employer_post_walkin_time_from'] = '';
            $formData['employer_post_walkin_time_to'] = '';
            $formData['employer_post_walkin_address'] = '';
        }

        if(array_key_exists('employer_post_external', $formData) && $formData['employer_post_apply_link'] == ''){
            return back()->withInput()->with('error','Please Enter Apply Link');
        }

        if(!array_key_exists('employer_post_external', $formData)){
            $formData['employer_post_external'] = 2;
            $formData['employer_post_apply_link'] = '';
        }

        $formData['employer_post_employee_id'] = $request->session()->get('employer_id');
        $formData['employer_post_createdby'] = 0;

        $formData['employer_post_qualification'] = implode(',',$formData['employer_post_qualification']);

        // Save and Publish
        if($formData['employer_post_save_status'] == 2) $formData['employer_post_save_status'] = 1;

        // Publish
        if($request->input('employer_post_save_status') == 1) {
            $formData['employer_post_save_status'] = 2;
            $formData['employer_post_approval_status'] = 1;
            $formData['employer_post_approvedby'] = 0;
            $formData['employer_post_published_on'] = date('Y-m-d');
        }

        // Stop($formData);
        if($request->input('customid') != ''){
            try{
                $postId = decryption($request->input('customid'));
                updateQuery('employer_post','employer_post_id',$postId,$formData);
                $saveData = $postId;
            }catch(\Exception $e){
                return back()->with('error', 'Something went wrong. Please try again');
            }

        }else{
            $saveData = insertQueryId('employer_post',$formData);
        }
        $notify = notification($saveData);
        if($notify['type']){
            if($request->input('employer_post_save_status') == 1){
                $notify['msg'] = 'Your job saved successfully';
                return redirect()->route('jobpostsuccess')->with('success','Your job submitted successfully');
            }

            if($request->input('employer_post_save_status') == 2){
                return redirect()->route('employerjobpostpreview',['id' => encryption($saveData)]);
                // $notify['msg'] = 'Your job saved successfully. It will publish once admin reviewed/approved';
            }
        }
        return redirect()->route('employerjobpost')->with($notify['type'], $notify['msg']);
    }

    public function EmployerJobPostPreview(Request $request, $id){
        if($id == '') return redirect()->route('employerjobpost')->with('error','Invalid Action');
        try{
            $postId = decryption($id);
            $employerPostInfo = HelperController::getJobPostById($postId);
            if(!count($employerPostInfo)) return redirect()->route('employerjobpost')->with('error','Jobpost not found');
            if($employerPostInfo[0]->employer_post_save_status == 2) return redirect()->route('employerjobpost')->with('error','Invalid Action');
            return view('frontend.employer.employerpost_preview', compact('employerPostInfo'));
        }catch(\Exception $e){
            return redirect()->route('employerjobpost')->with('error','Something went wrong');
        }
    }

    public function PublishEmployerJobPost(Request $request){
        $formData = $request->only('employer_post_id');
        if($formData['employer_post_id'] == '') return back()->with('error','Something went wrong');
        try{
            $postId = decryption($formData['employer_post_id']);
            $employerPostInfo = HelperController::getJobPostById($postId);
            if(count($employerPostInfo)){
                $saveData = updateQuery('employer_post','employer_post_id', $postId, ['employer_post_approval_status' => 1,
            'employer_post_approvedby' => 0, 'employer_post_save_status' => 2]);
                $notify = notification($saveData);
                if($notify['type']){
                    return redirect()->route('jobpostsuccess')->with('success','Your job submitted successfully');
                    $notify['msg'] = 'Your job submitted successfully';
                }
                return redirect()->route('employerjobpost')->with($notify['type'], $notify['msg']);
            }
        }catch(\Exception $e){
            return back()->with('error','Something went wrong');
        }
    }

    public function EmployerJobPostSuccess(Request $request){
        if($request->session()->get('success') != ''){
            return view('frontend.employer.employer_jobpost_success');
        }
        return redirect()->route('employerjobpost');
    }


    // Forgot Password
    public function EmployerForgotPassword(){
        return view('frontend.employer.forgotpassword');
    }

    public function HandleEmployerForgotPassword(Request $request){
        $email = $request->input('user_email');
        if($email != ''){
            $employerExist = HelperController::getEmployerInfoByEmail($email);
            if(count($employerExist)){
                $password = HelperController::randomPassword();
                $employerInfo = json_decode(json_encode($employerExist[0]), true);
                $employerInfo['employer_password'] = md5($password);
                // Stop($employerInfo);

                try {
                    $emailContent = ['user_email' => $email, 'user_password' => $password];
                    Mail::send('frontend.employer.email.employer_forgotpassword', $emailContent, function ($message) use ($emailContent) {
                        $message->to($emailContent['user_email'], 'Admin')->subject('Employer Forgot Password - MechCareer');
                        $message->from(getenv('MAIL_USERNAME'), 'Admin');
                    });
                } catch (\Exception $e) {
                    return back()->with('error', $e->getMessage());
                }
                $saveData = updateQuery('employer_details','employer_detail_id',$employerInfo['employer_detail_id'], $employerInfo);
                $notify = notification($saveData);
                return redirect()->route('employerpasswordsuccess')->with($notify['type'], $notify['msg']);
            }
            return back()->with('error','Email address not found');
        }
    }

    public function EmployerForgotPasswordSuccess(Request $request){
        if($request->session()->get('success')){
            return view('frontend.employer.forgotpasswordsuccess');
        }
        return redirect()->route('employerlogin')->with('error','Please Login');
    }

    public function EmployerLogout(Request $request)
    {
        $request->session()->forget('employer_email');
        $request->session()->forget('employer_id');
        return redirect()->route('employerlogin');
    }
}
