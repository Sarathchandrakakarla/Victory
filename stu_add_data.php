<?php require 'link.php';
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
	if(isset($_POST["add"])){          
        $id = validate($_POST['Id_No']);
        $admno = validate($_POST['Adm_No']);
        $firstname = validate($_POST['First_Name']);
        $surname = validate($_POST['Sur_Name']);
        $fathername = validate($_POST['Father_Name']);
        $mothername = validate($_POST['Mother_Name']);
        $dob = validate($_POST['DOB']);
        $gender = validate($_POST['Gender']);
        $mobile = validate($_POST['Mobile']);
        $aadhar = validate($_POST['Aadhar']);
        $class = validate($_POST['Stu_Class']);
        $section = validate($_POST['Stu_Section']);
        $religion = validate($_POST['Religion']);
        $caste = validate($_POST['Caste']);
        $category = validate($_POST['Category']);
        $houseno = validate($_POST['House_No']);
        $area = validate($_POST['Area']);
        $village = validate($_POST['Village']);
        //$pincode = validate($_POST['Pin_Code']);
        //$img = validate($_FILES['img']['name']);
        $doj = validate($_POST['DOJ']);
        $previous_school = validate($_POST['Previous_School']);
        $referred_by = validate($_POST['Referred_By']);
        echo "<script>if(!confirm('Confirm to Add Student Data?')){
            location.replace('Stu_Register1.php');
        }</script>";

		mysqli_query($link, "INSERT INTO student_database VALUES('', '$id','$admno', '$firstname', '$surname', '$fathername', '$mothername',
            '$dob', '$gender', '$mobile', '$aadhar','$class','$section', '$religion', '$caste', '$category', '$houseno', '$area','$village',
             '$doj','$previous_school','$referred_by')");

		echo
		"
		<script>
		alert('Succesfully Imported');
        location.replace('Stu_Register1.php');
		</script>
		";
    }
    else{
        echo "<script>alert('add variable is not Declared');
    location.replace('Stu_Register1.php');</script>";
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head> 
		<meta charset="utf-8">
		<title>Add Student Data To DataBase</title>
	</head>
	<body>
    <!--
        SET @autoid :=0;
UPDATE admin SET S_No = @autoid := (@autoid+1);
ALTER TABLE admin AUTO_INCREMENT = 1;
*/
    -->
    </body>
</html>
