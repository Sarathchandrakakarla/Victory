<?php
include '../../link.php';
session_start();
if (!$_SESSION['Admin_Id_No']) {
    echo "<script>
  alert('Admin Id Not Rendered');
  location.replace('../admin_login.php');
  </script>";
}
error_reporting(0);
?>
<?php

if (isset($_POST['Ok'])) {
    if ($_POST['Type']) {
        $type = $_POST['Type'];
        $date = $_POST['DOP'];
        $_SESSION['DOP'] = $date;
        if ($_POST['Id_No']) {
            $id = $_POST['Id_No'];
            $query1 = mysqli_query($link, "SELECT * FROM `student_master_data` WHERE Id_No = '$id'");
            if (mysqli_num_rows($query1) == 0) {
                echo "<script>alert('No Student Found!')</script>";
            } else {
                while ($row = mysqli_fetch_assoc($query1)) {
                    $name = $row['First_Name'];
                    if ($type == "Vehicle Fee") {
                        $route = $row['Van_Route'];
                    }
                }
            }
        } else {
            echo "<script>alert('Please Enter ID No!')</script>";
        }
    } else {
        echo "<script>alert('Please Select Fee Type!')</script>";
    }
}

if (isset($_POST['add'])) {
    if ($_POST['Type']) {
        $type = $_POST['Type'];
        $date = $_POST['DOP'];
        $_SESSION['DOP'] = $date;
        if ($_POST['Id_No']) {
            $id = $_POST['Id_No'];
            $query1 = mysqli_query($link, "SELECT * FROM `student_master_data` WHERE Id_No = '$id'");
            while ($row = mysqli_fetch_assoc($query1)) {
                $name = $row['First_Name'];
                $class = $row['Stu_Class'];
                $section = $row['Stu_Section'];
                $route = $row['Van_Route'];
            }
        } else {
            echo "<script>alert('Please Enter ID No!')</script>";
        }
        if ($_POST['Amount']) {
            $amount = $_POST['Amount'];
            $arr = explode('-', $date);
            $month = $arr[1];
            switch ($month) {
                case 1:
                    $month = "Jan";
                    break;
                case 2:
                    $month = "Feb";
                    break;
                case 3:
                    $month = "Mar";
                    break;
                case 4:
                    $month = "Apr";
                    break;
                case 5:
                    $month = "May";
                    break;
                case 6:
                    $month = "Jun";
                    break;
                case 7:
                    $month = "Jul";
                    break;
                case 8:
                    $month = "Aug";
                    break;
                case 9:
                    $month = "Sep";
                    break;
                case 10:
                    $month = "Oct";
                    break;
                case 11:
                    $month = "Nov";
                    break;
                case 12:
                    $month = "Dec";
                    break;
            }
            $temp = $arr[0];
            $arr[0] = $arr[2];
            $arr[1] = $month;
            $arr[2] = $temp;

            $date = implode("-", $arr);
            if ($_POST['Bill_No']) {
                $bill = $_POST['Bill_No'];
                if ($type == "Vehicle Fee") {
                    $sql = "INSERT INTO `stu_paid_fee` VALUES('','$id','$name','$type','$class','$section','$amount','$date','$bill','$route')";
                    /* Excluded on 05-02-23
                    $sql1 = mysqli_query($link, "SELECT * FROM `fee_balances` WHERE Id_No = '$id' AND Type = '$type'");
                    while ($row = mysqli_fetch_assoc($sql1)) {
                        $balance = $row['Balance'];
                    }
                    $balance -= $amount;
                    $sql2 = "UPDATE `fee_balances` SET Balance = '$balance' WHERE Id_No = '$id' AND Type = '$type'";
                    */
                } else {
                    $sql = "INSERT INTO `stu_paid_fee` VALUES('','$id','$name','$type','$class','$section','$amount','$date','$bill','0')";
                    /* Excluded on 05-02-23
                    $sql1 = mysqli_query($link, "SELECT * FROM `fee_balances` WHERE Id_No = '$id' AND Type = '$type'");
                    while ($row = mysqli_fetch_assoc($sql1)) {
                        $balance = $row['Balance'];
                    }
                    $balance -= $amount;
                    $sql2 = "UPDATE `fee_balances` SET Balance = '$balance' WHERE Id_No = '$id' AND Type = '$type'";
                    */
                }
                //$fee_balance_sql = mysqli_query($link,"SELECT * FROM `fee_balances` ");
                if(str_contains(strtolower($class),"others") || str_contains(strtolower($class),"drop")){
                    $fee_balance_sql = mysqli_query($link,"SELECT * FROM `stu_fee_master_data` WHERE Id_No = '$id' AND Type = '$type'");
                    while($fee_row = mysqli_fetch_assoc($fee_balance_sql)){
                        $balance = (int)$fee_row['Last_Balance'];
                    }
                    $balance -= (int)$amount;
                    mysqli_query($link,"UPDATE `stu_fee_master_data` SET Last_Balance = '$balance' WHERE Id_No = '$id' AND Type = '$type'");
                    mysqli_query($link,"UPDATE `fee_balances` SET Balance = '$balance' WHERE Id_No = '$id' AND Type = '$type'");
                }
                if (mysqli_query($link, $sql)) {
                    echo "<script>alert('Fee Inserted Successfully!!')</script>";
                } else {
                    echo "<script>alert('Fee Insertion Failed!!')</script>";
                }
            } else {
                echo "<script>alert('Please Enter Bill No.!')</script>";
            }
        } else {
            echo "<script>alert('Please Enter Amount!')</script>";
        }
    } else {
        echo "<script>alert('Please Select Fee Type!')</script>";
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
    <!-- Boxiocns CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <!-- Bootstrap Links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    .required {
        color: red;
        font-size: 20px;
    }

    .container {
        margin: 50px 350px;
        max-width: 700px;
        width: 100%;
        padding: 25px 30px;
        border-radius: 5px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        background-image: linear-gradient(to top, #37ecba 0%, #72afd3 100%);
    }

    .container .title {
        font-size: 25px;
        font-weight: 500;
        position: relative;
    }

    .container .title::before {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 5px;
        width: 100%;
        border-radius: 5px;
        background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }

    .content form .user-details {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 20px 0 12px 0;
    }

    form .user-details .input-box {
        margin-bottom: 15px;
        width: calc(100% / 2 - 20px);
    }

    form .input-box span.details {
        display: block;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .user-details .input-box input,
    select {
        height: 45px;
        width: 100%;
        outline: none;
        font-size: 16px;
        border-radius: 5px;
        padding-left: 15px;
        border: 1px solid #ccc;
        border-bottom-width: 2px;
        transition: all 0.3s ease;
    }

    .user-details .input-box input:focus,
    .user-details .input-box input:valid {
        border-color: #9b59b6;
    }

    form .gender-details .gender-title {
        font-size: 20px;
        font-weight: 500;
    }

    form .category {
        display: flex;
        width: 80%;
        margin: 14px 0;
        justify-content: space-between;
        font-size: large;
    }

    form .category input {
        margin-left: 20px;
    }

    form .button {
        height: 45px;
        margin: 35px 0;
    }

    form .button input {
        height: 100%;
        width: 100%;
        border-radius: 5px;
        border: none;
        color: #fff;
        font-size: 18px;
        font-weight: 500;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 5px;
        background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }

    form .button input:hover {
        /* transform: scale(0.99); */
        background: linear-gradient(-135deg, #71b7e6, #9b59b6);
    }

    @media (max-width: 584px) {
        .container {
            max-width: 70%;
            margin: 30px 80px;
        }

        form .user-details .input-box {
            margin-bottom: 15px;
            width: 100%;
        }

        form .category {
            width: 100%;
        }

        .content form .user-details {
            max-height: 300px;
            overflow-y: scroll;
        }

        .user-details::-webkit-scrollbar {
            width: 5px;
        }
    }

    @media (max-width: 459px) {
        .container .content .category {
            flex-direction: column;
        }
    }

    #sign-out {
        display: none;
    }

    @media screen and (min-width:600px) {
        #ok {
            margin-top: 30px;
            margin-left: 50px;
        }
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

    <div class="container">

        <div class="content">
            <div class="title">Student Fee Payment Entry</div>
            <form action="" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Fee Type<span class="required">*</span></span>
                        <select name="Type" id="type">
                            <option value="selectfeetype" disabled selected>-- Select Fee Type --</option>
                            <option value="School Fee" <?php if (isset($type) && $type == "School Fee") {
                                                            echo 'selected';
                                                        } else {
                                                            echo "";
                                                        } ?>>School Fee</option>
                            <option value="Admission Fee" <?php if (isset($type) && $type == "Admission Fee") {
                                                                echo 'selected';
                                                            } else {
                                                                echo "";
                                                            } ?>>Admission Fee</option>
                            <option value="Examination Fee" <?php if (isset($type) && $type == "Examination Fee") {
                                                                echo 'selected';
                                                            } else {
                                                                echo "";
                                                            } ?>>Examination Fee</option>
                            <option value="Computer Fee" <?php if (isset($type) && $type == "Computer Fee") {
                                                                echo 'selected';
                                                            } else {
                                                                echo "";
                                                            } ?>>Computer Fee</option>
                            <option value="Vehicle Fee" <?php if (isset($type) && $type == "Vehicle Fee") {
                                                            echo 'selected';
                                                        } else {
                                                            echo "";
                                                        } ?>>Vehicle Fee</option>
                            <option value="Book Fee" <?php if (isset($type) && $type == "Book Fee") {
                                                            echo 'selected';
                                                        } else {
                                                            echo "";
                                                        } ?>>Book Fee</option>
                        </select>
                    </div>
                    <div class="input-box">
                    </div>
                    <div class="input-box">
                        <span class="details">Id No. <span class="required">*</span></span>
                        <input type="text" placeholder="Enter Id No" value="<?php if (isset($id)) {
                                                                                echo $id;
                                                                            } else {
                                                                                echo "";
                                                                            } ?>" name="Id_No" oninput="this.value = this.value.toUpperCase()" required />
                    </div>
                    <div class="input-box">
                        <span class="details"></span>
                        <button class="btn btn-primary" id="ok" name="Ok">OK</button>
                    </div>
                    <div class="input-box">
                        <span class="details">Full Name</span>
                        <input type="text" name="First_Name" value="<?php if (isset($name)) {
                                                                        echo $name;
                                                                    } else {
                                                                        echo "";
                                                                    } ?>" disabled required />
                    </div>
                    <div class="input-box">
                        <span class="details">Route</span>
                        <input type="text" name="Route" id="route" value="<?php if (isset($route) && $type == "Vehicle Fee") {
                                                                                echo $route;
                                                                            } else {
                                                                                echo "";
                                                                            } ?>" disabled />
                    </div>
                    <div class="input-box">
                        <span class="details">Amount</span>
                        <input type="text" name="Amount" value="<?php if (isset($amount)) {
                                                                    echo $amount;
                                                                } ?>" />
                    </div>
                    <div class="input-box">
                        <span class="details">Date of Payment</span>
                        <input type="date" name="DOP" id="dop" value="<?php if (isset($_SESSION['DOP'])) {
                                                                            echo $_SESSION['DOP'];
                                                                        } else {
                                                                            echo date('Y-m-d');
                                                                        } ?>" />
                    </div>
                    <div class="input-box">
                        <span class="details">Bill No.</span>
                        <input type="text" id="last" value="<?php if (isset($bill)) {
                                                                echo $bill;
                                                            } else {
                                                                echo "";
                                                            } ?>" name="Bill_No" />
                    </div>
                </div>
                <div class="button">
                    <input type="submit" name="add" value="Insert" />
                </div>
            </form>
        </div>
    </div>
    <!-- Scripts -->

    <!-- Get Today Date -->
    <script>
        function getDate() {
            var today = new Date();
            date = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);
            document.getElementById("dop").value = date;
        }
    </script>
</body>

</html>