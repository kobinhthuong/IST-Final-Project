<!DOCTYPE html>
<?php
session_start();

// connect to db    
$db = mysqli_connect('localhost', 'root', '', 'forum') or die("Failed to connect to MySQL: " . mysqli_error());

if (isset($_POST['login_button'])) {
    login();
}

function login() {
    global $db;
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $errors = array();

// check if $username is empty
    if (empty($user_name)) {
        array_push($errors, 'Username is required');
        die("Username is required");
    }
    
// check if $username exists
    $get_user_id = mysqli_query($db, "SELECT user_id from users WHERE user_name = '$user_name'");
    if (mysqli_num_rows($get_user_id) == 0) {
        array_push($errors, "Username doesn't exist");
        die("Username doesn't exist");
    }

// check if password is empty
    if (empty($password)) {
        array_push($errors, 'Password is required');
        die("Password is required");
    }

// encrypt the password which is input
    $encrypt_password = md5($password);

// get the password from db
    $get_password = mysqli_query($db, "SELECT password FROM users WHERE password = '$encrypt_password'");

// check if the password is valid
    if (mysqli_num_rows($get_password) == 0) {
        array_push($errors, 'Password is invalid');
        die("Invalid password");
    }
    
    // get user_id & user_name
    $user_id_result = mysqli_fetch_array($get_user_id);
    $_SESSION['u_id'] = $user_id_result['user_id'];
    $_SESSION['u_name'] = $user_name;

// login when there is no error
    if (count($errors) == 0) {
        $_SESSION['success'] = "Login successfully!";
        header("Location: http://localhost/forum/index.php");
    } else {
        $_SESSION['error'] = "Error";
        header('error');
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="authen_style.css">
    </head>
    <body>
        <div class="header">
            <h2>Login</h2>
        </div>
        <form method ="post" action="login.php">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="user_name" value="">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" value="">
            </div>
            <div class="input-group">
                <button type="submit" class="button" name="login_button">Login</button>
                <a style="color: #0000e6;" href="register.php">Haven't had an account?</a>
            </div>
        </form>
    </body>
</html>