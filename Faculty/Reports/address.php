<?php
include_once('../../link.php');
session_start();
if (!$_SESSION['Id_No']) {
    echo "<script>alert('Faculty Id Not Rendered');
    location.replace('../faculty_login.php');</script>";
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
    <!-- Controlling Cache -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
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
        max-width: 1350px;
        max-height: 500px;
        overflow-x: scroll;
    }

    @media print {
        * {
            display: none;
        }

        #table-container {
            display: block;
        }
    }

    @media screen and (max-width:576px) {
        .container {
            width: 80%;
            margin-left: 20%;
            overflow-x: scroll;
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
<script type="text/javascript">
    function hide() {
        document.getElementById('inp_row').hidden = 'true';
        document.getElementById('route_row').hidden = 'true';
        document.getElementById('add_label').hidden = 'true';
    }
</script>

<body class="bg-light" onload="hide()">
    <?php include '../sidebar.php'; ?>
    <form action="" method="POST">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-lg-6">
                    <h2>Address By</h2>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="add_by" id="class_wise" checked value="Class_Wise">
                        <label class="form-check-label" for="class_wise">Class Wise</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="add_by" id="area_wise" value="Area_Wise">
                        <label class="form-check-label" for="area_wise">Area Wise</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="add_by" id="route_wise" value="Route_Wise">
                        <label class="form-check-label" for="route_wise">Route Wise</label>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-4" id="class_row">
                <div class="p-2 text-light col-lg-4 rounded">
                    <select class="form-select" name="Class" id="class" aria-label="Default select example">
                        <option selected disabled>-- Select Class --</option>
                        <option>PreKG</option>
                        <option>LKG</option>
                        <option>UKG</option>
                        <?php
                        for ($i = 1; $i <= 10; $i++) {
                            echo "<option value='" . $i . " CLASS'>" . $i . " CLASS</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="p-2 text-light col-lg-4 rounded">
                    <select class="form-select" name="Section" id="section" aria-label="Default select example">
                        <option selected disabled>-- Select Section --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <label for="add_by" class="col-sm-2 col-form-label" id="add_label"></label>
                <div class="col-sm-4" id="inp_row">
                    <input type="text" class="form-control" name="txtinp">
                </div>
                <div class="col-sm-4" id="route_row">
                    <select class="form-select" name="Route" aria-label="Default select example">
                        <option selected disabled>-- Select Route --</option>
                        <?php
                        $query = mysqli_query($link, "SELECT Van_Route FROM `van_route`");
                        while ($r = mysqli_fetch_assoc($query)) {
                            echo "<option value='" . $r['Van_Route'] . "'>" . $r['Van_Route'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-lg-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Photo" id="wo_photo" checked value="Without_Photo">
                        <label class="form-check-label" for="inlineRadio2">Without Photo</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Photo" id="w_photo" value="With_Photo">
                        <label class="form-check-label" for="inlineRadio1">With Photo</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-4">
                    <button class="btn btn-primary" type="submit" name="show">Show</button>
                    <button class="btn btn-warning">Clear</button>
                    <button class="btn btn-success" onclick="printDiv();return false;">Print</button>
                    <button class="btn btn-success" onclick="return false;" id="export">Export To Excel</button>
                </div>
            </div>
        </div>
    </form>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-4">
                <h3><b>Address Details Report</b></h3>
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
            <tr>
                <td style="font-size:20px;color:red" id="label"></td>
                <td id="txt_label" style="font-size:20px;"></td>
            </tr>
        </table>
        <table class="table table-striped table-hover" border="1">
            <thead class="bg-secondary text-light">
                <tr style="padding: 5px;">
                    <th>S.No</th>
                    <th>Id No.</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Father Name</th>
                    <th id="class_head">Class</th>
                    <th id="section_head">Section</th>
                    <th>Door No.</th>
                    <th>Area</th>
                    <th id="area_head">Village</th>
                    <th>Mobile No.</th>
                    <th id="route_head">Van Route</th>
                    <th id="img_head" hidden>Stu Image</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    if (isset($_POST['show'])) {
                        $search = $_POST['add_by'];
                        $photo = $_POST['Photo'];
                        if ($photo == 'With_Photo') {
                            echo "<script>document.getElementById('img_head').hidden = '';</script>";
                        } else {
                            echo "<script>document.getElementById('img_head').hidden = 'hidden';</script>";
                        }
                        $flag = false;
                        if ($search == 'Class_Wise') {
                            if ($_POST['Class']) {
                                $class = $_POST['Class'];
                                echo "<script>document.getElementById('class').value = '" . $class . "'</script>";
                                if ($_POST['Section']) {
                                    $section = $_POST['Section'];
                                    echo "<script>document.getElementById('label').innerHTML = 'Class:';
                                document.getElementById('txt_label').innerHTML = '" . $class . $section . "';</script>";
                                    echo "<script>document.getElementById('section').value = '" . $section . "'</script>";
                                    $sql = "SELECT * FROM `student_master_data` WHERE Stu_Class = '$class' AND Stu_Section = '$section'";
                                    $flag = true;
                                } else {
                                    $flag = false;
                                    echo "<script>alert('Please Select Section!')</script>";
                                }
                            } else {
                                $flag = false;
                                echo "<script>alert('Please Select Class!')</script>";
                            }
                        } else if ($search == 'Area_Wise') {
                            if ($_POST['txtinp']) {
                                $txtinp = $_POST['txtinp'];
                                echo "<script>document.getElementById('label').innerHTML = 'Area:';
                                document.getElementById('txt_label').innerHTML = '" . $txtinp . "';</script>";
                                echo "<script>document.getElementById('txtinp').value = '" . $txtinp . "'</script>";
                                $sql = "SELECT * FROM `student_master_data` WHERE Area LIKE '%$txtinp%' AND (Stu_Class LIKE '%CLASS%' OR Stu_Class ='PreKG' OR Stu_Class ='LKG' OR Stu_Class ='UKG')";
                                $flag = true;
                            } else {
                                $flag = false;
                                echo "<script>alert('Please Enter Area!')</script>";
                            }
                        } else if ($search == 'Route_Wise') {
                            if ($_POST['Route']) {
                                $route = $_POST['Route'];
                                echo "<script>document.getElementById('label').innerHTML = 'Route:';
                                document.getElementById('txt_label').innerHTML = '" . $route . "';</script>";
                                echo "<script>document.getElementById('route').value = '" . $route . "'</script>";
                                $sql = "SELECT * FROM `student_master_data` WHERE Van_Route LIKE '%$route%' AND (Stu_Class LIKE '%CLASS%' OR Stu_Class ='PreKG' OR Stu_Class ='LKG' OR Stu_Class ='UKG')";
                                $flag = true;
                            } else {
                                $flag = false;
                                echo "<script>alert('Please Select Route!')</script>";
                            }
                        }
                        if ($flag) {
                            $result = mysqli_query($link, $sql);
                            $i = 1;
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr style="padding: 5px;">
              <td>' . $i . '</td>
              <td>' . $row['Id_No'] . '</td>
              <td style="padding-left: 5px;">' . $row['First_Name'] . '</td>
              <td>' . $row['Sur_Name'] . '</td>
              <td>' . $row['Father_Name'] . '</td>';
                                    if ($search == "Class_Wise") {
                                        echo "<script>document.getElementById('class_head').hidden = 'hidden';
                document.getElementById('section_head').hidden = 'hidden';
                document.getElementById('area_head').hidden = '';
                document.getElementById('route_head').hidden = '';</script>";
                                    } else {
                                        echo '<td>' . $row['Stu_Class'] . '</td>
              <td style="text-align:center">' . $row['Stu_Section'] . '</td>';
                                    }
                                    echo '<td>' . $row['House_No'] . '</td>';
                                    if ($search == "Area_Wise") {
                                        echo "<script>document.getElementById('class_head').hidden = '';
                document.getElementById('section_head').hidden = '';
                document.getElementById('area_head').hidden = 'hidden';
                document.getElementById('route_head').hidden = '';</script>";
                                    } else {
                                        echo '<td>' . $row['Area'] . '</td>';
                                    }
                                    echo '<td>' . $row['Village'] . '</td>
              <td>' . $row['Mobile'] . '</td>';
                                    if ($search == "Route_Wise") {
                                        echo "<script>document.getElementById('class_head').hidden = '';
                document.getElementById('section_head').hidden = '';
                document.getElementById('area_head').hidden = '';
                document.getElementById('route_head').hidden = 'hidden';</script>";
                                    } else {
                                        echo '<td>' . $row['Van_Route'] . '</td>';
                                    }
                                    if ($photo == "With_Photo") {
                                        echo '<td><img src = "../../Images/stu_img/' . $row['Id_No'] . '.jpg" class="rounded" width="100px" height="100px"';
                                    }
                                    echo '</tr>';
                                    $i++;
                                }
                            } else {
                                echo "<script>
                                    alert('No Student Found');
                                    </script>";
                            }
                        }
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
    <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>

    <!-- Scripts -->

    <!-- Print Table -->
    <script type="text/javascript">
        function printDiv() {
            window.frames["print_frame"].document.body.innerHTML = "<div class = 'container'><table style='margin-bottom:20px;'><tr><td style='text-align:center;font-size:35px;'>VICTORY HIGH SCHOOL</td></tr></table></div>";
            window.frames["print_frame"].document.body.innerHTML += "<div class = 'container'><table style='margin-bottom:8px;'><tr><td style='text-align:center;font-size:28px;'>Address Details</td></tr></table></div>";
            window.frames["print_frame"].document.body.innerHTML += "<div class = 'container'><table style='margin-bottom:10px;'><tr><td style='font-size:15px;'><b><?php if ($search == 'Class_Wise') {
                                                                                                                                                                        echo 'Class:';
                                                                                                                                                                    } else if ($search == 'Area_Wise') {
                                                                                                                                                                        echo 'Area:';
                                                                                                                                                                    } else if ($search == 'Route_Wise') {
                                                                                                                                                                        echo 'Route:';
                                                                                                                                                                    } ?></b></td><td style='font-size:15px;'><?php if ($search == 'Class_Wise') {
                                                                                                                                                                                                                    echo $class . ' ' . $section;
                                                                                                                                                                                                                } else if ($search == 'Area_Wise') {
                                                                                                                                                                                                                    echo $txtinp;
                                                                                                                                                                                                                } else if ($search == 'Route_Wise') {
                                                                                                                                                                                                                    echo $route;
                                                                                                                                                                                                                } ?></td></tr><br></table></div>";
            window.frames["print_frame"].document.body.innerHTML += document.querySelector('.table-container').innerHTML;
            window.frames["print_frame"].window.focus();
            window.frames["print_frame"].window.print();
        }
    </script>

    <!-- Export Table to Excel -->
    <script type="text/javascript">
        $('#export').on('click', function() {
            type = '<?php echo $search; ?>';
            if (type == "Class_Wise") {
                stuclass = '<?php echo $class; ?>';
                stusection = '<?php echo $section; ?>';
                filename = stuclass + stusection + '_Address';
            } else if (type == "Area_Wise") {
                area = '<?php echo $txtinp; ?>';
                filename = area + '_Address';
            } else if (type == "Route_Wise") {
                route = '<?php echo $route; ?>';
                filename = route + '_Address';
            }
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

    <!-- Fetching and Displaying Student Image -->
    <script type="text/javascript">
        function photo() {
            img_head = document.getElementById('img_head');
            cls = '<?php echo $class ?>';
            console.log(cls);
            if (document.getElementById('w_photo').checked) {
                p = document.getElementById('w_photo').value;
                img_head.hidden = '';
            } else if (document.getElementById('wo_photo').checked) {
                p = document.getElementById('wo_photo').value;
                img_head.hidden = 'hidden';
            }
        }
    </script>
    <!-- Change labels -->
    <script type="text/javascript">
        let result = document.getElementById('add_label');
        let inp_row = document.getElementById('inp_row');
        let route_row = document.getElementById('route_row');
        let cls_row = document.getElementById('class_row');
        document.body.addEventListener('change', function(e) {
            let target = e.target;
            let message;
            switch (target.id) {
                case 'class_wise':
                    message = '';
                    if (cls_row.hidden) {
                        cls_row.hidden = '';
                    }
                    if (!inp_row.hidden) {
                        inp_row.hidden = 'true';
                    }
                    if (!route_row.hidden) {
                        route_row.hidden = 'true';
                    }
                    if (!result.hidden) {
                        result.hidden = 'true';
                    }
                    break;
                case 'area_wise':
                    message = "Area Wise";
                    if (!cls_row.hidden) {
                        cls_row.hidden = 'false';
                    }
                    if (inp_row.hidden) {
                        inp_row.hidden = '';
                    }
                    if (!route_row.hidden) {
                        route_row.hidden = 'true';
                    }
                    if (result.hidden) {
                        result.hidden = '';
                    } else if (!result.hidden) {
                        result.hidden = '';
                    }
                    break;
                case 'route_wise':
                    message = "Route Wise";
                    if (!cls_row.hidden) {
                        cls_row.hidden = 'true';
                    }
                    if (!inp_row.hidden) {
                        inp_row.hidden = 'true';
                    }
                    if (route_row.hidden) {
                        route_row.hidden = '';
                    }
                    if (result.hidden) {
                        result.hidden = '';
                    } else if (!result.hidden) {
                        result.hidden = '';
                    }
                    break;
                default:
                    if (result.innerHTML == '') {

                    } else if (result.innerHTML == "Area Wise") {
                        message = "Area Wise";
                    } else if (result.innerHTML == "Route Wise") {
                        message = "Route Wise";
                    }
            }
            result.innerHTML = message;
        });
    </script>

</body>

</html>