<?php require 'link.php'; ?>
 <!DOCTYPE html>
<html lang="en" dir="ltr">
	<head> 
		<meta charset="utf-8">
		<title>Import Excel To MySQL</title>
	</head>
	<body>
		<form class="" action="" method="post" enctype="multipart/form-data">
			<input type="file" name="excel" required value="">
			<button type="submit" name="import">Import</button>
		</form>
		<?php
		if(isset($_POST["import"])){
			$fileName = $_FILES["excel"]["name"];
			$fileExtension = explode('.', $fileName);
            $fileExtension = strtolower(end($fileExtension));
			$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

			$targetDirectory = "uploads/" . $newFileName;
			move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

			require 'excelReader/excel_reader2.php';
			require 'excelReader/SpreadsheetReader.php';

			$reader = new SpreadsheetReader($targetDirectory);
			foreach($reader as $key => $row){
				/*
				$id = $row[0];
				$name = $row[1];
				*/
				$id = $row[0];
				$admno = $row[1];
				$firstname = $row[2];
				$surname = $row[3];
				$fathername = $row[4];
				$mothername = $row[5];
				$dob = $row[6];
				$gender = $row[7];
				$mobile = $row[8];
				$aadhar = $row[9];
				$class = $row[10];
				$section = $row[11];
				$religion = $row[12];
				$caste = $row[13];
				$category = $row[14];
				$houseno = $row[15];
				$area = $row[16];
				$village = $row[17];
				$doj = $row[18];
				$previous_school = $row[19];
				$van_route = $row[20];
				$referred_by= $row[21];
				/*
				$password = $row[2];
				$hash = password_hash($password,PASSWORD_DEFAULT);
				*/
				/*
				mysqli_query($link, "INSERT INTO admin VALUES('', '$id', '$name', '$password', '$hash')");
				*/
				mysqli_query($link, "INSERT INTO student_master_data VALUES('', '$id','$admno', '$firstname', '$surname', '$fathername', '$mothername',
            '$dob', '$gender', '$mobile', '$aadhar','$class','$section', '$religion', '$caste', '$category', '$houseno', '$area','$village',
             '$doj','$previous_school','$van_route','$referred_by')");
			}

			echo
			"
			<script>
			alert('Succesfully Imported');
			document.location.href = '';
			</script>
			";
		}
		?>
		<!--
SET @autoid :=0;
UPDATE student SET S_No = @autoid := (@autoid+1);
ALTER TABLE student AUTO_INCREMENT = 1;
	-->
	</body>
</html>
