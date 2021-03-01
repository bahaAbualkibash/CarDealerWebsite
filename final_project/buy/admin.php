<?php
session_start();

if ($_SESSION['something'] == null) {
    header("Location: ../main/main.php");
}
require '../database/getconn.php';
$query = mysqli_query($conn, 'SELECT * FROM `car-info`');
$cars = mysqli_fetch_all($query, MYSQLI_ASSOC);

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

                                <h5 class="card-title">
                                    <?php echo $car['Car_company'] . ' ' . $car['Car_model'] . ' ' . $car['Car_Year'] ?>
                                </h5>
                                <p class="card-text">$
                                    <?php echo number_format($car['Car_price'])  ?>
                                </p>
                                <form method="POST" class="form-inline" action="add.php">
                                    <label for="add">Quantity: </label>
                                    <textarea name="old" id="old" hidden><?php echo $car['Car_quantity'] ?></textarea>
                                    <textarea name="add_id" id="add_id" hidden><?php echo $car['Car_id'] ?></textarea>
                                    <input style="width: auto;" name="add_input" type="text" class="form-control ml-3" placeholder="<?php echo $car['Car_quantity'] ?>" id="add">
                                    <button type="submit" class="btn btn-success ">Add </button>
                                </form>
                                <button type="button" data-toggle="modal" data-target="._<?php echo $car['Car_model'] ?>" class="btn btn-primary btn-block buybtn">Edit</button>
                                <form action="delete.php" method="POST">
                                    <textarea name="delete_id" id="delete_id" hidden><?php echo $car['Car_id'] ?></textarea>
                                    <button type="submit" class="btn btn-danger mt-2 btn-block">Remove</button>
                                </form>
                            </div>
                        </div>

                        <div class="modal fade  <?php echo '_' . $car['Car_model'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content p-3">
                                    <form method="POST" action="../buy/edit.php" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label for="exampleInputCompany1">Company</label>
                                            <input type="text" class="form-control" id="exampleInputCompany1" name="exampleInputCompany1" aria-describedby="CompanyHelp" placeholder=" Name" value="<?php echo $car['Car_company'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputyear1">Year</label>
                                            <input type="text" class="form-control" id="exampleInputyear1" name="exampleInputyear1" aria-describedby="yearHelp" placeholder=" Year" value="<?php echo $car['Car_Year'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputModel1">Model</label>
                                            <input type="text" class="form-control" id="exampleInputModel1" name="exampleInputModel1" aria-describedby="ModelHelp" placeholder=" Model" value="<?php echo $car['Car_model'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPrice1">Price</label>
                                            <input type="text" class="form-control" id="exampleInputPrice1" name="exampleInputPrice1" placeholder="Price" value="<?php echo $car['Car_price'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputDescription1">Description</label>
                                            <textarea class="form-control" id="exampleInputDescription1" name="exampleInputDescription1" placeholder="Description"><?php echo $car['Car_desc'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <?php echo '<img class="card-img-top d-inline" style="max-width: 50%; height: auto;" src="data:image/jpeg;base64,' . base64_encode($car['Car_photo']) . '"></img>'; ?>
                                            <input style="width: 49%;" type="file" type="image/*" class="form-control-file d-inline" id="exampleFormControlFile1" name="exampleFormControlFile1">
                                        </div>
                                        <div class="form-group">
                                            <?php echo '<img class="card-img-top d-inline" style="max-width: 50%; height: auto;" src="data:image/jpeg;base64,' . base64_encode($car['Car_photo2']) . '"></img>'; ?>
                                            <input type="file" style="width: 49%;" class="form-control-file d-inline" id="exampleFormControlFile2" name="exampleFormControlFile2">
                                        </div>
                                        <div class="form-group">
                                            <?php echo '<img class="card-img-top d-inline" style="max-width: 50%; height: auto;" src="data:image/jpeg;base64,' . base64_encode($car['Car_photo3']) . '"></img>'; ?>
                                            <input type="file" style="width: 49%;" class="form-control-file d-inline" id="exampleFormControlFile3" name="exampleFormControlFile3">
                                        </div>
                                        <div class="form-group">
                                            <?php echo '<img class="card-img-top d-inline" style="max-width: 50%; height: auto;" src="data:image/jpeg;base64,' . base64_encode($car['Car_photo4']) . '"></img>'; ?>
                                            <input type="file" style="width: 49%;" class="form-control-file d-inline" id="exampleFormControlFile4" name="exampleFormControlFile4">
                                        </div>

                                        <textarea name="id" hidden><?php echo $car['Car_id'] ?></textarea>
                                        <button type="submit" onclick="update()" class="btn btn-primary btn-block" name="btn">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>

    </div>
    <script src="main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script>
        function update() {
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('show').innerHTML = this.responseText;

                }

            };
            xhttp.open('POST', "../buy/edit.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("data1=bar&data2=foo");
        }
    </script>
</body>

</html>