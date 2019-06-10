<html>
    <head>
        <meta charset="utf-8"/>
        <link href='./style/style.css' rel="stylesheet"/>
    </head>
    <body>
        <form method="POST" action='upload.php' enctype="multipart/form-data">
          <input type="file" name="file" />
          <button type="submit">Отправить</button>
        </form>
        <? 
        if(isset($_GET['error']))
        echo $_GET['error'];
        $result=findAllFiles('./images');
        function cmp($arg1, $arg2)
         {
            $a=stat($arg1)['ctime'];
            $b=stat($arg2)['ctime'];
            if ($a == $b) {
                return 0;
        }
            return ($a < $b) ? -1 : 1;
        }
        usort($result,"cmp");
        ?>
        <div style="display:flex; flex-wrap:wrap;justify-content:space-around">
        <?
        foreach ($result as $value):
        ?>
        <div>
        <a href="<?=$value?>" style="margin-right:10px"><img width="100px" height="100px" src="<?=$value?>" /></a>
        <div style="text-align:center"><a href="./download.php?path=<?=$value?>" >cкачать</a> <a href="./delete.php?path=<?=$value?>" >удалить</a></div>
        </div>
        <?
        endforeach;
        function findAllFiles($path){
            $dirs=scandir($path);
            if(count($dirs)>2)
            {
            foreach($dirs as $dir){
            if($dir === '.' || $dir === '..') {continue;} 
            if(is_file("$path/$dir")) {$result[]="$path/$dir";continue;} 
            $mas=findAllFiles("$path/$dir");
                if($mas){
                    foreach($mas as $dir) 
                    { 
                        $result[]=$dir; 
                    } 
                }
            }
            return $result;
           }
        }
        ?>
        </div>
    </body>
</html>