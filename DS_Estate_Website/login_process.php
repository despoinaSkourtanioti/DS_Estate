<?php
session_start();
include 'db.php'; // Database

$username = $_POST['username'];
$password = $_POST['password'];

// Find user in the db
$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Create session
if ($user && password_verify($password, $user['password'])) {
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['user_first_name'] = $user['first_name'];
  $_SESSION['user_last_name'] = $user['last_name'];
  $_SESSION['user_email'] = $user['email'];
  
  header("Location: feed.php");
} else {
  header('Location: login.php?error=invalid_credentials'); // Redirect back to login with an error
  exit();
}
?>
