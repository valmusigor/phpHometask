<?
use services\User;
require_once('./autoloader.php');
session_start();
if(isset($_SESSION['auth']) && isset($_SESSION['id'])){ 
  $result=User::checkAutorizeLoginPage($_SESSION['auth'], $_SESSION['id']);
  if($result){
    if(isset($result['access']) && $result['access']==='1'){
      header('Location:admin.php');
      exit();
    }
  header('Location:index.php');
  exit();
  }
}
require_once('./views/login/index.php');
?>
