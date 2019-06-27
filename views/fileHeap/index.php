<html>
    <head>
        <meta charset="utf-8"/>
        <link href="/style/css/all.css" rel="stylesheet">
        <link href='/style/style.css' rel="stylesheet"/>
    </head>
    <body>
    <div style="display:flex;justify-content:space-between">
        <form method="POST" action='/cabinet/file/upload' enctype="multipart/form-data">
          <input type="file" name="file" />
          <button type="submit">Отправить</button>
        </form>
        <span><strong style="font-size:30px"><span class="logo"><a  href="/"  title="на главную"><?=(isset($result['login']))?$result['login']:''?></a></span></strong><a href="/logout"><i class="fas fa-sign-out-alt fa-2x"></i></a></span>
    </div>