<?
if(isset($_GET['task'])){
            $handle=fopen('tasks.txt','a');
            fputs($handle,$_GET['task'].'|'.$_GET['hour'].':'.$_GET['minutes'].' '.$_GET['calendar'].PHP_EOL);
            fclose($handle);
        }
header('Location:index.php');
?>