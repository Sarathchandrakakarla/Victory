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
                <label for="add_by" class="col-sm-2 col-form-label">Type of Fee: </label>
                <div class="p-2 col-lg-3 rounded">
                    <select class="form-select" name="Type" id="type" aria-label="Default select example">
                        <option value="selectfeetype" selected disabled>-- Select Fee Type --</option>
                        <option value="School Fee">School Fee</option>
                        <option value="Admission Fee">Admission Fee</option>
                        <option value="Computer Fee">Computer Fee</option>
                        <option value="Vehicle Fee">Vehicle Fee</option>
                        <option value="Examination Fee">Examination Fee</option>
                        <option value="Book Fee">Book Fee</option>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center" id="class_row">
                <div class="row justify-content-center">
                    <div class="p-2 col-sm-2 rounded">
                        <label>Class: </label>
                    </div>
                    <div class="p-2 col-lg-3 rounded">
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
                </div>
                <div class="row justify-content-center">
                    <div class="p-2 col-sm-2 rounded">
                        <label>Section: </label>
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
            </div>
            <div class="row justify-content-center" id="route_row" hidden>
                <div class="p-2 col-sm-2 rounded">
                    <label>Route: </label>
                </div>
                <div class="p-2 col-lg-3 rounded">
                    <select class="form-select" name="Route" id="route" aria-label="Default select example">
                        <option selected disabled>-- Select Route --</option>
                        <?php
                        $max_fee = array();
                        $route_query = mysqli_query($link, "SELECT v.Van_Route,f.Fee FROM van_route v,actual_fee f WHERE v.Van_Route=f.Route");
                        while ($route_row = mysqli_fetch_assoc($route_query)) {
                            $max_fee[$route_row['Van_Route']] = $route_row['Fee'];
                            echo "<option value='" . $route_row['Van_Route'] . "'>" . $route_row['Van_Route'] . " - " . $route_row['Fee'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <label for="exam_name" class="col-lg-2 col-form-label">Amount: </label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="Amount" id="amount" required>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <label for="exam_name" class="col-lg-2 col-form-label">Due Date: </label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" name="Date" id="date" required>
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
    <div class="container" id="alert-container" style="display: none;">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-4">
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                    <div>
                        Now, You Can Send SMS
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-lg-3" style="color: red;">
            NOTE: Please Press Show before Sending SMS
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-5">
                <h3><b>Send SMS of Fee Balances</b></h3>
            </div>
        </div>
    </div>
    <div class="container table-container" id="table-container">
        <table class="table table-striped table-hover" border="1">
            <thead>
                <th>S.No</th>
                <th>Id No.</th>
                <th>Name</th>
                <th>Balance</th>
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
                    if (isset($_POST['show'])) {
                        //Arrays
                        $ids = array();
                        $names = array();
                        $mobiles = array();
                        $total = array();
                        $paid = array();
                        $balances = array();

                        $amount = $_POST['Amount'];
                        $date = $_POST['Date'];
                        echo "<script>document.getElementById('amount').value = '" . $amount . "';
                                document.getElementById('date').value = '" . $date . "'</script>";

                        if ($_POST['Type']) {
                            $type = $_POST['Type'];
                            echo "<script>document.getElementById('type').value = '" . $type . "'</script>";
                            if ($type == "Vehicle Fee") {
                                echo "<script>
                                document.getElementById('class_row').hidden = 'hidden';
                                document.getElementById('route_row').hidden = '';
                                </script>";
                                if ($_POST['Route']) {
                                    $route = $_POST['Route'];
                                    echo "<script>document.getElementById('route').value = '" . $route . "'</script>";
                                    if ($amount > $max_fee[$route]) {
                                        echo "<script>alert('Sorry! Maximum fee limit exceeded for this route.')</script>";
                                    } else {
                                        $query1 = mysqli_query($link, "SELECT * FROM `student_master_data` WHERE Van_Route = '$route'");
                                        while ($row1 = mysqli_fetch_assoc($query1)) {
                                            array_push($ids, $row1['Id_No']);
                                            $names[$row1['Id_No']] = $row1['First_Name'];
                                            if (str_contains($row1['Mobile'], ',')) {
                                                $mobiles[$row1['Id_No']] = explode(',', $row1['Mobile'], 2)[0];
                                            } else {
                                                $mobiles[$row1['Id_No']] = $row1['Mobile'];
                                            }
                                            if ($row1['Route'] != '' && $row1['Route'] != NULL && $row1['Route'] != '0' && $row1['Route'] != 'Drop') {
                                                if (mysqli_num_rows(mysqli_query($link, "SELECT First_Name FROM `stu_fee_master_data` WHERE Id_No='" . $row1['Id_No'] . "' AND Type='Vehicle Fee'")) == 0) {
                                                    echo "<script>alert('" . $id . " Not Available in Stu Fee Master Data! ')</script>";
                                                }
                                            }
                                        }
                                        foreach ($ids as $id) {
                                            //Fetching Committed Fees of Each Student
                                            $query2 = mysqli_query($link, "SELECT Total FROM `stu_fee_master_data` WHERE Id_No = '$id' AND Type = 'Vehicle Fee'");
                                            if (mysqli_num_rows($query2) != 0) {
                                                while ($row2 = mysqli_fetch_assoc($query2)) {
                                                    $total[$id] = $row2['Total'];
                                                }
                                            }

                                            //Fetching Paid Fees of Each Student
                                            $query3 = mysqli_query($link, "SELECT SUM(Fee) AS Paid FROM `stu_paid_fee` WHERE Id_No = '$id' AND Type = '$type' GROUP BY Id_No");
                                            if (mysqli_num_rows($query3) == 0) {
                                                $paid[$id] = '0';
                                            } else {
                                                while ($row3 = mysqli_fetch_assoc($query3)) {
                                                    $paid[$id] = $row3['Paid'];
                                                }
                                            }

                                            //Calculating Balances of Each Student
                                            if ((int)$paid[$id] == 0) {
                                                $balances[$id] = (int)($total[$id]);
                                            } else {
                                                $balances[$id] = (int)($total[$id]) - (int)($paid[$id]);
                                            }
                                        }
                                        //Generating SMS Text for Each Student
                                        $i = 1;
                                        foreach ($ids as $id) {
                                            if ($balances[$id] != 0 && $balances[$id] >= $amount) {
                                                $text = "Dear sir/Madam,There is a balance of amount Rs" . $balances[$id] . "towards " . $type . " of your child " . $names[$id] . " studying " . $class . " " . $section . " .Kindly pay before date " . format_date($date) . " .Principal,Victory highschool,kodur.";
                                                $mobiles[$id] = rtrim($mobiles[$id]);
                                                echo '
                                            <tr>
                                            <td>' . $i . '</td>
                                            <td>' . $id . '</td>
                                            <td>' . $names[$id] . '</td>
                                            <td>' . $balances[$id] . '</td>
                                            <td><a
                                            href="https://api.smslane.com/api/v2/SendSMS?SenderId=VICKDR&Message=' . $text . '&MobileNumbers=' . $mobiles[$id] . '&ApiKey=RamaVic%401970&ClientId=kakarlavic%40gmail.com" class="sms_link">' . $mobiles[$id] . '
                                        </a></td>
                                        <td><input type="checkbox" class="student" id="student" name="student[' . $id . ']" value="' . $details[$id][1] . '"></td>
                                            </tr>
                                            ';
                                                $i++;
                                                /*
                                            echo '<a
                                        href="https://api.smslane.com/api/v2/SendSMS?SenderId=VICKDR&Message=' . $text . '&MobileNumbers=' . $mobiles[$id] . '&ApiKey=RamaVic%401970&ClientId=kakarlavic%40gmail.com" class="sms_link">' . $mobiles[$id] . '
                                    </a>';
                                    */
                                            }
                                        }
                                        echo "<script>document.getElementById('alert-container').style.display = 'block';</script>";
                                    }
                                } else {
                                    echo "<script>alert('Please Select Route!')</script>";
                                }
                            } else {
                                echo "<script>
                                document.getElementById('class_row').hidden = '';
                                document.getElementById('route_row').hidden = 'hidden';
                                </script>";
                                if ($_POST['Class']) {
                                    $class = $_POST['Class'];
                                    echo "<script>document.getElementById('class').value = '" . $class . "'</script>";
                                    if ($_POST['Section']) {
                                        $section = $_POST['Section'];
                                        echo "<script>document.getElementById('sec').value = '" . $section . "'</script>";
                                        //Fetching Id Nos of Students of that Class and Section
                                        $query1 = mysqli_query($link, "SELECT * FROM `student_master_data` WHERE Stu_Class = '$class' AND Stu_Section = '$section'");
                                        while ($row1 = mysqli_fetch_assoc($query1)) {
                                            array_push($ids, $row1['Id_No']);
                                            $names[$row1['Id_No']] = $row1['First_Name'];
                                            if (str_contains($row1['Mobile'], ',')) {
                                                $mobiles[$row1['Id_No']] = explode(',', $row1['Mobile'], 2)[0];
                                            } else {
                                                $mobiles[$row1['Id_No']] = $row1['Mobile'];
                                            }
                                        }
                                        foreach ($ids as $id) {
                                            //Fetching Committed Fees of Each Student
                                            $query2 = mysqli_query($link, "SELECT Total FROM `stu_fee_master_data` WHERE Id_No = '$id' AND Type = '$type'");
                                            if (mysqli_num_rows($query2) == 0) {
                                                if ($type != "Admission Fee") {
                                                    echo "<script>alert('" . $id . " Not Available in Stu Fee Master Data! ')</script>";
                                                }
                                            } else {
                                                while ($row2 = mysqli_fetch_assoc($query2)) {
                                                    $total[$id] = $row2['Total'];
                                                }
                                            }

                                            //Fetching Paid Fees of Each Student
                                            $query3 = mysqli_query($link, "SELECT SUM(Fee) AS Paid FROM `stu_paid_fee` WHERE Id_No = '$id' AND Type = '$type' GROUP BY Id_No");
                                            if (mysqli_num_rows($query3) == 0) {
                                                $paid[$id] = '0';
                                            } else {
                                                while ($row3 = mysqli_fetch_assoc($query3)) {
                                                    $paid[$id] = $row3['Paid'];
                                                }
                                            }

                                            //Calculating Balances of Each Student
                                            if ((int)$paid[$id] == 0) {
                                                $balances[$id] = (int)($total[$id]);
                                            } else {
                                                $balances[$id] = (int)($total[$id]) - (int)($paid[$id]);
                                            }
                                        }
                                        //Generating SMS Text for Each Student
                                        $i = 1;
                                        foreach ($ids as $id) {
                                            if ($balances[$id] != 0 && $balances[$id] >= $amount) {
                                                $text = "Dear sir/Madam,There is a balance of amount Rs" . $balances[$id] . "towards " . $type . " of your child " . $names[$id] . " studying " . $class . " " . $section . " .Kindly pay before date " . format_date($date) . " .Principal,Victory highschool,kodur.";
                                                $mobiles[$id] = rtrim($mobiles[$id]);
                                                echo '
                                            <tr>
                                            <td>' . $i . '</td>
                                            <td>' . $id . '</td>
                                            <td>' . $names[$id] . '</td>
                                            <td>' . $balances[$id] . '</td>
                                            <td><a
                                            href="https://api.smslane.com/api/v2/SendSMS?SenderId=VICKDR&Message=' . $text . '&MobileNumbers=' . $mobiles[$id] . '&ApiKey=RamaVic%401970&ClientId=kakarlavic%40gmail.com" class="sms_link">' . $mobiles[$id] . '
                                        </a></td>
                                        <td><input type="checkbox" class="student" id="student" name="student[' . $id . ']" value="' . $details[$id][1] . '"></td>
                                            </tr>
                                            ';
                                                $i++;
                                                /*
                                            echo '<a
                                        href="https://api.smslane.com/api/v2/SendSMS?SenderId=VICKDR&Message=' . $text . '&MobileNumbers=' . $mobiles[$id] . '&ApiKey=RamaVic%401970&ClientId=kakarlavic%40gmail.com" class="sms_link">' . $mobiles[$id] . '
                                    </a>';
                                    */
                                            }
                                        }
                                        echo "<script>document.getElementById('alert-container').style.display = 'block';</script>";
                                    } else {
                                        echo "<script>alert('Please Select Section!')</script>";
                                    }
                                } else {
                                    echo "<script>alert('Please Select Class!')</script>";
                                }
                            }
                        } else {
                            echo "<script>alert('Please Select Fee Type!')</script>";
                        }
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>


    <!-- Scripts -->
    <!-- Change Labels -->
    <script type="text/javascript">
        let route_row = document.getElementById('route_row');
        let cls_row = document.getElementById('class_row');
        document.getElementById('type').addEventListener('change', function(e) {
            type = this.value
            if (type == "Vehicle Fee") {
                if (!cls_row.hidden) {
                    cls_row.hidden = 'hidden';
                }
                if (route_row.hidden) {
                    route_row.hidden = '';
                }
            } else {
                if (cls_row.hidden) {
                    cls_row.hidden = '';
                }
                if (!route_row.hidden) {
                    route_row.hidden = 'hidden';
                }
            }
            /*
            if()
                case 'class_wise':
                    message = '';
                    if (cls_row.hidden) {
                        cls_row.hidden = '';
                    }
                    if (!route_row.hidden) {
                        route_row.hidden = 'true';
                    }
                    break;
                case 'route_wise':
                    message = "Route Wise";
                    if (!cls_row.hidden) {
                        cls_row.hidden = 'true';
                    }
                    if (route_row.hidden) {
                        route_row.hidden = '';
                    }
                    break;
                    */
        });
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
        function send(url) {
            fetchResponse = fetch(url)
        }
        $('#send').on('click', () => {
            absentees = []
            $(".student:checked").each(function() {
                absentees.push($(this).parent().siblings().eq(4).children().attr('href'));
                //mywin = window.open($(this).parent().siblings().eq(4).children().attr('href'), '_blank')
            });
            if (absentees.length > 0) {
                absentees.forEach((stu) => {
                    //console.log(stu)
                    send(stu)
                    //mywin = window.open(stu, '_blank')
                })
                alert('All SMS Sent Successfully!')
            } else {
                alert('No Student Selected!')
            }
            /*
            $('.sms_link').each(function() {
                mywin = window.open($(this).attr('href'), '_blank')
            });
            */
        });
    </script>

    <!-- Fetch Exam -->
    <script type="text/javascript">
        function fetchExam(cls) {
            $('#exam').html('');
            $.ajax({
                type: 'post',
                url: '../Reports/temp.php',
                data: {
                    class: cls
                },
                success: function(data) {
                    $("#exam").html(data);
                }
            })
        }
    </script>
</body>

</html>