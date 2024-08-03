<?php
include_once('../../link.php');
session_start();
if (!$_SESSION['Admin_Id_No']) {
    echo "<script>alert('Admin Id Not Rendered');
    location.replace('../admin_login.php');</script>";
}
//error_reporting(0);
?>
<?php
if (isset($_POST['Delete_All'])) {
    function deleteDirectory($dir)
    {
        if (!is_dir($dir)) {
            return false;
        }
        $handle = opendir($dir);
        while (($file = readdir($handle)) !== false) {
            if ($file != '.' && $file != '..') {
                $filePath = $dir . '/' . $file;
                if (is_dir($filePath)) {
                    deleteDirectory($filePath);
                } else {
                    unlink($filePath);
                }
            }
        }
        closedir($handle);
        return rmdir($dir);
    }
    $classes = ["PreKG", "LKG", "UKG"];
    for ($i = 1; $i <= 10; $i++) {
        $classes[] = $i . " CLASS";
    }
    $sections = ["A", "B", "C", "D"];
    $today = new DateTime();
    $today = $today->modify("-7 days")->format('d-m-Y');
    $today = new DateTime($today);
    foreach ($classes as $class) {
        foreach ($sections as $section) {
            if (is_dir("../../Files/Homework/" . $class . " " . $section . "/")) {
                $files = array_slice(scandir("../../Files/Homework/" . $class . " " . $section . "/"), 2);
                foreach ($files as $file) {
                    $d = new DateTime($file);
                    if ($d->getTimestamp() < $today->getTimestamp()) {
                        deleteDirectory("../../Files/Homework/" . $class . " " . $section . "/" . $file);
                    }
                }
            }
        }
    }
    echo "<script>alert('Successfully Deleted!');</script>";
}

if (isset($_POST['Previous'])) {
    $flag = "false";
    $classes = ["PreKG", "LKG", "UKG"];
    for ($i = 1; $i <= 10; $i++) {
        $classes[] = $i . " CLASS";
    }
    $sections = ["A", "B", "C", "D"];
    $date = new DateTime();
    $date = $date->modify("-7 days")->format('d-m-Y');
    $date = new DateTime($date);
    foreach ($classes as $class) {
        foreach ($sections as $section) {
            $sql = mysqli_query($link, "SELECT * FROM `homework` WHERE Class = '$class' AND Section = '$section'");
            while ($row = mysqli_fetch_assoc($sql)) {
                $d = new DateTime($row['Date']);
                if ($d->getTimestamp() < $date->getTimestamp()) {
                    $flag = "true";
                    break 3;
                }
            }
            if (is_dir("../../Files/Homework/" . $class . " " . $section . "/")) {
                $files = array_slice(scandir("../../Files/Homework/" . $class . " " . $section . "/"), 2);
                foreach ($files as $file) {
                    $d = new DateTime($file);
                    if ($d->getTimestamp() < $date->getTimestamp()) {
                        $flag = "true";
                        break 3;
                    }
                }
            }
        }
    }
    echo $flag;
    return;
}

