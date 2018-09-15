<!DOCTYPE html>
<?php
session_start();

// connect to db    
$db = mysqli_connect('localhost', 'root', '', 'forum') or die("Failed to connect to MySQL: " . mysqli_error());

$user_id = $_SESSION['u_id'];

// get all topic created by the this user
$get_ques = mysqli_query($db, "SELECT `topic_id`, `subject`, `date` FROM `topic` WHERE user_id = '$user_id'");

// create array storing topics' id, their title and date 
while ($ques_rows = mysqli_fetch_array($get_ques)) {
    $topic_id[] = $ques_rows['topic_id'];
    $subject[] = $ques_rows['subject'];
    $date[] = $ques_rows['date'];
}

$no_record = count($subject);

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
        <title>List of your questions</title>
        <link rel="stylesheet" href="question_list.css">
    </head>
    <body>
        <header><h3><a href="index.php">Home</a></h3></header>
        <div class="format">
            <label><h3 style="text-align: center;">List of your questions</h3></label>
            <table>
                <?php
                // loop each topic which has been created
                for ($i = $no_record - 1; $i >= 0; $i--) {
                    $no_of_reply = $no_replies_list[$i]; // get the number of replies
                    $order = $no_record - $i; // the the order of the topic
                    $t_id = $topic_id[$i]; // get the topic's id
                    ?>
                    <tr>
                        <td><a href="question_page.php?id=<?php echo $t_id; ?>">
                                <?php
                                // print the topic's title
                                echo $order . ". " . $subject[$i];
                                ?>
                            </a>
                        </td>
                        <td style="text-align: right;">
                            <?php
                            // print the date when topic's created and its number of replies
                            if ($no_of_reply == 0 || $no_of_reply == 1) {
                                echo " at " . $date[$i] . " received " . $no_of_reply . " reply";
                            } else {
                                echo " at " . $date[$i] . " received " . $no_of_reply . " replies";
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
