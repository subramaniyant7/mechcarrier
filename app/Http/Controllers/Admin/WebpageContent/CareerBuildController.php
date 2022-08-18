<?php

namespace App\Http\Controllers\Admin\WebpageContent;

use App\Http\Controllers\Admin\Helper\CommonHelperController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CareerBuildController extends Controller
{
    public function ViewCareerBuild()
    {
        $main = CommonHelperController::getHomeCareerBuildMain();
        $careerBuild = CommonHelperController::getHomeCareerBuild();
        return view('admin.websitecontent.careerbuild.viewcareerbuild', compact( 'main','careerBuild'));
    }

    public function SaveCareerBuildMain(Request $request){
        $formData =  $request->except(['_token','home_careerbuild_main_id']);
        if ($request->input('home_careerbuild_main_id') == '') {
            $saveData = insertQuery('home_careerbuild_main', $formData);
        } else {
            $actionId = decryption($request->input('home_careerbuild_main_id'));
            $saveData = updateQuery('home_careerbuild_main', 'home_careerbuild_main_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('viewcareerbuild')->with($notify['type'], $notify['msg']);
    }

    public function ManageCareerBuild()
    {
        return view('admin.websitecontent.careerbuild.actioncareerbuild', ['action' => 'add']);
    }

    public function ActionCareerBuild($option, $id)
    {
        $actionId = decryption($id);
        $careerBuild = CommonHelperController::getHomeCareerBuild($actionId);
        if (count($careerBuild) == 0) return redirect()->route('viewcareerbuild');

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'home_careerbuild', 'home_careerbuild_id');
            $notify = notification($delete);
            return back()->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.websitecontent.careerbuild.actioncareerbuild', ['action' => $option, 'data' => $careerBuild]);
    }

    public function SaveCareerBuild(Request $request)
    {
        $formData =  $request->except(['_token','home_careerbuild_id','edit_image']);
        $validatePosition = false;
        if($request->input('home_careerbuild_id') != ''){
            $actionId = decryption($request->input('home_careerbuild_id'));
            $careerBuildData = CommonHelperController::getHomeCareerBuild($actionId);
            if($careerBuildData[0]->home_careerbuild_position != $formData['home_careerbuild_position']) $validatePosition = true;
        }

        if($request->input('home_careerbuild_id') == '' || $validatePosition){
            $positionAvailable = CommonHelperController::getHomeCareerBuildByPosition($formData['home_careerbuild_position']);
            if (count($positionAvailable)) return back()->with('error', 'Position already allocated');
        }
        if ($request->hasFile('home_careerbuild_image')) {
            $file = $request->file('home_careerbuild_image');
            $destinationPath = public_path('uploads/homecareerbuild');
            $fileName = $file->getClientOriginalName();
            $fileExtension = explode('.', $fileName);

            if (strtolower(end($fileExtension)) != 'png' && strtolower(end($fileExtension)) != 'jpeg' &&  strtolower(end($fileExtension)) != 'jpg'
                && strtolower(end($fileExtension)) != 'webp') {
                return redirect()->back()->withInput()->with('error', 'Please upload the valid image!');
            }
            $file->move($destinationPath, $fileName);
            $formData['home_careerbuild_image'] = $fileName;
        } else {
            $formData['home_careerbuild_image'] =  $request->input('edit_image');
        }

        if ($request->input('home_careerbuild_id') == '') {
            $saveData = insertQuery('home_careerbuild', $formData);
        } else {
            $actionId = decryption($request->input('home_careerbuild_id'));
            $saveData = updateQuery('home_careerbuild', 'home_careerbuild_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('viewcareerbuild')->with($notify['type'], $notify['msg']);
    }
}
