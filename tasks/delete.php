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
$id=htmlspecialchars(trim($_GET['id']));
if(!isset($id) || !checkAccess($result['userId'],$id)){
  header('Location:index.php?error=Ошибка+удаления');
  exit(); 
}

$delete=DB::getInstance()->delete('tasks',['id'=>$id]);
if($delete==='error'){
  header('Location:index.php?error=Ошибка+удаления');
  exit(); 
}
header('Location:index.php');

 
