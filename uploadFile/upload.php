<?php
use services\User;
use services\File;
require_once("../autoloader.php");
session_start();
$result=User::Autorize($_SESSION['auth'], $_SESSION['id']);
if(!$result){
  header('Location:../login.php?error=Вы+неавторизированы');
  exit();
}
  if(isset($_FILES['file']['error']) && $_FILES['file']['error']===0 &&  isset($_FILES['file']['name']) && isset($_FILES['file']['tmp_name']) && file_exists($_FILES['file']['tmp_name'])){
   if(isset($_FILES['file']['type']) && explode('/',$_FILES['file']['type'])[0]==='image'){
    $insertId=File::uploadFile($result,$_FILES['file']);
    if(!$insertId){
     header('Location:index.php?error=Ошибка+сохранения');
     }
     header('Location:index.php');
   }
   else header('Location:index.php?error=Выберите+изображение+для+загрузки');
  }
  else header('Location:index.php?error=Ошибка+загрузки+файла');
 
