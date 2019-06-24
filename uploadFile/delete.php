<?
use services\User;
use services\File;
require_once("../autoloader.php");
session_start();
$result=User::Autorize($_SESSION['auth'], $_SESSION['id']);
if(!$result){
  header('Location:../login.php?error=Вы+неавторизированы');
  exit();
}
if(!isset($_GET['fileId'])){
header('Location:index.php?error=Ошибка+удаления+файла');
exit();
}
$fileId=htmlspecialchars(str_replace(' ','',trim($_GET['fileId'])));
$file=File::findFileById($fileId);
if(!$file){
   header('Location:index.php?error=Ошибка+удаления+файла');
   exit();
}
$path='./images/'.$file['name'][0].'/'.$file['name'];
if(!file_exists($path)){
  header('Location:index.php?error=Файл+не+существует'); 
  exit();
}
if($result['userId']!=$file['userId'])
{
  header('Location:index.php?error=Нет+прав+доступа'); 
  exit();   
}
if(!unlink($path)){
   header('Location:index.php?error=Ошибка+удаления+файла'); 
}
else{
   $delete=File::deleteFileFromBase(['fileId'=>$file['fileId']]);
   if($delete===false){
      header('Location:index.php?error=Ошибка+удаления');
      exit(); 
    }
}
header('Location:index.php');