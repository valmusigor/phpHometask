<?
namespace controllers;
use services\{User,Task};
class HomeController{
    public function actionIndex($type=false){
    $result=User::Autorize();
    if(!$result){
      header('Location:/login?error=Вы+неавторизированы');
      exit();
    }
    if(isset($result['access']) && $result['access']==='1')
    {
      header('Location:/cabinet/admin');
      exit();
    }
    require_once('./views/homePage/index.php');
  }
  public function actionAdmin(){
    $result=User::Autorize();
    if(!$result){
      header('Location:/login?error=Вы+неавторизированы');
      exit();
    }
    if(isset($result['access']) && $result['access']==='1')
      echo "<h1>Hello ADMIN!</h1>";
    else header('Location:/');
    require_once('./views/adminPage/index.php');
  }
};