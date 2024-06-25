<?php
session_start();
include 'db.php'; // Database

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
}

$user_id = $_SESSION['user_id'];
$listing_id = $_POST['listing_id'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];

// Add reservation into db
$query = "INSERT INTO reservations (listing_id, user_id, check_in, check_out, first_name, last_name, email) VALUES ('$listing_id', '$user_id', '$check_in', '$check_out', '$first_name', '$last_name', '$email')";
if (mysqli_query($conn, $query)) {
  
  header('Location: feed.php?success=book_complete'); // Redirect back to feed with message
  exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
