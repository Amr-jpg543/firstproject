 <?php

    require_once 'include/connection.php';

    if (isset(($_GET['l_id']))) {

        $user_id = $_GET['l_id'];
        $stmt = $con->prepare("DELETE FROM locationw WHERE `id`= ?");
        $stmt->execute([$user_id]);
        $stmt->rowCount();
        if ($stmt->rowCount() > 0) {
            header("Location:notification.php");
            echo "success";
        } else {
         //   header("Location:users.php");
            echo "error";
        }
    } else {
        echo "error - invalid parameter";
    }
