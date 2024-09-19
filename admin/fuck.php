<?php
require_once 'include/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cat_id = $_POST['cat_name'];
    $sub_cat_name = $_POST['update_sub_cat'];
    $sub_cat_id = $_POST['sub_cat_id'];

    if (empty($cat_id) || empty($sub_cat_name) || empty($sub_cat_id)) {
        header('Location: your_page.php?error=Please fill in all fields');
        exit;
    }

  
        $stmt = $con->prepare("UPDATE sub_category SET category_id = :cat_id, sub_cat_name = :sub_cat_name WHERE id = :sub_cat_id");
        $stmt->bindParam(':cat_id', $cat_id);
        $stmt->bindParam(':sub_cat_name', $sub_cat_name);
        $stmt->bindParam(':sub_cat_id', $sub_cat_id);
        $stmt->execute();

      
   if($stmt){
        header("Location:sub-category.php");
   }else{
        echo "Error st";
   }
      

}else {

    echo "Error";
}
