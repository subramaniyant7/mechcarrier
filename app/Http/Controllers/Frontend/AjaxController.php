<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Helper\HelperController;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function ResendEmailOTP(Request $request)
    {
        $response = ['status' => false, 'message' => ''];
        try {
            $userId = $request->input('userIdentity');
            $otpExist = HelperController::emailOTPExistByUserId(decryption($userId));
            // print_r($otpExist);
            if (count($otpExist)) $response = ['status' => true, 'message' => 'Please check your email we have re-sent the OTP.'];
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
            if (count($otpExist)) $response = ['status' => true, 'message' => 'Please check your mobile we have re-sent the OTP.'];
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

    public function RedirectToDashboard(Request $request){
        $response = ['status' => false, 'message' => ''];
        try {
            $userId = decryption($request->input('userIdentity'));
            $userInfo = HelperController::getUserInfo($userId);
            if (count($userInfo)) {
                $request->session()->put('frontend_useremail', $userInfo[0]->user_email);
                $request->session()->put('frontend_userid', $userInfo[0]->user_id);
                updateQuery('user_details','user_id',$userInfo[0]->user_id,['user_logged_in' => 1]);
                userLoginActivity(1);
                deleteQuery($userInfo[0]->user_id,'user_mobile_otp','user_id');
                $response = ['status' => true, 'redirect' => route('userdashboard')];
            }
        } catch (\Exception $e) {
        }
        return response()->json($response);
    }
}
