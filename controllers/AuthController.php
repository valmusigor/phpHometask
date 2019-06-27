<?
namespace controllers;
use services\{User,Task};
class AuthController{
   public function actionIndex(){
    $result=User::checkAutorizeLoginPage();
    if($result){
      if(isset($result['access']) && $result['access']==='1'){
        header('Location:/cabinet/admin');
        exit();
    }
    header('Location:/');
    exit();
    }
    $result=User::checkInputUserData($_POST['login'],$_POST['pass']);
    if(!$result){
      header('Location:/login?error=Некорректный+ввод'); 
      exit();
    }
    $result=User::findUserByAuthData($result['login'],$result['pass']);
    if(!$result){
      header("Location:/login?error=Пользователь+с+такими+данными+не+найден&login={$login}&pass={$pass}");
      exit();
    }
    $_SESSION['auth']='ok';
    $_SESSION['id']=$result['userId'];
    if($result['access']==='1') 
      header('Location:/cabinet/admin');
    else
      header('Location:/');
  }
    public function actionLogin(){
        $result=User::checkAutorizeLoginPage();
            if($result){
              if(isset($result['access']) && $result['access']==='1'){
                header('Location:/cabinet/admin');
                exit();
            }
            header('Location:/');
            exit();
            }
        require_once('./views/login/index.php');
  }
  public function actionLogout(){
    $result=User::Autorize();
    if(!$result){
      header('Location:/login?error=Вы+неавторизированы');
      exit();
    }
    session_destroy();
    session_abort();
    session_reset();
    header('Location:/login');
}
  public function actionRegister(){
    $result=User::checkAutorizeLoginPage();
        if($result){
          if(isset($result['access']) && $result['access']==='1'){
            header('Location:/cabinet/admin');
            exit();
        }
        header('Location:/');
        exit();
        }
    require_once('./views/register/index.php');
}
public function actionAdd(){
    $result=User::checkAutorizeLoginPage();
        if($result){
          if(isset($result['access']) && $result['access']==='1'){
            header('Location:/cabinet/admin');
            exit();
        }
        header('Location:/');
        exit();
        }
    $result=User::checkInputUserData($_POST['login'],$_POST['pass']);
    $email=User::checkEmail($_POST['email']);
    if(!$result || !$email){
        header('Location:/register?error=Некорректный+ввод'); 
        exit();
    }
    $exist=User::checkExistRegData(['login'=>$result['login'],'email'=>$email]);
    if(!$exist){
        header('Location:/register?error=Пользователь+с+такими+данными+существует'); 
          exit();
        }
    $id=User::insertData(['login'=>$result['login'],'pass'=>password_hash ($result['pass'],PASSWORD_DEFAULT),'email'=>$email,'access'=>0]);
    if(!$id){
        header('Location:/register?error=Ошибка+записи'); 
          exit();
        }
        $_SESSION['auth']='ok';
        $_SESSION['id']=$id;
        if($result['login']==='admin') 
          header('Location:/admin');
        else
          header('Location:/');
}
};