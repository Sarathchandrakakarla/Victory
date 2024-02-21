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
      <div class="row justify-content-center mt-4">
        <div class="col-lg-4">
          <button class="btn btn-primary" type="submit" name="show">Show</button>
          <button class="btn btn-warning" type="reset" onclick="hideTable()">Clear</button>
          <button class="btn btn-success" onclick="printDiv();return false;">Print</button>
          <button class="btn btn-success" onclick="return false;" id="export">Export To Excel</button>
        </div>
      </div>
    </div>
  </form>
  <div class="container">
    <div class="row justify-content-center mt-4">
      <div class="col-lg-5">
        <h3><b>Faculty Credentials Report</b></h3>
      </div>
    </div>
  </div>
  <div class="container table-container" id="table-container">
    <table hidden>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="font-size:30px;" colspan="4">VICTORY HIGH SCHOOL</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td style="font-size:25px;" colspan="2">Faculty Credentials</td>
      </tr>
    </table>
    <table class="table table-striped table-hover" border="1">
      <thead class="bg-secondary text-light">
        <tr>
          <th style="padding:5px;">S.No</th>
          <th style="padding:5px;">Id No. / Username</th>
          <th style="padding:5px;">First Name</th>
          <th style="padding:5px;">Password</th>
        </tr>
      </thead>
      <tbody id="tbody">
        <tr>
          <?php
          if (isset($_POST['show'])) {
              $sql = "SELECT Id_No,Faculty_Name,Password FROM faculty WHERE Id_No IN (SELECT Id_No FROM `employee_master_data` WHERE Id_No != 'VHST02674')";
              $result = mysqli_query($link,$sql);
              $i = 1;
              while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                <td style="padding:5px;">' . $i . '</td>
                <td style="padding:5px;">' . $row['Id_No'] . '</td>
                <td style="padding-left:5px;">' . $row['Faculty_Name'] . '</td>
                <td style="padding-left:5px;padding-right:5px;">' . $row['Password'] . '</td>
                </tr>';
                    $i++;
              }
          }
          ?>
        </tr>
      </tbody>
    </table>
  </div>
  <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>


  <!-- Scripts -->

  <!-- Export Table to Excel -->
  <script type="text/javascript">
    $('#export').on('click', function() {
      filename = 'faculty_credentials';
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

  <!-- Print Table -->
  <script type="text/javascript">
    function printDiv() {
      window.frames["print_frame"].document.body.innerHTML = "<h2 style='text-align:center;'>VICTORY HIGH SCHOOL</h2>";
      window.frames["print_frame"].document.body.innerHTML += "<h2 style='text-align:center;'>Faculty Credentials List</h2>";
      window.frames["print_frame"].document.body.innerHTML += document.querySelector('.table-container').innerHTML;
      window.frames["print_frame"].window.focus();
      window.frames["print_frame"].window.print();
    }
  </script>
</body>

</html>