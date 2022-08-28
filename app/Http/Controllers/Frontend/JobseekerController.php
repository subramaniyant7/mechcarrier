<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Helper\HelperController;
use Illuminate\Http\Request;
use Mail;

class JobseekerController extends Controller
{

    public function SendEmail(Request $request)
    {
        $otp = mt_rand(100000, 999999);
        $emailContent = ['user_email' => 'tsubramaniyan2@gmail.com', 'user_otp' => $otp];
        Mail::send('frontend.email.email_jobseeker_register', $emailContent, function ($message) use ($emailContent) {
            $message->to($emailContent['user_email'], 'Admin')->subject('Email OTP Verification - MechCareer');
            $message->from(getenv('MAIL_USERNAME'), 'Admin');
        });

        echo 'Email sent';
    }

    public function JobseekerRegister(Request $request)
    {
        $formData = $request->except('_token', 'user_confirmpassword');

        // $emailContent = ['user_email' =>$formData['user_email'], 'user_otp' => $otp];
        // Mail::send('frontend.email.email_jobseeker_register', $emailContent, function ($message) use ($emailContent) {
        //     $message->to($emailContent['user_email'], 'Admin')->subject('Email OTP Verification - MechCareer');
        //     $message->from(getenv('MAIL_USERNAME'), 'Admin');
        // });

        // exit;


        if (
            $formData['user_firstname'] == '' || $formData['user_lastname'] == '' || $formData['user_email'] == ''
            || $formData['user_phonenumber'] == '' || $formData['user_password'] == ''
        ) {
            return back()->with('error', 'Please enter all mandatory fields');
        }
        if ($formData['user_password'] != $request->input('user_confirmpassword')) return back()->with('error', "Password and Confirm password doesn't matched");

        $emailExist = HelperController::isUserExistByEmail($formData['user_email']);
        if (count($emailExist)) return back()->with('error', 'Email already exist');

        $phoneExist = HelperController::isUserExistByPhone($formData['user_phonenumber']);
        if (count($phoneExist)) return back()->with('error', 'Phone Number already exist');

        $emailPhone = HelperController::isUserExistByEmailPhone($formData['user_email'], $formData['user_phonenumber']);
        if (count($emailPhone)) return back()->with('error', 'Email and Phone Number already exist');

        $otp = mt_rand(100000, 999999);
        $formData['user_password'] = md5($request->input('user_password'));
        $createUser = insertQueryId('user_details', $formData);

        $userEmail = [
            'user_id' => $createUser, 'user_email' => $formData['user_email'],
            'user_phonenumber' => $formData['user_phonenumber'], 'user_otp' => $otp
        ];

        $otpInsert = insertQuery('user_email_otp', $userEmail);
        return redirect()->route('emailverification', ['id' => encryption($createUser)])->with('success', 'We have sent OTP to registered email. Please check you email');
    }

    public function EmailVerification($id)
    {
        try {
            $userId = decryption($id);
            $userInfo = HelperController::getUserInfo($userId);
            $otpExist = HelperController::emailOTPExistByUserId($userId);
            if (!count($userInfo) || !count($otpExist)) return redirect()->route('jobseekerregister')->with('error', 'Invalid action. Please try again / contact administrator');
            return view('frontend.email_verification', compact('userInfo'));
        } catch (\Exception $e) {
            return back()->with('error', 'Invalid action. Please try again / contact administrator');
        }
    }

    public function EmailVerificationSuccess(Request $request)
    {
        $formData = $request->except('_token');
        $userId = decryption($formData['user_identity']);
        $verifyOTP = HelperController::emailOTPVerify($userId, $formData['user_email_otp']);
        if (count($verifyOTP)) {
            updateQuery('user_details', 'user_id', $userId, ['user_email_verified' => 1]);
            deleteQuery($verifyOTP[0]->user_email_otp_id, 'user_email_otp', 'user_email_otp_id');
            return view('frontend.email_verification_success', ['userId' => encryption($userId)]);
        }
        return back()->with('error', 'Invalid OTP');
    }

    public function MobileVerification(Request $request)
    {
        $formData = $request->except('_token');
        try {
            $userId = decryption($formData['user_identity']);
            $userInfo = HelperController::getUserInfo($userId);
            $otp = mt_rand(100000, 999999);
            $userOTP = ['user_id' => $userId, 'user_email' => $userInfo[0]->user_email, 'user_phonenumber' => $userInfo[0]->user_phonenumber, 'user_otp' => $otp];
            $otpInsert = insertQuery('user_mobile_otp', $userOTP);
            return redirect()->route('mobileotpverification', ['id' => $formData['user_identity']])->with('success', 'We have sent OTP to registered mobile. Please check you mobile');
        } catch (\Exception $e) {
            return back()->with('error', 'Invalid action. Please try again / contact administrator');
        }
    }

    public function MobileOTPVerification($id)
    {
        try {
            $userId = decryption($id);
            $userInfo = HelperController::getUserInfo($userId);
            $otpExist = HelperController::mobileOTPExistByUserId($userId);
            if (!count($userInfo) || !count($otpExist)) return redirect()->route('jobseekerregister')->with('error', 'Invalid action. Please try again / contact administrator');
            return view('frontend.mobile_verification', compact('userInfo'));
        } catch (\Exception $e) {
            return redirect()->route('jobseekerregister')->with('error', 'Invalid action. Please try again / contact administrator');
        }
    }

    public function MobileVerificationSuccess(Request $request)
    {
        $formData = $request->except('_token');
        try {
            $userId = decryption($formData['user_identity']);
            $verifyOTP = HelperController::mobileOTPVerify($userId, $formData['user_phone_otp']);
            if (count($verifyOTP)) {
                updateQuery('user_details', 'user_id', $userId, ['user_phonenumber_verified' => 1]);
                deleteQuery($verifyOTP[0]->user_mobile_otp_id, 'user_mobile_otp', 'user_mobile_otp_id');
                return view('frontend.mobile_verification_success', ['userId' => encryption($userId)]);
            }
            return back()->with('error', 'Invalid OTP');
        } catch (\Exception $e) {
            return back()->with('error', 'Invalid action. Please try again / contact administrator');
        }
    }

    public function JobseekerValidate(Request $request)
    {
        $formData = $request->except('_token');
        $jobseekerExist = HelperController::loginValidate($formData['user_email'], $formData['user_password']);
        if (count($jobseekerExist)) {
            if ($jobseekerExist[0]->status != 1) return back()->with('error', 'Your account is not active. Please contact administrator');
            if ($jobseekerExist[0]->user_email_verified == 1) {
                if ($jobseekerExist[0]->user_phonenumber_verified == 1) {
                    $request->session()->put('frontend_useremail', $jobseekerExist[0]->user_email);
                    $request->session()->put('frontend_userid', $jobseekerExist[0]->user_id);
                    return redirect()->route('userdashboard');
                }
                $otpExist = HelperController::mobileOTPExistByUserId($jobseekerExist[0]->user_id);
                if (!count($otpExist)) {
                    $otp = mt_rand(100000, 999999);
                    $userOTP = ['user_id' => $jobseekerExist[0]->user_id, 'user_email' => $jobseekerExist[0]->user_email, 'user_phonenumber' => $jobseekerExist[0]->user_phonenumber, 'user_otp' => $otp];
                    insertQuery('user_mobile_otp', $userOTP);
                }
                return redirect()->route('mobileotpverification', ['id' => encryption($jobseekerExist[0]->user_id)]);
            }
            return back()->with('error', 'Your Email ID not verified. Please contact administrator');
        }
        return back()->with('error', 'Invalid Credentials');
    }
}
