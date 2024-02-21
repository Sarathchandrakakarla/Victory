<?php
include '../../link.php';
session_start();
if (!$_SESSION['Admin_Id_No']) {
    echo "<script>
  alert('Admin Id Not Rendered');
  location.replace('../admin_login.php');
  </script>
  </script>";
}
error_reporting(0);
?>
<?php

if (!$_SESSION['Type']) {
    echo "<script>alert('Fee Type Not Rendered!');
    location.replace('actual_fee.php');
    </script>";
} else {
    $type = $_SESSION['Type'];
    if ($type == "Vehicle Fee") {
        $route = $_SESSION['Route'];
        $query1 = mysqli_query($link, "SELECT * FROM `actual_fee` WHERE Type = '$type' AND Route = '$route'");
        if (mysqli_num_rows($query1) == 0) {
            echo "<script>alert('Data Not Available!!')</script>";
        } else {
            while ($row1 = mysqli_fetch_assoc($query1)) {
                $fee = $row1['Fee'];
            }
        }
    } else {
        $class = $_SESSION['Class'];
        $query1 = mysqli_query($link, "SELECT * FROM `actual_fee` WHERE Type = '$type' AND Class = '$class'");
        if (mysqli_num_rows($query1) == 0) {
            echo "<script>console.log('" . $type . " " . $class . "')</script>";
            echo "<script>alert('Data Not Available!!')</script>";
        } else {
            while ($row1 = mysqli_fetch_assoc($query1)) {
                $fee = $row1['Fee'];
            }
        }
    }
}

?>
<?php

if (isset($_POST['update'])) {
    if ($_POST['Fee_Type']) {
        $type = $_POST['Fee_Type'];
        if ($type == "Vehicle_Fee") {
            if ($_POST['Route']) {
                $route = $_POST['Route'];
                if ($_POST['Fee']) {
                    $fee = $_POST['Fee'];
                    $query2 = mysqli_query($link, "UPDATE `actual_fee` SET Fee = $fee WHERE Route = '$route' AND Type = '$type'");
                    if ($query2) {
                        echo "<script>alert('Fee Updated Successfully!')</script>";
                    } else {
                        echo "<script>alert('Fee Insertion Failed due to SQL Error')</script>";
                    }
                } else {
                    echo "<script>alert('Please Enter Fee!')</script>";
                }
            } else {
                echo "<script>alert('Please Select Route!')</script>";
            }
        } else {
            if ($_POST['Class']) {
                $class = $_POST['Class'];
                if ($_POST['Fee']) {
                    $fee = $_POST['Fee'];
                    $query2 = mysqli_query($link, "UPDATE `actual_fee` SET Fee = $fee WHERE Class = '$class' AND Type = '$type'");
                    if ($query2) {
                        echo "<script>alert('Fee Updated Successfully!')</script>";
                    } else {
                        echo "<script>alert('Fee Insertion Failed due to SQL Error')</script>";
                    }
                } else {
                    echo "<script>alert('Please Enter Fee!')</script>";
                }
            } else {
                echo "<script>alert('Please Select Class!')</script>";
            }
        }
    } else {
        echo "<script>alert('Please Select Fee Type!')</script>";
    }
}
if (isset($_POST['delete'])) {
    if ($_POST['Fee_Type']) {
        $type = $_POST['Fee_Type'];
        if ($type == "Vehicle_Fee") {
            if ($_POST['Route']) {
                $route = $_POST['Route'];
                $query2 = mysqli_query($link, "DELETE FROM `actual_fee` WHERE Route = '$route' AND Type = '$type'");
                if ($query2) {
                    echo "<script>alert('Fee Deleted Successfully!')</script>";
                } else {
                    echo "<script>alert('Fee Deletion Failed due to SQL Error')</script>";
                }
            } else {
                echo "<script>alert('Please Select Route!')</script>";
            }
        } else {
            if ($_POST['Class']) {
                $class = $_POST['Class'];
                echo "<script>if(!confirm('Confirm to Delete Actual Fee?')){location.replace('');}</script>";
                $query2 = mysqli_query($link, "DELETE FROM `actual_fee` WHERE Class = '$class' AND Type = '$type'");
                if ($query2) {
                    echo "<script>alert('Fee Deleted Successfully!');location.replace('actual_fee.php');</script>";
                } else {
                    echo "<script>alert('Fee Deletion Failed due to SQL Error')</script>";
                }
            } else {
                echo "<script>alert('Please Select Class!')</script>";
            }
        }
    } else {
        echo "<script>alert('Please Select Fee Type!')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title>Victory Schools</title>
    <link rel="shortcut icon" href="../../Images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/sidebar-style.css" />
    <link rel="stylesheet" href="../../css/style.css">
    <!-- Boxiocns CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap Links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<style>
    body {
        background: #E4E9F7;
    }

    .container {
        max-width: 550px;
    }

    .wrapper {
        height: 500px;
    }

    .button1 {
        margin-top: 10px;
    }

    #sign-out {
        display: none;
    }

    #fee {
        padding-left: 10px;
    }

    @media screen and (max-width:920px) {
        #sign-out {
            display: block;
        }
    }

    @media screen and (max-width:700px) {
        .container {
            margin-left: 70px;
            max-width: 340px;
        }
    }
