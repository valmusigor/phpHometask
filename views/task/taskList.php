<? 
function taskList($tasks){
  
    
      foreach($tasks as $task):
?>
        <div style="margin-top:10px" class=<?=($task['time_end']<strtotime(date("H:i Y-m-d")))?'expired':'' ?>>
          <span class="des"><?=$task['text'].'|'.date("H:i Y-m-d",$task['time_end']) ?></span>
          <i class="fas fa-edit fa-lg editTask" id=<?=$task['id']?>></i>
          <a href="/cabinet/task/delete/<?=$task['id']?>">
            <i class="fa fa-trash-alt fa-lg"></i>
          </a>
        </div>
<? 
      endforeach;
  
}
        