?>
<?php
if (isset($_POST['GetDetails'])) {
    $date = $_POST['Date'];
    $class = $_POST['Class'];
    $section = $_POST['Section'];
    $subject = $_POST['Subject'];
    $query1 = mysqli_query($link, "SELECT Text,Image FROM `homework` WHERE Date = '$date' AND Class = '$class' AND Section = '$section' AND Subject = '$subject'");
    if (mysqli_num_rows($query1) == 0) {
        echo "No Data Found!";
    } else {
        $arr = ["Image" => NULL, "Text" => NULL];
        while ($row1 = mysqli_fetch_assoc($query1)) {
            if ($row1['Image'] != NULL) {
                $arr["Image"] = $row1['Image'];
            }
            if ($row1['Text'] != NULL) {
                $arr["Text"] = $row1['Text'];
            }
        }
        echo json_encode($arr);
    }
    return;
}
if (isset($_POST['Action'])) {
    $action = $_POST['Action'];
    $date = format_date($_POST['Date']);
    $class = $_POST['Class'];
    $section = $_POST['Section'];
    $subject = $_POST['Subject'];
    if ($action == "new" || $action == "update") {
        $location = '../../Files/Homework/' . $class . ' ' . $section;
        if (!is_dir($location)) {
            mkdir($location);
        }
        $location = '../../Files/Homework/' . $class . ' ' . $section . '/' . $date . '/';
        if (!is_dir($location)) {
            mkdir($location);
        }
        $html = "
        <!DOCTYPE html>
        <html>
            <head></head>
            <body>
                <h3 style='text-align:center;'>VICTORY E.M SCHOOL</h3>
                <h4 style='text-align:center;'>Student Homework - " . $subject . " - " . $date . "</h4>
            ";
        if ($_POST['Text'] != "") {
            $text = $_POST['Text'];
            $html .= "
            <p style='font-size:25px;'>" . $text . "</p> <br/>
            ";
        }
        if ($_POST['file_type'] == "With_File") {
            if (isset($_FILES['Image'])) {
                $file = $_FILES['Image'];
                $filename = $location . $subject . "." . pathinfo($file['name'], PATHINFO_EXTENSION);
                if (!move_uploaded_file($file['tmp_name'], $filename)) {
                    echo "upload_failure";
                } else {
                    $html .= "<img src='" . $filename . "' style='width:100%;' />";
                }
            } else {
                $sql = mysqli_query($link, "SELECT * FROM `homework` WHERE Date = '$date' AND Class = '$class' AND Section = '$section' AND Subject = '$subject'");
                while ($row2 = mysqli_fetch_assoc($sql)) {
                    $html .= "<img src='" . $row2['Image'] . "' style='width:100%;' />";
                    $filename = $row2['Image'];
                }
            }
        }
        $html .= "</body>
        </html>";
        require '../SMS/vendor/autoload.php';
        try {
            $html2pdf = new Html2Pdf($orientation = 'L', $format = 'A4');
            $html2pdf->writeHTML($html);
            $d = str_replace('\\', '/', dirname(dirname(__DIR__)));
            $html2pdf->output($_SERVER['DOCUMENT_ROOT'] . "Victory/Files/Homework/" . $class . ' ' . $section . '/' . $date . '/' . $subject . '.pdf', 'F');
        } catch (Exception $e) {
            echo $e->getmessage();
        }
        if ($action == "new") {
            $sql = "INSERT INTO `homework`(Date,Class,Section,Subject";
            if (isset($text)) {
                $sql .= ",Text";
            }
            if (isset($file)) {
                $sql .= ",Image";
            }
            $sql .= ") VALUES('$date','$class','$section','$subject'";
            if (isset($text)) {
                $sql .= ",'$text'";
            }
            if (isset($file)) {
                $sql .= ",'$filename'";
            }
            $sql .= ")";
            if (mysqli_query($link, $sql)) {
                echo "success";
            }
        } else if ($action == "update") {
            $sql = "UPDATE `homework` SET ";
            if (isset($text)) {
                $sql .= "Text='$text',";
            } else {
                $sql .= "Text=NULL,";
            }
            if ($_POST['file_type'] == "With_File") {
                $sql .= "Image='$filename'";
            } else {
                $sql .= "Image=NULL";
            }
            $sql .= " WHERE Date = '$date' AND Class = '$class' AND Section = '$section' AND Subject = '$subject'";
            if (mysqli_query($link, $sql)) {
                echo "success";
            }
        }
    } else if ($action == "delete") {
        if (is_dir("../../Files/Homework/" . $class . " " . $section . "/" . $date)) {
            foreach (array_slice(scandir("../../Files/Homework/" . $class . " " . $section . "/" . $date), 2) as $file) {
                if (str_contains($file, $subject)) {
                    unlink("../../Files/Homework/" . $class . " " . $section . "/" . $date . "/" . $file);
                }
            }
        }
        $delete_sql = mysqli_query($link, "DELETE FROM `homework` WHERE Date = '$date' AND Class = '$class' AND Section = '$section' AND Subject = '$subject'");
        if ($delete_sql) {
            echo "success";
        }
    }
    return;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title>Victory Schools</title>
    <!-- Controlling Cache -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="shortcut icon" href="/Victory/Images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/Victory/css/sidebar-style.css" />
    <!-- Boxiocns CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <!-- Bootstrap Links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<style>
    body {
        overflow-x: scroll;
    }

    .table-container {
        max-width: 800px;
        max-height: 500px;
        overflow-x: scroll;
    }

    @media screen and (max-width:576px) {
        .container {
            width: 80%;
            margin-left: 20%;
            overflow-x: scroll;
        }
    }

    @media print {
        * {
            display: none;
        }

        #table-container {
            display: block;
        }
    }

    #sign-out {
        display: none;
    }

    @media screen and (max-width:920px) {
        #sign-out {
            display: block;
        }
    }
