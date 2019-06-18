<?
require_once('./services.php');
session_start();
Autorize($_SESSION['auth'], $_SESSION['id']);
session_destroy();
session_abort();
session_reset();
header('Location:login.php');
