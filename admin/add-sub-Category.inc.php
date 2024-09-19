<?php
require_once 'include/connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cat_id = $_POST['cat_name'];
    $subcat_name=$_POST['subcat_name'];
    $stmt = $con->prepare("INSERT INTO sub_category (sub_cat_name,category_id) VALUES (:subcat_name,:cat_id)");
    $stmt->execute([':subcat_name' => $subcat_name,':cat_id'=>$cat_id]);
    if ($stmt) {
        echo "success";
        header("Location:sub-category.php");
    } else {
        echo "error";
    }
} else {

    echo "a7aa";
}
