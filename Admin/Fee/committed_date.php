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

function format_date($date)
{
    $dob = explode('-', $date);
    $temp = $dob[0];
    $dob[0] = $dob[2];
    $dob[2] = $temp;

    $date = implode('-', $dob);
    return $date;
}
function reset_date($date)
{
    $dob = explode('-', $date);
    $temp = $dob[0];
    $dob[0] = $dob[2];
    $dob[2] = $temp;

    $date = implode('-', $dob);
    return $date;
}

if (isset($_POST['Ok'])) {
    if ($_POST['Id_No']) {
        $id = $_POST['Id_No'];
        $date = $_POST['DOC'];

        //Queries
        $query1 = mysqli_query($link, "SELECT First_Name,Stu_Class FROM `student_master_data` WHERE Id_No = '$id'");
        if ($query1) {
            if (mysqli_num_rows($query1) == 0) {
                echo "<script>alert('No Student Found!')</script>";
            } else {
                while ($row1 = mysqli_fetch_assoc($query1)) {
                    if (str_contains($row1['Stu_Class'], "Others") || str_contains($row1['Stu_Class'], "DROP")) {
                        echo "<script>alert('Student Passedout or Dropped!!')</script>";
                    } else {
                        $name = $row1['First_Name'];
                    }
                }
            }
        }
    } else {
        echo "<script>alert('Please Enter Id_No!')</script>";
    }
}

if (isset($_POST['add'])) {
    $date = $_POST['DOC'];
    if ($_POST['Id_No']) {
        $id = $_POST['Id_No'];
        $name = $_POST['Name'];
        if ($_POST['Type']) {
            $type = $_POST['Type'];
            $status = $_POST['Status'];

            //Queries
            $query1 = mysqli_query($link, "SELECT * FROM `student_master_data` WHERE Id_No = '$id'");
            if ($query1) {
                if (mysqli_num_rows($query1) == 0) {
                    echo "<script>alert('No Student Found')</script>";
                } else {
                    while ($row = mysqli_fetch_assoc($query1)) {
                        $class = $row['Stu_Class'];
                    }
                    if (str_contains($class, "Others")) {
                        echo "<script>alert('Student Passed Out!')</script>";
                    } else {
                        $date = format_date($date);
                        $check_query = mysqli_query($link, "SELECT * FROM `commit_date` WHERE Id_No = '$id' AND DOC = '$date' AND Type = '$type'");
                        if (mysqli_num_rows($check_query) > 0) {
                            echo "<script>alert('Student Already Inserted!')</script>";
                        } else {
                            $query2 = mysqli_query($link, "INSERT INTO `commit_date` VALUES('','$id','$type','$date','$status')");
                            if ($query2) {
                                echo "<script>alert('Student Inserted Successfully!')</script>";
                            } else {
                                echo "<script>alert('Student Insertion Failed!')</script>";
                            }
                        }
                        $date = reset_date($date);
                    }
                }
            }
        } else {
            echo "<script>alert('Please Select Fee Type!')</script>";
        }
    } else {
        echo "<script>alert('Please Enter Id No.')</script>";
    }
}

if (isset($_POST['update'])) {
    $date = $_POST['DOC'];
    $date = format_date($date);
    if ($_POST['Id_No']) {
        $id = $_POST['Id_No'];
        if ($_POST['Type']) {
            $type = $_POST['Type'];
            $status = $_POST['Status'];
            $query = mysqli_query($link, "UPDATE `commit_date` SET Status = '$status' WHERE Id_No = '$id' AND DOC = '$date' AND Type = '$type'");
            if ($query) {
                echo "<script>alert('Data Updated Successfully!')</script>";
            } else {
                echo "<script>alert('Updation Failed!')</script>";
            }
        } else {
            echo "<script>alert('Please Select Fee Type!')</script>";
        }
    } else {
        echo "<script>alert('Please Enter Id No.')</script>";
    }
    $date = reset_date($date);
}

