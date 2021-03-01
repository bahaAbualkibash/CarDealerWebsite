<?php
session_start();
require '../database/getconn.php';
$query = mysqli_query($conn, 'SELECT * FROM `car-info`');

if ($_SESSION['something'] == null) {
    header("Location: ../main/main.php");
}
$query2 = mysqli_query($conn, "SELECT * FROM  `users` where `user_email`='" . $_SESSION['something'] . "'");
$user = mysqli_fetch_all($query2, MYSQLI_ASSOC);

$id = $user[0]['user_id'];
$query3 = mysqli_query($conn, "SELECT * FROM card INNER JOIN `car-info` ON card.Car_id = `car-info`.Car_id and  `user_id`='" . $id . "'");
$cars = mysqli_fetch_all($query, MYSQLI_ASSOC);
$carts2 = mysqli_fetch_all($query3, MYSQLI_ASSOC);
$total = 0;

foreach ($carts2 as $cart) {
    $total = $total + ($cart['Car_price'] * $cart['number_of_cars']);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['formSubmitted'])) {
    BuyBtnPressed();
}
// plus btn
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['plus'])) {
    plusPressed();
}
// Minus btn
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['minus'])) {
    minusPressed();
}




function BuyBtnPressed()
{


    $conn = mysqli_connect('localhost', 'root', '123456', 'cars');
    $query2 = mysqli_query($conn, "SELECT * FROM  `users` where `user_email`='" . $_SESSION['something'] . "'");
    $user = mysqli_fetch_all($query2, MYSQLI_ASSOC);
    $Car_id = mysqli_real_escape_string($conn, $_POST['id']);
    $user_id = $user[0]['user_id'];

    $qunatity = mysqli_query($conn, "SELECT Car_quantity  FROM `car-info` where Car_id='" . $Car_id . "'");
    $fetchQuantity = mysqli_fetch_all($qunatity, MYSQLI_ASSOC);
    if ($fetchQuantity[0]['Car_quantity'] > 0) {

        $queryUpdate = "UPDATE `car-info` SET Car_quantity= Car_quantity -1 where Car_id='" . $Car_id . "'";
        $queryInsert = "INSERT INTO card(Car_id,number_of_cars,user_id) VALUES('" . $Car_id . "',1,'" . $user_id . "') ON DUPLICATE KEY UPDATE number_of_cars = number_of_cars + 1 ";
        var_dump($queryUpdate);
        echo "<br>";
        var_dump($queryInsert);
        if (mysqli_query($conn, $queryInsert)) {
            var_dump($queryInsert);
            mysqli_query($conn, $queryUpdate);
            header('Location:' . $_SERVER['PHP_SELF'] . '');
        }
    }
}
function plusPressed()
{
    $conn = mysqli_connect('localhost', 'root', '123456', 'cars');
    $Car_id = mysqli_real_escape_string($conn, $_POST['id1']);
    $query2 = mysqli_query($conn, "SELECT * FROM  `users` where `user_email`='" . $_SESSION['something'] . "'");
    $user = mysqli_fetch_all($query2, MYSQLI_ASSOC);
    $user_id = $user[0]['user_id'];
    $qunatity = mysqli_query($conn, "SELECT Car_quantity  FROM `car-info` where Car_id='" . $Car_id . "'");
    $fetchQuantity = mysqli_fetch_all($qunatity, MYSQLI_ASSOC);
    if ($fetchQuantity[0]['Car_quantity'] > 0) {
        $queryUpdate = "UPDATE `car-info` SET Car_quantity= Car_quantity -1 where Car_id='" . $Car_id . "'";
        $queryInsert = "INSERT INTO card(Car_id,number_of_cars,user_id) VALUES('$Car_id',1,'" . $user_id . "') ON DUPLICATE KEY UPDATE number_of_cars = number_of_cars + 1 ";
        var_dump($queryUpdate);
        echo "<br>";
        var_dump($queryInsert);
        if (mysqli_query($conn, $queryInsert)) {
            mysqli_query($conn, $queryUpdate);
            header('Location:' . $_SERVER['PHP_SELF'] . '');
        } else {
            echo 'ERROR' . mysqli_error($conn);
        }
    }
}
function minusPressed()
{
    $conn = mysqli_connect('localhost', 'root', '123456', 'cars');
    $Car_id = $_POST['id2'];
    $query2 = mysqli_query($conn, "SELECT * FROM  `users` where `user_email`='" . $_SESSION['something'] . "'");
    $user = mysqli_fetch_all($query2, MYSQLI_ASSOC);
    $user_id = $user[0]['user_id'];
    $number_of_cars = mysqli_query($conn, "SELECT `number_of_cars` FROM card WHERE `Car_id`='" . $Car_id . "'");
    $result_number =  mysqli_fetch_all($number_of_cars, MYSQLI_ASSOC);
    print_r($result_number);
    if ($result_number[0]["number_of_cars"] > 1) {
        var_dump($number_of_cars);
        $queryUpdate = "UPDATE `car-info` SET Car_quantity= Car_quantity + 1 where Car_id='" . $Car_id . "'";
        $queryInsert = "INSERT INTO card(Car_id,number_of_cars,user_id) VALUES('$Car_id',1,'" . $user_id . "') ON DUPLICATE KEY UPDATE number_of_cars = number_of_cars - 1 ";
        var_dump($queryUpdate);
        echo "<br>";
        var_dump($queryInsert);
        if (mysqli_query($conn, $queryInsert)) {
            mysqli_query($conn, $queryUpdate);
            header('Location:' . $_SERVER['PHP_SELF'] . '');
        } else {
            echo 'ERROR' . mysqli_error($conn);
        }
    } else {
        $queryUpdate = "UPDATE `car-info` SET Car_quantity= Car_quantity + 1 where Car_id='" . $Car_id . "'";
        $queryDelete = "DELETE FROM card WHERE `Car_id`='$Car_id' and user_id='" . $user_id . "'";
        var_dump($queryUpdate);
        echo "<br>";
        var_dump($queryDelete);
        if (mysqli_query($conn, $queryDelete)) {
            mysqli_query($conn, $queryUpdate);
            header('Location:' . $_SERVER['PHP_SELF'] . '');
        } else {
            echo 'ERROR' . mysqli_error($conn);
        }
    }
}



