<?php
include "../Controller/RegistrationController.php";
?>
<!DOCTYPE html>
<html>
    <body>
        <form method="post" action="">
            <h1> PHP Form Validation Example </h1>
                <?php echo $generalErr ?? ''; ?>            
            <table>
                <tr>
                    <td> <label for="name">Name: </label></td>
                    <td> 
                        <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>"> 
                        <?php echo $nameErr ?? ''; ?>
                    </td>
                </tr>
                <tr>
                    <td> <label for="email">E-mail:  </label></td>
                    <td> 
                        <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"> 
                        <?php echo $emailErr ?? ''; ?>
                    </td>
                </tr>
                <tr>
                    <td> <label for="Website">Website:  </label></td>
                    <td> 
                        <input type="url" id="Website" name="website" value="<?php echo isset($_POST['website']) ? $_POST['website'] : ''; ?>"> 
                    </td>
                </tr>
                <tr>
                    <td> <label for="comment">Comment: </label></td>
                    <td> 
                        <textarea id="comment" name="comment" rows="5" cols="40"><?php echo isset($_POST['comment']) ? $_POST['comment'] : ''; ?></textarea> 
                    </td>
                </tr>
                <tr>
                    <td> <label>Gender: </label></td>
                    <td>
                        <input type="radio" name="gender" value="female" <?php if (isset($_POST['gender']) && $_POST['gender'] == "female") echo "checked";?>> Female
                        <input type="radio" name="gender" value="male" <?php if (isset($_POST['gender']) && $_POST['gender'] == "male") echo "checked";?>> Male
                        <input type="radio" name="gender" value="other" <?php if (isset($_POST['gender']) && $_POST['gender'] == "other") echo "checked";?>> Other  
                        <?php echo $genderErr ?? ''; ?>
                    </td>
                </tr>
                <tr>
                    <td> <input type="submit" id="submitbutton" name="submit"> </td>
                </tr>
            </table>
        </form>
    </body>
</html>