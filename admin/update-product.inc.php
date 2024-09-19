<?php
require_once 'include/connection.php'; // Ensure this file sets up a PDO connection and assigns it to $con

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and assign input data
    $category_id = htmlspecialchars(trim($_POST['category']));
    $sub_category_id = htmlspecialchars(trim($_POST['sub_category']));
    $p_name = htmlspecialchars(trim($_POST['p_name']));
    $p_discount = htmlspecialchars(trim($_POST['p_discount']));
    $p_price = htmlspecialchars(trim($_POST['p_price']));
    $p_quantity = htmlspecialchars(trim($_POST['p_quantity']));
    $p_color = htmlspecialchars(trim($_POST['p_color']));

    // Validate if the product ID is provided in the URL
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo "Error: Invalid product ID.";
        exit();
    }
    $product_id = intval($_GET['id']); // Get the product ID from the URL

    // Handle image upload
    $img_name = $_FILES['image']['name'];
    $img_tmp = $_FILES['image']['tmp_name'];
    $img_error = $_FILES['image']['error'];
    $img_size = $_FILES['image']['size'];

    if ($img_error === 0) {
        // Validate file extension
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        $ex = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));

        if (!in_array($ex, $allowed_ext)) {
            echo "Error: Invalid file type. Allowed types are JPG, JPEG, PNG, GIF.";
            exit();
        }

        // Validate file size (2MB limit)
        if ($img_size > 2 * 1024 * 1024) { // 2MB
            echo "Error: File size exceeds 2MB.";
            exit();
        }

        // Generate a unique name for the image file
        $newimage = uniqid() . "." . $ex;

        // Define the target directory
        $target_dir = 'C:/xampp/htdocs/E-comerce/uploads/';
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true); // Ensure the directory exists
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($img_tmp, $target_dir . $newimage)) {
            // Update product data in the database using a prepared statement
            $stmt = $con->prepare("
                UPDATE products 
                SET 
                    category_id = ?, 
                    sub_category_id = ?, 
                    p_name = ?, 
                    p_discount = ?, 
                    p_price = ?, 
                    quantity = ?, 
                    p_colour = ?, 
                    images = ? 
                WHERE id = ?
            ");

            // Execute the statement
            $stmt->execute([
                $category_id,
                $sub_category_id,
                $p_name,
                $p_discount,
                $p_price,
                $p_quantity,
                $p_color,
                $newimage,
                $product_id
            ]);

            if ($stmt->rowCount() > 0) {
                // Redirect to products page if update is successful
                header("Location: product.php?success=Product updated successfully");
                exit();
            } else {
                echo "Error: Could not update the product in the database.";
            }
        } else {
            echo "Error: Failed to move uploaded file.";
        }
    } else {
        echo "Error: There was an issue with the file upload.";
    }
} else {
    echo "Error: Submission issue.";
    exit();
}
