<? 
if(@$handle=fopen('tasks.txt','r')){
            while(($line=fgets($handle)))
            $lines[]=$line;
            
fclose($handle);
if(@$handle=fopen('tasks.txt','w')){
for($i=0;$i<count($lines);$i++){
    if($i==$_GET['id'])
    continue;
   fputs($handle, $lines[$i]);
}
fclose($handle);
}
}
header('Location:index.php');
