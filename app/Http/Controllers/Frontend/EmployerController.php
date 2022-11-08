<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Helper\HelperController;
use Illuminate\Http\Request;
use Mail;

class EmployerController extends Controller
{

    public function EmployerDashboard()
    {
        return view('frontend.employer.employer_dashboard');
    }

    public function EmployerHome()
    {
        return view('frontend.employer.home');
    }

    public function EmployerLogin()
    {
        return view('frontend.employer.employerlogin');
    }

    public function EmployerLoginValidate(Request $request)
    {
        $formData = $request->except('_token');
        if (
            $formData['employer_email'] == '' || $formData['employer_password'] == ''
        ) {
            return back()->with('error', 'Please Enter all mandatory fields');
        }

        $employerExist = HelperController::getEmployerValidate($formData['employer_email'], $formData['employer_password']);

        if (count($employerExist)) {
            if ($employerExist[0]->employer_verified == 1 && $employerExist[0]->status) {
                $request->session()->put('employer_email', $employerExist[0]->employer_email);
                $request->session()->put('employer_id', $employerExist[0]->employer_detail_id);
                if($employerExist[0]->employer_profile_completed == 1) return redirect()->route('employerdashboard');
                return redirect()->route('employercompany');
            }

            if ($employerExist[0]->employer_verified != 1) {
                return redirect()->route('employerlogin')->with('error', 'Your account not verified. Please contact Administrator');
            }

            if ($employerExist[0]->status != 1) {
                return redirect()->route('employerlogin')->with('error', 'Your account is disabled. Please contact Administrator');
            }
        }

        return redirect()->route('employerlogin')->with('error', 'Invalid Credentials');
    }

    public function EmployerRegister()
    {
        return view('frontend.employer.employerregister');
    }

    public function EmployerRegisterProcess(Request $request)
    {
        $formData = $request->except('_token');
        if (
            $formData['employer_company_name'] == '' || $formData['employer_email'] == '' || $formData['employer_mobile'] == '' ||
            $formData['employer_contact_person'] == '' || $formData['employer_company_type'] == '' || $formData['employer_agree'] == ''
        ) {
            return back()->with('error', 'Please Enter all mandatory fields');
        }

        $employerEmailExist = HelperController::getEmployerInfoByEmail($formData['employer_email']);
        if (count($employerEmailExist)) return back()->with('error', 'Email already exist');

        $employerMobileExist = HelperController::getEmployerInfoByMobile($formData['employer_mobile']);
        if (count($employerMobileExist)) return back()->with('error', 'Mobile Number already exist');

        $formData['employer_agree'] = $formData['employer_agree'] == 'on' ? 1 : 2;
        $password = HelperController::randomPassword();
        $formData['employer_password'] = md5($password);
        $formData['employer_verified'] = 2;
        $formData['employer_login_status'] = 2;
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

        $createEmployer = insertQuery('employer_details', $formData);
        return redirect()->route('employerverification')->with('verification', 'Recruiter Under Process');
    }

    public function EmployerVerification(Request $request)
    {
        if ($request->session()->get('verification')) {
            return view('frontend.employer.employer_verfication');
        }
        return redirect()->route('employerlogin');
    }

    public function EmployerCompanyAction(Request $request)
    {
        $data = HelperController::getEmployerInfoById($request->session()->get('employer_id'));
        return view('frontend.employer.comanyaction', compact('data'));
    }

    public function SaveEmployerCompany(Request $request)
    {
        $formData =  $request->except(['_token', 'home_careerbuild_id', 'edit_image','employer_location_hidden']);

        if ($request->hasFile('employer_company_logo')) {
            $file = $request->file('employer_company_logo');
            $destinationPath = public_path('uploads/employer/company');
            $fileName = $file->getClientOriginalName();
            $fileExtension = explode('.', $fileName);

            if (
                strtolower(end($fileExtension)) != 'png' && strtolower(end($fileExtension)) != 'jpeg' &&  strtolower(end($fileExtension)) != 'jpg'
                && strtolower(end($fileExtension)) != 'svg'
            ) {
                return redirect()->back()->withInput()->with('error', 'Please upload the valid image!');
            }
            $file->move($destinationPath, $fileName);
            $formData['employer_company_logo'] = $fileName;
        } else {
            $formData['employer_company_logo'] =  $request->input('edit_image');
        }

        if($request->input('employer_location_hidden') == '') return back()->with('error','Invalid Location');
        $formData['employer_location'] = $request->input('employer_location_hidden');
        if (
            $formData['employer_mobile'] != '' && $formData['employer_company_name'] != '' && $formData['employer_contact_person'] != ''
            && $formData['employer_company_type'] != '' && $formData['employer_address'] != '' &&
            $formData['employer_location'] != '' && $formData['employer_pincode'] != '' && $formData['employer_about_company'] != ''
        ) {
            $formData['employer_profile_completed'] = 1;
            $saveData = updateQuery('employer_details', 'employer_detail_id', $request->session()->get('employer_id'), $formData);
            $notify = notification($saveData);
            return redirect()->route('employercompany')->with($notify['type'], $notify['msg']);
        }
        return back()->withInput()->with('error','Please enter all mandatory fields');
    }


    public function EmployerJobPost()
    {
        return view('frontend.employer.employer_jobpost');
    }

    public function EmployerLogout(Request $request)
    {
        $request->session()->forget('employer_email');
        $request->session()->forget('employer_id');
        return redirect()->route('employerlogin');
    }
}
