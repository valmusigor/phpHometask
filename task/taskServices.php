<?
require_once('./db.php');
function checkInputTaskData($task,$data){
    if(!isset($task)){
      header('Location:index.php?error=Некорректный+ввод'); 
      exit();
    }
  foreach($data as $value)
  if(!isset($value)){
    header('Location:index.php?error=Некорректный+ввод'); 
    exit();
  }
  $task=htmlspecialchars(trim($task));
  if(strlen($task)===0){
    header('Location:index.php?error=Некорректный+ввод'); 
    exit();
  }
  $data_end=strtotime($data[0].':'.$data[1].' '.$data[2]);
  if($data_end<=strtotime(date("H:i Y-m-d")) ){
  header('Location:index.php?error=Неверно+введены+данные');
  exit();
  }
 return [$task,$data_end];
}
function checkExist($time_end,$id){
  $result = DB::getInstance()->find('tasks',['userId'=>$id, 'time_end'=>$time_end ]);
  if(is_array($result) && count($result)>0){
    header('Location:index.php?error=В+данное+время+запланирован+task+поменяйте+время+или+дату');
    exit();
  }
  return true;
}