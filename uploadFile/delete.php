<?
if(isset($_GET['path'])){
   $path=htmlspecialchars(str_replace(' ','',trim($_GET['path'])));
   if(file_exists($path)){
      if(unlink($path))
      header('Location:index.php');
      else header('Location:index.php?error=Ошибка+удаления+файла'); 
   }
   else header('Location:index.php?error=Ошибка+удаления+файла'); 
}
else header('Location:index.php?error=Ошибка+удаления+файла');