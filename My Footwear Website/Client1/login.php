<?php
session_start(); // Start a session at the beginning of your script

require_once('../config/connection.php'); // Make sure to include your database connection

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

  if (!empty($email) && !empty($password)) {
    $sql = "SELECT User_id, User_name, Email, Password, is_admin FROM User WHERE Email = '$email' AND Password = '$password' ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      $row_count = mysqli_num_rows($result);
      if ($row_count == 1) {
        // Authentication successful, set up a session
        $row = mysqli_fetch_assoc($result);
        $_SESSION["User_id"] = $row['User_id'];
        header('location: index.php');
        exit;
      } else {
        echo "<center>Invalid password.</center>";
      }
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="meta description">
  <title>Footwear Shop</title>
  <!--=== Favicon ===-->
  <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
  <!--=== All Plugins CSS ===-->
  <link href="assets/css/plugins.css" rel="stylesheet">
  <!--=== All Vendor CSS ===-->
  <link href="assets/css/vendor.css" rel="stylesheet">
  <!--=== Main Style CSS ===-->
  <link href="assets/css/style.css" rel="stylesheet">
  <!-- Modernizer JS -->
  <script src="assets/js/modernizr-2.8.3.min.js"></script>

</head>

<body>
  <div class="loader"></div>

  <main>
    <!-- Your HTML content for the login form goes here -->
    <div class="login-register-wrapper section-padding">
      <div class="container">
        <div class="member-area-from-wrap">
          <div class="row">
            <div class="col-lg-6">
              <div class="login-reg-form-wrap">
                <h2>Sign In</h2>
                <form action="login.php" method="post">
                  <div class="single-input-item">
                    <label for="email">Email or Username</label>
                    <input type="email" id="email" name="email" placeholder="Email or Username" required />
                    <span class="error">
                      <?php echo $emailErr; ?>
                    </span>
                  </div>
                  <div class="single-input-item">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your Password" required />
                    <span class="error">
                      <?php echo $passwordErr; ?>
                    </span>
                  </div>

                  <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <style>
    .error {
      color: pink:
    }
  </style>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/vendor.js"></script>
  <!--=== All Plugins Js ===-->
  <script src="assets/js/plugins.js"></script>
  <!--=== Active Js ===-->
  <script src="assets/js/active.js"></script>
</body>

</html>