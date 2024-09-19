<?php
require_once 'admin/include/connection.php';
session_start();
if(isset($_POST['submit'])){

    $product_id=$_POST['product_id'];
    $user_id=$_SESSION['id'];
    $qty=$_POST['qty'];
 $stmt = $con->prepare("INSERT INTO cart (p_qty,product_id,user_id) VALUES (:qty,:product_id,:user_id)");
$stmt->execute([':qty' => $qty,':product_id' =>$product_id,':user_id' =>$user_id]);
if($stmt){
        echo "success";
        header("Location:index.php");
}else{
    echo "error";
}

}else {

    echo "a7aa";
}
