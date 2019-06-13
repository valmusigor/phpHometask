<?
function Autorize($auth, $id){
 $config=require_once('./config.php');

if(isset($auth) && $auth==='ok' && isset($id) && array_key_exists($id, $config)){
 return $config[$id];
}
else { header('Location:login.php');}
}