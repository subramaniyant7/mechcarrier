<?php

namespace App\Http\Controllers\Admin\WebpageContent;

use App\Http\Controllers\Admin\Helper\CommonHelperController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyManagementController extends Controller
{
    public function GetCompanyDetails(){
        $companyData = CommonHelperController::getMappedCompanyData();
        return view('admin.websitecontent.companymapping.viewmappedcompany',compact('companyData'));
    }

    public function ManageCompanyMapping()
    {
        return view('admin.websitecontent.companymapping.actioncompanymapping',['action' => 'add']);
    }

    public function ActionCompanyMapping($option, $id)
    {
        $actionId = decryption($id);
        $companyData = CommonHelperController::getMappedCompanyData($actionId);
        if (count($companyData) == 0) return redirect()->route('view_mapped_company')->with('error','Something went wrong');

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'company_mapping', 'company_id');
            $notify = notification($delete);
            return redirect()->route('viewcompany')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.websitecontent.companymapping.actioncompanymapping', ['action' => $option, 'data' => $companyData]);
    }


    public function SaveCompanyMapping(Request $request)
    {
        $formData = ['company_action'=>'','company_actual_id'=>'','company_name'=>'','company_image'=>'','company_jobcount'=>''];
        $formData['company_position'] = $request->input('company_position');
        $validatePosition = false;
        if($request->input('company_id') != ''){
            $actionId = decryption($request->input('company_id'));
            $companyData = CommonHelperController::getMappedCompanyData($actionId);
            if($companyData[0]->company_position != $formData['company_position']) $validatePosition = true;
        }

        if($request->input('company_id') == '' || $validatePosition ) {
            $positionAvailable = CommonHelperController::getMappedCompanyByPosition($formData['company_position']);
            if (count($positionAvailable)) return back()->with('error', 'Position already allocated');
        }

        if ($request->hasFile('company_image')) {
            $file = $request->file('company_image');
            $destinationPath = public_path('uploads/company_mapping');
            $fileName = $file->getClientOriginalName();
            $fileExtension = explode('.', $fileName);

            if (strtolower(end($fileExtension)) != 'png' && strtolower(end($fileExtension)) != 'jpeg' &&  strtolower(end($fileExtension)) != 'jpg'
                && strtolower(end($fileExtension)) != 'webp') {
                return redirect()->back()->withInput()->with('error', 'Please upload the valid image!');
            }
            $file->move($destinationPath, $fileName);
            $formData['company_image'] = $fileName;
        } else {
            $formData['company_image'] =  $request->input('edit_image');
        }

        if($request->input('company_action') == 1){
            $formData = array_merge($formData,$request->only(['company_action','company_name', 'company_jobcount']));
        }
        if($request->input('company_action') == 2){
            $formData = array_merge($formData,$request->only(['company_action','company_actual_id']));
            $formData['company_image'] = '';
        }

        if ($request->input('company_id') == '') {
            $saveData = insertQuery('company_mapping', $formData);
        } else {
            $actionId = decryption($request->input('company_id'));
            $formData['status'] = $request->input('status');
            $saveData = updateQuery('company_mapping', 'company_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('viewcompany')->with($notify['type'], $notify['msg']);
    }

}
