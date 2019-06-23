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
?>
<html>
  <head><meta charset="utf-8"/></head>
    <body>
      <span style="color:red"><?=(isset($_GET['error']))?$_GET['error']:''?></span>
      <form action="./auth.php" method="POST">
        <input type="text" name="login" placeholder="enter login" value="<?=(isset($_GET['login']))?$_GET['login']:'' ?>" />
        <input type="password" name="pass" placeholder="enter password" value="<?=(isset($_GET['pass']))?$_GET['pass']:'' ?>" />
        <button type="submit">Войти</button>
      </form> 
      <a href="./register.php">Зарегестироваться</a> 
    </body>
</html>