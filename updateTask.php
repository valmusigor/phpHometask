<? 
foreach($_GET as $key=>$value)
$mas[explode("_", $key)[1]][explode("_", $key)[0]]=$value;
echo"<pre>";
print_r($mas);
echo"</pre>";
$counter=0;

if(@$handle=fopen('tasks.txt','r')){
    while(($line=fgets($handle))){
     $str='';
    if(isset($mas[$counter])){ 
      $lines[]=$mas[$counter]['edit'].'|'.$mas[$counter]['hour'].':'.$mas[$counter]['minutes'].' '.$mas[$counter]['calendar'].PHP_EOL;
    }
    else
    $lines[]=$line;
    $counter++;
    }
fclose($handle);
if(@$handle=fopen('tasks.txt','w')){
    for($i=0;$i<count($lines);$i++){
       fputs($handle, $lines[$i]);
    }
    fclose($handle);
    }
}
header('Location:index.php');
