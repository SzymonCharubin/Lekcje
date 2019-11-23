<?php
session_start();

if (isset($_POST['email']))
 {
  // require_once 'connection.php';

// filmik 1:29:46

  $nameRegExp = "/^([A-Z])([a-zżźćńółęąś]){2,30}+$|^([ŻŹĆŚĘŁÓŃ]){1,2}([a-zżźćńółęąś]){2,30}+$/";
  //$name1RegExp = "/^([A-Z])([a-zżźćńółęąś]){2,30}+$/";
  //$name2RegExp = "/^([ŻŹĆŚĘŁÓŃ]){1,2}([a-zżźćńółęąś]){2,30}+$/";
  //Udana walidacja
  $flag = true;

  //poprawność Imię;
  $name = $_POST['name'];

  //Sprawdzenie długości imienia
      if(!preg_match($nameRegExp,$name))
      {
        $flag = false;
        $_SESSION['e_name'] = "Imię musi zaczynać się z wielkiej litery
        i posiadać od 3 do 20 znaków!";
      }
  //Sprawdzenie nazwiska
      $surnameRegExp = "/^([A-Z])([a-zżźćńółęąś]){2,30}+$|^([ŻŹĆŚĘŁÓŃ]){1,2}([a-zżźćńółęąś]){2,30}+$/";
      $surname = $_POST['surname'];

      if(!preg_match($surnameRegExp,$surname))
      {
        $flag = false;
        $_SESSION['e_surname'] = "Nazwisko musi zaczynać się z wielkiej litery
        i posiadać od 3 do 20 znaków!";
      }
  //Sprawdzenie poprawności adresu email
      $email = $_POST['email'];
      $emailSafe = filter_var($email, FILTER_SANITIZE_EMAIL);

      if((filter_var($emailSafe, FILTER_VALIDATE_EMAIL)==false) || ($emailSafe!=$email))
      {
        $flag = false;
        $_SESSION['e_email'] = "Podaj prawidłowy adres e-mail!";
      }
  //Sprawdzenie haseł
      $password = $_POST['password'];
      $password2 = $_POST['password2'];

      if((strlen($password)<8) || (strlen($password)>20))
      {
        $flag = false;
        $_SESSION['e_password'] = "Hasło musi posiadać od 8 do 20 znaków!";
      }

      if($password!=$password2){
        $flag = false;
        $_SESSION['e_password2'] = "Podane hasła nie są identyczne!";
      }

      $passwordhashed = password_hash($password, PASSWORD_DEFAULT);

      //Zapamiętanie wprowadzonych danych
      $_SESSION['fr_name'] = $name;
      $_SESSION['fr_surname'] = $surname;
      $_SESSION['fr_email'] = $email;
      $_SESSION['fr_password'] = $password;
      $_SESSION['fr_password2'] = $password2;

      require_once 'connection.php';

      $userQuery = $db->prepare('SELECT id FROM Susers WHERE email = :email');
      $userQuery->bindValue(':email', $email, PDO::PARAM_STR);
      $userQuery->execute();
      $user = $userQuery->fetch();

      if($user)
      {
        $flag = false;
        $_SESSION['e_email'] = "Istnieje już konto o podanym adresie e-mail!";
      }

  if($flag == true)
  {
    //walidacja udana możemy dodać do bazy nowego użytkownika
    $insertQuery = $db->prepare('INSERT INTO Susers (email, passwd, name, surname) VALUES (:email,:passwd, :name, :surname)');
    $insertQuery->bindValue(':email', $email, PDO::PARAM_STR);
    $insertQuery->bindValue(':passwd', $passwordhashed, PDO::PARAM_STR);
    $insertQuery->bindValue(':name', $name, PDO::PARAM_STR);
    $insertQuery->bindValue(':surname', $surname, PDO::PARAM_STR);

    if($insertQuery->execute())
    {
      $_SESSION['insertSuccess'] = true;
      header('Location: http://localhost/Atom/Sklep/successfulRegistration.php');
      exit();
    }
    else
    {
      $_SESSION['insertFailure'] = "Rejestracja nie powiodła się. Za wszelkie problemy przepraszamy.";
    }
    exit();
  }
}


// /^([A-Z])([a-z]){2,30}+$/";
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <title>Zarejestruj się!</title>
    <link rel="stylesheet" type=text/css href="register.css">
  </head>
  <body>

<div class="box">
  <div class="form">
    <form method="post">
                <h1>  Rejestracja </h1>
                      <br><br>
      <?php
        if(isset($_SESSION['insertFailure']))
        {
          echo '<div class="error">'.$_SESSION['insertFailure'].'</div>';
          unset($_SESSION['insertFailure']);
        }
      ?>
          Imię
      <br> <input type="text" value="<?php
      if(isset($_SESSION['fr_name']))
      {
        echo $_SESSION['fr_name'];
        unset($_SESSION['fr_name']);
      }
       ?>" name="name" id="input"><br><br>
      <?php
        if(isset($_SESSION['e_name']))
        {
          echo '<div class="error">'.$_SESSION['e_name'].'</div>';
          unset($_SESSION['e_name']);
        }
      ?>
          Nazwisko
      <br> <input type="text" value="<?php
      if(isset($_SESSION['fr_surname']))
      {
        echo $_SESSION['fr_surname'];
        unset($_SESSION['fr_surname']);
      }
       ?>" name="surname" id="input"><br><br>
      <?php
        if(isset($_SESSION['e_surname']))
        {
          echo '<div class="error">'.$_SESSION['e_surname'].'</div>';
          unset($_SESSION['e_surname']);
        }
      ?>
          Podaj swój adres e-mail
      <br> <input type="text" value="<?php
      if(isset($_SESSION['fr_email']))
      {
        echo $_SESSION['fr_email'];
        unset($_SESSION['fr_email']);
      }
       ?>" name="email" id="input"><br><br>
      <?php
        if(isset($_SESSION['e_email']))
        {
          echo '<div class="error">'.$_SESSION['e_email'].'</div>';
          unset($_SESSION['e_email']);
        }
      ?>
          Ustaw swoje hasło
      <br><input type="password" value="<?php
      if(isset($_SESSION['fr_password']))
      {
        echo $_SESSION['fr_password'];
        unset($_SESSION['fr_password']);
      }
       ?>" name="password" id="input"><br><br>
      <?php
        if(isset($_SESSION['e_password']))
        {
          echo '<div class="error">'.$_SESSION['e_password'].'</div>';
          unset($_SESSION['e_password']);
        }
      ?>
          Potwierdź hasło
      <br><input type="password" value="<?php
      if(isset($_SESSION['fr_password2']))
      {
        echo $_SESSION['fr_password2'];
        unset($_SESSION['fr_password2']);
      }
       ?>" name="password2" id="input"><br><br>
      <?php
        if(isset($_SESSION['e_password2']))
        {
          echo '<div class="error">'.$_SESSION['e_password2'].'</div>';
          unset($_SESSION['e_password2']);
        }
      ?>

      <input type="submit" value="Zarejestruj" id="button"><br><br><br>

      <a href="http://localhost/Atom/Sklep/index.php" id="link">Strona główna</a>

    </form>
  </div>
</div>

  </body>
</html>
