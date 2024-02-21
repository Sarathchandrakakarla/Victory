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

  .table-container,
  .detail-container {
    max-width: 900px;
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
        <div class="col-lg-2">
          <label for="">Debiter's AC No: </label>
        </div>
        <div class="col-lg-2 rounded">
          <input type="text" class="form-control" name="AC_No" id="ac_no" oninput="this.value = this.value.toUpperCase()" required>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row justify-content-center mt-4">
        <div class="col-lg-3">
          <button class="btn btn-primary" type="submit" name="show">Show</button>
          <button class="btn btn-warning" type="reset" onclick="document.querySelector('.table-container').hidden = 'hidden';document.querySelector('.detail-container').hidden = 'hidden';">Clear</button>
          <button class="btn btn-success" onclick="printDiv();return false;">Print</button>
        </div>
      </div>
    </div>
  </form>
  <div class="container">
    <div class="row justify-content-center mt-4">
      <div class="col-lg-5">
        <h3><b>Debiter's Transactions Details Report</b></h3>
      </div>
    </div>
  </div>
  <?php
  if (isset($_POST['show'])) {
    $ac_no = $_POST['AC_No'];
    echo "<script>document.getElementById('ac_no').value = '" . $ac_no . "'</script>";
    $query1 = mysqli_query($link, "SELECT * FROM `debiter_master_data` WHERE AC_No = '$ac_no'");
    if (mysqli_num_rows($query1) == 0) {
      echo "<script>alert('Debiter Not Found!');</script>";
    } else {
      echo '
      <div class="container table-container">
        <table class="table table-striped" border="1">
          <thead>
            <th>AC No.</th>
            <th>Debiter Name</th>
            <th>Address</th>
            <th>Mobile</th>
            <th>Total Amount</th>
            <th>Date of Commitment</th>
            <th>Amount Paid</th>
            <th>Balance</th>
          </thead>
          <tbody>
          ';
      $amount = 0;
      while ($row1 = mysqli_fetch_assoc($query1)) {
        $amount = (int)$row1['Amount'];
        echo '
            <tr>
              <td>' . $row1['AC_No'] . '</td>
              <td>' . $row1['Name'] . '</td>
              <td>' . $row1['Address'] . '</td>
              <td>' . $row1['Mobile'] . '</td>
              <td id="amount">' . $row1['Amount'] . '</td>
              <td>' . $row1['DOC'] . '</td>
              <td id="paid"></td>
              <td id="balance"></td>
            ';
      }
      echo '</tbody>
        </table>
      </div>
      ';
      $query2 = mysqli_query($link, "SELECT * FROM `tran_details` WHERE AC_No = '$ac_no'");
      echo '
      <div class="container detail-container">
        <table class="table table-striped" border="1" style="width:100%;">
          <thead>
            <th>S No.</th>
            <th>Amount</th>
            <th>Date of Payment</th>
            <th>Bill No.</th>
            <th>Purpose</th>
          </thead>
          <tbody>
          ';
      if (mysqli_num_rows($query2) == 0) {
        echo '
            <tr>
              <td colspan="5" style="text-align:center;">No Transactions Done Yet!</td>
            </tr>
            ';
        echo "<script>
        document.getElementById('paid').innerHTML = 0;
        document.getElementById('balance').innerHTML = document.getElementById('amount').innerHTML;
        </script>";
      } else {
        $i = 1;
        $paid = 0;
        while ($row2 = mysqli_fetch_assoc($query2)) {
          echo '
                  <tr>
                    <td>' . $i . '</td>
                    <td>' . $row2['Amount'] . '</td>
                    <td>' . $row2['DOP'] . '</td>
                    <td>' . $row2['Bill_No'] . '</td>
                    <td>' . $row2['Purpose'] . '</td>
                  ';
          $paid  += $row2['Amount'];
          echo "<script>
          document.getElementById('paid').innerHTML = " . $paid . ";
          document.getElementById('balance').innerHTML = " . ($amount - $paid) . ";
          </script>";
          $i++;
        }
      }
      echo '</tbody>
        </table>
      </div>
      ';
    }
  }
  ?>
  <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>


  <!-- Scripts -->

  <!-- Print Table --> 
  <script type="text/javascript">
    function printDiv() {
      window.frames["print_frame"].document.body.innerHTML = "<h2 style='text-align:center;'>VICTORY HIGH SCHOOL</h2>";
      window.frames["print_frame"].document.body.innerHTML += "<h2 style='text-align:center;'>Debiter's Transactions Details</h2>";
      window.frames["print_frame"].document.body.innerHTML += document.querySelector('.table-container').innerHTML + '<br><br>';
      window.frames["print_frame"].document.body.innerHTML += document.querySelector('.detail-container').innerHTML;
      window.frames["print_frame"].window.focus();
      window.frames["print_frame"].window.print();
    }
  </script>
</body>

</html>