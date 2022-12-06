<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;

function admintype()
{
    return array('Primary Admin', 'Super Admin', 'Sub Admin');
}

function companytype()
{
    return array('Manual', 'Company');
}

function companyTemp()
{
    return array('TCS', 'Wipro');
}

function statusClass()
{
    return array('badge badge-light-success', 'badge badge-light-danger', 'badge badge-light-secondary', 'badge badge-light-info');
}

function statustype()
{
    return array('Active', 'De-Active');
}

function approvaltype()
{
    return array('Approved', 'Not Approved');
}


function verifiedStatus()
{
    return array('Verified', 'Not Verified');
}

function registeredFrom()
{
    return array('Form', 'Google', 'LinkenIn', 'Admin', 'Import');
}

function loginStatusClass()
{
    return array('badge-primary', 'badge-danger');
}

function loginStatus()
{
    return array('Online', 'Offline');
}

function typeOfCompany()
{
    return array('Company', 'Consultancy');
}


function getActiveRecord($table)
{
    return DB::table($table)->where('status', 1)->get();
}

function getRecordData($table, $condition)
{
    return DB::table($table)->where($condition)->get();
}

function encryption($string, $root = '')
{
    if ($root != '' && Session::get('admin_name') == 'root') return $string;
    return Crypt::encryptString($string);
}

function decryption($string, $root = '')
{
    if ($root != '' && Session::get('admin_name') == 'root') return $string;
    return Crypt::decryptString($string);
}

function insertQuery($table, $data)
{
    $data['status'] = 1;
    $data['created_at'] = date('Y-m-d h:i:s', time());
    $data['updated_at'] = date('Y-m-d h:i:s', time());
    try {
        return DB::table($table)->insert($data);
    } catch (Exception $e) {
        echo '<pre>';
        print_r($e->getMessage());
        exit;
        return false;
    }
}

function insertQueryId($table, $data)
{
    $data['status'] = 1;
    $data['created_at'] = date('Y-m-d h:i:s', time());
    $data['updated_at'] = date('Y-m-d h:i:s', time());
    try {
        return DB::table($table)->insertGetId($data);
    } catch (Exception $e) {
        return false;
    }
}

function updateQuery($table, $match, $id, $data)
{
    try {
        $data['updated_at'] =  date('Y-m-d h:i:s', time());;
        $update = DB::table($table)->where($match, $id)->update($data);
        return true;
    } catch (Exception $e) {
        print_r($e->getMessage());
        exit;
        return false;
    }
}

function deleteQuery($id, $table, $field)
{
    return  DB::table($table)->where($field, $id)->delete();
}

function notification($type = false)
{
    if ($type) {
        return ['type' => 'success', 'msg' => 'Data Saved Succesfully'];
    }
    return ['type' => 'error', 'msg' => 'Something went wrong... please try again'];
}

function getSocialMedia()
{
    $data =  DB::table("social_media")->where('status', 1);
    return $data->orderBy('social_media_id', 'desc')->get();
}

function getSocialMediaLinks()
{
    return DB::table("social_media_links")->get();
}

function getMixedContentByType($type)
{
    return DB::table("mixed_content")->where('mixed_content_type', $type)->get();
}

function userLoginActivity($data)
{
    $userData = ['user_id' => session('frontend_userid'), 'user_ip_address' => request()->ip(), 'user_logged_in' => $data];
    return insertQuery('user_login_history', $userData);
}

function getSiteInfo()
{
    return DB::table("banner_content")->where('banner_id', 1)->get();
}

function getUserSidebar()
{
    return [
        ['name' => 'Attach Resume', 'key' => 'resume'],
        ['name' => 'Resume Headline', 'key' => 'headline'],
        ['name' => 'Basic Details', 'key' => 'basic_details'],
        ['name' => 'Key Skill', 'key' => 'userKeySkils'],
        ['name' => 'Profile Summary', 'key' => 'profilesummary'],
        ['name' => 'Employment', 'key' => 'userEmployments'],
        ['name' => 'Education', 'key' => 'userEducations'],
        ['name' => 'Location', 'key' => 'currentlocation'],
        // ['name' => 'Total Experience', 'key' => 'totalexperience'],
        ['name' => 'IT Skill', 'key' => 'userITSkils'],
        ['name' => 'Certifications', 'key' => 'userCertifications'],
        ['name' => 'Personal Details', 'key' => 'personadetail']
    ];
}

function getIndustry($id)
{
    return DB::table("industry")->where('industry_id', $id)->get();
}

function Year()
{
    $year = [];
    for ($t = 1980; $t <= date('Y'); $t++) {
        array_push($year, $t);
    }
    return $year;
}

function restrictedMonths()
{
    $month = [];
    for ($t = 0; $t <= date('m'); $t++) {
        array_push($month, $t);
    }
    return $month;
}


function Months()
{
    $month = [];
    for ($t = 0; $t <= 12; $t++) {
        array_push($month, $t);
    }
    return $month;
}

function ExperienceMonths()
{
    $month = [];
    for ($t = 0; $t <= 12; $t++) {
        array_push($month, $t);
    }
    return $month;
}

function noticePeriod()
{
    return ['Serving Notice Period','Immediate', '15 Days', '1 Month', '2 Months', '3 Months', 'More than 3 Months'];
}

function MonthName()
{
    return ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep','Oct','Nov','Dec'];
}

function education()
{
    return ['10th', '12th', 'B.E', 'B.Com'];
}

function courses()
{
    return ['State Board', 'CBSE'];
}

function specialization()
{
    return ['Computer Science', 'Mechnical'];
}

function university()
{
    return ['Anna University', 'Bharathiyar University'];
}

function grade()
{
    return ['A', 'B'];
}

function city()
{
    return ['Chennai', 'Mumbai', 'Pune'];
}

function experience()
{
    $data = [];
    for ($t = 1; $t <= 30; $t++) {
        array_push($data, $t);
    }
    return $data;
}

function Gender()
{
    return ['Male', 'Female', 'Other'];
}

function Maritual()
{
    return ['Single', 'Married', 'Other'];
}

function Country()
{
    return ['America', 'Russia', 'Japan'];
}

function language()
{
    return ['English', 'Tamil', 'Hindi'];
}

function languageStrength()
{
    return ['Basic', 'Good', 'Proficient', 'Master'];
}

function SalaryLakhs(){
    $data = [];
    for ($t = 0; $t <= 20; $t++) {
        array_push($data, $t);
    }
    return $data;
}

function SalaryThousands(){
    $data = [];
    for ($t = 0; $t <= 18; $t++) {
        if($t ==0) array_push($data, 0);
        else array_push($data,$data[$t-1]+5);
    }
    return $data;
}

function educationGrades()
{
    return ['Scale 10 Grading System', 'Scale 4 Grading System', '% Marks of 100 Maximum', 'Course Requires a Pass'];
}

function employmentType()
{
    return array('Permanent', 'Temporary');
}

function YesNo()
{
    return array('Yes', 'No');
}

function SaveStatus()
{
    return array('Save', 'Save & Publish');
}

function Stop($value){
    echo '<pre>';
    print_r($value);
    exit;
}

function experienceGap()
{
    return array('0 -1', '1 - 3','3 - 5','5 - 10','10 - 15','15 +');
}



