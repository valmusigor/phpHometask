   <div style="display:flex; flex-wrap:wrap;justify-content:space-around">
        <?
        foreach ($files as $value):
        $filePath='/uploadFile/images'.'/'.$value['name'][0].'/'.$value['name'];
        ?>
        <div>
        <a href="<?=$filePath?>" style="margin-right:10px"><img width="100px" height="100px" src="<?=$filePath?>" /></a>
        <div style="text-align:center"><a href="/cabinet/file/download/<?=$value['fileId']?>" >cкачать</a> <a href="/cabinet/file/delete/<?=$value['fileId']?>">удалить</a></div>
        </div>
        <? endforeach; ?>
    </div>
 