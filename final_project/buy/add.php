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
    if (isset($_POST['add_input'])) {
        if ($_POST['add_input'] > 0) {
            $id = $_POST['add_id'];
            $quantity_befor_add = $_POST['old'];
            $query = "UPDATE `car-info` SET Car_quantity= '" . $quantity_befor_add  +  $_POST['add_input'] . "' where Car_id='" . $id . "'";
            var_dump($query);
            if (mysqli_query($conn, $query)) {
                echo 'ERROR' . mysqli_error($conn);
            } else {
                echo 'error';
            }
        }
    }
    header("Location: admin.php");
    ?>
</body>

</html>