<?php
session_start();
require_once("../config/conn.php");

if (isset($_POST['update_cart'])) {
    $uid = $_SESSION['User_id'];
    $updatedQuantities = $_POST['quantity'];

    foreach ($updatedQuantities as $cartId => $newQuantity) {
        // Ensure that the new quantity is a positive integer
        $newQuantity = max(0, intval($newQuantity));

        // Update the quantity and price in the cart table
        $updateSql = "UPDATE cart SET Cart_quantity = $newQuantity, Cart_price = P_price * $newQuantity WHERE Cart_id = $cartId AND User_id = $uid";
        mysqli_query($conn, $updateSql);
    }
}

// Redirect back to the cart page
header("Location: cart.php");
exit();
?>
