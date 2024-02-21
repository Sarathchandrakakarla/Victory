<?php
include 'link.php';
session_start(); 
function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }
if (isset($_POST['show'])) {
    $id = validate($_POST['show_id']);
    
    if (empty($id)) {
        echo "<script>alert('Student ID empty');
    location.replace('show_student_page.php');</script>";
    }else{
        $sql = "SELECT * FROM student_master_data WHERE Id_No = '$id'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $stu_id = $row['Id_No'];
            $stu_adm = $row['Adm_No'];
            $firstname = $row['First_Name'];
            $surname = $row['Sur_Name'];
            $fathername = $row['Father_Name'];
            $mothername = $row['Mother_Name'];
            $dob = $row['DOB'];
            $gender = $row['Gender'];
            $mobile = $row['Mobile'];
            $aadhar = $row['Aadhar'];
            $class = $row['Stu_Class'];
            $section = $row['Stu_Section'];
            $religion = $row['Religion'];
            $caste = $row['Caste'];
            $category = $row['Category'];
            $houseno = $row['House_No'];
            $area = $row['Area'];
            $village = $row['Village'];
            $doj = $row['DOJ'];
            $previous = $row['Previous_School'];
            $van = $row['Van_Route'];
            $refer = $row['Referred_By'];
            $_SESSION['Stu_Id_No']=$stu_id;
            $_SESSION['Stu_Adm_No']=$stu_adm;
            $_SESSION['First_Name']=$firstname;
            $_SESSION['Sur_Name']=$surname;
            $_SESSION['Father_Name']=$fathername;
            $_SESSION['Mother_Name']=$mothername;
            $_SESSION['DOB']=$dob;
            $_SESSION['Gender']=$gender;
            $_SESSION['Mobile']=$mobile;
            $_SESSION['Aadhar']=$aadhar;
            $_SESSION['Stu_Class']=$class;
            $_SESSION['Stu_Section']=$section;
            $_SESSION['Religion']=$religion;
            $_SESSION['Caste']=$caste;
            $_SESSION['Category']=$category;
            $_SESSION['House_No']=$houseno;
            $_SESSION['Area']=$area;
            $_SESSION['Village']=$village;
            $_SESSION['DOJ']=$doj;
            $_SESSION['Previous_School']=$previous;
            $_SESSION['Van_Route']=$van;
            $_SESSION['Referred_By']=$refer;
            header('Location: show_student_details.php');
        }else{
            echo "<script>alert('Incorrect ID');
    location.replace('show_student_page.php');</script>";
        }
    }
}else{
    echo "<script>alert('show variable is not Declared');
    location.replace('show_student_page.php');</script>";
}
/*
if(isset($_POST['update'])){
    $id = validate($_POST['show_id']);
    
    if (empty($id)) {
        echo "<script>alert('Student ID empty');
    location.replace('show_student_page.php');</script>";
    }else{
        $sql = "SELECT * FROM student_database WHERE Stu_Id_No = '$id'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
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
            header('Location: update_student.php');
        }else{
            echo "<script>alert('Incorrect ID');
    location.replace('show_student_page.php');</script>";
        }
    }
}
else{
    echo "<script>alert('update variable is not Declared');
    location.replace('show_student_page.php');</script>";
}
*/
/*
if(isset($_POST['delete'])){
    $id = validate($_POST['show_id']);
    
    if (empty($id)) {
        echo "<script>alert('Student ID empty');
    location.replace('show_student_page.php');</script>";
    }else{
        echo "<script>if(!confirm('Confirm To Delete Student Data?')){
            location.replace('show_student_page.php');
        }</script>";
        $sql = "DELETE FROM student_database WHERE Stu_Id_No = '$id'";
        $sql_ = "DELETE FROM student WHERE Id_No = '$id'";
        mysqli_query($link, $sql);
        mysqli_query($link, $sql_);
    }
}else{
    echo "<script>alert('delete variable is not Declared');
    location.replace('show_student_page.php');</script>"; 
}
*/
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head> 
		<meta charset="utf-8">
		<title>Validate Student to be Shown</title>
	</head>
</html>