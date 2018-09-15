<!DOCTYPE html>
<?php
session_start();

// connect to db    
$db = mysqli_connect('localhost', 'root', '', 'forum') or die("Failed to connect to MySQL: " . mysqli_error());

$user_id = $_SESSION['u_id'];

if (isset($_POST['send'])) {
    ask();
}

function ask() {
    global $db, $user_id;
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    $level = $_POST['level'];
    $errors = array();
    $num_spaces_sub = substr_count($subject, ' ');
    $num_spaces_con = substr_count($content, ' ');

    if (empty($subject)) {
        array_push($errors, "Invalid subject");
        die("You need to fill in the subject!");
    } else if (strlen($subject) - $num_spaces_sub < 20) {
        array_push($errors, "Not enough char");
        die("The subject must contain at least 10 characters (not include space)");
    } else if (strlen($subject) - $num_spaces_sub > 50) {
        array_push($errors, "Too many chars");
        die("The subject must not exceed 50 characters (not include space)");
    } else if (empty($content)) {
        array_push($errors, "Invalid content");
        die("You need to fill in the content!");
    } else if (strlen($content) - $num_spaces_con < 100) {
        array_push($errors, "Not enough char");
        die("The content must contain at least 100 character (not include space)");
    } else if (strlen($content) - $num_spaces_con > 2000) {
        array_push($errors, "Too many chars");
        die("The content must not exceed 2000 characters (not include space)");
    }

    if (count($errors) === 0) {
        mysqli_query($db, "INSERT INTO `topic`(`user_id`, `subject`, t_content, level) VALUES ('$user_id', '$subject', '$content', '$level')");
        header("Location: http://localhost/forum/index.php");
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ask</title>
    </head>
    <style>
        body {
            font-family: "Courier New";
        }
        header{
            background-color: #ffcc99;
            border: 1px #ffb366 solid;
            border-radius: 4px;
            padding-left: 20px;
        }
        header a {
            text-decoration: none;
            color: #e60073;
        }
        form {
            margin: 5% 15% 5% 15%;
            width: 70%;
            border: 2px #B0C4DE solid;
            background-color: #cce5ff;
        }
        .title{
            margin-left: 20px;
        }
        form input{
            padding: 7px;
            margin: 0px 0px 0px 20px;
            width: 80%;
            border: 1px #B0C4DE solid;
        }
        textarea{
            width: 90%;
            padding: 7px;
            margin: 0px 0px 20px 20px;
            height: 200px;
            border: 1px #B0C4DE solid;
        }
        button{
            background-color: #ffd699;
            font-family: "Courier New";
            border: 2px #ff9900 solid;
            border-radius: 10px;
            padding: 5px;
            margin: 0px 0px 20px 20px;
            font-weight: bold;
        }
        select {
            border: 1px #B0C4DE solid;
            border-radius: 5px;
            height: 30px;
            width: 130px;
        }
        select option {
            font-family: "Courier New";
        }
    </style>
    <body>
        <header><h3><a href="http://localhost/forum/index.php">Home</a></h3>
        </header>
        <form method="post">
            <div class="title">
                <h4>Your question belongs to 
                    <select name="level">
                        <option value="2nd year students">2nd year students</option>
                        <option value="3rd year students">3rd year students</option>
                        <option value="4th year students">4th year students</option>
                    </select>
                </h4>
            </div>
            <div class="title">
                <h4>Subject</h4>
            </div>
            <input style="font-family: Courier New;" type="text" placeholder="Your question is about? (Contains at least 10 characters and no more than 50 characters)" name="subject">
            <div class="title">
                <h4>Content</h4>
            </div>
            <textarea style="font-family: Courier New;" placeholder="Your question is... (Contains at least 100 characters and no more than 2000 characters)" name="content"></textarea>
            <button class="button" type="submit" name="send">Send</button>
        </form>
    </body>
</html>
