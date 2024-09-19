<?php
require_once 'include/connection.php'; // Ensure this file sets up a PDO connection and assigns it to $con



session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize input data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $street = htmlspecialchars(trim($_POST['street']));
    $city = htmlspecialchars(trim($_POST['city']));
    $description = htmlspecialchars(trim($_POST['description']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $user_id = $_GET['l_id'];
    try {
        $stmt = $con->prepare("UPDATE locationw SET email=?, phone=?, name=?, street=?, city=?, description=?  WHERE id = ? ");
        $stmt->execute(array($email, $phone, $name, $street, $city, $description, $user_id));

        // Check if any rows were affected (i.e., if the user was successfully added)
        if ($stmt->rowCount() > 0) {
            $_SESSION['success'] = "Record successfully added.";
            header("Location:notification.php"); // Redirect to a success page
            exit();
        } else {
            $_SESSION['error'] = "Error: Unable to add record.";
            //  header("Location:notification.php"); // Redirect back to the form page
            exit();
        }
    } catch (PDOException $e) {
        // Handle database errors
        $_SESSION['error'] = 'Database error: ' . $e->getMessage();
        // header("Location:notification.php");
        exit();
    }
} else {
    echo "Error: Submission failed.";
}
