<!DOCTYPE html>
<html lang="en">

<?php


require_once('../config/connection.php');
$emailErr = $passwordErr = "";
$email = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = $_POST["email"];
  }
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = $_POST["password"];
  }


  if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($email != '' && $password != '') {
      $sql = "select User_id,User_name,Email,Password,User_name from User where Email= '" . $email . "'
					and Password ='" . $password . "' and is_admin = 1";


      $result = mysqli_query($conn, $sql);
      if ($row = mysqli_fetch_assoc($result)) {
        session_start();
        $_SESSION["User_id"] = $row['User_id'];
        $_SESSION["User_name"] = $row['User_id'];
        header('location:index.php');
      } else {
        echo "<center>invalid password..!</center>";
      }
    }
  }
}

?>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Jaymin Footwear - Admin Dashboard </title>
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">

                <h4>Login</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="#" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <span class="error">
                      <?php echo $emailErr; ?>
                    </span>
                    <div class="invalid-feedback">
                      Email is Required
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>

                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <span class="error">
                      <?php echo $passwordErr; ?>
                    </span>
                    <div class="invalid-feedback">
                      Password is Required
                    </div>
                  </div>
                  <div class="float-left">
                    <a href="forgotpassword.php" class="text-small">
                      Forgot Password?
                    </a>
                  </div>
                  <div class="float-right">
                    <a href="resetpassword.php" class="text-small">
                      Reset Password?
                    </a>
                  </div>

                  <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Login</button>

                  </div>

                </form>

              </div>
            </div>
    </section>
  </div>
  <style>
    .error {
      color: pink;
    }
  </style>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>