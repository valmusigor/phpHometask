<?
namespace controllers;
use services\{User,Task};
class TaskController{
    public function actionIndex($type=false){
    $result=User::Autorize();
    if(!$result){
      header('Location:/login?error=Вы+неавторизированы');
      exit();
    }
    if($type==='up')
      $tasks=Task::getTask(['userId'=>$result['userId']],'ASC');
    else if($type=='down')
        $tasks=Task::getTask(['userId'=>$result['userId']],'DESC');
    else
    $tasks=Task::getTask(['userId'=>$result['userId']]);
    if(!$tasks){
        header('Location:/cabinet/task?error=Ошибка+чтения');
        exit();
    }
    require_once("./views/task/indexPage.php");
    }
    public function actionSave(){
    $result=User::Autorize();
    if(!$result){
      header('Location:/login?error=Вы+неавторизированы');
      exit();
    }
    $input=Task::checkInputTaskData($_GET['task'],[$_GET['hour'],$_GET['minutes'],$_GET['calendar']]);
    if(!$input){
    header('Location:/cabinet/task?error=Некорректный+ввод');
    exit(); 
    }
    if(!Task::checkExist($input[1],$result['userId'])){
    header('Location:/cabinet/task?error=В+данное+время+запланирован+task+поменяйте+время+или+дату');
    exit(); 
    }
    $insertId=Task::insertTask(["text"=>$input[0],"time_end"=>$input[1],"time_create"=>strtotime(date("Y-m-d H:i:s")), "userId"=>$result['userId'],]); 
    if(!$insertId)
    header('Location:/cabinet/task?error=Ошибка+сохранения');
    else header('Location:/cabinet/task');
    }
    public function actionUpdate(){
      $result=User::Autorize();
      if(!$result){
        header('Location:/login?error=Вы+неавторизированы');
        exit();
      }
    foreach($_GET as $key=>$value)
      $mas[explode("_", $key)[1]][explode("_", $key)[0]]=htmlspecialchars(str_replace('|','',trim($value)));
    $success=true;
    foreach($mas as $key=>$value){
      if(!Task::checkAccess($result['userId'],$key)){
        $success=false;
        break;
      }
      $update=Task::updateTask(['text'=>$value['edit'],'time_end'=>strtotime($value['hour'].':'.$value['minutes'].' '.$value['calendar'])],$key);
      if(!$update){
        $success=false;
        break;
      }
    }
    if(!$success)
    header('Location:/cabinet/task?error=Ошибка+редактирования');
    else header('Location:/cabinet/task');
        }
    public function actionDelete($id){
      $result=User::Autorize();
      if(!$result){
        header('Location:/login?error=Вы+неавторизированы');
        exit();
      }
      $id=htmlspecialchars(trim($id));
      if(!isset($id) || !Task::checkAccess($result['userId'],$id)){
        header('Location:/cabinet/task?error=Ошибка+удаления');
        exit(); 
      }
      $delete=Task::deleteTask(['id'=>$id]);
      if(!$delete){
        header('Location:/cabinet/task?error=Ошибка+удаления');
        exit(); 
      }
      header('Location:/cabinet/task');
      
    }
};