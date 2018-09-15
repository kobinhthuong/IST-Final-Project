<!DOCTYPE html>
<?php
session_start();

// connect to db
$db = mysqli_connect('localhost', 'root', '', 'forum') or die("Failed to connect to MySQL: " . mysqli_error());

// call the register() function if register_button is clicked
if (isset($_POST['register_button'])) {
    register();
}

function register() {
    // call variables with global keyword to make them available in the function
    global $db;

    // receive all input values from the form
    $user_name = $_POST['user_name'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    $errors = array();

    // form validation: make sure the form is correctly filled
    // validate username
    $get_user_id = mysqli_query($db, "SELECT user_id FROM users WHERE user_name = '$user_name'");
    if (mysqli_num_rows($get_user_id) > 0) {
        array_push($errors, "Username has existed already");
        die("Username has existed already! Choose another name!");
    }

    // check if user_name is empty
    if (empty($user_name)) {
        array_push($errors, "Username is required");
        die("Username is required!");
    }
    
    // check if user_name only contains alphabetic characters and digits
    if (!ctype_alnum($user_name)) {
        array_push($errors, "Invalid username");
        die("Username can only contain letters and numbers");
    }

    // check if user_name's length < 6
    if (strlen($user_name) < 6) {
        array_push($errors, "Invalid username");
        die("Username must contain at least 6 characters!");
    }
    
    // check if user_name's length > 20
    if (strlen($user_name) > 20 ) {
        array_push($errors, "Invalid username");
        die("Username must not contain no more than 20 characters!");
    }

    // check if user has entered password
    if (empty($password_1)) {
        array_push($errors, "Password is required");
        die("Password is required");
    }

    // check if password's length < 8
    if (strlen($password_1) < 8) {
        array_push($errors, "Invalid password");
        die("Password must contain at least 8 characters!");
    }

    // check if password's length > 20
    if (strlen($password_1) > 20) {
        array_push($errors, "Invalid password");
        die("Password must not contain no more than 20 characters!");
    }

    // check password contains alphabetic characters and digits
    if (!ctype_alnum($password_1)) {
        array_push($errors, "Invalid password");
        die("Password can only contain letters and numbers");
    }

    // check if 2 password match with each other
    if ($password_1 != $password_2) {
        array_push($errors, "Two passwords do not match");
        die("Two passwords do not match");
    }

    // register user if there is no error in the form
    if (count($errors) == 0) {
        // encrypt the password before saving in the db
        $password = md5($password_1);
        // add new user
        mysqli_query($db, "INSERT INTO users (user_name, password) VALUES('$user_name', '$password')");
        echo "New user successfully created!";
        header("Location: http://localhost/forum/login.php");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
        <link rel="stylesheet" href="authen_style.css">
    </head>
    <body>
        <div class ="header">
            <h2>Register</h2>
        </div>
        <form method="post" action="register.php">
            <div class="input-group"
                 <label>Username</label>
                <input type="xt" name="user_name" placeholder="Only contains letters or numbers and has at least 8 characters" value="">
            </div>
            <div class="input-group"
                 <label>Password</label>
                <input type="password" name="password_1" placeholder="Only contains letters or numbers and has at least 8 characters" value="">
            </div>
            <div class="input-group"
                 <label>Confirm password</label>
                <input type="password" name="password_2" placeholder="Insert password again" value="">
            </div>
            <div class="input-group">
                <button type="submit" class="button" name="register_button">Register</button>
            </div>
            <div>
                <label style="margin: 10px;">Already a member?</label><a style="color: #0000e6;" href="login.php">Log in</a>
            </div>
        </form>
    </body>
</html>