<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\CommonHelperController;

class EmployerPost extends Controller
{
    public function ViewEmployersPost()
    {
        $employerspost = CommonHelperController::getEmployersPost();
        return view('admin.employerpost.viewemployerpost', compact('employerspost'));
    }

    public function ManageEmployerPost()
    {
        return view('admin.employerpost.actionemployerpost', ['action' => 'add']);
    }

    public function ActionEmployerPost($option, $id)
    {
        $actionId = decryption($id);
        $data = CommonHelperController::getEmployersPost($actionId);
        if (count($data) == 0) return redirect()->route('viewemployerspost')->withInput();

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'employer_post', 'employer_post_id');
            $notify = notification($delete);
            return redirect()->route('viewemployerspost')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.employerpost.actionemployerpost', ['action' => $option, 'data' => $data]);
    }

    public function SaveEmployerPostDetails(Request $request)
    {
        $formData =  $request->except(['_token', 'employer_post_id','save_status']);
        $keySkil = explode(',',$formData['employer_post_key_skils']);
        if(count($keySkil) <=4){
            return back()->withInput()->with('error', "Please add minimum 5 skils to create a job post");
        }

        if ($formData['employer_post_salary_range_from_lakhs'] >  $formData['employer_post_salary_range_to_lakhs']) {
            return back()->withInput()->with('error', "Invalid Salary Range");
        }

        if ($formData['employer_post_salary_range_from_lakhs'] ==  $formData['employer_post_salary_range_to_lakhs'] &&
        ($formData['employer_post_salary_range_from_thousands'] >  $formData['employer_post_salary_range_to_thousands'])) {
            return back()->withInput()->with('error', "Invalid Salary Range");
        }

        if ($request->input('employer_post_id') == '') {
            $formData['employer_post_createdby'] = $request->session()->get('admin_id');
            $saveData = insertQuery('employer_post', $formData);
        } else {
            $formData['employer_post_updatedby'] = $request->session()->get('admin_id');
            $actionId = decryption($request->input('employer_post_id'));
            $saveData = updateQuery('employer_post', 'employer_post_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('viewemployerspost')->with($notify['type'], $notify['msg']);
    }
}
