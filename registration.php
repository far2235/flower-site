<?php
require_once "connection.php";

//initialize variables
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

//process data on submission
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //check username
    //if left empty
    if(empty(trim($_POST["username"]))){
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
                echo "Database error!";
            }
            mysqli_stmt_close($stmt);
        }
    }

    //check password
    //if left empty
    if(empty(trim($_POST["password"]))){
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
    if(empty(trim($_POST["confirm_password"]))){
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
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
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
                echo "Error: account could not be created (for some reason?)";
            }
            mysqli_stmt_close($stmt);
        }
        else{
            echo "Error accessing database";
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
        <script src="register.js"></script>
        <h1>Create Account</h1>
    </head>
    <body>
        <div class="login">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validate()" method="post">
                <legend>Your Info</legend>
                <div class="login-form">
                    <label>Create a username:</label>
                    <input type="text" name="username" id="uname" onkeyup="validate_uname()" class="login-form <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-login"><?php echo $username_err; ?></span>
                    <div class="invalid-login" id="bad-uname"></div>
                </div>
                <div class="login-form">
                    <label>Create a password:</label>
                    <input type="password" name="password" id="pword" onkeyup="validate_pass()" class="login-form <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                    <span class="invalid-login"><?php echo $password_err; ?></span>
                    <div class="invalid-login" id="bad-pass"></div>
                </div>
                <div class="login-form">
                    <label>Confirm password:</label>
                    <input  type="password" name="confirm_password" id="cpword" onkeyup="validate_conf()" class="login-form <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                    <span class="invalid-login"><?php echo $confirm_password_err; ?></span>
                    <div class="invalid-login" id="bad-conf"></div>
                </div>
                <div class="login-form">
                    <input type="submit" value="Create Account" class="login-submit-button"/>
                </div>
            </form>
            <script type="text/javascript" src="register.js"></script>
            <p>
                Click <a href="authentication.php">here</a> to go back
            </p>
        </div>
    </body>
</html>