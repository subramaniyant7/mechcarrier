<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\CommonHelperController;
use Mail;

class UserController extends Controller
{
    // Action Admin

    public function ImportUsers()
    {
        return view('admin.users.importusers');
    }

    public function DownloadSampleFile(Request $request)
    {
        $filepath = public_path('admin/docs/user_import.csv');
        return Response()->download($filepath);
    }

    private function csvToArray($csvFile)
    {
        echo '<pre>';
        $file_to_read = fopen($csvFile, 'r');
        print_r($file_to_read);
        while (!feof($file_to_read)) {
            $lines[] = fgetcsv($file_to_read, 1000, ',');
        }
        fclose($file_to_read);
        return $lines;
    }

    private function CreateRandomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    public function SaveImportUsers(Request $request)
    {
        if ($request->hasFile('user_import')) {
            $file = $request->file('user_import');
            $fileName = $file->getClientOriginalName();
            $fileExtension = explode('.', $fileName);
            if (strtolower(end($fileExtension)) != 'csv') return redirect()->back()->withInput()->with('error', 'Please upload the valid csv file!');
        }
        $csvFile = file($request->file('user_import'));
        foreach ($csvFile as $k => $line) {
            if ($k > 0) {
                $userData = explode(',', $line);
                $emailExist = CommonHelperController::getUserByEmail($userData[2]);
                if (count($emailExist) == 0) {
                    $mobileExist = CommonHelperController::getUserByEmail($userData[3]);
                    if (count($mobileExist) == 0 && strlen(trim($userData[3])) == 10) {
                        $password = $this->CreateRandomPassword();
                        $userCreate = [
                            'user_firstname' => $userData[0], 'user_lastname' => $userData[1], 'user_email' => $userData[2], 'user_password' => md5($password),
                            'user_phonenumber' => $userData[3], 'user_email_verified' => 1, 'user_phonenumber_verified' => 1,
                            'user_register_type' => 5, 'user_ip_address' => $request->ip()
                        ];
                        // try {
                        //     $emailContent = ['user_email' => $userData[2], 'user_password' => $password];
                        //     Mail::send('frontend.email.jobseeker_password_template', $emailContent, function ($message) use ($emailContent) {
                        //         $message->to($emailContent['user_email'], 'Admin')->subject('Jobseeker Account Credentials');
                        //         $message->from(getenv('MAIL_USERNAME'), 'Admin');
                        //     });

                        //     Mail::send('frontend.email.jobseeker_account_created_template', $emailContent, function ($message) use ($emailContent) {
                        //         $message->to($emailContent['user_email'], 'Admin')->subject('Welcome to MechCareer');
                        //         $message->from(getenv('MAIL_USERNAME'), 'Admin');
                        //     });
                        // } catch (\Exception $e) {
                        //     return back()->with('error',$e->getMessage());
                        // }

                        insertQuery('user_details', $userCreate);
                    }
                }
            }
        }
        return redirect()->route('importusers')->with('success', 'User Imported Successfully');
    }

    public function ViewUser()
    {
        $users = CommonHelperController::getUsers();
        return view('admin.users.viewusers', compact('users'));
    }

    public function ManageUser()
    {
        return view('admin.users.actionuser', ['action' => 'add']);
    }

    public function ActionUser($option, $id)
    {
        $actionId = decryption($id);
        $userData = CommonHelperController::getUsers($actionId);
        if (count($userData) == 0) return redirect(ADMINURL . '/view_users')->withInput();

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'user_details', 'user_id');
            deleteQuery($actionId,'user_education','user_id');
            deleteQuery($actionId,'user_email_otp','user_id');
            deleteQuery($actionId,'user_employment','user_id');
            deleteQuery($actionId,'user_itskils','user_id');
            deleteQuery($actionId,'user_key_skils','user_id');
            deleteQuery($actionId,'user_languages','user_id');
            deleteQuery($actionId,'user_mobile_otp','user_id');
            deleteQuery($actionId,'user_profile','user_id');
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
            if (count($isUserExist)) return back()->with('error', 'Email address already exist. Please try with different email address')->withInput();
            if (count($isUserPhoneExist)) return back()->with('error', 'Mobile Number already exist. Please try with different mobile number')->withInput();

            try {
                $emailContent = ['user_email' => $formData['user_email'], 'user_password' => $request->user_password];
                Mail::send('frontend.email.jobseeker_password_template', $emailContent, function ($message) use ($emailContent) {
                    $message->to($emailContent['user_email'], 'Admin')->subject('Jobseeker Account Credentials');
                    $message->from(getenv('MAIL_USERNAME'), 'Admin');
                });

                Mail::send('frontend.email.jobseeker_account_created_template', $emailContent, function ($message) use ($emailContent) {
                    $message->to($emailContent['user_email'], 'Admin')->subject('Welcome to MechCareer');
                    $message->from(getenv('MAIL_USERNAME'), 'Admin');
                });
            } catch (\Exception $e) {
                return back()->with('error',$e->getMessage());
            }

            $saveData = insertQuery('user_details', $formData);
        } else {
            $actionId = decryption($request->input('user_id'));
            $saveData = updateQuery('user_details', 'user_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('viewusers')->with($notify['type'], $notify['msg']);
    }
}
