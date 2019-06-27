<?php
namespace services;
use components\DB;
class File {
public static function findAllFiles($path){
            $dirs=scandir($path);
            if(count($dirs)>2)
            {
            foreach($dirs as $dir){
            if($dir === '.' || $dir === '..') {continue;} 
            if(is_file("$path/$dir")) {$result[]="$path/$dir";continue;} 
            $mas=findAllFiles("$path/$dir");
                if($mas){
                    foreach($mas as $dir) 
                    { 
                        $result[]=$dir; 
                    } 
                }
            }
            return $result;
           }
}
public static function uploadFile($result,$files){
    $arr=explode('.',$files['name']);
    $filename=md5($files['name'].rand(1,99).time()).'.'.$arr[count($arr)-1];
    $path='./uploadFile/images/'.$filename[0];
    mkdir($path,0777, true);
    move_uploaded_file($files['tmp_name'],$path.'/'. $filename);
    $insertId=DB::getInstance()->insert('files',["name"=>$filename,"time_upload"=>strtotime(date("Y-m-d H:i:s")),"userId"=>$result['userId'],]); 
    if(!$insertId)
      return false;
    return $insertId;
}
public static function getFiles($result){
    $files=DB::getInstance()->find('files',['userId'=>$result['userId']],'fileId ASC');
    if($files==='error'){
      return false;
      }
    return $files;
}
public static function findFileById($id){
    $result = DB::getInstance()->find('files',['fileId'=>$id]);
    if(!is_array($result) && count($result)===0)
      return false;
    if($result==='error')
    return false;
    return $result[0];
  }
public static function deleteFileFromBase($data){
  $delete=DB::getInstance()->delete('files',$data);
   if($delete==='error'){
      return false;
    }
  return true;
}
};