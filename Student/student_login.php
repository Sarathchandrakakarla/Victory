<?php
include '../link.php';
session_start();
$flag = "";
if (isset($_POST['Login'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $uname = validate($_POST['UserName']);
    $pass = validate($_POST['Password']);
    $sql = "SELECT * FROM `student` WHERE Id_No = '$uname'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['Id_No'];
        $stu_hash = $row['Stu_Hash'];
        if (password_verify($pass, $stu_hash)) {
            $_SESSION['Id_No'] = $id;
            $sql_ = "SELECT * FROM `student_master_data` WHERE Id_No = '$id'";
            $result_ = mysqli_query($link, $sql_);
            if (mysqli_num_rows($result_) == 1) {
                $row = mysqli_fetch_assoc($result_);
                $stu_id = $row['Id_No'];
                $stu_adm = $row['Adm_No'];
                $firstname = $row['First_Name'];
                $surname = $row['Sur_Name'];
                $fathername = $row['Father_Name'];
                $mothername = $row['Mother_Name'];
                $dob = $row['DOB'];
                $gender = $row['Gender'];
                $mobile = $row['Mobile'];
                $aadhar = $row['Aadhar'];
                $class = $row['Stu_Class'];
                $section = $row['Stu_Section'];
                $religion = $row['Religion'];
                $caste = $row['Caste'];
                $category = $row['Category'];
                $houseno = $row['House_No'];
                $area = $row['Area'];
                $village = $row['Village'];
                $doj = $row['DOJ'];
                $previous = $row['Previous_School'];
                $van_route = $row['Van_Route'];
                $referred_by = $row['Referred_By'];
                $siblings = $row['Siblings'];
                $_SESSION['Id_No'] = $id;
                $_SESSION['Stu_Adm_No'] = $stu_adm;
                $_SESSION['First_Name'] = $firstname;
                $_SESSION['Sur_Name'] = $surname;
                $_SESSION['Father_Name'] = $fathername;
                $_SESSION['Mother_Name'] = $mothername;
                $_SESSION['DOB'] = $dob;
                $_SESSION['Gender'] = $gender;
                $_SESSION['Mobile'] = $mobile;
                $_SESSION['Aadhar'] = $aadhar;
                $_SESSION['Stu_Class'] = $class;
                $_SESSION['Stu_Section'] = $section;
                $_SESSION['Religion'] = $religion;
                $_SESSION['Caste'] = $caste;
                $_SESSION['Category'] = $category;
                $_SESSION['House_No'] = $houseno;
                $_SESSION['Area'] = $area;
                $_SESSION['Village'] = $village;
                $_SESSION['DOJ'] = $doj;
                $_SESSION['Previous_School'] = $previous;
                $_SESSION['Van_Route'] = $van_route;
                $_SESSION['Referred_By'] = $referred_by;
                $_SESSION['Siblings'] = $siblings;
            }
            header('Location: student_dashboard.php');
            exit;
        } else {
            $flag = "password";
            /*
                echo "<script>alert('Incorrect Password');
                    </script>";
            */
        }
    } else {
        $flag = "username";
        /*
            echo "<script>alert('Incorrect Username');
                    </script>";
            */
    }
} else {
    echo "<script>alert('variable 'Login is not declared');
            </script>";
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="../Images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <!-- Bootstrap Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Victory EM School</title>
</head>
<style>
    body {
        background: #1abc9c;
    }

    #hide {
        position: absolute;
        text-align: right;
        margin: -3% 26%;
        font-size: 20px;
        color: #1abc9c;
        cursor: pointer;
    }

    @media screen and (max-width:920px) {
        #hide {
            position: absolute;
            text-align: right;
            margin: -13% 74%;
            font-size: 20px;
        }
    }

    @media screen and (max-width:500px) {
        footer {
            bottom: -10%;
        }
    }

    @media screen and (max-height:600px){
        footer{
            bottom: -200px;
        }
    }
</style>

<body>
    <nav>
        <div class="logo">
            <img src="../Images/Victory Logo.png" alt="..." width="70px">
        </div>
        <div class="heading">
            <h3>Victory Schools, Kodur</h3>
        </div>
        <input type="checkbox" id="click" />
        <label for="click" class="menu-btn">
            <i class="fas fa-bars"></i>
        </label>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../about.html">About</a></li>
            <li><a href="../Gallery/gallery.html">Gallery</a></li>
            <li><a href="../contact.html">Contact</a></li>
            <li>
                <a class="active" href="#">Login</a>
                <ul class="login-sub-menu sub-menu">
                    <li><a href="../Admin/admin_login.php">Admin Login</a></li>
                    <li><a class="active" href="student_login.php">Student Login</a></li>
                    <li><a href="../Faculty/faculty_login.php">Faculty Login</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="container col-lg-4">
        <div class="wrapper">
            <div class="title p-2"><span>Student Login</span></div>
            <form action="" method="post">
                <?php if ($flag == "password") { ?>
                    <div class="row">
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <div id="alert">
                                Incorrect Password
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($flag == "username") { ?>
                    <div class="row">
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <div id="alert">
                                Incorrect Username
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="User Name" id="user" value="<?php echo (isset($uname)) ? $uname : ''; ?>" name="UserName" oninput="this.value = this.value.toUpperCase()" required>
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" id="password" value="<?php echo (isset($pass)) ? $pass : ''; ?>" name="Password" required>
                </div>
                <span class="fas fa-eye" id="hide"></span>
                <div class="pass"><a href="forgot_password.php">Forgot password?</a></div>
                <div class="row button">
                    <input type="submit" name="Login">
                </div>
            </form>
        </div>
    </div>
    <footer>
        <div class="footer-bottom">
            <p>
                &copy;
                <?php echo date('Y'); ?>, <a href="/">Victory Schools </a>. All
                Rights Reserved.
            </p>
            <p class="company-tag">
                Developed and Maintained by <u><a href="https://sarathtechgenics.netlify.app" target="_blank">Sarath Techgenics</a></u>
            </p>
        </div>
    </footer>
</body>
<script type="text/javascript">
    $('#hide').on('click', function() {
        $(this).toggleClass('fa-eye');
        $(this).toggleClass('fa-eye-slash');
        if ($(this).hasClass('fa-eye-slash')) {
            $('#password').attr('type', 'text')
        } else {
            $('#password').attr('type', 'password')
        }
    });
</script>

</html>