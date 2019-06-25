<? 
use services\{User,Task};
require_once("../autoloader.php");
session_start();
$result=User::Autorize($_SESSION['auth'], $_SESSION['id']);
if(!$result){
  header('Location:../login.php?error=Вы+неавторизированы');
  exit();
}
foreach($_GET as $key=>$value)
  $mas[explode("_", $key)[1]][explode("_", $key)[0]]=htmlspecialchars(str_replace('|','',trim($value)));
$success=true;
foreach($mas as $key=>$value){
  if(!Task::checkAccess($result['userId'],$key)){
    $success=false;
    break;
  }
  $update=Task::updateTask(['text'=>$value['edit'],'time_end'=>strtotime($value['hour'].':'.$value['minutes'].' '.$value['calendar'])],$key);
  if(!$update){
    $success=false;
    break;
  }
}
if(!$success)
header('Location:index.php?error=Ошибка+редактирования');
else header('Location:index.php');
 