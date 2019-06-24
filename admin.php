<?
use services\User;
require_once('./autoloader.php');
session_start();
if(!isset($_SESSION['auth']) || !isset($_SESSION['id'])){
    header('Location:login.php?error=Вы+неавторизированы');
    exit();
}
$result=User::Autorize($_SESSION['auth'],$_SESSION['id']);
if(!$result){
    header('Location:login.php?error=Вы+неавторизированы');
    exit();
  }
if(isset($result['access']) && $result['access']==='1')
echo "<h1>Hello ADMIN!</h1>";
else header('Location:index.php');
require_once('./views/adminPage/index.php');
?>