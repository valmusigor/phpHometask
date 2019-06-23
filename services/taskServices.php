<?
require_once('../components/db.php');
function checkInputTaskData($task,$data){
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
function checkExist($time_end,$id){
  $result = DB::getInstance()->find('tasks',['userId'=>$id, 'time_end'=>$time_end ]);
  if(is_array($result) && count($result)>0){
    return false;
  }
  return true;
}
//проверка на доступ к функциям update/delete
function checkAccess($userId, $tasksId){
  $result = DB::getInstance()->find('tasks',['id'=>$tasksId,'userId'=>$userId]);
  return (is_array($result) && count($result)===1)?true:false;
}