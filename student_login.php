<?php
include 'link.php';
session_start(); 
if (isset($_POST['Login'])) {
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
    $uname = validate($_POST['UserName']);
    $pass = validate($_POST['Password']);
    if (empty($uname)) {
        echo "<script>alert('UserName is Empty');
    location.replace('student_login.html');</script>";
    }else if(empty($pass)){
        echo "<script>alert('Password is Empty');
    location.replace('student_login.html');</script>";
    }else{
        $sql = "SELECT * FROM student WHERE Id_No = '$uname'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $id = $row['Id_No'];
            $stu_hash = $row['Stu_Hash'];
            if(password_verify($pass,$stu_hash)){
                $_SESSION['Id_No'] = $id;
                $sql_ = "SELECT * FROM student_database WHERE Stu_Id_No = '$id'";
                $result_ = mysqli_query($link, $sql_);
                if (mysqli_num_rows($result_) == 1) {
                    $row = mysqli_fetch_assoc($result_);
                    $stu_id = $row['Stu_Id_No'];
                    $firstname = $row['First_Name'];
                    $surname = $row['Sur_Name'];
                    $fathername = $row['Father_Name'];
                    $mothername = $row['Mother_Name'];
                    $dob = $row['DOB'];
                    $gender = $row['Gender'];
                    $mobile = $row['Mobile'];
                    $aadhar = $row['Aadhar'];
                    $nation = $row['Nation'];
                    $state = $row['State'];
                    $district = $row['District'];
                    $houseno = $row['House_No'];
                    $area = $row['Area'];
                    $village = $row['Village'];
                    $pincode = $row['Pincode'];         
                    $_SESSION['Id_No']=$id;
                    $_SESSION['Stu_Id_No']=$stu_id;
                    $_SESSION['First_Name']=$firstname;
                    $_SESSION['Sur_Name']=$surname;
                    $_SESSION['Father_Name']=$fathername;
                    $_SESSION['Mother_Name']=$mothername;
                    $_SESSION['DOB']=$dob;
                    $_SESSION['Gender']=$gender;
                    $_SESSION['Mobile']=$mobile;
                    $_SESSION['Aadhar']=$aadhar;
                    $_SESSION['Nation']=$nation;
                    $_SESSION['State']=$state;
                    $_SESSION['District']=$district;
                    $_SESSION['House_No']=$houseno;
                    $_SESSION['Area']=$area;
                    $_SESSION['Village']=$village;
                    $_SESSION['PinCode']=$pincode;
                    header('Location: student_dashboard.php');
                }
                else{
                    echo "<script>alert('Id No is Not Added to Student Database!');
                    location.replace('student_dashboard.php');</script>";
                }
            }
            else{
                echo "<script>alert('Incorrect Password');
                location.replace('student_login.html');
                </script>";
            } 
        }
        else{
            echo "<script>alert('Incorrect UserName');
                location.replace('student_login.html');</script>";
        }
    }
}
else{
    echo "<script>alert('Login Variable is Not Declared');
    location.replace('student_login.html')</script>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head> 
		<meta charset="utf-8">
		<title>Victory EM School</title>
	</head>
</html>