<?php
session_start();
require_once '../includes/db.php';

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare the SQL statement with error handling
    $stmt = $conn->prepare("SELECT * FROM signup WHERE email=?");
    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if ($password == $user['password']) { // Compare passwords directly
            $_SESSION['user_id'] = $user['id']; // Set session
            header("Location: homepage.php"); // Redirect to homepage
            exit();
        } else {
            $errors['login'] = "Incorrect email or password";
        }
    } else {
        $errors['login'] = "Incorrect email or password"; // Use the same error message
    }

    $_SESSION['errors'] = $errors; // Store errors in session
    header("Location: index.php"); // Redirect back to login page
    exit();
}
?>
