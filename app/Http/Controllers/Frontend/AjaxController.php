<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Helper\HelperController;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Http;
use File;

class AjaxController extends Controller
{
    public function ResendEmailOTP(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            $userId = $request->input('userIdentity');
            $userInfo = HelperController::getUserInfo(decryption($userId));
            $otpExist = HelperController::emailOTPExistByUserId(decryption($userId));
            if (count($userInfo)) {
                if (count($otpExist)) $response = ['status' => true, 'message' => 'Please check your email we have re-sent the OTP.'];
                try {
                    $emailContent = ['user_email' => $userInfo[0]->user_email, 'user_otp' => $otpExist[0]->user_otp];
                    Mail::send('frontend.email.email_jobseeker_register', $emailContent, function ($message) use ($emailContent) {
                        $message->to($emailContent['user_email'], 'Admin')->subject('Email OTP Verification - MechCareer');
                        $message->from(getenv('MAIL_USERNAME'), 'Admin');
                    });
                } catch (\Exception $e) {
                    $response = ['status' => false, 'message' => 'Something went wrong. Please try again'];
                }
            }
        } catch (\Exception $e) {
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        return response()->json($response);
    }

    public function UpdateEmailAddress(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            $userId = decryption($request->input('userIdentity'));
            $userEmail = $request->input('userEmail');
            $userInfo = HelperController::getUserInfo($userId);
            if (count($userInfo)) {
                $emailExist = HelperController::isUserExistByEmail($userEmail);
                if (count($emailExist)) {
                    $response = ['status' => false, 'message' => 'Please enter different Email ID. This Email ID already exist'];
                } else {
                    $otp = mt_rand(100000, 999999);
                    try {
                        $emailContent = ['user_email' => $userEmail, 'user_otp' => $otp, 'type' => 'Email'];
                        Mail::send('frontend.email.jobseeker_otp_email', $emailContent, function ($message) use ($emailContent) {
                            $message->to($emailContent['user_email'], 'Admin')->subject('Email OTP Verification - MechCareer');
                            $message->from(getenv('MAIL_USERNAME'), 'Admin');
                        });
                    } catch (\Exception $e) {
                        $response = ['status' => false, 'message' => 'Something went wrong. Please try again'];
                        return response()->json($response);
                    }

                    updateQuery('user_details', 'user_id', $userId, ['user_email' => $userEmail]);
                    updateQuery('user_email_otp', 'user_id', $userId, ['user_email' => $userEmail, 'user_otp' => $otp]);
                    $response = ['status' => true, 'message' => 'Email Updated successfully and we have sent new OTP for Email Verification'];
                }
            }
        } catch (\Exception $e) {
        }
        return response()->json($response);
    }

    public function ResendMobileOTP(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            $userId = $request->input('userIdentity');
            $otpExist = HelperController::mobileOTPExistByUserId(decryption($userId));
            if (count($otpExist)) {
                // $response = Http::get(env('SMS_GATEWAY') . '/request?authkey=' . env('SMS_AUTHKEY') . '&mobile=' . $otpExist[0]->user_phonenumber . '&country_code=91&voice=Hello%20your%20OTP%20is%20' . $otpExist[0]->user_otp);
                $response = Http::get(env('SMS_URL') . '?user=' . env('SMS_USER') . '&password=' . env('SMS_PASSWORD') . '&senderid=' . env('SMS_SENDERID') .
                    '&channel=trans&DCS=0&flashsms=0&number=91' . $otpExist[0]->user_phonenumber . '&text=' . $otpExist[0]->user_otp . ' is the OTP to verify your mobile number with MechCareer.com.OTP is valid for 10 minutes. Do not share with anyone.');

                if ($response->successful()) {
                    $res = $response->json();
                    // if (array_key_exists('LogID', $res) && $res['LogID'] != '') {
                    if (array_key_exists('ErrorCode', $res) && $res['ErrorCode'] == '000') {
                        $response = ['status' => true, 'message' => 'Please check your mobile we have re-sent the OTP.'];
                    } else {
                        $response = ['status' => false, 'message' => 'Something went wrong. Please try again.'];
                    }
                } else {
                    $response = ['status' => false, 'message' => 'Something went wrong. Please try again.'];
                }
            } else {
                $response = ['status' => false, 'message' => 'Invalid action'];
            }
        } catch (\Exception $e) {
        }
        return response()->json($response);
    }

    public function UpdateMobileAddress(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            $userId = decryption($request->input('userIdentity'));
            $userPhone = $request->input('userPhone');
            $userInfo = HelperController::getUserInfo($userId);
            if (count($userInfo)) {
                $phoneNumberExist = HelperController::isUserExistByPhone($userPhone);
                if (count($phoneNumberExist)) {
                    $response = ['status' => false, 'message' => 'Please enter different Mobile Number. This Mobile Number already exist'];
                } else {
                    $otp = mt_rand(100000, 999999);
                    $response = Http::get(env('SMS_URL') . '?user=' . env('SMS_USER') . '&password=' . env('SMS_PASSWORD') . '&senderid=' . env('SMS_SENDERID') .
                        '&channel=trans&DCS=0&flashsms=0&number=91' . $userPhone . '&text=' . $otp . ' is the OTP to verify your mobile number with MechCareer.com.OTP is valid for 10 minutes. Do not share with anyone.');

                    if ($response->successful()) {
                        $res = $response->json();
                        if (array_key_exists('ErrorCode', $res) && $res['ErrorCode'] == '000') {
                            updateQuery('user_details', 'user_id', $userId, ['user_phonenumber' => $userPhone]);
                            updateQuery('user_mobile_otp', 'user_id', $userId, ['user_phonenumber' => $userPhone, 'user_otp' => $otp]);
                            $response = ['status' => true, 'message' => 'Mobile Number Updated successfully and We have sent OTP to that mobilenumber.'];
                        } else {
                            $response = ['status' => false, 'message' => 'Something went wrong. Please try again after sometime'];
                            return response()->json($response);
                        }
                    } else {
                        $response = ['status' => false, 'message' => 'Something went wrong. Please try again after sometime'];
                        return response()->json($response);
                    }
                }
            }
        } catch (\Exception $e) {
            $response = ['status' => false, 'message' => 'Something went wrong. Please try again after sometime'];
            return response()->json($response);
        }
        return response()->json($response);
    }

    public function UpdateProfilePicture(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        if ($request->hasFile('profile_picture')) {
            try {
                $file = $request->file('profile_picture');
                $destinationPath = public_path('uploads/users/profilepic');
                $fileName = $file->getClientOriginalName();
                $fileExtension = explode('.', $fileName);
                $file_size = $file->getSize();
                if (
                    strtolower(end($fileExtension)) != 'jpeg' && strtolower(end($fileExtension)) != 'png' && strtolower(end($fileExtension)) != 'jpg'
                ) {
                    $response['message'] = 'Please upload valid Profile Picture';
                }
                $userId = $request->session()->get('frontend_userid');
                $file->move($destinationPath, $userId . '_' . $fileName);
                $profileInfo = HelperController::getUserProfile($userId);
                $data = [
                    'user_id' => $userId, 'user_profile_picture' => $userId . '_' . $fileName
                ];
                if (count($profileInfo)) {
                    updateQuery('user_details', 'user_id', $userId, $data);
                }
                $response = ['status' => true, 'message' => 'Profile Picture uploaded Successfully'];
            } catch (\Exception $e) {
                $response['message'] = 'Something went wrong. Please trya again';
            }
        } else {
            $response['message'] = 'Please upload valid Profile Picture';
        }
        return $response;
    }

    public function UpdateResume(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        if ($request->hasFile('upload_resume')) {
            try {
                $file = $request->file('upload_resume');
                $destinationPath = public_path('uploads/users/resume');
                $fileName = $file->getClientOriginalName();
                $fileExtension = explode('.', $fileName);
                $file_size = $file->getSize();
                if (
                    strtolower(end($fileExtension)) != 'doc' && strtolower(end($fileExtension)) != 'docx' && strtolower(end($fileExtension)) != 'pdf'
                ) {
                    $response['message'] = 'Please upload valid resume file';
                }
                $userId = $request->session()->get('frontend_userid');
                $file->move($destinationPath, $userId . '_' . $fileName);
                $profileInfo = HelperController::getUserProfile($userId);
                $data = [
                    'user_id' => $userId, 'user_resume' => $userId . '_' . $fileName, 'user_resume_uploaded' => 1, 'user_resume_size' => $file_size,
                    'user_resume_format' => end($fileExtension)
                ];
                if (count($profileInfo)) {
                    updateQuery('user_profile', 'user_id', $userId, $data);
                } else {
                    insertQuery('user_profile', $data);
                }
                $response = ['status' => true, 'message' => 'Resume uploaded Successfully'];
            } catch (\Exception $e) {
                $response['message'] = 'Something went wrong. Please trya again';
            }
        } else {
            $response['message'] = 'Please upload valid resume file';
        }
        return $response;
    }

    public function DeleteResume(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        $userId = $request->session()->get('frontend_userid');
        $profileInfo = HelperController::getUserProfile($userId);
        if (count($profileInfo) && $profileInfo[0]->user_resume != '') {
            if (File::exists(public_path('uploads/users/resume/' . $profileInfo[0]->user_resume))) {
                File::delete(public_path('uploads/users/resume/' . $profileInfo[0]->user_resume));
            }
            $data = ['user_id' => $userId, 'user_resume' => '', 'user_resume_uploaded' => 0, 'user_resume_size' => '', 'user_resume_format' => ''];
            updateQuery('user_profile', 'user_id', $userId, $data);
            $response = ['status' => true, 'message' => 'Resume Deleted Successfully'];
        }

        return $response;
    }

    public function GetBasicDetailsHtml(Request $request){
        $response = ['status' => false, 'message' => 'Something went wrong.', 'data' => ''];
        try {
            if ($request->session()->get('frontend_userid') != '' && $request->input('type') != '') {
                $type = $request->input('type');
                $data = [];
                if ($request->input('dataid') != '') {
                    $profileInfo = HelperController::getUserProfileById(decryption($request->input('dataid')));
                    if (count($profileInfo)) $data = $profileInfo;
                }
                $html = view('frontend.users.actionbasicetails', compact('type', 'data'))->render();
                $response = ['status' => true, 'message' => '', 'data' => $html];
            }
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function GetCurrentLocationHtml(Request $request){
        $response = ['status' => false, 'message' => 'Something went wrong.', 'data' => ''];
        try {
            if ($request->session()->get('frontend_userid') != '' && $request->input('type') != '') {
                $type = $request->input('type');
                $data = [];
                if ($request->input('dataid') != '') {
                    $profileInfo = HelperController::getUserProfileById(decryption($request->input('dataid')));
                    if (count($profileInfo)) $data = $profileInfo;
                }
                $html = view('frontend.users.actioncurrentlocation', compact('type', 'data'))->render();
                $response = ['status' => true, 'message' => '', 'data' => $html];
            }
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function GetPreferredLocationHtml(Request $request){
        $response = ['status' => false, 'message' => 'Something went wrong.', 'data' => ''];
        try {
            if ($request->session()->get('frontend_userid') != '' && $request->input('type') != '') {
                $type = $request->input('type');
                $data = [];
                if ($request->input('dataid') != '') {
                    $profileInfo = HelperController::getUserProfileById(decryption($request->input('dataid')));
                    if (count($profileInfo)) $data = $profileInfo;
                }
                $html = view('frontend.users.actionpreferredlocation', compact('type', 'data'))->render();
                $response = ['status' => true, 'message' => '', 'data' => $html];
            }
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function GetAddMoreLocationHtml(Request $request){
        $response = ['status' => false, 'message' => 'Something went wrong.', 'data' => ''];
        try {
            if ($request->session()->get('frontend_userid') != '') {
                $html = view('frontend.users.addmorepreferredlocation',)->render();
                $response = ['status' => true, 'message' => '', 'data' => $html];
            }else{
                $response['message'] = 'Something went wrong. Invalid access';
            }
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function GetEmployerAddress(Request $request){
        $response = ['status' => false, 'message' => 'Something went wrong.', 'data' => ''];
        try {
            if ($request->session()->get('employer_id') != '') {
                $employerInfo = HelperController::getEmployerById($request->session()->get('employer_id'));
                if(count($employerInfo)){
                    $response = ['status' => true, 'message' => '', 'data' => $employerInfo[0]->employer_address];
                }

            }else{
                $response['message'] = 'Something went wrong. Invalid access';
            }
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function GetAddMoreJobLocationHtml(Request $request){
        $response = ['status' => false, 'message' => 'Something went wrong.', 'data' => ''];
        try {
            if ($request->session()->get('employer_id') != '') {
                $html = view('frontend.employer.addmorelocationhtml',)->render();
                $response = ['status' => true, 'message' => '', 'data' => $html];
            }else{
                $response['message'] = 'Something went wrong. Invalid access';
            }
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function GetEmploymentHtml(Request $request)
    {
        $response = ['status' => false, 'message' => 'Something went wrong.', 'data' => ''];
        try {
            if ($request->session()->get('frontend_userid') != '' && $request->input('type') != '') {
                $type = $request->input('type');
                $data = [];
                if ($request->input('dataid') != '') {
                    $employmentInfo = HelperController::getEmployment(decryption($request->input('dataid')));
                    if (count($employmentInfo)) $data = $employmentInfo;
                }
                $html = view('frontend.users.addemployment', compact('type', 'data'))->render();
                $response = ['status' => true, 'message' => '', 'data' => $html];
            }
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function GetEducationHtml(Request $request)
    {
        $response = ['status' => false, 'message' => 'Something went wrong.', 'data' => ''];
        try {
            if ($request->session()->get('frontend_userid') != '' && $request->input('type') != '') {
                $type = $request->input('type');
                $educationId = '';
                if ($request->input('educationId') != '') {
                    $educationId = $request->input('educationId');
                }
                $data = [];
                if ($request->input('dataid') != '') {
                    $educationInfo = HelperController::getEducation(decryption($request->input('dataid')));
                    if (count($educationInfo)) $data = $educationInfo;
                }
                // echo '<pre>';
                // echo $educationId;
                // print_r($data);
                // exit;
                $html = view('frontend.users.actioneducation', ['type' => $type, 'data' => $data, 'educationId' => $educationId])->render();
                $response = ['status' => true, 'message' => '', 'data' => $html];

                // echo '<pre>';
                // print_r($response);
                // exit;
            }
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function GetItSkillHtml(Request $request)
    {
        $response = ['status' => false, 'message' => 'Something went wrong.', 'data' => ''];
        try {
            if ($request->session()->get('frontend_userid') != '' && $request->input('type') != '') {
                $type = $request->input('type');
                $data = [];
                if ($request->input('dataid') != '') {
                    $itskillInfo = HelperController::getITSkill(decryption($request->input('dataid')));
                    if (count($itskillInfo)) $data = $itskillInfo;
                }
                $html = view('frontend.users.actionitskil', compact('type', 'data'))->render();
                $response = ['status' => true, 'message' => '', 'data' => $html];
            }
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function GetCertificationHtml(Request $request)
    {
        $response = ['status' => false, 'message' => 'Something went wrong.', 'data' => ''];
        try {
            if ($request->session()->get('frontend_userid') != '' && $request->input('type') != '') {
                $type = $request->input('type');
                $data = [];
                if ($request->input('dataid') != '') {
                    $certificationInfo = HelperController::getCertification(decryption($request->input('dataid')));
                    if (count($certificationInfo)) $data = $certificationInfo;
                }
                $html = view('frontend.users.actioncertification', compact('type', 'data'))->render();
                $response = ['status' => true, 'message' => '', 'data' => $html];
            }
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function GetNewLanguage(Request $request)
    {
        $response = ['status' => false, 'message' => 'Something went wrong.', 'data' => ''];
        try {
            if ($request->session()->get('frontend_userid') != '') {
                $html = view('frontend.users.newlanguage')->render();
                $response = ['status' => true, 'message' => '', 'data' => $html];
            }
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function GetPersonalDetailHtml(Request $request)
    {
        $response = ['status' => false, 'message' => 'Something went wrong.', 'data' => ''];
        try {
            if ($request->session()->get('frontend_userid') != '') {
                $data = HelperController::getUserLanguages($request->session()->get('frontend_userid'));
                $userInfo = HelperController::getUserInfo($request->session()->get('frontend_userid'));

                $html = view('frontend.users.actionpersonaldetails', compact('data', 'userInfo'))->render();
                $response = ['status' => true, 'message' => '', 'data' => $html];
            }
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function GetDesignation(Request $request)
    {
        $response = ['status' => false, 'message' => '', 'data' => json_encode([])];
        if ($request->input('designaionname') != '') {
            $designationDetails = HelperController::getDesignation($request->input('designaionname'));
            $response = ['status' => true, 'message' => '', 'data' => json_encode($designationDetails)];
        }
        return $response;
    }

    public function GetSpecialization(Request $request)
    {
        $response = ['status' => false, 'message' => '', 'data' => json_encode([])];
        if ($request->input('name') != '') {
            $data = HelperController::getSpecialization($request->input('name'), $request->input('id'));
            $response = ['status' => true, 'message' => '', 'data' => json_encode($data)];
        }
        return $response;
    }

    public function GetCountry(Request $request)
    {
        $response = ['status' => false, 'message' => '', 'data' => json_encode([])];
        if ($request->input('name') != '') {
            $data = HelperController::getCountry($request->input('name'));
            $response = ['status' => true, 'message' => '', 'data' => json_encode($data)];
        }
        return $response;
    }

    public function GetState(Request $request)
    {
        $response = ['status' => false, 'message' => '', 'data' => json_encode([])];
        if ($request->input('name') != '') {
            $data = HelperController::getState($request->input('name'));
            $response = ['status' => true, 'message' => '', 'data' => json_encode($data)];
        }
        return $response;
    }

    public function GetStateCity(Request $request)
    {
        $response = ['status' => false, 'message' => '', 'data' => json_encode([])];
        if ($request->input('state') != '' && $request->input('city') != '') {
            $data = HelperController::getStateCity($request->input('state'),$request->input('city'));
            $response = ['status' => true, 'message' => '', 'data' => json_encode($data)];
        }
        return $response;
    }

    public function GetCity(Request $request)
    {
        $response = ['status' => false, 'message' => '', 'data' => json_encode([])];
        if ($request->input('name') != '') {
            $data = HelperController::getCity($request->input('name'));
            $response = ['status' => true, 'message' => '', 'data' => json_encode($data)];
        }
        return $response;
    }

    public function GetUniversity(Request $request)
    {
        $response = ['status' => false, 'message' => '', 'data' => json_encode([])];
        if ($request->input('name') != '') {
            $data = HelperController::getUniversity($request->input('name'), $request->input('id'));
            $response = ['status' => true, 'message' => '', 'data' => json_encode($data)];
        }
        return $response;
    }

    public function GetCompany(Request $request)
    {
        $response = ['status' => false, 'message' => '', 'data' => json_encode([])];
        if ($request->input('companyname') != '') {
            $companyDetails = HelperController::getCompany($request->input('companyname'));
            $response = ['status' => true, 'message' => '', 'data' => json_encode($companyDetails)];
        }
        return $response;
    }

    public function ActionEmployment(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            $formData = $request->except('user_employment_id', 'current_company_id', 'current_designation_id');
            $formData['user_id'] = $request->session()->get('frontend_userid');
            if ($request->input('current_company_id') != '') {
                $formData['user_employment_current_companyname'] = $request->input('current_company_id');
            }

            if ($request->input('current_designation_id') != '') {
                $formData['user_employment_current_designation'] = $request->input('current_designation_id');
            }

            $years = Year();
            usort($years, function ($a, $b) {
                if ($a == $b) {
                    return 0;
                }
                return $a > $b ? -1 : 1;
            });
            $currentCompanyExist = HelperController::getUserEmploymentCurrentCompany($request->session()->get('frontend_userid'));
            if ($formData['user_employment_current_company'] == 1) {
                $formData['user_employment_working_year'] = array_search(date('Y'), $years) + 1;
                $formData['user_employment_working_month'] = date('m');
                if ($request->input('user_employment_id') == '') {

                    if (count($currentCompanyExist)) {
                        $response['message'] = 'Invalid action. Current Company already available';
                        return $response;
                    }
                }
            }

            // echo '<pre>';
            // print_r($formData);
            // exit;

            if ($formData['user_employment_joining_year'] !=  $formData['user_employment_working_year'] && $formData['user_employment_joining_year'] <  $formData['user_employment_working_year']) {
                $response['message'] = 'Working date should be greater than Joining Date';
                return $response;
            }

            if (($formData['user_employment_joining_year'] ==  $formData['user_employment_working_year']) && ($formData['user_employment_joining_month'] > $formData['user_employment_working_month'])) {
                $response['message'] = 'Working date should be greater than Joining Date';
                return $response;
            }
            // $currentCompanyExist = HelperController::getUserEmploymentCurrentCompany($request->session()->get('frontend_userid'), $request->input('user_employment_id'));
            // if (count($currentCompanyExist)) {
            //     $response['message'] = 'Invalid action. Current Company already available';
            // } else {

            if($formData['user_employment_current_company'] == 2){
                $formData['user_employment_notice_period'] = '';
            }

            if ($request->input('user_employment_id') != '') {
                if (count($currentCompanyExist) && $formData['user_employment_current_company'] == 1 && $currentCompanyExist[0]->user_employment_id != $request->input('user_employment_id')) {
                    $response['message'] = 'Invalid action. Current Company already available';
                    return $response;
                }
                updateQuery('user_employment', 'user_employment_id', decryption($request->input('user_employment_id')), $formData);
            } else {
                insertQuery('user_employment', $formData);
            }
            $response = ['status' => true, 'message' => 'Employment Details Successfully saved'];
            // }
        } catch (\Exception $e) {
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }

    public function ActionBasicDetails(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            $formData = $request->except('user_profile_id');

            if($formData['user_current_salary_month'] == '' || $formData['user_current_salary_year'] == ''
                || $formData['user_total_experience_year'] == '' || $formData['user_total_experience_month'] == ''){
                    $response = ['status' => false, 'message' => 'Please enter all mandatory fields'];
                }
            $formData['user_id'] = $request->session()->get('frontend_userid');
            $userid = $request->session()->get('frontend_userid');
            $profileInfo = HelperController::getUserProfile($userid);
            if(count($profileInfo)){
                updateQuery('user_profile', 'user_id', $userid, $formData);
            } else {
                insertQuery('user_profile', $formData);
            }
            $response = ['status' => true, 'message' => 'Basic Details saved'];
        } catch (\Exception $e) {
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }

    public function ActionCurrentLocationOnly(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            $formData = $request->except('user_profile_id','current_state_id','current_city_id');

            if($formData['user_current_state'] == '' || $formData['user_current_city'] == ''){
                return ['status' => false, 'message' => 'Please enter all mandatory fields'];
            }

            if($request->input('current_state_id') == ''){ $response['message'] = 'Please Enter valid State'; return $response; }
            if($request->input('current_city_id') == ''){ $response['message'] = 'Please Enter valid City'; return $response; }

            $formData['user_current_state'] = $request->input('current_state_id');
            $formData['user_current_city'] = $request->input('current_city_id');
            $formData['user_id'] = $request->session()->get('frontend_userid');
            $userid = $request->session()->get('frontend_userid');
            $profileInfo = HelperController::getUserProfile($userid);
            if(count($profileInfo)){
                updateQuery('user_profile', 'user_id', $userid, $formData);
            } else {
                insertQuery('user_profile', $formData);
            }
            $response = ['status' => true, 'message' => 'Current Location Details saved'];
        } catch (\Exception $e) {
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }

    public function ActionPreferredLocationOnly(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            $formData = $request->only('preferred_state_id','preferred_city_id');

            if(!count($formData['preferred_state_id']) || !count($formData['preferred_city_id'])){
                return ['status' => false,'message' => 'Please enter valid State/City'];
            }

            if(count($formData['preferred_state_id']) == count($formData['preferred_city_id'])){
                $userData = ['user_preferred_state' => implode(',',$formData['preferred_state_id']), 'user_preferred_city' => implode(',',$formData['preferred_city_id'])];
                $stateSplit = explode(',',$userData['user_preferred_state']);

                if(count($formData['preferred_state_id']) !== count(array_unique($formData['preferred_state_id']))
                 && count($formData['preferred_city_id']) !== count(array_unique($formData['preferred_city_id']))) {
                    return ['status' => false,'message' => 'Please Enter Valid State/City'];
                }

                if(count($formData['preferred_state_id']) == 1 && $formData['preferred_state_id'][0] == 0){
                    $userData = ['user_preferred_state' => 0];
                }else{
                    foreach($stateSplit as $stateInfo){
                        $stateData = HelperController::getStateById($stateInfo);
                        if(!count($stateData)) return ['status' => false,'message' => 'Please Enter Valid State'];
                    }

                    foreach(explode(',',$userData['user_preferred_city']) as $k => $cityInfo){
                        $cityData = HelperController::getStateCityById($stateSplit[$k], $cityInfo);
                        if(!count($cityData)){
                            return ['status' => false,'message' => 'Please Enter Valid City'];
                        }
                    }
                }

                $userid = $request->session()->get('frontend_userid');
                $profileInfo = HelperController::getUserProfile($userid);
                if(count($profileInfo)){
                    updateQuery('user_profile', 'user_id', $userid, $userData);
                } else {
                    insertQuery('user_profile', $userData);
                }
                $response = ['status' => true, 'message' => 'Preferred Location Details saved'];
            }else{
                return $response['message'] = 'Invalid action';
            }

            // Stop($formData);
            // exit;
            // if($formData['user_current_state'] == '' || $formData['user_current_city'] == ''){
            //     return ['status' => false, 'message' => 'Please enter all mandatory fields'];
            // }

            // if($request->input('current_state_id') == ''){ $response['message'] = 'Please Enter valid State'; return $response; }
            // if($request->input('current_city_id') == ''){ $response['message'] = 'Please Enter valid City'; return $response; }

            // $formData['user_current_state'] = $request->input('current_state_id');
            // $formData['user_current_city'] = $request->input('current_city_id');
            // $formData['user_id'] = $request->session()->get('frontend_userid');
            // $userid = $request->session()->get('frontend_userid');
            // $profileInfo = HelperController::getUserProfile($userid);
            // if(count($profileInfo)){
            //     updateQuery('user_profile', 'user_id', $userid, $formData);
            // } else {
            //     insertQuery('user_profile', $formData);
            // }
            // $response = ['status' => true, 'message' => 'Current Location Details saved'];
        } catch (\Exception $e) {
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }

    public function ActionEducation(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            $formData = $request->except('user_education_id', 'current_specialization', 'current_university');
            $formData['user_id'] = $request->session()->get('frontend_userid');

            if ($request->input('current_specialization') != '') {
                $formData['user_education_specialization'] = $request->input('current_specialization');
            }

            if ($request->input('current_university') != '') {
                $formData['user_education_university'] = $request->input('current_university');
            }

            $educationExist = HelperController::getEducationByEducation($formData['user_education_primary_id'], $formData['user_id']);
            if ($request->input('user_education_id') == '' && count($educationExist)) {
                $response = ['status' => false, 'message' => 'Education Already exist'];
                return $response;
            }

            $grade = $request->input('user_education_grade');
            $marks = $request->input('user_education_mark');

            if ($grade > 4 && $marks == '') {
                $response = ['status' => false, 'message' => 'Please Enter Marks'];
                return $response;
            }



            if ($grade == 4) {
                $formData['user_education_mark'] = '';
            }

            if($formData['user_education_mark'] != ''){
                $formData['user_education_mark'] = number_format($formData['user_education_mark'],2);
            }

            if ($grade == 1 && $marks > 10) {
                $response = ['status' => false, 'message' => 'Marks value should not exceed 10'];
                return $response;
            }

            if ($grade == 2 && $marks > 4) {
                $response = ['status' => false, 'message' => 'Marks value should not exceed 4'];
                return $response;
            }

            if ($grade == 3 && $marks > 100) {
                $response = ['status' => false, 'message' => 'Marks value should not exceed 100'];
                return $response;
            }

            if ($request->input('user_education_id') != '') {
                updateQuery('user_education', 'user_education_id', decryption($request->input('user_education_id')), $formData);
            } else {
                insertQuery('user_education', $formData);
            }
            $response = ['status' => true, 'message' => 'Education Details Successfully saved'];
        } catch (\Exception $e) {
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }

    public function ActionPersonalData(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            $userId = $request->session()->get('frontend_userid');
            $userPermit = $request->input('user_work_permit_id');
            if($userPermit != ''){
                $countryId = explode(',', $userPermit);
                foreach($countryId as $country){
                    $countryExist = HelperController::getCountryById($country);
                    if(!count($countryExist)){
                        return ['status' => false, 'message' => 'Invalid Country Provided'];
                    }
                }
            }
            $userData = $request->only(
                'user_gender',
                'user_marital_status',
                'user_dob',
                'user_permanent_address',
                'user_permanent_address_pin',
                'user_work_permit'
            );
            $userData['user_work_permit'] = $userPermit;
            $languageData = $request->only(
                'user_language_primary_id',
                'user_language_proficiency',
                'user_language_read',
                'user_language_write',
                'user_language_speak',
                'user_language_id',
                'user_language_read_value',
                'user_language_write_value',
                'user_language_speak_value'
            );

            // echo '<pre>';
            // print_r($languageData);
            // exit;

            $userLanguages = HelperController::getUserLanguages($userId);
            $totalRecord = count($languageData['user_language_id']);

            if(count($languageData['user_language_primary_id']) > 10){
                return ['status' => false,'message' => 'You cannot add more than 10 Languages'];
            }

            if(count($userLanguages) != $totalRecord){
                $deletedLanguageId = [];
                foreach($userLanguages as $uLanguage){
                    if(!in_array($uLanguage->user_language_id, $languageData['user_language_id'])){
                        array_push($deletedLanguageId,$uLanguage->user_language_id);
                        deleteQuery($uLanguage->user_language_id,'user_languages','user_language_id');
                    }
                }
            }

            foreach ($languageData['user_language_primary_id'] as $k => $langloop) {
                $update = false;
                $prepareData = [
                    'user_id' => $userId, 'user_language_primary_id' => $langloop,
                    'user_language_proficiency' => isset($languageData['user_language_proficiency'][$k]) ? $languageData['user_language_proficiency'][$k] : '',
                    'user_language_read' => isset($languageData['user_language_read_value'][$k]) ? $languageData['user_language_read_value'][$k] : 2,
                    'user_language_write' => isset($languageData['user_language_write_value'][$k]) ? $languageData['user_language_write_value'][$k] : 2,
                    'user_language_speak' => isset($languageData['user_language_speak_value'][$k]) ? $languageData['user_language_speak_value'][$k] : 2,
                ];
                if (isset($languageData['user_language_id'][$k]) && $languageData['user_language_id'][$k] != '') {
                    $langExist = HelperController::getUserLanguagesById($languageData['user_language_id'][$k], $userId);
                    if (count($langExist)) {
                        $update = true;
                    }
                }

                if ($update) {
                    updateQuery('user_languages', 'user_language_id', $languageData['user_language_id'][$k], $prepareData);
                } else {
                    $languageExist = HelperController::getUserLanguageExistByLanguageId($langloop, $userId);
                    if(count($languageExist)){
                        return ['status' => false,'message' => 'Invalid Action. Language Already added'];
                    }
                    insertQuery('user_languages', $prepareData);
                }
            }
            // echo '<pre>';
            // print_r($languageData);
            // exit;

            updateQuery('user_details', 'user_id', $userId, $userData);



            $response = ['status' => true, 'message' => 'Perosnal Details Successfully saved'];
        } catch (\Exception $e) {
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }

    public function ActionItSkill(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            $formData = $request->except('user_itskil_id');
            $formData['user_id'] = $request->session()->get('frontend_userid');
            if ($request->input('user_itskil_id') != '') {
                updateQuery('user_itskils', 'user_itskil_id', decryption($request->input('user_itskil_id')), $formData);
            } else {
                insertQuery('user_itskils', $formData);
            }
            $response = ['status' => true, 'message' => 'IT Skills Successfully saved'];
        } catch (\Exception $e) {
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }

    public function ActionCertification(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            $formData = $request->except('user_certification_id');
            $formData['user_id'] = $request->session()->get('frontend_userid');

            // if ($formData['user_certification_duration_month'] <  $formData['user_certification_validity_year_to']) {
            //     $response['message'] = 'To date should be greater than From Date';
            //     return $response;
            // }

            // if (($formData['user_certification_duration_month'] ==  $formData['user_certification_validity_year_to']) && ($formData['user_certification_duration_year'] > $formData['user_certification_validity_month_to'])) {
            //     $response['message'] = 'To date should be greater than From Date';
            //     return $response;
            // }

            if ($request->input('user_certification_id') != '') {
                updateQuery('user_certification', 'user_certification_id', decryption($request->input('user_certification_id')), $formData);
            } else {
                insertQuery('user_certification', $formData);
            }
            $response = ['status' => true, 'message' => 'Certifications Successfully saved'];
        } catch (\Exception $e) {
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }

    public function ActionCurrentLocation(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            $formData = $request->except('user_city', 'current_city', 'preferred_city');
            $invalidLocation = false;
            if ($request->input('current_city') == '') $invalidLocation = true;
            if ($request->input('current_city') != '') {
                $locationAvailable = HelperController::getCityInfo($request->input('current_city'));
                if (!count($locationAvailable)) $invalidLocation = true;
            }

            if ($request->input('preferred_city') == '') $invalidLocation = true;
            if ($request->input('preferred_city') != '') {
                $locationAvailable = HelperController::getCityInfo($request->input('preferred_city'));
                if (!count($locationAvailable)) $invalidLocation = true;
            }

            if ($invalidLocation) return response()->json(['status' => false, 'message' => 'Invalid Location Entered']);

            $userid = $request->session()->get('frontend_userid');
            $formData['user_id'] = $userid;
            $formData['user_preferred_location'] = $request->input('preferred_city');
            $profileInfo = HelperController::getUserProfile($userid);
            updateQuery('user_details', 'user_id', $userid, ['user_city' => $request->input('current_city')]);
            if (count($profileInfo)) {
                updateQuery('user_profile', 'user_id', $userid, $formData);
            } else {
                insertQuery('user_profile', $formData);
            }
            $response = ['status' => true, 'message' => 'Information saved successfully'];
        } catch (\Exception $e) {
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }

    public function UpdateResumeHeadline(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            if ($request->input('headline') != '') {
                $userId = $request->session()->get('frontend_userid');
                $profileInfo = HelperController::getUserProfile($userId);
                $data = ['user_id' => $userId, 'user_resume_headline' => $request->input('headline')];
                if (count($profileInfo)) {
                    updateQuery('user_profile', 'user_id', $userId, $data);
                } else {
                    insertQuery('user_profile', $data);
                }
                $response = ['status' => true, 'message' => 'Data Updated Successfully'];
            }
        } catch (\Exception $e) {
            $response = ['status' => false, 'message' => 'Something went wrong. Please try again'];
        }
        return $response;
    }

    public function UpdateProfileSummary(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            if ($request->input('summary') != '') {
                $userId = $request->session()->get('frontend_userid');
                $profileInfo = HelperController::getUserProfile($userId);
                $data = ['user_id' => $userId, 'user_profile_summary' => $request->input('summary')];
                if (count($profileInfo)) {
                    updateQuery('user_profile', 'user_id', $userId, $data);
                } else {
                    insertQuery('user_profile', $data);
                }
                $response = ['status' => true, 'message' => 'Data Updated Successfully'];
            }
        } catch (\Exception $e) {
            $response = ['status' => false, 'message' => 'Something went wrong. Please try again'];
        }
        return $response;
    }

    public function CreateKeySkils(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            if ($request->input('keyskils') != '') {
                $splitKeys = explode(',', $request->input('keyskils'));
                $userId = $request->session()->get('frontend_userid');
                foreach ($splitKeys as $keys) {
                    $keyExist = HelperController::getUserSkilsByText($keys, $userId);
                    if (!count($keyExist)) {
                        $data = ['user_id' => $userId, 'user_key_skil_text' => $keys];
                        insertQuery('user_key_skils', $data);
                    }
                }
                $response = ['status' => true, 'message' => 'Key Skil Created Successfully'];
            }
        } catch (\Exception $e) {
            $response = ['status' => false, 'message' => 'Something went wrong. Please try again'];
        }
        return $response;
    }

    public function DeleteKeySkils(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            if ($request->input('skilid') != '') {
                deleteQuery($request->input('skilid'), 'user_key_skils', 'user_key_skil_id');
                $response = ['status' => true, 'message' => 'Key Skil Deleted Successfully'];
            }
        } catch (\Exception $e) {
            $response = ['status' => false, 'message' => 'Something went wrong. Please try again'];
        }
        return $response;
    }

    public function RedirectToDashboard(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            $userId = decryption($request->input('userIdentity'));
            $userInfo = HelperController::getUserInfo($userId);
            if (count($userInfo)) {
                $request->session()->put('frontend_useremail', $userInfo[0]->user_email);
                $request->session()->put('frontend_userid', $userInfo[0]->user_id);
                updateQuery('user_details', 'user_id', $userInfo[0]->user_id, ['user_logged_in' => 1]);
                userLoginActivity(1);
                deleteQuery($userInfo[0]->user_id, 'user_mobile_otp', 'user_id');
                $response = ['status' => true, 'redirect' => route('userdashboard')];
            }
        } catch (\Exception $e) {
        }
        return response()->json($response);
    }

    public function EmployerJobPostPrefil(Request $request){
        $response = ['status' => false, 'message' => ''];
        $postId = $request->input('post_id');
        if($postId != ''){
            try {
                $jobPost = HelperController::getJobPostById(decryption($postId));

               // Stop($jobPost);
                if (count($jobPost)) {
                    $renderPostForm = view('frontend.employer.employerpost_form',compact('jobPost'))->render();
                    return ['status' => true, 'html' => $renderPostForm];
                }
                $response = ['status' => false, 'message' => 'Job Post Not available'];
            } catch (\Exception $e) {
                $response = ['status' => false, 'message' => $e->getMessage()];
            }
        }
        return $response;
    }


    // Search Job

    public function FilterJob(Request $request){
        $response = ['status' => false, 'message' => 'Something went wrong'];
        $filterRequest = $request->all();
        $filterQuery = ['employer_post_save_status' => 2,'employer_post_approval_status' => 1, 'status' => 1];
        if(count($filterRequest)){

            if(array_key_exists('skil',$filterRequest)){
                $filterQuery['employer_post_key_skils'] = $filterRequest['skil'];
            }

            if(array_key_exists('location',$filterRequest)){
                $filterQuery['employer_post_location_city'] = $filterRequest['location'];
            }



            if(array_key_exists('emptype',$filterRequest)){
                $filterQuery['employer_post_employement_type'] = $filterRequest['emptype'];
            }
            if(array_key_exists('walkin',$filterRequest) && $filterRequest['walkin'] == 1){
                $filterQuery['employer_post_walkin'] = $filterRequest['walkin'];
            }

            if(array_key_exists('post_range',$filterRequest)){
                $from = date('Y-m-d', strtotime('-'.$filterRequest['post_range'].' days'));
                $filterQuery['employer_post_published_on'] = ['from' => $from, 'to' => date('Y-m-d')];
            }

            if(array_key_exists('type',$filterRequest)){
                $filterQuery['employer_post_employmenttype'] = $filterRequest['type'];
            }

            if(array_key_exists('salary',$filterRequest)){
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

            if(array_key_exists('experience',$filterRequest)){
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

            if(array_key_exists('education',$filterRequest)){
                $filterQuery['employer_post_qualification'] = $filterRequest['education'];
            }

            if(array_key_exists('industry',$filterRequest)){
                $filterQuery['employer_post_industry_type'] = $filterRequest['industry'];
            }

            if(array_key_exists('department',$filterRequest)){
                $filterQuery['employer_post_department'] = $filterRequest['department'];
            }


            // Stop($filterQuery);

            // echo '<pre>';
            // print_r($filterQuery);


            if(count($filterQuery)){
                $data = HelperController::getFilterJob($filterQuery, 10);
                $html = '';
                if(count($data)){
                    $data = json_decode(json_encode($data),true);
                }

                // Stop($data);
                $html = view('frontend.jobseeker.recommended_jobs', compact('data'))->render();
                $response = ['status' => true, 'html' => $html];
            }
        }
        // Stop($filterRequest);
        return $response;
    }
}
