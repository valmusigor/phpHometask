<?
namespace services;
use components\DB;
class Task{
public static function checkInputTaskData($task,$data){
    if(!isset($task)){
      return false;      
    }
  foreach($data as $value)
  if(!isset($value)){
    return false;
  }
  $task=htmlspecialchars(trim($task));
  if(strlen($task)===0){
    return false;
  }
  $data_end=strtotime($data[0].':'.$data[1].' '.$data[2]);
  if($data_end<=strtotime(date("H:i Y-m-d")) ){
  return false;
  }
 return [$task,$data_end];
}
public static function checkExist($time_end,$id){
  $result = DB::getInstance()->find('tasks',['userId'=>$id, 'time_end'=>$time_end ]);
  if(is_array($result) && count($result)>0){
    return false;
  }
  return true;
}
//проверка на доступ к функциям update/delete
public static function checkAccess($userId, $tasksId){
  $result = DB::getInstance()->find('tasks',['id'=>$tasksId,'userId'=>$userId]);
  return (is_array($result) && count($result)===1)?true:false;
}
public static function updateTask($data,$key){
  $update=DB::getInstance()->update('tasks',$data,$key);
  if($update==='error'){
    return false;
  }
  return true;
}
public static function insertTask($data){
  $insertId=DB::getInstance()->insert('tasks',$data); 
  if($insertId==='error'){
    return false;
  }
  return true;
}
public static function getTask($where,$sort=false){
  if(!$sort){
    $tasks=DB::getInstance()->find('tasks',$where);
  }
  else if($sort==='ASC'){
    $tasks=DB::getInstance()->find('tasks',$where,'time_end ASC');
  }
  else {
    $tasks=DB::getInstance()->find('tasks',$where,'time_end DESC');
  }
  if($tasks==='error'){
    return false;
  }
  return $tasks;
}
public static function deleteTask($where){
  $delete=DB::getInstance()->delete('tasks',$where);
  if($delete==='error'){
    return false;
  }
  return true;
}
};