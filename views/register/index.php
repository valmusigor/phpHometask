<html>
  <head><meta charset="utf-8"/></head>
    <body>
      <span style="color:red"><?(isset($_GET['error']))??''?></span>
      <form action="/auth/add" method="POST">
        <input type="text" name="login" placeholder="enter login" value="<?=(isset($_GET['login']))?$_GET['login']:'' ?>" />
        <input type="password" name="pass" placeholder="enter password" value="<?=(isset($_GET['pass']))?$_GET['pass']:'' ?>" />
        <input type="email" name="email" placeholder="enter email" value="<?=(isset($_GET['email']))?$_GET['email']:'' ?>" />
        <button type="submit">Зарегестрироваться</button>
      </form> 
      <a href="/login">Войти</a> 
    </body>
</html>