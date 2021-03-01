<?php
$conn = mysqli_connect('localhost', 'root', '123456', 'cars');
if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}
