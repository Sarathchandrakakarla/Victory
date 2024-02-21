<?php
session_start();
if (!$_SESSION['Admin_Id_No']) {
  echo "<script>alert('Admin Id Not Available');
    location.replace('show_student_page.php');</script>";
}
if (!$_SESSION['Stu_Id_No']) {
  echo "<script>alert('Student Id Not Available');
    location.replace('show_student_page.php');</script>";
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
    padding-left: 60px;
    padding-right: 60px;
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
    font-weight: bold;
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

  .form-control {
    width: 285px;
    border-radius: 10px;
  }

  .buttons {
    margin-left: 500px;
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

  .btn {
    margin-left: 50px;
  }
</style>

<body>
  <div class="container-scroller">
    <!--
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="admin_dashboard.php">
            <i class="mdi mdi-home menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="stu"><img src="Images/stu.png" width="30px"></i>
            <span class="menu-title">Student Data</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <a class="nav-link" href="Stu_Register1.php" id="stu_item">Add Student</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="show_student_page.php">Modify Student Details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages/icons/mdi.html">
            <i class="mdi mdi-contacts menu-icon"></i>
            <span class="menu-title">Icons</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages/forms/basic_elements.html">
            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            <span class="menu-title">Forms</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages/charts/chartjs.html">
            <i class="mdi mdi-chart-bar menu-icon"></i>
            <span class="menu-title">Charts</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages/tables/basic-table.html">
            <i class="mdi mdi-table-large menu-icon"></i>
            <span class="menu-title">Tables</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.bootstrapdash.com/demo/breeze-free/documentation/documentation.html">
            <i class="mdi mdi-file-document-box menu-icon"></i>
            <span class="menu-title">Documentation</span>
          </a>
        </li>
        <li class="nav-item sidebar-actions">
          <div class="nav-link">
            <div class="mt-4">
              <div class="border-none">
                <p class="text-black">Notification</p>
              </div>
              <ul class="mt-4 pl-0">
                <li>Sign Out</li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
    </nav>
-->
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
                    <a href="../Marks/class_wise_examination.php"><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Examinations</a>
                  </li>
                  <li>
                    <a href="../Marks/class_wise_subjects.php"><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Subjects</a>
                  </li>
                  <li>
                    <a href="../Marks/class_marks.php"><i class="mdi mdi-circle-medium menu-icon"></i>Class Wise Marks</a>
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
                    <a href="Emp_register.php"><i class="mdi mdi-circle-medium menu-icon"></i>Emp Personal Details</a>
                  </li>
                  <li>
                    <a href="show_emp_page.php"><i class="mdi mdi-circle-medium menu-icon"></i>Modify Emp Personal Details</a>
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
      <div class="details-form">
        <h1 style="margin-left: auto; margin-right:auto; padding-left: 25px;">Student Details Form</h1>
        <form autocomplete="off" method="post" action="update_student_add_data.php">
          <h2 style="margin-left: auto; margin-right:auto;">Personal Details</h2>
          <table width="100%" onload="set()">
            <tr>
              <td>Id No.</td>
              <td>
                <input type="text" name="Stu_Id_No" value="<?php echo $_SESSION['Stu_Id_No'] ?>" size="30" Required>
                <span style="color: red;">*</span>
              </td>
              <td>Admission No.</td>
              <td>
                <input type="text" name="Stu_Adm_No" value="<?php echo $_SESSION['Stu_Adm_No'] ?>"size="30" Required>
                <span style="color: red;">*</span>
              </td>
            </tr>
            <tr>
              <td>First Name</td>
              <td>
                <input type="text" id="first_name" name="first_name" value="<?php echo $_SESSION['First_Name'] ?>" size="30" Required>
                <span style="color: red;">*</span>
              </td>
              <td>SurName</td>
              <td>
                <input type="text" name="sur_name" value="<?php echo $_SESSION['Sur_Name'] ?>" size="30" Required>
                <span style="color: red;">*</span>
              </td>
            </tr>
            <tr>
              <td>Class</td>
              <td>
                <select class="form-control" name="Stu_Class" id="class">
                  <option value="Select Class">Select Class</option>
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
              <td>Section</td>
              <td>
                <select class="form-control" name="Stu_Section" id="section">
                  <option value="Select Section">Select Section</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Father's Name</td>
              <td>
                <input type="text" name="father_name" value="<?php echo $_SESSION['Father_Name'] ?>" size="30" Required>
                <span style="color: red;">*</span>
              </td>
              <td>Mother's Name</td>
              <td>
                <input type="text" name="mother_name" value="<?php echo $_SESSION['Mother_Name'] ?>" size="30" Required>
                <span style="color: red;">*</span>
              </td>
            </tr>
            <tr>
              <td>Date of Birth</td>
              <td>
                <input type="date" name="dob" id="dob" Required>
                <span style="color: red;">*</span>
              </td>
            </tr>
            <tr>
              <td colspan="1">Select Gender</td>
              <td>
                <input type="radio" name="gender" value="Boy" <?php echo ($_SESSION['Gender'] == 'Boy') ? 'checked' : '' ?> Required>Boy
                <input type="radio" name="gender" value="Girl" <?php echo ($_SESSION['Gender'] == 'Girl') ? 'checked' : '' ?> style="margin-left: 50px;">Girl
                <span style="color: red;">*</span>
              </td>
            </tr>
            <tr>
              <td>Mobile Number</td>
              <td>
                <input type="text" name="mobile" value="<?php echo $_SESSION['Mobile'] ?>" size="30" Required>
                <span style="color: red;">*</span>
              </td>
              <td>Student Image</td>
              <td>
                <img src="Images/<?php echo $_SESSION['Stu_Id_No'] . ".jpg" ?>" style="padding-left: 30px;" alt="Student Image Not Available" id="stu_img" width="120px">
                <button style="width:200px; height:30px; border-radius:8px" onclick="document.getElementById('getFile').click()">Upload New Photo</button>
                <input type='file' id="getFile" name="img" accept=".png,.jpg,.jpeg" onchange="if(!confirm('Confirm to Update User Image?')){location.replace('update_student.php')}; document.getElementById('stu_img').src = window.URL.createObjectURL(this.files[0])" style="display:none">
                <span style="color: red;">*</span>
              </td>
            </tr>
            <tr>
              <td>Aadhar Number</td>
              <td>
                <input type="text" name="aadhar" value="<?php if($_SESSION['Aadhar']!=''){echo $_SESSION['Aadhar'];} else{echo '0';} ?>" size="30" Required>
                <span style="color: red;">*</span>
              </td>
            </tr>
          </table>

          <h2>Address Details</h2>
          <table width="100%">
            <tr>
              <td>Religion</td>
              <td colspan="1">
                <input type="radio" name="religion" value="Indian" <?php echo ($_SESSION['Religion'] == 'Indian-Hindu') ? 'checked' : '' ?> Required>Indian-Hindu
                <input type="radio" name="religion" value="Other" <?php echo ($_SESSION['Religion'] == 'Indian-Islam') ? 'checked' : '' ?> style="margin-left: 50px;">Indian-Islam
                <input type="radio" name="religion" value="Other" <?php echo ($_SESSION['Religion'] == 'Indian-Christian') ? 'checked' : '' ?> style="margin-left: 50px;">Indian-Christian
                <span style="color: red;">*</span>
              </td>
            </tr>
            <tr>
              <td>Caste</td>
              <td>
                <input type="text" name="Caste" value="<?php echo $_SESSION['Caste']?>" size="25" required>
                <span style="color: red;">*</span>
              </td>
              <td>Category</td>
              <td>
                <select class="form-control" id="category" name="Category" required>
                  <option value="selectcategory">Select Category</option>
                  <option value="OC">OC</option>
                  <option value="BC">BC</option>
                  <option value="SC">SC</option>
                  <option value="ST">ST</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>House No</td>
              <td>
                <input type="text" name="house_no" value="<?php echo $_SESSION['House_No'] ?>" size="25" Required>
                <span style="color: red;">*</span>
              </td>
              <td>Area</td>
              <td>
                <input type="text" name="area" value="<?php echo $_SESSION['Area'] ?>" size="25" Required>
                <span style="color: red;">*</span>
              </td>
            </tr>
            <tr>
              <td>Village/Town</td>
              <td>
                <input type="text" name="village" value="<?php echo $_SESSION['Village'] ?>" size="25" Required>
                <span style="color: red;">*</span>
              </td>
            </tr>
          </table>
          <h2>Other Details</h2>
          <table width="100%">
          <tr>
              <td>Date of Join</td>
              <td> 
                <input type="date" id="doj" value="<?php echo $_SESSION['DOJ'] ?>" name="DOJ" required>
                <span style="color: red;">*</span>
              </td>
              <td>Previous School Studied</td>
            <td>
              <input type="text" value="<?php echo $_SESSION['Previous_School'] ?>" size="25" name="Previous_School">
            </td>
            </tr>
            <tr>
              <td>Van Route</td>
            <td>
              <input type="text" value="<?php echo $_SESSION['Van_Route'] ?>" name="Van_Route">
            </td>
            </tr>
            <tr>
              <td>Referred By</td>
            <td>
              <input type="text" value="<?php echo $_SESSION['Referred_By'] ?>" name="Referred_By">
            </td>
            </tr>
          </table>
          <div class="buttons">
            <button type="submit" class="btn btn-primary" name="update" id="submit">Update</button>
            <input type="reset" class="btn btn-warning" id="reset" style="color: white;">
          </div>
        </form>
      </div>
    </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
            
            stuclass = '<?php echo $_SESSION['Stu_Class']?>';
            stusection = '<?php echo $_SESSION['Stu_Section']?>';
            category = '<?php echo $_SESSION['Category']?>';
            var dob = '<?php echo $_SESSION['DOB']?>';
            date1 = dob.substring(0,2);
            month1 = dob.substring(3,5);
            year1 = dob.substring(6,10);
            var doj = '<?php echo $_SESSION['DOJ']?>';
            date2 = doj.substring(0,2);
            month2 = doj.substring(3,5);
            year2 = doj.substring(6,10);
            $('#class').find('option[value="'+stuclass+'"]').attr('selected','selected');
            $('#section').find('option[value="'+stusection+'"]').attr('selected','selected');
            $('#category').find('option[value="'+category+'"]').attr('selected','selected');
            $('#dob').val(year1+'-'+month1+'-'+date1);
            $('#doj').val('20'+year2+'-'+month2+'-'+date2);
        });
    </script>
    
</body>

</html>