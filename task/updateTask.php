<? 
require_once('./services.php');
$userData=Autorize($_COOKIE['auth'],$_COOKIE['id']);

  if(isset($userData['file']))
{
  
foreach($_GET as $key=>$value)
$mas[explode("_", $key)[1]][explode("_", $key)[0]]=htmlspecialchars(str_replace('|','',trim($value)));
$counter=0;
$ind=false;
if(file_exists($userData['file'])){
  $handle=fopen($userData['file'],'r');
  if(isset($handle)){
    while(($line=fgets($handle))){
      $str='';
      if(isset($mas[$counter])){ 
        if(strlen($mas[$counter]['edit'])==0){
        $ind=true;
        break;
      }
      else $lines[]=$mas[$counter]['edit'].'|'.$mas[$counter]['hour'].':'.$mas[$counter]['minutes'].
      ' '.$mas[$counter]['calendar'].'|'.explode("|", $line)[2];
      }
      else
        $lines[]=$line;
        $counter++;
    }
    fclose($handle);
    if($ind)
      header('Location:index.php?error=Ошибка+редактирования');
    else if(file_exists($userData['file'])){
      $handle=fopen($userData['file'],'w');
      if(isset($handle)){
        for($i=0;$i<count($lines);$i++){
          fputs($handle, $lines[$i]);
        }
        fclose($handle);
        header('Location:index.php');
      } 
      else header('Location:index.php?error=Ошибка+записи+файла');
    }
    else header('Location:index.php?error=Запрашиваемый+файл+не+существует');
  }
  else header('Location:index.php?error=Ошибка+чтения+файла');   
} else header('Location:index.php?error=Запрашиваемый+файл+не+существует');

}