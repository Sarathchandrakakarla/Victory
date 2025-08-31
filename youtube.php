<?php
include "link.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" href="Images/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="css/header.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <!-- Bootstrap Links -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous" />

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <!-- Boxiocns CDN Link -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <link
    href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
    rel="stylesheet" />
  <title>Victory EM School</title>
</head>
<style>
  body {
    background-image: linear-gradient(to top, #cfd9df 0%, #e2ebf0 100%);
    height: 1000px;
    display: flex;
    flex-direction: column;
  }

  /* Container for the video grid */
  .videos-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    /* 2 videos per row */
    gap: 20px;
    max-width: 1200px;
    margin: 0 auto;
  }

  /* Styling for each video block */
  .video-item {
    border: 1px solid #ddd;
    padding: 10px;
    background-color: #f9f9f9;
    text-align: center;
  }

  /* Styling the iframe to make it responsive */
  .video-item iframe {
    width: 100%;
    border: none;
  }

  /* Title and date styling */
  .video-title {
    font-size: 16px;
    font-weight: bold;
    margin-top: 10px;
  }

  .video-date {
    font-size: 14px;
    color: #777;
  }

  @media screen and (max-width: 768px) {
    .videos-container {
      grid-template-columns: 1fr;
      gap: 70px;
      /* 1 video per row on mobile */
    }
  }

  /* Footer */
  footer {
    bottom: 0;
    left: 0;
    right: 0;
    height: auto;
    width: 98.9vw;
    padding-top: 40px;
    color: #fff;
  }

  .footer-bottom {
    background: #000;
    width: 98.9vw;
    padding: 20px;
    padding-bottom: 40px;
    text-align: center;
  }

  .footer-bottom p {
    float: left;
    font-size: 14px;
    word-spacing: 2px;
    text-transform: capitalize;
  }

  .footer-bottom p a {
    color: #44bae8;
    font-size: 16px;
    text-decoration: none;
  }

  .footer-menu {
    float: right;
  }

  .footer-menu ul {
    display: flex;
  }

  .footer-menu ul li {
    padding-right: 10px;
    display: block;
  }

  .footer-menu ul li a {
    color: #cfd2d6;
    text-decoration: none;
  }

  .footer-menu ul li a:hover {
    color: #27bcda;
  }

  @media (min-width: 500px) {
    /* footer {
      bottom: -155%;
    } */
  }

  @media (max-width: 500px) {
    body {
      height: 1500px;
    }

    footer {
      background: #111;
      bottom: -350%;
      width: 100vw;
    }

    .footer-bottom {
      width: 100vw;
    }

    .footer-menu ul {
      display: flex;
      margin-top: 10px;
      margin-bottom: 20px;
    }
  }

  .company-tag {
    padding-top: 3px;
    float: right !important;
  }

  @media (min-width: 500px) {
    .company-tag {
      margin-left: 15%;
    }
  }
</style>

<body>
  <nav>
    <div class="logo">
      <img src="Images/Victory Logo.png" alt="..." width="70px" />
    </div>
    <div class="heading">
      <h3>Victory Schools, Kodur</h3>
    </div>
    <input type="checkbox" id="click" />
    <label for="click" class="menu-btn">
      <i class="fas fa-bars"></i>
    </label>
    <ul>
      <li><a id="link" href="index.php">Home</a></li>
      <li><a href="about.html" id="link">About</a></li>
      <li><a href="Gallery/gallery.html" id="link">Gallery</a></li>
      <li><a href="contact.html" id="link">Contact</a></li>
      <li><a class="active" href="youtube.php" id="link">Our Stories</a></li>
      <li><a href="blog/blog_index.php" id="link">Blog</a></li>
      <li>
        <a href="#">Login</a>
        <ul class="login-sub-menu sub-menu">
          <li><a href="Admin/admin_login.php">Admin Login</a></li>
          <li><a href="Student/student_login.php">Student Login</a></li>
          <li><a href="Faculty/faculty_login.php">Faculty Login</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div class="container">
    <h2 class="text-center mt-3">Our Victory School Events Videos</h2>
    <p class="text-center">You can watch our school events live and recorded videos from here easily!</p>
    <div class="container videos-container">
      <?php
      $videos = [];
      $query1 = mysqli_query($link, "SELECT * FROM `youtube`");
      while ($row1 = mysqli_fetch_assoc($query1)) {
        $videos[$row1['Video_Id']] = [$row1['Video_Title'], $row1['Published_Date']];
      }
      // Sort the $videos array by Published_Date in descending order (latest to oldest)
      uasort($videos, function ($a, $b) {
        // Convert Published_Date to DateTime objects for comparison
        $dateA = DateTime::createFromFormat('d-m-Y H:i:s', $a[1]);
        $dateB = DateTime::createFromFormat('d-m-Y H:i:s', $b[1]);

        // Compare the two dates (latest to oldest)
        return $dateB <=> $dateA; // Using spaceship operator to compare
      });
      ?>
      <?php foreach ($videos as $video_id => $video): ?>
        <div class="video-item">
          <iframe
            src="https://www.youtube.com/embed/<?php echo htmlspecialchars($video_id); ?>"
            title="<?php echo htmlspecialchars($video[0]); ?>"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen
            height="300"></iframe>
          <div class="video-title"><?php echo htmlspecialchars($video[0]); ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <footer>
    <div class="footer-bottom">
      <p>
        &copy;
        <span id="year"></span>, <a href="/">Victory Schools </a>. All Rights
        Reserved.
      </p>
      <p class="company-tag">
        Developed and Maintained by
        <u><a href="https://sarathtechgenics.netlify.app" target="_blank">Sarath Techgenics</a></u>
      </p>
      <!-- <div class="footer-menu">
          <ul class="f-menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="Gallery/gallery.html">Gallery</a></li>
            <li><a href="contact.html">Contact</a></li>
          </ul>
        </div> -->
    </div>
  </footer>

  <!-- Scripts -->

  <!-- Copyright Year -->
  <script>
    var d = new Date();
    document.getElementById("year").innerHTML = d.getFullYear();
  </script>

  <script></script>
</body>

</html>