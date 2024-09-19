<?php
require_once 'connection.php'; // Ensure this file sets up a PDO connection and assigns it to $con

session_start();

if (isset($_POST['submit'])) {
    // Collect and sanitize input data
    $name = htmlspecialchars(trim($_POST['name']));
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $address = htmlspecialchars(trim($_POST['address']));
    $city = htmlspecialchars(trim($_POST['city']));
    $country = htmlspecialchars(trim($_POST['country']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Check if any required fields are missing
    if (empty($username) || empty($email) || empty($phone) || empty($password) || empty($name) || empty($address) || empty($city) || empty($country)) {
        $_SESSION['error'] = 'Please fill in all required fields.';
        header("location: register.php"); // Redirect to the registration page
        exit();
    }

    // Hash the password using a more secure hashing algorithm
    $pwd = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Prepare SQL statement with named placeholders
        $stmt = $con->prepare("INSERT INTO users (username, email, phone, password, name, address, city, country) VALUES (:zuser, :zemail, :zphone, :zpwd, :zname, :zaddress, :zcity, :zcountry)");

        // Execute the prepared statement with an array of values
        $stmt->execute([
            'zuser' => $username,
            'zemail' => $email,
            'zphone' => $phone,
            'zpwd' => $pwd,
            'zname' => $name,
            'zaddress' => $address,
            'zcity' => $city,
            'zcountry' => $country
        ]);

        // Check if any rows were affected (i.e., if the user was successfully added)
        if ($stmt->rowCount() > 0) {
            $_SESSION['success'] = "User registered successfully.";
            header("location:../../login.php"); // Redirect to the login page
            exit();
        } else {
            $_SESSION['error'] = 'Error occurred during registration.';
        }
    } catch (PDOException $e) {
        // Handle database errors gracefully
        $_SESSION['error'] = 'Database error: ' . $e->getMessage();
        header("location: register.php");
        exit();
    }
} else {
    echo "Submission failed.";
}
