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
    if (isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];
        var_dump($id);

        $quntity = 0;
        $query = "UPDATE `car-info` SET Car_quantity='" . $quntity . "' where Car_id='" . $id . "'";
        var_dump($query);
        if (mysqli_query($conn, $query) == false) {
            echo 'failed';
        } else {
            echo 'success';
        }
    } else {
        echo 'error';
    }

    header('Location: admin.php');
    ?>
</body>

</html>