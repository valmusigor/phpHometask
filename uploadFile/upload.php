<?php
  if(isset($_FILES) && $_FILES['file']['error']===0){
   if(explode('/',$_FILES['file']['type'])[0]==='image'){
     uploadFile();
     header('Location:index.php');
   }
   else header('Location:index.php?error=Выберите+изображение+для+загрузки');
  }
  else header('Location:index.php?error=Ошибка+загрузки+файла');
 
  function uploadFile(){
    $arr=explode('.',$_FILES['file']['name']);
    $filename=md5($_FILES['file']['name'].rand(1,99).time()).'.'.$arr[count($arr)-1];
    $path='./images/'.$filename[0];
    mkdir($path,0777, true);
    move_uploaded_file($_FILES['file']['tmp_name'],$path.'/'. $filename);
  }