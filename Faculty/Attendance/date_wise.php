<?php
include '../../link.php';
session_start();
if (!$_SESSION['Id_No']) {
    echo "<script>
  alert('Faculty Id Not Rendered');
  location.replace('faculty_login.php');
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
        overflow-x: scroll;
    }

    .table-container {
        margin-top: 30px;
        margin-left: 150px;
        max-width: 1300px;
        max-height: 500px;
        overflow-x: scroll;
    }

    #section {
        text-align: center;
    }

    @media screen and (max-width:576px) {
        .container {
            width: 80%;
            margin-left: 20%;
            overflow-x: scroll;
        }
    }

    @media print {
        * {
            display: none;
        }

        #table-container {
            display: block;
        }
    }

    #sign-out {
        display: none;
    }

    @media screen and (max-width:920px) {
        #sign-out {
            display: block;
        }
    }
</style>

<body class="bg-light">
    <?php
    include '../sidebar.php';
    ?>
    <div class="container">
        <form action="" method="post">
            <div class="row justify-content-center mt-5">
                <div class="col-lg-1">
                    <label for=""><b>Date:</b></label>
                </div>
                <div class="col-lg-4">
                    <input type="date" class="form-control" value="<?php if (isset($date)) {
                                                                        echo $date;
                                                                    } else {
                                                                        echo date('Y-m-d');
                                                                    } ?>" name="Date" id="date" required>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-lg-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="att_type" id="am" checked value="AM">
                        <label class="form-check-label" for="am">Morning</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="att_type" id="pm" value="PM">
                        <label class="form-check-label" for="pm">Evening</label>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-3">
                    <label for=""><b>Total Absentees:</b> <span id="total"></span> </label>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-3">
                        <button class="btn btn-primary" type="submit" name="show">Show</button>
                        <button class="btn btn-warning" type="reset" onclick="hideTable();document.getElementById('total').innerHTML = '';">Clear</button>
                        <button class="btn btn-success" onclick="printDiv();return false;">Print</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-lg-5" style="color: red;">
                NOTE: 1. Please Give Margin: Minimum in Page Setup
            </div>
        </div>
    </div>
    <div class="container table-container" id="table-container">
        <table class="table table-striped">
            <thead class="bg-secondary text-white">
                <th style="border:1px solid black;">S.No</th>
                <th style="border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;text-align:center;">Id No.</th>
                <th style="border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;text-align:center;">Name</th>
                <th style="border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;text-align:center;">Class</th>
                <th style="border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;text-align:center;">Father Name</th>
                <th style="border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;text-align:center;">Van Route</th>
                <th style="border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;text-align:center;">Mobile</th>
            </thead>
            <tbody id="tbody">
                <tr>
                    <?php
                    function format_date($date)
                    {
                        $arr = explode('-', $date);
                        $t = $arr[0];
                        $arr[0] = $arr[2];
                        $arr[2] = $t;
                        $date = implode('-', $arr);
                        return $date;
                    }
                    if (isset($_POST['show'])) {
                        $date = $_POST['Date'];
                        $type = $_POST['att_type'];
                        echo "<script>document.getElementById('date').value = '" . $date . "';
              document.getElementById('" . strtolower($type) . "').checked = true;
              document.getElementById('" . strtolower($stu_type) . "').checked = true;
              </script>";
                        $date = format_date($date);

                        //Arrays
                        $ids = array();
                        $names = array();

                        //Queries
                        $query1 = mysqli_query($link, "SELECT Id_No FROM `van_attendance_daily` WHERE Date = '$date' AND $type = 'A'");

                        if ($query1) {
                            if (mysqli_num_rows($query1) == 0) {
                                echo "<script>alert('No Student Found on " . $date . " " . $type . " of Absent!!')</script>";
                            } else {
                                while ($row1 = mysqli_fetch_assoc($query1)) {
                                    array_push($ids, $row1['Id_No']);
                                }
                                $i = 1;
                                foreach ($ids as $id) {
                                    $query2 = mysqli_query($link, "SELECT First_Name,Father_Name,Stu_Class,Stu_Section,Mobile,House_No,Van_Route FROM `student_master_data` WHERE Id_No = '$id'");
                                    while ($row2 = mysqli_fetch_assoc($query2)) {
                                        echo '
                                            <td style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;text-align:center;">' . $i . '</td>
                                            <td style="border-right:1px solid black;border-bottom:1px solid black;">' . $id . '</td>
                                            <td style="border-right:1px solid black;border-bottom:1px solid black;">' . $row2['First_Name'] . '</td>
                                            <td style="width:150px;border-right:1px solid black;border-bottom:1px solid black;">' . $row2['Stu_Class'] . ' ' . $row2['Stu_Section'] . '</td>
                                            <td style="border-right:1px solid black;border-bottom:1px solid black;">' . $row2['Father_Name'] . '</td>
                                            <td style="border-right:1px solid black;border-bottom:1px solid black;">' . $row2['Van_Route'] . '</td>
                                            <td style="border-right:1px solid black;border-bottom:1px solid black;">' . $row2['Mobile'] . '</td>
                                            ';
                                    }
                                    $i++;
                                    echo '</tr>';
                                }
                                echo "<script>document.getElementById('total').innerHTML = '" . ($i - 1) . "'</script>";
                            }
                        } else {
                            echo "<script>alert('Error in Fetching Id Nos!')</script>";
                        }
                    }

                    ?>
            </tbody>
        </table>
    </div>
    <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>

    <!-- Print Table -->
    <script type="text/javascript">
        function printDiv() {
            window.frames["print_frame"].document.body.innerHTML = "<h2 style='text-align:center;'>VICTORY HIGH SCHOOL</h2>";
            window.frames["print_frame"].document.body.innerHTML += "<h2 style='text-align:center;'>Absentees List</h2>";
            window.frames["print_frame"].document.body.innerHTML += "<p style='font-size:20px;'><b>Date: </b> <?php echo $date . '   ' . $type; ?></p>";
            window.frames["print_frame"].document.body.innerHTML += document.querySelector('#table-container').innerHTML;
            window.frames["print_frame"].window.focus();
            window.frames["print_frame"].window.print();
        }
    </script>
</body>

</html>