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
        $error = "Username empty";
    }else if(empty($pass)){
        $error = "Password empty";
    }else{
        $sql = "SELECT * FROM student_database WHERE Id_No = '$uname'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $id = $row['Id_No'];
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
            $pincode = $row['PinCode'];
            echo $s;
            header('Location: student_dashboard.php');
            $_SESSION['Id_No']=$id;
            $_SESSION['First_Name']=$firstname;
            $_SESSION['Sur_Name']=$surname;
            $_SESSION['Father_Name']=$fathername;
            $_SESSION['Mother_Name']=$mothername;
            $_SESSION['DOB']=$dob;
            $_SESSION['Gender']=$gender;
            $_SESSION['Aadhar']=$mobile;
            $_SESSION['Nation']=$aadhar;
            $_SESSION['State']=$nation;
            $_SESSION['District']=$district;
            $_SESSION['House_No']=$houseno;
            $_SESSION['Area']=$area;
            $_SESSION['PinCode']=$pincode;
        }else{
            echo "Incorrect Username or Password";
        }
    }
}else{

    $error = "variable 'UserName' or variable 'Password' is not declared";

}
?>