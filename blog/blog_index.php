<?php
include '../link.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" href="../Images/favicon.ico" type="image/x-icon" />
  <title>Victory EM School</title>
  <!-- Controlling Cache -->
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <!-- Links for Header -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

  <!-- Links for Carousel -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<style>
  /* Google Fonts Import Link */
  @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
  }

  body {
    background-color: whitesmoke;
  }

  /* Header */
  nav {
    display: flex;
    height: 80px;
    width: 100%;
    /* background: #1b1b1b; */
    /* background-image: linear-gradient(to top, #48c6ef 0%, #6f86d6 100%); */
    background: rgba(0, 0, 0, 0.5);
    align-items: center;
    justify-content: space-evenly;
    flex-wrap: wrap;
    position: absolute;
  }

  nav .heading {
    color: #fff;
    font-size: large;
  }

  nav ul {
    display: flex;
    flex-wrap: wrap;
    list-style: none;
  }

  nav ul li {
    margin: 0 5px;
    position: relative;
  }

  nav ul li a {
    color: #f2f2f2;
    text-decoration: none;
    font-size: 18px;
    font-weight: 500;
    padding: 8px 15px;
    border-radius: 5px;
    letter-spacing: 1px;
    transition: all 0.3s ease;
  }

  nav ul li a.active,
  nav ul li a:hover {
    color: #111;
    background: #fff;
    text-decoration: none;
  }

  nav .menu-btn i {
    color: #fff;
    font-size: 22px;
    cursor: pointer;
    display: none;
  }

  input[type="checkbox"] {
    display: none;
  }

  /* New */
  nav ul li .sub-menu {
    width: max-content;
    position: absolute;
    top: 35px;
    left: 0;
    /* background: #1b1b1b; */
    /* background-image: linear-gradient(to top, #48c6ef 0%, #6f86d6 100%); */
    background: rgba(0, 0, 0, 0.5);
    padding: 0 0 10px 0;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    border-radius: 0 0 4px 4px;
    display: none;
    z-index: 20;
  }

  nav ul li:hover .login-sub-menu {
    display: block;
  }

  ul li .sub-menu li {
    padding: 10px 0 0 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }

  ul li .sub-menu a {
    color: #fff;
    font-size: 15px;
    font-weight: 500;
  }

  @media (max-width: 920px) {
    nav .logo {
      font-size: 20px;
    }

    nav .logo img {
      width: 50px;
    }

    nav .menu-btn i {
      display: block;
    }

    nav ul {
      position: fixed;
      top: 80px;
      left: -100%;
      background: #111;
      height: 100vh;
      width: 100%;
      text-align: center;
      display: block;
      transition: all 0.3s ease;
      z-index: 20;
    }

    #click:checked~ul {
      left: 0;
    }

    nav ul li {
      width: 100%;
      margin: 20px 0;
    }

    nav ul li a {
      width: 100%;
      margin-left: -100%;
      display: block;
      font-size: 20px;
      transition: 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    #click:checked~ul li a {
      margin-left: 0px;
    }

    nav ul li a.active,
    nav ul li a:hover {
      background: none;
      color: cyan;
    }

    nav ul li .sub-menu {
      left: 80px;
    }

    ul li .sub-menu li {
      padding: 0 100px 0 0;
      margin-left: 30px;
    }
  }

  .img-container img {
    width: 100%;
    margin-top: -100px;
  }

  .title h4 {
    margin-top: -45%;
    width: 600px;
    color: #fff;
    margin-left: 5%;
    font-size: 45px;
    line-height: 50px;
    font-family: Georgia, 'Times New Roman', Times, serif;
    font-weight: bold;
  }

  .tip-box {
    font-style: italic;
    font-size: 25px;
  }

  @media screen and (max-width:574px) {
    .img-container img {
      margin-top: 0;
    }

    .title h4 {
      font-size: 15px;
      width: 200px;
      line-height: 20px;
      margin-top: -40%;
    }

    .tip-box {
      font-size: 18px;
    }

  }
</style>

<body>
  <!-- Header -->
  <nav>
    <div class="logo">
      <img src="../Images/Victory Logo.png" alt="..." width="70px" />
    </div>
    <div class="heading">
      <h3>Victory Schools, Kodur</h3>
    </div>
    <input type="checkbox" id="click" />
    <label for="click" class="menu-btn">
      <i class="fas fa-bars"></i>
    </label>
    <ul>
      <li><a href="../index.php">Home</a></li>
      <li><a href="../about.html">About</a></li>
      <li><a href="../Gallery/gallery.html">Gallery</a></li>
      <li><a href="../contact.html">Contact</a></li>
      <li><a href="../youtube.php" id="link">Our Stories</a></li>
      <li><a class="active" href="blog_index.php" id="link">Blog</a></li>
      <li>
        <a href="#">Login</a>
        <ul class="login-sub-menu sub-menu">
          <li><a href="../Admin/admin_login.php">Admin Login</a></li>
          <li><a href="../Student/student_login.php">Student Login</a></li>
          <li><a href="../Faculty/faculty_login.php">Faculty Login</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div class="container-fluid" style="padding:0;">
    <div class="img-container">
      <img src="../Images/blog/main-bg.jpg" alt="">
      <div class="title">
        <h4>Celebrating Student Achievements Together as a Community</h4>
      </div>
    </div>
  </div>
  <div class="container" style="margin-top: 37%;">
    <div class="container mb-5">
      <h3 class="text-center">Tip of the Day</h3>
      <?php
      $dayNumber = date('z'); // 0–365
      $result = mysqli_query($link, "SELECT tip_text FROM tips ORDER BY id LIMIT 1 OFFSET " . ($dayNumber % 50));
      $row = mysqli_fetch_assoc($result);
      echo "<div class='tip-box text-center'>\"" . $row['tip_text'] . "\"</div>";
      ?>
    </div>
    <h3 class="text-center">Engage in Events and Activities from Victory Schools</h3>
    <h5 class="text-center mt-4">Posts From the School Desk</h5>
    <div class="cards-container">
      <?php
      $query1 = mysqli_query($link, "SELECT * FROM `posts` WHERE Author='School' ORDER BY STR_TO_DATE(Posted_On,'%d-%m-%Y %H:%i:%s') DESC");
      $count = 0;

      echo '<div class="row g-4">'; // start first row

      while ($row1 = mysqli_fetch_assoc($query1)) {
      ?>
        <div class="col-12 col-md-4 mb-3">
          <div class="card h-100">
            <img src="../Images/blog/posts_images/<?php echo $row1['Cover_Photo']; ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row1['Title']; ?></h5>
              <p class="card-text"><?php echo $row1['Description']; ?></p>
            </div>
            <div class="card-footer d-flex justify-content-between small text-muted">
              <span>📅 <?php echo date("M d, Y", strtotime($row1['Posted_On'])); ?></span>
              <a href="post.php?id=<?php echo $row1['Post_Id']; ?>">Read More</a>
            </div>
          </div>
        </div>
      <?php

        $count++;

        // After every 3 posts, close row and start a new one
        if ($count % 3 == 0) {
          echo '</div><div class="row g-4">';
        }
      }

      echo '</div>'; // close last row
      ?>
    </div>


  </div>

  <footer class="bg-dark text-light py-3 mt-5">
    <div class="container text-center">
      <p class="mb-1">&copy; <?php echo date('Y'); ?> Victory Schools, Kodur. All Rights Reserved.</p>
      <small>
        Developed by
        <a href="https://sarathtechgenics.netlify.app" target="_blank" class="text-info">Sarath Techgenics</a>
      </small>
    </div>
  </footer>

</body>

</html>