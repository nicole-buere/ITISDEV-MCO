<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "dbcityease");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$id = $_POST['id'];
$status = $_POST['status'];

// Validate and sanitize inputs
$id = $conn->real_escape_string($id);
$status = $conn->real_escape_string($status);

// Determine if we are updating a document request or a reported issue
// Assuming we have a hidden field in the form indicating the type (request or report)
$type = $_POST['type']; // Add this hidden field in your form in the main PHP file

// Update status based on type
if ($type == 'request') {
    $sql = "UPDATE request SET status='$status' WHERE requestid='$id'";
} elseif ($type == 'report') {
    $sql = "UPDATE report SET status='$status' WHERE reportid='$id'";
} else {
    die("Invalid type specified.");
}

if ($conn->query($sql) === TRUE) {
    // Redirect back to the admin homepage or wherever appropriate
    header("Location: admin-homepage.php");
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
