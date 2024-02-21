<?php include_once '../link.php';
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
	if(isset($_POST["update"])){          
        $id = validate($_POST['Stu_Id_No']);
        $id = validate($_POST['Stu_Adm_No']);
        $firstname = validate($_POST['first_name']);
        $surname = validate($_POST['sur_name']);
        $fathername = validate($_POST['father_name']);
        $mothername = validate($_POST['mother_name']);
        $dob = validate($_POST['dob']);
        $gender = validate($_POST['gender']);
        $mobile = validate($_POST['mobile']);
        $aadhar = validate($_POST['aadhar']);
        $class = validate($_POST['Stu_Class']);
        $section = validate($_POST['Stu_Section']);
        $religion = validate($_POST['religion']);
        $caste = validate($_POST['Caste']);
        $category = validate($_POST['Category']);
        $houseno = validate($_POST['house_no']);
        $area = validate($_POST['area']);
        $village = validate($_POST['village']);
        $doj = validate($_POST['DOJ']);
        $previous = validate($_POST['Previous_School']);
        $van = validate($_POST['Van_Route']);
        $refer = validate($_POST['Referred_By']);
        echo "<script>if(!confirm('Confirm to Update Student Data?')){
            location.replace('update_student.php');
        }</script>";
		mysqli_query($link, "UPDATE student_master_data
        SET First_Name = '$firstname', Sur_Name = '$surname', Father_Name = '$fathername', Mother_Name = '$mothername',
         DOB = '$dob', Gender = '$gender', Mobile = '$mobile', Aadhar = '$aadhar', Stu_Class = '$class', Stu_Section = '$section',
          Religion = '$religion', Caste = '$caste', Category = '$category', House_No = '$houseno', Area = '$area',
          Village = '$village', DOJ = '$doj', Previous_School = '$previous', Van_Route = '$van', Referred_By = '$refer'
        WHERE 'Stu_Id_No' = '$id';");

		echo
		"
		<script>
		alert('Succesfully Updated');
        location.replace('show_student_page.php');
		</script>
		";
        
    }
    else{
        echo
		"
		<script>
        location.replace('update_student.php');
		</script>
		";
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
