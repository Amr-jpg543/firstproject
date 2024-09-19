<?php
require_once 'include/connection.php';




if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the delete statement
  

    $stmt = $con->prepare("DELETE FROM products WHERE id= ?");
    $stmt->execute([$id]);
if($stmt->rowCount()>0){
        echo "Success";
        header("Location:product.php");
}else{
        echo "error";

}

    // Redirect to avoid re-submission on refresh
 
    exit;
}else{
    echo "error something";
}
