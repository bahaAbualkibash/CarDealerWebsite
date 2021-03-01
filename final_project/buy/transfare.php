<?php
session_start();
require '../database/getconn.php';
$transfareEmail = $_POST['transfareemail'];
$amount = $_POST['amount'];
$originalAmount = $_POST['amount'];
$path = $_POST['path'];
var_dump($path);
$amountAfter = $amount * 0.02;
$amount = $amount - $amountAfter;
$isThereUser = "SELECT * from `users` where user_email='$transfareEmail'";
// var_dump($isThereUser);
$result = mysqli_query($conn, $isThereUser);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
$checkBalance = "SELECT `Balance` from `users` where user_email='" . $_SESSION['something'] . "' ";
$BalanceGet = mysqli_query($conn, $checkBalance);
$FetchBalance = mysqli_fetch_all($BalanceGet, MYSQLI_ASSOC);
var_dump($FetchBalance[0]['Balance']);

if (isset($transfareEmail)  && isset($amount)) {
    // if($FetchBalance[0]['Balance'] >0 )
    if ($users == []) {
        header("Location: $path?x=There Is No User With This Email");
    } else {
        $sendQueryToUser = "UPDATE `users` SET Balance=Balance + $amount where user_email='" . $transfareEmail . "'";
        var_dump($sendQueryToUser);
        $sendQueryToBalance = "UPDATE `balance` SET `Total`= Total + $amountAfter";
        $cutFromMain = "UPDATE `users` SET `Balance`=Balance - $originalAmount where user_email = '" . $_SESSION['something'] . "'";
        if (
            mysqli_query($conn, $sendQueryToUser) &&
            mysqli_query($conn, $cutFromMain) &&
            mysqli_query($conn, $sendQueryToBalance)

        ) {
            echo 'success';
        } else {
            echo 'failed';
        }
    }
}
