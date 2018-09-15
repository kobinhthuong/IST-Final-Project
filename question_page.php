<!DOCTYPE html>
<?php
session_start();

// connect to db    
$db = mysqli_connect('localhost', 'root', '', 'forum') or die("Failed to connect to MySQL: " . mysqli_error());

$user_id = $_SESSION['u_id'];
$user_name = $_SESSION['u_name'];
$topic_id = $_GET['id'];

// get user_id, subject, content and date of topic
$get_topic = mysqli_query($db, "SELECT user_id, subject, `t_content`, `date` FROM `topic` WHERE topic_id = '$topic_id'");
$get_topic_result = mysqli_fetch_array($get_topic);
$subject = $get_topic_result['subject'];
$content = $get_topic_result['t_content'];
$date = $get_topic_result['date'];
$author_id = $get_topic_result['user_id'];

// get name of user who created the topic
$get_u_name = mysqli_query($db, "SELECT `user_name` FROM `users` WHERE user_id = '$author_id'");
$get_u_name_result = mysqli_fetch_array($get_u_name);
$author_name = $get_u_name_result['user_name'];

$get_reply = mysqli_query($db, "SELECT reply_id, user_id, content, date FROM `replies` WHERE topic_id = '$topic_id'");

// if the reply is valid, invoke reply() function
if (isset($_POST['reply'])) {
    $rep_content = $_POST['rep_content'];
    $num_spaces_con = substr_count($rep_content, ' ');
    $con_length = strlen($rep_content) - $num_spaces_con;

    if (empty($rep_content) || $con_length < 50) {
        die("Your reply must contain at least 20 characters (not include spaces)!");
    } else if ($con_length > 2000) {
        die("Your reply must not exceed 2000 characters (not include spaces)");
    }

    reply();
}

// add reply to db
function reply() {
    global $db, $user_id, $topic_id, $rep_content;
    $add_reply = mysqli_query($db, "INSERT INTO `replies`(`user_id`, `topic_id`, `content`) VALUES ('$user_id', '$topic_id', '$rep_content')");

    if ($add_reply !== FALSE) {
        header("Location: http://localhost/forum/question_page.php?id=" . $topic_id);
    }
}

// end of php class
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Question</title>
    </head>
    <style>
        body{
            font-family: "Courier New";
        }
        header{
            background-color: #ffcc99;
            border: 1px #ffb366 solid;
            border-radius: 4px;
            padding-left: 20px;
            text-decoration: none;
        }
        header a {
            text-decoration: none;
            color: #e60073;
        }
        .format{
            margin: 5% 1% 5% 1%;
            width: 93%;
            border: 1px #B0C4DE solid;
            padding: 2%;
            background-color: #bbff99;
        }
        .format label{
            margin-left: 2%;
            font-weight: bold;
            font-size: 1.3em;
            width: 90%;
        }
        .format section{
            margin: 1% 2% 1% 2%;
            /*margin: auto;*/
            border: 1px darkblue solid;
            /*width: 95%;*/
            padding: 1%;
            text-align: justify;
        }
        textarea{
            border: 1px #ff9900 solid;
            margin: 2% 2% 1% 2%;
            width: 94%;
            height: 200px;
            padding: 1%;
        }
        button{
            background-color: #ffd699;
            font-family: "Courier New";
            border: 2px #ff9900 solid;
            border-radius: 10px;
            padding: 3px;
            margin: 1% 0% 0% 2%;
            font-weight: bold;
        }
    </style>
    <body>
        <header>
            <h3><a href="http://localhost/forum/index.php">Home</a></h3>
        </header>
        <div class="format">
            <label>Title: <?php echo $subject; ?>
            </label>
            <div style="font-style: italic; margin-left: 2%;">
                <!--show time of question-->
                At <?php echo $date; ?><br>
                <!--show question's owner-->
                Asked by: <?php echo $author_name; ?>
            </div>
            <section>
                <!--show question's content-->
                <?php echo $content; ?>
            </section>
            <?php
            // store user_id, subject, date in 3 arrays
            $rep_id = array();
            while ($row = mysqli_fetch_array($get_reply)) {
                $rep_id[] = $row['reply_id'];
                $u_id_list[] = $row['user_id'];
                $content_list[] = $row['content'];
                $date_list[] = $row['date'];
            }

            // get number of records
            $no_record = count($rep_id);

            // get and store user_name based on array of user_id
            $name_array = array();
            for ($i = 0; $i < $no_record; $i++) {
                $u_id = $u_id_list[$i];
                $get_u_name = mysqli_query($db, "SELECT `user_name` FROM `users` WHERE user_id = '$u_id'");
                $get_u_name_result = mysqli_fetch_array($get_u_name);
                $u_name = $get_u_name_result['user_name'];
                array_push($name_array, $u_name);
            }

            // count and store the number of likes for each reply
            $likes_number = array();
            for ($i = 0; $i < $no_record; $i++) {
                $id = $rep_id[$i];
                $get_like = mysqli_query($db, "SELECT COUNT(like_id) AS no_likes FROM likes WHERE reply_id = '$id'");
                $get_like_result = mysqli_fetch_array($get_like);
                $no_replies = $get_like_result['no_likes'];
                array_push($likes_number, $no_replies);
            }

            // show all the replies along with its owner, time and number of likes
            for ($i = $no_record - 1; $i >= 0; $i--) {
                ?>
                <section>
                    <?php
                    echo "<mark>Reply:</mark>" . " " . $content_list[$i] . "<br><br>"; // show content
                    echo "By " . $name_array[$i]; // show owner
                    echo " at " . $date_list[$i]; // show time
                    ?>
                    <form method="post">
                        <button type="submit" name="like<?php echo $i; ?>" style="background-color: #ffb3d1; border: 1px solid #ff3385; margin-left: 1px;">Like</button> <?php echo $likes_number[$i]; ?>
                    </form>
                </section>
                <?php
                ob_start();
            }

            /**
             * @effects
             *  if user A has liked the reply X
             *      delete his/ her like on X in db
             *  else
             *      add his/ her like on X in db
             */
            for ($i = $no_record - 1; $i >= 0; $i--) {
                if (isset($_POST['like' . $i])) {
                    $check_query = mysqli_query($db, "SELECT `like_id` FROM `likes` WHERE user_id = '$user_id' AND reply_id = '$rep_id[$i]'");
                    $check_query_result = mysqli_fetch_array($check_query);

                    if (mysqli_num_rows($check_query) != 0) {
                        $like_id = $check_query_result['like_id'];
                        mysqli_query($db, "DELETE FROM `likes` WHERE like_id = '$like_id'");
                        header("Location: http://localhost/forum/question_page.php?id=" . $topic_id);
                    } else {
                        mysqli_query($db, "INSERT INTO `likes`(`reply_id`, `user_id`) VALUES ('$rep_id[$i]', '$user_id')");
                        header("Location: http://localhost/forum/question_page.php?id=" . $topic_id);
                    }
                }
            }
            ob_end_flush();
            ?>
            <form method="post">
                <textarea placeholder="Reply here (at least 50 characters and no more than 2000 characters)..." name="rep_content"></textarea>
                <button type="submit" name="reply">Reply</button>
            </form>
        </div>
    </body>
</html>
