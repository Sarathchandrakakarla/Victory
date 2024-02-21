<?php
session_start();
if (!$_SESSION['Admin_Id_No']) {
    echo "<script>
  alert('Admin Id Not Rendered');
  location.replace('../admin_login.php');
  </script>";
}
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Victory Schools</title>
    <link rel="shortcut icon" href="/Victory/Images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/Victory/css/sidebar-style.css" />

    <!-- Bootstrap Links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Boxiocns CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
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

    @media screen and (max-width:920px) {
        #sign-out {
            display: block;
        }
    }

    #ok {
        margin-top: 30px;
        margin-left: 50px;
    }
</style>

<body>
    <?php
    include '../sidebar.php';
    ?>

    <div class="container">

        <div class="content">
            <div class="title">Student Admission Entry Form</div>
            <form action="" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Admission Book <span class="required">*</span></span>
                        <select name="Book" id="book">
                            <option value="selectbook" selected disabled>-- Select Book --</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Admission No.</span>
                        <input type="text" placeholder="Enter Admission No" id="adm_no" name="Adm_No" required />
                    </div>
                    <div class="input-box">
                        <span class="details"></span>
                        <button class="btn btn-primary" id="ok" name="Ok">OK</button>
                    </div>
                    <div class="input-box">
                        <span class="details">Full Name</span>
                        <input type="text" placeholder="Enter Fullname" id="first_name" name="First_Name" />
                    </div>
                    <div class="input-box">
                        <span class="details">Surname</span>
                        <input type="text" placeholder="Enter Surname" id="sur_name" name="Sur_Name" />
                    </div>
                    <div class="input-box">
                        <span class="details">Name of Parent</span>
                        <input type="text" placeholder="Enter Parent Name" id="parent_name" name="Parent_Name" />
                    </div>
                    <div class="input-box">
                        <span class="details">Date Of Birth</span>
                        <input type="date" name="DOB" id="dob" />
                    </div>
                    <div class="input-box">
                        <span class="details">Residence</span>
                        <input type="text" placeholder="Enter Residence" name="Residence" id="residence" />
                    </div>
                    <div class="input-box">
                        <span class="details">Occupation</span>
                        <input type="text" placeholder="Enter Occupation" name="Occupation" id="occupation" />
                    </div>
                    <div class="input-box">
                        <span class="details">Previous School</span>
                        <input type="text" placeholder="Enter Previous School" id="previous_school" name="Previous_School" />
                    </div>
                    <div class="input-box">
                        <span class="details">Class Studied (Come)</span>
                        <select name="Class_Come" id="class_come">
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
                    <div class="gender-details">
                        <span class="gender-title">Gender</span>
                        <div class="category">
                            <input type="radio" id="boy" value="Boy" name="Gender" />
                            <span><label for="boy">Boy</label></span>
                            <input type="radio" id="girl" value="Girl" name="Gender" />
                            <span><label for="girl">Girl</label></span>
                        </div>
                    </div>
                    <div class="input-box">
                        <span class="details">TC No.</span>
                        <input type="text" id="tc_no" placeholder="Enter TC No." name="TC_No" />
                    </div>
                    <div class="input-box">
                        <span class="details">TC Produced</span>
                        <input type="text" placeholder="Enter TC Produced No." id="tc_pro" name="TC_Pro" />
                    </div>
                    <div class="input-box">
                        <span class="details">Date of Admission</span>
                        <input type="date" name="DOA" id="doa" />
                    </div>
                    <div class="input-box">
                        <span class="details">Mother Tongue</span>
                        <input type="text" placeholder="Enter Mother Tongue" id="mother_tongue" name="Mother_Tongue" />
                    </div>
                    <div class="input-box">
                        <span class="details">Nationality and State</span>
                        <input type="text" placeholder="Enter Nationality and State" id="nationality" name="Nationality" />
                    </div>
                    <div class="gender-details">
                        <span class="gender-title">Religion</span>
                        <div class="category">
                            <input type="radio" id="hindu" value="Hindu" name="Religion" />
                            <span><label for="hindu">Hindu</label></span>
                            <input type="radio" id="islam" value="Islam" name="Religion" />
                            <span><label for="islam">Islam</label></span>
                            <input type="radio" id="christian" value="Christian" name="Religion" />
                            <span><label for="christian">Christian</label></span>
                        </div>
                    </div>
                    <div class="input-box">
                        <span class="details">Caste</span>
                        <input type="text" placeholder="Enter Caste" name="Caste" id="caste" />
                    </div>
                    <div class="input-box">
                        <span class="details">Medium<span class="required">*</span></span>
                        <input type="text" placeholder="Enter Medium" name="Medium" id="medium" />
                    </div>
                    <div class="input-box">
                        <span class="details">Class of Admission</span>
                        <select name="Class_Admission" id="class_admission">
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
                        <span class="details">Class of Leaving</span>
                        <select name="Class_Leave" id="class_leave">
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
                        <span class="details">Date of Leaving</span>
                        <input type="date" name="DOL" id="dol" />
                    </div>
                    <div class="input-box">
                        <span class="details">No. and Date of TC Issued</span>
                        <input type="text" placeholder="Enter No. and Date of TC Issued" name="DOT" id="dot" />
                    </div>
                </div>
                <div class="button">
                    <input type="submit" name="update" value="Update" />
                    <input type="reset" value="Clear" />
                </div>
            </form>
        </div>
    </div>

    <?php include '../../link.php';
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
    function format_class($class)
    {
        for ($a = 1; $a <= 10; $a++) {
            if (strcmp($class, "$a") == 0) {
                $new_class = $class . ' CLASS';
                break;
            } else if (strcasecmp($class, "prekg") == 0 || strcasecmp($class, "lkg") == 0 || strcasecmp($class, "ukg") == 0) {
                $new_class = strtoupper($class);
                break;
            } else {
                $new_class = $class;
            }
        }
        return $new_class;
    }

    if (isset($_POST['Ok'])) {
        $book = $_POST['Book'];
        $adm_no = $_POST['Adm_No'];

        //Arrays
        $ids = array();

        $query = mysqli_query($link, "SELECT * FROM `admission" . $book . "` WHERE Adm_No LIKE '$adm_no/%'");
        if (mysqli_num_rows($query) == 0) {
            echo "<script>alert('No Student Found')</script>";
        } else {
            while ($row1 = mysqli_fetch_assoc($query)) {
                $ids["book"] = $book;
                $ids["adm_no"] = $row1['Adm_No'];
                $ids["first_name"] = $row1['First_Name'];
                $ids["sur_name"] = $row1['Sur_Name'];
                $ids["parent_name"] = $row1['Parent_Name'];
                $ids["dob"] = reset_date($row1['DOB']);
                $ids["residence"] = $row1['Residence'];
                $ids["occupation"] = $row1['Occupation'];
                $ids["previous_school"] = $row1['Previous_School'];
                $gender = $row1['Gender'];
                if (strcasecmp($gender, "Boy") == 0 || strcasecmp($gender, "m") == 0) {
                    $ids["boy"] = $gender;
                } else if (strcasecmp($gender, "Girl") == 0 || strcasecmp($gender, "f") == 0) {
                    $ids["girl"] = $gender;
                }
                $ids["tc_no"] = $row1['TC_No'];
                $ids["tc_pro"] = $row1['TC_Pro'];
                $ids["doa"] = reset_date($row1['DOA']);
                $ids["mother_tongue"] = $row1['Mother_Tongue'];
                $ids["nationality"] = $row1['Nationality'];
                $religion = $row1['Religion'];
                if (strcasecmp($religion, "Hindu") == 0) {
                    $ids['hindu'] = $religion;
                } else if (strcasecmp($religion, "Islam") == 0) {
                    $ids['islam'] = $religion;
                } else if (strcasecmp($religion, "Christian") == 0) {
                    $ids['christian'] = $religion;
                }
                $ids["caste"] = $row1['Caste'];
                $ids["medium"] = $row1['Medium'];
                $ids["class_admission"] = $row1['Class_Admission'];
                $ids["class_leave"] = $row1['Class_Leave'];
                $ids["class_come"] = format_class($row1['Class_Come']);
                $ids["class_admission"] = format_class($row1['Class_Admission']);
                $ids["class_leave"] = format_class($row1['Class_Leave']);
                if ($row1['DOL']  != "dd/mm/yyyy") {
                    $ids["dol"] = reset_date($row1['DOL']);
                }
                $ids["dot"] = $row1['DOT'];
            }
            foreach (array_keys($ids) as $id) {
                if ($id == "class_come" || $id == "class_admission" || $id == "class_leave") {
                    if ($ids["class_come"] == "") {
                        $ids["class_come"] = "selectclass";
                    } else if ($ids["class_admission"] == "") {
                        $ids["class_admission"] = "selectclass";
                    } else if ($ids["class_leave"] == "") {
                        $ids["class_leave"] = "selectclass";
                    }
                }
                if ($id == "boy" || $id == "girl"  || $id == "hindu"  || $id == "islam"  || $id == "christian") {
                    echo "<script>document.getElementById('" . $id . "').checked = true;</script>";
                } else {
                    echo "<script>document.getElementById('" . $id . "').value = '" . $ids[$id] . "'</script>";
                }
            }
        }
    }
    if (isset($_POST["update"])) {

        //Arrays
        $ids = array();

        //Optional
        $dob = $_POST['DOB'];
        $residence = $_POST['Residence'];
        $occupation = $_POST['Occupation'];
        $previous = $_POST['Previous_School'];
        $tc_no = $_POST['TC_No'];
        $tc_pro = $_POST['TC_Pro'];
        $doa = $_POST['DOA'];
        $mother_tongue = $_POST['Mother_Tongue'];
        $nationality = $_POST['Nationality'];
        $religion = $_POST['Religion'];
        $caste = $_POST['Caste'];
        $class_leave = $_POST['Class_Leave'];
        $dol = $_POST['DOL'];
        $dot = $_POST['DOT'];

        //Required
        $adm_no = $_POST['Adm_No'];
        $first_name = $_POST['First_Name'];
        $sur_name = $_POST['Sur_Name'];
        $parent_name = $_POST['Parent_Name'];
        $medium = $_POST['Medium'];

        if ($_POST['Gender']) {
            $gender = $_POST['Gender'];
            if ($_POST['Class_Come']) {
                $class_come = $_POST['Class_Come'];
                if ($_POST['Class_Admission']) {
                    $class_admission = $_POST['Class_Admission'];

                    $ids["dob"] = format_date($ids["dob"]);
                    $ids["doa"] = format_date($ids["doa"]);
                    $ids["dol"] = format_date($ids["dol"]);

                    $sql = "UPDATE `admission` SET First_Name = '$first_name', Sur_Name = '$sur_name', Parent_Name = '$parent_name',
                     DOB = '$dob', Residence = '$residence', Occupation = '$occupation', Previous_School = '$previous', Class_Come = '$class_come',
                     Gender = '$gender', TC_No = '$tc_no', TC_Pro = '$tc_pro',DOA = '$doa', Mother_Tongue = '$mother_tongue', Nationality = '$nationality',
                     Religion = '$religion',Caste = '$caste', Medium = '$medium', Class_Admission = '$class_admission', Class_Leave = '$class_leave',
                     DOL = '$dol', DOT = '$dot' WHERE Adm_No = '$adm_no'";

                    if (mysqli_query($link, $sql)) {
                        echo "<script>alert('Student Updated Successfully!!')</script>";
                    } else {
                        echo "<script>alert('Student Updation Failed!!')</script>";
                    }
                } else {
                    echo "<script>alert('Please Select Class of Admission!')</script>";
                }
            } else {
                echo "<script>alert('Please Select Class Studied (Come)!')</script>";
            }
        } else {
            echo "<script>alert('Please Select Gender!')</script>";
        }
        foreach (array_keys($ids) as $id) {
            $ids["dob"] = reset_date($ids["dob"]);
            $ids["doa"] = reset_date($ids["doa"]);
            $ids["dol"] = reset_date($ids["dol"]);
            if ($id == "class_come" || $id == "class_admission" || $id == "class_leave") {
                if (!$_POST['Class_Come']) {
                    $ids["class_come"] = "selectclass";
                } else if (!$_POST['Class_Admission']) {
                    $ids["class_admission"] = "selectclass";
                } else if (!$_POST['Class_Leave']) {
                    $ids["class_leave"] = "selectclass";
                }
            }
            if ($id == "boy" || $id == "girl"  || $id == "hindu"  || $id == "islam"  || $id == "christian") {
                echo "<script>document.getElementById('" . $id . "').checked = true;</script>";
            } else {
                echo "<script>document.getElementById('" . $id . "').value = '" . $ids[$id] . "'</script>";
            }
        }
    }
    ?>
</body>

</html>