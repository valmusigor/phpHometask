<?
if(isset($_GET['task'])){  
  $str=htmlspecialchars(str_replace('|','',trim($_GET['task'])));
  if (strtotime($_GET['hour'].':'.$_GET['minutes'].' '.$_GET['calendar'])<=strtotime(date("H:i Y-m-d")) || strlen($str)==0)
    header('Location:index.php?error=Неверно+введены+данные');
  else if(file_exists('tasks.txt')){
      $handle=fopen('tasks.txt','a');
      if(isset($handle)){
        fputs($handle,$str.'|'.$_GET['hour'].':'.$_GET['minutes'].' '.$_GET['calendar'].'|'.date("Y-m-d H:i:s").PHP_EOL);
        fclose($handle);
        header('Location:index.php');
      } else header('Location:index.php?error=Запрашиваемый+файл+не+существует');
  }
  else header('Location:index.php?error=Запрашиваемый+файл+не+существует');
}
?>