<?php
include_once('../link.php');
session_start();
if (!$_SESSION['Admin_Id_No']) {
    echo "<script>
  alert('Admin Id Not Rendered');
  location.replace('/Victory/Admin/admin_login.php');
  </script>
  </script>";
}
?>

<?php

$apiKey = 'AIzaSyDCqN_8pQmJsghZF3Zc4U9dx_N_nS1wuFs';

if (isset($_POST['add'])) {
    if ($_POST['Video_Id']) {
        $video_id = $_POST['Video_Id'];
        $apiUrl = "https://www.googleapis.com/youtube/v3/videos?id=$video_id&key=$apiKey&part=snippet,contentDetails,statistics";
        $check_sql = mysqli_query($link, "SELECT * FROM `youtube` WHERE Video_Id = '$video_id'");
        $response = file_get_contents($apiUrl);
        if ($response) {
            $data = json_decode($response, true);

            if (isset($data['items'][0])) {
                $video = $data['items'][0];

                // Extracting video details
                $title = $video['snippet']['title'];
                $publishedAt = $video['snippet']['publishedAt'];
                $publishedAt = new DateTime($publishedAt);
                $publishedAt = $publishedAt->format('d-m-Y H:i:s');
                if (mysqli_num_rows($check_sql) > 0) {
                    echo "<script>alert('Video Already Exists!!')</script>";
                } else {
                    $sql = mysqli_query($link, "INSERT INTO `youtube`(Video_Id,Video_Title,Published_Date) VALUES('$video_id','$title','$publishedAt')");

                    if ($sql) {
                        echo "<script>alert('New Video Inserted Successfully!!')</script>";
                    } else {
                        echo "<script>alert('New Video Insertion Failed!!')</script>";
                    }
                }
            } else {
                echo "<script>alert('No data found for the video ID.');</script>";
            }
        } else {
            echo "<script>alert('Error fetching data.');</script>";
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
    <!-- Controlling Cache -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <!-- Boxiocns CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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

    #sign-out {
        display: none;
    }

    @media screen and (max-width:920px) {
        #sign-out {
            display: block;
        }
    }

    #inp,
    #add-btn {
        position: relative;
    }

    @keyframes mymove {
        from {
            opacity: 0;
            left: -100px;
        }

        to {
            left: 0;
            opacity: 1;
        }
    }

    @keyframes myrevmove {
        from {
            opacity: 1;
            left: 0;
        }

        to {
            left: -100px;
            opacity: 0;
        }
    }

    .delete {
        cursor: pointer;
        font-size: 20px;
        color: red;
    }
</style>

<body>
    <?php
    include 'sidebar.php';
    ?>
    <form action="" method="POST">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-lg-2">
                    <label for=""><b>Add New Video</b></label>
                </div>
                <div class="col-lg-1">
                    <button class="btn btn-primary" style="border-radius: 50%;" id="plus" onclick="reveal();return false;"> <i class="bx bx-plus" id="plus-icon"></i> </button>
                </div>
                <div class="col-lg-3">
                    <input type="text" class="form-control" id="inp" name="Video_Id" placeholder="Enter Video Id" value="<?php if (isset($video_id)) {
                                                                                                                                echo $video_id;
                                                                                                                            } else {
                                                                                                                                echo '';
                                                                                                                            } ?>" style="opacity: 0;">
                </div>
                <div class="col-lg-1">
                    <button class="btn btn-warning" name="add" id="add-btn" style="opacity: 0;">Insert</button>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center mt-3">
                <div class="col-lg-2">
                    <button class="btn btn-primary" type="submit" name="show">Show</button>
                    <button class="btn btn-warning" type="reset" onclick="hideTable()">Clear</button>
                </div>
            </div>
        </div>
    </form>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-4">
                <h3><b>Youtube Videos Report</b></h3>
            </div>
        </div>
    </div>
    <div class="container table-container" id="table-container">
        <table class="table table-striped table-hover" border="1">
            <thead class="bg-secondary text-light">
                <tr>
                    <th style="padding:5px;">S.No</th>
                    <th style="padding:5px;">Video Id</th>
                    <th style="padding:5px;">Video Title</th>
                    <th style="padding:5px;">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr>
                    <?php
                    if (isset($_POST['show'])) {
                        $sql = "SELECT * FROM `youtube`";
                        $result = mysqli_query($link, $sql);
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>
                <td style="padding:5px;">' . $i . '</td>
                <td style="padding:5px;">' . $row['Video_Id'] . '</td>
                <td style="padding:5px;">' . $row['Video_Title'] . '</td>
                <td style="padding:5px;"><i class="bx bx-trash delete"></i></td>
                </tr>';
                            $i++;
                        }
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
    <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>

    <!-- Revealing Text Box -->

    <script type="text/javascript">
        function reveal() {
            button = document.getElementById('plus-icon');
            if (!button.classList.contains('open')) {
                button.style.transform = 'rotate(45deg)';

                txtinp = document.getElementById('inp')
                txtinp.style.animation = "mymove 1s ease-in 1";
                txtinp.style.opacity = 1;

                txtbtn = document.getElementById('add-btn')
                txtbtn.style.animation = "mymove 1s ease-in 1";
                txtbtn.style.opacity = 1;
            } else {
                button.style.transform = 'rotate(90deg)';

                txtinp = document.getElementById('inp')
                txtinp.style.animation = "myrevmove 1s ease-out 1";


                txtbtn = document.getElementById('add-btn')
                txtbtn.style.animation = "myrevmove 1s ease-out 1";

                txtinp.style.opacity = 0;
                txtbtn.style.opacity = 0;
            }
            button.classList.toggle('open');
        }
    </script>

    <!-- Delete Row -->
    <script type="text/javascript">
        $(".delete").click(function() {
            video_id = $(this).parent().siblings().eq(1).text();
            if (!confirm('Confirm to delete Video: ' + video_id + '?')) {
                return;
            } else {
                $.ajax({
                    type: 'post',
                    url: 'temp.php',
                    data: {
                        Video_Id: video_id
                    },
                    success: function(data) {
                        alert('Video Deleted Successfully!! Refresh to get data updated!')
                    }
                });
            }
        });
    </script>

    <!-- Print Table -->
    <script type="text/javascript">
        function printDiv() {
            window.frames["print_frame"].document.body.innerHTML = "<h2 style='text-align:center;'>VICTORY HIGH SCHOOL</h2>";
            window.frames["print_frame"].document.body.innerHTML += document.querySelector('.table-container').innerHTML;
            window.frames["print_frame"].window.focus();
            window.frames["print_frame"].window.print();
        }
    </script>
</body>

</html>