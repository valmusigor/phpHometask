<?
namespace controllers;
use services\{User,File};
class FileController{
    public function actionIndex($type=false){
    $result=User::Autorize();
    if(!$result){
      header('Location:/login?error=Вы+неавторизированы');
      exit();
    }
    require_once('./views/fileHeap/index.php');
    if(isset($_GET['error'])){
      $error=htmlspecialchars(trim($_GET['error']));
      echo $error;
      }
    $files=File::getFiles($result);
        if(is_array($files) && count($files)>0){
      require_once('./views/fileHeap/fileList.php');
    }
    require_once('./views/fileHeap/endHtml.php');
    }
    public function actionUpload(){
    $result=User::Autorize();
    if(!$result){
      header('Location:/login?error=Вы+неавторизированы');
      exit();
    } 
    if(isset($_FILES['file']['error']) && $_FILES['file']['error']===0 &&  isset($_FILES['file']['name']) && isset($_FILES['file']['tmp_name']) && file_exists($_FILES['file']['tmp_name'])){
      if(isset($_FILES['file']['type']) && explode('/',$_FILES['file']['type'])[0]==='image'){
       $insertId=File::uploadFile($result,$_FILES['file']);
       if(!$insertId){
        header('Location:/cabinet/file?error=Ошибка+сохранения');
        }
        header('Location:/cabinet/file');
      }
      else header('Location:/cabinet/file?error=Выберите+изображение+для+загрузки');
     }
     else header('Location:/cabinet/file?error=Ошибка+загрузки+файла');
    }
    
    public function actionDelete($id){
      $result=User::Autorize();
      if(!$result){
        header('Location:/login?error=Вы+неавторизированы');
        exit();
      }
      if(!isset($id)){
        header('Location:/cabinet/file?error=Ошибка+удаления+файла');
        exit();
        }
        $file=File::findFileById(htmlspecialchars(str_replace(' ','',trim($id))));
        if(!$file){
           header('Location:/cabinet/file?error=Ошибка+удаления+файла');
           exit();
        }
        $path='./uploadFile/images/'.$file['name'][0].'/'.$file['name'];
        if(!file_exists($path)){
          header('Location:/cabinet/file?error=Файл+не+существует'); 
          exit();
        }
        if($result['userId']!=$file['userId'])
        {
          header('Location:/cabinet/file?error=Нет+прав+доступа'); 
          exit();   
        }
        if(!unlink($path)){
           header('Location:/cabinet/file?error=Ошибка+удаления+файла'); 
        }
        else{
           $delete=File::deleteFileFromBase(['fileId'=>$file['fileId']]);
           if($delete===false){
              header('Location:/cabinet/file?error=Ошибка+удаления');
              exit(); 
            }
        }
        header('Location:/cabinet/file');
    
        }
    public function actionDownload($id){
      $result=User::Autorize();
      if(!$result){
        header('Location:/login?error=Вы+неавторизированы');
        exit();
      }
      if(isset($id)){
        $id=htmlspecialchars(str_replace(' ','',trim($id)));
        $file=File::findFileById($id);
        if(!$file){
          header('Location:index.php?error=Файл+не+найден');
          exit();
        }
        $path='./uploadFile/images/'.$file['name'][0].'/'.$file['name'];
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
        else header('Location:/cabinet/file?error=Ошибка+загрузки+файла');
      }
      else header('Location:/cabinet/file?error=Ошибка+загрузки+файла');
    }
};