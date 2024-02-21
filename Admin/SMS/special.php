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
        max-width: 700px;
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
                <div class="col-lg-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sms_to" id="student" checked value="Student">
                        <label class="form-check-label" for="student">Student</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sms_to" id="employee" value="Employee">
                        <label class="form-check-label" for="employee">Employee</label>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5" id="cls_row">
                <div class="p-2 col-lg-3 rounded">
                    <select class="form-select" name="Class" id="class" aria-label="Default select example" onchange="fetchExam(this.value)">
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
                <div class="p-2 col-lg-3 rounded">
                    <select class="form-select" name="Section" id="sec" aria-label="Default select example">
                        <option selected disabled>-- Select Section --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-1">
                    <label for=""><b>SMS For:</b></label>
                </div>
                <div class="col-lg-3">
                    <select class="form-select" name="Type" id="type">
                        <option value="selecttype" selected disabled>-- Select SMS Type --</option>
                        <option value="New_Year">New Year</option>
                        <option value="Pongal">Pongal Wishes</option>
                        <option value="Festival">Festival Holiday</option>
                        <option value="Rain">Rain Holiday</option>
                        <option value="Reopen">School Reopen</option>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-1">
                    <label for=""><b>Text:</b></label>
                </div>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="Text" id="text">
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-lg-5">
                <label for="" style="color:red;font-size:large">
                    <strong>Instructions : </strong>
                    <ol>
                        <li>New Year: Enter Year (yyyy)</li>
                        <li>Pongal Wishes: No Text</li>
                        <li>Festival Holiday: Enter No.of Days,Festival Name (Ex:3days,Ugadi)</li>
                        <li>Rain Holiday: No Text</li>
                        <li>School Reopen: Enter Date of Reopen (dd-mm-yyyy)</li>
                    </ol>
                </label>
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
            <div class="col-lg-3">
                <h3><b>Occational SMS</b></h3>
            </div>
        </div>
    </div>
    <div class="container table-container" id="table-container">
        <table class="table table-striped table-hover" border="1">
            <thead>
                <th>S.No</th>
                <th>Id No.</th>
                <th>Name</th>
                <th>SMS Link</th>
                <th>Action <span style="margin:5px;"></span><input type="checkbox" id="select_all" onclick="toggle(this)">Select All</th>
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
                    function getTemplate($name, $txt1, $txt2 = "")
                    {
                        $templates = array(
                            "New_Year" => "Dear sir/Madam,Victory wishes you a happy New year {#var#}.May this new year bring you happy and prosperity to your family.Principal,Victory HS,KDR",
                            "Pongal" => "Dear {#var#}“Wishing you and your family lots of happiness and sweet surprises this Makar Sankranti!” to All our students and their parents-VICTORY SCHOOLS KODUR",
                            "Festival" => "Dear sir,The school is declared holiday for {#var#} on account of {#var#} festival.Principal,Victory highschool,kodur.",
                            "Rain" => "Dear Sir/Madam, Today is declared holiday because of heavy rains.Kindly inform your child {#var#} .Principal,Victory highschool,kodur.",
                            "Reopen" => "Dear Sir/Madam, it is to inform you that the school will open on {#var#}.Kindly inform your child {#var#} .Principal,Victory highschool,kodur."
                        );
                        foreach (array_keys($templates) as $temp_name) {
                            if ($name == $temp_name) {
                                switch ($temp_name) {
                                    case 'New_Year':
                                        $temp_text = "Dear sir/Madam,Victory wishes you a happy New year " . $txt1 . ".May this new year bring you happy and prosperity to your family.Principal,Victory HS,KDR";
                                        break;
                                    case 'Pongal':
                                        $temp_text = "Dear sir/Madam“Wishing you and your family lots of happiness and sweet surprises this Makar Sankranti!” to All our students and their parents-VICTORY SCHOOLS KODUR";
                                        break;
                                    case 'Festival':
                                        $temp_text = "Dear sir,The school is declared holiday for " . $txt1 . " on account of " . $txt2 . " festival.Principal,Victory highschool,kodur.";
                                        break;
                                    case 'Rain':
                                        $temp_text = "Dear Sir/Madam, Today is declared holiday because of heavy rains.Kindly inform your child " . $txt1 . " .Principal,Victory highschool,kodur.";
                                        break;
                                    case 'Reopen':
                                        $temp_text = "Dear Sir/Madam, it is to inform you that the school will open on " . $txt1 . ".Kindly inform your child " . $txt2 . " .Principal,Victory highschool,kodur.";
                                        break;
                                }
                            }
                        }
                        return $temp_text;
                    }
                    if (isset($_POST['show'])) {
                        $sms_to = $_POST['sms_to'];
                        echo "<script>document.getElementById('" . strtolower($sms_to) . "').checked = true;</script>";
                        if ($sms_to == "Student") {
                            echo "<script>
                                let cls_row = document.getElementById('cls_row');
                                if(cls_row.hidden){cls_row.hidden = '';}
                            </script>";
                            if ($_POST['Class']) {
                                $class = $_POST['Class'];
                                echo "<script>document.getElementById('class').value = '" . $class . "'</script>";
                                if ($_POST['Section']) {
                                    $section = $_POST['Section'];
                                    echo "<script>document.getElementById('sec').value = '" . $section . "'</script>";
                                } else {
                                    echo "<script>alert('Please Select Section!')</script>";
                                }
                            } else {
                                echo "<script>alert('Please Select Class!')</script>";
                            }
                        } else {
                            echo "<script>
                                let cls_row = document.getElementById('cls_row');
                                if(!cls_row.hidden){cls_row.hidden = 'hidden';}
                            </script>";
                        }
                        if ($_POST['Type']) {
                            $type = $_POST['Type'];
                            echo "<script>document.getElementById('type').value = '" . $type . "'</script>";
                            $text_status = true;
                            if ($type == "New_Year" || $type == "Festival" || $type == "Reopen") {
                                if ($_POST['Text']) {
                                    $txt = $_POST['Text'];
                                    echo "<script>document.getElementById('text').value = '" . $txt . "'</script>";
                                    $text_status = true;
                                } else {
                                    $text_status = false;
                                    echo "<script>alert('Please Enter Text!')</script>";
                                }
                            }
                            if ($text_status) {

                                //Arrays
                                $mobiles = array();
                                if ($sms_to == "Student") {
                                    if (isset($class) && isset($section)) {
                                        $mobiles_query = mysqli_query($link, "SELECT Id_No,First_Name,Mobile FROM `student_master_data` WHERE Stu_Class = '$class' AND Stu_Section = '$section' ORDER BY Id_No");
                                        while ($mobile_row = mysqli_fetch_assoc($mobiles_query)) {
                                            if (str_contains($mobile_row['Mobile'], ',')) {
                                                $mobiles[$mobile_row['Id_No']] = array($mobile_row['First_Name'], explode(',', $mobile_row['Mobile'], 2)[0]);
                                            } else {
                                                $mobiles[$mobile_row['Id_No']] = array($mobile_row['First_Name'], $mobile_row['Mobile']);
                                            }
                                        }
                                    }
                                } else if ($sms_to == "Employee") {
                                    $mobiles_query = mysqli_query($link, "SELECT Emp_Id,Emp_First_Name,Mobile FROM `employee_master_data` WHERE Status = 'Working' ORDER BY Emp_Id");
                                    while ($mobile_row = mysqli_fetch_assoc($mobiles_query)) {
                                        if (str_contains($mobile_row['Mobile'], ',')) {
                                            $mobiles[$mobile_row['Emp_Id']] = array($mobile_row['Emp_First_Name'], explode(',', $mobile_row['Mobile'], 2)[0]);
                                        } else {
                                            $mobiles[$mobile_row['Emp_Id']] = array($mobile_row['Emp_First_Name'], $mobile_row['Mobile']);
                                        }
                                    }
                                }
                                $i = 1;
                                foreach (array_keys($mobiles) as $id) {
                                    switch ($type) {
                                        case 'New_Year':
                                            $text = getTemplate($type, $txt);
                                            break;
                                        case 'Pongal':
                                            $text = getTemplate($type, $mobiles[$id][0]);
                                            break;
                                        case 'Festival':
                                            $txt1 = explode(',', $txt);
                                            $text = getTemplate($type, $txt1[0], $txt1[1]);
                                            break;
                                        case 'Rain':
                                            $text = getTemplate($type, $mobiles[$id][0]);
                                            break;
                                        case 'Reopen':
                                            $text = getTemplate($type, $txt, $mobiles[$id][0]);
                                            break;
                                    }
                                    $text = urlencode($text);
                                    echo '
                                    <tr>
                                    <td>' . $i . '</td>
                                    <td>' . $id . '</td>
                                    <td>' . $mobiles[$id][0] . '</td>
                                    <td><a href="https://api.smslane.com/api/v2/SendSMS?SenderId=VICKDR&Message=' . $text . '&MobileNumbers=' . $details[$id][1] . '&ApiKey=RamaVic%401970&ClientId=kakarlavic%40gmail.com" class="sms_link">' . $mobiles[$id][1] . '</a></td>
                                    <td><input type="checkbox" class="person" id="person" name="person[' . $id . ']" value="' . $details[$id][1] . '"></td>
                                    </tr>
                                    ';
                                    /*
                                    echo $id . '&nbsp;' . $mobiles[$id][0] . '' . '&nbsp;';
                                    echo '<a href="https://api.smslane.com/api/v2/SendSMS?SenderId=VICKDR&Message=' . $text . '&MobileNumbers='.$mobiles[$id][1].'&ApiKey=RamaVic%401970&ClientId=kakarlavic%40gmail.com" class="sms_link">' . $mobiles[$id][1] . '</a>';
                                    echo '<br>';
                                    */
                                    $i++;
                                }
                            }
                        } else {
                            echo "<script>alert('Please Select SMS Type!')</script>";
                        }
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>


    <!-- Scripts -->

    <!-- Show/Hide Class Row -->
    <script type="text/javascript">
        let class_row = document.getElementById('cls_row');
        document.body.addEventListener('change', function(e) {
            let target = e.target;
            switch (target.id) {
                case 'student':
                    if (class_row.hidden) {
                        class_row.hidden = '';
                    }
                    break;
                case 'employee':
                    if (!class_row.hidden) {
                        class_row.hidden = 'hidden';
                    }
                    break;
            }
        });
    </script>

    <!-- Scripts -->

    <!-- Checkbox Select All -->
    <script type="text/javascript">
        function toggle(source) {
            checkboxes = document.getElementsByClassName('person');
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
        $('.person').on('click', function() {
            if ($('.person').not(':checked').length == 0) {
                document.getElementById('select_all').checked = true;
            } else {
                document.getElementById('select_all').checked = false;
            }
        });
    </script>

    <!-- Send SMS -->
    <script>
        async function send(url){
            response = await fetch(url)
        }
        $('#send').on('click', () => {
            absentees = []
            $(".person:checked").each(function() {
                absentees.push($(this).parent().siblings().eq(3).children().attr('href'));
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