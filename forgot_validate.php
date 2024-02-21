<?php
include 'link.php';
session_start(); 
if (isset($_POST['Forgot'])) {
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
    $uname = validate($_POST['UserName']);
    if (empty($uname)) {
        echo "<script>alert('User Name is Empty');
                location.replace('admin_login.html');
                </script>";
    }else{
        mail('kakarlanani4@gmail.com','Forgot Password','Hello Nani!!');
        /*
        $sql = "SELECT * FROM admin WHERE Admin_Id_No = '$uname'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            echo "<script>
            const pass = document.getElementById('id_password');
            pass.removeAttribute('hidden');
            </script>";
        }else{
            echo "<script>alert('Incorrect Username');
                    location.replace('forgot.php');
                    </script>";
        }
        */
    }
}else{
    echo "<script>alert('variable 'UserName' is not declared');
                    location.replace('forgot.php');
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