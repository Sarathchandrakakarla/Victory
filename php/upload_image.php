<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
error_reporting(0);

if (isset($_POST['Action']) && $_POST['Action'] == "Student") {
    try {
        $filename = $_POST['FileName'];
        $filepath = $_POST['FilePath'];
        
        // Check if the directory exists
        $uploadDir = "../Images/" . $filepath;
        if (!file_exists($uploadDir)) {
            throw new Exception("Path does not exist");
        }
        
        // Check if file was uploaded and move it to the target directory
        if (isset($_FILES['File']) && move_uploaded_file($_FILES['File']['tmp_name'], $uploadDir . "/" . $filename)) {
            echo json_encode(["success" => true, "message" => "Image Uploaded Successfully"]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to Upload Image"]);
        }
    } catch (Exception $err) {
        echo json_encode(["success" => false, "message" => $err->getMessage()]);
    }
}
else if (isset($_POST['Action']) && $_POST['Action'] == "Delete") {
    try {
        $filename = $_POST['FileName'];
        $filepath = "../Images/" . $_POST['FilePath'] . "/" . $filename;
        if (file_exists($filepath)) {
            unlink($filepath);
            echo json_encode(["success" => true, "message" => "Image Deleted Successfully"]);
        } else {
            echo json_encode(["success" => false, "message" => "File or Path Does not Exists"]);
        }
    } catch (Exception $err) {
        echo json_encode(["success" => false, "message" => $err->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid Request"]);
}
?>
