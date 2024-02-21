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
        <div class="p-2 col-lg-4 rounded">
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
    </div>
    <div class="container">
      <div class="row justify-content-center mt-4">
        <div class="col-lg-4">
          <button class="btn btn-primary" type="submit" name="show">Show</button>
          <button class="btn btn-warning" type="reset" onclick="hideTable()">Clear</button>
          <button class="btn btn-success" onclick="printDiv();return false;">Print</button>
        </div>
      </div>
    </div>
  </form>
  <div class="container">
    <div class="row justify-content-center mt-4">
      <div class="col-lg-6">
        <h3><b>Class Wise Student Fee Remarks Report</b></h3>
      </div>
    </div>
  </div>
  <div class="container table-container" id="table-container">
    <?php
    if (isset($_POST['show'])) {
      if ($_POST['Class']) {
        $class = $_POST['Class'];
        echo "<script>document.getElementById('class').value = '" . $class . "'</script>";
        if ($_POST['Section']) {
          $section = $_POST['Section'];
          echo "<script>document.getElementById('class_label').innerHTML = '" . $class . ' ' . $section . "'</script>";
          echo "<script>document.getElementById('sec').value = '" . $section . "'</script>";
          $sql = "SELECT * FROM `student_master_data` WHERE Stu_Class = '$class' AND Stu_Section = '$section'";
          $result = mysqli_query($link, $sql);
          if (mysqli_num_rows($result) == 0) {
            echo "<script>alert('Class or Section Not Available!')</script>";
          } else {
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
              $mobile = '';
              if (str_contains($row['Mobile'], ',')) {
                $mobile = explode(',', $row['Mobile'], 2)[0];
              } else if (str_contains($row['Mobile'], ' ')) {
                $mobile = explode(' ', $row['Mobile'], 2)[0];
              } else {
                $mobile = $row['Mobile'];
              }
              echo '
                <table class="" style="border:2px solid black;width:100%;height:22%;margin-bottom:15px;font-size:11px;">
                <tbody>
                  <tr>
                    <th colspan="3" style="height:10px;text-align:center;">Victory High School</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th style="width:25%;height:10px;text-align:center;border-bottom:2px solid black;">Remarks</th>
                  </tr>
                  <tr>
                    <td colspan="2" style="height:10px;white-space:nowrap;">' . $row['First_Name'] . '</td>
                    <td colspan="2" rowspan="4" style="text-align:center;border-right:2px solid black;"><img src="/Victory/Images/VHST02674.jpg" style="border:2px solid black;" width="55px"></td>
                  </tr>
                  <tr>
                    <td style="height:10px;">' . $row['Stu_Class'] . ' ' . $row['Stu_Section'] . '</td>
                  </tr>
                  <tr>
                    <td style="width:30%;height:10px;white-space:nowrap;">' . $row['Father_Name'] . '</td>
                  </tr>
                  <tr>
                    <td style="height:10px;">' . $row['Area'] . '</td>
                  </tr>
                  <tr>
                    <td style="height:10px;">' . $row['Village'] . '</td>
                    <td></td>
                    <td></td>
                    <td style="border-right:2px solid black;"></td>
                  </tr>
                  <tr>
                    <td>OFFICE USE</td>
                    <td style="text-align:right;height:10px;">' . $mobile . '</td>
                    <td></td>
                    <td style="border-right:2px solid black;"></td>
                  </tr>
                  <tr>
                    <td style="border-top:2px solid black;">Id No.:</td>
                    <td style="border-top:2px solid black;">Adm No.:</td>
                    <td style="border-top:2px solid black;"></td>
                    <td style="border-top:2px solid black;border-right:2px solid black;"></td>
                  </tr>
                  <tr>
                    <td style="border-top:2px solid black;">Total Fee:</td>
                    <td style="border-top:2px solid black;white-space:nowrap;">Fee Finalized:</td>
                    <td style="border-top:2px solid black;"></td>
                    <td style="border-top:2px solid black;border-right:2px solid black;"></td>
                  </tr>
                  <tr>
                    <td style="border-top:2px solid black;border-bottom:2px solid black;">Term</td>
                    <td style="border-top:2px solid black;border-bottom:2px solid black;">Fee Paid</td>
                    <td style="width:15%;border-top:2px solid black;border-bottom:2px solid black;">Date</td>
                    <td style="width:15%;border-top:2px solid black;border-bottom:2px solid black;border-right:2px solid black;">Bill No.</td>
                  </tr>
                  <tr>
                    <td colspan="4" style="border-right:2px solid black;">Term - I</td>
                  </tr>
                  <tr>
                    <td colspan="4" style="border-right:2px solid black;">Term - II</td>
                  </tr>
                  <tr>
                    <td colspan="4" style="border-right:2px solid black;">Term - III</td>
                  </tr>
                </tbody>
                </table>
                ';
              $i++;
            }
          }
        } else {
          echo "<script>alert('Please Select Section!')</script>";
        }
      } else {
        echo "<script>alert('Please Select Class!')</script>";
      }
    }
    ?>
  </div>
  <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>


  <!-- Scripts -->

  <!-- Print Table -->
  <script type="text/javascript">
    function printDiv() {
      window.frames["print_frame"].document.body.innerHTML = document.querySelector('.table-container').innerHTML;
      window.frames["print_frame"].window.focus();
      window.frames["print_frame"].window.print();
    }
  </script>
</body>

</html>