<?php
session_start();
include 'db.php'; // Database

// User must be logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
}

$user_id = $_SESSION['user_id'];
$photo = $_FILES['photo']['name'];
$title = $_POST['title'];
$area = $_POST['area'];
$rooms = $_POST['rooms'];
$price_per_night = $_POST['price_per_night'];

$target_dir = "uploads/";
$target_file = $target_dir . basename($photo);

if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
  // Add listing into db
  $query = "INSERT INTO listings (photo, title, area, rooms, price_per_night, user_id) VALUES ('$photo', '$title', '$area', '$rooms', '$price_per_night', '$user_id')";
  if (mysqli_query($conn, $query)) {
    header("Location: feed.php");
  } else {
    echo "Error: " . mysqli_error($conn);
  }
} else {
  echo "There was an error uploading your file.";
}
?>
