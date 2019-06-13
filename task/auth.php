<?
$config=require_once('./config.php');
if(isset($_COOKIE['auth']) && $_COOKIE['auth']==='ok' && isset($_COOKIE['id']) && array_key_exists($_COOKIE['id'], $config ))
header('Location:index.php');
else {
if(isset($_POST['login']) && isset($_POST['pass'])){
  $login=htmlspecialchars(str_replace(' ','',trim($_POST['login'])));
  $pass=htmlspecialchars(str_replace(' ','',trim($_POST['pass'])));
    if(strlen($login)!==0 || strlen($pass)!==0){
      $success=false;
      foreach($config as $key=>$value){
          if($value['login']===$login && $value['pass']===$pass){
              setcookie('auth','ok');
              setcookie('id',$key);
              $success=true;
              break;
          }
      }
      if($success) {if($login==='admin') header('Location:admin.php'); else header('Location:index.php');}
      else header("Location:login.php?error=Пользователь+с+такими+данными+не+существует&login={$_POST['login']}&pass={$_POST['pass']}");  
    } else header('Location:login.php?error=Некорректный+ввод');  
}
else header('Location:login.php?error=Ошибка+авторизации');   
}