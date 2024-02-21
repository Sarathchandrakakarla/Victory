<?php
include '../link.php';
session_start();
if (!$_SESSION['Admin_Id_No']) {
    echo "<script>
  alert('Admin Id Not Rendered');
  location.replace('admin_login.php');
  </script>
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
    <link rel="stylesheet" href="../css/sidebar-style.css" />
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- Bootstrap Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Boxiocns CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <title>Victory EM School</title>
</head>

<style>
    body {
        background: #E4E9F7;
    }

    #sign-out {
        display: none;
    }

    @media screen and (max-width:920px) {
        #sign-out {
            display: block;
        }
    }

    #hide {
        position: absolute;
        margin: -3% 26%;
        font-size: 25px;
        cursor: pointer;
        color: #1abc9c;
    }

    .wrapper {
        height: 650px !important;
    }

    @media screen and (max-width:920px) {
        #hide {
            position: absolute;
            text-align: right;
            margin: -13% 74%;
            font-size: 20px;
        }
    }
</style>

<body>
    <?php
    include 'sidebar.php';
    ?>
    <div class="container col-lg-4">
        <div class="wrapper">
            <div class="title"><span>Add Student/Faculty User</span></div>
            <form action="" method="post" autocomplete="off">
                <div class="row" id="alert-row" style="display: none;">
                    <div class="alert alert-danger d-flex align-items-center" role="alert" id="alert-parent">
                        <div id="alert">
                            Alert
                        </div>
                    </div>
                </div>
                <div class="row">
                    <i class="fas fa-users"></i>
                    <select class="form-select" name="User" id="user" style="padding-left: 60px;">
                        <option value="selectuser" selected disabled>-- Select User --</option>
                        <option value="Student">Student</option>
                        <option value="Faculty">Faculty</option>
                    </select>
                </div>
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="User Name" name="UserName" id="username" oninput="this.value = this.value.toUpperCase()" required>
                </div>
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Full Name" name="Full_Name" id="full_name" required readonly>
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" id="password" name="Password" required>
                </div>
                <span class="fas fa-eye" id="hide"></span>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Confirm Password" id="c_password" name="C_Password" required>
                </div>
                <div class="row button">
                    <button type="submit" class="btn" style="background: #16a085;color:white;" name="Add" id="add" onclick="if(!confirm('Confirm to Add New User?')){return false;}else{return true;}">Add User</button>
                </div>
                <div class="row button">
                    <button type="submit" class="btn" style="background: #16a085;color:white;" name="Update" id="update" onclick="if(!confirm('Confirm to Update User?')){return false;}else{return true;}">Update User</button>
                </div>
                <div class="row button">
                    <button type="submit" class="btn" style="background: #16a085;color:white;" name="Delete" id="delete" onclick="if(!confirm('Confirm to Delete User?')){return false;}else{return true;}">Delete User</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if (isset($_POST['Add'])) {
        $uid = validate($_POST['UserName']);
        $name = validate($_POST['Full_Name']);
        $password = validate($_POST['Password']);
        $c_password = validate($_POST['C_Password']);
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        echo "<script>document.getElementById('username').value = '" . $uid . "';
        document.getElementById('full_name').value = '" . $name . "';
        document.getElementById('password').value = '" . $password . "';
        document.getElementById('c_password').value = '" . $c_password . "';</script>";
        if ($_POST['User']) {
            echo "<script>document.getElementById('user').value = '" . $_POST['User'] . "';</script>";
            $user = strtolower($_POST['User']);
            if ($user == "faculty") {
                if ($_POST['Role']) {
                    $role = $_POST['Role'];
                    echo "<script>document.getElementById('role').value = '" . $role . "';</script>";

                    //Check if User Already Exists
                    $check_sql = mysqli_query($link, "SELECT * FROM `faculty` WHERE Id_No = '$uid'");
                    if ($check_sql) {
                        if (mysqli_num_rows($check_sql) != 0) {
                            echo "<script>alert('User Already Exists!!')</script>";
                        } else {
                            $sql = "INSERT INTO `faculty` VALUES('','$uid','$name','$password','$pass_hash','$role')";
                            if (mysqli_query($link, $sql)) {
                                echo "<script>
            alert_row = document.getElementById('alert-row');
            alert = document.getElementById('alert');
            alert_parent = document.getElementById('alert-parent');
            alert_row.style.display = 'block';
            alert_parent.classList.remove('alert-danger');
            alert_parent.classList.add('alert-success');
            alert.innerHTML = 'Successfully Added " . $_POST['User'] . " User!!';
            </script>";
                            } else {
                                echo "<script>
            alert_row = document.getElementById('alert-row');
            alert = document.getElementById('alert');
            alert_parent = document.getElementById('alert-parent');
            alert_row.style.display = 'block';
            alert_parent.classList.remove('alert-success');
            alert_parent.classList.add('alert-danger');
            alert.innerHTML = 'User Insertion Failed due to SQL Error!!';
            </script>";
                            }
                        }
                    } else {
                        echo "<script>alert('User Checking Query Error!!')</script>";
                    }
                } else {
                    echo "<script>alert('Please Select Role!!')</script>";
                }
            } else if ($user == "student") {
                $check_sql = mysqli_query($link, "SELECT * FROM `student` WHERE Id_No = '$uid'");
                if ($check_sql) {
                    if (mysqli_num_rows($check_sql) != 0) {
                        echo "<script>alert('User Already Exists!!')</script>";
                    } else {
                        $sql = "INSERT INTO `student` VALUES('','$uid','$name','$password','$pass_hash')";
                        if (mysqli_query($link, $sql)) {
                            echo "<script>
            alert_row = document.getElementById('alert-row');
            alert = document.getElementById('alert');
            alert_parent = document.getElementById('alert-parent');
            alert_row.style.display = 'block';
            alert_parent.classList.remove('alert-danger');
            alert_parent.classList.add('alert-success');
            alert.innerHTML = 'Successfully Added " . $_POST['User'] . " User!!';
            </script>";
                        } else {
                            echo "<script>
            alert_row = document.getElementById('alert-row');
            alert = document.getElementById('alert');
            alert_parent = document.getElementById('alert-parent');
            alert_row.style.display = 'block';
            alert_parent.classList.remove('alert-success');
            alert_parent.classList.add('alert-danger');
            alert.innerHTML = 'User Insertion Failed due to SQL Error!!';
            </script>";
                        }
                    }
                } else {
                    echo "<script>alert('User Checking Query Error!!')</script>";
                }
            }
        } else {
            echo "<script>alert('Please Select User Type!!')</script>";
        }
    }

    if (isset($_POST['Update'])) {
        $uid = validate($_POST['UserName']);
        $name = validate($_POST['Full_Name']);
        $password = validate($_POST['Password']);
        $c_password = validate($_POST['C_Password']);
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        echo "<script>document.getElementById('username').value = '" . $uid . "';
        document.getElementById('full_name').value = '" . $name . "';
        document.getElementById('password').value = '" . $password . "';
        document.getElementById('c_password').value = '" . $c_password . "';</script>";
        if ($_POST['User']) {
            echo "<script>document.getElementById('user').value = '" . $_POST['User'] . "';</script>";
            $user = strtolower($_POST['User']);
            if ($user == "faculty") {
                if ($_POST['Role']) {
                    $role = $_POST['Role'];
                    echo "<script>document.getElementById('role').value = '" . $role . "';</script>";
                    //Check if User Already Exists
                    $check_sql = mysqli_query($link, "SELECT * FROM `faculty` WHERE Id_No = '$uid'");
                    if ($check_sql) {
                        if (mysqli_num_rows($check_sql) == 0) {
                            echo "<script>alert('User does not Exists!!')</script>";
                        } else {
                            $sql = "UPDATE `faculty` SET Password = '$password',Fac_Hash = '$pass_hash',Role = '$role' WHERE Id_No = '$uid'";
                            if (mysqli_query($link, $sql)) {
                                echo "<script>
            alert_row = document.getElementById('alert-row');
            alert = document.getElementById('alert');
            alert_parent = document.getElementById('alert-parent');
            alert_row.style.display = 'block';
            alert_parent.classList.remove('alert-danger');
            alert_parent.classList.add('alert-success');
            alert.innerHTML = 'Successfully Updated " . $_POST['User'] . " User!!';
            </script>";
                            } else {
                                echo "<script>
            alert_row = document.getElementById('alert-row');
            alert = document.getElementById('alert');
            alert_parent = document.getElementById('alert-parent');
            alert_row.style.display = 'block';
            alert_parent.classList.remove('alert-success');
            alert_parent.classList.add('alert-danger');
            alert.innerHTML = 'User Updation Failed due to SQL Error!!';
            </script>";
                            }
                        }
                    } else {
                        echo "<script>alert('User Checking Query Error!!')</script>";
                    }
                } else {
                    echo "<script>alert('Please Select Role!!')</script>";
                }
            } else if ($user == "student") {
                //Check if User Already Exists
                $check_sql = mysqli_query($link, "SELECT * FROM `student` WHERE Id_No = '$uid'");
                if ($check_sql) {
                    if (mysqli_num_rows($check_sql) == 0) {
                        echo "<script>alert('User does not Exists!!')</script>";
                    } else {
                        $sql = "UPDATE `student` SET Stu_Password = '$password',Stu_Hash = '$pass_hash' WHERE Id_No = '$uid'";
                        if (mysqli_query($link, $sql)) {
                            echo "<script>
        alert_row = document.getElementById('alert-row');
        alert = document.getElementById('alert');
        alert_parent = document.getElementById('alert-parent');
        alert_row.style.display = 'block';
        alert_parent.classList.remove('alert-danger');
        alert_parent.classList.add('alert-success');
        alert.innerHTML = 'Successfully Updated " . $_POST['User'] . " User!!';
        </script>";
                        } else {
                            echo "<script>
        alert_row = document.getElementById('alert-row');
        alert = document.getElementById('alert');
        alert_parent = document.getElementById('alert-parent');
        alert_row.style.display = 'block';
        alert_parent.classList.remove('alert-success');
        alert_parent.classList.add('alert-danger');
        alert.innerHTML = 'User Updation Failed due to SQL Error!!';
        </script>";
                        }
                    }
                } else {
                    echo "<script>alert('User Checking Query Error!!')</script>";
                }
            }
        } else {
            echo "<script>alert('Please Select User Type!!')</script>";
        }
    }

    if (isset($_POST['Delete'])) {
        $type = strtolower($_POST['User']);
        $uid = validate($_POST['UserName']);

        //Check if User Already Exists
        $check_sql = mysqli_query($link, "SELECT * FROM `$type` WHERE Id_No = '$uid' ");
        if ($check_sql) {
            if (mysqli_num_rows($check_sql) == 0) {
                echo "<script>alert('User Not Found!!')</script>";
            } else {
                $del_sql = mysqli_query($link, "DELETE FROM `$type` WHERE Id_No = '$uid' ");
                if ($del_sql) {
                    echo "<script>alert('User Deleted Successfully!!')</script>";
                } else {
                    echo "<script>alert('User Deletion Failed!!')</script>";
                }
            }
        }
    }
    ?>
    <!-- Scripts -->

    <!-- Show/Hide Password -->
    <script type="text/javascript">
        $('#hide').on('click', function() {
            $(this).toggleClass('fa-eye');
            $(this).toggleClass('fa-eye-slash');
            if ($(this).hasClass('fa-eye-slash')) {
                $('#password').attr('type', 'text')
                $('#c_password').attr('type', 'text')
            } else {
                $('#password').attr('type', 'password')
                $('#c_password').attr('type', 'password')
            }
        });
    </script>

    <!-- Show/Hide Role -->
    <script type="text/javascript">
        $('#user').on('change', () => {
            if ($('#user').val() == "Faculty") {
                document.querySelector('.button').style.marginTop = '70px';
                $('#c_password').parent().append('<div class="row role" style="margin-top:20px;"><i class="fas fa-users"></i><select class="form-select" name="Role" id="role" style="padding-left: 60px;"><option value="selectrole" selected disabled>-- Select Role --</option><option value="Faculty">Faculty</option><option value="Faculty_Admin">Faculty Admin</option><option value="Van_Incharge">Van Incharge</option></select></div>')
            } else if ($('#user').val() == "Student") {
                $('.role').remove()
                document.querySelector('.button').style.marginTop = '';
            }
        })
    </script>

    <!-- Get Full Name of User -->
    <script type="text/javascript">
        $('#username').on('change', () => {
            type = $('#user').val();
            if (type == null) {
                alert_row = document.getElementById('alert-row');
                alert = document.getElementById('alert');
                alert_parent = document.getElementById('alert-parent');
                alert_row.style.display = 'block';
                alert_parent.classList.remove('alert-success');
                alert_parent.classList.add('alert-danger');
                alert.innerHTML = 'Please Select User Type!!';
            } else {
                id = $('#username').val();
                $.ajax({
                    type: 'post',
                    url: 'temp.php',
                    data: {
                        Type: type,
                        Id: id
                    },
                    success: function(data) {
                        if (data == '0') {
                            alert_row = document.getElementById('alert-row');
                            alert = document.getElementById('alert');
                            alert_parent = document.getElementById('alert-parent');
                            alert_row.style.display = 'block';
                            alert_parent.classList.remove('alert-success');
                            alert_parent.classList.add('alert-danger');
                            alert.innerHTML = 'Invalid User Name!!';
                        } else {
                            arr = data.split(",");
                            alert_row.style.display = 'none';
                            $('#full_name').val(arr[0]);
                            if (arr[1] != "") {
                                $('#password').val(arr[1]);
                                $('#c_password').val(arr[1]);
                                if (type == "Faculty") {
                                    $('#role').val(arr[2]);
                                }
                            }
                        }
                    }
                })
            }
        });
    </script>

    <!-- Validation of From and Display Alert -->
    <script>
        pass = document.getElementById('password');
        c_pass = document.getElementById('c_password');
        alert_row = document.getElementById('alert-row');
        alert = document.getElementById('alert');
        let flag = false;

        function checkPassword() {
            if (pass.value != c_pass.value) {
                alert_row.style.display = 'block';
                alert.innerHTML = 'Passwords are not Same';
                flag = false;
            } else {
                flag = true;
                alert_row.style.display = 'none';
            }
        }
        pass.addEventListener('input', () => {
            if (c_pass.value.length > 0) {
                checkPassword();
            }
        })
        c_pass.addEventListener('input', checkPassword);
    </script>
</body>

</html>