<?
use services\User;
require_once('./autoloader.php');
session_start();
$result=User::Autorize($_SESSION['auth'], $_SESSION['id']);
if(!$result){
  header('Location:login.php?error=Вы+неавторизированы');
  exit();
}
session_destroy();
session_abort();
session_reset();
header('Location:login.php');
