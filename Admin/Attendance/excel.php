<?php
include '../../link.php';
session_start();
if (!$_SESSION['Admin_Id_No']) {
    echo "<script>
  alert('Admin Id Not Rendered');
  location.replace('../admin_login.php');
  </script>
  </script>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title>Victory Schools</title>
    <link rel="shortcut icon" href="/Victory/Images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/Victory/css/sidebar-style.css" />
    <!-- Bootstrap Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Boxiocns CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<style>
    body {
        height: 1000px;
    }

    .file {
        cursor: pointer;
        position: absolute;
    }

    .img-row {
        padding: 1%;
        border: 4px dashed grey;
    }

    .img-container i {
        font-size: 5rem;
    }

    @media screen and (max-width:600px) {
        .img-container i {
            margin-left: 150px;
            font-size: 3rem;
        }

        .btn-container {
            margin-left: 150px;
        }

        #img_type {
            width: 200px;
            margin-left: 30%;
        }

        .instruction-container {
            width: 220px;
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

<body>
    <?php
    include '../sidebar.php';
    ?>
    <form action="" method="POST" enctype="multipart/form-data" onsubmit="return upload">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-1">
                <label for=""><b>Date:</b></label>
            </div>
            <div class="col-lg-4">
                <input type="date" class="form-control" value="<?php if (isset($date)) {
                                                                    echo $date;
                                                                } else {
                                                                    echo date('Y-m-d');
                                                                } ?>" name="Date" id="date" required>
            </div>
        </div>

        <div class="container instruction-container">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-5">
                    <strong style="color:red;">Don't Close or Refresh.Please Wait While Processing Till Alert!!</strong>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-lg-5">
                    <h5><strong>Instructions</strong></h5>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <label for="home">Excel File Format</label>
                    <ul>
                        <li>No Headings (Only Data)</li>
                        <li>Column1: Id_No</li>
                        <li>Column2: AM</li>
                        <li>Column3: PM</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container img-container">
            <div class="row img-row justify-content-center mt-5">
                <div class="col-lg-2">
                    <i class="bx bx-file"></i>
                    <p>
                        <input type="file"class="btn btn-warning" class="file" name="excel" required>
                    </p>
                </div>
            </div>
        </div>
        <div class="container btn-container">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-2">
                    <button class="btn btn-primary upload" type="submit" name="upload">
                        <i class="bx bx-upload"></i>
                        Upload</button>
                </div>
            </div>
        </div>
    </form>
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
    if (isset($_POST['upload'])) {
        $date = $_POST['Date'];
        echo "<script>document.getElementById('date').value = '" . $date . "';</script>";

        $date = format_date($date);
        //Excel Reader
        $fileName = $_FILES["excel"]["name"];
        $fileExtension = explode('.', $fileName);
        $fileExtension = strtolower(end($fileExtension));
        $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

        $targetDirectory = "../att_uploads/" . $newFileName;
        move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

        require '../../Miscellaneous/excelReader/excel_reader2.php';
        require '../../Miscellaneous/excelReader/SpreadsheetReader.php';

        $reader = new SpreadsheetReader($targetDirectory);
        $status = false;
        foreach ($reader as $key => $row) {
            //Daily Attendance
            $id = $row[0];
            $am = $row[1];
            $pm = $row[2];
            if (mysqli_query($link, "INSERT INTO `attendance_daily` VALUES('', '$id', '$date','$am','$pm')")) {
                $status = true;
            } else {
                $status = false;
            }
        }
        if ($status) {
            echo
            "
			<script>
			alert('Attendance Uploaded Successfully for ".$date."!');
			document.location.href = '';
			</script>
			";
        } else {
            echo
            "
			<script>
			alert('Attendance Upload Failed for ".$date."!');
			document.location.href = '';
			</script>
			";
        }
    }

    ?>
</body>

</html>