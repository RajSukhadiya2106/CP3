<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
</head>

<body>

    <?php
    require_once("../config/conn.php");
    include("header.php");
    if (!isset($_SESSION['User_id'])) {
        echo "User is not authenticated.";
        exit;
    }
    $user_id = $_SESSION['User_id'];
    $sql = "SELECT * FROM user WHERE User_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $first_name = $row['User_name'];
        $last_name = $row['User_name'];
        $email = $row['Email'];
        $address = $row['Address'];
        $phone = $row['Contact_no'];
    } else {
        echo "No user data found.";
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $order_description = $_POST['Order_des'];
        $order_date = date('Y-m-d');
        $payment_method = $_POST['paymentmethod']; // Get selected payment method

        $sql = "INSERT INTO `order` (Order_des, Order_date, Payment_status, User_id, Order_status)
        VALUES ('$order_description', '$order_date', ' $payment_method ', $user_id, 0)";


        if (mysqli_query($conn, $sql)) {
            $last_order_id = mysqli_insert_id($conn); // Get the ID of the newly created order
            // Redirect using JavaScript
            echo '<script>window.location.href = "index.php";</script>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Get order details
    $oid = $_GET['id'];
    $sql = "SELECT o.Order_id, o.Order_des, o.Order_date, o.Payment_status, o.Order_status,
               ot.Quantity, p.P_name, p.P_price
        FROM `order` o
        JOIN `order details` ot ON o.Order_id = ot.Order_id
        JOIN product p ON ot.P_id = p.P_id
        WHERE o.Order_id = '$oid'";
    $result = mysqli_query($conn, $sql);
    ?>

    <main>
        <div class="checkout-page-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout-billing-details-wrap">
                                    <h4 class="checkout-title">Billing Details</h4>
                                    <div class="billing-form-wrap">
                                        <form action="#" method="post">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="single-input-item">
                                                        <label for="f_name" class="required">First Name</label>
                                                        <input type="text" id="f_name" name="f_name" placeholder="First Name" required value="<?php echo $first_name; ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-input-item">
                                                        <label for="l_name" class="required">Last Name</label>
                                                        <input type="text" id="l_name" name="l_name" placeholder="Last Name" required value="<?php echo $last_name; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-input-item">
                                                <label for="email" class="required">Email Address</label>
                                                <input type="email" id="email" name="email" placeholder="Email Address" required value="<?php echo $email; ?>" />
                                            </div>
                                            <div class="single-input-item">
                                                <label for="address" class="required mt-20">Street address</label>
                                                <input type="text" id="address" name="address" placeholder="Address" required value="<?php echo $address; ?>" />
                                            </div>
                                            <div class="single-input-item">
                                                <label for="phone">Phone</label>
                                                <input type="text" id="phone" name="phone" placeholder="Phone" value="<?php echo $phone; ?>" />
                                            </div>
                                            <div class="single-input-item">
                                                <label>Product Name</label>
                                                <input value=<?php echo $_GET['p_name']  ?> name="Order_des" id="Order_des" type="text" readonly />
                                            </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Order Summary Details (Continuation) -->
                            <div class="col-lg-6">
                                <div class="order-summary-details">
                                    <h4 class="checkout-title">Your Order Summary</h4>
                                    <div class="order-summary-content">
                                        <!-- Order Summary Table (Continuation) -->
                                        <div class="order-summary-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Products</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td>Sub Total</td>
                                                        <td><strong>Rs.<?php echo $_GET['amt'] ?></strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Amount</td>
                                                        <td><strong>Rs. <?php echo $_GET['amt'] ?></strong></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- Order Payment Method (Continuation) -->
                                        <div class="order-payment-method">

                                            <div class="single-payment-method show">
                                                <div class="payment-method-name">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="cashon" name="paymentmethod" value="cash" class="custom-control-input" checked />
                                                        <label class="custom-control-label" for="cashon">Cash On Delivery</label>
                                                    </div>
                                                </div>
                                                <div class="payment-method-details" data-method="cash">
                                                    <p>Pay with cash upon delivery.</p>
                                                </div>
                                            </div>
                                            <div class="single-payment-method">
                                                <div class="payment-method-name">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="directbank" name="paymentmethod" value="bank" class="custom-control-input" />
                                                        <label class="custom-control-label" for="directbank">Direct Bank Transfer</label>
                                                    </div>
                                                </div>
                                                <div class="payment-method-details" data-method="bank">
                                                    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                                                </div>
                                            </div>
                                            <!-- Add other payment methods similarly -->
                                            <div class="single-payment-method">
                                                <div class="payment-method-name">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="checkpayment" name="paymentmethod" value="check" class="custom-control-input" />
                                                        <label class="custom-control-label" for="checkpayment">Pay with Check</label>
                                                    </div>
                                                </div>
                                                <div class="payment-method-details" data-method="check">
                                                    <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                                </div>
                                            </div>
                                            <div class="single-payment-method">
                                                <div class="payment-method-name">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="paypalpayment" name="paymentmethod" value="paypal" class="custom-control-input" />
                                                        <label class="custom-control-label" for="paypalpayment">Paypal <img src="assets/img/paypal-card.jpg" class="img-fluid paypal-card" alt="Paypal" /></label>
                                                    </div>
                                                </div>
                                                <div class="payment-method-details" data-method="paypal">
                                                    <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                                </div>
                                            </div>
                                            <div class="summary-footer-area">
                                                <div class="custom-control custom-checkbox mb-20">
                                                    <input type="checkbox" class="custom-control-input" id="terms" required />
                                                    <label class="custom-control-label" for="terms">I have read and agree to the website <a href="index.html">terms and conditions.</a></label>
                                                </div>
                                                <button type="submit" class="btn btn-sqr">Place Order</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- main wrapper end -->
    <?php
    include('footer.php');
    ?>

    <script src="assets/js/vendor.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/active.js"></script>
</body>

</html>