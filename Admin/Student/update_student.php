<?php
session_start();
if (!$_SESSION['Admin_Id_No']) {
  echo "<script>
  alert('Admin Id Not Rendered');
  location.replace('../admin_login.php');
  </script>";
}
if (!$_SESSION['Stu_Id_No']) {
  echo "<script>
  alert('Student Id Not Rendered');
  location.replace('show_student_page.php');
  </script>";
}
error_reporting(0);
?>

<?php require '../../link.php';
function validate($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST["update"])) {
  $id = validate($_POST['Stu_Id_No']);
  $adm = validate($_POST['Stu_Adm_No']);
  $firstname = validate($_POST['First_Name']);
  $surname = validate($_POST['Sur_Name']);
  $fathername = validate($_POST['Father_Name']);
  $mothername = validate($_POST['Mother_Name']);
  $dob = validate($_POST['DOB']);
  $gender = validate($_POST['Gender']);
  $mobile = validate($_POST['Mobile']);
  $aadhar = validate($_POST['Aadhar']);
  $class = validate($_POST['Stu_Class']);
  $section = validate($_POST['Stu_Section']);
  $pass_class = validate($_POST['Pass_Class']);
  $religion = validate($_POST['Religion']);
  $caste = validate($_POST['Caste']);
  $category = validate($_POST['Category']);
  $houseno = validate($_POST['House_No']);
  $area = validate($_POST['Area']);
  $village = validate($_POST['Village']);
  $doj = validate($_POST['DOJ']);
  $previous = validate($_POST['Previous_School']);
  $van = validate($_POST['Van_Route']);
  $refer = validate($_POST['Referred_By']);
  if ($_POST['Pass_Class'] && $pass_class != ' ' && $pass_class != '') {
    $class = $pass_class;
    $section = '';
  }
  $d = explode('-', $dob);
  $j = explode('-', $doj);
  $dob = $d[2] . "-" . $d[1] . "-" . $d[0];
  //Removing 20 from 2023
  if (substr($j[0], 0, strlen("20")) == "20") {
    $j[0] = substr($j[0], strlen("20"));
  }
  //Removing 19 from 1998
  else if (substr($j[0], 0, strlen("19")) == "19") {
    $j[0] = substr($j[0], strlen("19"));
  }
  $doj = $j[2] . "-" . $j[1] . "-" . $j[0];
  //Siblings Arrangement
  $sibling_status = $_POST['Siblings'];
  if ($sibling_status == "Yes") {
    $no_of_siblings = $_POST['No_Of_Siblings'];
    if ($_POST['Sib_Id_No']) {
      $siblings = implode(',', $_POST['Sib_Id_No']);
      $siblings_update_status = true;
      foreach ($_POST['Sib_Id_No'] as $sibling) {
        if ($sibling[0] == "") {
          echo "<script>alert('Please Enter All Siblings!')</script>";
          $siblings_update_status = false;
          break;
        }
      }
      if ($siblings_update_status) {
        if (mysqli_query($link, "UPDATE `student_master_data`
        SET Adm_No = '$adm', First_Name = '$firstname', Sur_Name = '$surname', Father_Name = '$fathername', Mother_Name = '$mothername',
         DOB = '$dob', Gender = '$gender', Mobile = '$mobile', Aadhar = '$aadhar', Stu_Class = '$class', Stu_Section = '$section',
          Religion = '$religion', Caste = '$caste', Category = '$category', House_No = '$houseno', Area = '$area',
          Village = '$village', DOJ = '$doj', Previous_School = '$previous', Van_Route = '$van', Referred_By = '$refer',Siblings = '$siblings'
        WHERE Id_No = '$id'")) {
          if ($van != "") {
            if (mysqli_num_rows(mysqli_query($link, "SELECT * FROM `stu_fee_master_data` WHERE Id_No = '$id' AND Type = 'Vehicle Fee'")) == 0) {
              echo "<script>alert('Student Not Found in Fee Master Data!Please Insert Manually for Vehicle fee!')</script>";
            } else {
              $actual = '';
              $actual_status = true;
              if ($van != "Drop") {
                $sql = mysqli_query($link, "SELECT Fee FROM `actual_fee` WHERE Type = 'Vehicle Fee' AND Route = '$van'");
                if (mysqli_num_rows($sql) == 0) {
                  echo "<script>alert('Actual Fee Not Available for " . $van . "')</script>";
                  $actual_status = false;
                } else {
                  while ($row = mysqli_fetch_assoc($sql)) {
                    $actual = $row['Fee'];
                  }
                }
              }
              if (!$actual_status) {
                echo "<script>alert('Fee Master Data Updation Failed!')</script>";
              } else {
                if (mysqli_query($link, "UPDATE `stu_fee_master_data` SET First_Name = '$firstname', Class = '$class', Section = '$section'
          ,Street = '$area',Actual = '$actual', Route = '$van' WHERE Id_No = '$id' AND Type = 'Vehicle Fee'")) {
                  echo "<script>alert('Fee Master Data Updated Successfully')</script>";
                }
              }
            }
          }

          echo
          "
                <script>
                alert('Succesfully Updated');
                </script>
                ";
        } else {
          echo
          "
                <script>
                alert('Updation Failed (SQL error)');
                </script>
                ";
        }
      }
    }
  } else {

    if (mysqli_query($link, "UPDATE `student_master_data`
        SET Adm_No = '$adm', First_Name = '$firstname', Sur_Name = '$surname', Father_Name = '$fathername', Mother_Name = '$mothername',
         DOB = '$dob', Gender = '$gender', Mobile = '$mobile', Aadhar = '$aadhar', Stu_Class = '$class', Stu_Section = '$section',
          Religion = '$religion', Caste = '$caste', Category = '$category', House_No = '$houseno', Area = '$area',
          Village = '$village', DOJ = '$doj', Previous_School = '$previous', Van_Route = '$van', Referred_By = '$refer',Siblings = NULL
        WHERE Id_No = '$id'")) {
      if ($van != "") {
        if (mysqli_num_rows(mysqli_query($link, "SELECT * FROM `stu_fee_master_data` WHERE Id_No = '$id' AND Type = 'Vehicle Fee'")) == 0) {
          echo "<script>alert('Student Not Found in Fee Master Data!Please Insert Manually for Vehicle fee!')</script>";
        } else {
          $actual = '';
          $actual_status = true;
          if ($van != "Drop") {
            $sql = mysqli_query($link, "SELECT Fee FROM `actual_fee` WHERE Type = 'Vehicle Fee' AND Route = '$van'");
            if (mysqli_num_rows($sql) == 0) {
              echo "<script>alert('Actual Fee Not Available for " . $van . "')</script>";
              $actual_status = false;
            } else {
              while ($row = mysqli_fetch_assoc($sql)) {
                $actual = $row['Fee'];
              }
            }
          }
          if (!$actual_status) {
            echo "<script>alert('Fee Master Data Updation Failed!')</script>";
          } else {
            if (mysqli_query($link, "UPDATE `stu_fee_master_data` SET First_Name = '$firstname', Class = '$class', Section = '$section'
          ,Street = '$area',Actual = '$actual', Route = '$van' WHERE Id_No = '$id' AND Type = 'Vehicle Fee'")) {
              echo "<script>alert('Fee Master Data Updated Successfully')</script>";
            }
          }
        }
      }

      echo
      "
                <script>
                alert('Succesfully Updated');
                </script>
                ";
    } else {
      echo
      "
                <script>
                alert('Updation Failed (SQL error)');
                </script>
                ";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Victory Schools</title>
  <link rel="shortcut icon" href="/Victory/Images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="/Victory/css/sidebar-style.css" />
  <link rel="stylesheet" href="/Victory/css/form-style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Boxiocns CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
</head>
<style>
  #sign-out {
    display: none;
  }

  @media screen and (max-width:920px) {
    #sign-out {
      display: block;
    }
  }

  /* Slider */
  .quantity {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
  }

  .quantity__minus,
  .quantity__plus {
    display: block;
    width: 35px;
    height: 35px;
    background: #dee0ee;
    text-align: center;
    padding-top: 4.5px;
  }

  .quantity__minus:hover,
  .quantity__plus:hover {
    background: #575b71;
    color: #fff;
  }

  .quantity__minus {
    border-radius: 50%;
    cursor: pointer;
    margin-right: 5px;
  }

  .quantity__plus {
    border-radius: 50%;
    cursor: pointer;
    margin-left: 5px;
  }

  .quantity__input {
    text-align: center;
  }
</style>

<body>
  <?php
  include '../sidebar.php';
  ?>

  <div class="container">

    <div class="content">
      <div class="title">Student Personal Details</div>
      <form action="" method="POST" onsubmit="if(!confirm('Confirm to Update Student Data?')){return false;}else{return true;}">
        <div class="user-details main-section">
          <div class="input-box">
            <span class="details">Id No. <span class="required">*</span></span>
            <input type="text" placeholder="Enter Id No" value="<?php echo $_SESSION['Stu_Id_No'] ?>" id="id_no" name="Stu_Id_No" oninput="this.value = this.value.toUpperCase()" readonly required />
          </div>
          <div class="input-box">
            <span class="details">Admission No.</span>
            <input type="text" placeholder="Enter Admission No" value="<?php echo $_SESSION['Stu_Adm_No'] ?>" name="Stu_Adm_No" />
          </div>
          <div class="input-box">
            <span class="details">Full Name <span class="required">*</span></span>
            <input type="text" placeholder="Enter Fullname" value="<?php echo $_SESSION['First_Name'] ?>" name="First_Name" required />
          </div>
          <div class="input-box">
            <span class="details">Surname</span>
            <input type="text" placeholder="Enter Surname" value="<?php echo $_SESSION['Sur_Name'] ?>" name="Sur_Name" />
          </div>
          <div class="input-box">
            <span class="details">Father Name</span>
            <input type="text" placeholder="Enter Father Name" value="<?php echo $_SESSION['Father_Name'] ?>" name="Father_Name" />
          </div>
          <div class="input-box">
            <span class="details">Mother Name</span>
            <input type="text" placeholder="Enter Mother Name" value="<?php echo $_SESSION['Mother_Name'] ?>" name="Mother_Name" />
          </div>
          <div class="input-box">
            <span class="details">Class</span>
            <select name="Stu_Class" id="class">
              <option value="selectclass" selected disabled>--Select Class --</option>
              <option value="PreKG">PreKG</option>
              <option value="LKG">LKG</option>
              <option value="UKG">UKG</option>
              <?php
              for ($i = 1; $i <= 10; $i++) {
                echo "<option value='" . $i . " CLASS" . "'>" . $i . " CLASS" . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="input-box">
            <span class="details">Section</span>
            <select name="Stu_Section" id="section">
              <option value="selectsection" selected disabled>--Select Section --</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
              <option value="D">D</option>
            </select>
          </div>
          <div class="input-box">
            <input type="text" placeholder="Enter Passed Out Class" id="pass_class" name="Pass_Class" />
          </div>
          <div class="input-box">
            <span class="required" style="font-size: 15px;"> For Passed Out - <u>OthersPassedout-23</u> <br> For Drop - <u>DROP-7-23/24</u></span>
          </div>
          <div class="gender-details">
            <span class="gender-title">Gender</span>
            <div class="category">
              <input type="radio" value="Boy" id="boy" name="Gender" <?php echo ($_SESSION['Gender'] == 'Boy') ? 'checked' : '' ?> />
              <span><label for="boy">Boy</label></span>
              <input type="radio" value="Girl" id="girl" name="Gender" <?php echo ($_SESSION['Gender'] == 'Girl') ? 'checked' : '' ?> />
              <span><label for="girl">Girl</label></span>
            </div>
          </div>
          <div class="input-box">
            <span class="details">Date Of Birth</span>
            <input type="date" id="dob" name="DOB" />
          </div>
          <div class="input-box">
            <span class="details">Mobile Number</span>
            <input type="text" placeholder="Enter Mobile No." value="<?php echo $_SESSION['Mobile'] ?>" name="Mobile" />
          </div>
          <div class="input-box">
            <span class="details">Aadhar Number</span>
            <input type="text" placeholder="Enter Aadhar No." maxlength="12" value="<?php echo $_SESSION['Aadhar'] ?>" name="Aadhar" />
          </div>
          <div class="gender-details">
            <span class="gender-title">Siblings</span>
            <div class="category">
              <input type="radio" id="yes" value="Yes" name="Siblings" <?php echo ($_SESSION['Sibling_Status'] == 'Yes') ? 'checked' : '' ?> />
              <span><label for="yes">Yes</label></span>
              <input type="radio" id="no" value="No" name="Siblings" <?php echo ($_SESSION['Sibling_Status'] == 'No') ? 'checked' : '' ?> />
              <span><label for="no">No</label></span>
            </div>
          </div>
          <div class="input-box no_siblings" <?php echo ($_SESSION['Sibling_Status'] == 'Yes') ? '' : 'hidden' ?>><span>No. Of Siblings</span>
            <div class="quantity">
              <span class="quantity__minus"><span>-</span></span>
              <input name="No_Of_Siblings" type="text" class="quantity__input no_of_siblings" value="0" readonly>
              <span class="quantity__plus"><span>+</span></span>
            </div>
          </div>
        </div>
        <div class="title siblings-title" <?php echo ($_SESSION['Sibling_Status'] == 'Yes') ? '' : 'hidden' ?>>Siblings Details</div>
        <div class="user-details siblings-section">
          <?php
          if ($_SESSION['Sibling_Status'] == "Yes") {
            $siblings = explode(',', $_SESSION['Siblings']);
            echo "<script>document.querySelector('.no_of_siblings').value = '" . count($siblings) . "'</script>";
            $classes = array();
            foreach ($siblings as $sibling) {
              $query1 = mysqli_query($link, "SELECT Stu_Class,Stu_Section FROM `student_master_data` WHERE Id_No = '$sibling'");
              while ($row1 = mysqli_fetch_assoc($query1)) {
                $classes[$sibling] = $row1['Stu_Class'] . ' ' . $row1['Stu_Section'];
              }
              echo '
              <div class="all_siblings input-box">
                <span>Sibling Id No.</span>
                <input type="text" placeholder="Enter Sibling Id No" id="id_no[]" name="Sib_Id_No[]" value = "' . $sibling . '" oninput="this.value = this.value.toUpperCase()"/>
              </div>
              <div class="all_siblings input-box">
                <span>Sibling Class</span>
                <input type="text" placeholder="Enter Sibling Class" value = "' . $classes[$sibling] . '" id="sib_class[]" name="Sib_Class[]" readonly/>
              </div>';
            }
          }
          ?>
        </div>
        <div class="title">Student Address Details</div>
        <div class="user-details">
          <div class="gender-details">
            <span class="gender-title">Religion</span>
            <div class="category">
              <input type="radio" name="Religion" id="indian-hindu" value="Indian-Hindu" <?php echo (strcasecmp($_SESSION['Religion'], 'Indian-Hindu')) ? '' : 'checked' ?> />
              <span><label for="indian-hindu">Indian-Hindu</label></span>
              <input type="radio" name="Religion" id="indian-islam" value="Indian-Islam" <?php echo (strcasecmp($_SESSION['Religion'], 'Indian-Islam')) ? '' : 'checked' ?> />
              <span><label for="indian-islam">Indian-islam</label></span>
              <input type="radio" name="Religion" id="indian-christian" value="Indian-Christian" <?php echo (strcasecmp($_SESSION['Religion'], 'Indian-Christian')) ? '' : 'checked' ?> />
              <span><label for="indian-christian">Indian-Christian</label></span>
            </div>
          </div>
          <div class="input-box">
            <span class="details">Caste</span>
            <input type="text" placeholder="Enter Caste" value="<?php echo $_SESSION['Caste'] ?>" name="Caste" />
          </div>
          <div class="input-box">
            <span class="details">Category</span>
            <select name="Category" id="category">
              <option value="selectcategory" disabled>--Select Category--</option>
              <option value="OC">OC</option>
              <option value="BC">BC</option>
              <option value="ST">ST</option>
              <option value="SC">SC</option>
              <option value="Mi">Mi</option>
            </select>
          </div>
          <div class="input-box">
            <span class="details">House No.</span>
            <input type="text" placeholder="Enter House No." value="<?php echo $_SESSION['House_No'] ?>" name="House_No" />
          </div>
          <div class="input-box">
            <span class="details">Area</span>
            <input type="text" placeholder="Enter Area" value="<?php echo $_SESSION['Area'] ?>" name="Area" />
          </div>
          <div class="input-box">
            <span class="details">Village/Town</span>
            <input type="text" placeholder="Enter Village" value="<?php echo $_SESSION['Village'] ?>" name="Village" />
          </div>
        </div>
        <div class="title">Other Details</div>
        <div class="user-details">
          <div class="input-box">
            <span class="details">Date of Join</span>
            <input type="date" id="doj" name="DOJ" />
          </div>
          <div class="input-box">
            <span class="details">Previous School</span>
            <input type="text" placeholder="Enter Previous School" value="<?php echo $_SESSION['Previous_School'] ?>" name="Previous_School" />
          </div>
          <div class="input-box">
            <span class="details">Van Route</span>
            <select class="form-control" name="Van_Route" id="van_route">
              <option value="selectroute" selected disabled>-- Select Route --</option>
              <?php
              $van_sql = mysqli_query($link, "SELECT Van_Route FROM `van_route`");
              while ($van_row = mysqli_fetch_assoc($van_sql)) {
                echo '<option value="' . $van_row['Van_Route'] . '"';
                if ($_SESSION['Van_Route'] == $van_row['Van_Route']) {
                  echo 'selected';
                }
                echo '>' . $van_row['Van_Route'] . '</option>';
              }
              ?>
              <option value="Drop" <?php if ($_SESSION['Van_Route'] == "Drop") {
                                      echo 'selected';
                                    } ?>>Drop</option>
            </select>
          </div>
          <div class="input-box">
            <span class="details">Referred By</span>
            <input type="text" placeholder="Enter Referred By" value="<?php echo $_SESSION['Referred_By'] ?>" name="Referred_By" />
          </div>
        </div>
        <div class="button">
          <input type="submit" name="update" value="Update" />
          <input type="reset" value="Reset" />
        </div>
      </form>
    </div>
  </div>


  <!-- Scripts -->

  <!-- Set Values of Class, Section, Category, DOB, DOJ -->
  <script type="text/javascript">
    $(document).ready(function() {
      stuclass = '<?php echo $_SESSION['Stu_Class'] ?>';
      stusection = '<?php echo $_SESSION['Stu_Section'] ?>';
      category = '<?php echo $_SESSION['Category'] ?>';
      var dob = '<?php echo $_SESSION['DOB'] ?>';
      date1 = dob.substring(0, 2);
      month1 = dob.substring(3, 5);
      year1 = dob.substring(6, 10);
      var doj = '<?php echo $_SESSION['DOJ'] ?>';
      date2 = doj.substring(0, 2);
      month2 = doj.substring(3, 5);
      year2 = doj.substring(6, 10);
      if (stuclass.toLowerCase().includes("others") || stuclass.toLowerCase().includes("drop")) {
        $('#class').find('option[value="selectclass"]').attr('selected', 'selected');
        $('#section').find('option[value="selectsection"]').attr('selected', 'selected');
        $('#pass_class').val(stuclass);
      } else {
        $('#pass_class').val(' ');
        $('#class').find('option[value="' + stuclass + '"]').attr('selected', 'selected');
        $('#section').find('option[value="' + stusection + '"]').attr('selected', 'selected');
      }
      $('#category').find('option[value="' + category + '"]').attr('selected', 'selected');
      $('#dob').val(year1 + '-' + month1 + '-' + date1);
      $('#doj').val('20' + year2 + '-' + month2 + '-' + date2);
    });
  </script>

  <!-- Add/Remove Slider and Sibling Text Boxes -->
  <script type="text/javascript">
    function add_Ele(val) {
      if (val != '-1') {
        sibling = '<div class="all_siblings input-box"><span>Sibling Id No.</span><input type="text" placeholder="Enter Sibling Id No" id="id_no[' + parseInt($('.no_of_siblings').val()) + ']" name="Sib_Id_No[]" oninput="this.value = this.value.toUpperCase()"/></div><div class="all_siblings input-box"><span>Sibling Class</span><input type="text" placeholder="Enter Sibling Class" id="sib_class[' + parseInt($('.no_of_siblings').val()) + ']" name="Sib_Class[]" readonly/></div>'
        $('.siblings-section').append(sibling)
      } else {
        if ($('.no_of_siblings').val() > 1)
          $('.siblings-section').children().last().remove()
        $('.siblings-section').children().last().remove()
      }
    }

    document.body.addEventListener('change', function(e) {
      if (e.target.id == "yes") {
        document.querySelector('.siblings-title').hidden = '';
        $('.main-section').append('<div class="input-box no_siblings"><span>No. Of Siblings</span><div class="quantity"><span class="quantity__minus"><span>-</span></span><input name="No_Of_Siblings" type="text" class="quantity__input no_of_siblings" value="0"readonly><span class="quantity__plus"><span>+</span></span></div></div>')
        $(document).ready(function() {
          const minus = $('.quantity__minus');
          const plus = $('.quantity__plus');
          const input = $('.quantity__input');
          minus.click(function(e) {
            e.preventDefault();
            var value = input.val();
            if (value > 1) {
              value--;
            }
            input.val(value);
          });

          plus.click(function(e) {
            e.preventDefault();
            var value = input.val();
            value++;
            input.val(value);
          })
        });
        $('.quantity__minus').click(() => {
          if ($('.no_of_siblings').val() > 1)
            add_Ele(-1)
        });
        $('.quantity__plus').on('click', function() {
          add_Ele(1)
        });

      } else if (e.target.id == "no") {
        document.querySelector('.siblings-title').hidden = 'hidden';
        $('.no_siblings').remove()
        $('.all_siblings').remove()
      }
    });
    $(document).ready(function() {
      const minus = $('.quantity__minus');
      const plus = $('.quantity__plus');
      const input = $('.quantity__input');
      minus.click(function(e) {
        e.preventDefault();
        var value = input.val();
        if (value > 1) {
          value--;
        }
        input.val(value);
      });

      plus.click(function(e) {
        e.preventDefault();
        var value = input.val();
        value++;
        input.val(value);
      })
    });
    $('.quantity__minus').click(() => {
      if ($('.no_of_siblings').val() > 1)
        add_Ele(-1)
    });
    $('.quantity__plus').on('click', function() {
      add_Ele(1)
    });
  </script>

  <!-- Getting Id No of Each Sibling -->
  <script type="text/javascript">
    $(document).on('change', function(e) {
      if (e.target.id.includes('id_no[')) {
        sib_class = "sib_class[" + e.target.id.split('[')[1].charAt(0) + "]"
        id_no = document.getElementById(e.target.id).value
        original_id = document.getElementById('id_no').value
        if (id_no == original_id) {
          alert('Sibling Id and Student Id are Same')
        } else {
          $.ajax({
            type: 'post',
            url: 'temp.php',
            data: {
              Id_No: id_no,
            },
            success: function(data) {
              if (data == "0") {
                alert('No Student Found With ' + id_no)
              } else {
                document.getElementById(sib_class).value = data
              }
            }
          });
        }
      }
    });
  </script>
</body>

</html>