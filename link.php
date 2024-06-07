<?php
$link = mysqli_connect("localhost", "root", "", "vtest");
if ($link === false) {
    echo "<script>alert('Could not Connect to Database!')
    location.replace('index.php')</script>";
    //die("ERROR: Could not connect. " . mysqli_connect_error());
} 