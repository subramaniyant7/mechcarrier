<?php

namespace App\Http\Controllers\Admin\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CommonHelperController extends Controller
{
    static function getAdminDetails($email, $password)
    {
        return DB::table("admin")->where([['admin_email', $email ], ['admin_password', $password]])->get();
    }

    static function getAdminByEmail($email)
    {
        return DB::table("admin")->where('admin_email', $email)->get();
    }

    static function getAdminData($id = '')
    {
        $admin = DB::table('admin');
        if ($id != '')  $admin->where('admin_id', $id);
        return $admin->get();
    }

    static function getBannerData($id = '')
    {
        $admin = DB::table('banner_content');
        if ($id != '')  $admin->where('banner_id', $id);
        return $admin->get();
    }

    static function getMappedCompanyData($id = '')
    {
        $company = DB::table('company_mapping');
        if ($id != '')  $company->where('company_id', $id);
        return $company->get();
    }

    static function getMappedCompanyByPosition($position)
    {
        return DB::table("company_mapping")->where('company_position',$position)->get();
    }

    static function getAdminDetailsExceptLoggedIn()
    {
        return DB::table("admin")->where('admin_id', '!=', Session::get('admin_id'))->get();
    }

    static function getSocialMediaLinks()
    {
        return DB::table("social_media_links")->get();
    }

    static function getHomeTrainingCenter($id = '')
    {
        $training = DB::table('home_training_center');
        if ($id != '')  $training->where('training_center_id', $id);
        return $training->get();
    }

    static function getHomeTrainingCenterByPosition($position)
    {
        return DB::table("home_training_center")->where('training_center_position',$position)->get();
    }

    static function getHomeTrainingCenterDetails($id = '')
    {
        $training = DB::table('home_training_center_details');
        if ($id != '')  $training->where('training_center_detail_id', $id);
        return $training->get();
    }

    static function getHomeTrainingCenterByTrainingCenterId($id)
    {
        return DB::table("home_training_center_details")->where('training_center_id',$id)->get();
    }

    static function getHomeTrainingCenterContentByPosition($position,$centerid)
    {
        return DB::table("home_training_center_details")->where([['training_center_details_position',$position],['training_center_id',$centerid]])->get();
    }

    static function getWhyWe($id = '')
    {
        $training = DB::table('whywe');
        if ($id != '')  $training->where('whywe_id', $id);
        return $training->get();
    }

    static function getWhyWeByPosition($position)
    {
        return DB::table("whywe")->where('whywe_position',$position)->get();
    }

    static function getHomeCareerBuildMain($id = '')
    {
        $career = DB::table('home_careerbuild_main');
        if ($id != '')  $career->where('home_careerbuild_main_id', $id);
        return $career->get();
    }

    static function getHomeCareerBuild($id = '')
    {
        $career = DB::table('home_careerbuild');
        if ($id != '')  $career->where('home_careerbuild_id', $id);
        return $career->get();
    }

    static function getHomeCareerBuildByPosition($position)
    {
        return DB::table("home_careerbuild")->where('home_careerbuild_position',$position)->get();
    }

    static function getUsers($id = '')
    {
        $users = DB::table('user_details');
        if ($id != '')  $users->where('user_id', $id);
        return $users->get();
    }

    static function getUserByEmail($email)
    {
        return DB::table("user_details")->where('user_email', $email)->get();
    }

    static function isUserExistByPhone($phone)
    {
        return DB::table("user_details")->where('user_phonenumber', $phone)->get();
    }

    static function getIndustry($id = '')
    {
        $data = DB::table('industry');
        if ($id != '')  $data->where('industry_id', $id);
        return $data->get();
    }

    static function getDepartment($id = '')
    {
        $data = DB::table('department');
        if ($id != '')  $data->where('department_id', $id);
        return $data->get();
    }

    static function getDesignation($id = '')
    {
        $data = DB::table('designation');
        if ($id != '')  $data->where('designation_id', $id);
        return $data->get();
    }


}
