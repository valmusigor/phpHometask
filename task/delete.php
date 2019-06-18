<? 
require_once('./services.php');
require_once('./db.php');
session_start();
$result=Autorize($_SESSION['auth'], $_SESSION['id']);
$id=htmlspecialchars(trim($_GET['id']));
if(!isset($id)){
  header('Location:index.php?error=Ошибка+удаления');
  exit(); 
}
$delete=DB::getInstance()->delete('tasks',['id'=>$id]);
if($delete==='error'){
  header('Location:index.php?error=Ошибка+удаления');
  exit(); 
}
header('Location:index.php');

 
