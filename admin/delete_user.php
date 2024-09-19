 <?php

   require_once 'include/connection.php';

   if (isset(($_GET['id']))) {

      $user_id = $_GET['id'];
      $stmt = $con->prepare("DELETE FROM users WHERE `id`= ?");
      $stmt->execute([$user_id]);
      $stmt = $con->prepare("DELETE FROM orders WHERE `user_id`= ?");
      $stmt->execute([$user_id]);
      $stmt->rowCount();
      if ($stmt->rowCount() > 0) {
         header("Location:users.php");
         echo "success";
      } else {
         header("Location:users.php");
         echo "error";
      }
   } else {
      echo "error - invalid parameter";
   }
