<?php
session_start();
if (!$_SESSION['Admin_Id_No']) {
    echo "<script>
  alert('Admin Id Not Rendered');
  location.replace('/Victory/Admin/admin_login.php');
  </script>
  </script>";
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
    <!-- Animation Links -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<style>
    body {
        background: linear-gradient(120deg, #136a8a, #267871);
    }

    #sign-out {
        display: none;
    }

    @media screen and (max-width:920px) {
        #sign-out {
            display: block;
        }
    }

    .img-container {
        display: grid;
        margin-top: 50px;
        place-items: center;
    }

    /* TypeWriter Effect */
    .type-container {
        display: flex;
        margin-top: 100px;
    }

    #vic_heading {
        margin-left: 200px;
        display: flex;
        font-size: 3em;
        color: yellow;
    }

    .typing-demo {
        width: 43ch;
        animation: typing 2s steps(42), blink .5s step-end infinite alternate;
        white-space: nowrap;
        overflow: hidden;
        border-right: 3px solid;
        font-family: "Times New Roman", serif;
        font-weight: bold;
        /*font-family: 'Times New Roman';*/
        font-size: 2em;
        color: yellow;
    }

    @keyframes typing {
        from {
            width: 0
        }
    }

    @keyframes blink {
        50% {
            border-color: transparent
        }
    }

    @media screen and (max-width:960px) {
        .type-container {
            display: flex;
            margin-top: 100px;
        }

        #vic_heading {
            margin-left: 80px;
            display: flex;
            font-size: 1em;
        }

        .typing-demo {
            font-size: 1em;
        }
    }
    @media screen and (min-width:1300px) {
        #vic_heading{
            margin-left: 400px;
        }
    }
</style>

<body>
    <?php
    include 'sidebar.php';
    ?>
    <div class="container img-container" data-aos="fade-in">
        <img src="/Victory/Images/Victory Logo.png" alt="Logo" width="200px">
    </div>
    <div class="container type-container">
        <div class="head">
            <p id="vic_heading"><b style="padding-right: 30px;font-family: 'algerian';">Victory</b></p>
        </div>
        <div class="wrapper">
            <div class="typing-demo">
                A Place Where Future Talented Minds Assemble...
            </div>
            <div class="typing-demo">
                A Place Which Brings Glory To Your Skill...
            </div>
        </div>
    </div>

    <!-- Scripts -->

    <!-- Animation Scripts-->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 2000,
            once: true,
        });
    </script>
</body>

</html>