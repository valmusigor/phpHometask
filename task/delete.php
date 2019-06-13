<? 
require_once('./services.php');
$userData=Autorize($_COOKIE['auth'],$_COOKIE['id']);
    if(isset($userData['file']))
  {
    
if(file_exists($userData['file'])){
  $handle=fopen($userData['file'],'r');
  if(isset($handle)){
    while(($line=fgets($handle)))
        $lines[]=$line;
    fclose($handle);
    if(file_exists($userData['file'])){
        $handle=fopen($userData['file'],'w');
        if(isset($handle)){
            for($i=0;$i<count($lines);$i++){
            if($i==$_GET['id'])
                continue;
                fputs($handle, $lines[$i]);
            }
        fclose($handle);
        }
    }
  }
}
header('Location:index.php');
  }