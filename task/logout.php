<?
if(isset($_COOKIE['auth']) && isset($_COOKIE['id'])){
 setcookie('auth',time()-3600);
 setcookie('id',time()-3600);
 header('Location:login.php');
} else header('Location:login.php');