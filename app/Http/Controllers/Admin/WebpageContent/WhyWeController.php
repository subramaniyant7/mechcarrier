<?php

namespace App\Http\Controllers\Admin\WebpageContent;

use App\Http\Controllers\Admin\Helper\CommonHelperController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WhyWeController extends Controller
{
    public function ViewWhyWe()
    {
        $whywe = CommonHelperController::getWhyWe();
        return view('admin.websitecontent.whywe.viewwhywe', compact( 'whywe'));
    }

    public function ManageWhyWe()
    {
        return view('admin.websitecontent.whywe.actionwhywe', ['action' => 'add']);
    }

    public function ActionWhyWe($option, $id)
    {
        $actionId = decryption($id);
        $whyweData = CommonHelperController::getWhyWe($actionId);
        if (count($whyweData) == 0) return redirect()->route('viewwhywe');

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'whywe', 'whywe_id');
            $notify = notification($delete);
            return back()->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.websitecontent.whywe.actionwhywe', ['action' => $option, 'data' => $whyweData]);
    }

    public function SaveWhyWe(Request $request)
    {
        $formData =  $request->except(['_token','whywe_id','edit_image']);
        $validatePosition = false;
        if($request->input('whywe_id') != ''){
            $actionId = decryption($request->input('whywe_id'));
            $whyweData = CommonHelperController::getWhyWe($actionId);
            if($whyweData[0]->whywe_position != $formData['whywe_position']) $validatePosition = true;
        }

        if($request->input('whywe_id') == '' || $validatePosition){
            $positionAvailable = CommonHelperController::getWhyWeByPosition($formData['whywe_position']);
            if (count($positionAvailable)) return back()->with('error', 'Position already allocated');
        }
        if ($request->hasFile('whywe_image')) {
            $file = $request->file('whywe_image');
            $destinationPath = public_path('uploads/whywe');
            $fileName = $file->getClientOriginalName();
            $fileExtension = explode('.', $fileName);

            if (strtolower(end($fileExtension)) != 'png' && strtolower(end($fileExtension)) != 'jpeg' &&  strtolower(end($fileExtension)) != 'jpg'
                && strtolower(end($fileExtension)) != 'webp') {
                return redirect()->back()->withInput()->with('error', 'Please upload the valid image!');
            }
            $file->move($destinationPath, $fileName);
            $formData['whywe_image'] = $fileName;
        } else {
            $formData['whywe_image'] =  $request->input('edit_image');
        }

        if ($request->input('whywe_id') == '') {
            $saveData = insertQuery('whywe', $formData);
        } else {
            $actionId = decryption($request->input('whywe_id'));
            $saveData = updateQuery('whywe', 'whywe_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('viewwhywe')->with($notify['type'], $notify['msg']);
    }
}
