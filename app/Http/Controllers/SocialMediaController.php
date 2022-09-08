<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Http\Controllers\Admin\Helper\CommonHelperController;
use App\Http\Controllers\Frontend\Helper\HelperController;

class SocialMediaController extends Controller
{

    public function SocialMedia($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback(Request $request, $social)
    {

        $userSocial = Socialite::driver($social)->user();
        if ($request->session()->get('admin_social') != '') {
            try {
                $request->session()->forget('admin_social');
                if ($userSocial->email && $userSocial->email != '') {
                    $admin = CommonHelperController::getAdminByEmail($userSocial->email);
                    if (count($admin)) {
                        $request->session()->put('admin_name', $admin[0]->admin_name);
                        $request->session()->put('admin_id', $admin[0]->admin_id);
                        $request->session()->put('admin_role', $admin[0]->admin_role);
                        return redirect()->route('analysisdashboard');
                    } else {
                        return redirect(ADMINURL)->with('error', 'Email ID not found. Please contact admin');
                    }
                } else {
                    return redirect(ADMINURL)->with('error', 'Something went wrong. Please try again');
                }
            } catch (\Exception $e) {
                return redirect(ADMINURL)->with('error', 'Something went wrong. Please try again');
            }
        } else {
            try {
                if ($userSocial->email != '') {
                    $userInfo = HelperController::isUserExistByEmail($userSocial->email);

                    if (count($userInfo)) {
                        $userData = ['email' => $userSocial->email, 'userid' => $userInfo[0]->user_id];
                    }
                    if (!count($userInfo)) {
                        $name = explode(' ', $userSocial->name);
                        $firstname = $lastname = $userSocial->name;
                        if (count($name) > 1) {
                            $firstname = $name[0];
                            $lastname = $name[1];
                        }
                        $registerType = $social == 'google' ? 2 : 3;
                        $createUser = ['user_firstname' => $firstname, 'user_lastname' => $lastname, 'user_email' => $userSocial->email, 'user_password' => md5(123456), 'user_email_verified' => 1,
                                    'user_phonenumber_verified'=>2,'user_register_type'=> $registerType, 'user_ip_address' => request()->ip(), 'user_logged_in' => 1];
                        $createuserInfo = insertQueryId('user_details', $createUser);
                        $userData = ['email' => $userSocial->email, 'userid' => $createuserInfo];
                        $userInfo = HelperController::isUserExistByEmail($userSocial->email);
                    }

                    $request->session()->put('frontend_useremail', $userData['email']);
                    $request->session()->put('frontend_userid', $userData['userid']);
                    updateQuery('user_details','user_id', $userInfo[0]->user_id, ['user_logged_in' => 1]);
                    userLoginActivity(1);
                    return redirect()->route('userdashboard');
                } else {
                    return redirect()->route('jobseekerregister')->with('error', 'Something went wrong. Please try again');
                }
            } catch (\Exception $e) {
                return redirect()->route('jobseekerregister')->with('error', 'Something went wrong. Please try again');
            }
        }
    }
}
