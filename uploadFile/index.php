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
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <link href="../style/css/all.css" rel="stylesheet">
        <link href='../style/style.css' rel="stylesheet"/>
    </head>
    <body>
    <div style="display:flex;justify-content:space-between">
        <form method="POST" action='upload.php' enctype="multipart/form-data">
          <input type="file" name="file" />
          <button type="submit">Отправить</button>
        </form>
        <span><strong style="font-size:30px"><span class="logo"><a  href="../index.php"  title="на главную"><?=(isset($result['login']))?$result['login']:''?></a></span></strong><a href="../logout.php"><i class="fas fa-sign-out-alt fa-2x"></i></a></span>
    </div>
        <? 
        if(isset($_GET['error'])){
        $error=htmlspecialchars(trim($_GET['error']));
        echo $error;
        }
        ?>

        <?
        $files=File::getFiles($result);
        if(is_array($files) && count($files)>0){
            
        ?>
          <div style="display:flex; flex-wrap:wrap;justify-content:space-around">
        <?
        foreach ($files as $value):
        $filePath='./images/'.$value['name'][0].'/'.$value['name'];
        ?>
        <div>
        <a href="<?=$filePath?>" style="margin-right:10px"><img width="100px" height="100px" src="<?=$filePath?>" /></a>
        <div style="text-align:center"><a href="./download.php?path=<?=$filePath?>" >cкачать</a> <a href="./delete.php?fileId=<?=$value['fileId']?>">удалить</a></div>
        </div>
        <?
        endforeach;
        }
        ?>
        </div>
    </body>
</html>