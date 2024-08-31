<?php
include "link.php";
function randomPassword()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 4; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return "VICEM" . implode($pass); //turn the array into a string
}
$query1 = mysqli_query($link, "SELECT * FROM `employee_master_data` WHERE Status = 'Working' ORDER BY Emp_Id");
$i = 1;
while ($row1 = mysqli_fetch_assoc($query1)) {
    /* echo $row1['Emp_Id'] . " ";
    echo $i . "<br/>";
    $i++; */
    $pass = randomPassword();
    $query2 = mysqli_query($link, "INSERT INTO `faculty` VALUES('','" . $row1["Emp_Id"] . "','" . $row1["Emp_First_Name"] . "','" . $pass . "','" . password_hash($pass, PASSWORD_DEFAULT) . "','Faculty')");
}
echo "Done!";
