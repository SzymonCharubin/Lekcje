<?php
    session_start();
      if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] != true))
  {
    header('Location: http://localhost/Borger/aplikacja/login.php');
    exit();
  }
            require_once 'functionsClass.php'; 
            $functions = new Functions();
  ?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Statystyki</title>
    <link rel="stylesheet" type=text/css href="statistics.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>
</head>
<body>
    
    <div id="box">

    <div id="who">
        <?php 
        
        echo $_SESSION['name']." ".$_SESSION['surname']; 
        
        ?>
         <a id="logOut" href="logout.php">Wyloguj</a>
    </div>
            <h1>STATYSTYKI</h1>
   
    <br>
    <div id="tabs">
        <ul>
          <li><a href="#tabs-1">USER</a></li>
          <?php
            if ($_SESSION['isAdmin'] == 1){

                echo '<li><a href="#tabs-2">ADMIN</a></li>';
                
            }
              
          ?>
        </ul>
        <div id="tabs-1">
          <?php
            $userId = $_SESSION['userId'];
            
            $conn = $functions->connect();
            echo '<table>
                        <tr>
                            <th>Min</th>
                            <th>Max</th>
                            <th>Time</th>
                        </th>';
            $functions->userStatistics($userId, $conn);
            echo '</table>';
          ?>
        </div>
          <?php
            if ($_SESSION['isAdmin'] == 1){

                echo '<div id="tabs-2">';
         
                    echo '<table>
                            <tr>
                                <th>Imię</th>
                                <th>Nazwisko</th>
                                <th>Min</th>
                                <th>Max</th>
                                <th>Time</th>
                                <th>Ostatnie logowanie</th>
                                <th>Data rejestracji</th>
                            </th>';
                    $functions->adminStatistics($conn);
                    echo '</table>';
        
                echo '</div>';
                
            }
          ?>
    </div>
    <a href="index.php">Wróć do aplikacji</a>
    </div>
</body>
</html>