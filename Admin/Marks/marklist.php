<?php
/*
Marklist
width:22.70cm
height:16.00cm
left:1.50cm
right:1.50cm
top:0.80cm
bottom:0.80cm
*/
include_once('../../link.php');
session_start();
if (!$_SESSION['Admin_Id_No']) {
    echo "<script>alert('Admin Id Not Rendered');
    location.replace('../admin_login.php');</script>";
}
error_reporting(0);
function month($date)
{
    $arr = explode('-', $date);
    $temp = array();
    switch ($arr[1]) {
        case '01':
            array_push($temp, str_split($arr[1])[1]);
            $arr[1] = "January";
            break;
        case '02':
            array_push($temp, str_split($arr[1])[1]);
            $arr[1] = "February";
            break;
        case '03':
            array_push($temp, str_split($arr[1])[1]);
            $arr[1] = "March";
            break;
        case '04':
            array_push($temp, str_split($arr[1])[1]);
            $arr[1] = "April";
            break;
        case '05':
            array_push($temp, str_split($arr[1])[1]);
            $arr[1] = "May";
            break;
        case '06':
            array_push($temp, str_split($arr[1])[1]);
            $arr[1] = "June";
            break;
        case '07':
            array_push($temp, str_split($arr[1])[1]);
            $arr[1] = "July";
            break;
        case '08':
            array_push($temp, str_split($arr[1])[1]);
            $arr[1] = "August";
            break;
        case '09':
            array_push($temp, str_split($arr[1])[1]);
            $arr[1] = "September";
            break;
        case '10':
            array_push($temp, $arr[1]);
            $arr[1] = "October";
            break;
        case '11':
            array_push($temp, $arr[1]);
            $arr[1] = "November";
            break;
        case '12':
            array_push($temp, $arr[1]);
            $arr[1] = "December";
            break;
    }
    array_push($temp, $arr[1]);
    return $temp;
}
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
        max-width: 1000px;
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
                        <input class="form-check-input" type="radio" name="stu_type" id="class_wise" onchange="stuType()" checked value="Class_Wise">
                        <label class="form-check-label" for="class_wise">Class Wise</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="stu_type" id="single" onchange="stuType()" value="Single">
                        <label class="form-check-label" for="single">Single</label>
                    </div>
                </div>
                <div class="col-lg-3" id="id_row" hidden>
                    <input type="text" class="form-control" placeholder="Enter Id No." oninput="this.value = this.value.toUpperCase()" onchange="fetchExam()" name="Id_No" id="id_no">
                </div>
            </div>
            <div class="row justify-content-center mt-5" id="class_row">
                <div class="p-2 col-lg-4 rounded">
                    <select class="form-select" name="Class" id="class" onchange="fetchExam()" aria-label="Default select example">
                        <option selected disabled>-- Select Class --</option>
                        <option value="PreKG">PreKG</option>
                        <option value="LKG">LKG</option>
                        <option value="UKG">UKG</option>
                        <?php
                        for ($i = 1; $i <= 10; $i++) {
                            echo '<option value="' . $i . ' CLASS">' . $i . ' CLASS</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="p-2 col-lg-4 rounded">
                    <select class="form-select" name="Section" id="sec" aria-label="Default select example">
                        <option selected disabled>-- Select Section --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <label for="exam_name" class="col-lg-2 col-form-label">Examination Name</label>
                <div class="col-sm-3">
                    <select class="form-select" name="Exam" id="exam">
                        <option value="selectexam">--Select Exam--</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-3">
                    <button class="btn btn-primary" type="submit" name="Ok">OK</button>
                    <button class="btn btn-warning" type="reset" onclick="hideTable()">Clear</button>
                    <button class="btn btn-success" onclick="printDiv();return false;">Print</button>
                </div>
            </div>
        </div>
    </form>
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-lg-5" style="color: red;">
                NOTE: 1. Please Give Margin: Minimum in Page Setup <br>
                2. Place the ribbon at "scholastic" word in mark list
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-3">
                <h3><b>Mark List</b></h3>
            </div>
        </div>
    </div>
    <div class="container table-container" id="table-container">
        <?php

        if (isset($_POST['Ok'])) {
            $months = array(
                'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February', 'March', 'April'
            );
            //Arrays
            $working_days = array();
            $days = array();
            $working_months = array();

            foreach ($months as $month) {
                $working_query = mysqli_query($link, "SELECT Working_Days AS Days FROM `working_days` WHERE Month = '$month'");
                if (mysqli_num_rows($working_query) == 0) {
                    //echo "<script>alert('" . $month . " Not Available!!')</script>";
                    $working_days[$month] = '';
                } else {
                    while ($working_row = mysqli_fetch_assoc($working_query)) {
                        if ((int)$working_row['Days'] != '') {
                            $working_days[$month] = (int)$working_row['Days'];
                        }
                    }
                }
            }

            $mon_arr = array();
            foreach (array_keys($working_days) as $mon) {
                array_push($mon_arr, $mon);
            }
            $stu_type = $_POST['stu_type'];
            if ($stu_type == "Single") {
                echo "<script>
                document.getElementById('single').checked = true;
                document.getElementById('id_row').hidden = '';
                document.getElementById('class_row').hidden = 'hidden';
                </script>";

                //Arrays
                $subs = array();
                $marks = array();


                if ($_POST['Id_No']) {
                    $id = $_POST['Id_No'];
                    echo "<script>document.getElementById('id_no').value = '" . $id . "'</script>";
                    if ($_POST['Exam']) {
                        $exam = $_POST['Exam'];
                        $class_sql = mysqli_query($link, "SELECT First_Name,Stu_Class,Stu_Section FROM `student_master_data` WHERE Id_No = '$id'");
                        while ($class_row = mysqli_fetch_assoc($class_sql)) {
                            $name = $class_row['First_Name'];
                            $class = $class_row['Stu_Class'];
                            $section = $class_row['Stu_Section'];
                        }

                        $query1 = mysqli_query($link, "SELECT Subjects,Max_Marks FROM `class_wise_subjects` WHERE Class = '$class' AND Exam = '$exam'");
                        while ($row1 = mysqli_fetch_assoc($query1)) {
                            array_push($subs, array($row1['Subjects'], $row1['Max_Marks']));
                        }

                        $total_max = 0;
                        foreach ($subs as $sub) {
                            $total_max += $sub[1];
                        }

                        foreach (array_keys($working_days) as $month) {
                            $days_query = mysqli_query($link, "SELECT $month FROM `stu_att_master` WHERE Id_No = '$id'");
                            if (mysqli_num_rows($days_query) == 0) {
                                $days[$id][$month]['Present'] = '';
                            } else {
                                while ($days_row = mysqli_fetch_assoc($days_query)) {
                                    if ($days_row[$month] != '0') {
                                        $days[$id][$month]['Present'] = $days_row[$month];
                                    } else {
                                        $days[$id][$month]['Present'] = '';
                                    }
                                }
                            }
                        }

                        $query2 = mysqli_query($link, "SELECT * FROM `stu_marks` WHERE Id_No = '$id' AND Exam = '$exam'");

                        $temp = array();
                        while ($row2 = mysqli_fetch_assoc($query2)) {
                            for ($i = 1; $i <= count($subs); $i++) {
                                array_push($temp, $row2['sub' . $i]);
                            }
                            $temp['Total'] = $row2['Total'];
                            $percentage = round(($row2['Total'] / $total_max) * 100, 1);
                            if ($percentage >= 80 && $percentage <= 100) {
                                $grade = "Excellent";
                            } else if ($percentage >= 70 && $percentage < 80) {
                                $grade = "Good";
                            } else if ($percentage >= 60 && $percentage < 70) {
                                $grade = "Satisfactory";
                            } else if ($percentage >= 50 && $percentage < 60) {
                                $grade = "Above Average";
                            } else if ($percentage >= 35 && $percentage < 50) {
                                $grade = "Average";
                            } else if ($percentage > 0 && $percentage < 35) {
                                $grade = "Below Average";
                            } else {
                                $grade = "";
                            }
                            $temp['Percentage'] = $percentage;
                            $temp['Grade'] = $grade;
                        }
                        $marks[$id] = $temp;

                        echo '
                                <div style="margin-left:3.7cm;padding-top:2.1cm;margin-bottom:0.4cm;">
                                    <table>
                                        <tr style = "line-height:30px;">
                                            <td style = "font-weight:bold;font-family:' . 'Arial' . ';">' . $id . '</td>
                                            <td></td>
                                            <td style = "width:230px;"></td>
                                            <td></td>
                                            <td style = "font-weight:bold;font-family:' . 'Arial' . '">' . $name . '</td>
                                        </tr>
                                        <tr style = "line-height:25px;">
                                            <td style = "font-weight:bold;font-family:' . 'Arial' . ';">' . $exam . '</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style = "font-weight:bold;font-family:' . 'Arial' . '">' . $class . ' ' . $section . '</td>
                                        </tr>
                                    </table>
                                </div>
                                ';
                            $count = 0;
                            echo '<div class="main-container" style="display:flex;">
                                <div class="" style="height:5.7cm;">
                                <table>';
                            foreach ($subs as $sub) {
                                echo '
                                        <tr>
                                            <td style = "padding-left:15px;font-size:13px;font-weight:bold;font-family:' . 'Arial' . '">' . $sub[0] . '</td>
                                            <td style = "padding-left:75px;font-size:13px;font-weight:bold;font-family:' . 'Arial' . '">' . $sub[1] . '</td>
                                            <td style = "padding-left:75px;font-size:13px;font-weight:bold;font-family:' . 'Arial' . '">' . $marks[$id][$count] . '</td>
                                        <tr>';

                                $count++;
                            }
                            echo '</table>
                                </div>';
                            echo '
                                <div class="">
                                    <table>';
                            foreach ($mon_arr as $mon) {
                                echo '
                                        <tr>
                                            <td style = "width:250px;font-family:' . 'Arial' . '"></td>
                                            <td style = "padding-left:10px;font-size:13px;font-weight:bold;font-family:' . 'Arial' . '">' . $days[$id][$mon]['Present'] . '</td>
                                            <td style = "padding-left:70px;font-size:13px;font-weight:bold;font-family:' . 'Arial' . '">' . $working_days[$mon] . '</td>
                                        <tr>';

                                $count++;
                                $i++;
                            }
                            echo '
                                        </table>
                                    </div>
                                </div>';
                            echo '
                                <div style="height:1.5cm;">
                                    <table>
                                        <tr>
                                            <td style = "padding-left:2.8cm;font-weight:bold;font-family:' . 'Arial' . '">' . $marks[$id]['Total'] . '</td>
                                        </tr>
                                        <tr style = "line-height:30px;">
                                            <td style = "padding-left:2.8cm;font-weight:bold;font-family:' . 'Arial' . '">' . $marks[$id]['Percentage'] . '</td>
                                        </tr>
                                        <tr style = "line-height:30px;">
                                            <td style = "padding-left:2.8cm;font-weight:bold;font-family:' . 'Arial' . '">' . $marks[$id]['Grade'] . '</td>
                                        </tr>
                                    </table>
                                </div>
                                ';
                    } else {
                        echo "<script>alert('Please Select Exam!!')</script>";
                    }
                } else {
                    echo "<script>alert('Please Enter Id_No')</script>";
                }
            } else {
                if ($_POST['Class']) {
                    $class = $_POST['Class'];
                    echo "<script>document.getElementById('class').value = '" . $class . "'</script>";
                    if ($_POST['Section']) {
                        $section = $_POST['Section'];
                        echo "<script>document.getElementById('sec').value = '" . $section . "'</script>";
                        if ($_POST['Exam']) {
                            $exam = $_POST['Exam'];

                            //Arrays
                            $ids = array();
                            $names = array();
                            $subs = array();
                            $marks = array();

                            //Queries
                            $query1 = mysqli_query($link, "SELECT Id_No,First_Name FROM `student_master_data` WHERE Stu_Class = '$class' AND Stu_Section = '$section'");
                            $query2 = mysqli_query($link, "SELECT Subjects,Max_Marks FROM `class_wise_subjects` WHERE Class = '$class' AND Exam = '$exam'");

                            while ($row1 = mysqli_fetch_assoc($query1)) {
                                array_push($ids, $row1['Id_No']);
                                $names[$row1['Id_No']] = $row1['First_Name'];
                            }
                            while ($row2 = mysqli_fetch_assoc($query2)) {
                                array_push($subs, array($row2['Subjects'], $row2['Max_Marks']));
                            }

                            $total_max = 0;
                            foreach ($subs as $sub) {
                                $total_max += $sub[1];
                            }

                            foreach ($ids as $id) {
                                foreach (array_keys($working_days) as $month) {
                                    $days_query = mysqli_query($link, "SELECT $month FROM `stu_att_master` WHERE Id_No = '$id'");
                                    if (mysqli_num_rows($days_query) == 0) {
                                        $days[$id][$month]['Present'] = '';
                                    } else {
                                        while ($days_row = mysqli_fetch_assoc($days_query)) {
                                            if ($days_row[$month] != '0') {
                                                $days[$id][$month]['Present'] = $days_row[$month];
                                            } else {
                                                $days[$id][$month]['Present'] = '';
                                            }
                                        }
                                    }
                                }
                            }

                            foreach ($ids as $id) {
                                $query3 = mysqli_query($link, "SELECT * FROM `stu_marks` WHERE Id_No = '$id' AND Exam = '$exam'");

                                $temp = array();
                                while ($row3 = mysqli_fetch_assoc($query3)) {
                                    for ($i = 1; $i <= count($subs); $i++) {
                                        array_push($temp, $row3['sub' . $i]);
                                    }
                                    $temp['Total'] = $row3['Total'];
                                    $percentage = round(($row3['Total'] / $total_max) * 100, 1);
                                    if ($percentage >= 80 && $percentage <= 100) {
                                        $grade = "Excellent";
                                    } else if ($percentage >= 70 && $percentage < 80) {
                                        $grade = "Good";
                                    } else if ($percentage >= 60 && $percentage < 70) {
                                        $grade = "Satisfactory";
                                    } else if ($percentage >= 50 && $percentage < 60) {
                                        $grade = "Above Average";
                                    } else if ($percentage >= 35 && $percentage < 50) {
                                        $grade = "Average";
                                    } else if ($percentage > 0 && $percentage < 35) {
                                        $grade = "Below Average";
                                    } else {
                                        $grade = "";
                                    }
                                    $temp['Percentage'] = $percentage;
                                    $temp['Grade'] = $grade;
                                }
                                $marks[$id] = $temp;
                            }

                            echo '
                                <div style="margin-left:3.3cm;padding-top:2.1cm;margin-bottom:0.7cm;">
                                    <table>
                                        <tr style = "line-height:30px;">
                                            <td style = "font-weight:bold;font-family:' . 'Arial' . ';">' . $ids[0] . '</td>
                                            <td></td>
                                            <td style = "width:230px;"></td>
                                            <td></td>
                                            <td style = "font-weight:bold;font-family:' . 'Arial' . '">' . $names[$ids[0]] . '</td>
                                        </tr>
                                        <tr style = "line-height:25px;">
                                            <td style = "font-weight:bold;font-family:' . 'Arial' . ';">' . $exam . '</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style = "font-weight:bold;font-family:' . 'Arial' . '">' . $class . ' ' . $section . '</td>
                                        </tr>
                                    </table>
                                </div>
                                ';
                            $count = 0;
                            echo '<div class="main-container" style="display:flex;">
                                <div class="" style="height:5.7cm;">
                                <table>';
                            foreach ($subs as $sub) {
                                echo '
                                        <tr>
                                            <td style = "padding-left:15px;font-size:13px;font-weight:bold;font-family:' . 'Arial' . '">' . $sub[0] . '</td>
                                            <td style = "padding-left:75px;font-size:13px;font-weight:bold;font-family:' . 'Arial' . '">' . $sub[1] . '</td>
                                            <td style = "padding-left:75px;font-size:13px;font-weight:bold;font-family:' . 'Arial' . '">' . $marks[$ids[0]][$count] . '</td>
                                        <tr>';

                                $count++;
                            }
                            echo '</table>
                                </div>';
                            echo '
                                <div class="">
                                    <table>';

                            foreach ($mon_arr as $mon) {
                                echo '
                                        <tr>
                                            <td style = "width:250px;font-family:' . 'Arial' . '"></td>
                                            <td style = "padding-left:10px;font-size:13px;font-weight:bold;font-family:' . 'Arial' . '">' . $days[$ids[0]][$mon]['Present'] . '</td>
                                            <td style = "padding-left:70px;font-size:13px;font-weight:bold;font-family:' . 'Arial' . '">' . $working_days[$mon] . '</td>
                                        <tr>';

                                $count++;
                                $i++;
                            }
                            echo '
                                        </table>
                                    </div>
                                </div>';
                            echo '
                                <div style="height:1.5cm;">
                                    <table>
                                        <tr>
                                            <td style = "padding-left:2.8cm;font-weight:bold;font-family:' . 'Arial' . '">' . $marks[$ids[0]]['Total'] . '</td>
                                        </tr>
                                        <tr style = "line-height:30px;">
                                            <td style = "padding-left:2.8cm;font-weight:bold;font-family:' . 'Arial' . '">' . $marks[$ids[0]]['Percentage'] . '</td>
                                        </tr>
                                        <tr style = "line-height:30px;">
                                            <td style = "padding-left:2.8cm;font-weight:bold;font-family:' . 'Arial' . '">' . $marks[$ids[0]]['Grade'] . '</td>
                                        </tr>
                                    </table>
                                </div>
                                ';

                            foreach ($ids as $id) {
                                echo '
                                <div class="full-paper" style="padding-bottom:0.5cm;">
                                <div style="margin-left:3.7cm;padding-top:3.0cm;margin-bottom:0.8cm;">
                                    <table>
                                        <tr style = "line-height:30px;">
                                            <td style = "font-weight:bold;font-family:' . 'Arial' . ';">' . $id . '</td>
                                            <td></td>
                                            <td style = "width:230px;"></td>
                                            <td></td>
                                            <td style = "font-weight:bold;font-family:' . 'Arial' . '">' . $names[$id] . '</td>
                                        </tr>
                                        <tr style = "line-height:25px;">
                                            <td style = "font-weight:bold;font-family:' . 'Arial' . ';">' . $exam . '</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style = "font-weight:bold;font-family:' . 'Arial' . '">' . $class . ' ' . $section . '</td>
                                        </tr>
                                    </table>
                                </div>
                                ';
                                $count = 0;
                                echo '<div class="main-container" style="display:flex;">
                                <div class="" style="height:5.7cm;">
                                <table>';
                                foreach ($subs as $sub) {
                                    echo '
                                        <tr>
                                            <td style = "padding-left:15px;font-size:13px;font-weight:bold;font-family:' . 'Arial' . '">' . $sub[0] . '</td>
                                            <td style = "padding-left:75px;font-size:13px;font-weight:bold;font-family:' . 'Arial' . '">' . $sub[1] . '</td>
                                            <td style = "padding-left:75px;font-size:13px;font-weight:bold;font-family:' . 'Arial' . '">' . $marks[$id][$count] . '</td>
                                        <tr>';

                                    $count++;
                                }
                                echo '</table>
                                </div>';
                                echo '
                                <div class="">
                                    <table>';

                                foreach ($mon_arr as $mon) {
                                    echo '
                                        <tr>
                                            <td style = "width:250px;font-family:' . 'Arial' . '"></td>
                                            <td style = "padding-left:10px;font-size:13px;font-weight:bold;font-family:' . 'Arial' . '">' . $days[$id][$mon]['Present'] . '</td>
                                            <td style = "padding-left:70px;font-size:13px;font-weight:bold;font-family:' . 'Arial' . '">' . $working_days[$mon] . '</td>
                                        <tr>';

                                    $count++;
                                    $i++;
                                }
                                echo '
                                        </table>
                                    </div>
                                </div>';
                                echo '
                                <div style="height:1.5cm;">
                                    <table>
                                        <tr>
                                            <td style = "padding-left:2.8cm;font-weight:bold;font-family:' . 'Arial' . '">' . $marks[$id]['Total'] . '</td>
                                        </tr>
                                        <tr style = "line-height:30px;">
                                            <td style = "padding-left:2.8cm;font-weight:bold;font-family:' . 'Arial' . '">' . $marks[$id]['Percentage'] . '</td>
                                        </tr>
                                        <tr style = "line-height:30px;">
                                            <td style = "padding-left:2.8cm;font-weight:bold;font-family:' . 'Arial' . '">' . $marks[$id]['Grade'] . '</td>
                                        </tr>
                                    </table>
                                </div>
                                </div>
                                ';
                            }
                        } else {
                            echo "<script>alert('Please Select Exam!!')</script>";
                        }
                    } else {
                        echo "<script>alert('Please Select Section!!')</script>";
                    }
                } else {
                    echo "<script>alert('Please Select Class!!')</script>";
                }
            }
        }

        ?>
    </div>
    <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>




    <!-- Scripts -->

    <!-- Change labels -->
    <script type="text/javascript">
        function stuType() {
            id_row = document.getElementById('id_row');
            class_row = document.getElementById('class_row');
            if (document.getElementById('class_wise').checked) {
                id_row.hidden = 'hidden';
                class_row.hidden = '';
            } else if (document.getElementById('single').checked) {
                id_row.hidden = '';
                class_row.hidden = 'hidden';
            }
        }
    </script>

    <!-- Fetch Exam -->
    <script type="text/javascript">
        function fetchExam() {
            if (document.getElementById('class_wise').checked) {
                cls = $('#class').val();
                $('#exam').html('');
                $.ajax({
                    type: 'post',
                    url: 'temp.php',
                    data: {
                        class: cls
                    },
                    success: function(data) {
                        $("#exam").html(data);
                    }
                })
            } else if (document.getElementById('single').checked) {
                id = $('#id_no').val();
                console.log(id);
                $('#exam').html('');
                $.ajax({
                    type: 'post',
                    url: 'temp.php',
                    data: {
                        Id_No: id
                    },
                    success: function(data) {
                        $("#exam").html(data);
                    }
                })
            }
        }
    </script>

    <!-- Print Table -->
    <script type="text/javascript">
        function printDiv() {
            window.frames["print_frame"].document.body.innerHTML = document.querySelector('.table-container').innerHTML;
            window.frames["print_frame"].window.focus();
            window.frames["print_frame"].window.print();
        }
    </script>
</body>

</html>