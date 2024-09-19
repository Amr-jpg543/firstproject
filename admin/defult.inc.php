<?php
require_once 'include/connection.php'; // Ensure this file sets up a PDO connection and assigns it to $con


require_once 'include/connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize input data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $street = htmlspecialchars(trim($_POST['street']));
    $city = htmlspecialchars(trim($_POST['city']));
    $description = htmlspecialchars(trim($_POST['description']));
    $phone = htmlspecialchars(trim($_POST['phone']));

    try {
        $stmt = $con->prepare("INSERT INTO locationw (email, phone, name, street, city, description) VALUES (:zemail, :zphone, :zname, :zstreet, :zcity, :zdescription)");

        // Execute the prepared statement with an array of values
        $stmt->execute([
            'zemail' => $email,
            'zphone' => $phone,
            'zname' => $name,
            'zstreet' => $street,
            'zcity' => $city,
            'zdescription' => $description
        ]);

        // Check if any rows were affected (i.e., if the user was successfully added)
        if ($stmt->rowCount() > 0) {
            $_SESSION['success'] = "Record successfully added.";
            header("Location:notification.php"); // Redirect to a success page
            exit();
        } else {
            $_SESSION['error'] = "Error: Unable to add record.";
            header("Location:notification.php");// Redirect back to the form page
            exit();
        }

    } catch (PDOException $e) {
        // Handle database errors
        $_SESSION['error'] = 'Database error: ' . $e->getMessage();
        header("Location:notification.php");
        exit();
    }

} else {
    echo "Error: Submission failed.";
}

