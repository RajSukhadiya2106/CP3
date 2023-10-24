<?php
session_start();
require_once('../config/connection.php');

$user_nameErr = $emailErr = $contact_noErr = $addressErr = $area_idErr = $passwordErr = "";
$user_name = $email = $contact_no = $address = $area_id = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["User_name"])) {
        $user_nameErr = "User name is required";
    } else {
        $user_name = $_POST["User_name"];
    }
    if (empty($_POST["Email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["Email"];
    }
    if (empty($_POST["Contact_no"])) {
        $contact_noErr = "Contact number is required";
    } else {
        $contact_no = $_POST["Contact_no"];
    }
    if (empty($_POST["Address"])) {
        $addressErr = "Address is required";
    } else {
        $address = $_POST["Address"];
    }
    if ($_POST["Area_id"] == "Area name") {
        $area_idErr = "Please select an Area";
    } else {
        $area_id = $_POST["Area_id"];
    }
    if (empty($_POST["Password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST["Password"];
    }

    if (!empty($user_name) && !empty($email) && !empty($contact_no) && !empty($address) && !empty($area_id) && !empty($password)) {

        $sql = "INSERT INTO user (User_name, Email, Contact_no, Address, Area_id, Password, is_admin, Created_date) 
        VALUES ('$user_name', '$email', '$contact_no', '$address', '$area_id', '$password', 0, NOW())";


        if (mysqli_query($conn, $sql)) {

            header('location: login.php');
            exit;
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
    <title>Our Footwear Shop</title>
    <!--=== Favicon ===-->
    <!-- <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" /> -->
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
        <center>
            <div class="col-lg-6">
                <div class="login-reg-form-wrap signup-form">
                    <h2>Singup Form</h2>
                    <form method="post">
                        <div class="single-input-item">
                            <input type="text" name="User_name" placeholder="User name" required />
                        </div>
                        <div class="single-input-item">
                            <input type="email" name="Email" placeholder="Email" required />
                        </div>

                        <div class="single-input-item">
                            <input type="text" name="Address" placeholder="Address" required />
                        </div>
                        <div class="single-input-item">
                            <input type="text" name="Contact_no" placeholder="Contact-no" required />
                        </div>
                        <div class="single-input-item">

                            <div class="form-group">
                                <label></label>
                                <select class="form-control" name="Area_id">
                                    <option readonly selected>Area name</option>
                                    <?php
                                    $sql = "select * from area";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>

                                        <option value="<?php echo $row['Area_id']; ?>">
                                            <?php echo $row['Area_name']; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="single-input-item">
                                    <input type="password" name="Password" placeholder="Enter your Password" required />
                                </div>
                            </div>

                        </div>


                        <div class="single-input-item">
                            <div class="login-reg-form-meta">
                            </div>
                        </div>
                        <div class="single-input-item">
                        <p>Already Have an Account!!! <a href="login.php">Login</a></p>
                            <button type="submit" name="register" class="btn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </center>
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