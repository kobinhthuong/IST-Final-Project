<!DOCTYPE html>
<?php
session_start();

// connect to db    
$db = mysqli_connect('localhost', 'root', '', 'forum') or die("Failed to connect to MySQL: " . mysqli_error());

$level = $_GET['level'] . " year students";

$get_level = mysqli_query($db, "SELECT `topic_id`, `user_id`, `level`, `subject`, `t_content`, `date` FROM `topic` WHERE level = '$level'");

while ($get_level_result = mysqli_fetch_array($get_level)) {
    $u_id[] = $get_level_result['user_id'];
    $topic_id[] = $get_level_result['topic_id'];
    $subject[] = $get_level_result['subject'];
    $content[] = $get_level_result['t_content'];
    $date[] = $get_level_result['date'];
}

$no_record = count($subject);

// get and store user_name based on array of user_id
$name_array = array();

for ($i = 0; $i < $no_record; $i++) {
    $user_id = $u_id[$i];
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
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>For <?php echo $level; ?> students</title>
        <link rel="stylesheet" href="question_list.css">
    </head>
    <body>
        <header><h3><a href="index.php">Home</a></h3></header>
        <div class="format">
            <label><h3 style="text-align: center;">Question list</h3></label>
            <table>
                <?php
                for ($i = $no_record - 1; $i >= 0; $i--) {
                    $order = $no_record - $i;
                    $t_id = $topic_id[$i];
                    $no_of_reply = $no_replies_list[$i]; // get the number of replies
                    ?>
                    <tr>
                        <td><a href="question_page.php?id=<?php echo $t_id; ?>">
                                <?php
                                echo $order . ". " . $subject[$i];
                                ?></a>
                        </td>
                        <td style="text-align: right;">
                            <?php
                            echo "by " . $name_array[$i] . " at " . $date[$i];
                            ?>
                            <?php
                            // print the date when topic's created and its number of replies
                            if ($no_of_reply == 0 || $no_of_reply == 1) {
                                echo "<br>"."received " . $no_of_reply . " reply";
                            } else {
                                echo "<br>"."received " . $no_of_reply . " replies";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </body>
</html>
