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
$result=User::checkInputUserData($_POST['login'],$_POST['pass']);
$email=User::checkEmail($_POST['email']);
if(!$result || !$email){
  header('Location:register.php?error=Некорректный+ввод'); 
  exit();
}
$exist=User::checkExistRegData(['login'=>$result['login'],'email'=>$email]);
if(!$exist){
  header('Location:register.php?error=Пользователь+с+такими+данными+существует'); 
  exit();
}
$id=User::insertData(['login'=>$result['login'],'pass'=>password_hash ($result['pass'],PASSWORD_DEFAULT),'email'=>$email,'access'=>0]);
if(!$id){
  header('Location:register.php?error=Ошибка+записи'); 
  exit();
}
$_SESSION['auth']='ok';
$_SESSION['id']=$id;
if($result['login']==='admin') 
  header('Location:admin.php');
else
  header('Location:index.php');

  
