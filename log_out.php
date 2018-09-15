<!DOCTYPE html>
<?php
session_start();
unset($_SESSION['u_id']);
unset($_SESSION['u_name']);
session_destroy();

header("Location: login.php");
exit;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    </body>
</html>
