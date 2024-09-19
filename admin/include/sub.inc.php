<?php
// require_once 'include/connection.php'; // Ensure this file sets up a PDO connection and assigns it to $con

// session_start(); // Start the session if you need to use session variables

// if (isset($_POST['call_id'])) {
//     // Sanitize and validate the input to prevent XSS and other issues
//     $call_id = htmlspecialchars(trim($_POST["call_id"]));

//     // Check if the provided ID is a valid integer
//     if (!is_numeric($call_id)) {
//         echo '<option value="">Invalid category ID</option>';
//         exit();
//     }

//     try {
//         // Prepare the SQL statement with a placeholder for the ID
//         $stmt = $con->prepare("SELECT id, sub_cat_name FROM sub_category WHERE category_id = :category_id");

//         // Bind the parameter to the prepared statement
//         $stmt->bindValue(':category_id', (int)$call_id, PDO::PARAM_INT);

//         // Execute the prepared statement
//         $stmt->execute();

//         // Fetch all results as an associative array
//         $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

//         // Check if any results were returned
//         if (empty($results)) {
//             echo '<option value="">Null</option>';
//         } else {
//             // Loop through the results and output them safely
//             foreach ($results as $row) {
//                 echo "<option value=\"" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "\">" . htmlspecialchars($row['sub_cat_name'], ENT_QUOTES, 'UTF-8') . "</option>";
//             }
//         }
//     } catch (PDOException $e) {
//         // Log the error message to a file or notify the developer
//         error_log("Database error: " . $e->getMessage());
//         echo '<option value="">Error loading data</option>';
//     }
// } else {
//     echo "Invalid request.";
// }
