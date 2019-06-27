<form action="/cabinet/task/save" class="addTask">
  <input type="text" name="task" placeholder="enter task">
  <select name="hour">
    <? for($i=0;$i<24;$i++): ?>
      <option value=<?=($i<10)?'0'.$i:$i ?>><?=($i<10)?'0'.$i:$i ?></option>
    <? endfor;?>
  </select>
  <select name="minutes">
    <? for($i=0;$i<60;$i++): ?>
      <option value=<?=($i<10)?'0'.$i:$i ?>><?=($i<10)?'0'.$i:$i ?></option>
    <? endfor;?>
  </select>
  <input type="date" name="calendar" value=<?=date("Y-m-d")?> min=<?=date("Y-m-d")?>>
  <button type="submit">Add task</button>
</form>
