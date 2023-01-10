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

    // Search Page
    static function GetUserSkilBasedJobs($skil, $limit = 0)
    {
        $data = DB::table("employer_post")->where([['employer_post_key_skils', 'like', '%' . $skil . '%'],
        ['employer_post_save_status',2],['employer_post_approval_status',1],['status', 1]])->orderBy('employer_post_id', 'desc');
        if($limit != '' && $limit > 0) $data->take($limit);
        return $data->get();
    }

    static function GetUserSearchJobs($skil,$location='',$experience='', $limit = 0)
    {
        $requestData = ['employer_post_key_skils', 'employer_post_description'];

        $response = DB::table("employer_post")->where(function($q) use($requestData, $skil) {
                foreach ($requestData as $field)
                   $q->orWhere($field, 'like', "%{$skil}%");
        })->where([['employer_post_save_status',2],['employer_post_approval_status',1],['status', 1]]);

        if($location != '') $response->where('employer_post_location_city', $location);

        if($experience != '') {
            $from = $to = '';
            $experienceRange = experienceGap()[$experience-1];
            if($experienceRange != '') {
                $range = explode("-", $experienceRange);
                if(count($range) == 2){
                    $from = trim($range[0]);
                    $to = trim($range[1]);
                }
            }

            $response->where([
                ['employer_post_experience_from', '>=', $from ],
                ['employer_post_experience_to','<=' ,$to]
            ]);

        }

        if($limit != '' && $limit > 0) $response->take($limit);

        return $response->where([['employer_post_save_status',2],['employer_post_approval_status',1],['status', 1]])
            ->orderBy('employer_post_id', 'desc')->get();
    }
    // End

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

    static function getUserProfileById($id)
    {
        return DB::table('user_profile')->where('user_profile_id', $id)->get();
    }

    static function getUserKeySkilByUserId($id)
    {
        return DB::table('user_key_skils')->where('user_id', $id)->get();
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

    static function getLanguageById($languageId)
    {
        return DB::table('languages')->where([['language_id', $languageId],['status' ,1]])->get();
    }

    static function getCountry($value)
    {
        return DB::table('country')->where([['country_name', 'like', '%' . $value . '%'],['status' ,1]])->get();
    }

    static function getCountryById($stateId)
    {
        return DB::table('country')->where([['country_id', $stateId],['status' ,1]])->get();
    }

    static function getState($value)
    {
        return DB::table('state')->where([['state_name', 'like', '%' . $value . '%'],['status' ,1]])->get();
    }

    static function getStateById($stateId)
    {
        return DB::table('state')->where([['state_id', $stateId],['status' ,1]])->get();
    }

    static function getStateCity($state,$value)
    {
        return DB::table('city')->where([['state_id', $state],['city_name', 'like', '%' . $value . '%'],['status' ,1]])->get();
    }

    static function getStateCityById($state,$city)
    {
        return DB::table('city')->where([['state_id', $state],['city_id', $city],['status' ,1]])->get();
    }

    static function getCityById($cityId)
    {
        return DB::table('city')->where([['city_id', $cityId],['status' ,1]])->get();
    }

    static function getCity($value)
    {
        return DB::table('city')->where([['city_name', 'like', '%' . $value . '%'],['status' ,1]])->get();
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

    static function getUserLanguagesById($id, $userId)
    {
        return DB::table('user_languages')->where([['user_language_id', $id],['user_id', $userId]])->get();
    }

    static function getUserLanguageExistByLanguageId($id, $userId)
    {
        return DB::table('user_languages')->where([['user_language_primary_id', $id],['user_id', $userId]])->get();
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

    static function getEducationById($id)
    {
        return DB::table('education_info')->where([['education_id', $id],['status', 1]])->get();
    }

    static function getIndutryById($id)
    {
        return DB::table('industry')->where([['industry_id', $id],['status', 1]])->get();
    }

    static function getDepartmentById($id)
    {
        return DB::table('department')->where([['department_id', $id],['status', 1]])->get();
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

    static function getCountryInfo($id = '')
    {
        $data = DB::table('country');
        if ($id != '')  $data->where('country_id', $id);
        return $data->get();
    }

    static function getCityInfo($id = '')
    {
        $data = DB::table('city');
        if ($id != '')  $data->where('city_id', $id);
        return $data->get();
    }

    static function getActiveCityInfo($id)
    {
        return DB::table('city')->where([['city_id', $id],['status', 1]])->get();
    }

    static function getGradeInfo($id = '')
    {
        $data = DB::table('education_grade');
        if ($id != '')  $data->where('education_grade_id', $id);
        return $data->get();
    }

    static function getEmployerInfoById($id)
    {
        return DB::table('employer_details')->where('employer_detail_id', $id)->get();
    }

    static function getEmployerById($id)
    {
        return DB::table('employer_details')->where([['employer_detail_id', $id],['status', 1]])->get();
    }

    static function getEmployerInfoByEmail($email)
    {
        return DB::table('employer_details')->where('employer_email', $email)->get();
    }

    static function getEmployerInfoByMobile($mobile)
    {
        return DB::table('employer_details')->where('employer_mobile', $mobile)->get();
    }

    static function getEmployerValidate($email, $password)
    {
        return DB::table('employer_details')->where([['employer_email', $email], ['employer_password', md5($password)]])->get();
    }

    static function getEmployerPost($employerId, $skip = 0, $take = '')
    {
        $data = DB::table('employer_post')->where([['employer_post_employee_id', $employerId], ['status', 1]]);
        if($skip != '' && $take != '') $data->skip($skip)->take($take);
        return $data->get();
    }

    static function getEmploymentTypeId($employmentId)
    {
        return DB::table('employmenttype')->where([['employmenttype_id', $employmentId], ['status', 1]])->get();
    }

    static function getJobPostById($postId)
    {
        return DB::table('employer_post')->where('employer_post_id', $postId)->get();
    }


    static function getSearchforResume($filter, $limit =0 )
    {
        $data = DB::table('user_key_skils');

        if($limit != '' && $limit > 0) $data->take($limit);

        // $requestData = ['user_resume_headline', 'user_profile_summary'];



        if(array_key_exists('employer_post_key_skils', $filter) && $filter['employer_post_key_skils'] !=''){

            // $data->join('user_profile', 'user_details.user_id', '=', 'user_profile.user_id');

            $skilDesignation = explode(',',$filter['employer_post_key_skils']);
            foreach($skilDesignation as $skil){
                $data->leftjoin('user_profile', 'user_key_skils.user_id', '=', 'user_profile.user_id');
                $data->where('user_key_skils.user_key_skil_text', 'like', "%{$skil}%");
                // $data->orWhere('user_profile.user_resume_headline', 'like', "%{$skil}%");
            }
        }


        $data->join('user_details', 'user_key_skils.user_id', '=', 'user_details.user_id');

        // $data->groupBy('user_key_skils.user_id');


        // $data->where(function($q) use($requestData, $skil) {
        //     foreach ($requestData as $field)
        //        $q->orWhere($field, 'like', "%{$skil}%");
        // })->where([['user_details.user_id', 'user_profile.user_id'],['user_details.status',1]]);

        // $data->whereBetween('user_profile.user_total_experience_year', [$filter['employer_post_experience_from'], $filter['employer_post_experience_to']] );


        // $data->where([['user_details.user_id', 'user_profile.user_id'],['user_details.status',1]]);

        return $data->orderBy('user_details.user_id', 'desc')->get();
    }


    static function getFilterJob($filter, $limit =0 )
    {

        $data = DB::table('employer_post');

        $typeFilter = '';

        if($limit != '' && $limit > 0) $data->take($limit);

        if(array_key_exists('employer_post_key_skils', $filter)){
            $data->where('employer_post_key_skils', 'like', "%{$filter['employer_post_key_skils']}%");
            unset($filter['employer_post_key_skils']);
        }

        if(array_key_exists('employer_post_published_on', $filter)){
            $data->whereBetween('created_at', $filter['employer_post_published_on'] );
            unset($filter['employer_post_published_on']);
        }

        if(array_key_exists('employer_post_employmenttype', $filter)){
            $typeFilter = $filter['employer_post_employmenttype'];
            unset($filter['employer_post_employmenttype']);
        }



        if(array_key_exists('employer_post_salary_range', $filter)){
            $data->where([
                ['employer_post_salary_range_from_lakhs', '>=', $filter['employer_post_salary_range']['from'] ],
                ['employer_post_salary_range_to_lakhs','<=' ,$filter['employer_post_salary_range']['to']],
                ['employer_post_hidesalary', 2]
            ]);
            unset($filter['employer_post_salary_range']);
        }

        // Stop($filter);

        if(array_key_exists('employer_post_experience_range', $filter)){
            $data->where([
                ['employer_post_experience_from', '>=', $filter['employer_post_experience_range']['from'] ],
                ['employer_post_experience_to','<=' ,$filter['employer_post_experience_range']['to']]
            ]);
            unset($filter['employer_post_experience_range']);
        }


        if($typeFilter != ''){
            return $data->join('employer_details', 'employer_post.employer_post_employee_id',  'employer_details.employer_detail_id')
            ->where('employer_details.employer_company_type', $typeFilter)->orderBy('employer_post.employer_post_id')->get();
        }

        $data->where($filter);




        return $data->orderBy('employer_post_id')->get();
    }



    static function randomPassword()
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
}
