<?php
include 'link.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <button type="submit" name="Change" onclick="if(!confirm('Confirm to Change initials?')){return false;}else{return true;}">Change</button>
    </form>
    <?php
    if (isset($_POST['Change'])) {
        $sql = mysqli_query($link, "SELECT * FROM `employee_master_data`");
        $initials = array();
        while ($row = mysqli_fetch_assoc($sql)) {
            $initials[$row['Emp_Id']] = $row['Emp_Sur_Name'][0];
        }
        foreach (array_keys($initials) as $id) {
            $change_sql = mysqli_query($link, "UPDATE `employee_master_data` SET Emp_First_Name = CONCAT('" . $initials[$id] . ".',Emp_First_Name) WHERE Emp_Id = '" . $id . "'");
        }
    }
    ?>
</body>

</html>