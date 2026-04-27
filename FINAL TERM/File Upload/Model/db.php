<?php

class db
{
    function connection()
{
$db_host = "localhost";
$db_user= "root";
$db_password="";
$db_name="section_c"; 

    $connection=  new mysqli($db_host, $db_user,$db_password,$db_name);
    if($connection->connect_error)
        {
            die ("Could not Connect Database".$connection->connect_error);
        }
    return $connection;
    }

    function signup($connection, $tablename, $name, $password, $filepath)
    {
        $sql= "INSERT INTO " .$tablename. "(name, password, filepath) VALUES (?,?,?)";
        $result = $connection->prepare($sql);
        
        if($result)
        {
            $result->bind_param("sss", $name, $password, $filepath);
            $result = $result->execute();
            return $result;
        }
        else
        {
            return false;
        }
    }
    function signin($connection, $tablename, $name, $password)
    {
        $sql = "SELECT * FROM ".$tablename." WHERE name=? AND password=?";
        $result = $connection->prepare($sql);
        
        if($result)
        {
            $result->bind_param("ss", $name, $password);
            $result->execute();
            $result = $result->get_result();
            return $result;
        }
        return false;
        
    }
}
?>