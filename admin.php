<?php
require_once('./services/services.php');
$userData=Autorize($_COOKIE['auth'],$_COOKIE['id']);
if(isset($userData['login']) && $userData['login']==='admin')
echo "Hello ADMIN!";
else header('Location:index.php');