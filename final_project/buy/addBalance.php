<?php
session_start();
require '../database/getconn.php';
$amount = $_POST['amount'];
$path = $_POST['path'];

$visa = $_POST['visa'];
if (isset($visa) && isset($amount) && isset($path)) {
    if ($amount > 100) {
        $query = "UPDATE  `users` SET Balance=Balance+$amount where  user_email= '" . $_SESSION['something'] . "'";
        if (mysqli_query($conn, $query)) {
            echo 'success';
            header("Location: $path");
        } else {
            echo 'failed';
        }
    }
}
