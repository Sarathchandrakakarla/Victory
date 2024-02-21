<?php
include '../link.php';
$classes = array('PreKG', 'LKG', 'UKG');
$i = 1;
while ($i <= 10) {
    array_push($classes, $i . ' CLASS');
    $i++;
}
$master_ids = array();
$fee_master_ids = array();
foreach ($classes as $class) {
    $query1 = mysqli_query($link, "SELECT * FROM `student_master_data` WHERE Stu_Class = '$class'");
    $temp = array();
    while ($row1 = mysqli_fetch_assoc($query1)) {
        array_push($temp, $row1['Id_No']);
    }
    $master_ids[$class] = $temp;
    $query2 = mysqli_query($link, "SELECT * FROM `stu_fee_master_data` WHERE Class = '$class' AND Type = 'School Fee'");
    $temp = array();
    while ($row2 = mysqli_fetch_assoc($query2)) {
        array_push($temp, $row2['Id_No']);
    }
    $fee_master_ids[$class] = $temp;
    echo $class . ': ';
    echo "In Fee Master Data but not Student Master Data <br>";
    $count = 0;
    foreach ($fee_master_ids[$class] as $id) {
        if (!in_array($id, $master_ids[$class])) {
            echo $id . ',';
            $count++;
        }
    }
    echo $count . '<br>';
    $count = 0;
    echo $class . ': ';
    echo "In Student Master Data but not Fee Master Data<br>";
    foreach ($master_ids[$class] as $id) {
        if (!in_array($id, $fee_master_ids[$class])) {
            echo $id . ',';
            $count++;
        }
    }
    echo $count.'<br><br>';
}
