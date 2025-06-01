<?php
$connection = mysqli_connect("localhost", "root", "", "PwbPraktekP9");

if (!$connection){
    die("Connection failed: " . mysqli_connect_error());
}
?>
