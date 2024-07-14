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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

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
        max-width: 900px;
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
            <div class="row justify-content-center mt-5">
                <label for="class_name" class="col-lg-2 col-form-label">Class</label>
                <div class="col-sm-3">
                    <select class="form-select" name="Class" id="class" onchange="fetchExam(this.value)">
                        <option value="selectclass" selected disabled>--Select Class--</option>
                        <option value="PreKG">PreKG</option>
                        <option value="LKG">LKG</option>
                        <option value="UKG">UKG</option>
                        <?php
                        for ($i = 1; $i <= 10; $i++) {
                            echo "<option value='" . $i . " CLASS'>" . $i . " CLASS</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center mt-3" id="section_row">
                <label for="class_name" class="col-lg-2 col-form-label">Section</label>
                <div class="col-sm-3">
                    <select class="form-select" name="Section" id="sec">
                        <option value="selectsection" selected disabled>--Select Section--</option>
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
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
                <div class="col-lg-2">
                    <button class="btn btn-primary" type="submit" name="Show">Show</button>
                    <button class="btn btn-warning" type="reset" onclick="hideTable();send_alert_container.hidden = 'hidden';">Clear</button>
                </div>
            </div>
        </div>
    </form>
    <div class="container" id="send_alert_container" hidden>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-4">
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <div>
                        Messages Sent Successfully!! <br>
                        Total Messages: <span id="total"></span> <br>
                        Sent Messages: <span id="sent"></span> <br>
                        Failed Messages: <span id="failed"></span> <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4" id="send_error_alert" hidden>
            <div class="col-lg-4">
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <div>
                        Sorry! Message could not sent be to these Mobile Numbers:<br>
                        <span id="error_mobiles"></span> <br>
                        Please Check these Mobile Numbers!
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-4">
                <h3><b>Send SMS of Marks</b></h3>
            </div>
        </div>
    </div>
    <form action="" method="post">
        <div class="container table-container" id="table-container">
            <table class="table table-striped table-hover" border="1">
                <thead>
                    <th>S.No</th>
                    <th>Id No.</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>File Link</th>
                    <th>Action <span style="margin:5px;"></span><input type="checkbox" id="select_all" onclick="toggle(this)"><label for="select_all">Select All</label></th>
                </thead>
                <tbody id="tbody">
                    <?php
                    if (isset($_POST['Show'])) {
                        if ($_POST['Class']) {
                            $class = $_POST['Class'];
                            echo "<script>document.getElementById('class').value = '" . $class . "'</script>";
                            $s = mysqli_query($link, "SELECT * FROM `class_wise_examination` WHERE Class = '$class'");
                            echo "<script>document.getElementById('exam').innerHTML = '';</script>";
                            if (mysqli_num_rows($s) > 0) {
                                echo "<script>$('#exam').html('<option value=" . 'selectexam' . " disabled selected>--Select Exam--</option>');</script>";
                                while ($r = mysqli_fetch_assoc($s)) {
                                    echo "<script>$('#exam').append('<option value=' + '" . $r['Exam'] . "' + '>" . $r['Exam'] . "</option>');</script>";
                                }
                            } else {
                                echo "<script>$('#exam').html('<option selected disabled>No Exam Found</option>');</script>";
                            }
                            if ($_POST['Section']) {
                                $section = $_POST['Section'];
                                echo "<script>document.getElementById('sec').value = '" . $section . "'</script>";
                                if ($_POST['Exam']) {
                                    $exam = $_POST['Exam'];
                                    echo "<script>document.getElementById('exam').value='$exam';</script>";
                                    //Arrays
                                    $details = [];
                                    $ids = [];
                                    $subjects = [];

                                    //Queries
                                    $query1 = mysqli_query($link, "SELECT * FROM `student_master_data` WHERE Stu_Class = '$class' AND Stu_Section = '$section'");

                                    $query2 = mysqli_query($link, "SELECT * FROM `class_wise_examination` WHERE Class = '$class' AND Exam = '$exam'");
                                    $max = 0;
                                    while ($row2 = mysqli_fetch_assoc($query2)) {
                                        $max = $row2['Max_Marks'];
                                    }

                                    $query3 = mysqli_query($link, "SELECT * FROM `class_wise_subjects` WHERE Class = '$class' AND Exam = '$exam'");
                                    $subject_count = mysqli_num_rows($query3);

                                    $query4 = mysqli_query($link, "SELECT * FROM `stu_marks` WHERE Class = '$class' AND Section = '$section' AND Exam = '$exam'"); //Query to check whether marks of particular class,section and exam are available
                                    if (mysqli_num_rows($query4) == 0) {
                                        echo "<script>alert('Data Not Available')</script>";
                                    } else {
                                        while ($row1 = mysqli_fetch_assoc($query1)) {
                                            $details[$row1['Id_No']]['Name'] = $row1['First_Name'];
                                            if (strlen($row1['Mobile']) >= 10) {
                                                $details[$row1['Id_No']]['Mobile'] = str_split($row1['Mobile'], 10)[0];
                                            } else {
                                                $details[$row1['Id_No']]['Mobile'] = "0";
                                            }
                                        }
                                        $max_total = 0;
                                        while ($row3 = mysqli_fetch_assoc($query3)) {
                                            $subjects[$row3['Subjects']] = $row3['Max_Marks'];
                                            $max_total += (int)$row3['Max_Marks'];
                                        }
                                        foreach (array_keys($details) as $id) {
                                            $query5 = mysqli_query($link, "SELECT * FROM `stu_marks` WHERE Id_No = '$id' AND Exam = '$exam'");
                                            if (mysqli_num_rows($query5) == 0) {
                                                for ($sub = 1; $sub <= $subject_count; $sub++) {
                                                    $details[$id]['Marks'][array_keys($subjects)[$sub - 1]] = 0;
                                                }
                                                $details[$id]['Total'] = 0;
                                                $details[$id]['Percentage'] = 0;
                                                $details[$id]['Grade'] = "";
                                            } else {
                                                while ($row5 = mysqli_fetch_assoc($query5)) {
                                                    for ($sub = 1; $sub <= $subject_count; $sub++) {
                                                        $details[$id]['Marks'][array_keys($subjects)[$sub - 1]] = $row5['sub' . $sub];
                                                    }
                                                    $details[$id]['Total'] = (int)$row5['Total'];
                                                }
                                                $percentage = round(($details[$id]['Total'] / $max_total) * 100, 1);
                                                $details[$id]['Percentage'] = $percentage;
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
                                                $details[$id]['Grade'] = $grade;
                                            }
                                        }

                                        //File Creation

                                        foreach ($details as $id => $data) {
                                            $image = imagecreatefromjpeg("../../Files/Message Files/Academic Report Template.jpg");
                                            $black = imagecolorallocate($image, 0, 0, 0);
                                            imagettftext($image, 30, 0, 530, 495, $black, "../../Files/Message Files/fonts/timesbd.ttf", $data['Name']);
                                            imagettftext($image, 30, 0, 1600, 495, $black, "../../Files/Message Files/fonts/timesbd.ttf", $class . " " . $section);
                                            imagettftext($image, 30, 0, 530, 600, $black, "../../Files/Message Files/fonts/timesbd.ttf", $id);
                                            imagettftext($image, 30, 0, 1950, 595, $black, "../../Files/Message Files/fonts/timesbd.ttf", $exam);
                                            $height = 750;
                                            foreach ($data['Marks'] as $subject => $marks) {
                                                imagettftext($image, 30, 0, 250, $height, $black, "../../Files/Message Files/fonts/times.ttf", $subject);
                                                imagettftext($image, 30, 0, 1100, $height, $black, "../../Files/Message Files/fonts/times.ttf", $subjects[$subject]);
                                                imagettftext($image, 30, 0, 1900, $height, $black, "../../Files/Message Files/fonts/times.ttf", $marks);
                                                $height += 60;
                                            }
                                            imagettftext($image, 30, 0, 200, 1430, $black, "../../Files/Message Files/fonts/timesbd.ttf", "Total           :");
                                            imagettftext($image, 30, 0, 200, 1490, $black, "../../Files/Message Files/fonts/timesbd.ttf", "Percentage :");
                                            imagettftext($image, 30, 0, 200, 1550, $black, "../../Files/Message Files/fonts/timesbd.ttf", "Grade         :");

                                            imagettftext($image, 30, 0, 450, 1430, $black, "../../Files/Message Files/fonts/timesbd.ttf", $data['Total'] . "/" . $max_total);
                                            imagettftext($image, 30, 0, 450, 1490, $black, "../../Files/Message Files/fonts/timesbd.ttf", $data['Percentage'] . "%");
                                            imagettftext($image, 30, 0, 450, 1550, $black, "../../Files/Message Files/fonts/timesbd.ttf", $data['Grade']);
                                            imagejpeg($image, '../../Files/Message Files/Report.jpg');
                                            imagedestroy($image);
                                            $html = "
                                        <!DOCTYPE html>
                                        <html>
                                            <head></head>
                                            <body>
                                                <img src='../../Files/Message Files/Report.jpg' style='width:98%;'/>
                                            </body>
                                        </html>";
                                            require 'vendor/autoload.php';
                                            try {
                                                $html2pdf = new Html2Pdf($orientation = 'L', $format = 'C5');
                                                $html2pdf->writeHTML($html);

                                                if (!is_dir('../../Files/' . $class . " " . $section)) {
                                                    mkdir('../../Files/' . $class . " " . $section);
                                                }
                                                if (!is_dir('../../Files/' . $class . " " . $section . '/' . $exam)) {
                                                    mkdir('../../Files/' . $class . " " . $section . '/' . $exam);
                                                }
                                                $d = str_replace('\\', '/', dirname(dirname(__DIR__)));
                                                $html2pdf->output($_SERVER['DOCUMENT_ROOT'] . "/Victory/Files/" . $class . " " . $section . '/' . $exam . '/' . $id . '.pdf', 'F');
                                            } catch (Exception $e) {
                                                echo $e->getmessage();
                                            }
                                        }
                                        //Displaying the Fetched Data

                                        $i = 1;
                                        foreach ($details as $id => $data) {
                                            echo '
                                        <tr>
                                            <td>' . $i . '</td>
                                            <td>' . $id . '</td>
                                            <td>' . $data['Name'] . '</td>
                                            <td>' . $class . ' ' . $section . '</td>
                                            <td><a href="../../Files/' . $class . " " . $section . '/' . $exam . '/' . $id . '.pdf" target="_blank">Download File</a></td>
                                            <td><input type="checkbox" class="student" id="student" name="student[]" value="' . $id . ',' . $class . ',' . $section . ',' . $exam . ',' . $data['Mobile'] . '">' . $data['Mobile'] . '</td>
                                        </tr>
                                            ';
                                            $i++;
                                        }
                                    }
                                }
                            } else {
                                echo "<script>alert('Please Select Section!')</script>";
                            }
                        } else {
                            echo "<script>alert('Please Select Class!')</script>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-1">
                    <button class="btn btn-success" type="submit" name="Send" onclick="if(!confirm('Confirm to Send Marks Messages?'))return false; else return true;">Send</button>
                </div>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST['Send'])) {
        if (isset($_POST['student'])) {
            $students = $_POST['student'];
            $ch = curl_init("https://wapi.wbbox.in/v2/wamessage/send");

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'apikey: 1aa0a6ca-2ef7-11ef-ad4f-92672d2d0c2d'
            ));

            $send_count = 0;
            $failed_mobiles = [];
            foreach ($students as $student) {
                $student = explode(',', $student);
                $id = $student[0];
                $class = $student[1];
                $section = $student[2];
                $exam = $student[3];
                $mobile = $student[4];
                $body = array(
                    "from" => "919133663334",
                    "to" => "91" . $mobile,
                    "type" => "template",
                    "message" => array(
                        "templateid" => "328403",
                        "url" => "https://victoryschools.in/Victory/Files/" . $class . " " . $section . "/" . $exam . "/" . $id . ".pdf",
                        "filename" => $id
                    )
                );
                $data_string = json_encode($body);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                echo $data_string;
                $response = curl_exec($ch);
                if (explode(":", explode(',', $response)[1])[1] != '"SUCCESS"' || explode(":", explode(',', $response)[0])[1] != '"200"') {
                    $failed_mobiles[] = $mobile;
                } else {
                    $send_count++;
                }
            }
            curl_close($ch);
            $failed_count = count($students) - $send_count;
            echo "
            <script>
                send_alert_container.hidden = '';
                total.innerHTML = '" . count($students) . "';
                sent.innerHTML = '" . $send_count . "';
                failed.innerHTML = '" . $failed_count . "';
            </script>
            ";
            if ($failed_count != 0) {
                echo "
                                <script>
                                    send_error_alert.hidden = '';
                                    error_mobiles.innerHTML = '" . implode(',', $failed_mobiles) . "';
                                </script>
                                ";
            } else {
                echo "
                                <script>
                                    send_error_alert.hidden = 'hidden';
                                    error_mobiles.innerHTML = '';
                                </script>
                                ";
            }
        } else {
            echo "
                <script>
                    send_alert_container.hidden = 'hidden';
                </script>
            ";
            echo "<script>alert('No Student Selected!');</script>";
        }
    }
    ?>


    <!-- Scripts -->
    <!-- Fetch Exam -->
    <script type="text/javascript">
        function fetchExam(cls) {
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
        }
    </script>

    <!-- Checkbox Select All -->
    <script type="text/javascript">
        function toggle(source) {
            checkboxes = document.getElementsByClassName('student');
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
        $('.student').on('click', function() {
            if ($('.student').not(':checked').length == 0) {
                document.getElementById('select_all').checked = true;
            } else {
                document.getElementById('select_all').checked = false;
            }
        });
    </script>
</body>

</html>