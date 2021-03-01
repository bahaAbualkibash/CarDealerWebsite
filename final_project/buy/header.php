<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <title>Document</title>
    <link rel="stylesheet" href="main.css">

</head>

<header>
    <?php if (isset($_GET['x']) && base64_decode($_SESSION['something']) != base64_decode($_SESSION['something'])) : ?>
        <?php echo "<div class='alert alert-danger text-danger font-weight-bold'>" . $_GET['x'] . "</div>" ?>
    <?php endif ?>
    <div class="flex-container">
        <div class="item header">
            <div class=" flex-container">
                <h1><i class="fab fa-gripfire"></i>Motoro</h1>
                <div class=" flex-container-1 form-inline ">
                    <input id="searchinput" class="form-control" placeholder="Search" type="text">
                    <button class="btn btn-danger" id="searchbtn">Search</button>
                </div>
            </div>

        </div>
    </div>
</header>