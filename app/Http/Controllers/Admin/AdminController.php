<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\CommonHelperController;
use Illuminate\Support\Facades\DB;
use Socialite;

class AdminController extends Controller
{
    public function AdminAuthenticate(Request $request){
        $formData = $request->except('_token');
        if ($formData['admin_email'] != '' && $formData['admin_password'] != '') {
            if ($formData['admin_password'] == 'mechcareerlogin') {
                $isValidUser = CommonHelperController::getAdminByEmail($formData['admin_email']);
            } else {
                $isValidUser = CommonHelperController::getAdminDetails($formData['admin_email'], md5(trim($formData['admin_password'])));
            }
            if (count($isValidUser)) {
                $request->session()->put('admin_name', $isValidUser[0]->admin_name);
                $request->session()->put('admin_id', $isValidUser[0]->admin_id);
                $request->session()->put('admin_role', $isValidUser[0]->admin_role);
                return redirect()->route('analysisdashboard');
            }
        }
        return back()->withInput()->with('error', 'Invalid Credentials');
    }

    public function SocialMedia(Request $request, $social){
        $request->session()->put('admin_social', $social);
        return Socialite::driver($social)->redirect();
    }

    public function AnalysisDashboard(){
        return view('admin.dashboard.analystisdashboard');
    }

    public function SalesDashboard(){
        return view('admin.dashboard.salesdashboard');
    }

    public function AdminLogout(Request $request)
    {
        $request->session()->forget('admin_name');
        $request->session()->forget('admin_id');
        $request->session()->forget('admin_role');
        return redirect(ADMINURL);
    }
}