</style>

<body class="bg-light">
    <?php
    include '../sidebar.php';
    ?>
    <form action="" method="POST">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="p-2 col-lg-2 rounded">
                    <label for="">Class:</label>
                </div>
                <div class="p-2 col-lg-3 rounded">
                    <select class="form-select" name="Class" id="class" aria-label="Default select example">
                        <option selected disabled>-- Select Class --</option>
                        <option value="PreKG">PreKG</option>
                        <option value="LKG">LKG</option>
                        <option value="UKG">UKG</option>
                        <?php
                        for ($i = 1; $i <= 10; $i++) {
                            echo "<option value='" . $i . " CLASS'>" . $i . " CLASS</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="p-2 col-lg-2 rounded">
                    <label for="">Section:</label>
                </div>
                <div class="p-2 col-lg-3 rounded">
                    <select class="form-select" name="Section" id="section" aria-label="Default select example">
                        <option selected disabled>-- Select Section --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="p-2 col-lg-2 rounded">
                    <label for="">Date of Homework:</label>
                </div>
                <div class="p-2 col-lg-3 rounded">
                    <input type="date" class="form-control" name="Date" id="date">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-5">
                    <button class="btn btn-primary" type="submit" name="show">Show</button>
                    <button class="btn btn-warning" type="reset" onclick="hideTable();">Clear</button>
                    <button class="btn btn-danger" type="submit" name="Delete_All" onclick="if(!confirm('Confirm to Delete Past Week Homeworks?')){return false;}else{return true;}">Delete Past Week Homeworks</button>
                </div>
            </div>
        </div>
    </form>
    <div class="modal fade" id="modal" tabindex="-1">
        <form action="" method="post" enctype="multipart/form-data" id="modal_form">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <input type="hidden" name="Details" id="modal_details" value="">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="file" class="form-control" name="File" id="img_file" accept="image/*" onchange="loadImage()">
                        <div class="row justify-content-center" id="file_row" hidden>
                            <div class="col-lg-8 mt-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="file_type" id="with_file" checked value="With_File">
                                    <label class="form-check-label" for="with_file">With File</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="file_type" id="without_file" value="Without_File">
                                    <label class="form-check-label" for="without_file">Without File</label>
                                </div>
                            </div>
                        </div>
                        <img src="" alt="" class="mt-3" id="modal_img" style="width:100%">
                        <textarea class="form-control mt-4" name="Text" id="text" cols="30" rows="10" placeholder="Enter Text (Optional):"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save_btn" onclick="save();">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="alert-container" hidden>
        <div class="row justify-content-center mt-3">
            <div class="col-lg-4">
                <div class="alert alert-warning" role="alert">
                    ⚠️Please Delete Past week Homeworks!
                </div>
            </div>
        </div>

    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-5">
                <h3><b>Manage Class Wise Homeworks</b></h3>
            </div>
        </div>
    </div>
    <div class="container table-container" id="table-container">
        <table class="table table-striped table-hover" border="1">
            <thead class="bg-secondary text-light">
                <tr>
                    <th style="padding:5px;">S.No</th>
                    <th style="width:300px;padding-left:30px;">Subjects</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr>
                    <?php
                    function format_date($date)
                    {
                        $arr = explode('-', $date);
                        $t = $arr[0];
                        $arr[0] = $arr[2];
                        $arr[2] = $t;
                        $date = implode('-', $arr);
                        return $date;
                    }
                    echo "<script>date.value = '" . date('Y-m-d') . "';</script>";
                    if (isset($_POST['show'])) {
                        $date = $_POST['Date'];
                        echo "<script>date.value = '" . $date . "';</script>";
                        $date = format_date($date);
                        if ($_POST['Class']) {
                            $class = $_POST['Class'];
                            echo "<script>document.getElementById('class').value = '" . $class . "'</script>";
                            if ($_POST['Section']) {
                                $section = $_POST['Section'];
                                echo "<script>document.getElementById('section').value = '" . $section . "'</script>";
                                if (mysqli_num_rows(mysqli_query($link, "SELECT * FROM `student_master_data` WHERE Stu_Class = '$class' AND Stu_Section = '$section'")) == 0) {
                                    echo "<script>alert('Class or Section Not Available!')</script>";
                                } else {
                                    $query1 = mysqli_query($link, "SELECT DISTINCT Subjects FROM `class_wise_subjects` WHERE Class = '$class'");
                                    if (mysqli_num_rows($query1) == 0) {
                                        echo "<script>alert('Subjects Not Available for this Class!')</script>";
                                    }
                                    $i = 1;
                                    while ($row1 = mysqli_fetch_assoc($query1)) {
                                        echo '
                                        <tr>
                                            <td>' . $i . '</td>
                                            <td style="padding-left:30px;">' . $row1['Subjects'] . '</td>
                                            <td>';
                                        if (mysqli_num_rows(mysqli_query($link, "SELECT * FROM `homework` WHERE Date = '$date' AND Class = '$class' AND Section = '$section' AND Subject = '" . $row1['Subjects'] . "'")) == 0) {
                                            echo '
                                            <button class="btn btn-primary" data-bs-toggle="modal" id="new_' . $row1['Subjects'] . '" data-bs-target="#modal" onclick="modal_form.reset();ShowModal(this.id)"><i class="bx bx-message-square-add"></i> New</button>
                                            ';
                                        } else {
                                            echo '
                                            <a href="/Victory/Files/Homework/' . $class . ' ' . $section . '/' . $date . '/' . $row1['Subjects'] . '.pdf" target="_blank" class="btn btn-warning"><i class="fas fa-eye"></i> View</a>
                                            <button class="btn btn-success" data-bs-toggle="modal" id="update_' . $row1['Subjects'] . '" data-bs-target="#modal" onclick="ShowModal(this.id)"><i class="bx bx-edit-alt"></i> Update</button>
                                            <button class="btn btn-danger" id="delete_' . $row1['Subjects'] . '" onclick="deletework(this.id)"><i class="bx bx-trash"></i> Delete</button>
                                            ';
                                        }
                                        echo '
                                            </td>
                                        </tr>';
                                        $i++;
                                    }
                                }
                            } else {
                                echo "<script>alert('Please Select Section!')</script>";
                            }
                        } else {
                            echo "<script>alert('Please Select Class!')</script>";
                        }
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Scripts -->

    <!-- With File or Without File -->
    <script>
        document.addEventListener('change', (e) => {
            if (e.target.id == 'with_file' && img_file.hidden) {
                img_file.hidden = "";
            } else if (e.target.id == 'without_file' && !img_file.hidden) {
                img_file.hidden = "hidden";
            }
        })
    </script>

    <!-- Set Date -->
    <script>
        function setDate() {
            var today = new Date().toISOString().split('T')[0];
            date.value = today;
        }
    </script>

    <!-- Warning for Past Week HomeWorks -->
    <script>
        $.ajax({
            url: "",
            type: "POST",
            data: {
                "Previous": "true"
            },
            success: function(data) {
                if (data == "false") {
                    document.querySelector('.alert-container').hidden = "hidden";
                } else {
                    document.querySelector('.alert-container').hidden = "";
                }
            }
        })
    </script>
    
    <!-- Show Class, Section, Subject on Modal, getDetails of -->
    <script>
        function getDetails(date, cls, sec, subject) {
            $.ajax({
                url: "",
                type: "POST",
                data: {
                    GetDetails: true,
                    Date: date,
                    Class: cls,
                    Section: sec,
                    Subject: subject
                },
                success: function(data) {
                    if (data == "No Data Found") {
                        alert("No Data Found of this Subject for this Class and Section!")
                    } else {
                        data = JSON.parse(data)
                        if (data['Image'] != null) {
                            with_file.checked = true;
                            $('#modal_img').attr('src', data['Image'] + "?timestamp=" + new Date().getTime());
                        } else {
                            without_file.checked = true;
                            img_file.hidden = "hidden";
                            $('#modal_img').attr('src', "");
                        }
                        if (data['Text'] != null) {
                            $('#text').html(data['Text']);
                        } else {
                            $('#text').html("");
                        }
                    }
                }
            })
        }

        function ShowModal(eleid) {
            var subject = eleid.split("_")[1];
            var modal = document.getElementById('modal');
            var d = date.value.split("-").reverse().join("-");
            $('#modal').off("shown.bs.modal");
            $('#modal').off("hide.bs.modal");
            $('#modal').on('shown.bs.modal', function(e) {
                $('.modal-title').html($('#class').val() + " " + $('#section').val() + " " + subject);
                $('#modal_details').val(eleid.split('_')[0] + "," + $('#class').val() + "," + $('#section').val() + "," + subject);
                if (eleid.split("_")[0] == "update") {
                    file_row.hidden = "";
                    getDetails(d, $('#class').val(), $('#section').val(), subject);
                } else {
                    img_file.hidden = "";
                    file_row.hidden = "hidden";
                }
            })
        }
        modal.addEventListener('hide.bs.modal', function() {
            document.getElementById("modal_form").reset()
            modal_img.src = "";
            text.innerHTML = "";
            img_file.value = "";
        })
    </script>

    <!-- Delete Homework of the class, section, subject -->
    <script>
        function deletework(eleid) {
            var date = $('#date').val();
            var cls = $('#class').val();
            var section = $('#section').val();
            var subject = eleid.split("_")[1];
            var par_id = $('#' + eleid).parent()
            if (confirm("Confirm to Delete Homework of " + cls + " " + section + " " + subject + " on " + date + "?")) {
                $.ajax({
                    url: "",
                    type: "POST",
                    data: {
                        Action: "delete",
                        Date: date,
                        Class: cls,
                        Section: section,
                        Subject: subject
                    },
                    success: function(data) {
                        if (data.trim() == "success") {
                            alert("Successfully Deleted!");
                            var p = $('#' + eleid).parent();
                            $('#' + eleid).parent().empty();
                            p.append('<button class="btn btn-primary" data-bs-toggle="modal" id="new_' + subject + '" data-bs-target="#modal" onclick="ShowModal(this.id)"><i class="bx bx-message-square-add"></i> New</button>')
                        } else {
                            alert("Failed to Delete!");
                        }
                    }
                });
            } else {
                return false;
            }
        }
    </script>

    <!-- Load Image -->
    <script>
        async function loadImage() {
            let formData = new FormData();
            let fileInput = document.getElementById("img_file");
            if (fileInput.files.length === 0) {
                console.error("No file selected");
                return;
            }
            formData.append("Image", fileInput.files[0]);
            $.ajax({
                url: "img.php",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    data = data.split(',')
                    if (data[0] == "Success") {
                        modal_img.src = "";
                        modal_img.src = "temp_img." + data[1] + "?timestamp=" + new Date().getTime();
                    } else {
                        alert("Image Upload Failed!")
                    }
                }
            })
        }
    </script>

    <!-- Save HomeWork -->
    <script>
        function save() {
            let formData = new FormData();
            let action = "";
            $('#modal_form').serializeArray().forEach((e) => {
                if (e.name != "Details") {
                    formData.append(e.name, e.value);
                } else {
                    let details = e.value.split(",");
                    formData.append("Action", details[0]);
                    formData.append("Class", details[1]);
                    formData.append("Section", details[2]);
                    formData.append("Subject", details[3]);
                }
            })
            if (img_file.files.length != 0) {
                let file = document.getElementById('img_file');
                formData.append("Image", file.files[0]);
            }
            formData.append("Date", date.value);
            if (!with_file.checked && text.value.trim() == "") {
                alert("To Save, Either Image or Text should be present!")
            } else {
                $.ajax({
                    url: "",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        console.log(data)
                        if (data.trim() == "success") {
                            bootstrap.Modal.getInstance(document.getElementById('modal')).hide()
                            alert("Saved Successfully!");
                            var p;
                            var subject, cls, section, date;
                            formData.forEach((e, v) => {
                                if (v == "Subject") {
                                    p = $('#new_' + e).parent()
                                    subject = e;
                                }
                                if (v == "Class") {
                                    cls = e;
                                }
                                if (v == "Section") {
                                    section = e;
                                }
                                if (v == "Date") {
                                    date = e;
                                    date = date.split("-").reverse().join("-");
                                }
                            })
                            p.empty();
                            p.append('<a href="/Victory/Files/Homework/' + cls + ' ' + section + '/' + date + '/' + subject + '.pdf" target="_blank" class="btn btn-warning me-1"><i class="fas fa-eye"></i> View</a><button class="btn btn-success me-1" data-bs-toggle="modal" id="update_' + subject + '" data-bs-target="#modal" onclick="ShowModal(this.id)"><i class="bx bx-edit-alt"></i> Update</button><button class="btn btn-danger" id="delete_' + subject + '" onclick="deletework(this.id)"><i class="bx bx-trash"></i> Delete</button>')
                            modal_img.src = ""
                            text.innerHTML = ""
                        } else {
                            alert("Failed to Save!");
                        }
                    }
                })
            }

        }
    </script>
</body>

</html>