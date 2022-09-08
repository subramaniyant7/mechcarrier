<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\CommonHelperController;

class UserController extends Controller
{
     // Action Admin
     public function ViewUser(){
        $users = CommonHelperController::getUsers();
        return view('admin.users.viewusers', compact('users'));
    }

    public function ManageUser()
    {
        return view('admin.users.actionuser',['action' => 'add']);
    }

    public function ActionUser($option, $id)
    {
        $actionId = decryption($id);
        $userData = CommonHelperController::getUsers($actionId);
        if (count($userData) == 0) return redirect(ADMINURL . '/view_users')->withInput();

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'user_details', 'user_id');
            $notify = notification($delete);
            return redirect(ADMINURL . '/view_users')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.users.actionuser', ['action' => $option, 'data' => $userData]);
    }

    public function SaveUserDetails(Request $request)
    {
        $formData =  $request->except(['_token', 'user_id']);
        $formData['user_password'] = md5($request->user_password);
        $isUserExist = CommonHelperController::getUserByEmail($request->user_email);
        $isUserPhoneExist = CommonHelperController::isUserExistByPhone($request->user_phonenumber);


        if ($request->input('user_id') == '') {
            if(count($isUserExist)) return back()->with('error', 'Email address already exist. Please try with different email address')->withInput();
            if(count($isUserPhoneExist)) return back()->with('error', 'Mobile Number already exist. Please try with different mobile number')->withInput();
            $saveData = insertQuery('user_details', $formData);
        } else {
            $actionId = decryption($request->input('user_id'));
            $saveData = updateQuery('user_details', 'user_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('viewusers')->with($notify['type'], $notify['msg']);
    }
}
