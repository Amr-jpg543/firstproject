<?php
require_once 'connection.php';
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);

        // Fetch user data if a matching user is found
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['login'] ="yes";
            $_SESSION['id'] = $user['id'];
            echo "Success" . $_SESSION['id'];

            if ($_SESSION['id'] == 1) {
            header("Location:../index.php");
            
            } else {// Redirect to a welcome page or dashboard
                header("Location: ../../index.php");
            }exit();
        } else {
            // Incorrect username or password
           echo $_SESSION['error'] = "Incorrect username or password.";
            //header("Location: ../../login.php");
            exit();
        }
    } catch (PDOException $e) {
        // Handle database errors and log the error for debugging purposes
        error_log("Database error: " . $e->getMessage());
    echo   $_SESSION['error'] = "An unexpected error occurred. Please try again later.";
     //   header("Location: ../../login.php");
        exit();
    }
} else {
    // If the form is not submitted
   echo $_SESSION['error'] = "Please submit the form.";
    //header("Location: ../../login.php");
    exit();
}
