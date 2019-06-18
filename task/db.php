<?
class DB{
    private static $instance=null;
    private $db;
    public static function getInstance(){
      if(self::$instance===null){
        self::$instance = new DB();
        }
        return self::$instance;
    }
    private function __construct(){
        setlocale(LC_ALL,'ru_RU.UTF8');
        $dsn=require_once('./config_bd.php');
        try{
            $this->db = new PDO('mysql:host='.$dsn['host'].';dbname='.$dsn['dbname'],$dsn['user'], $dsn['pass']);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            echo "ERROR:".$e->getMessage();
            exit();
        }
    }
    public function insert($table,$data){
        $columns=implode(',',array_keys($data)); 
        $values=':'.implode(',:',array_keys($data)); 
        $querry=$this->db->prepare("INSERT INTO $table ($columns) VALUES ($values)");
        $querry->execute($data);
        if($querry->errorCode()!=PDO::ERR_NONE){
          echo $querry->errorInfo()[2];
          return 'error';
		} 
        return $this->db->lastInsertId();
    }
    public function find($table,$data,$orderBy=false){
        foreach($data as $key=>$value)
          $params[]=$key.'=:'.$key;
        $where=implode(' AND ',$params);
        if(!$orderBy)
        $querry=$this->db->prepare("SELECT * FROM $table WHERE $where");
        else
        {
            $querry=$this->db->prepare("SELECT * FROM $table WHERE $where ORDER BY $orderBy");  
        }
        $querry->execute($data);
        if($querry->errorCode()!=PDO::ERR_NONE){
          echo $querry->errorInfo()[2];
          return 'error';
		} 
        return $querry->fetchAll();
    }
    public function update($table,$data,$id){
        foreach(array_keys($data) as $key)
        $keys[]=$key.'=:'.$key;
        $columns=implode(',',$keys);
        $querry=$this->db->prepare("UPDATE $table SET $columns WHERE id=$id");
        $querry->execute($data);
        if($querry->errorCode()!=PDO::ERR_NONE){
            echo $querry->errorInfo()[2];
            return 'error';
          } 
        return $querry->rowCount();
    }
    public function delete($table,$data)
    {
     foreach(array_keys($data) as $key)
        $keys[]=$key.'=:'.$key;
        $columns=implode(' AND ',$keys);
      $querry=$this->db->prepare("DELETE FROM $table WHERE $columns");
      $querry->execute($data);
        if($querry->errorCode()!=PDO::ERR_NONE){
            echo $querry->errorInfo()[2];
            return 'error';
          } 
        return $querry->rowCount();
    }

};