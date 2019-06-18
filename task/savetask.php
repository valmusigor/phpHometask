<?
require_once('./services.php');
require_once('./taskServices.php');
require_once('./db.php');
session_start();
$result=Autorize($_SESSION['auth'], $_SESSION['id']);
$input=checkInputTaskData($_GET['task'],[$_GET['hour'],$_GET['minutes'],$_GET['calendar']]);
 if(!checkExist($input[1],$result['userId'])){
  header('Location:index.php?error=В+данное+время+запланирован+task+поменяйте+время+или+дату');
}

$insertId=DB::getInstance()->insert('tasks',["text"=>$input[0],"time_end"=>$input[1],"time_create"=>strtotime(date("Y-m-d H:i:s")), "userId"=>$result['userId'],]); 
if(!$insertId)
  header('Location:index.php?error=Ошибка+сохранения');
else header('Location:index.php');
?>