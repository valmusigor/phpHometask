<?
 if(file_exists($_GET['path'])){
    if(unlink($_GET['path']))
    header('Location:index.php');
    else header('Location:index.php?error=Ошибка+удаления+файла'); 
 }
 else header('Location:index.php?error=Ошибка+удаления+файла'); 