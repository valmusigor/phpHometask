<?

require_once('./services.php');
require_once('./views/homePage/taskList.php');
$userData=Autorize($_COOKIE['auth'],$_COOKIE['id']);
  if(isset($userData['file']))
{
  
?>
<html>
    <head>
    <link href="./style/css/all.css" rel="stylesheet">
    <link href="./style/style.css" rel="stylesheet">
    </head>
    <body>
      <?if(file_exists($userData['file'])){
        $handle=fopen($userData['file'],'r');
         if(isset($handle)){
            while(($line=fgets($handle))){
              $lines[strtotime((explode("|", $line)[1]))]=$line;
            }
            fclose($handle);
            if(isset($_GET['sort']) && $_GET['sort']=='up')
            ksort($lines);
            else if(isset($_GET['sort']) && $_GET['sort']=='down')
            krsort($lines);
          }
        } ?>
        <div style="display:flex;justify-content:space-between">
        <? require_once('./views/homePage/formAddTask.php'); ?>
        <span><strong style="font-size:30px"><?=(isset($userData['login']))?$userData['login']:''?></strong><a href="./logout.php"><i class="fas fa-sign-out-alt fa-2x"></i></a></span>
      </div>
        <span>Сортировка по дате</span> <a href="index.php?sort=up">По возрастанию</a> <a href="index.php?sort=down">По убыванию</a> 
        <form action="./updateTask.php">
          <? taskList($userData,$lines);?>
        </form>
        <?if(isset($_GET['error'])) echo "<div>".$_GET['error']."</div>"; ?>
        <script src="./scripts/createTaskEdit.js">
        </script>
    </body>
</html>
<?
}