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
    if (
        isset($_POST['id']) &&
        isset($_POST['exampleInputCompany1']) &&
        isset($_POST['exampleInputyear1']) &&
        isset($_POST['exampleInputModel1']) &&
        isset($_POST['exampleInputPrice1']) &&
        isset($_POST['exampleInputDescription1']) ||
        isset($_FILES['exampleFormControlFile1']) ||
        isset($_Files['exampleFormControlFile2']) ||
        isset($_Files['exampleFormControlFile3']) ||
        isset($_Files['exampleFormControlFile4'])
    ) {

        $id =  $_POST['id'];
        $comapny =  $_POST['exampleInputCompany1'];
        $year =  $_POST['exampleInputyear1'];
        $model =  $_POST['exampleInputModel1'];
        $price =  $_POST['exampleInputPrice1'];
        $desc =  $_POST['exampleInputDescription1'];


        if ($_FILES['exampleFormControlFile1']['name'] != '') {
            $image1 = $_FILES['exampleFormControlFile1']['tmp_name'];
            $image1 = addslashes(file_get_contents($_FILES['exampleFormControlFile1']['tmp_name']));
            mysqli_query($conn, "UPDATE `car-info` SET Car_photo='" . $image1 . "' where Car_id='" . $id . "'");
        }
        if ($_FILES['exampleFormControlFile2']['name'] != '') {
            $image2 = $_FILES['exampleFormControlFile2']['tmp_name'];
            $image2 = addslashes(file_get_contents($_FILES['exampleFormControlFile2']['tmp_name']));
            mysqli_query($conn, "UPDATE `car-info` SET Car_photo2='" . $image2 . "' where Car_id='" . $id . "'");
        }
        if ($_FILES['exampleFormControlFile3']['name'] != '') {
            $image3 = $_FILES['exampleFormControlFile3']['tmp_name'];
            $image3 = addslashes(file_get_contents($_FILES['exampleFormControlFile3']['tmp_name']));
            mysqli_query($conn, "UPDATE `car-info` SET Car_photo3='" . $image3 . "' where Car_id='" . $id . "'");
        }
        if ($_FILES['exampleFormControlFile4']['name'] != '') {
            $image4 = $_FILES['exampleFormControlFile4']['tmp_name'];
            $image4 = addslashes(file_get_contents($_FILES['exampleFormControlFile4']['tmp_name']));
            mysqli_query($conn, "UPDATE `car-info` SET Car_photo4='" . $image4 . "' where Car_id='" . $id . "'");
        }
        $query = mysqli_query($conn, "UPDATE `car-info` SET Car_model='" . $model . "',Car_Year='" . $year . " ',Car_desc= '" . $desc . "',Car_price='" . $price . "' , Car_company='" . $comapny . "' where Car_id='$id' ");
        if (mysqli_query($conn, $query)) {
            echo 'failed';
        } else {
            echo 'updated';
        }
    } else {
        echo 'error';
    }


    header("Location: admin.php");
    ?>
</body>

</html>