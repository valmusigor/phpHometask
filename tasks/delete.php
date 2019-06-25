<? 
use services\{User,Task};
require_once("../autoloader.php");
session_start();
$result=User::Autorize($_SESSION['auth'], $_SESSION['id']);
if(!$result){
  header('Location:../login.php?error=Вы+неавторизированы');
  exit();
}
$id=htmlspecialchars(trim($_GET['id']));
if(!isset($id) || !Task::checkAccess($result['userId'],$id)){
  header('Location:index.php?error=Ошибка+удаления');
  exit(); 
}

$delete=Task::deleteTask(['id'=>$id]);
if(!$delete){
  header('Location:index.php?error=Ошибка+удаления');
  exit(); 
}
header('Location:index.php');

 
