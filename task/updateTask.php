<? 
require_once('./services.php');
require_once('./db.php');
session_start();
$result=Autorize($_SESSION['auth'], $_SESSION['id']);
foreach($_GET as $key=>$value)
  $mas[explode("_", $key)[1]][explode("_", $key)[0]]=htmlspecialchars(str_replace('|','',trim($value)));
 $success=true;
foreach($mas as $key=>$value){
  $update=DB::getInstance()->update('tasks',['text'=>$value['edit'],'time_end'=>strtotime($value['hour'].':'.$value['minutes'].' '.$value['calendar'])],$key);
  if($update==='error'){
    $success=false;
    break;
  }
}
if(!$success)
header('Location:index.php?error=Ошибка+редактирования');
else header('Location:index.php');
 