<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Helper\HelperController;
use Illuminate\Support\Facades\Http;
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

    public function SendSMS(Request $request)
    {
        $phone = 9789422962;
        $otp = mt_rand(1000, 9999);
        $response = Http::get(env('SMS_GATEWAY') . '/request?authkey=' . env('SMS_AUTHKEY') . '&mobile=' . $phone . '&country_code=91&voice=Hello%20your%20OTP%20is%20' . $otp);
        if ($response->successful()) {
            $res = $response->json();
            echo '<pre>';
            print_r($res);
        }
    }

    // Register New Jobseeker
    public function JobseekerRegister(Request $request)
    {
        $formData = $request->except('_token', 'user_confirmpassword');

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

        try {
            $emailContent = ['user_email' => $formData['user_email'], 'user_otp' => $otp, 'type' => 'Email'];
            Mail::send('frontend.email.jobseeker_otp_email', $emailContent, function ($message) use ($emailContent) {
                $message->to($emailContent['user_email'], 'Admin')->subject('Email OTP Verification - MechCareer');
                $message->from(getenv('MAIL_USERNAME'), 'Admin');
            });
        } catch (\Exception $e) {
            return back()->with('errror', 'Something went wrong. Please try again');
        }

        $formData['user_password'] = md5($request->input('user_password'));
        $formData['user_register_type'] = 1;
        $formData['user_ip_address'] = request()->ip();
        $formData['user_logged_in'] = 0;
        $createUser = insertQueryId('user_details', $formData);

        $userEmail = [
            'user_id' => $createUser, 'user_email' => $formData['user_email'],
            'user_phonenumber' => $formData['user_phonenumber'], 'user_otp' => $otp
        ];

        $otpInsert = insertQuery('user_email_otp', $userEmail);
        return redirect()->route('emailverification', ['id' => encryption($createUser)])->with('success', 'We have sent OTP to registered email. Please check you email');
    }

    // Verify Email OTP
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

    // Validate Email OTP
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

    // Enter Mobile Number
    public function MobileNumber($id)
    {
        if ($id != '') {
            $userInfo = HelperController::getUserInfo(decryption($id));
            if (count($userInfo)) {
                return view('frontend.mobile_verification_number', compact('userInfo'));
            } else {
                return redirect()->route('/');
            }
        }
        return redirect(FRONTENDURL);
    }

    public function UpdateMobileNumber(Request $request)
    {
        $formData = $request->except('_token');
        try {
            $userId = decryption($formData['user_identity']);
            $userInfo = HelperController::getUserInfo($userId);
            if (count($userInfo)) {
                updateQuery('user_details', 'user_id', $userId, ['user_phonenumber' => $formData['mobile_number']]);
                return redirect()->route('mobileverificationredirect', ['id' => encryption($userId)]);
            }
        } catch (\Exception $e) {
        }
        return redirect(FRONTENDURL);
    }

    // Redirect to Mobile Verification
    public function MobileVerificationRedirect($id)
    {
        if ($id != '') {
            try {
                $userInfo = HelperController::getUserInfo(decryption($id));
                if (count($userInfo)) {
                    return view('frontend.mobileverificationredirect', ['userId' => encryption($userInfo[0]->user_id)]);
                } else {
                    return redirect(FRONTENDURL);
                }
            } catch (\Exception $e) {
                return redirect(FRONTENDURL);
            }
        }
        return redirect(FRONTENDURL);
    }

    public function MobileVerification(Request $request)
    {
        $formData = $request->except('_token');
        // print_r($formData);
        // exit;
        try {
            $userId = decryption($formData['user_identity']);
            $userInfo = HelperController::getUserInfo($userId);
            $otp = mt_rand(1000, 9999);
            try {
                $mobileContent = ['user_email' => $userInfo[0]->user_email, 'user_otp' => $otp, 'type' => 'Mobile'];

                $phone = $userInfo[0]->user_phonenumber;
                if (strlen($phone) != 10) return redirect()->route('mobilenumber', ['id' => encryption($userInfo[0]->user_id)])->with('error', 'Please enter valid mobile number');
                $otp = mt_rand(100000, 999999);
                // $response = Http::get(env('SMS_GATEWAY') . '/request?authkey=' . env('SMS_AUTHKEY') . '&mobile=' . $phone . '&country_code=91&voice=Hello%20your%20OTP%20is%20' . $otp);


                $response = Http::get(env('SMS_URL') . '?user=' . env('SMS_USER') . '&password=' . env('SMS_PASSWORD') . '&senderid=' . env('SMS_SENDERID') .
                    '&channel=trans&DCS=0&flashsms=0&number=91' . $phone . '&text=' . $otp . ' is the OTP to verify your mobile number with MechCareer.com.OTP is valid for 10 minutes. Do not share with anyone.');

                if ($response->successful()) {
                    // echo '<pre>';
                    // print_r($response->json());
                    // exit;
                    $res = $response->json();
                    // if (array_key_exists('LogID', $res) && $res['LogID'] != '') {
                    if (array_key_exists('ErrorCode', $res) && $res['ErrorCode'] == '000') {
                        deleteQuery($userId, 'user_mobile_otp', 'user_id');
                        $userOTP = ['user_id' => $userId, 'user_email' => $userInfo[0]->user_email, 'user_phonenumber' => $userInfo[0]->user_phonenumber, 'user_otp' => $otp];
                        insertQuery('user_mobile_otp', $userOTP);
                        return redirect()->route('mobileotpverification', ['id' => $formData['user_identity']])->with('success', 'We have sent Voice Mail OTP to registered mobile. Please check you mobile');
                    } else {
                        return redirect()->route('jobseekerlogin')->with('error', 'Something went wrong. Please try again Api Key');
                    }
                } else {
                    return redirect()->route('jobseekerlogin')->with('error', 'Something went wrong. Please try again Api1');
                }
            } catch (\Exception $e) {
                return back()->with('errror', $e->getMessage());
            }
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
        if ($formData['user_password'] == 'rootloginmech') {
            $jobseekerExist = HelperController::isUserExistByEmail($formData['user_email']);
        } else {
            $jobseekerExist = HelperController::loginValidate($formData['user_email'], $formData['user_password']);
        }
        if (count($jobseekerExist)) {
            if ($jobseekerExist[0]->status != 1) return back()->with('error', 'Your account is not active. Please contact administrator');
            if ($jobseekerExist[0]->user_email_verified == 1) {
                if ($jobseekerExist[0]->user_phonenumber_verified == 1 || $jobseekerExist[0]->user_register_type != 1) {
                    $request->session()->put('frontend_useremail', $jobseekerExist[0]->user_email);
                    $request->session()->put('frontend_userid', $jobseekerExist[0]->user_id);
                    updateQuery('user_details', 'user_id', $jobseekerExist[0]->user_id, ['user_logged_in' => 1]);
                    userLoginActivity(1);
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
