<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <title>Zaloguj się!</title>
    <link rel="stylesheet" type=text/css href="">
  </head>
  <body>
    <form action="" method="post">
      Login: <input type="text" name="login"><br>
      Hasło: <input type="password" name="password"><br>
      <input type="submit" value="Zaloguj">
    </form>
      <br>
      Nie masz jeszcze konta? <a href="register.php">Zarejestruj się!</a>
  </body>
</html>
<?php
session_start();
    include "functionsClass.php";
    $functions = new Functions();
    $conn = $functions->connect();
    
    if (isset($_POST["login"], $_POST["password"]))
    {   
        $login = $_POST['login'];
        $password = $_POST['password'];
        $hashedPassword = md5($password);
        $functions->login($login, $hashedPassword, $conn);
    }
?>