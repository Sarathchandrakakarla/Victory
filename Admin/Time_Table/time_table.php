<?php
include '../../link.php';
session_start();
if (!$_SESSION['Admin_Id_No']) {
    echo "<script>
  alert('Admin Id Not Rendered');
  location.replace('../admin_login.php');
  </script>";
}
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Victory Schools</title>
    <link rel="shortcut icon" href="/Victory/Images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/Victory/css/sidebar-style.css" />

    <!-- Bootstrap Links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Boxiocns CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
</head>
<style>
    body {
        background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
    }

    .table-container {
        margin-left: 90px;
        max-width: 1400px;
        max-height: 700px;
        overflow-x: scroll;
        overflow-y: scroll;
    }

    .leisure-container {
        max-width: 1400px;
        max-height: 500px;
        overflow-x: scroll;
        overflow-y: scroll;
    }

    .period {
        color: #fff;
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

<body>
    <?php include '../sidebar.php'; ?>
    <div class="container mt-3">
        <h1 style="text-align: center;font-family:'Times New Roman';">Time Table</h1>
    </div>
    <form action="" method="post">
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-4">
                    <button class="btn btn-success" onclick="printDiv();return false;"><i class="bx bx-printer"></i>Print</button>
                    <button class="btn btn-primary" name="Refresh"><i class="bx bx-refresh"></i>Refresh</button>
                    <button class="btn btn-primary" name="Reset"><i class="bx bx-reset"></i>Reset Time Table</button>
                </div>
            </div>
        </div>
    </form>
    <form action="" method="post">
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-3">
                    <button class="btn btn-primary edit" onclick="edit();return false;"><i class="bx bx-edit"></i>Edit</button>
                    <button class="btn btn-primary save" name="Save" onclick="return false;" disabled><i class="bx bx-save"></i>Save</button>
                </div>
            </div>
        </div>

        <div class="container table-container">
            <table class="table table-striped table-hover mt-5" id="table-container">
                <thead class="bg-warning">
                    <th style="text-align:center;border-top: 2px solid black;border-bottom: 2px solid black;border-left: 2px solid black;border-right: 2px solid black;">Class</th>
                    <?php
                    for ($i = 1; $i <= 4; $i++) {
                        echo "<th style='text-align:center;border-right: 2px solid black;border-top: 2px solid black;border-bottom: 2px solid black;'>Period " . $i . "</th>";
                    }
                    echo "<th style='width:50px;text-align:center;border-right: 2px solid black;border-top: 2px solid black;border-bottom: 2px solid black;'>Lunch Break</th>";
                    for ($i = 5; $i <= 8; $i++) {
                        echo "<th style='text-align:center;border-right: 2px solid black;border-top: 2px solid black;border-bottom: 2px solid black;'>Period " . $i . "</th>";
                    }
                    ?>
                </thead>
                <tbody>
                    <?php
                    $classes = ['PreKG', 'LKG', 'UKG'];
                    for ($i = 1; $i <= 10; $i++) {
                        array_push($classes, $i . ' CLASS');
                    }
                    $sections = ['A', 'B', 'C', 'D'];
                    $final_classes = [];
                    foreach ($classes as $class) {
                        $temp = [];
                        foreach ($sections as $section) {
                            if (mysqli_num_rows(mysqli_query($link, "SELECT Id_No FROM `student_master_data` WHERE Stu_Class = '$class' AND Stu_Section = '$section'")) > 0) {
                                array_push($temp, $section);
                            }
                        }
                        $final_classes[$class] = $temp;
                    }
                    foreach (array_keys($final_classes) as $class) {
                        foreach ($final_classes[$class] as $section) {
                            echo "
                <tr>
                    <td style='text-align:center;border-left: 2px solid black;border-right: 2px solid black;border-bottom: 2px solid black;'>" . $class . " " . $section . "</td>";
                            $time_table_sql = mysqli_query($link, "SELECT * FROM `time_table` WHERE Class = '$class' AND Section = '$section'");
                            if ($time_table_sql) {
                                if (mysqli_num_rows($time_table_sql) == 0) {
                                    for ($i = 1; $i <= 4; $i++) {
                                        echo "<td class='period' id='" . $class . "_" . $section . "_period_" . $i . "' style='text-align:center;border-right: 2px solid black;border-bottom: 2px solid black;'></td>";
                                    }
                                    echo "<td class='period' name='Lunch' style='text-align:center;border-right: 2px solid black;border-bottom: 2px solid black;'></td>";
                                    for ($i = 5; $i <= 8; $i++) {
                                        echo "<td class='period' id='" . $class . "_" . $section . "_period_" . $i . "' style='text-align:center;border-right: 2px solid black;border-bottom: 2px solid black;'></td>";
                                    }
                                } else {
                                    while ($time_table_row = mysqli_fetch_assoc($time_table_sql)) {
                                        for ($i = 1; $i <= 4; $i++) {
                                            $time_table_temp_sql = mysqli_query($link, "SELECT * FROM `time_table_temp` WHERE Class = '$class' AND Section = '$section' AND Period = 'Period$i'");
                                            if (mysqli_num_rows($time_table_temp_sql) != 0) {
                                                while ($time_table_temp_row =  mysqli_fetch_assoc($time_table_temp_sql)) {
                                                    $teacher_id = $time_table_temp_row['Faculty'];

                                                    $name_sql = mysqli_query($link, "SELECT Emp_First_Name FROM `employee_master_data` WHERE Emp_Id = '$teacher_id'");
                                                    while ($name_row = mysqli_fetch_assoc($name_sql)) {
                                                        $teacher_name = $name_row['Emp_First_Name'];
                                                    }
                                                    echo "<td class='period " . $teacher_id . " allocated'  id='" . $class . "_" . $section . "_period_" . $i . "' style='color:black;text-align:center;border-right: 2px solid black;border-bottom: 2px solid black;background-color:blue;font-weight:bold;'>" . $teacher_id . " <br> " . $teacher_name . "</td>";
                                                }
                                            } else {
                                                if ($time_table_row['Period' . $i] != "" && $time_table_row['Period' . $i] != NULL) {
                                                    $details = explode(',', $time_table_row['Period' . $i]);
                                                    if (count($details) > 1) {
                                                        $teacher_id = trim($details[0]);
                                                        $subject = trim(end($details));
                                                    } else {
                                                        $teacher_id = trim($details[0]);
                                                    }
                                                    $name_sql = mysqli_query($link, "SELECT Emp_First_Name FROM `employee_master_data` WHERE Emp_Id = '$teacher_id'");
                                                    while ($name_row = mysqli_fetch_assoc($name_sql)) {
                                                        $teacher_name = $name_row['Emp_First_Name'];
                                                    }
                                                    //Checking Teacher is Present or Absent
                                                    $date = date('d-m-Y');
                                                    date_default_timezone_set("Asia/Kolkata");
                                                    $am_pm = strtoupper(date('a', $timestamp));
                                                    $teacher_status = true;
                                                    $teacher_status_sql = mysqli_query($link, "SELECT * FROM `employee_attendance` WHERE Id_No = '$teacher_id' AND Date = '$date' AND AM = 'A'");
                                                    if (mysqli_num_rows($teacher_status_sql) == 0) {
                                                        $teacher_status = true;
                                                    } else {
                                                        $teacher_status = false;
                                                    }
                                                    if ($teacher_status) {
                                                        echo "<td class='period " . $teacher_id . "'  id='" . $class . "_" . $section . "_period_" . $i . "' style='text-align:center;border-right: 2px solid black;border-bottom: 2px solid black;background-color:green;font-weight:bold;'>" . $teacher_id . " <br> " . $teacher_name . " <br> " . $subject . "</td>";
                                                    } else {
                                                        echo "<td class='period absent " . $teacher_id . "'  id='" . $class . "_" . $section . "_period_" . $i . "' style='text-align:center;border-right: 2px solid black;border-bottom: 2px solid black;background-color:red;font-weight:bold;'>" . $teacher_id . " <br> " . $teacher_name . " <br> " . $subject . "</td>";
                                                    }
                                                } else {
                                                    echo "<td class='period'  id='" . $class . "_" . $section . "_period_" . $i . "' style='text-align:center;border-right: 2px solid black;border-bottom: 2px solid black;'></td>";
                                                }
                                            }
                                        }
                                        echo "<td style='text-align:center;border-right: 2px solid black;border-bottom: 2px solid black;font-weight:bold;'>Lunch Break</td>";
                                        for ($i = 5; $i <= 8; $i++) {
                                            $time_table_temp_sql = mysqli_query($link, "SELECT * FROM `time_table_temp` WHERE Class = '$class' AND Section = '$section' AND Period = 'Period$i'");
                                            if (mysqli_num_rows($time_table_temp_sql) != 0) {
                                                while ($time_table_temp_row =  mysqli_fetch_assoc($time_table_temp_sql)) {
                                                    $teacher_id = $time_table_temp_row['Faculty'];

                                                    $name_sql = mysqli_query($link, "SELECT Emp_First_Name FROM `employee_master_data` WHERE Emp_Id = '$teacher_id'");
                                                    while ($name_row = mysqli_fetch_assoc($name_sql)) {
                                                        $teacher_name = $name_row['Emp_First_Name'];
                                                    }
                                                    echo "<td class='period " . $teacher_id . "'  id='" . $class . "_" . $section . "_period_" . $i . "' style='text-align:center;border-right: 2px solid black;border-bottom: 2px solid black;background-color:blue;font-weight:bold;'>" . $teacher_id . " <br> " . $teacher_name . "</td>";
                                                }
                                            } else {
                                                if ($time_table_row['Period' . $i] != "" && $time_table_row['Period' . $i] != NULL) {
                                                    $details = explode(',', $time_table_row['Period' . $i]);
                                                    if (count($details) > 1) {
                                                        $teacher_id = trim($details[0]);
                                                        $subject = trim(end($details));
                                                    } else {
                                                        $teacher_id = trim($details[0]);
                                                    }
                                                    $name_sql = mysqli_query($link, "SELECT Emp_First_Name FROM `employee_master_data` WHERE Emp_Id = '$teacher_id'");
                                                    while ($name_row = mysqli_fetch_assoc($name_sql)) {
                                                        $teacher_name = $name_row['Emp_First_Name'];
                                                    }
                                                    //Checking Teacher is Present or Absent
                                                    $date = date('d-m-Y');
                                                    date_default_timezone_set("Asia/Kolkata");
                                                    $am_pm = strtoupper(date('a', $timestamp));
                                                    $teacher_status = true;
                                                    $teacher_status_sql = mysqli_query($link, "SELECT * FROM `employee_attendance` WHERE Id_No = '$teacher_id' AND Date = '$date' AND PM = 'A'");
                                                    if (mysqli_num_rows($teacher_status_sql) == 0) {
                                                        $teacher_status = true;
                                                    } else {
                                                        $teacher_status = false;
                                                    }
                                                    if ($teacher_status) {
                                                        echo "<td class='period " . $teacher_id . "'  id='" . $class . "_" . $section . "_period_" . $i . "' style='text-align:center;border-right: 2px solid black;border-bottom: 2px solid black;background-color:green;font-weight:bold;'>" . $teacher_id . " <br> " . $teacher_name . " <br> " . $subject . "</td>";
                                                    } else {
                                                        echo "<td class='period absent " . $teacher_id . "'  id='" . $class . "_" . $section . "_period_" . $i . "' style='text-align:center;border-right: 2px solid black;border-bottom: 2px solid black;background-color:red;font-weight:bold;'>" . $teacher_id . " <br> " . $teacher_name . " <br> " . $subject . "</td>";
                                                    }
                                                } else {
                                                    echo "<td class='period'  id='" . $class . "_" . $section . "_period_" . $i . "' style='color:black;text-align:center;border-right: 2px solid black;border-bottom: 2px solid black;'></td>";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                    }
                    ?>

                    <?php

                    if (isset($_POST['Refresh'])) {
                        $date = date('d-m-Y');
                        date_default_timezone_set("Asia/Kolkata");
                        $am_pm = strtoupper(date('a', $timestamp));
                        $absent_sql = mysqli_query($link, "SELECT * FROM `employee_attendance` WHERE Date = '$date' AND $am_pm = 'A'");
                        if (mysqli_num_rows($absent_sql) == 0) {
                            echo "<script>alert('There are No Absentees!');</script>";
                        } else {
                            $absentees = [];
                            while ($absent_row = mysqli_fetch_assoc($absent_sql)) {
                                array_push($absentees, $absent_row['Id_No']);
                            }
                            foreach ($absentees as $teacher_id) {
                                echo "<script>
                            const nodeList = document.querySelectorAll('." . $teacher_id . "');
                            for (let i = 0; i < nodeList.length; i++) {
                              nodeList[i].style.backgroundColor = 'red';
                            }
                            </script>";
                            }
                        }
                    }
                    ?>

                    <?php
                    if (isset($_POST['Reset'])) {
                        $reset_query = mysqli_query($link, "TRUNCATE TABLE `time_table_temp`");
                        if ($reset_query) {
                            echo "<script>alert('Time Table Reset Succesful! Refresh to get Updated Data! ')</script>";
                        } else {
                            echo "<script>alert('Time Table Reset Failed!')</script>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </form>

    <div class="leisure-container table-container mt-5">
        <table class="table table-hover">
            <thead class="bg-secondary text-white">
                <tr>
                    <th class="text-center" colspan="5">Additional Faculty</th>
                </tr>
                <tr>
                    <th>S No.</th>
                    <th>Id No.</th>
                    <th>Name</th>
                    <th>Period</th>
                    <th>Allocate</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //Arrays
                $periods = [];
                for ($i = 1; $i <= 8; $i++) {
                    array_push($periods, 'Period' . $i);
                }
                $classes = ['PreKG', 'LKG', 'UKG'];
                for ($i = 1; $i <= 10; $i++) {
                    array_push($classes, $i . ' CLASS');
                }
                $sections = ['A', 'B', 'C', 'D'];
                $period_faculties = [];
                $overall_faculties = [];
                $leisure_faculties = [];

                //Getting Faculties from Time Table Period Wise
                foreach ($periods as $period) {
                    $period_faculties[$period] = [];
                    foreach ($classes as $class) {
                        foreach ($sections as $section) {
                            $query1 = mysqli_query($link, "SELECT * FROM `time_table` WHERE Class = '$class' AND Section = '$section'");
                            if (mysqli_num_rows($query1) > 0) {
                                while ($row1 = mysqli_fetch_assoc($query1)) {
                                    if ($row1[$period] != NULL && $row1[$period] != 'Handwriting') {
                                        array_push($period_faculties[$period], explode(',', $row1[$period])[0]);
                                        array_push($overall_faculties, explode(',', $row1[$period])[0]);
                                    }
                                }
                            }

                            $query2 = mysqli_query($link, "SELECT * FROM `time_table_temp` WHERE Class = '$class' AND Section = '$section' AND Period = '$period'");
                            if (mysqli_num_rows($query2) > 0) {
                                while ($row2 = mysqli_fetch_assoc($query2)) {
                                    array_push($period_faculties[$period], $row2['Faculty']);
                                }
                            }
                        }
                    }
                }
                //Overall Faculties from Time Table
                $overall_faculties = array_unique($overall_faculties);
                //Checking Which Period is Leisure for each faculty
                foreach ($overall_faculties as $faculty) {
                    $temp = [];
                    foreach ($periods as $period) {
                        if (!in_array($faculty, $period_faculties[$period])) {
                            array_push($temp, $period);
                        }
                    }
                    if (count($temp) > 0) {
                        $leisure_faculties[$faculty] = $temp;
                    }
                }

                $i = 1;
                foreach (array_keys($leisure_faculties) as $id) {
                    $query2 = mysqli_query($link, "SELECT Emp_First_Name FROM `employee_master_data` WHERE Emp_Id = '$id'");
                    if (mysqli_num_rows($query2) > 0) {
                        while ($row2 = mysqli_fetch_assoc($query2)) {

                            foreach ($leisure_faculties[$id] as $period) {
                                echo '
                            <tr>
                                <td>' . $i . '</td>
                                <td>' . $id . '</td>
                                <td>' . $row2['Emp_First_Name'] . '</td>
                                <td>' . $period . '</td>
                                <td>
                                    <input type="checkbox" id="allocate_' . $id . '_' . $period . '" onclick = "disp_class(this)" />
                                    <label for="allocate_' . $id . '_' . $period . '">Allocate</label>
                                </td>
                            </tr>
                            ';
                                $i++;
                            }
                        }
                    }
                }

                //Head Master and Nagaraju Sir
                $additional_ids = ['VHEM006', 'VHEM011'];
                foreach ($additional_ids as $id) {
                    $status = true;
                    foreach ($periods as $period) {
                        if (in_array($id, $period_faculties[$period])) {
                            $status = false;
                            break;
                        }
                    }
                    if ($status) {
                        $query3 = mysqli_query($link, "SELECT Emp_First_Name FROM `employee_master_data` WHERE Emp_Id = '$id'");
                        if (mysqli_num_rows($query3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($query3)) {
                                echo '
                            <tr>
                                <td>' . $i . '</td>
                                <td>' . $id . '</td>
                                <td>' . $row3['Emp_First_Name'] . '</td>
                                <td>Any</td>
                                <td>
                                    <input type="checkbox" class="any" id="allocate_' . $id . '_' . $period . '" onclick = "disp_class(this)" />
                                    <label for="allocate_' . $id . '_' . $period . '">Allocate</label>
                                </td>
                            </tr>
                            ';
                                $i++;
                            }
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>

    <!-- Scripts -->

    <!-- Display Classes -->
    <script type="text/javascript">
        function disp_class(ele) {
            if (ele.checked) {
                let absent_classes = []
                let absent_sections = []
                //Get All Period td elements
                var period_list = document.querySelectorAll('.absent')
                Array.from(period_list).forEach((element) => {
                    var arr = element.id.split('_')
                    absent_classes.push(arr[0]);
                    absent_sections.push(arr[1]);
                })
                absent_classes = new Set(absent_classes)
                absent_sections = new Set(absent_sections)
                text = "<select class='form-control' id='" + ele.id + "_class'><option value='' selected>-- Select Class --</option>"
                absent_classes.forEach((cls) => {
                    text += "<option value='" + cls + "'>" + cls + "</option>"
                })
                //text += "<option value='1 CLASS'>1 CLASS</option>"
                text += "</select>"
                text += "<select class='form-control' id='" + ele.id + "_section'><option value='' selected>-- Select Section --</option>"
                absent_sections.forEach((sec) => {
                    text += "<option value='" + sec + "' id='" + ele.id + "_section'>" + sec + "</option>"
                })
                //text += "<option value='A'>A</option>"
                text += "</select>"
                if (ele.classList.contains('any')) {
                    text += "<select class='form-control' id='" + ele.id + "_period'><option value='' selected>-- Select Period --</option>"
                    for (var i = 1; i <= 8; i++) {
                        text += "<option value='Period" + i + "'>Period" + i + "</option>"
                    }
                    text += "</select>"
                }
                text += "<button class='btn btn-success' id='" + ele.id + "_allocate' onclick='allocate(this)' >Allocate</button>"
                $(ele).parent('td').append(text)
            } else {
                $('#' + ele.id + '_class').remove()
                $('#' + ele.id + '_section').remove()
                $('#' + ele.id + '_allocate').remove()
                $('#' + ele.id + '_period').remove()
            }
        }
    </script>

    <!-- Allocate -->
    <script type="text/javascript">
        function allocate(ele) {
            cls = $(ele).parent().children().eq(2).val()
            if (cls == null) {
                alert("Please Select Class!")
            } else {
                sec = $(ele).parent().children().eq(3).val()
                if (sec == null) {
                    alert("Please Select Section!")
                } else {
                    period = $(ele).parent().siblings().eq(3).text()
                    if (period == "Any") {
                        period = $(ele).parent().children().eq(4).val()
                    }
                    fac_id = $(ele).parent().siblings().eq(1).text()
                    period_num = period.charAt(period.length - 1);
                    if (!document.getElementById(cls + '_' + sec + '_period_' + period_num).classList.contains('absent')) {
                        alert('Given Period is Already Allocated!')
                    } else {
                        $.ajax({
                            type: 'post',
                            url: 'temp1.php',
                            data: {
                                Class: cls,
                                Section: sec,
                                Period: period,
                                Faculty: fac_id
                            },
                            success: function(data) {
                                console.log(data)
                                if (data == "success") {
                                    alert('Faculty Allocated Successfully!Please Refresh to get Latest Data')
                                } else if (data == "failure") {
                                    alert('Faculty Allocation Failed!')
                                } else {
                                    alert('Internal Error!')
                                }
                            }
                        })
                    }
                }
            }
        }
    </script>

    <!-- Edit -->
    <script type="text/javascript">
        function edit() {
            var periodList = document.querySelectorAll('.period');
            periodList.forEach((period) => {
                $(period).attr('contenteditable', 'true');
            });
            $('.save').prop('disabled', false);
        }
    </script>

    <!-- Save -->
    <script type="text/javascript">
        $('.save').on('click', () => {
            classes = ['PreKG', 'LKG', 'UKG'];
            for (i = 1; i <= 10; i++) {
                classes.push(i + ' CLASS')
            }
            sections = ['A', 'B', 'C', 'D'];
            text = ""
            allocated_text = ""
            classes.forEach((cls) => {
                sections.forEach((section) => {
                    for (period = 1; period <= 8; period++) {
                        let elm = document.getElementById(cls + '_' + section + '_period_' + period)
                        if (JSON.stringify(elm) == "null") {
                            continue
                        } else {
                            if(elm.classList.contains('allocated')){
                                allocated_text += cls + '_' + section + '_period_' + period + '=' + document.getElementById(cls + '_' + section + '_period_' + period).innerHTML + '&'
                            } else{
                                text += cls + '_' + section + '_period_' + period + '=' + document.getElementById(cls + '_' + section + '_period_' + period).innerHTML + '&'
                            }
                        }
                    }
                });
            });
            $.ajax({
                type: 'post',
                url: 'temp.php',
                data: {
                    Time_Table: text,
                    Allocated:allocated_text
                },
                success: function(data) {
                    console.log(data)
                    if (data == "success") {
                        alert('Time Table Updated Successfully!')
                    } else if (data == "failure") {
                        alert('Time Table Updation Failed!')
                    } else {
                        alert('Internal Error!')
                    }
                }
            });
        });
    </script>

    <!-- Print Table -->
    <script type="text/javascript">
        function printDiv() {
            window.frames["print_frame"].document.body.innerHTML = "<h2 style='text-align:center;'>VICTORY HIGH SCHOOL</h2>";
            window.frames["print_frame"].document.body.innerHTML += "<h2 style='text-align:center;'>Time Table</h2>";
            window.frames["print_frame"].document.body.innerHTML += document.querySelector('.table-container').innerHTML;
            window.frames["print_frame"].window.focus();
            window.frames["print_frame"].window.print();
        }
    </script>
</body>

</html>