<?
if(file_exists($_GET['path']) && explode('/',mime_content_type($_GET['path'])[0]==='image')){
$fileArr=explode('/',$_GET['path']);
header("Content-Description: File Transfer\r\n");
header("Pragma: public\r\n");
header("Expires: 0\r\n");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0\r\n");
header("Cache-Control: public\r\n");
header("Content-Type:".mime_content_type($_GET['path']).";\r\n");
header("Content-Disposition: attachment; filename=\"".$fileArr[count($fileArr)-1]."\"\r\n");
readfile($_GET['path']);
}
else 
header('Location:index.php?error=Ошибка+загрузки+файла');