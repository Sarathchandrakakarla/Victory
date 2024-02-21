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

    <!-- Excel Links -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>

    <!-- Bootstrap Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<style>
    body {
        overflow-x: scroll;
    }

    .table-container {
        max-width: 1200px;
        max-height: 500px;
        overflow-x: scroll;
        display: none;
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
                    <select class="form-select" name="Class" id="cls" aria-label="Default select example">
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
            <div class="row justify-content-center mt-3">
                <div class="col-lg-4" style="color: red;">
                    NOTE: Please Press Show before exporting to Excel
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-4">
                    <button class="btn btn-primary" name="show">Show</button>
                    <button class="btn btn-success" onclick="return false;" id="export">Export To Excel</button>
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
                        Now, You Can Export to Excel
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container table-container" id="table-container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th style="text-align: center;font-size:20px;color:red" colspan="4">VICTORY HIGH SCHOOL</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th style="text-align: center;font-size:20px;color:red" colspan="3">Marks Entry Slip</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th style="text-align: left;font-size:20px;color:red" colspan="2">Name of the Examination:</th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th style="text-align: left;font-size:20px;color:blue" colspan="2">Name of the Class: <span id="class"></span></th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th style="text-align: left;font-size:20px;color:blue" colspan="2">SUBJECT</th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th style="text-align: left;font-size:20px;color:blue" colspan="2">MAX-MARKS</th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th style="text-align: left;font-size:20px;color:blue" colspan="2">NAME OF THE TEACHER</th>
                    <th></th>
                </tr>
                <tr>
                    <th style="text-align: center;font-size:20px;color:blue">S.NO</th>
                    <th style="text-align: center;font-size:20px;color:blue">ID.NO</th>
                    <th style="text-align: center;font-size:20px;color:blue">Student Name</th>
                    <th style="text-align: center;font-size:20px;color:blue">Marks</th>
                </tr>
            </thead>
            <?php
            if (isset($_POST['show'])) {
                if ($_POST['Class']) {
                    $class = $_POST['Class'];
                    echo '<script>document.getElementById("cls").value = "' . $class . '";</script>';
                    if ($_POST['Section']) {
                        $section = $_POST['Section'];
                        echo '<script>document.getElementById("sec").value = "' . $section . '";</script>';
                        $sql = mysqli_query($link, "SELECT Id_No,First_Name FROM `student_master_data` WHERE Stu_Class = '$class' AND Stu_Section = '$section'");
                        echo '<script>document.getElementById("class").innerHTML = "' . $class . ' ' . $section . '"</script>';
                        $i = 1;
                        if (mysqli_num_rows($sql) == 0) {
                            echo "<script>alert('Invalid Class & Section!!')</script>";
                        } else {
                            while ($row = mysqli_fetch_assoc($sql)) {
                                echo '
                                <tr>
                                    <td>' . $i . '</td>
                                    <td>' . $row['Id_No'] . '</td>
                                    <td>' . $row['First_Name'] . '</td>
                                </tr>
                                ';
                                $i++;
                            }
                            echo "<script>document.getElementById('alert-container').style.display = 'block';</script>";
                        }
                    } else {
                        echo "<script>alert('Please Select Section!!')</script>";
                    }
                } else {
                    echo "<script>alert('Please Select Class!!')</script>";
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
            window.frames["print_frame"].document.body.innerHTML = "<h2 style='text-align:center;'><?php echo $class; ?> Student Details</h2>";
            window.frames["print_frame"].document.body.innerHTML += document.querySelector('.table-container').innerHTML;
            window.frames["print_frame"].window.focus();
            window.frames["print_frame"].window.print();
        }
    </script>

    <!-- Export Table to Excel -->
    <script type="text/javascript">
        $('#export').on('click', function() {
            stuclass = '<?php echo $class; ?>';
            stusection = '<?php echo $section; ?>';
            filename = stuclass + stusection + "_Marks_Slip";
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
</body>

</html>