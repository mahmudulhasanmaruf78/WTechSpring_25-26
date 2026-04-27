<?php
include "../Model/db.php";
session_start(); 
$email = "";
$password = "";
$loginErr = "";
$generalErr = "";
$datafile = "../data.json";


if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $name = $_POST["name"];
        $password = $_POST["password"];

        if (!empty($name) || !empty($password)) 
        {
                echo "Log in Successful";
                setcookie("name", $name, time() + 3600, "/");
                $formdata = array("name"=>$name, "password"=>$password);

                if(file_exists($datafile))
                {
                    $existdata = file_get_contents($datafile);
                    $tempdata = json_decode($existdata, true);
                }
                else
                {
                    $tempdata = array();
                }
                $tempdata[] = $formdata;
                $jsondata = json_encode($tempdata, JSON_PRETTY_PRINT);

                if(file_put_contents($datafile, $jsondata)!== false)
                {
                    echo "Data successfully saved. <br>";
                }
                else
                {
                    echo "Error saving data.";
                }

            $database = new Database();
            $connection = $database->getConnection();
            $result = $database->signin($connection,"users",$name, $password);

            if($result)
            {
                $_SESSION["loggedin"] = true;
                $_SESSION["name"] = $name;
                $row = $result->fetch_assoc();

                if($row && isset($row["filepath"]))
                {
                    $_SESSION["filepath"] = $row["filepath"];
                }
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