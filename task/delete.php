<? 
$config=require_once('./config.php');
if(isset($_COOKIE['auth']) && $_COOKIE['auth']==='ok' && isset($_COOKIE['id']) && array_key_exists($_COOKIE['id'], $config)){
    if(isset($config[$_COOKIE['id']]['file']))
  {
    
if(file_exists($config[$_COOKIE['id']]['file'])){
  $handle=fopen($config[$_COOKIE['id']]['file'],'r');
  if(isset($handle)){
    while(($line=fgets($handle)))
        $lines[]=$line;
    fclose($handle);
    if(file_exists($config[$_COOKIE['id']]['file'])){
        $handle=fopen($config[$_COOKIE['id']]['file'],'w');
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
}else header('Location:login.php');