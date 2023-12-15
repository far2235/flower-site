<?php
session_start();

include 'functions.php';

//go to home page if already logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: loggedIn.php");
    exit;
}

require_once("connection.php");

//variable definitions
$username = $password = "";
$username_err = $password_err = $login_err = "";

//process data on submission
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //check username
    //if empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    }
    else{
        $username = trim($_POST["username"]);
    }

    //check password
    //if empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    }
    else{
        $password = trim($_POST["password"]);
    }

    //validate
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt,"s",$param_username);
            $param_username = $username;

            //execution
            if(mysqli_stmt_execute($stmt)){
                //store result
                mysqli_stmt_store_result($stmt);

                //check for username in db
                if(mysqli_stmt_num_rows($stmt) == 1){
                    //if username exists, check password
                    mysqli_stmt_bind_result($stmt,$id,$username,$hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password,$hashed_password)){
                            //if password matched, start a new session while logged in
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            //go to home page
                            header("location: index.php?page=home");
                        }
                        else{ //incorrect password
                            $login_err = "Username and password do not match.";
                        }
                    }
                }
                else{//incorrect username
                    $login_err = "Username and password do not match.";
                }
            }
            else{//database problems
                echo "database error: authentication.php";
            }
            //close statement
            mysqli_stmt_close($stmt);
        }
    }
    //end connection
    mysqli_close($link);
}
?>

<?=template_header('Log In')?>

<div class="login">
    <p>
        Log in for an exclusive member discount!
    </p>
    <h2>Sign in </h2>
    <?php
        if(!empty($login_err)){
            echo '<div class="invalid-login">' . $login_err . '</div>';
        }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="login-form">
            <label>Username:</label>
            <input type="text" name="username" class="login-form <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            <span class="invalid-login"><?php echo $username_err; ?></span>
        </div>
        <div class="login-form">
            <label>Password:</label>
            <input type="password" name="password" class="login-form <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
            <span class="invalid-login"><?php echo $password_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
        <p>
            New user? Create an account by clicking <a href="registration.php">here</a>.
        </p>
    </form>
</div>

<?=template_footer()?>