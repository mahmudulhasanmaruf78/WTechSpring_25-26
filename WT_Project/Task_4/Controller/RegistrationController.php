<?php

include "../config/db.php";
include "../Model/UserModel.php";

session_start();

$nameError="";
$emailError="";
$passwordError="";
$roleError="";
$fileError="";

if($_SERVER["REQUEST_METHOD"]=="POST")
{

    $name=$_POST["name"];

    $email=$_POST["email"];

    $password=$_POST["password"];



    $role="";

    if(isset($_POST["role"]))
    {
        $role=$_POST["role"];
    }


    $file=$_FILES["file"];

    $hasError=false;




    // NAME VALIDATION
    if(empty($name))
    {
        $nameError="Name Required";

        $hasError=true;
    }




    // EMAIL VALIDATION
    if(empty($email))
    {
        $emailError="Email Required";

        $hasError=true;
    }




    // PASSWORD VALIDATION
    if(empty($password))
    {
        $passwordError="Password Required";

        $hasError=true;
    }

    elseif(strlen($password)<8)
    {
        $passwordError="Minimum 8 Characters";

        $hasError=true;
    }




    // ROLE VALIDATION
    if(empty($role))
    {
        $roleError="Select Role";

        $hasError=true;
    }




    // FILE VALIDATION
    if($file["name"]!="")
    {

        $fileextension=
        strtolower(
            pathinfo(
                $file["name"],
                PATHINFO_EXTENSION
            )
        );



        // SEEKER PDF VALIDATION
        if($role=="seeker")
        {

            if($fileextension!="pdf")
            {
                $fileError=
                "Only PDF Allowed";

                $hasError=true;
            }

        }



        // FILE SIZE VALIDATION
        if($file["size"] > 2000000)
        {

            $fileError=
            "File Must Be Less Than 2MB";

            $hasError=true;

        }

    }




    if($hasError==false)
    {

        echo "Registration Successful <br>";




        // PASSWORD HASH
        $hashpassword=password_hash(
            $password,
            PASSWORD_DEFAULT
        );




        // FILE UPLOAD
        if($file["name"]!="")
        {

            $targetdirectory=
            "../public/uploads/";


            $path=$targetdirectory.basename(
                $file["name"]
            );


            move_uploaded_file(
                $file["tmp_name"],
                $path
            );

        }
        else
        {
            $path="";
        }




        // DATABASE
        $database=new db();

        $connection=$database->connection();

        $user=new UserModel();



        $result=$user->signup(
            $connection,
            "users",
            $name,
            $email,
            $hashpassword,
            $role,
            $path
        );



        if($result)
        {
            header(
            "Location:../View/Login.php"
            );

            exit();
        }
        else
        {
            echo "Database Error";
        }

    }

}

?>