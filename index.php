<?
use services\User;
require_once('./autoloader.php');
session_start();
$result=User::Autorize($_SESSION['auth'], $_SESSION['id']);
if(!$result){
  header('Location:login.php?error=Вы+неавторизированы');
  exit();
}
if(isset($result['access']) && $result['access']==='1')
{
  header('Location:admin.php');
  exit();
}
require_once('./views/homePage/index.php');
?>