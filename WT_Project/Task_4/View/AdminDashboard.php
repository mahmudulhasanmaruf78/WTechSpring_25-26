<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location:Login.php");
}

?>

<!DOCTYPE html>

<html>

<head>

    <link rel="stylesheet" href="../View/CSS/style.css">

</head>

<body>

    <div class="formbox">

        <h1>Admin Dashboard</h1>

        <h3>

            Welcome

            <?php
            echo $_SESSION["name"];
            ?>

        </h3>

        <br>

        <a href="../Controller/Logout.php">

            Logout

        </a>

        <br><br>

        <a href="../View/admin.view.php">
            Admin Panel
        </a>


    </div>

</body>

</html>