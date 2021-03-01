<?php
require '../database/getconn.php';
// create query
$query = 'SELECT * FROM `car-info`';
if (isset($_GET['x']))
    echo "<div class='alert alert-danger' style='margin-bottom:0px;'>" . $_GET['x'] . "</div>";
if (isset($_GET['y']))
    echo "<div class='alert alert-success' style='margin-bottom:0px;'>" . $_GET['y'] . "</div>";
// get result
$result = mysqli_query($conn, $query);

// fetch data
$cars = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result
mysqli_free_result($result);

// close connection
mysqli_close($conn);
$i = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../../website3/bootstrap.min.css">
    <title>Welcome to Motoro</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        .brand {
            font-size: 90px;
        }

        .navbar ul li a {
            color: #3E4950;
            font-weight: 500;
        }

        .navbar ul li:hover {
            transition: border-bottom 150ms ease;
            border-bottom: 3px solid #3E4950;
        }

        .navbar {
            padding: 0px;
        }

        .navbar ul li.active-pg a {
            color: #DD232E;
            border-bottom: 3px solid #DD232E;
        }

        .navbar ul li.active-pg:hover {
            color: #DD232E;
            border-bottom: none;
        }

        #contact {
            border-top: 10px solid #3E4950;
            border-left: 1px solid #EEEEEE;
            border-right: 1px solid #EEEEEE;
            border-bottom: 1px solid #EEEEEE;
            padding: 20px;
        }

        button {
            font-size: 30px !important;
        }

        #contact h3 {
            border-left: 3px solid #1C2931;
            padding-left: 10px;
            font-weight: 600;
            display: block;
        }

        #smallscreen {
            display: none;
        }

        @media screen and (max-height: 820px) {
            #smallscreen {
                display: block;
                margin: 10px;
            }
        }

        #contact h6 {
            display: inline-block;
            margin-right: 50%;
        }

        footer h6 {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div id="home">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">

                <?php foreach ($cars as $car) : ?>

                    <div class="carousel-item <?php if ($car['Car_id'] == 0) : ?>
                            <?php echo 'active' ?>
                        <?php endif ?>">
                        <?php echo '<img class="d-block w-100" style="max-width: 100%; height: auto;" src="data:image/jpeg;base64,' . base64_encode($car['Car_photo']) . '">  </img>'; ?>
                        <div class="carousel-caption d-none d-md-block">
                            <h1 class="mb-5 font-weight-bold brand">MOTO<span class="text-danger">RO</span></h1>
                            <h2 class="mb-5 font-weight-bold"><span class="text-danger">|</span> FIND YOUR DREAM CAR <span class="text-danger">|</span></h2>
                            <h1 class="mb-5 font-weight-bold text-danger">
                                <?php echo implode(" ", explode("_", $car['Car_model'])) ?>
                            </h1>
                            <h3 class="mb-5 font-weight-bold">MODEL <span class="text-danger"><?php echo $car['Car_Year'] ?></span> </h3>
                            <button data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-outline-danger mb-5 join">Join Us</button>
                        </div>
                    </div>

                    <?php if ($car['Car_id'] == 2) : ?>

                        <?php break; ?>
                    <?php endif ?>

                <?php endforeach ?>


                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">LogIn</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="login.php">
                                    <div id="warn" class="alert alert-danger" style="display: none;"></div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" name="em" class="form-control" id="exampleInputuser1" aria-describedby="userHelp" placeholder="Enter Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
                                    </div>
                                    <div>
                                        <button type="submit" id="login" class="btn btn-primary">Log In</button>
                                    </div>
                                </form>


                            </div>
                            <div class="modal-footer">
                                <h6 style="margin: auto;">Not having account: <a href="" data-dismiss="modal" data-toggle="modal" data-target="#1">Register Now</a></h6>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Sign Up</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="signup.php" enctype="multipart/form-data">
                                <div id="warn" class="alert alert-danger" style="display: none;"></div>
                                <div class="form-group">
                                    <label for="exampleInputUsername">Username</label>
                                    <input type="Username" name="Username" class="form-control" id="exampleInputusername" aria-describedby="userHelp" placeholder="Enter username">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputuser1" aria-describedby="userHelp" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputphone1">Phone Number</label>
                                    <input type="phone" name="phone" class="form-control" id="exampleInputphone1" placeholder="Enter Phone Number">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputlocation1">Location</label>
                                    <input type="location" name="location" class="form-control" id="exampleInputlocation1" placeholder="Enter Location Number">
                                </div>
                                <div class="form-group">
                                    <label for="userphoto">User Photo</label>
                                    <input type="file" type="image/*" class="form-control-file" id="userphoto" name="userphoto">
                                </div>
                                <div>
                                    <button type="submit" id="signup" class="btn btn-primary">Sign Up</button>
                                </div>
                            </form>


                        </div>
                        <div class="modal-footer">
                            <h6 style="margin: auto;">Already Have Account: <a href="" data-toggle="modal" data-target="#exampleModalCenter" data-dismiss="modal">Sign In</a></h6>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="container text-center" id="smallscreen">
        <h1 class="font-weight-bolder">MOTO<span class="text-danger">RO</span></h1>
        <button data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-outline-danger join">Join Us</button>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../../website4/app.js"></script>
    <script src="../main/redirect.js"></script>
</body>

</html>