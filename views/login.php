<?php
session_start();
require_once '../includes/db.php'; // Include database connection file

// Initialize an array to hold error messages
$errors = array();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    // Retrieve and sanitize user input
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare the SQL statement to fetch user details
    $stmt = $conn->prepare("SELECT * FROM signup WHERE email=?");
    if ($stmt === false) {
        // Error handling if the statement preparation fails
        die("Error preparing the statement: " . $conn->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user with the provided email exists
    if ($result->num_rows == 1) {
        // Fetch user data from the database
        $user = $result->fetch_assoc();
        
        // Check if the provided password matches the stored password
        if ($password == $user['password']) { // In a real application, use hashed passwords
            $_SESSION['email'] = $user['email']; // Store the user's email in the session
            header("Location: homepage.php"); // Redirect to the homepage
            exit();
        } else {
            // If passwords do not match, set an error message
            $errors['login'] = "Incorrect email or password";
        }
    } else {
        // If no user is found with the provided email, set an error message
        $errors['login'] = "Incorrect email or password"; // Use the same error message
    }

    // Store error messages in the session for later use
    $_SESSION['errors'] = $errors;
    
    // Redirect back to the login page
    header("Location: index.php");
    exit();
}
?>
