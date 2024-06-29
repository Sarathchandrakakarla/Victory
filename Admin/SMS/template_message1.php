<?php
include_once('../../link.php');
session_start();
if (!$_SESSION['Admin_Id_No']) {
    echo "<script>alert('Admin Id Not Rendered');
    location.replace('../admin_login.php');</script>";
}
error_reporting(0);
?>
<?php
if (isset($_POST['Action']) && $_POST['Action'] == "Get_Id") {
    $id = $_POST['Id'];
    $sql = mysqli_query($link, "SELECT * FROM `whatsapp_templates` WHERE T_Id = '$id'");
    if (mysqli_num_rows($sql) == 0) {
        echo "No Data Found";
        return;
    } else {
        while ($row = mysqli_fetch_assoc($sql)) {
            echo $row['T_Type'] . "|" . $row['M_Type'] . "|" . $row['Placeholders'];
            return;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title>Victory Schools</title>
    <link rel="shortcut icon" href="/Victory/Images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/Victory/css/sidebar-style.css" />
    <!-- Boxiocns CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

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
        max-width: 900px;
        max-height: 500px;
        overflow-x: scroll;
    }

    #section {
        text-align: center;
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
    <div class="container">
        <form action="" method="post">
            <div class="row justify-content-center mt-5">
                <div class="col-lg-2">Template Id</div>
                <div class="col-lg-3">
                    <input type="number" class="form-control" placeholder="6 Digit Template Id" name="T_Id" id="t_id" required>
                </div>
            </div>
            <div class="row justify-content-center mt-3" id="media_row" hidden>
                <div class="col-lg-2">File</div>
                <div class="col-lg-3">
                    <input type="file" class="form-control" name="File" id="file">
                </div>
            </div>
            <div class="row justify-content-center mt-3" id="placeholder_row" hidden>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-primary" name="Send">Send</button>
                    <button type="reset" class="btn btn-warning" onclick="media_row.hidden = 'hidden';placeholder_row.hidden = 'hidden';">Clear</button>
                </div>
            </div>
        </form>
        <?php
        if (isset($_POST['Send'])) {
            $T_Id = $_POST['T_Id'];
            echo "<script>document.getElementById('t_id').value = '" . $T_Id . "'</script>";
            $query1 = mysqli_query($link, "SELECT * FROM `whatsapp_templates` WHERE T_Id = '$T_Id'");
            if (mysqli_num_rows($query1) == 0) {
                echo "<script>alert('Template Not Found')</script>";
            } else {
                $row = mysqli_fetch_assoc($query1);
                if ($row['T_Type'] == "Media") {
                    echo "<script>media_row.hidden = '';file.required = true;</script>";
                    $extension = $_FILES['File']['extension'];
                    echo $extension;
                }
                if ($row['Placeholders'] != '0') {
                    $placeholders = $_POST['Placeholder'];
                    $i = 1;
                    foreach ($placeholders as $placeholder) {
                        echo "<script>
                        placeholder_row.hidden = '';
                        placeholder_row.innerHTML += '<div class=\"row justify-content-center mt-2\"><div class=\"col-lg-2\"><label>Placeholder " . $i . "</label></div><div class=\"col-lg-3\"><input type=\"text\" class=\"form-control\" value=\"" . $placeholder . "\" required/></div></div>';
                        </script>";
                        $i++;
                    }
                }
            }
        }
        ?>
    </div>

    <!-- Scripts -->

    <!-- Fetching Template Details -->
    <script>
        $('#t_id').on('change', () => {
            let id = $('#t_id').val();
            if (id.length != 6) {
                alert('Template Id should be of 6 Digits');
            } else {
                $.ajax({
                    url: '',
                    type: 'POST',
                    data: {
                        'Action': 'Get_Id',
                        'Id': id
                    },
                    success: function(data) {
                        if (data == "No Data Found") {
                            alert('Template Not Found');
                        } else {
                            let details = data.split('|')
                            if (details[0] == "Media") {
                                $('#media_row').removeAttr('hidden');
                            } else {
                                $('#media_row').attr('hidden', true);
                            }
                            if (details[1] != "") {
                                $('#file').attr('required', true);
                                if (details[1] == "Document") {
                                    $('#file').attr('accept', '.pdf');
                                } else if (details[1] == "Image") {
                                    $('#file').attr('accept', '.jpeg,.png');
                                } else if (details[1] == "Video") {
                                    $('#file').attr('accept', '.mp4');
                                }
                            }
                            let no_of_placeholders = parseInt(details[2]);
                            $('#placeholder_row').removeAttr('hidden');
                            for (let i = 0; i < no_of_placeholders; i++) {
                                $('#placeholder_row').append("\
                                <div class='row justify-content-center mt-2'>\
                                    <div class='col-lg-2'>\
                                        <label>Placeholder " + (i + 1) + "</label>\
                                    </div>\
                                    <div class='col-lg-3'>\
                                        <input type='text' class='form-control' name='Placeholder[]' required/>\
                                    </div>\
                                </div>")
                            }
                        }
                    }
                });
            }
        })
    </script>

</body>

</html>