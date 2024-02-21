<?php
include 'link.php';
session_start(); 
function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }
if(isset($_POST['delete'])){
    $id = validate($_POST['show_id']);
    
    if (empty($id)) {
        echo "<script>alert('Student ID empty');
    location.replace('show_student_page.php');</script>";
    }else{
        echo "<script>if(!confirm('Confirm To Delete Student Data from Student Login and Student Database?')){
            location.replace('show_student_page.php');
        }</script>";
        $sql_search = "SELECT * FROM student_database WHERE Stu_Id_No = '$id'";
        $sql_search_ = "SELECT * FROM student WHERE Id_No = '$id'";
        $result = mysqli_query($link,$sql_search);
        $result_ = mysqli_query($link,$sql_search_);
        if (mysqli_num_rows($result) == 0){
            echo "<script>alert('Student ID is Not Available in Student Database');
                location.replace('show_student_page.php');</script>";
        }
        else if (mysqli_num_rows($result_) == 0){
            echo "<script>alert('Student ID is Not Available in Student Login Database');
                location.replace('show_student_page.php');</script>";
        }
        else{
        $sql = "DELETE FROM student_database WHERE Stu_Id_No = '$id'";
        $sql_ = "DELETE FROM student WHERE Id_No = '$id'";
        mysqli_query($link,$sql);
        mysqli_query($link,$sql_);
        echo "<script>alert('Student Details Deleted Successfully!!');
        location.replace('show_student_page.php');</script>";
        }
    }
}else{
    echo "<script>alert('delete variable is not Declared');
    location.replace('show_student_page.php');</script>"; 
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head> 
		<meta charset="utf-8">
		<title>Validate Student to be Shown</title>
	</head>
</html>