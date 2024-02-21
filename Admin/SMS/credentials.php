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
                <div class="p-2 col-lg-4 rounded">
                    <select class="form-select" name="Class" id="class" aria-label="Default select example">
                        <option selected disabled>-- Select Class --</option>
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
        </div>
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-3">
                    <button class="btn btn-primary" type="submit" name="show">Show</button>
                    <button class="btn btn-warning" type="reset" onclick="hideTable()">Clear</button>
                    <button class="btn btn-success" name="send" id="send" onclick="return false;">Send</button>
                </div>
            </div>
        </div>
    </form>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-4">
                <h3><b>Send SMS of Credentials</b></h3>
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
                <th>Password</th>
                <th>SMS Link</th>
                <th>Action <span style="margin:5px;"></span><input type="checkbox" id="select_all" onclick="toggle(this)">Select All</th>
            </thead>
            <tbody id="tbody">
                <tr>
                    <?php
                    if (isset($_POST['show'])) {
                        if($_POST['Class']){
                            $class = $_POST['Class'];
                            echo "<script>document.getElementById('class').value='$class';</script>";
                            if($_POST['Section']){
                                $section = $_POST['Section'];
                                echo "<script>document.getElementById('sec').value='$section';</script>";
                                $mobile_sql = mysqli_query($link,"SELECT Id_No,Mobile FROM `student_master_data` WHERE Stu_Class = '$class' AND Stu_Section = '$section'");
                                $mobiles = array();
                                if(mysqli_num_rows($mobile_sql) > 0){
                                    while($mobile_row = mysqli_fetch_assoc($mobile_sql)){
                                        $mobiles[$mobile_row['Id_No']] = $mobile_row['Mobile'];
                                    }
                                }
                                $sql = mysqli_query($link,"SELECT Id_No,Stu_Name,Stu_Password AS Password FROM student WHERE Id_No IN (SELECT Id_No FROM `student_master_data` WHERE Stu_Class = '$class' AND Stu_Section = '$section')");
                                if (mysqli_num_rows($sql) == 0) {
                                    echo "<script>alert('Class or Section Not Available!')</script>";
                                } else {
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($sql)) {
                                        if (str_contains($mobiles[$row['Id_No']], ',')) {
                                            $mobile = explode(',', $mobiles[$row['Id_No']], 2)[0];
                                        } else if (str_contains($mobiles[$row['Id_No']], ' ')) {
                                            $mobile = explode(' ', $mobiles[$row['Id_No']], 2)[0];
                                        }
                                        else{
                                            $mobile = $mobiles[$row['Id_No']];
                                        }
                                        $text = "Dear student,The credentials to login VICTORYSCHOOLS portal are as follows.Name :". $row['Stu_Name'] ." ,Username:". $row['Id_No'] .",Password:". $row['Password'] .".Change pass word once you login.Principal,Victory schools,KDR";
                                        $text = urlencode($text);
                                        echo '<tr>
                                        <td style="padding:5px;">' . $i . '</td>
                                        <td style="padding:5px;">' . $row['Id_No'] . '</td>
                                        <td style="padding-left:5px;">' . $row['Stu_Name'] . '</td>
                                        <td style="padding-left:5px;">' . $class . ' ' . $section . '</td>
                                        <td style="padding-left:5px;padding-right:5px;">' . $row['Password'] . '</td>
                                        <td><a href="https://api.smslane.com/api/v2/SendSMS?SenderId=VICKDR&Message='.$text.'&MobileNumbers='.$mobile.'&ApiKey=RamaVic%401970&ClientId=kakarlavic%40gmail.com" class="sms_link">' . $mobile . '</a></td>
                                        <td><input type="checkbox" class="student" id="student" name="student[' . $id . ']" value="'.$mobile.'"></td>
                                        </tr>';
                                        $i++;
                                    }
                                }
                            }
                            else{
                                echo "<script>alert('Please Select Section!')</script>";
                            }
                        }
                        else{
                            echo "<script>alert('Please Select Class!')</script>";
                        }
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>


    <!-- Scripts -->

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

    <!-- Send SMS -->
    <!--
    <script>
        $('#send').on('click', () => {
            absentees = []
            $(".student:checked").each(function() {
                absentees.push($(this).parent().siblings().eq(4).children().attr('href'));
                //mywin = window.open($(this).parent().siblings().eq(4).children().attr('href'), '_blank')
            });
            if (absentees.length > 0) {
                absentees.forEach((stu) => {
                    mywin = window.open(stu, '_blank')
                })
            }
            /*
            $('.sms_link').each(function() {
                mywin = window.open($(this).attr('href'), '_blank')
            });
            */
        });
    </script>
    -->
    <script>
        async function send(url){
            var response = await fetch( url);
            console.log(response.json());
        }
        $('#send').on('click', () => {
            absentees = []
            $(".student:checked").each(function() {
                absentees.push($(this).parent().siblings().eq(5).children().attr('href'));
                //mywin = window.open($(this).parent().siblings().eq(4).children().attr('href'), '_blank')
            });
            if (absentees.length > 0) {
                absentees.forEach((stu) => {
                    //console.log(stu)
                    send(stu)
                    //mywin = window.open(stu, '_blank')
                })
                alert('All SMS Sent Successfully!')
            } else{
                alert('No Student Selected!')
            }
            /*
            $('.sms_link').each(function() {
                mywin = window.open($(this).attr('href'), '_blank')
            });
            */
        });
    </script>
</body>

</html>