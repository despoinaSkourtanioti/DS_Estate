<?php
include 'db.php'; // Database

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email = $_POST['email'];

// Email and username must be unique
$sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header('Location: login.php?error=invalid_credentials2'); // Redirect back to feed with message
    exit();
} else {
    // Add to database
    $sql = "INSERT INTO users (first_name, last_name, username, password, email) VALUES ('$first_name', '$last_name', '$username', '$password', '$email')";
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
