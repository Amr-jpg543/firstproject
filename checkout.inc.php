<?php
session_start();
require_once 'admin/include/connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize an errors array
    $errors = [];

    // Retrieve and validate form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $country = trim($_POST['country']);
    $phone = trim($_POST['tel']);
    $shipping_address = trim($_POST['shipping_address']);
    $total_price = $_POST['total_price'];
   // $cart_product_ids = $_POST['p_id'];

    // Simple validation
    if (empty($name)) {
        $errors[] = 'Name is required';
    }
    if (empty($email)) {
        $errors[] = 'Email is required';
    }
    if (empty($address)) {
        $errors[] = 'Address is required';
    }
    if (empty($city)) {
        $errors[] = 'City is required';
    }
    if (empty($country)) {
        $errors[] = 'Country is required';
    }
    if (empty($phone)) {
        $errors[] = 'Phone number is required';
    }
    if (empty($shipping_address)) {
        $errors[] = 'Shipping address is required';
    }
    // if (empty($total_price) || empty($cart_product_ids)) {
    //     $errors[] = 'Cart details are missing';
    // }

    // If there are no errors, proceed with order placement
    if (empty($errors)) {
        try {
            // Prepare SQL to insert the order into the 'orders' table
            $stmt = $con->prepare("INSERT INTO orders (user_id, shipping_address, total_price) VALUES (?, ?, ?)");
            $stmt->execute([$_SESSION['id'], $shipping_address, $total_price]);
            $order_id = $con->lastInsertId();

            // Insert order items from the cart into the 'order_items' table
            // $cart_items = explode(',', $cart_product_ids);
            // foreach ($cart_items as $item) {
            //     list($product_id, $product_qty) = explode('-', $item);
            //     $stmt = $con->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");
            //     $stmt->execute([$order_id, $product_id, $product_qty]);
            

            // Clear the cart after successful order
            $stmt = $con->prepare("DELETE FROM cart WHERE user_id = ?");
            $stmt->execute([$_SESSION['id']]);
header("Location:index.php");
            // Redirect to order success page or show success message
            echo "Order placed successfully!";
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Show errors to the user
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
