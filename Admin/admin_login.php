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
        cursor: pointer;
        text-align: right;
        margin: -3% 26%;
        font-size: 20px;
        color: #1abc9c;
    }

    @media screen and (max-width:920px) {
        #hide {
            position: absolute;
            text-align: right;
            margin: -13% 74%;
            font-size: 20px;
        }
    }
    
    @media screen and (max-width:500px){
        footer{
            bottom:-10%;
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
                    <li><a class="active" href="admin_login.php">Admin Login</a></li>
                    <li><a href="../Student/student_login.php">Student Login</a></li>
                    <li><a href="../Faculty/faculty_login.php">Faculty Login</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="container col-lg-4">
        <div class="wrapper">
            <div class="title p-2"><span>Admin Login</span></div>
            <form action="" method="post">
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="User Name" name="UserName" oninput="this.value = this.value.toUpperCase()" required>
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" name="Password" id="password" required>
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
    <?php
    include '../link.php';
    session_start();
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
        $sql = "SELECT * FROM admin WHERE Admin_Id_No = '$uname'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $adm_id = $row['Admin_Id_No'];
            $adm_hash = $row['Admin_Hash'];
            if (password_verify($pass, $adm_hash)) {
                $_SESSION['Admin_Id_No'] = $adm_id;
                $_SESSION['Role'] = $row['Role'];
                header('Location: admin_dashboard.php');
                exit;
            } else {
                echo "<script>alert('Incorrect Password');
                    </script>";
            }
        } else {
            echo "<script>alert('Incorrect Username');
                    </script>";
        }
    } else {
        echo "<script>alert('variable 'UserName' or variable 'Password' is not declared');
            </script>";
    }
    ?> 
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