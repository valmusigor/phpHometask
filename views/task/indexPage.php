<html>
<head>
<link href="/style/css/all.css" rel="stylesheet">
<link href="/style/style.css" rel="stylesheet">
</head>
<body>
    <? require_once('./views/task/taskList.php'); ?>
    <div style="display:flex;justify-content:space-between">
    <? require_once('./views/task/formAddTask.php'); ?>
    <span><strong style="font-size:30px"><span class="logo"><a  href="/"  title="на главную"><?=(isset($result['login']))?$result['login']:''?></a></span></strong><a href="/logout><i class="fas fa-sign-out-alt fa-2x"></i></a></span>
  </div>
    <span>Сортировка по дате</span> <a href="/cabinet/task/sort/up">По возрастанию</a> <a href="/cabinet/task/sort/down">По убыванию</a> 
    <form action="/cabinet/task/update">
      <? taskList($tasks);?>
    </form>
    <?if(isset($_GET['error'])) echo "<div>".$_GET['error']."</div>"; ?>
    <script src="/scripts/createTaskEdit.js">
    </script>
</body>
</html>