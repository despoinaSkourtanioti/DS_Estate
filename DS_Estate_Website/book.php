<?php
session_start();

require 'db.php'; // Database

if (isset($_SESSION['user_id'])){

  if (!isset($_GET['listing_id'])) {
    echo "Invalid listing ID";
    exit();
}

// Find the specific listing in the db
$listing_id = $_GET['listing_id'];

$query = $conn->prepare("SELECT * FROM listings WHERE id =?");
$query->bind_param("i", $listing_id);
$query->execute();
$result = $query->get_result();
$listing = $result->fetch_assoc();

if (!$listing) {
    echo "Listing not found";
    exit();
}
  ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <?php include 'navbar.php';?>
  <div class="container2">
        <div class="listing-info-container">
            <div class="listing-image">
                <?php $imagePath = 'uploads/' . htmlspecialchars($listing['photo']);?>
                <img src="<?php echo $imagePath; ?>" alt="Listing Image">
            </div>
            <div class="listing-details">
                <h2><?php echo htmlspecialchars($listing['title']); ?></h2>
                <p>Area: <?php echo htmlspecialchars($listing['area']); ?></p>
                <p>Rooms: <?php echo htmlspecialchars($listing['rooms']); ?></p>
                <p>Price per night: <?php echo htmlspecialchars($listing['price_per_night']); ?> €</p>
            </div>
        </div>

        <div class="booking-form-container">
            <form id="booking-form" action="book_process.php"  method="POST">
                <input type="hidden" name="listing_id" value="<?php echo $listing['id']; ?>">
                <input type="hidden" name="listing_price" value="<?php echo $listing['price_per_night']; ?>">
                
                <!-- Step 1: Check-in and Check-out Dates -->
                <div id="step1" class="step" >
                    <h2>Step 1: Select Dates</h2>
                    </br>
                    <label for="check_in">Check In:</label>
                    <input type="date" id="check_in" name="check_in" required>
                    <label for="check_out">Check Out:</label>
                    <input type="date" id="check_out" name="check_out" required>
                    <button type="button" id="next-step" onclick="check_availability()" ">Next</button>
                </div>

                <!-- Step 2: User Info -->
                <div id="step2" class="step" style="display:none;">
                    <h2>Step 2: Your Information</h2>
                    </br>
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" value="<?php echo ($_SESSION['user_first_name']); ?>" required>
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" value="<?php echo htmlspecialchars($_SESSION['user_last_name']); ?>" required>
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" required>
                    <button type="submit">Book Now</button>
                </div>
            </form>
        <!-- Final Price -->
        <div id="final_price"></div>
        </div>
    </div>
  <?php include 'footer.php'; ?>  
  <script>
        const listing_price = <?= $listing['price_per_night'] ?>;
        let discount = 0;

        function check_availability() {
            const check_in = document.getElementById('check_in').value;
            const check_out = document.getElementById('check_out').value;

            // Check in/out dates must exist
            if (check_in && check_out) {
                const start_date = new Date(check_in);
                const end_date = new Date(check_out);
                const current_date = new Date();

                // Check in/out dates shouldn't be old
                if (start_date <= current_date || end_date <= current_date) {
                    alert('Check-in and check-out dates must be future dates.');
                    return;
                }
                
                const nights = (end_date - start_date) / (1000 * 60 * 60 * 24);

                if (nights > 0) {
                    // Availability is checked through a php file
                    fetch('check_availability.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ 
                            listing_id: <?= $listing_id ?>, 
                            check_in: check_in, 
                            check_out: check_out 
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.available) {
                            discount = Math.random() * (30 - 10) + 10;
                            const initial_price = listing_price * nights;
                            const final_price = initial_price - (initial_price * (discount / 100));

                            // Final price
                            document.getElementById('final_price').innerText = `Final Price: ${final_price.toFixed(2)}€ (Discount: ${discount.toFixed(0)}%)`;

                            // Don't display
                            document.getElementById('step1').style.display = 'none';
                            document.getElementById('next-step').style.display = 'none';
                            // Display
                            document.getElementById('step2').style.display = 'block';
                        } else {
                            alert('This listing is not available.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                } else {
                    alert('Check in date should be earlier than check out date.');
                }
            } else {
                alert('Choose check in and check out dates.');
            }
        }
    </script>
</body>
</html>
<?php }else{
  header("Location: login.php");
 }
?>
