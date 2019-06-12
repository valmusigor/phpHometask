<?
if(isset($_COOKIE['auth']) && $_COOKIE['auth']==='ok' && isset($_COOKIE['id']) && array_key_exists($_COOKIE['id'], require_once('./config.php')))
header('Location:index.php');
else {
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
<?}?>