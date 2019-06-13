<? 
function taskList($userData,$lines){
  if(file_exists($userData['file'])){
    $counter=0;
    $handle_read=fopen($userData['file'],'r');
    if(isset($handle_read)){
      foreach($lines as $line):
?>
        <div style="margin-top:10px" class=<?=(strtotime(explode("|", $line)[1])<strtotime(date("H:i Y-m-d")))?'expired':'' ?>>
          <span class="des"><?=explode("|", $line)[0].'|'.explode("|", $line)[1] ?></span>
          <i class="fas fa-edit fa-lg editTask" id=<?=$counter?>></i>
          <a href="delete.php?id=<?=$counter?>">
            <i class="fa fa-trash-alt fa-lg"></i>
          </a>
        </div>
<?    
        $counter++; 
      endforeach;
      fclose($handle_read);
    }   
  }
}
        