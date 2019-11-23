<?php
    session_start();
      if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] != true))
  {
    header('Location: http://localhost/Borger/aplikacja/login.php');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Aplikacja</title>
    <link rel="stylesheet" type=text/css href="main.css">
</head>
<body>
    <?php
    if(isset($_SESSION['zalogowany']))
    {
        echo "Zalogowano jako: ".$_SESSION['name']." ".$_SESSION['surname'];
    }
    ?>
    <form action="index.php" method="post">
        <input type="number" placeholder="Liczba najmniejsza" name="from">
        <input type="number" placeholder="Liczba nawiększa" name="to"><br>
        <input type="submit" value="Sprawdz">
    </form>
    <a href="statistics.php">Statystyki</a>
    <br>
    <a href="logout.php">Wyloguj</a>
    <br>
</body>
</html>

<?php

include "functionsClass.php";
$functions = new Functions();
$conn = $functions->connect();
  
    if (isset($_POST["from"], $_POST["to"]))
    {
        $userId = $_SESSION['userId'];
        $name = $_SESSION['name'];
        $surname = $_SESSION['surname'];
        $from = $_POST["from"];
        $to = $_POST["to"];        
        $display = $functions->displayEven($from, $to);
        $functions->insert($userId, $from, $to, $conn);      
    }
    
?>