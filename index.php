<!DOCTYPE html>
<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'forum') or die("Failed to connect to MySQL: " . mysqli_error());

$user_id = $_SESSION['u_id'];
$user_name = $_SESSION['u_name'];
$subject_list = array(); // store the title's topic
$date_list = array(); // store date when topic was created
$name_array = array(); // store name of user who created the topic
$topic_id = array(); // store the topics' id
$u_id_list = array(); // store id of user who created the topic

// direct to home page if user_id or user_name is empty
if (empty($user_id) || empty($user_name)){
    header("Location: http://localhost/forum/home_page.php");
}

$get_topic = mysqli_query($db, "SELECT topic_id, `user_id`, `level`, `subject`, `date` FROM `topic`");

// store topic_id, user_id, subject, date in 4 arrays
while ($row = mysqli_fetch_array($get_topic)) {
    $topic_id[] = $row['topic_id'];
    $u_id_list[] = $row['user_id'];
    $subject_list[] = $row['subject'];
    $date_list[] = $row['date'];
}

// get number of records
$no_record = count($u_id_list);

// get and store user_name based on array of user_id
for ($i = 0; $i < $no_record; $i++) {
    $user_id = $u_id_list[$i];
    $get_u_name = mysqli_query($db, "SELECT `user_name` FROM `users` WHERE user_id = '$user_id'");
    $get_u_name_result = mysqli_fetch_array($get_u_name);
    $u_name = $get_u_name_result['user_name'];
    array_push($name_array, $u_name);
}

// get and store number of replies of each topic
$no_replies_list = array(); // <= numbers of replies are stored here 
for ($i = 0; $i < $no_record; $i++) {
    $id = $topic_id[$i];
    $get_no_replies = mysqli_query($db, "SELECT COUNT(reply_id) AS no_replies FROM replies WHERE topic_id = '$id'"); // get quantity of replies
    $get_no_replies_result = mysqli_fetch_array($get_no_replies);
    $no_replies = $get_no_replies_result['no_replies'];
    array_push($no_replies_list, $no_replies);
}

// get 5 topics which has the greatest number of replies
$max = 0; // <= the greatest number of replies
$pos = 0;
$top_subject_list = array();
$element = 0;

// loop the array containing indices of 5 most-replies topics
for ($j = 0; $j < 5; $j++) {
    // loop the array containing the number of replies of each topic
    for ($i = 0; $i < count($no_replies_list); $i++) {
        $element = $no_replies_list[$i];
        if ($element >= $max) {
            $max = $element;
            $pos = $i;
        }
    }
    // after discovering the topic has the most replies, set its no of replies to -1
    $no_replies_list[$pos] = -1;
    // set max to 0
    $max = 0;
    array_push($top_subject_list, $pos);
}

// end of php class
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FIT Forum</title>
        <link rel="stylesheet" href="home_style.css">
    </head>
    <body>
        <div class="row">
            <div class="column left">
                <h1 style="color: #ff0066;">In FIT... How to not retake?</h1>
            </div>
            <div class="column right">
                <h2 style="font-size: large; color: blue;">Ciao</h2>
                <a style="text-decoration: none; color: red; font-weight: bold;" href="personal.php"><?php
                    echo $user_name . "<br>";
                    ?>
                </a>
                <a style="font-style: italic;" href="log_out.php">Log out</a>
            </div>
        </div>
                <div >
            <table>
                <th>
                    <a href="paritcular_level.php?level=<?php echo "2nd"; ?>">2nd year students</a>
                </th>
                <th>
                    <a href="paritcular_level.php?level=<?php echo "3rd"; ?>">3rd year students</a>
                </th>
                <th>
                    <a href="paritcular_level.php?level=<?php echo "4th"; ?>">4th year students</a>
                </th>
            </table>
        </div>
        <div class="contain ques">
            <h3>New Questions</h3>
            <h4><a style="background-color: #ff9999; color:#0000e6; text-decoration: none;" href="ask.php">Want to ask?</a></h4>
            <?php
            // print each subject together with its author and date when it was created
            $new_ques_limit = $no_record - 5;
            for ($i = $no_record - 1; $i >= $new_ques_limit; $i--) {
                ?>
                <ul>
                    <li><a href="question_page.php?id=<?php echo $topic_id[$i]; ?>"><?php echo $subject_list[$i]; ?></a></li>
                    <li style="font-style: italic;">by <?php echo $name_array[$i]; ?> at <?php echo $date_list[$i]; ?></li>
                </ul>
                <?php
            }
            ?>
        </div>
        <div class="contain top">
            <h3>Most Replies</h3>
            <?php
            $length_top_list = count($top_subject_list);
            for ($i = 0; $i < $length_top_list; $i++) {
                $index = $top_subject_list[$i];
                ?>
                <ul>
                    <li><a href="question_page.php?id=<?php echo $topic_id[$index]; ?>"><?php echo $subject_list[$index]; ?></a></li>
                </ul>
                <?php
            }
            ?>
        </div>
    </body>
</html>