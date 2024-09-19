<?php
require_once 'include/connection.php';




if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the delete statement
    $stmt = $con->prepare("DELETE FROM category WHERE id = ?");
    $stmt->execute([$id]);

    $stmt = $con->prepare("DELETE FROM products WHERE category_id= ?");
    $stmt->execute([$id]);

    $stmt = $con->prepare("DELETE FROM sub_category WHERE category_id = ?");
    $stmt->execute([$id]);

    // Redirect to avoid re-submission on refresh
    header("Location:category.php");
    exit;
}
