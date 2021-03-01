<?php
$query2 = mysqli_query($conn, "SELECT * FROM  `users` where `user_email`='" . $_SESSION['something'] . "'");
$user = mysqli_fetch_all($query2, MYSQLI_ASSOC);
?>
<div class="item ">
    <?php echo '<img id="userimage"  src="data:image/jpeg;base64,' . base64_encode($user[0]['user_photo']) . '"></img>'; ?>

    <h3><?php echo $user[0]['username'] ?></h3>
    <div>
        <i class="fas fa-envelope"> <span> <?php echo $user[0]['user_email'] ?></span></i>
    </div>
    <div>
        <i class="fas fa-location-arrow"> <span><?php echo $user[0]['user_location'] ?></span></i>
    </div>
    <div>
        <i class="fas fa-phone"> <span>0<?php echo $user[0]['user_phone'] ?></span></i>
    </div>
    <div>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mt-4" data-toggle="modal" data-target="#amount">My Balance</button>
    <div class="modal fade" id="amount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLongTitle">My Balance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <i class="fas fa-2x fa-money-bill-alt "> <span>$<?php echo $user[0]['Balance'] ?></span></i>
                    </div>
                    <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#transfare" data-dismiss="modal">Transfare Money</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter" data-dismiss="modal">Add Money</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Money</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="addBalance.php">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Enter Visa Number</label>
                            <input maxlength="14" type="text" name="visa" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Visa Number">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Enter Amount</label>
                            <input type="number" name="amount" class="form-control" id="exampleInputPassword1" placeholder="Minimum 100$">
                        </div>
                        <textarea name="path" id="path" hidden><?php echo $_SERVER['PHP_SELF'] ?></textarea>
                        <button type="submit" class="btn btn-success">Add Now</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="transfare" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Money</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="transfare.php">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Enter User Transfare Email</label>
                            <input type="text" name="transfareemail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="User Email To Transfare">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Enter Amount</label>
                            <input type="number" name="amount" class="form-control" id="exampleInputPassword1" placeholder="Minimum 100$">
                        </div>
                        <textarea name="path" id="path" hidden><?php echo $_SERVER['PHP_SELF'] ?></textarea>
                        <button type="submit" class="btn btn-success">Transfare Now</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <form action="exit.php" method="POST">
        <button class="btn btn-danger mt-5" id="logoutbtn">Logout</button>
    </form>
    <?php if ($user[0]['isAdmin'] == 1) : ?>
        <?php if ($_SERVER['REQUEST_URI'] == "/final_project/buy/admin.php?") : ?>

            <form action="users.php">
                <button class="btn btn-success btn-block mt-5" id="usersbtn">Users</button>
            </form>
        <?php endif ?>

        <?php if ($_SERVER['REQUEST_URI'] == "/final_project/buy/users.php?") : ?>
            <form action="admin.php">
                <button class="btn btn-success btn-block mt-5" id="usersbtn">Edit Cars</button>
            </form>
        <?php endif ?>
    <?php endif ?>

</div>