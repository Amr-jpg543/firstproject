<?php
require_once 'include/connection.php';
if(isset($_POST['submit'])){
$cat_name=$_POST['cat_name'];
 $stmt = $con->prepare("INSERT INTO category (cat_name) VALUES (:cat_name)");
$stmt->execute([':cat_name' => $cat_name]);
if($stmt){
        echo "success";
        header("Location:category.php");
}else{
    echo "error";
}

}else {

    echo "a7aa";
}