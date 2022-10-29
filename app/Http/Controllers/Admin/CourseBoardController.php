<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Helper\CommonHelperController;

class CourseBoardController extends Controller
{
    public function ViewCourseBoard()
    {
        $courseboard = CommonHelperController::getCourseBoard();
        return view('admin.courseboard.viewcourseboard', compact('courseboard'));
    }

    public function ManageCourseBoard()
    {
        return view('admin.courseboard.actioncourseboard', ['action' => 'add']);
    }

    public function ActionCourseBoard($option, $id)
    {
        $actionId = decryption($id);
        $data = CommonHelperController::getCourseBoard($actionId);
        if (count($data) == 0) return redirect()->route('courseboard')->withInput();

        if ($option == 'delete') {
            $delete = deleteQuery($actionId, 'education_course_board', 'course_board_id');
            $notify = notification($delete);
            return redirect()->route('courseboard')->with($notify['type'], 'Data Deleted Successfully');
        }
        return view('admin.courseboard.actioncourseboard', ['action' => $option, 'data' => $data]);
    }

    public function SaveCourseBoardDetails(Request $request)
    {
        $formData =  $request->except(['_token', 'course_board_id']);
        if ($request->input('course_board_id') == '') {
            $saveData = insertQuery('education_course_board', $formData);
        } else {
            $actionId = decryption($request->input('course_board_id'));
            $saveData = updateQuery('education_course_board', 'course_board_id', $actionId, $formData);
        }
        $notify = notification($saveData);
        return redirect()->route('courseboard')->with($notify['type'], $notify['msg']);
    }
}
