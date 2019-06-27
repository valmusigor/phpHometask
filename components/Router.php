<?
namespace components;
//use controllers\ErrorController;
class Router{
  private $routes;
  public function __construct()
  {
      $this->routes=require_once(__DIR__.'/../config/routes.php');
  }
  private function getUri(){
      if(isset($_SERVER['QUERY_STRING']))
      return str_replace('?'.$_SERVER['QUERY_STRING'],'',$_SERVER['REQUEST_URI']);
      return $_SERVER['REQUEST_URI'];
  }
  public function start(){
    $status=false;
   foreach($this->routes as $path=>$handler){ 
    if(preg_match("~^$path$~",$this->getUri(),$match)){
           $handler=explode('/',$handler);
           $className="controllers\\".ucfirst(array_shift($handler)).'Controller';
           $methodName='action'.ucfirst(array_shift($handler));
           $contoller= new $className();
           if(isset($match[1]))
           $contoller->$methodName($match[1]);
           else
           $contoller->$methodName();
           $status=true;
       }
   }
   if(!$status){
    $contoller= new \controllers\ErrorController();
    $contoller->notFound();
   }

  }
};
