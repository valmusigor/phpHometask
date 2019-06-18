<?
require_once('./services.php');
session_start();
checkAutorizeLoginPage($_SESSION['auth'], $_SESSION['id']);
?>
<html>
  <head><meta charset="utf-8"/></head>
    <body>
      <span style="color:red"><?(isset($_GET['error']))??''?></span>
      <form action="./auth.php" method="POST">
        <input type="text" name="login" placeholder="enter login" value="<?=(isset($_GET['login']))?$_GET['login']:'' ?>" />
        <input type="password" name="pass" placeholder="enter password" value="<?=(isset($_GET['pass']))?$_GET['pass']:'' ?>" />
        <button type="submit">Войти</button>
      </form>  
    </body>
</html>