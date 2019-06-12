<?
$config=require_once('./config.php');
$exist=false;
if(isset($_COOKIE['auth']) && $_COOKIE['auth']==='ok' && isset($_COOKIE['id']) && array_key_exists($_COOKIE['id'], $config)){
    if(isset($config[$_COOKIE['id']]['file'])){
      if(isset($_GET['task'])){  
        $str=htmlspecialchars(str_replace('|','',trim($_GET['task'])));
        if(strtotime($_GET['hour'].':'.$_GET['minutes'].' '.$_GET['calendar'])<=strtotime(date("H:i Y-m-d")) || strlen($str)==0)
          header('Location:index.php?error=Неверно+введены+данные');
        else if(file_exists($config[$_COOKIE['id']]['file'])){
          $handle=fopen($config[$_COOKIE['id']]['file'],'r');
          if(isset($handle)){
         while(($line=fgets($handle))){
        if(strtotime(explode("|", $line)[1])===strtotime($_GET['hour'].':'.$_GET['minutes'].' '.$_GET['calendar']))
        {
          
          $exist=true;
          break;
      }
    }
      fclose($handle);
      if($exist) header('Location:index.php?error=В+данное+время+запланирован+task+поменяйте+время+или+дату');
      else{
        $handle=fopen($config[$_COOKIE['id']]['file'],'a');
      if(isset($handle)){
        fputs($handle,$str.'|'.$_GET['hour'].':'.$_GET['minutes'].' '.$_GET['calendar'].'|'.date("Y-m-d H:i:s").PHP_EOL);
        fclose($handle);
        header('Location:index.php');
      } else header('Location:index.php?error=Запрашиваемый+файл+не+существует');
      }
    }
  }
  else {
    $handle=fopen($config[$_COOKIE['id']]['file'],'a');
      if(isset($handle)){
        fputs($handle,$str.'|'.$_GET['hour'].':'.$_GET['minutes'].' '.$_GET['calendar'].'|'.date("Y-m-d H:i:s").PHP_EOL);
        fclose($handle);
        header('Location:index.php');
      } else header('Location:index.php?error=Запрашиваемый+файл+не+существует');
  }
}
}
}else header('Location:login.php');
?>