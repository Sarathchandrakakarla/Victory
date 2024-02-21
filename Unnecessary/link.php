<?php
$link = mysqli_connect("localhost", "root", "", "vtest");
if($link === false){
    echo "could not Connect";
    //die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>