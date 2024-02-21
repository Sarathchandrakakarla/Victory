<?php
include_once '../link.php';
session_start();
if (!$_SESSION['Admin_Id_No']) {
    echo "<script>alert('Name Not Available');
    location.replace('../admin_login.html');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Victory EM School</title>
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../css/style2.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>
<style>
    #main {
        width: 100%;
        height: 1000px;
        background: #E3D2C4;
    }

    #header {
        background: linear-gradient(#6A11CB, #2754c7);
        padding: 10px;
        padding-left: 40px;
        border-radius: 10px;
    }

    #side_logo {
        margin-left: 50px;
    }

    #heading {
        color: white;
        margin-top: 20px;
        font-family: Georgia, 'Times New Roman', Times, serif;
    }

    #stu_item {
        text-decoration: none;
        color: black;
        opacity: 80%;
    }

    .details-form {
        margin-top: 20px;
        font-family: "comic sans ms", sans serif;
        padding-left: 100px;
        padding-right: 100px;
        padding-bottom: 50px;
    }

    h2 {
        background-color: forestgreen;
        color: white;
        padding: 10px;
        text-align: center;
        border-radius: 10px;
    }

    td {
        padding: 7px;
    }

    input {
        height: 30px;
        border-radius: 10px;
        border: none;
    }

    input:focus {
        outline: none;
        border: 1px solid forestgreen;
    }

    input:hover {
        box-shadow: 5px 5px 5px black;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .form-control {
        width: 285px;
        border-radius: 10px;
    }

    .buttons {
        margin-left: 450px;
        margin-top: 20px;
    }

    .btn {
        height: 40px;
        margin-left: 20px;
    }

    .sidebar {
        padding-top: 50px;
    }

    .profile {
        color: white;
        margin-top: 30px;
    }

    .profile a {
        color: white;
        text-decoration: none;
    }

    .dropdown-menu {
        width: 200px;
        margin-left: 20px;
    }

    .profile_img {
        border-radius: 15px;
        background-color: darkgrey;
    }

    #tbl {
        margin-left: 200px;
        margin-top: 50px;
    }

    #tbl td {
        font-weight: bold;
        border: none;
    }

    #report_heading {
        margin-top: 20px;
        margin-left: 400px;
        font-weight: bold;
    }
    #err{
        margin-left: 450px;
        background: red;
        color: white;
        border-radius: 8px;
        padding: 10px;
    }

    #table {
        width: 100%;
        margin: 0 auto;
        margin-top: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        max-height: 500px;
    }

    .table-wrapper {
        max-height: 500px;
        overflow-y: scroll;
        margin: 20px;
    }

    th {
        position: sticky;
        top: 0px;
        background: #E3D2C4;
        padding-left: 35px;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    td {
        padding-left: 25px;
    }

    #table,
    td,
    th {
        border: 2px solid black;
    }
</style>
<script type="text/javascript">
    function hideTable() {
        document.getElementById('table').style.visibility = "hidden";
    }
</script>

<body>
    <div class="container-scroller">
        <div class="wrapper">
            <!-- Sidebar  -->
            <nav id="sidebar">
        <div class="sidebar-header">
          <h3>Administrator</h3>
        </div>
        <ul class="list-unstyled components">
          <li class="active">
            <a href="../admin_dashboard.php"><i class="mdi mdi-home menu-icon"></i> Dashboard</a>
          </li>
          <li class="submenu1">
            <a href=""><i class="mdi mdi-account menu-icon"></i> Student <span style="margin-left: 10px;">&rsaquo;</span></a>
            <ul class="collapse collapse1 list-unstyled">
              <li class="submenu11">
                <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>Entry<span style="margin-left: 10px;">&rsaquo;</span></a>
                <ul class="collapse list-unstyled">
                  <li>
                    <a href="../Stu_Register1.php"><i class="mdi mdi-circle-medium menu-icon"></i>Personal Details</a>
                  </li>
                  <li>
                    <a href="../show_student_page.php"><i class="mdi mdi-circle-medium menu-icon"></i>Modify Personal Details</a>
                  </li>
                </ul>
              </li>
              <li class="submenu12">
                <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>View<span style="margin-left: 10px;">&rsaquo;</span></a>
                <ul class="collapse list-unstyled">
                  <li>
                    <a href="../Reports/class_wise_stu_report.php"><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Student Details</a>
                  </li>
                  <li>
                    <a href="../Reports/search_student.php"><i class="mdi mdi-circle-medium menu-icon"></i>Search Student</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="submenu2">
            <a href=""><i class="mdi mdi-library-books menu-icon"></i>Examinations<span style="margin-left: 10px;">&rsaquo;</span></a>
            <ul class="collapse collapse1 list-unstyled">
              <li class="submenu21">
                <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>Entry<span style="margin-left: 10px;">&rsaquo;</span></a>
                <ul class="collapse list-unstyled">
                  <li>
                    <a href="class_wise_examination.php"><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Examinations</a>
                  </li>
                  <li>
                    <a href=class_wise_subjects.php"><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Subjects</a>
                  </li>
                  <li>
                    <a href="class_marks.php"><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Marks</a>
                  </li>
                </ul>
              </li>
              <li class="submenu22">
                <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>View<span style="margin-left: 10px;">&rsaquo;</span></a>
                <ul class="collapse list-unstyled">
                  <li>
                    <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Examinations</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="submenu3">
            <a href=""><i class="mdi mdi-account menu-icon"></i> Employee <span style="margin-left: 10px;">&rsaquo;</span></a>
            <ul class="collapse collapse2 list-unstyled">
              <li class="submenu31">
                <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>Entry<span style="margin-left: 10px;">&rsaquo;</span></a>
                <ul class="collapse list-unstyled">
                  <li>
                    <a href="../Employee/Emp_register.php"><i class="mdi mdi-circle-medium menu-icon"></i>Emp Personal Details</a>
                  </li>
                  <li>
                    <a href="../Employee/show_emp_page.php"><i class="mdi mdi-circle-medium menu-icon"></i>Modify Emp Personal Details</a>
                  </li>
                </ul>
              </li>
              <!--
              <li class="submenu32">
                <a href=""><i class="mdi mdi-circle-medium menu-icon"></i>View<span style="margin-left: 10px;">&rsaquo;</span></a>
                <ul class="collapse list-unstyled">
                  <li>
                    <a href="Reports/class_wise_stu_report.php"><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Student Details</a>
                  </li>
                  <li>
                    <a href="Reports/search_student.php"><i class="mdi mdi-circle-medium menu-icon"></i>Search Student</a>
                  </li>
                </ul>
              </li>
              -->
            </ul>
          </li>
          <li>
            <a href="#">Contact</a>
          </li>
        </ul>
      </nav>
            <div class="container-fluid" id="main">
                <div class="container-fluid" id="header">
                    <div class="row">
                        <div class="logo col-md-2">
                            <button type="button" id="sidebarCollapse" class="navbar-toggler navbar-toggler align-self-center mr-2" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fas fa-align-left"></i>
                            </button>
                            <img src="../Images/Victory Logo2.jpg" alt="Victory Logo" style="width: 100px;">
                        </div>
                        <div class="heading col-md-6">
                            <h1 id="heading">VICTORY SCHOOLS</h1>
                        </div>
                        <img src="../Images/<?php echo $_SESSION['Admin_Id_No'] . ".jpg" ?>" alt="Img Not Available" id="user-img" width="100px" height="100px" style="border-radius: 50%;">
                        <div class="profile col-md-3">
                            <a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h4><?php echo $_SESSION['Admin_Id_No'] . "(Administrator)" ?><img src="../Images/arrow.png" width="20px" id="arrow"></h4>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <button style="border-radius:8px;margin-left:5px; margin-top:2px;" onclick="document.getElementById('getFile').click()">Upload New Photo</button>
                                <input type='file' id="getFile" name="img" accept=".png,.jpg,.jpeg" onchange="if(!confirm('Confirm to Update User Image?')){location.replace('admin_dashboard.php')}; document.getElementById('user-img').src = window.URL.createObjectURL(this.files[0])" style="display:none">
                                <div class="dropdown-divider"></div>
                                <button class="btn btn-success" onclick="location.replace('../logout.php')">Sign Out</button>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="" method="post">
                    <table id="tbl">
                        <tr>
                            <td>
                                <label for="max_marks">Class:</label>
                            </td>
                            <td>
                                <select name="Class" id="class" class="form-control" style="width: 220px;" onchange="fetchExam(this.value)">
                                    <option value="selectclass" disabled selected>--Select Class--</option>
                                    <option value="PreKG">PreKG</option>
                                    <option value="LKG">LKG</option>
                                    <option value="UKG">UKG</option>
                                    <option value="1 CLASS">1 CLASS</option>
                                    <option value="2 CLASS">2 CLASS</option>
                                    <option value="3 CLASS">3 CLASS</option>
                                    <option value="4 CLASS">4 CLASS</option>
                                    <option value="5 CLASS">5 CLASS</option>
                                    <option value="6 CLASS">6 CLASS</option>
                                    <option value="7 CLASS">7 CLASS</option>
                                    <option value="8 CLASS">8 CLASS</option>
                                    <option value="9 CLASS">9 CLASS</option>
                                    <option value="10 CLASS">10 CLASS</option>
                                </select>
                            </td>
                            <td>
                                <label for="section">Section:</label>
                            </td>
                            <td>
                                <select name="Section" class="form-control" style="width: 160px;">
                                    <option value="select section">--Select Section--</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="exam">Name of Examination:</label>
                            </td>
                            <td>
                                <select name="Exam" class="form-control" id="exam">
                                    <option value="selectexam" disabled selected>--Select Examination--</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="max_marks">Max Marks:</label>
                            </td>
                            <td>
                                <input type="number" id="max" name="Max_Marks" onclick="fetchMax()">
                            </td>
                        </tr>
                    </table>
                    <div class="buttons">
                        <button type="submit" class="btn btn-primary" name="ok">OK</button>
                        <button type="submit" class="btn btn-primary" name="add">ADD</button>
                        <button type="submit" class="btn btn-primary" name="show">SHOW</button>
                        <button type="reset" class="btn btn-warning" onclick="hideTable()">CLEAR</button>
                    </div>
                </form>
                <div class="container">
                    <h3 id="report_heading">Class Wise Marks Entry</h3>
                    <span id="err" style="display: none;"> Hello Welcome</span>
                    <div class="table-wrapper">
                        <form action="" method="POST">
                        <table class="scrolldown" id="table">
                            <tr>
                                <?php
                                if (isset($_POST['ok'])) {
                                    $class = $_POST['Class'];
                                    $section = $_POST['Section'];
                                    $exam = $_POST['Exam'];
                                    $max = $_POST['Max_Marks'];
                                    echo "<script>var max = ".$max."</script>";
                                    $result1 = mysqli_query($link, "SELECT * FROM `class_wise_subjects` WHERE Class = '$class'");
                                    echo '<th>S.No</th>
                                        <th>Id No.</th>
                                        <th>Student Name</th>';
                                    while ($row1 = mysqli_fetch_assoc($result1)) {
                                        echo '
            <th>' . $row1['Subjects'] . '</th>';
                                    }
                                    echo '<tbody>';
                                    $sql = "SELECT * FROM `student_master_data` WHERE Stu_Class = '$class' AND Stu_Section = '$section'";
                                    $result = mysqli_query($link, $sql);
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>
                <td>' . $i . '</td>
                <td>' . $row['Id_No'] . '</td>
                <td>' . $row['First_Name'] . '</td>';
                                        $result1 = mysqli_query($link, "SELECT * FROM `class_wise_subjects` WHERE Class = '$class' AND Exam = '$exam'");
                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                            echo '
                <td><input type="number" name="mark" id="markinp" style="width:100px;"></td>';
                                        }
                                        echo '</tr>';
                                        $i++;
                                    }
                                }
                                ?>
                            </tr>
                            </tbody>
                        </table>
                        </form>
                        <?php 
                        if(isset($_POST['add'])){
                            $mark = $_POST['mark'];
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script type="text/javascript">
        function fetchExam(cls){
            $('#exam').html('');
            $.ajax({
            type:'post',
            url:'temp.php',
            data:{class:cls},
            success:function(data){
                $("#exam").html(data);
            }
        })
        }
        function fetchMax(){
            var cl = $('#class').find(":selected").text();
            var ex = $('#exam').find(":selected").text();
            $.ajax({
            type:'post',
            url:'temp1.php',
            data:{stu_class:cl,exam:ex},
            success:function(data){
                var max_marks = document.getElementById('max');
                max_marks.value = data;
            }
        })
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    <script type="text/javascript">
        var span = document.getElementById('err');
        $('#markinp').keyup(function(){
            span.textContent = "Marks should be less than Max Marks!";
            max = <?php echo $max ?>;
            if(($('#markinp').val())>max){
                $('#err').show();
            }
            else{
                $('#err').hide();
            }
        });
    </script>
    <script src="../script.js"></script>
</body>

</html>