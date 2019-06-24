<?
function autoloder($class){
$path=__DIR__."/".str_replace("\\",'/',$class).".php";
echo $path."<br>";
if(file_exists($path)){
    require_once($path);
}
}
spl_autoload_register('autoloder');