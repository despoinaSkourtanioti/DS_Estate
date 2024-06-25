<?php
session_start();

require 'db.php'; // Database

if (isset($_SESSION['user_id'])){
  ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <?php include 'navbar.php'; ?>
  <div class="container"> 
  <div class="create-listing">
    <form id="create-listing-form" method="post" action="create_listing_process.php" enctype="multipart/form-data">
      <label for="photo">Photo:</label>
      <input type="file" id="photo" name="photo" required>

      <label for="title">Title:</label>
      <input type="text" id="title" name="title" pattern="[A-Za-z]+" placeholder="Only Characters" required>
      <span id="title-error" class="error"></span>

      <label for="area">Area:</label>
      <input type="text" id="area" name="area" pattern="[A-Za-z]+" placeholder="Only Characters" required>
      <span id="area-error" class="error"></span>

      <label for="rooms">Rooms:</label>
      <input type="number" id="rooms" name="rooms" required>
      <span id="rooms-error" class="error"></span>

      <label for="price_per_night">Price per Night:</label>
      <input type="number" id="price_per_night" name="price_per_night" required>
      <span id="price_per_night-error" class="error"></span>

      <button type="submit">Create Listing</button>
    </form>
  </div>
</div>
  <?php include 'footer.php'; ?>
  <script src="scripts.js"></script>
</body>
</html>
<?php }else{
  header("Location: login.php");
 }
?>