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
                    updateQuery('user_details', 'user_id', $userId, ['user_email' => $userEmail]);
                    updateQuery('user_email_otp', 'user_id', $userId, ['user_email' => $userEmail]);
                    $response = ['status' => true, 'message' => 'Email Updated successfully'];
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
                $response = Http::get(env('SMS_GATEWAY') . '/request?authkey=' . env('SMS_AUTHKEY') . '&mobile=' . $otpExist[0]->user_phonenumber . '&country_code=91&voice=Hello%20your%20OTP%20is%20' . $otpExist[0]->user_otp);
                if ($response->successful()) {
                    $res = $response->json();
                    if (array_key_exists('LogID', $res) && $res['LogID'] != '') {
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
                $emailExist = HelperController::isUserExistByPhone($userPhone);
                if (count($emailExist)) {
                    $response = ['status' => false, 'message' => 'Please enter different Mobile Number. This Mobile Number already exist'];
                } else {
                    updateQuery('user_details', 'user_id', $userId, ['user_phonenumber' => $userPhone]);
                    updateQuery('user_mobile_otp', 'user_id', $userId, ['user_phonenumber' => $userPhone]);
                    $response = ['status' => true, 'message' => 'Mobile Number Updated successfully'];
                }
            }
        } catch (\Exception $e) {
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
                    'user_id' => $userId, 'user_profile_picture' => $userId . '_' . $fileName ];
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
                $data = [];
                if ($request->input('dataid') != '') {
                    $educationInfo = HelperController::getEducation(decryption($request->input('dataid')));
                    if (count($educationInfo)) $data = $educationInfo;
                }
                $html = view('frontend.users.actioneducation', compact('type', 'data'))->render();
                $response = ['status' => true, 'message' => '', 'data' => $html];
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
            $formData = $request->except('user_employment_id');
            $formData['user_id'] = $request->session()->get('frontend_userid');
            if ($formData['user_employment_current_company'] == 1) {
                $formData['user_employment_working_year'] = array_search(date('Y'), Year()) + 1;
                $formData['user_employment_working_month'] = date('m');
                if ($request->input('user_employment_id') == '') {
                    $currentCompanyExist = HelperController::getUserEmploymentCurrentCompany($request->session()->get('frontend_userid'));
                    if (count($currentCompanyExist)) {
                        $response['message'] = 'Invalid action. Current Company already available';
                        return $response;
                    }
                }
            }

            if ($formData['user_employment_joining_year'] >  $formData['user_employment_working_year']) {
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
            if ($request->input('user_employment_id') != '') {
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

    public function ActionEducation(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            $formData = $request->except('user_education_id');
            $formData['user_id'] = $request->session()->get('frontend_userid');

            $educationExist = HelperController::getEducationByEducation($formData['user_education_primary_id']);
            if ($request->input('user_education_id') == '' && count($educationExist)) {
                $response = ['status' => false, 'message' => 'Education Already exist'];
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
            $userData = $request->only(
                'user_gender',
                'user_marital_status',
                'user_dob',
                'user_permanent_address',
                'user_permanent_address_pin',
                'user_work_permit'
            );
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

            $totalRecord = count($languageData['user_language_primary_id']);

            foreach ($languageData['user_language_primary_id'] as $k => $langloop) {
                $update = false;
                $prepareData = [
                    'user_id' => $userId, 'user_language_primary_id' => $langloop,
                    'user_language_proficiency' => isset($languageData['user_language_proficiency'][$k]) ? $languageData['user_language_proficiency'][$k] : '',
                    'user_language_read' => isset($languageData['user_language_read_value'][$k]) ? $languageData['user_language_read_value'][$k] : 2,
                    'user_language_write' => isset($languageData['user_language_write_value'][$k]) ? $languageData['user_language_write_value'][$k] : 2,
                    'user_language_speak' => isset($languageData['user_language_speak_value'][$k]) ? $languageData['user_language_speak_value'][$k] : 2,
                ];
                if(isset($languageData['user_language_id'][$k])){
                    $langExist = HelperController::getLanguagesById($languageData['user_language_id'][$k]);
                    if(count($langExist)){
                        $update = true;
                    }
                }

                if($update){
                    updateQuery('user_languages','user_language_id',$languageData['user_language_id'][$k],$prepareData);
                }else{
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



    public function ActionCurrentLocation(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            $formData = $request->except('user_city');
            $userid = $request->session()->get('frontend_userid');
            $formData['user_id'] = $userid;
            $profileInfo = HelperController::getUserProfile($userid);
            updateQuery('user_details', 'user_id', $userid, ['user_city' => $request->input('user_city')]);
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

    public function CreateKeySkils(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            if ($request->input('keyskils') != '') {
                $splitKeys = explode(',', $request->input('keyskils'));
                $userId = $request->session()->get('frontend_userid');
                foreach ($splitKeys as $keys) {
                    $keyExist = HelperController::getUserSkilsByText($keys);
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
}
