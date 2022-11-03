<?php

namespace App\Http\Controllers\Frontend\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HelperController extends Controller
{
    static function GetHomeTrainingCenter()
    {
        return DB::table("home_training_center")->where('status', 1)->orderBy('training_center_id', 'desc')->get();
    }

    static function GetHomeTrainingCenterContent($centerid)
    {
        return DB::table("home_training_center_details")->where([['training_center_id', $centerid], ['status', 1]])->orderBy('training_center_detail_id', 'desc')->get();
    }

    static function isUserExistByEmail($email)
    {
        return DB::table("user_details")->where('user_email', $email)->get();
    }

    static function isUserExistByPhone($phone)
    {
        return DB::table("user_details")->where('user_phonenumber', $phone)->get();
    }

    static function isUserExistByEmailPhone($email, $phone)
    {
        return DB::table("user_details")->where([['user_email', $email], ['user_phonenumber', $phone]])->get();
    }

    static function getUserInfo($id = '')
    {
        $user = DB::table('user_details');
        if ($id != '')  $user->where('user_id', $id);
        return $user->get();
    }

    static function getUserCompleteProfileInfo($id)
    {
        $user = [];
        if ($id == '') return $user;
        $user['userDetails'] = DB::table('user_details')->where('user_id', $id)->get();
        $user['userEducations'] = DB::table('user_education')->where('user_id', $id)->get();
        $user['userEmployments'] = DB::table('user_employment')->where('user_id', $id)->get();
        $user['userITSkils'] = DB::table('user_itskils')->where('user_id', $id)->get();
        $user['userKeySkils'] = DB::table('user_key_skils')->where('user_id', $id)->get();
        $user['userLanguages'] = DB::table('user_languages')->where('user_id', $id)->get();
        $user['userProfile'] = DB::table('user_profile')->where('user_id', $id)->get();
        $user['userCertification'] = DB::table('user_certification')->where('user_id', $id)->get();
        return $user;
    }

    static function emailOTPExistByUserId($id)
    {
        return DB::table('user_email_otp')->where('user_id', $id)->get();
    }

    static function emailOTPVerify($id, $otp)
    {
        return DB::table('user_email_otp')->where([['user_id', $id], ['user_otp', $otp]])->get();
    }

    static function mobileOTPVerify($id, $otp)
    {
        return DB::table('user_mobile_otp')->where([['user_id', $id], ['user_otp', $otp]])->get();
    }

    static function mobileOTPExistByUserId($id)
    {
        return DB::table('user_mobile_otp')->where('user_id', $id)->get();
    }

    static function loginValidate($email, $password)
    {
        return DB::table('user_details')->where([['user_email', $email], ['user_password', md5($password)]])->get();
    }

    static function getUserProfile($id)
    {
        return DB::table('user_profile')->where('user_id', $id)->get();
    }

    static function getUserSkilsById($id)
    {
        return DB::table('user_key_skils')->where('user_key_skil_id', $id)->get();
    }

    static function getUserSkilsByText($text, $userId)
    {
        return DB::table('user_key_skils')->where([['user_key_skil_text', $text], ['user_id', $userId]])->get();
    }

    static function getEmployment($id)
    {
        return DB::table('user_employment')->where('user_employment_id', $id)->get();
    }

    static function getUserEmploymentCurrentCompany($userid, $empId = '')
    {
        $data = DB::table('user_employment')->where([['user_id', $userid], ['user_employment_current_company', 1]]);
        if ($empId != '') $data->where('user_employment_id', '!=', $empId);
        return $data->get();
    }

    static function getCompany($value)
    {
        return DB::table('company_details')->where('company_detail_name', 'like', '%' . $value . '%')->get();
    }

    static function getDesignation($value)
    {
        return DB::table('designation')->where('designation_name', 'like', '%' . $value . '%')->get();
    }

    static function getSpecialization($value, $id)
    {
        return DB::table('education_specialization')->where([['education_specialization_name', 'like', '%' . $value . '%'], ['education_id', $id]])->get();
    }

    static function getUniversity($value, $id)
    {
        return DB::table('education_university')->where([['education_university_name', 'like', '%' . $value . '%'], ['education_id', $id]])->get();
    }

    static function getEducation($id)
    {
        return DB::table('user_education')->where('user_education_id', $id)->get();
    }

    static function getEducationByEducation($id, $userId)
    {
        return DB::table('user_education')->where([['user_education_primary_id', $id], ['user_id', $userId]])->get();
    }

    static function getCompanyById($id)
    {
        return DB::table('company_details')->where('company_detail_id', $id)->get();
    }

    static function getITSkill($id)
    {
        return DB::table('user_itskils')->where('user_itskil_id', $id)->get();
    }

    static function getCertification($id)
    {
        return DB::table('user_certification')->where('user_certification_id', $id)->get();
    }

    static function getUserLanguages($id)
    {
        return DB::table('user_languages')->where('user_id', $id)->get();
    }

    static function getLanguagesById($id)
    {
        return DB::table('user_languages')->where('user_language_id', $id)->get();
    }

    static function getUserCurrentEmployment($id)
    {
        return DB::table('user_employment')->where([['user_id', $id], ['user_employment_current_company', 1]])->get();
    }

    static function getDesignationById($id)
    {
        return DB::table('designation')->where('designation_id', $id)->get();
    }

    static function getCourseByEducationId($id)
    {
        return DB::table('education_course_board')->where('education_id', $id)->get();
    }

    static function getSpecializationByEducationId($id)
    {
        return DB::table('education_specialization')->where('education_id', $id)->get();
    }

    static function getUniversityByEducationId($id)
    {
        return DB::table('education_university')->where('education_id', $id)->get();
    }

    static function getGradesByEducationId($id)
    {
        return DB::table('education_grade')->where('education_id', $id)->get();
    }

    static function getEducationInfo($id = '')
    {
        $data = DB::table('education_info');
        if ($id != '')  $data->where('education_id', $id);
        return $data->get();
    }

    static function getCourseInfo($id = '')
    {
        $data = DB::table('education_course_board');
        if ($id != '')  $data->where('course_board_id', $id);
        return $data->get();
    }

    static function getSpecializationInfo($id = '')
    {
        $data = DB::table('education_specialization');
        if ($id != '')  $data->where('education_specialization_id', $id);
        return $data->get();
    }

    static function getUniversityInfo($id = '')
    {
        $data = DB::table('education_university');
        if ($id != '')  $data->where('education_university_id', $id);
        return $data->get();
    }

    static function getGradeInfo($id = '')
    {
        $data = DB::table('education_grade');
        if ($id != '')  $data->where('education_grade_id', $id);
        return $data->get();
    }
}
