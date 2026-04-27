<?php
include "../Model/db.php";
session_start(); 
$name = "";
$password = "";
$loginErr = "";
$generalErr = "";
$datafile = "../data.json";


if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $name = $_POST["name"] ?? "";
        $password = $_POST["password"] ?? "";

        if (!empty($name) && !empty($password)) 
        {
            $database = new db();
            $connection = $database->connection();
            $result = $database->signin($connection,"users",$name, $password);

            if($result && $result->num_rows > 0)
            {
                $_SESSION["loggedIn"] = true;
                $_SESSION["name"] = $name;
                setcookie("name", $name, time() + 3600, "/");

                $row = $result->fetch_assoc();
                if($row && isset($row["filepath"]))
                {
                    $_SESSION["filepath"] = $row["filepath"];
                }

                $formdata = array("name" => $name,"password" => $password);
                
                if(file_exists($datafile))
                    {
                        $existdata = file_get_contents($datafile);
                        $tempdata = json_decode($existdata, true) ?? array();
                    }
                else
                    {
                    $tempdata = array();
                    }

                $tempdata[] = $formdata;
                $jsondata = json_encode($tempdata, JSON_PRETTY_PRINT);
                file_put_contents($datafile, $jsondata);

                header("Location:../View/dashboard.php");
                exit();
            }
            else
                {
                    $loginErr = "<p><span style='color: red;'>Invalid username or password.</span></p>";
                }
        }
        else
        {
            $generalErr = "<p><span style='color: red;'>Please fill in all fields.</span></p>";
        }
        
    }
?>