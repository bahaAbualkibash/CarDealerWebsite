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
    $email2 = $_POST['email'];
    $email = $_POST['email'];
    $username = $_POST['Username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $image1 = $_FILES['userphoto'];
    $query2 = "SELECT `user_email` FROM users";
    $query = mysqli_query($conn, $query2);
    $emails = mysqli_fetch_all($query, MYSQLI_ASSOC);
    foreach ($emails as $e) {
        if ($e['user_email'] === $email) {
            var_dump($e['user_email']);
            echo '<br>';
            var_dump($email);
            header("Location: main.php?x=Already Registered");
            exit();
            break;
        } else {
        }
    }

    if (
        $email != '' &&
        $username != '' &&
        $password != '' &&
        $phone != '' &&
        $location != '' &&
        isset($image1)
    ) {
        $email = $_POST['email'];
        $username = $_POST['Username'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $location = $_POST['location'];
        $image1 = $_FILES['userphoto'];
        if ($_FILES['userphoto']['name'] != '') {
            $image1 = $_FILES['userphoto']['tmp_name'];
            $image1 = addslashes(file_get_contents($_FILES['userphoto']['tmp_name']));
        }

        $query = "INSERT INTO users(username,user_email,user_password,user_photo,user_phone,user_location) 
    VALUES('$username','$email','$password','$image1','$phone','$location')";
        if (mysqli_query($conn, $query)) {
            echo 'success';
            header("Location: main.php?y=Success Signup");
        } else {
            echo 'error';
            header("Location: main.php?x=Failed Signup Try Again");
        }
    } else {
        header("location: main.php?x=Something Is Empty");
    }

    ?>
</body>

</html>