if (isset($_POST['delete'])) {
    $date = $_POST['DOC'];
    $date = format_date($date);
    if ($_POST['Id_No']) {
        $id = $_POST['Id_No'];
        if ($_POST['Type']) {
            $type = $_POST['Type'];
            $status = $_POST['Status'];
            $query = mysqli_query($link, "DELETE FROM `commit_date` WHERE Id_No = '$id' AND DOC = '$date' AND Type = '$type'");
            if ($query) {
                echo "<script>alert('Data Deleted Successfully!')</script>";
            } else {
                echo "<script>alert('Deletion Failed!')</script>";
            }
        } else {
            echo "<script>alert('Please Select Fee Type!')</script>";
        }
    } else {
        echo "<script>alert('Please Enter Id No.')</script>";
    }
    $date = reset_date($date);
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

    .entry-container {
        margin: 50px 350px;
        max-width: 700px;
        width: 100%;
        height: 700px;
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

        .entry-container {
            height: 660px;
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

    .table-container {
        max-width: 1300px;
        max-height: 500px;
        overflow-x: scroll;
    }

    .bx-edit {
        cursor: pointer;
        font-size: large;
        padding: 5px;
    }
</style>

<body>
    <?php include '../sidebar.php'; ?>

    <div class="container entry-container">

        <div class="content">
            <div class="title">Committed Date Entry</div>
            <form action="" method="POST" autocomplete="off">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Date of Commitment<span class="required">*</span></span>
                        <input type="date" name="DOC" id="doc" value="<?php if (isset($date)) {
                                                                            echo $date;
                                                                        } else {
                                                                            echo date("Y-m-d");
                                                                        } ?>" required>
                    </div>
                    <div class="gender-details">
                        <span class="gender-title">View By</span>
                        <div class="category">
                            <input type="radio" id="id_wise" value="Id_Wise" name="View_By" checked />
                            <span><label for="id_wise">Id</label></span>
                            <input type="radio" id="date_wise" value="Date_Wise" name="View_By" />
                            <span><label for="date_wise">Date</label></span>
                        </div>
                    </div>
                    <div class="input-box">
                        <span class="details">Id No.</span>
                        <input type="text" placeholder="Enter Id No" value="<?php if (isset($id)) {
                                                                                echo $id;
                                                                            } ?>" name="Id_No" id="id_no" oninput="this.value = this.value.toUpperCase()" />
                    </div>
                    <div class="input-box">
                        <span class="details"></span>
                        <button class="btn btn-primary" id="ok" name="Ok">OK</button>
                    </div>
                    <div class="input-box">
                        <span class="details">Student Name</span>
                        <input type="text" value="<?php if (isset($name)) {
                                                        echo $name;
                                                    } ?>" name="Name" id="name" readonly required />
                    </div>
                    <div class="input-box">
                        <span class="details">Type of Fee</span>
                        <select class="details" name="Type" id="type">
                            <option value="selectfeetype" selected disabled>-- Select Fee Type --</option>
                            <option value="School Fee" <?php if (isset($type) && $type == "School Fee") {
                                                            echo "selected";
                                                        } else {
                                                            echo "";
                                                        } ?>>School Fee</option>
                            <option value="Examination Fee" <?php if (isset($type) && $type == "Examination Fee") {
                                                                echo "selected";
                                                            } else {
                                                                echo "";
                                                            } ?>>Examination Fee</option>
                            <option value="Computer Fee" <?php if (isset($type) && $type == "Computer Fee") {
                                                                echo "selected";
                                                            } else {
                                                                echo "";
                                                            } ?>>Computer Fee</option>
                            <option value="Admission Fee" <?php if (isset($type) && $type == "Admission Fee") {
                                                                echo "selected";
                                                            } else {
                                                                echo "";
                                                            } ?>>Admission Fee</option>
                            <option value="Vehicle Fee" <?php if (isset($type) && $type == "Vehicle Fee") {
                                                            echo "selected";
                                                        } else {
                                                            echo "";
                                                        } ?>>Vehicle Fee</option>
                            <option value="Book Fee" <?php if (isset($type) && $type == "Book Fee") {
                                                            echo "selected";
                                                        } else {
                                                            echo "";
                                                        } ?>>Book Fee</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Payment Status</span>
                        <select class="details" name="Status" id="status">
                            <option value="Pending" <?php if (isset($status) && $status == "Pending") {
                                                        echo "selected";
                                                    } else {
                                                        echo "";
                                                    } ?>>Pending</option>
                            <option value="Paid" <?php if (isset($status) && $status == "Paid") {
                                                        echo "selected";
                                                    } else {
                                                        echo "";
                                                    } ?>>Paid</option>
                        </select>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" name="add" value="Insert" />
                    <input type="submit" name="view" value="View" />
                    <input type="submit" name="update" value="Update" />
                    <input type="submit" name="delete" value="Delete" onclick="if(!confirm('Confirm to Delete Student Committed Date?')){return false;}else{return true;}" />
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-3">
                <button class="btn btn-success" id="ok" onclick="printDiv();return false;">Print</button>
            </div>
        </div>
    </div>

    <div class="container table-container">
        <table class="table table-striped">
            <thead>
                <th>S.No</th>
                <th>Id No.</th>
                <th>Name</th>
                <th>Class</th>
                <th>Father Name</th>
                <th>Phone Number</th>
                <th>Type of Fee</th>
                <th id="route_head" hidden>Route</th>
                <th id="doc_head">Date of Commitment</th>
                <th>Payment Status</th>
                <th>Action</th>
            </thead>
            <tbody id="tbody">
                <?php

                if (isset($_POST['view'])) {
                    $view_by = $_POST['View_By'];

                    if ($view_by == "Id_Wise") {
                        echo "<script>document.getElementById('doc_head').hidden = '';</script>";
                        echo "<script>document.getElementById('id_wise').checked = true;</script>";
                        if ($_POST['Id_No']) {
                            $id = $_POST['Id_No'];
                            echo "<script>document.getElementById('id_no').value = '$id';</script>";
                            if ($_POST['Type']) {
                                $type = $_POST['Type'];
                                echo "<script>document.getElementById('type').value = '$type';</script>";
                                $query3 = mysqli_query($link, "SELECT * FROM `commit_date` WHERE Id_No = '$id' AND Type = '$type'");
                                if (mysqli_num_rows($query3) == 0) {
                                    echo "<script>alert('No Entries Found with " . $id . "!')</script>";
                                } else {
                                    $query4 = mysqli_query($link, "SELECT First_Name,Stu_Class,Stu_Section,Father_Name,Mobile,Van_Route FROM `student_master_data` WHERE Id_No = '$id'");
                                    while ($row1 = mysqli_fetch_assoc($query4)) {
                                        $name = $row1['First_Name'];
                                        $class = $row1['Stu_Class'];
                                        $section = $row1['Stu_Section'];
                                        $mobile = $row1['Mobile'];
                                        $father_name = $row1['Father_Name'];
                                        $route = $row1['Van_Route'];
                                    }
                                    $i = 1;
                                    while ($row2 = mysqli_fetch_assoc($query3)) {
                                        echo '<tr>
                                    <td>' . $i . '</td>
                                    <td>' . $row2['Id_No'] . '</td>
                                    <td>' . $name . '</td>
                                    <td>' . $class . ' ' . $section . '</td>
                                    <td>' . $father_name . '</td>
                                    <td>' . $mobile . '</td>
                                    <td>' . $row2['Type'] . '</td>';
                                        if ($type == "Vehicle Fee") {
                                            echo "<script>document.getElementById('route_head').hidden = '';</script>";
                                            echo '<td>' . $route . '</td>';
                                        } else {
                                            echo "<script>document.getElementById('route_head').hidden = 'hidden';</script>";
                                        }
                                        echo '<td>' . $row2['DOC'] . '</td>
                                    <td>' . $row2['Status'] . '</td>
                                    <td><i class="bx bx-edit text-primary modify"></i></td>
                                    </tr>';
                                        $i++;
                                    }
                                }
                            } else {
                                echo "<script>alert('Please Select Fee Type!')</script>";
                            }
                        } else {
                            echo "<script>alert('Please Enter Id No.')</script>";
                        }
                    } else {
                        echo "<script>document.getElementById('doc_head').hidden = 'hidden';</script>";
                        echo "<script>document.getElementById('date_wise').checked = true;</script>";
                        $date = $_POST['DOC'];
                        echo "<script>document.getElementById('doc').value = '$date';</script>";
                        if ($_POST['Type']) {
                            $type = $_POST['Type'];
                            echo "<script>document.getElementById('type').value = '$type';</script>";
                            $date = format_date($date);
                            $query5 = mysqli_query($link, "SELECT * FROM `commit_date` WHERE DOC = '$date' AND Type = '$type' AND Status = 'Pending'");

                            if ($query5) {
                                if (mysqli_num_rows($query5) == 0) {
                                    echo "<script>alert('No Entries Found on " . $date . "!')</script>";
                                } else {
                                    $i = 1;
                                    while ($row3 = mysqli_fetch_assoc($query5)) {
                                        $id = $row3['Id_No'];
                                        $query6 = mysqli_query($link, "SELECT First_Name,Stu_Class,Stu_Section,Father_Name,Mobile,Van_Route FROM `student_master_data` WHERE Id_No = '$id'");
                                        while ($row4 = mysqli_fetch_assoc($query6)) {
                                            echo '<tr>
                                        <td>' . $i . '</td>
                                        <td>' . $id . '</td>
                                        <td>' . $row4['First_Name'] . '</td>
                                        <td>' . $row4['Stu_Class'] . ' ' . $row4['Stu_Section'] . '</td>
                                        <td>' . $row4['Father_Name'] . '</td>
                                        <td>' . $row4['Mobile'] . '</td>
                                        <td>' . $row3['Type'] . '</td>';
                                            if ($type == "Vehicle Fee") {
                                                echo "<script>document.getElementById('route_head').hidden = '';</script>";
                                                echo '<td>' . $row4['Van_Route'] . '</td>';
                                            } else {
                                                echo "<script>document.getElementById('route_head').hidden = 'hidden';</script>";
                                            }

                                            echo '<td>' . $row3['Status'] . '</td>
                                        <td><i class="bx bx-edit text-primary modify"></i></td>
                                        </tr>';
                                        }
                                        $i++;
                                    }
                                }
                            }
                        } else {
                            echo "<script>alert('Please Select Fee Type!')</script>";
                        }
                    }
                }

                ?>
            </tbody>
        </table>
    </div>
    <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>

    <!-- Scripts -->

    <!-- Modify Row -->
    <script type="text/javascript">
        function format_date(date) {
            date = date.split('-');
            temp = date[0];
            date[0] = date[2];
            date[2] = temp;
            new_date = date[0] + "-" + date[1] + "-" + date[2];
            return new_date;
        }
        $(".modify").click(function() {
            id = $(this).parent().siblings().eq(1).text();
            name = $(this).parent().siblings().eq(2).text();
            if (document.getElementById('id_wise').checked) {
                if (document.getElementById('type').value == "Vehicle Fee") {
                    doc = $(this).parent().siblings().eq(9).text();
                    status = $(this).parent().siblings().eq(10).text();
                } else {
                    doc = $(this).parent().siblings().eq(8).text();
                    status = $(this).parent().siblings().eq(9).text();
                }
                doc = format_date(doc);
                $('#doc').val(doc);
            } else {
                if (document.getElementById('type').value == "Vehicle Fee") {
                    status = $(this).parent().siblings().eq(9).text();
                } else {
                    status = $(this).parent().siblings().eq(8).text();
                }
            }
            type = $(this).parent().siblings().eq(6).text();
            $('#id_no').val(id);
            $('#name').val(name);
            $('#type').val(type);
            $('#status').val(status);
        });
    </script>

    <!-- Print Table -->
    <script type="text/javascript">
        function printDiv() {
            window.frames["print_frame"].document.body.innerHTML = "<p style='text-align:center;font-size:35px;'>VICTORY HIGH SCHOOL</p>";
            window.frames["print_frame"].document.body.innerHTML += "<p style='text-align:center;font-size:20px;'>Commitment Date Details</p>";
            window.frames["print_frame"].document.body.innerHTML += "<div class = 'container'><table style='margin-bottom:8px;'><tr><td style='text-align:center;'>Date of Commitment:</td><td><?php if (isset($date)) {
                                                                                                                                                                                                    echo $date;
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo "";
                                                                                                                                                                                                } ?></td></tr></table></div>";
            window.frames["print_frame"].document.body.innerHTML += document.querySelector('.table-container').innerHTML;
            window.frames["print_frame"].window.focus();
            window.frames["print_frame"].window.print();
        }
    </script>

    <!-- Get Existing Data on that Date -->
    <script type="text/javascript">
        function myFunction(item, index) {
            text += index + ": " + item + "<br>";
        }
        $('#ac_no').on('focus', function() {
            date = document.getElementById('dop').value;
            $.ajax({
                type: 'post',
                url: 'temp.php',
                data: {
                    Date: date
                },
                success: function(data) {
                    document.querySelector('#tbody').innerHTML = data;
                }
            });
        });
    </script>

    <!-- Sidebar Open/Close -->
    <script type="text/javascript">
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
                arrowParent.classList.toggle("showMenu");
            });
        }

        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    </script>

    <!-- Update User Image -->
    <script type="text/javascript">
        async function saveImg() {
            let formData = new FormData();
            formData.append("file", getFile.files[0]);
            await fetch('../../php/img.php', {
                method: "POST",
                body: formData
            });
            alert('Image has been Uploaded');
        }
    </script>
</body>

</html>