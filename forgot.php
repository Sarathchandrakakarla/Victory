<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>

  <title>Victory EM School</title>
  <body>
    <div class="container-fluid" id="main">
      <div class="container-fluid" id="header">
        <div class="row">
          <div class="logo col-md-8">
            <img
              src="Images/Victory Logo2.jpg"
              alt="Victory Logo"
              style="width: 100px;"
            />
          </div>
          <div class="heading col-md-4">
            <h2>VICTORY SCHOOLS</h2>
          </div>
        </div>
      </div>
      <div class="login" id="login">
        <div class="head">
          <h1 class="company">Forgot Password?</h1>
        </div>
        <div class="form">
          <form autocomplete="off" method="post" action="forgot_validate.php">
            <label for="username" style="margin-top: 10px;"><h5>Enter Your UserName:</h5></label>
            <input
              type="text"
              placeholder="Username"
              class="text"
              id="username"
              name="UserName"
              oninput="this.value = this.value.toUpperCase()"
              maxlength="9"
              required
            /><br />
            <!--
            <input
              type="password"
              placeholder="New Password"
              class="password"
              id="id_password"
              name="Password"
              required
            /><i class="far fa-eye" id="togglePassword" hidden style="margin-left: -30px; cursor: pointer;"></i>--><br />
            <input class="btn-login" type="submit" id="do-login" name="Forgot">
            <!--
            <div class="g-recaptcha" data-sitekey="your_site_key" style="margin-top: 10px;margin-left: 20px;"></div>
            -->
          </form>
        </div>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
