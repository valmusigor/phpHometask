<?
if(isset($_GET['task'])){  
    $str=htmlspecialchars(str_replace('|','',trim($_GET['task'])));
            if (strtotime($_GET['hour'].':'.$_GET['minutes'].' '.$_GET['calendar'])<=strtotime(date("H:i Y-m-d")) || strlen($str)==0)
            header('Location:index.php?error=Неверно+введены+данные');
            else{
            $handle=fopen('tasks.txt','a');
            fputs($handle,$str.'|'.$_GET['hour'].':'.$_GET['minutes'].' '.$_GET['calendar'].'|'.date("Y-m-d H:i:s").PHP_EOL);
            header('Location:index.php');
            fclose($handle);
            }
        }

?>