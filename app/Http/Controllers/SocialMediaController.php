<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Http\Controllers\Admin\Helper\CommonHelperController;

class SocialMediaController extends Controller
{
    public function handleProviderCallback(Request $request, $social){
        try {
            $userSocial = Socialite::driver($social)->user();
            if($request->session()->get('admin_social') != ''){
                $request->session()->forget('admin_social');
                if ($userSocial->email && $userSocial->email != '') {
                    $admin = CommonHelperController::getAdminByEmail($userSocial->email);
                    if (count($admin)) {
                        $request->session()->put('admin_name', $admin[0]->admin_name);
                        $request->session()->put('admin_id', $admin[0]->admin_id);
                        $request->session()->put('admin_role', $admin[0]->admin_role);
                        return redirect()->route('analysisdashboard');
                    }else{
                        return redirect(ADMINURL)->with('error','Email ID not found. Please contact admin');
                    }
                }else{
                    return redirect()->with('error','Something went wrong. Please try again');
                }
            }else{
                echo '<pre>';
                print_r($userSocial);
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
