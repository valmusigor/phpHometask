<?
require_once('./services/services.php');
session_start();
$result=Autorize($_SESSION['auth'], $_SESSION['id']);
if(!$result){
  header('Location:login.php?error=Вы+неавторизированы');
  exit();
}
session_destroy();
session_abort();
session_reset();
header('Location:login.php');
