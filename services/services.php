<?
require_once(__DIR__.'/../components/db.php');
//авторизация пользователя
function Autorize($auth, $id){
  $result=findUserById($id);
  if(isset($auth) && $auth==='ok' && isset($id) && $id===$result['userId']){
    return $result;
}
else { return false;}
}
//если у пользователя открыта сессия
function checkAutorizeLoginPage($auth, $id){
  $result=findUserById($id); 
  if($auth==='ok' && $id==$result['userId']){
  return $result;
  }
  return false;
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
    $result = DB::getInstance()->find('users',['login'=>$login,'email'=>$login],false,'OR');
    if(!is_array($result)){
      return false;
    }
    if(count($result)===0){
    return false;
    }
    return (password_verify($pass,$result[0]['pass']))?$result[0]:false;
}
//проверка данных пользователя
function checkInputUserData($login,$pass){
    if(!isset($login) || !isset($pass)){
      return false;
    }
  $login=htmlspecialchars(str_replace(' ','',trim($login)));
  $pass=htmlspecialchars(str_replace(' ','',trim($pass)));
  if(strlen($login)===0 || strlen($pass)===0){
    return false;
  }
  return ['login'=>$login,'pass'=>$pass];
}
//проверка на валидность email
function checkEmail($email){
  if(!isset($email)){
    return false;
  }
  $email=htmlspecialchars(str_replace(' ','',trim($email)));
  return (filter_var($email, FILTER_VALIDATE_EMAIL))?$email:false;
}
//проверка на существование пользователя с заданными данными
function checkExistRegData($data)
{
  $result = DB::getInstance()->find('users',$data, false,'OR');
  if(is_array($result) && count($result)>0){
    return false;
  }
  return true;
}
//добавление пользователя в таблицу
function insertData($data)
{
  $insertId=DB::getInstance()->insert('users',$data);
  return ($insertId)?$insertId:false;
}