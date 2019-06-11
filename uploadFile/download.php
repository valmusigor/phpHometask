<?
if(isset($_GET['path'])){
  $path=htmlspecialchars(str_replace(' ','',trim($_GET['path'])));
  if(file_exists($path) && explode('/',mime_content_type($path)[0]==='image')){
    $fileArr=explode('/',$path);
    header("Content-Description: File Transfer\r\n");
    header("Pragma: public\r\n");
    header("Expires: 0\r\n");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0\r\n");
    header("Cache-Control: public\r\n");
    header("Content-Type:".mime_content_type($path).";\r\n");
    header("Content-Disposition: attachment; filename=\"".$fileArr[count($fileArr)-1]."\"\r\n");
    readfile($path);
  }
  else header('Location:index.php?error=Ошибка+загрузки+файла');
}
else header('Location:index.php?error=Ошибка+загрузки+файла');