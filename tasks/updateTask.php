<? 
require_once('../services/services.php');
require_once('../services/taskServices.php');
require_once('../components/db.php');
session_start();
$result=Autorize($_SESSION['auth'], $_SESSION['id']);
if(!$result){
  header('Location:../login.php?error=Вы+неавторизированы');
  exit();
}
foreach($_GET as $key=>$value)
  $mas[explode("_", $key)[1]][explode("_", $key)[0]]=htmlspecialchars(str_replace('|','',trim($value)));
$success=true;
foreach($mas as $key=>$value){
  if(!checkAccess($result['userId'],$key)){
    $success=false;
    break;
  }
  $update=DB::getInstance()->update('tasks',['text'=>$value['edit'],'time_end'=>strtotime($value['hour'].':'.$value['minutes'].' '.$value['calendar'])],$key);
  if($update==='error'){
    $success=false;
    break;
  }
}
if(!$success)
header('Location:index.php?error=Ошибка+редактирования');
else header('Location:index.php');
 