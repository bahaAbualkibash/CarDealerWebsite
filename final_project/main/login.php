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
    session_start();
    require '../database/getconn.php';
    // print_r($conn);
    $email = $_POST['em'];
    // var_dump($email);
    $password = $_POST['pass'];
    $query = "SELECT * FROM `users`";
    // var_dump($query);
    $result  = mysqli_query($conn, $query);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // var_dump($users);
    foreach ($users as $user) {


        if (
            strtolower($user['user_email']) === strtolower($email)
            && $user['user_password'] === $password
        ) {
            $something = base64_encode($email);
            $_SESSION['something'] = $email;
            print_r($_SESSION['something']);
            if ($user['isAdmin'] == 1) {

                header("Location: ../buy/admin.php?");
            } else {
                header("Location: ../buy/flex.php?");
            }
        }
    }
    // header("Location: main.php?x=Some Information You Entered Is Wrong");



    ?>
</body>

</html>