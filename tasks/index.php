<?
use services\{User,Task};
require_once("../autoloader.php");
require_once('../views/homePage/taskList.php');
session_start();
$result=User::Autorize($_SESSION['auth'], $_SESSION['id']);
if(!$result){
  header('Location:../login.php?error=Вы+неавторизированы');
  exit();
}
$tasks=Task::getTask(['userId'=>$result['userId']]);
if(!$tasks){
  header('Location:index.php?error=Ошибка+чтения');
  exit();
}
?>
<html>
    <head>
    <link href="../style/css/all.css" rel="stylesheet">
    <link href="../style/style.css" rel="stylesheet">
    </head>
    <body>
      <?
        if(isset($_GET['sort']) && $_GET['sort']=='up')
          $tasks=Task::getTask(['userId'=>$result['userId']],'ASC');
        else if(isset($_GET['sort']) && $_GET['sort']=='down')
        $tasks=Task::getTask(['userId'=>$result['userId']],'DESC');
        if(!$tasks){
          header('Location:index.php?error=Ошибка+чтения');
          exit();
        }
      ?>
        <div style="display:flex;justify-content:space-between">
        <? require_once('../views/homePage/formAddTask.php'); ?>
        <span><strong style="font-size:30px"><span class="logo"><a  href="../index.php"  title="на главную"><?=(isset($result['login']))?$result['login']:''?></a></span></strong><a href="../logout.php"><i class="fas fa-sign-out-alt fa-2x"></i></a></span>
      </div>
        <span>Сортировка по дате</span> <a href="index.php?sort=up">По возрастанию</a> <a href="index.php?sort=down">По убыванию</a> 
        <form action="./updateTask.php">
          <? taskList($tasks);?>
        </form>
        <?if(isset($_GET['error'])) echo "<div>".$_GET['error']."</div>"; ?>
        <script src="../scripts/createTaskEdit.js">
        </script>
    </body>
</html>