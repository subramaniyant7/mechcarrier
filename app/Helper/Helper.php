<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;

function admintype(){
    return array('Primary Admin','Super Admin','Sub Admin');
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
        print_r($e->getMessage());
        exit;
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

function checkImageExistByGallery($id)
{
    return DB::table("clients_gallery_images")->where('clients_gallery_images_galleryid', $id)->get();
}

function checkVideoExistByGallery($id)
{
    return DB::table("clients_gallery_videos")->where('clients_gallery_videos_galleryid', $id)->get();
}

function getSubCategoryById($id){
    return DB::table('sub_category')->where('sub_category_id', $id)->get();
}

function pageName(){
    $name = ['profile' => 'profile','who'=>'whoweare','vision'=> 'visionmission','why'=>'whyus','software' =>'software','medical'=>'medicalequipment',
            'bclad' =>'bioclad','pclad' =>'printclad','kclad' =>'kleenclad','faq'=>'faq','anti'=>'antimicrobialwallcladding','hygenic'=>'hygenicwallcladding',
            'wall'=>'wallprotection','ips'=>'ips','safety'=>'safetyflooring','doorsets'=>'doorsets','director'=>'directormessage',
            'photo'=>'photoclad','kclAnti'=>'kcladantimicrobialwallcladding','kclhygenic'=>'khygenicwallcladding','wallclad'=>'wallcladding','floorclad'=>'floorcladding',
            'construction'=>'constructionbyspecification','install'=>'installation','design'=>'design','develop'=>'develop','deliver'=>'deliver','maintain'=>'maintain',
            'privacy'=>'privacypolicy','terms'=>'termsconditions','home'=>'home','innov'=>'innovation','survivo'=>'survivowellness','goggle'=>'goggletech',
            'otproduct'=>'otproducts','ivf'=>'ivfproducts','ferti'=>'fertiassist','life'=>'lifewhisperer','soft'=>'software','ourteam'=>'ourteam'
        ];
    return $name;
}

function getSocialMedia(){
    $data =  DB::table("social_media")->where('status', 1);
    return $data->orderBy('social_media_id', 'desc')->get();
}


?>
