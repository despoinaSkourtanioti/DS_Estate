<?php
session_start();
require 'db.php'; // Database

// Listings
$sql = "SELECT * FROM listings";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Feed</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <main>
    <div class="container2">
    <?php
    // Check if there is a message in the URL
    if (isset($_GET['success']) && $_GET['success'] == 'book_complete') {
        echo '<script>alert("Booking was successful!");</script>';
    }
    ?>
        <h1>Listings</h1>
        </br>
        <div class="listings">
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imagePath = 'uploads/' . htmlspecialchars($row['photo']);?>
                    <div class="listing">
                        <img src="<?php echo $imagePath; ?>" alt="Listing Image">
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p>Area: <?php echo htmlspecialchars($row['area']); ?></p>
                        <p>Rooms: <?php echo htmlspecialchars($row['rooms']); ?></p>
                        <p>Price per night: <?php echo htmlspecialchars($row['price_per_night']); ?> €</p>
                        <?php if (isset($_SESSION['user_id'])) { ?>
                            <!-- Only if the user is logged in -->
                            <a href="book.php?listing_id=<?php echo $row['id']; ?>" class="btn">Book Now</a> 
                        <?php } else { ?>
                            <!-- If it's a guest user -->
                            <p><a href="login.php">Login to book</a></p>
                        <?php } ?>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No listings available.</p>";
            }
            ?>
        </div>
    </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>


