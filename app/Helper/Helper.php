<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;

function admintype(){
    return array('Primary Admin','Super Admin','Sub Admin');
}

function statusClass(){
    return array('badge badge-light-success','badge badge-light-danger','badge badge-light-secondary','badge badge-light-info');
}

function statustype(){
    return array('Active','De-Active');
}

function verifiedStatus(){
    return array('Activate','De-Activate');
}

function getActiveRecord($table){
    return DB::table($table)->where('status', 1)->get();
}

function getRecordData($table,$condition){
    return DB::table($table)->where($condition)->get();
}

function encryption($string,$root=''){
    if($root!='' && Session::get('admin_name') == 'root') return $string;
    return Crypt::encryptString($string);
}

function decryption($string,$root=''){
    if($root!='' && Session::get('admin_name') == 'root') return $string;
    return Crypt::decryptString($string);
}

function insertQuery($table,$data){
    $data['status'] = 1;
    $data['created_at'] = date('Y-m-d h:i:s', time());
    $data['updated_at'] = date('Y-m-d h:i:s', time());
    try{
        return DB::table($table)->insert($data);
    }catch(Exception $e){
        return false;
    }
}

function insertQueryId($table,$data){
    $data['status'] = 1;
    $data['created_at'] = date('Y-m-d h:i:s', time());
    $data['updated_at'] = date('Y-m-d h:i:s', time());
    try{
        return DB::table($table)->insertGetId($data);
    }catch(Exception $e){
        return false;
    }
}

function updateQuery($table,$match,$id,$data){
    try{
        $data['updated_at'] =  date('Y-m-d h:i:s', time());;
        $update = DB::table($table)->where($match, $id)->update($data);
        return true;
    }catch(Exception $e){
        return false;
    }
}

function deleteQuery($id,$table,$field){
    return  DB::table($table)->where($field, $id)->delete();
}

function notification($type= false){
    if($type){
        return ['type'=>'success','msg'=>'Data Saved Succesfully'];
    }
    return ['type'=>'error','msg'=>'Something went wrong... please try again'];
}

function getSocialMedia(){
    $data =  DB::table("social_media")->where('status', 1);
    return $data->orderBy('social_media_id', 'desc')->get();
}

function getSocialMediaLinks()
{
    return DB::table("social_media_links")->get();
}

?>
