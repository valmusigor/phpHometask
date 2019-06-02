<? 
foreach($_GET as $key=>$value)
$mas[explode("_", $key)[1]][explode("_", $key)[0]]=htmlspecialchars(str_replace('|','',trim($value)));
echo"<pre>";
print_r($mas);
echo"</pre>";
$counter=0;
$ind=false;
if(@$handle=fopen('tasks.txt','r')){
    while(($line=fgets($handle))){
     $str='';
    if(isset($mas[$counter])){ 
      if(strlen($mas[$counter]['edit'])==0){
      $ind=true;
      break;
      }
      else
      $lines[]=$mas[$counter]['edit'].'|'.$mas[$counter]['hour'].':'.$mas[$counter]['minutes'].' '.$mas[$counter]['calendar'].'|'.explode("|", $line)[2];
    }
    else
    $lines[]=$line;
    $counter++;
    }
fclose($handle);
if($ind)
header('Location:index.php?error=Ошибка+редактирования');
else if(@$handle=fopen('tasks.txt','w')){
    for($i=0;$i<count($lines);$i++){
       fputs($handle, $lines[$i]);
    }
    fclose($handle);
    header('Location:index.php');
    }
   
}
