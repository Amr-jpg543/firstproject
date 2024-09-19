<?php
require_once 'include/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cat_id']) && isset($_POST['cat_name'])) {
    $cat_id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];

    try {
        $stmt = $con->prepare("UPDATE category SET cat_name = :cat_name WHERE id = :cat_id");
        $stmt->bindParam(':cat_name', $cat_name, PDO::PARAM_STR);
        $stmt->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
        $stmt->execute();

        echo 'Category updated successfully';
        header("location:category.php");// This will be received by the AJAX success function
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage(); // Handle errors
    }
}
?>




