<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require '../database/getconn.php';
    $id = $_POST['user-id'];

    $query = "UPDATE `users` SET isAdmin=1 where `user_id`='$id'";
    if (mysqli_query($conn, $query)) {

        echo 'success';
    } else {
        echo 'error';
    }
    header("Location: users.php");
    ?>
</body>

</html>