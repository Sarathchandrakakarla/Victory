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

    /* 
    /* Student Marks Table
    .marks-table {
        width: 100%;
        border: 2px solid black;
    }

    .marks-table thead {
        background-color: grey;
    }

    .marks-table th,
    .marks-table td {
        text-align: center;
        border: 2px solid black;
    } */
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
                <div class="col-lg-3">
                    <button class="btn btn-primary" type="submit" name="show">Show</button>
                    <button class="btn btn-warning" type="reset" onclick="hideTable()">Clear</button>
                    <button class="btn btn-success" name="send" id="send" onclick="Send();return false;">Send</button>
                </div>
            </div>
        </div>
    </form>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-4">
                <h3><b>Send SMS of Marks</b></h3>
            </div>
        </div>
    </div>
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
                if (isset($_POST['show'])) {
                    $class_type = $_POST['class_type'];
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
                                if (mysqli_num_rows($query4) != 0) {
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
                                                    $details[$id]['Marks'][] = $row5['sub' . $sub];
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
                                        $html = "<!DOCTYPE html>
                                        <html>
                                            <head></head>
                                            <style>
                                                /* Student Marks Table */
                                                .marks-table {
                                                    width: 100%;
                                                }

                                                .marks-table .header {
                                                    font-weight:bold;
                                                }

                                                .marks-table td {
                                                    text-align: center;
                                                    width:20%;
                                                }
                                            </style>
                                            <body>";
                                        $html .= '
                                        <h1 style="text-align:center;">Victory E.M. Schools, Kodur</h1>
                                        <h3 style="text-align:center;">Progress Report</h3>
                                        <p style="margin-left:50px;">
                                        <strong>Student Name: ' . $data['Name'] . '</strong> <br/> <br/>
                                        <strong>Class: ' . $class . ' ' . $section . '</strong> <br/> <br/>
                                        <strong>Examination Name: ' . $exam . '</strong>
                                        </p>
                                        <table class="marks-table" style="width:100%;margin-top:50px;margin-left:100px;">
                                            <tbody>
                                                <tr class="header">
                                                    <td style="border-width:2px 2px 2px 2px;border-color:black;border-style:solid;">S No.</td>
                                                    <td style="border-width:2px 2px 2px 0;border-color:black;border-style:solid;">Subject</td>
                                                    <td style="border-width:2px 2px 2px 0;border-color:black;border-style:solid;">Max Marks</td>
                                                    <td style="border-width:2px 2px 2px 0;border-color:black;border-style:solid;">Obtained Marks</td>
                                                </tr>';
                                        $c = 1;
                                        foreach ($data['Marks'] as $subject => $marks) {
                                            $html .= '
                                            <tr>
                                                <td style="border-width:0 2px 2px 2px;border-color:black;border-style:solid;">' . $c . '</td>
                                                <td style="border-width:0 2px 2px 0;border-color:black;border-style:solid;">' . $subject . '</td>
                                                <td style="border-width:0 2px 2px 0;border-color:black;border-style:solid;">' . $subjects[$subject] . '</td>
                                                <td style="border-width:0 2px 2px 0;border-color:black;border-style:solid;">' . $marks . '</td>
                                            </tr>
                                            ';
                                            $c++;
                                        }
                                        $html .= '</tbody>
                                        </table>
                                        ';
                                        $html .= '
                                        <p style="margin-top:50px;margin-left:50px;">
                                            <strong>Total Marks Obtained: ' . $data['Total'] . '/' . $max_total . '</strong> <br/> <br/>
                                            <strong>Percentage: ' . $data['Percentage'] . '%</strong> <br/> <br/>
                                            <strong>Grade: ' . $data['Grade'] . '</strong>
                                        </p>
                                        ';
                                        $html .= "
                                            </body>
                                        </html>";
                                        require 'vendor/autoload.php';
                                        try {
                                            $html2pdf = new Html2Pdf($orientation = 'L',$format = 'C5');
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
                                            <td><input type="checkbox" class="student" id="student" name="student[' . $id . ']" value="' . $details[$id]['Mobile'] . '">' . $data['Mobile'] . '</td>
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
    <script>
        function Send() {
            if ($(".student:checked").length != 0) {
                document.querySelectorAll('.student:checked').forEach((s) => {
                    mobile = s.value
                    id = s.name.substring(8, s.name.length - 1)
                    url = "https://victoryschools.in/Victory/Files/" + id + ".pdf";
                    var apibody = {
                        "from": "919133663334",
                        "to": "91" + mobile,
                        "type": "template",
                        "message": {
                            "templateid": "123456",
                            "url": url
                        }
                    }
                    /* if (placeholders.length != 0) {
                        apibody.message["placeholders"] = placeholders
                    } */
                    /* fetch('https://wapi.wbbox.in/v2/wamessage/send', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'apikey': '1aa0a6ca-2ef7-11ef-ad4f-92672d2d0c2d',
                        },
                        body: JSON.stringify(apibody)
                    }) */
                })
            } else {
                alert('No Student Selected!')
            }
            /*
            details.forEach((student) => {
                mobile = student[0]
                placeholders = student[1]
                var apibody = {
                    "from": "919133663334",
                    "to": "91" + mobile,
                    "type": "template",
                    "message": {
                        "templateid": t_id.toString(),
                    }
                }
                if (placeholders.length != 0) {
                    apibody.message["placeholders"] = placeholders
                }
                if (file_url != "") {
                    apibody.message["url"] = file_url
                }
                fetch('https://wapi.wbbox.in/v2/wamessage/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'apikey': '1aa0a6ca-2ef7-11ef-ad4f-92672d2d0c2d',
                    },
                    body: JSON.stringify(apibody)
                })
            }) */
        }
    </script>
</body>

</html>