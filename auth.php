<?
require_once('./services/services.php');
session_start();
if(isset($_SESSION['auth']) && isset($_SESSION['id'])){ 
  $result=checkAutorizeLoginPage($_SESSION['auth'], $_SESSION['id']);
  if($result){
    if(isset($result['access']) && $result['access']==='1'){
      header('Location:admin.php');
      exit();
    }
  header('Location:index.php');
  exit();
  }
}
$result=checkInputUserData($_POST['login'],$_POST['pass']);
if(!$result){
  header('Location:login.php?error=Некорректный+ввод'); 
  exit();
}
$result=findUserByAuthData($result['login'],$result['pass']);
if(!$result){
  header("Location:login.php?error=Пользователь+с+такими+данными+не+найден&login={$login}&pass={$pass}");
  exit();
}
$_SESSION['auth']='ok';
$_SESSION['id']=$result['userId'];
if($result['access']==='1') 
  header('Location:admin.php');
else
  header('Location:index.php');

  
