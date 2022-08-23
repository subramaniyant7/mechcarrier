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
        $emailContent = ['user_email' =>'tsubramaniyan2@gmail.com', 'user_otp' => $otp];
        Mail::send('frontend.email.email_jobseeker_register', $emailContent, function ($message) use ($emailContent) {
            $message->to($emailContent['user_email'], 'Admin')->subject('Email OTP Verification - MechCareer');
            $message->from(getenv('MAIL_USERNAME'), 'Admin');
        });

        echo 'Email sent';
    }

    public function JobseekerRegister(Request $request)
    {
        $formData = $request->except('_token', 'user_confirmpassword');
        $otp = mt_rand(100000, 999999);
        $emailContent = ['user_email' =>$formData['user_email'], 'user_otp' => $otp];
        Mail::send('frontend.email.email_jobseeker_register', $emailContent, function ($message) use ($emailContent) {
            $message->to($emailContent['user_email'], 'Admin')->subject('Email OTP Verification - MechCareer');
            $message->from(getenv('MAIL_USERNAME'), 'Admin');
        });

        exit;


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

        $createUser = insertQueryId('user_details', $formData);
    }

    public function EmailVerification($id)
    {
        try{
            $userId = decryption($id);
            $userInfo = HelperController::getUserInfo($userId);
            if(count($userInfo)) return back()->with('error', 'Invalid action. Please try again / contact administrator');
            return view('frontend.email_verification',compact('userInfo'));
        }catch(\Exception $e){
            return back()->with('error', 'Invalid action. Please try again / contact administrator');
        }
    }
}
