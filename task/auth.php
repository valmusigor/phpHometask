<?
require_once('./services.php');
session_start();
checkAutorizeLoginPage($_SESSION['auth'], $_SESSION['id']);
$result=checkInputUserData($_POST['login'],$_POST['pass']);
$_SESSION['auth']='ok';
$_SESSION['id']=$result['userId'];
if($result['login']==='admin') 
  header('Location:admin.php');
else
  header('Location:index.php');

  
