<?php
include "../Model/db.php";
$name = $_POST['name'] ?? "";
    if(!$name)
    {
        echo "Username is required";
    }
    else
    {
        $database = new db();
        $connection = $database->Connection();
        $result = $database->CheckUsername($connection, "users", $name);
        if($result->num_rows > 0)
        {
            echo "Username already exists";
        }
        else
        {
            echo "Username is available";
        }
    }

?>