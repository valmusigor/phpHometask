<?
namespace services;
use components\DB;
class User{
//авторизация пользователя
public static function Autorize(){
  session_start();
  $auth=$_SESSION['auth'];
  $id=$_SESSION['id'];
  $result=self::findUserById($id);
  if(isset($auth) && $auth==='ok' && isset($id) && $id===$result['userId']){
    return $result;
}
else { return false;}
}
//если у пользователя открыта сессия
public static function checkAutorizeLoginPage(){
  session_start();
  if(!isset($_SESSION['auth']) || !isset($_SESSION['id'])){ 
  return false;
  }
  $auth=$_SESSION['auth'];
  $id=$_SESSION['id'];
  $result=self::findUserById($id); 
  if($auth==='ok' && $id==$result['userId']){
  return $result;
  }
  return false;
}
//поиск пользователя по id
public static function findUserById($id){
  $result = DB::getInstance()->find('users',['userId'=>$id]);
  if(!is_array($result))
    exit();
  return $result[0];
}
//аунтефикация пользователя
public static function findUserByAuthData($login,$pass){
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
public static function checkInputUserData($login,$pass){
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
public static function checkEmail($email){
  if(!isset($email)){
    return false;
  }
  $email=htmlspecialchars(str_replace(' ','',trim($email)));
  return (filter_var($email, FILTER_VALIDATE_EMAIL))?$email:false;
}
//проверка на существование пользователя с заданными данными
public static function checkExistRegData($data)
{
  $result = DB::getInstance()->find('users',$data, false,'OR');
  if(is_array($result) && count($result)>0){
    return false;
  }
  return true;
}
//добавление пользователя в таблицу
public static function insertData($data)
{
  $insertId=DB::getInstance()->insert('users',$data);
  return ($insertId)?$insertId:false;
}

};