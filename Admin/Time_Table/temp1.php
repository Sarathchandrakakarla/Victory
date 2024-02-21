<?php
include '../../link.php';
if (isset($_POST['Class']) && isset($_POST['Section']) && isset($_POST['Period']) && isset($_POST['Faculty'])) {
    $class = $_POST['Class'];
    $section = $_POST['Section'];
    $period = $_POST['Period'];
    $faculty = $_POST['Faculty'];

    $insert_sql = mysqli_query($link, "INSERT INTO `time_table_temp` VALUES('','$class','$section','$period','$faculty')");
    if ($insert_sql) {
        echo "success";
    } else {
        echo "failure";
    }
}
