<?php
include_once('../../link.php');
session_start();
if (!$_SESSION['Admin_Id_No']) {
    echo "<script>alert('Admin Id Not Rendered');
    location.replace('../admin_login.php');</script>";
}
//error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title>Victory Schools</title>
    <link rel="shortcut icon" href="/Victory/Images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/Victory/css/sidebar-style.css" />
    <!-- Boxiocns CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap Links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
    <?php
    include '../sidebar.php';
    ?>
    <div class="container mt-5 me-5">
        <form action="" method="POST">
            <button class="btn btn-primary" name="Add" type="submit">Add</button>
            <?php
            if (isset($_POST['Add'])) {
                $classes = ['PreKG', 'LKG', 'UKG'];
                for ($i = 1; $i <= 10; $i++) {
                    $classes[] = $i . " CLASS";
                }
                $ids = [];
                foreach ($classes as $class) {
                    $query1 = mysqli_query($link, "SELECT * FROM `student_master_data` WHERE `Stu_Class` = '$class'");
                    while ($row1 = mysqli_fetch_assoc($query1)) {
                        $ids[$row1['Id_No']] = [$row1['First_Name'], $row1['Stu_Class'], $row1['Stu_Section'], $row1['Area']];
                    }
                }
                echo "<br/>";
                foreach ($ids as $id => $details) {
                    echo $id . " " . $details[0] . " " . $details[1] . " " . $details[2] . " " . $details[3] . " Book Fee Actual 0 Actual Total NULL";
                    echo "<br/>";
                }

                foreach ($ids as $id => $details) {
                    $query2 = mysqli_query($link, "SELECT * FROM `actual_fee` WHERE Class = '$details[1]' AND Type = 'Book Fee'");
                    while ($row2 = mysqli_fetch_assoc($query2)) {
                        $actual = (int)$row2['Fee'];
                    }
                    $query3 = mysqli_query($link, "INSERT INTO `stu_fee_master_data` VALUES('','$id','$details[0]','$details[1]','$details[2]','$details[3]','Book Fee','$actual','0','$actual','$actual',NULL)");
                }
            }
            ?>
        </form>
    </div>

</body>

</html>