<html>
    <head>
    <link href="./style/css/all.css" rel="stylesheet">
    <link href="./style/style.css" rel="stylesheet">
    </head>
    <body>
        <form action="savetask.php">
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
        <form action="./updateTask.php">
        <span>Сортировка по дате</span> <a href="sort.php?sort=up">По возрастанию</a> <a href="sort.php?sort=up">По убыванию</a> 
        <? 
           if(@$handle_read=fopen('tasks.txt','r')){
             $counter=0;
            while(($line=fgets($handle_read))):
        ?>
        
        <div style="margin-top:10px" class=<?=(strtotime(explode("|", $line)[1])<strtotime(date("H:i Y-m-d")))?'expired':'' ?>>
          <span class="des"><?=$line ?></span>
          <i class="fas fa-edit fa-lg editTask" id=<?=$counter?>></i>
          <a href="delete.php?id=<?=$counter?>">
            <i class="fa fa-trash-alt fa-lg"></i>
          </a>
        </div>
        <? $counter++; endwhile; }
        if(isset($_GET['error']))
        echo "<div>".$_GET['error']."</div>";
        ?>
        </form>
        <script>
          window.onload = () =>{
          let editTask=document.querySelectorAll('.editTask');
          for(let i=0;i<editTask.length;i++)
          editTask[i].addEventListener('click',(event)=>{
            let input = document.createElement('input');
            input.type="text";
            input.name=`edit_${i}`;
            let btn = document.createElement('button');
            btn.type="submit";
            btn.innerHTML='save';
            let mas=event.target.parentNode.querySelector('.des').innerHTML.split('|');
            input.value=mas[0];
            let time=mas[1].split(' ');
            //console.log(time[1]);
            let hour=document.createElement('select');
            hour.name=`hour_${i}`;
            for(let i=0;i<24;i++)
            {
              if(i<10 && i==time[0].slice(1,2))
              hour.innerHTML+=`<option selected value='${(i<10)?'0'+i:i}'>${(i<10)?'0'+i:i}</option>`;
              else if(i==+(time[0].slice(0,2)))
              hour.innerHTML+=`<option selected value='${(i<10)?'0'+i:i}'>${(i<10)?'0'+i:i}</option>`;
              else hour.innerHTML+=`<option value='${(i<10)?'0'+i:i}'>${(i<10)?'0'+i:i}</option>`;
            }
            let minutes=document.createElement('select');
            minutes.name=`minutes_${i}`;
            for(let i=0;i<60;i++)
            {
              if(i<10 && i==time[0].slice(4,5))
              minutes.innerHTML+=`<option selected value='${(i<10)?'0'+i:i}'>${(i<10)?'0'+i:i}</option>`;
              else if(i==+(time[0].slice(3,5)))
              minutes.innerHTML+=`<option selected value='${(i<10)?'0'+i:i}'>${(i<10)?'0'+i:i}</option>`;
              else minutes.innerHTML+=`<option value='${(i<10)?'0'+i:i}'>${(i<10)?'0'+i:i}</option>`;
            }
            let calendar = document.createElement('input');
            calendar.type="date";
            calendar.name=`calendar_${i}`;
            calendar.value=time[1].substring(0, time[1].length - 1);
            event.target.parentNode.insertBefore(input,event.target.parentNode.querySelector('.des'));
            event.target.parentNode.insertBefore(hour,event.target.parentNode.querySelector('.des'));
            event.target.parentNode.insertBefore(minutes,event.target.parentNode.querySelector('.des'));
            event.target.parentNode.insertBefore(calendar,event.target.parentNode.querySelector('.des'));
            event.target.parentNode.insertBefore(btn,event.target.parentNode.querySelector('.des'));
            event.target.parentNode.removeChild(event.target.parentNode.querySelector('.des'));
            event.target.parentNode.removeChild(event.target);
          });
          }
        </script>
    </body>
</html>