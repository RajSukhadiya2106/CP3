<footer class="footer-wrapper">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <div class="footer-widget-area section-padding">
        <div class="container">
            <div class="row mtn-40">
                <div class="col-xl-5 col-lg-3 col-md-6">
                    <div class="widget-item mt-40">
                        <h5 class="widget-title">My Account</h5>
                        <div class="widget-body">
                            <ul class="location-wrap">
                                <li><i class="ion-ios-location-outline"></i>Shop No.2,High School Shopping Centre,Chikhli,Gujarat</li>
                                <li><i class="ion-ios-email-outline"></i>Mail Us: <a href="MailTo:rajsukhadiya5322@gmail.com">rajsukhadiya5322@gmail.com</a></li>
                                <li><i class="ion-ios-telephone-outline"></i>Phone: +919426111125</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-6">
                    <div class="widget-item mt-40">
                        <h5 class="widget-title">Categories</h5>
                        <div class="widget-body">
                            <ul class="useful-link">
                                <?php
                                $sql = "select * from category ";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <li><a href="#"></a><?php echo $row['C_name'] ?></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-6">
                    <div class="widget-item mt-40">
                        <h5 class="widget-title">Information</h5>
                        <div class="widget-body">
                            <ul class="useful-link">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="aboutus.php">About Us</a></li>
                                <li><a href="contactus.php">Contact Us</a></li>
                                <li><a href="index.php">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-2 order-md-1">
                    <div class="copyright-text text-center text-md-left">
                        <p class="centered-text">Copyright 2023 <a href="index.php">Jaymin Footwear</a>. All Rights Reserved</p>
                    </div>
                </div>
                <div class="social-media-icons">
                    <div class="social-media-icons">
                        <a href="https://www.instagram.com/rajsukhadiya_20/" target="_blank">
                            <i class="fab fa-instagram fa-2x" style="color: #E4405F;"></i>
                        </a>
                        <a href="https://github.com/RajSukhadiya2106" target="_blank">
                            <i class="fab fa-facebook fa-2x" style="color: #1877f2;"></i>
                        </a>
                        <a href="https://www.facebook.com/raj.sukhadiya.9461" target="_blank">
                            <i class="fab fa-github fa-2x" style="color: #171515;"></i>
                    </div>
                </div>

            </div>
        </div>
    </div>

</footer>
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
                    <h5>Cart Items</h5>
                    <br>
                    <br>
                    <ul>

                        <?php
                        $id = $_SESSION['User_id'];
                        $sql1 = "select * from `cart` c join user u join product p where c.user_id= u.user_id and c.P_id=p.P_id and c.user_id='" . $id . "'";
                        $result1 = mysqli_query($conn, $sql1);
                        while ($row1 = mysqli_fetch_array($result1)) {
                        ?>
                            <li class="minicart-item">
                                <div class="minicart-thumb">
                                    <a href="#">
                                        <img src="assets/img/product/<?php echo $row1['P_image'] ?>"></a>
                                    </a>
                                </div>
                                <div class="minicart-content">
                                    <h3 class="product-name">
                                        <a href="product details.php"><?php echo $row1['P_name'] ?></a>
                                    </h3>
                                    <p>
                                        <span class="cart-quantity"><?php echo $row1['Cart_quantity'] ?> <strong>&times;</strong></span>
                                        <span class="cart-price"><?php echo $row1['Cart_price'] ?></span>
                                    </p>
                                </div>
                            </li>
                        <?php

                        } ?>

                        <div class="minicart-button">
                            <a href="cart1.php"><i class="fa fa-shopping-cart"></i> view cart</a>

                        </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/vendor.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/active.js"></script>
    </body>

    </html>