</style>

<body>
    <?php
    include '../sidebar.php';
    ?>
    <div class="container">
        <div class="wrapper">
            <div class="title"><span>Find/Update Actual Fee</span></div>
            <form action="" method="post" autocomplete="off">
                <div class="row">
                    <div class="col-lg-3">
                        <label for="Fee_type"><b>Fee Type:</b></label>
                    </div>
                    <div class="col-lg-9">
                        <select name="Fee_Type" class="form-select" id="type">
                            <option value="selectfeetype" selected disabled>-- Select Fee Type --</option>
                            <option value="School Fee">School Fee</option>
                            <option value="Examination Fee">Examination Fee</option>
                            <option value="Computer Fee">Computer Fee</option>
                            <option value="Admission Fee">Admission Fee</option>
                            <option value="Vehicle Fee">Vehicle Fee</option>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="p-2 col-lg-3 rounded">
                        <label for="Route"><b>Class:</b></label>
                    </div>
                    <div class="p-2 col-lg-6 rounded">
                        <select class="form-select" name="Class" id="class" aria-label="Default select example">
                            <option selected disabled>-- Select Class --</option>
                            <option value="PreKG">PreKG</option>
                            <option value="UKG">LKG</option>
                            <option value="LKG">UKG</option>
                            <?php
                            for ($i = 1; $i <= 10; $i++) {
                                echo "<option value='" . $i . " CLASS'>" . $i . " CLASS</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="p-2 col-lg-3 rounded">
                        <label for="Route"><b>Route:</b></label>
                    </div>
                    <div class="p-2 col-lg-6 rounded">
                        <select class="form-select" name="Route" id="route" aria-label="Default select example">
                            <option selected disabled>-- Select Route --</option>
                            <?php
                            $sql = mysqli_query($link, "SELECT * FROM `van_route`");
                            while ($row = mysqli_fetch_assoc($sql)) {
                                echo "<option value=" . $row['Van_Route'] . ">" . $row['Van_Route'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-top: 30px;">
                    <div class="col-lg-4 text-center">
                        <label for="password_head" id="password_head"><b>Fee:</b></label>
                    </div>
                    <div class="col-lg-4">
                        <input type="number" id="fee" name="Fee" value="<?php if (isset($fee)) {
                                                                            echo (int)$fee;
                                                                        } ?>">
                    </div>
                </div>
                <div class="row button">
                    <input type="submit" class="button1" name="update" value="Update">
                    <input type="submit" class="button1" name="delete" value="Delete">
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->

    <script type="text/javascript">
        $(document).ready(function() {
            stuclass = '<?php if ($_SESSION['Class']) {
                            echo $_SESSION['Class'];
                        } ?>';
            route = '<?php if ($_SESSION['Route']) {
                            echo $_SESSION['Route'];
                        } ?>';
            type = '<?php if ($_SESSION['Type']) {
                        echo $_SESSION['Type'];
                    } ?>';
            route_row = document.getElementById('route');
            class_row = document.getElementById('class');
            $('#type').find('option[value="' + type + '"]').attr('selected', 'selected');
            if (route == '') {
                $('#class').find('option[value="' + stuclass + '"]').attr('selected', 'selected');
                route_row.disabled = 'disabled';
                class_row.disabled = '';
            } else if (stuclass == '') {
                $('#route').find('option[value="' + route + '"]').attr('selected', 'selected');
                class_row.disabled = 'disabled';
                route_row.disabled = '';
            }

        });
    </script>

    <!-- Show/Hide Route -->
    <script type="text/javascript">
        $('#fee_type').on('change', function() {
            type = document.getElementById('fee_type').value;
            cls = document.getElementById('cls_row');
            route = document.getElementById('route_row');
            if (type == "Vehicle_Fee") {
                cls.hidden = 'hidden';
                route.hidden = '';
            } else {
                cls.hidden = '';
                route.hidden = 'hidden';
            }
        });
    </script>
</body>

</html>