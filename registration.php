<?php
require_once "connection.php";

//initialize variables
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

//process data on submission
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //check username
    //if left empty
    if(empty(trim($POST["username"]))){
        $username_err = "Username cannot be empty.";
    }
    //if it contains special symbols
    elseif(!preg_match('/^[a-zA-Z0-9_]+$/',trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    }
    //if previous conditions are checked, proceed
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt,"s",$param_username);
            //set parameters
            $param_username = trim($_POST["username"]);

            //execute previous statement
            if(mysqli_stmt_execute($stmt)){
                //store in db
                mysqli_stmt_store_result($stmt);
                //check existing usernames
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is taken.";
                }
                else{
                    $username = trim($_POST["username"]);
                }
            }
            else{
                echo("Database error!");
            }
            mysqli_stmt_close($stmt);
        }
    }

    //check password
    //if left empty
    if(empty(trim($POST["password"]))){
        $password_err = "Password cannot be empty.";
    }
    //if too short
    elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must contain at least 6 characters.";
    }
    //otherwise proceed
    else{
        $password = trim($_POST["password"]);
    }

    //check password confirmation
    //if left empty
    if(empty(trim($POST["confirm_password"]))){
        $confirm_password_err = "Please confirm your password.";
    }
    else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Passwords do not match.";
        }
    }

    //database insertion
    //check for errors first
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        $sql = "INSERT INTO users (username, password), VALUES(?,?)";
        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt,"ss",$param_username,$param_password);
            //set parameters
            $param_username = $username;
            $param_password = password_hash($password,PASSWORD_DEFAULT);

            //execute previous statement
            if(mysqli_stmt_execute($stmt)){
                //go back to account page
                header("location: authentication.php");
            }
            else{
                echo("Error: account could not be created (for some reason?)");
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="flowerCSS.css">
        <h1>Create Account</h1>
    </head>
    <body>
        <div class="login">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <fieldset>
                    <legend>Your Info</legend>
                    <p>
                        <label>Create a username:</label>
                        <input type="text" name="username" class="login-form <?php echo(!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" >
                        <span class="invalid-login"><?php echo $username_err; ?></span>
                    </p>
                    <p>
                        <label>Create a password:</label>
                        <input type="password" name="password" class="login-form <?php echo(!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" />
                        <span class="invalid-login"><?php echo $password_err; ?></span>
                    </p>
                    <p>
                        <label>Confirm password:</label>
                        <input type="password" name="confirm_password" class="login-form <?php echo(!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" />
                        <span class="invalid-login"><?php echo $confirm_password_err; ?></span>
                    </p>
                    <p>
                        <label>Select your birth month:</label>
                        <select name="month">
                            <option>no response</option>
                            <option>January</option>
                            <option>February</option>
                            <option>March</option>
                            <option>April</option>
                            <option>May</option>
                            <option>June</option>
                            <option>July</option>
                            <option>August</option>
                            <option>September</option>
                            <option>October</option>
                            <option>November</option>
                            <option>December</option>
                        </select>
                    </p>
                    <input type="submit" value="Submit" id="accreate-submit"/>
                </fieldset>
            </form>
            <p>
                Click <a href="authentication.php">here</a> to go back
            </p>
        </div>
    </body>
</html>