<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <title>Zarejestruj się!</title>
    <link rel="stylesheet" type=text/css href="register.css">
  </head>
  <body>
    <form action="" method="post">
      Imię: <input type="text" name="name"><br>
      Nazwisko: <input type="text" name="surname"><br>
      Login: <input type="text" name="login"><br>
      Hasło: <input type="password" name="password"><br>
      <input type="submit" value="Zarejestruj">
    </form>
      <br>
      Masz już konto: <a href="login.php">zaloguj się!</a>
      <br>
  </body>
</html>
<?php
session_start();
    include "functionsClass.php";
    $functions = new Functions();
    $conn = $functions->connect();
    
    if (isset($_POST["name"], $_POST["surname"], $_POST["login"], $_POST["password"]))
    {   
        $userName = $_POST["name"];
        $userSurname = $_POST["surname"];
        $userLogin = $_POST["login"];
        $userPassword = $_POST["password"];
        $hashedUserPassword = md5($userPassword);
        $functions->insertRegister($userName, $userSurname, $userLogin, $hashedUserPassword, $conn); 
        if($functions)
        {
            echo "Zarejestrowano pomyślnie";
        }
    }
?>