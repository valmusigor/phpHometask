<?
require_once('./db.php');
//авторизация пользователя
function Autorize($auth, $id){
  $result=findUserById($id);
  if(isset($auth) && $auth==='ok' && isset($id) && $id===$result['userId']){
    return $result;
}
else { header('Location:login.php');}
}
//если у пользователя открыта сессия
function checkAutorizeLoginPage($auth, $id){
  $result=findUserById($id); 
  if(isset($auth) && $auth==='ok' && isset($id) && $id==$result['userId']){
  header('Location:index.php');
  }
}
//поиск пользователя по id
function findUserById($id){
  $result = DB::getInstance()->find('users',['userId'=>$id]);
  if(!is_array($result))
    exit();
  return $result[0];
}
//аунтефикация пользователя
function findUserByAuthData($login,$pass){
    $result = DB::getInstance()->find('users',['login'=>$login,'pass'=>$pass]);
    if(!is_array($result)){
      header('Location:login.php?error=Ошибка+авторизации');
      exit();
    }
    if(count($result)===0){
    header("Location:login.php?error=Пользователь+с+такими+данными+не+существует&login={$login}&pass={$pass}");
    exit();
    }
    return $result[0];
}
function checkInputUserData($login,$pass,$auth=true){
    if(!isset($login) || !isset($pass)){
      header('Location:login.php?error=Ошибка+авторизации'); 
      exit();
    }
  $login=htmlspecialchars(str_replace(' ','',trim($login)));
  $pass=htmlspecialchars(str_replace(' ','',trim($pass)));
  if(strlen($login)===0 || strlen($pass)===0){
    header('Location:login.php?error=Некорректный+ввод'); 
    exit();
  }
  if($auth){
  return findUserByAuthData($login,$pass);
  }
  else return [$login,$pass];
}