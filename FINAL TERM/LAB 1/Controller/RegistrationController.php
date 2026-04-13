<?php

$name = "";
$email = "";
$website = "";
$comment = "";
$gender = "";

if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $website = $_POST["website"];
        $comment = $_POST["comment"];
        $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";

        $name = $_REQUEST["name"];
        $email = $_REQUEST["email"];
        $website = $_REQUEST["website"];
        $comment = $_REQUEST["comment"];
        $gender = isset($_REQUEST["gender"]) ? $_REQUEST["gender"] : "";


        if(!empty($name))
            {
                echo "User Name: " . $name;
            }
            else
            {
                echo "User Name Required";
            }

        if(!empty($email))
            {
                $emailPattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
                if(preg_match($emailPattern, $email))
                    {
                        echo " Email: " . $email;
                    }
                    else
                    {
                        echo "Invalid Email Format. Email must be like example@email.com";
                    }
            }
            else
            {
                echo "User Email Required";
            }

        if(!empty($website))
            {
                $urlPattern = "/^(https?:\/\/)?([\w\-]+\.)+[\w\-]+(\/[\w\-]*)*$/";
                if(preg_match($urlPattern, $website))
                    {
                        echo " Website: " . $website;
                    }
                    else
                    {
                        echo "Invalid URL Format. URL must be like http://example.com";
                    }
            }

        if(!empty($comment))
            {
                echo " Comment: " . $comment;
            }
        if(!empty($gender))
            {
                echo " Gender: " . $gender;
            }
        else
            {
                echo "Please select a gender";
            }
        
    }
?>