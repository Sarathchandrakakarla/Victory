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
        height: 450px;
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
            <div class="title"><span>Actual Fee Entry</span></div>
            <form action="" method="post" autocomplete="off">
                <div class="row">
                    <div class="col-lg-3">
                        <label for="Fee_type"><b>Fee Type:</b></label>
                    </div>
                    <div class="col-lg-9">
                        <select name="Fee_Type" class="form-select" id="fee_type">
                            <option value="selectfeetype" selected disabled>-- Select Fee Type --</option>
                            <option value="School Fee">School Fee</option>
                            <option value="Examination Fee">Examination Fee</option>
                            <option value="Computer Fee">Computer Fee</option>
                            <option value="Admission Fee">Admission Fee</option>
                            <option value="Vehicle Fee">Vehicle Fee</option>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center" id="cls_row" hidden>
                    <div class="p-2 col-lg-3 rounded">
                        <label for="Route"><b>Class:</b></label>
                    </div>
                    <div class="p-2 col-lg-6 rounded">
                        <select class="form-select" name="Class" id="class" aria-label="Default select example">
                            <option selected disabled>-- Select Class --</option>
                            <option value="PreKG" <?php if (isset($class)) {
                                                        if ($class == "PreKG") {
                                                            echo 'selected="selected"';
                                                        } else {
                                                            echo 'selected=""';
                                                        }
                                                    } ?>>PreKG</option>
                            <option value="LKG" <?php if (isset($class)) {
                                                    if ($class == "LKG") {
                                                        echo 'selected="selected"';
                                                    } else {
                                                        echo 'selected=""';
                                                    }
                                                } ?>>LKG</option>
                            <option value="UKG" <?php if (isset($class)) {
                                                    if ($class == "UKG") {
                                                        echo 'selected="selected"';
                                                    } else {
                                                        echo 'selected=""';
                                                    }
                                                } ?>>UKG</option>
                            <?php
                            for ($i = 1; $i <= 10; $i++) {
                                echo "<option value='" . $i . " CLASS'";
                                if (isset($classs)) {
                                    if ($class == $i . ' CLASS') {
                                        echo "selected='selected'";
                                    } else {
                                        echo 'selected=""';
                                    }
                                }
                                echo ">" . $i . " CLASS</option>";
                            }

                            ?>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center" id="route_row" hidden>
                    <div class="p-2 col-lg-3 rounded">
                        <label for="Route"><b>Route:</b></label>
                    </div>
                    <div class="p-2 col-lg-6 rounded">
                        <select class="form-select" name="Route" id="route" aria-label="Default select example">
                            <option selected disabled>-- Select Route --</option>
                            <?php
                            $sql = mysqli_query($link, "SELECT * FROM `van_route`");
                            while ($row = mysqli_fetch_assoc($sql)) {
                                echo "<option value='" . $row['Van_Route'] . "'>" . $row['Van_Route'] . "</option>";
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
                    <input type="submit" class="button1" name="insert" value="Insert">
                    <input type="reset" class="button1" onclick="document.getElementById('cls_row').hidden='hidden';document.getElementById('route_row').hidden='hidden';" value="Clear">
                    <input type="submit" class="button1" name="find" value="Find">
                </div>
            </form>
        </div>
    </div>

    <?php

    if (isset($_POST['insert'])) {
        if ($_POST['Fee_Type']) {
            $type = $_POST['Fee_Type'];
            echo "<script>document.getElementById('fee_type').value = '" . $type . "'</script>";
            if ($type == "Vehicle Fee") {
                echo "<script>document.getElementById('cls_row').hidden = 'hidden';
            document.getElementById('route_row').hidden = '';</script>";
                if ($_POST['Route']) {
                    $route = $_POST['Route'];
                    echo "<script>document.getElementById('route').value = '" . $route . "'</script>";
                    if ($_POST['Fee']) {
                        $fee = $_POST['Fee'];
                        echo "<script>document.getElementById('fee').value = '" . $fee . "'</script>";
                        $query1 = mysqli_query($link, "SELECT * FROM `actual_fee` WHERE Route = '$route' AND Type = '$type'");
                        if (mysqli_num_rows($query1) > 0) {
                            echo "<script>alert('Data Already Exists!')</script>";
                        } else {
                            $query2 = mysqli_query($link, "INSERT INTO `actual_fee`(Type,Route,Fee) VALUES('$type','$route','$fee')");
                            if ($query2) {
                                echo "<script>alert('Fee Inserted Successfully!')</script>";
                            } else {
                                echo "<script>alert('Fee Insertion Failed due to SQL Error')</script>";
                            }
                        }
                    } else {
                        echo "<script>alert('Please Enter Fee!')</script>";
                    }
                } else {
                    echo "<script>alert('Please Select Route!')</script>";
                }
            } else {
                echo "<script>document.getElementById('cls_row').hidden = '';
            document.getElementById('route_row').hidden = 'hidden';</script>";
                if ($_POST['Class']) {
                    $class = $_POST['Class'];
                    echo "<script>document.getElementById('class').value = '" . $class . "'</script>";
                    if ($_POST['Fee']) {
                        $fee = $_POST['Fee'];
                        echo "<script>document.getElementById('fee').value = '" . $fee . "'</script>";
                        $query1 = mysqli_query($link, "SELECT * FROM `actual_fee` WHERE Class = '$class' AND Type = '$type'");
                        if (mysqli_num_rows($query1) > 0) {
                            echo "<script>alert('Data Already Exists!');</script>";
                        } else {
                            $query2 = mysqli_query($link, "INSERT INTO `actual_fee`(Type,Class,Fee) VALUES('$type','$class','$fee')");
                            if ($query2) {
                                echo "<script>alert('Fee Inserted Successfully!')</script>";
                            } else {
                                echo "<script>alert('Fee Insertion Failed due to SQL Error')</script>";
                            }
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
    } else if (isset($_POST['find'])) {
        if (isset($_POST['Fee_Type'])) {
            $type = $_POST['Fee_Type'];
            echo "<script>document.getElementById('class').value = '" . $type . "'</script>";
            if ($type == "Vehicle Fee") {
                echo "<script>document.getElementById('cls_row').hidden = 'hidden';
            document.getElementById('route_row').hidden = '';</script>";
                if ($_POST['Route']) {
                    $route = $_POST['Route'];
                    echo "<script>document.getElementById('class').value = '" . $route . "'</script>";
                    $_SESSION['Type'] = $type;
                    $_SESSION['Route'] = $route;
                    echo "<script>location.replace('show_fee_page.php')</script>";
                } else {
                    echo "<script>alert('Please Select Route!')</script>";
                }
            } else {
                echo "<script>document.getElementById('cls_row').hidden = '';
            document.getElementById('route_row').hidden = 'hidden';</script>";
                if ($_POST['Class']) {
                    $class = $_POST['Class'];
                    echo "<script>document.getElementById('class').value = '" . $class . "'</script>";
                    $_SESSION['Type'] = $type;
                    $_SESSION['Class'] = $class;
                    echo "<script>location.replace('show_fee_page.php')</script>";
                } else {
                    echo "<script>alert('Please Select Class!')</script>";
                }
            }
        }
    }

    ?>
    <!-- Scripts -->

    <!-- Show/Hide Route -->
    <script type="text/javascript">
        $('#fee_type').on('change', function() {
            type = document.getElementById('fee_type').value;
            cls = document.getElementById('cls_row');
            route = document.getElementById('route_row');
            if (type == "Vehicle Fee") {
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