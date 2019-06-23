<?php
require_once('./services/services.php');
session_start();
if(!isset($_SESSION['auth']) || !isset($_SESSION['id'])){
    header('Location:login.php?error=Вы+неавторизированы');
    exit();
}
$result=Autorize($_SESSION['auth'],$_SESSION['id']);
if(!$result){
    header('Location:login.php?error=Вы+неавторизированы');
    exit();
  }
if(isset($result['access']) && $result['access']==='1')
echo "<h1>Hello ADMIN!</h1>";
else header('Location:index.php');
?>
<html>
    <head>
    <link href="./style/css/all.css" rel="stylesheet">
    <link href="./style/style.css" rel="stylesheet">
    </head>
    <body>
      <div style="display:flex;justify-content:space-between;font-size:30px">
      <div class="wrap">
        <div class="menu" ><a class="item" href="./tasks/">task list</a></div>
        <div class="menu" ><a class="item" href="./uploadFile/">file heap</a></div>
      </div> 
        <div><strong style="vertical-align:top"><?=(isset($result['login']))?$result['login']:''?></strong><a href="./logout.php"><i class="fas fa-sign-out-alt fa-lg"></i></a></div>
      </div>
    </body>
</html>