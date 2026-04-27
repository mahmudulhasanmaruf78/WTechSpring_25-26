<?php
session_start(); // Start a session to keep the user logged in
$email = $password = "";
$loginErr = $generalErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    // Check if fields are empty
    if (empty($email) || empty($password)) {
        $generalErr = "<p><span style='color: red; font-weight: bold;'>* Both email and password are required.</span></p>";
    } else {
        $datafile = "../data.json";
        
        // Check if the data file exists
        if (file_exists($datafile)) {
            $json_data = file_get_contents($datafile);
            $users = json_decode($json_data, true);
            $isValidUser = false;
            $userName = "";

            // Loop through JSON data to find a match
            if (is_array($users)) {
                foreach ($users as $user) {
                    if (isset($user["E-mail"]) && isset($user["Password"])) {
                        // Check if email and password match
                        if ($user["E-mail"] === $email && $user["Password"] === $password) {
                            $isValidUser = true;
                            $userName = $user["Name"]; // Grab the user's name to use later
                            break;
                        }
                    }
                }
            }

            // Handle successful or failed login
            if ($isValidUser) {
                // Store user info in session
                $_SESSION["user_email"] = $email;
                $_SESSION["user_name"] = $userName;
                
                // Redirect to a dashboard or welcome page
                header("Location: welcome.php");
                exit();
            } else {
                $loginErr = "<p><span style='color: red;'>Invalid email or password.</span></p>";
            }
        } else {
            $loginErr = "<p><span style='color: red;'>No users found. Please register first.</span></p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <form method="post" action="">
        <h1> User Login </h1>
        
        <?php echo $generalErr; ?>
        <?php echo $loginErr; ?>

        <table>
            <tr>
                <td><label for="email">E-mail: </label></td>
                <td>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                </td>
            </tr>
            <tr>
                <td><label for="password">Password: </label></td>
                <td>
                    <input type="password" id="password" name="password">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <input type="submit" name="submit" value="Login">
                </td>
            </tr>
        </table>
        
    </form>
</body>
</html>