?>


<body>
    <?php include '../buy/header.php'; ?>
    <div class="flex-container">
        <?php require 'left_nav.php' ?>

        <div style="max-height: 90vh; " class="overflow-auto">
            <div class="item item-2">
                <div class="grid-container">
                    <?php foreach ($cars as $car) : ?>

                        <div class="card cararr">
                            <?php echo '<img class="card-img-top" style="max-width: 100%; height: auto;" src="data:image/jpeg;base64,' . base64_encode($car['Car_photo']) . '"></img>'; ?>
                            <div class="card-body">

                                <h5 class="card-title"><?php echo $car['Car_company'] . ' ' . $car['Car_model'] . ' ' . $car['Car_Year'] ?></h5>
                                <p class="card-text">$<?php echo number_format($car['Car_price'])  ?></p>
                                Quantity<p class="card-text"><?php echo $car['Car_quantity'] ?></p>

                                <?php if ($car['Car_quantity'] > 0) : ?>
                                    <button type="button" data-toggle="modal" data-target="._<?php echo $car['Car_model'] ?>" class="btn btn-danger btn-block buybtn">Buy now</button>
                                <?php else : ?>
                                    <button type="button" data-toggle="modal" data-target="._<?php echo $car['Car_model'] ?>" class="btn btn-dark btn-block buybtn" disabled>Sold Out</button>
                                <?php endif ?>

                            </div>
                        </div>
                        <div class="modal fade  _<?php echo $car['Car_model'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <?php echo '<img class="d-block w-100" style="max-width: 100%; height: auto;" src="data:image/jpeg;base64,' . base64_encode($car['Car_photo']) . '"></img>'; ?>
                                            </div>
                                            <div class="carousel-item ">
                                                <?php echo '<img class="d-block w-100" style="max-width: 100%; height: auto;" src="data:image/jpeg;base64,' . base64_encode($car['Car_photo2']) . '"></img>'; ?>
                                            </div>
                                            <div class="carousel-item ">
                                                <?php echo '<img class="d-block w-100" style="max-width: 100%; height: auto;" src="data:image/jpeg;base64,' . base64_encode($car['Car_photo3']) . '"></img>'; ?>
                                            </div>
                                            <div class="carousel-item ">
                                                <?php echo '<img class="d-block w-100" style="max-width: 100%; height: auto;" src="data:image/jpeg;base64,' . base64_encode($car['Car_photo4']) . '"></img>'; ?>
                                            </div>

                                        </div>

                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $car['Car_company'] . ' ' . $car['Car_model'] . ' ' . $car['Car_Year'] ?></h5>
                                            <p class="card-text">$<?php echo number_format($car['Car_price'])  ?></p>
                                            <p class="card-text"><?php echo $car['Car_desc']  ?></p>
                                            <form method="POST">
                                                <textarea name="id" hidden><?php echo $car['Car_id'] ?></textarea>
                                                <button type="submit" name="formSubmitted" class="btn btn-danger btn-block addtocart" value="cart">Add to Cart</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <div class="item item-3" style="max-height: 90vh; overflow: auto;">
            <h4>Shopping Cart</h4>
            <div id="checkout-cards">
                <?php foreach ($carts2 as $cart) : ?>
                    <div class="card">
                        <?php echo '<img class="d-block w-100" style="max-width: 100%; height: auto;" src="data:image/jpeg;base64,' . base64_encode($cart['Car_photo']) . '"></img>'; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $cart['Car_company'] . ' ' . $cart['Car_model'] . ' ' . $cart['Car_Year'] ?></h5>
                            <p class="card-text">$<?php echo number_format($cart['Car_price'])  ?></p>
                            <form method="POST">
                                <textarea name='id2' hidden><?php echo $cart['Car_id'] ?></textarea>
                                <button type="submit" name="minus" class="btn btn-danger ">-</button>
                            </form>
                            <label><?php echo $cart['number_of_cars'] ?></label>
                            <form method="POST">
                                <textarea name='id1' hidden><?php echo $cart['Car_id'] ?></textarea>
                                <button type="submit" name="plus" class="btn btn-success ">+</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <hr>
            <h3>Total</h3>

            <h5 class="card-text mt-3 total">$<?php echo number_format($total)  ?></h5>


        </div>
    </div>
    <script src="main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

</body>

</html>