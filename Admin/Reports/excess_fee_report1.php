<?php
include_once('../../link.php');
session_start();
if (!$_SESSION['Admin_Id_No']) {
    echo "<script>alert('Admin Id Not Rendered');
    location.replace('../admin_login.php');</script>";
}
error_reporting(0);
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
<style>
    body {
        overflow-x: scroll;
    }

    .table-container {
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
    <form action="" method="POST">
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="report_type" id="excess" checked value="Excess">
                        <label class="form-check-label" for="excess">Excess</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="report_type" id="not_paid" value="Not_Paid">
                        <label class="form-check-label" for="not_paid">Not Paid</label>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-lg-4">
                    <select name="Type" id="type" class="form-control" required>
                        <option value="" selected disabled>-- Select Fee Type --</option>
                        <option value="School Fee">School Fee</option>
                        <option value="Vehicle Fee">Vehicle Fee</option>
                        <option value="Book Fee">Book Fee</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-4">
                    <button class="btn btn-primary" type="submit" name="show">Show</button>
                    <button class="btn btn-warning" type="reset" onclick="hideTable()">Clear</button>
                    <button class="btn btn-success" onclick="printDiv();return false;">Print</button>
                    <button class="btn btn-success" onclick="return false;" id="export">Export To Excel</button>
                </div>
            </div>
        </div>
    </form>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-7">
                <h3><b>Excess Fee Balance Student Details Report</b></h3>
            </div>
        </div>
    </div>
    <div class="container table-container" id="table-container">
        <table hidden>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-size:30px;" colspan="4">VICTORY HIGH SCHOOL</td>
            </tr>
        </table>
        <table class="table table-striped table-hover" border="1">
            <thead class="bg-secondary text-light">
                <tr id="headings">
                    <th style="padding:5px;">S.No</th>
                    <th style="padding:5px;">Id No.</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Committed Fee</th>
                    <th>Last Year Balance</th>
                    <th>Total</th>
                    <th>Mobile Number</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr>
                    <?php
                    if (isset($_POST['show'])) {
                        $report_type = $_POST['report_type'];
                        echo "<script>" . strtolower($report_type) . ".checked = true;</script>";
                        $type = $_POST['Type'];
                        echo "<script>type.value='" . $type . "';</script>";
                        $actuals = [];
                        $ids = [];
                        $fees = [];
                        if ($type != "Vehicle Fee") {
                            $classes = ['PreKG', 'LKG', 'UKG'];
                            for ($i = 1; $i <= 10; $i++) {
                                $classes[] = $i . " CLASS";
                            }
                            foreach ($classes as $class) {
                                $query1 = mysqli_query($link, "SELECT * FROM actual_fee WHERE Class = '$class' AND Type = '$type'");
                                while ($row1 = mysqli_fetch_array($query1)) {
                                    $actuals[$class] = $row1['Fee'];
                                }
                                $query2 = mysqli_query($link, "SELECT Id_No FROM student_master_data WHERE Stu_Class = '$class'");
                                while ($row2 = mysqli_fetch_array($query2)) {
                                    $ids[] = $row2['Id_No'];
                                }
                            }
                        } else {
                            $routes = [];
                            $query1 = mysqli_query($link, "SELECT * FROM van_route");
                            while ($row1 = mysqli_fetch_array($query1)) {
                                $routes[] = $row1['Van_Route'];
                            }
                            foreach ($routes as $route) {
                                $actual_query = mysqli_query($link, "SELECT * FROM actual_fee WHERE Route = '$route' AND Type = 'Vehicle Fee'");
                                while ($actual_row = mysqli_fetch_array($actual_query)) {
                                    $actuals[$route] = $actual_row['Fee'];
                                }
                                $query2 = mysqli_query($link, "SELECT * FROM `student_master_data` WHERE Van_Route = '$route' AND ((Stu_Class LIKE '%CLASS%') OR (Stu_Class LIKE '%KG')) ORDER BY Id_No");
                                while ($row2 = mysqli_fetch_assoc($query2)) {
                                    $ids[] = $row2['Id_No'];
                                }
                            }
                        }
                        foreach ($ids as $id) {
                            $query3 = mysqli_query($link, "SELECT * FROM student_master_data WHERE Id_No = '$id'");
                            while ($row3 = mysqli_fetch_assoc($query3)) {
                                $query4 = mysqli_query($link, "SELECT * FROM stu_fee_master_data WHERE Id_No = '" . $row3['Id_No'] . "' AND Type = '" . $type . "'");
                                if (mysqli_num_rows($query4) == 0 && $type != "Book Fee") {
                                    echo "<script>alert('" . $row3['Id_No'] . " Not Found in fee master data for this Fee Type!');</script>";
                                } else {
                                    $query5 = mysqli_query($link, "SELECT * FROM stu_paid_fee WHERE Id_No = '" . $row3['Id_No'] . "' AND Type = '" . $type . "'");
                                    $paid = 0;
                                    while ($row5 = mysqli_fetch_assoc($query5)) {
                                        $paid += (int)$row5['Fee'];
                                    }
                                    while ($row4 = mysqli_fetch_array($query4)) {
                                        $tot_bal = (int)$row4['Current_Balance'] + (int)$row4['Last_Balance'] - $paid;
                                        if ($type != "Vehicle Fee") {
                                            $actual = (int)$actuals[$row3['Stu_Class']];
                                        } else {
                                            $actual = (int)$actuals[$row3['Van_Route']];
                                        }
                                        if ($tot_bal > $actual && (int)$row4['Last_Balance'] != 0) {
                                            $fees[$row3['Id_No']] = ["Name" => $row3['First_Name'], "Class" => $row3['Stu_Class'] . " " . $row3['Stu_Section'], "Committed" => $row4['Current_Balance'], "Previous" => $row4['Last_Balance'], "Total" => (int)$row4['Current_Balance'] + (int)$row4['Last_Balance'], "Mobile" => $row3['Mobile']];
                                            if ($type != "Vehicle Fee") {
                                                $fees[$row3['Id_No']]["Excess"] = $tot_bal - (int)$actuals[$row3['Stu_Class']];
                                            } else {
                                                $fees[$row3['Id_No']]["Excess"] = $tot_bal - (int)$actuals[$row3['Van_Route']];
                                                $fees[$row3['Id_No']]["Route"] = $row3['Van_Route'];
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if ($type == "Vehicle Fee") {
                            echo '
                            <script>$("#headings").append("<th>Route</th>")</script>
                            ';
                        }
                        $i = 1;
                        foreach ($fees as $id => $details) {
                            echo '
                            <tr>
                                <td>' . $i . '</td>
                                <td>' . $id . '</td>
                                <td>' . $details['Name'] . '</td>
                                <td>' . $details['Class'] . '</td>
                                <td>' . $details['Committed'] . '</td>
                                <td>' . $details['Previous'] . '</td>
                                <td>' . $details['Total'] . '</td>
                                <td>' . $details['Mobile'] . '</td>';
                            if ($type == "Vehicle Fee") {
                                echo '
                                <td>' . $details['Route'] . '</td>
                                ';
                            }
                            echo '</tr>
                            ';
                            $i++;
                        }
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
    <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>


    <!-- Scripts -->

    <!-- Export Table to Excel -->
    <script type="text/javascript">
        $('#export').on('click', function() {
            stuclass = '<?php echo $class; ?>';
            stusection = '<?php echo $section; ?>';
            filename = stuclass + stusection;
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById('table-container');
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
            // Specify file name
            filename = filename ? filename + '.xls' : 'excel_data.xls';

            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
        });
    </script>

    <!-- Print Table -->
    <script type="text/javascript">
        function printDiv() {
            window.frames["print_frame"].document.body.innerHTML = "<h2 style='text-align:center;'>VICTORY HIGH SCHOOL</h2>";
            window.frames["print_frame"].document.body.innerHTML += "<p style='font-size:20px;'><b>Class: </b> <?php if ($class == '' && $section == '') {
                                                                                                                    echo 'All Classes';
                                                                                                                } else {
                                                                                                                    echo $class . ' ' . $section;
                                                                                                                } ?></p>";
            window.frames["print_frame"].document.body.innerHTML += document.querySelector('.table-container').innerHTML;
            window.frames["print_frame"].window.focus();
            window.frames["print_frame"].window.print();
        }
    </script>
</body>

</html>