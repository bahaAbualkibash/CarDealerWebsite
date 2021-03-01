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

    if ($_SESSION['something'] == null) {
        header("Location: ../main/main.php");
    }
    require '../database/getconn.php';
    $query = mysqli_query($conn, 'SELECT * FROM `users` ');

    $users = mysqli_fetch_all($query, MYSQLI_ASSOC);

    ?>


    <body>
        <?php include '../buy/header.php'; ?>
        <div class="flex-container">
            <?php require './left_nav.php'  ?>

            <div style="max-height: 90vh; " class="overflow-auto">
                <div class="item item-2">
                    <ul style="width: 80vw;" class="list-group " style="float: left;">
                        <li class="list-group-item d-flex justify-content-between align-items-center "><span> Photo</span> <span>Email</span> <span> Make/Remove Admin</span></li>

                        <?php foreach ($users as $user) : ?>
                            <?php if ($user['isAdmin'] == 0) : ?>
                                <form method="post" action="make.php">
                                    <textarea name="user-id" id="user-id" hidden><?php echo $user['user_id'] ?></textarea>
                                    <li class="list-group-item d-flex justify-content-between align-items-center "><?php echo '<img style="width:100px; height:100px;" src="data:image/jpeg;base64,' . base64_encode($user['user_photo']) . '"></img>'; ?> <span name="email"><?php echo $user['user_email'] ?></span> <button type="submit" class="btn btn-primary ">Make Admin</button></li>
                                </form>

                            <?php else : ?>
                                <?php if ($user['user_id'] == 2) : ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center "><?php echo '<img style="width:100px; height:100px;" src="data:image/jpeg;base64,' . base64_encode($user['user_photo']) . '"></img>'; ?> <span><?php echo $user['user_email'] ?></span> <button type="submit" class="btn btn-danger " disabled>Remove Admin</button></li>
                                    <?php continue ?>
                                <?php endif ?>
                                <form method="post" action="dele.php">
                                    <textarea name="user-id" id="user-id" hidden><?php echo $user['user_id'] ?></textarea>

                                    <li class="list-group-item d-flex justify-content-between align-items-center "><?php echo '<img style="width:100px; height:100px;" src="data:image/jpeg;base64,' . base64_encode($user['user_photo']) . '"></img>'; ?> <span><?php echo $user['user_email'] ?></span> <button type="submit" class="btn btn-danger ">Remove Admin</button></li>
                                </form>

                            <?php endif ?>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>

        </div>
        <script src="main.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    </body>

</html>
</body>

</html>