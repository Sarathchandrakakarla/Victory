<?php
include '../../link.php';
session_start();
if (!$_SESSION['Admin_Id_No']) {
    echo "<script>
  alert('Admin Id Not Rendered');
  location.replace('admin_login.php');
  </script>
  </script>";
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
                    </ul>
                </div>
            </div>
        </div>
        <div class="container img-container">
            <div class="row img-row justify-content-center mt-5">
                <div class="col-lg-2">
                    <i class="bx bx-file"></i>
                    <p>
                        <input type="file" class="btn btn-warning" class="file" name="excel" required>
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
    if (isset($_POST['upload'])) {
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
            $details_sql = mysqli_query($link, "SELECT First_Name FROM `student_master_data` WHERE Id_No = '$id'");
            if (mysqli_num_rows($details_sql) > 0) {
                while ($details_row = mysqli_fetch_assoc($details_sql)) {
                    $name = $details_row['First_Name'];
                }
                $password = "VHST" . rand(1111, 9999);
                $pass_hash = password_hash($password, PASSWORD_DEFAULT);
                if (mysqli_num_rows(mysqli_query($link, "SELECT * FROM `student` WHERE Id_No = '$id'")) == 0) {
                    if (mysqli_query($link, "INSERT INTO `student` VALUES('', '$id', '$name','$password','$pass_hash')")) {
                        $status = true;
                    } else {
                        $status = false;
                        break;
                    }
                } else {
                    $status = true;
                }
            }
        }
        if ($status) {
            echo
            "
			<script>
			alert('Students Credentials Inserted Successfully!');
			</script>
			";
        } else {
            echo
            "
			<script>
			alert('Students Credentials Insertion Failed!');
			</script>
			";
        }
    }

    ?>
</body>

</html>