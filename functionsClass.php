<?php
Class Functions
{
    function connect()
    {
        $serverName = "127.0.0.1";
        $username = "root";
        $password = "";
        $bdName = "aplikacja";
        $conn = new mysqli($serverName, $username, $password, $bdName);

        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    } 
    
    function displayEven($from,$to)
    {
        for ($from; $from <=$to; $from++)
        {
          $a = $from%2;
          if ($a == 1)
            {
                echo $from ."<br>";
            }
        }
    }

    function insert($userId, $from, $to, $conn)
    {  
        $insert = "INSERT INTO data (userID, Min, Max) values ($userId, $from, $to)";
        if (mysqli_query($conn,$insert))
                {
                  mysqli_close($conn);
                } else 
                {
                    echo "coś poszło nie tak ";
                  print_r($userId);
                  mysqli_close($conn); 
                }
               
          
    }
    function insertRegister($userName, $userSurname, $userLogin, $hashedUserPassword, $conn)
    {
        $insertRegister = "INSERT INTO users (name, surname, login, password, isAdmin) values ('$userName','$userSurname','$userLogin','$hashedUserPassword', 0)";
        mysqli_query($conn,$insertRegister); 
        mysqli_close($conn);   
    }
    function login($login, $hashedPassword, $conn)
    {
        $SELECT = "SELECT * FROM users WHERE login = '$login' and password = '$hashedPassword'";
        $result = mysqli_query($conn, $SELECT);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if(mysqli_num_rows($result) == 1)
        {
            $_SESSION['zalogowany'] = true;
            $_SESSION['userId'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['surname'] = $row['surname'];
            $_SESSION['isAdmin'] = $row['isAdmin'];
            $id = $_SESSION['userId'];
            $update = "UPDATE users SET LastLogin = now() WHERE id = $id";
            mysqli_query($conn, $update);
            header('location: http://localhost/Borger/aplikacja/index.php');
            
        }
        else
        {
            echo "Błędny login lub hasło!";
        }
        
    }
    function userStatistics($userId, $conn)
    {
        $SELECT = "SELECT Min, Max, Time FROM data WHERE userId = $userId ORDER BY Time DESC";
        $result = mysqli_query($conn, $SELECT);
        while($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            echo '<tr>
                        <th>'.$row["Min"].'</th>
                        <th>'.$row["Max"].'</th>
                        <th>'.$row["Time"].'</th>
                 </tr>';
        }
        
        
       
    }
        function adminStatistics($conn)
    {
        $SELECT = "SELECT users.name, users.surname, data.Min, data.Max, data.Time, users.LastLogin, users.DateofRegistration FROM data INNER JOIN users ON data.userId = users.id ORDER BY users.id DESC, data.Time ASC";
        $result = mysqli_query($conn, $SELECT);
        while($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            echo '<tr>
                        <th>'.$row["name"].'</th>
                        <th>'.$row["surname"].'</th>
                        <th>'.$row["Min"].'</th>
                        <th>'.$row["Max"].'</th>
                        <th>'.$row["Time"].'</th>
                        <th>'.$row["LastLogin"].'</th>
                        <th>'.$row["DateofRegistration"].'</th>
                 </tr>';
        }
        
        
       
    }
}
?>