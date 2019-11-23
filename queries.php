<?php

function queries($typeOfQuery, $tableName, $columns, $values, $condition, $conn)
{
    $query = $typeOfQuery;

    switch ($query) 
    {
        case "select":
            $sql = "$query $columns FROM $tableName WHERE $condition";
            break;
        case "insert":
            $sql = "$query INTO $tableName $columns VALUES $values";
            break;
        case "update":
            $sql = "$query $tableName SET $columns = $values WHERE $condition";
            break;
        case "delete":
            $sql = "$query FROM $tableName WHERE $condition";
            break;  

    }
}
?>