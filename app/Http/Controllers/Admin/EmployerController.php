<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\CommonHelperController;
use App\Http\Controllers\Frontend\Helper\HelperController;
use Mail;

class EmployerController extends Controller
{
    public function ViewEmployers()
    {
        $employers = CommonHelperController::getEmployers();
        return view('admin.employer.viewemployer', compact('employers'));
    }

    public function ManageEmployer()
    {
        return view('admin.employer.actionemployer', ['action' => 'add']);
    }

    public function ActionEmployer($option, $id)
    {
        $actionId = decryption($id);
        $data = CommonHelperController::getEmployers($actionId);
        if (count($data) == 0) return redirect()->route('viewemployers')->withInput();

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'employer_details', 'employer_detail_id');
            $notify = notification($delete);
            return redirect()->route('viewemployers')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.employer.actionemployer', ['action' => $option, 'data' => $data]);
    }

    public function SaveEmployerDetails(Request $request)
    {
        $formData =  $request->except(['_token', 'employer_detail_id']);
        $formData['employer_agree'] = 1;
        $formData['employer_login_status'] = 2;

        if ($request->input('employer_detail_id') == '') {

            $employerEmailExist = CommonHelperController::getEmployerInfoByEmail($formData['employer_email']);
            if (count($employerEmailExist)) return back()->with('error', 'Email already exist');

            $employerMobileExist = CommonHelperController::getEmployerInfoByMobile($formData['employer_mobile']);
            if (count($employerMobileExist)) return back()->with('error', 'Mobile Number already exist');

            $password = HelperController::randomPassword();
            $formData['employer_password'] = md5($password);
            $formData['employer_verified'] = 1;
            $formData['employer_profile_completed'] = 2;

            try {
                $emailContent = ['user_email' => $formData['employer_email'], 'user_password' => $password];
                Mail::send('frontend.employer.email.employer_password', $emailContent, function ($message) use ($emailContent) {
                    $message->to($emailContent['user_email'], 'Admin')->subject('Welcome Recruiter - MechCareer');
                    $message->from(getenv('MAIL_USERNAME'), 'Admin');
                });
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }

            $saveData = insertQuery('employer_details', $formData);
        } else {
            $actionId = decryption($request->input('employer_detail_id'));
            $saveData = updateQuery('employer_details', 'employer_detail_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('viewemployers')->with($notify['type'], $notify['msg']);
    }
}
