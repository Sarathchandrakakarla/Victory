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
        echo "<script>alert('User Name is Empty');
                location.replace('admin_login.html');
                </script>";
    }else if(empty($pass)){
        echo "<script>alert('Password is Empty');
                    location.replace('admin_login.html');
                    </script>";
    }else{
        $sql = "SELECT * FROM admin WHERE Admin_Id_No = '$uname'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
                $adm_id = $row['Admin_Id_No'];
                $adm_hash = $row['Admin_Hash'];
                if(password_verify($pass,$adm_hash)){
                    $_SESSION['Admin_Id_No'] = $adm_id;
                    header('Location: admin_dashboard.php');
                    exit; 
                }
                else{
                    echo "<script>alert('Incorrect Password');
                    location.replace('admin_login.html');
                    </script>";
                }
                
        }else{
            echo "<script>alert('Incorrect Username');
                    location.replace('admin_login.html');
                    </script>";
        }
    }
}else{
    echo "<script>alert('variable 'UserName' or variable 'Password' is not declared');
                    location.replace('admin_login.html');
            </script>";

}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head> 
		<meta charset="utf-8">
		<title>Victory EM School</title>
	</head>
	<body>
    </body>
</html>