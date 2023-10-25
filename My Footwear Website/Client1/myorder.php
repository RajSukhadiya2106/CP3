<!DOCTYPE html>
<html class="no-js" lang="zxx">

<?php
session_start();
include('header.php');
require_once("../config/conn.php");
$id = $_SESSION['User_id'];
if (isset($_GET['id'])  && isset($_GET['name'])); {
    $sql = "select * from user where User_id = '" . $id . "'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
}
?>
<main>
    <div class="breadcrumb-area bg-img" data-bg="assets/img/banner/breadcrumb-banner.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap text-center">
                        <nav aria-label="breadcrumb">
                            <h1 class="breadcrumb-title">Cart</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="pro-title">Product</th>
                                        <th class="pro-price">Price</th>
                                        <th class="pro-quantity">Quantity</th>
                                        <th class="pro-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <?php

                                $id = $_SESSION['User_id'];

                                $sql = "select * from `order details` O join `product` p join `order`  r join user u  where O.Order_id=r.Order_id and O.P_id=P.P_id and r.User_id=u.User_id and r.User_id='" . $id . "'
										";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {

                                    $id = $row['P_id'];

                                ?>
                                    <tr>
                                        <td class="pro-title"><a href="#"><?php echo $row['P_name'] ?></a></td>
                                        <td class="pro-price"><span>₹<?php echo $row['P_price'] ?></span></td>
                                        <td>
                                            <input type="text" class="form-control text-center" value="<?php echo $row['Quantity'] ?>">

                                        </td>
                                        <td class="pro-price"><span>₹<?php echo $row['Amount'] ?></span></td>
                                    </tr>
                                <?php } ?>


                                </tbody>
                            </table>
                        </div>
</main>

<?php include('footer.php'); ?>
<div class="offcanvas-search-wrapper">
    <div class="offcanvas-search-inner">
        <div class="offcanvas-close">
            <i class="ion-android-close"></i>
        </div>
        <div class="container">
            <div class="offcanvas-search-box">
                <form class="d-flex bdr-bottom w-100">
                    <input type="text" placeholder="Search entire storage here...">
                    <button class="search-btn"><i class="ion-ios-search-strong"></i>search</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="offcanvas-minicart-wrapper">
    <div class="minicart-inner">
        <div class="offcanvas-overlay"></div>
        <div class="minicart-inner-content">
            <div class="minicart-close">
                <i class="ion-android-close"></i>
            </div>
            <div class="minicart-content-box">
                <div class="minicart-item-wrapper">
                    <ul>
                        <li class="minicart-item">
                            <div class="minicart-thumb">
                                <a href="product-details.html">
                                    <img src="assets/img/cart/cart-1.jpg" alt="product">
                                </a>
                            </div>
                            <div class="minicart-content">
                                <h3 class="product-name">
                                    <a href="product-details.html">Flowers bouquet pink for all flower lovers</a>
                                </h3>
                                <p>
                                    <span class="cart-quantity">1 <strong>&times;</strong></span>
                                    <span class="cart-price">$100.00</span>
                                </p>
                            </div>
                            <button class="minicart-remove"><i class="ion-android-close"></i></button>
                        </li>
                        <li class="minicart-item">
                            <div class="minicart-thumb">
                                <a href="product-details.html">
                                    <img src="assets/img/cart/cart-2.jpg" alt="product">
                                </a>
                            </div>
                            <div class="minicart-content">
                                <h3 class="product-name">
                                    <a href="product-details.html">Jasmine flowers white for all flower lovers</a>
                                </h3>
                                <p>
                                    <span class="cart-quantity">1 <strong>&times;</strong></span>
                                    <span class="cart-price">$80.00</span>
                                </p>
                            </div>
                            <button class="minicart-remove"><i class="ion-android-close"></i></button>
                        </li>
                    </ul>
                </div>

                <div class="minicart-pricing-box">
                    <ul>
                        <li>
                            <span>sub-total</span>
                            <span><strong>$300.00</strong></span>
                        </li>
                        <li>
                            <span>Eco Tax (-2.00)</span>
                            <span><strong>$10.00</strong></span>
                        </li>
                        <li>
                            <span>VAT (20%)</span>
                            <span><strong>$60.00</strong></span>
                        </li>
                        <li class="total">
                            <span>total</span>
                            <span><strong>$370.00</strong></span>
                        </li>
                    </ul>
                </div>

                <div class="minicart-button">
                    <a href="cart.html"><i class="fa fa-shopping-cart"></i> view cart</a>
                    <a href="cart.html"><i class="fa fa-share"></i> checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="scroll-top not-visible">
    <i class="fa fa-angle-up"></i>
</div>
<script src="assets/js/vendor.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/active.js"></script>
</body>

</html>