<?php
require 'db.php'; // Database

header('json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['listing_id'], $input['check_in'], $input['check_out'])) {
        $listing_id = $input['listing_id'];
        $check_in = $input['check_in'];
        $check_out = $input['check_out'];

        // Booking the listing means it doesn't coincide with other booked dates 
        $query = $conn->prepare("SELECT COUNT(*) FROM reservations WHERE listing_id = ? AND (check_in <= ? AND check_out >= ?)");
        $query->bind_param("iss", $listing_id, $check_out, $check_in);
        $query->execute();
        $query->bind_result($count);
        $query->fetch();
        $query->close();

        // Output for book.php
        if ($count > 0) {
            echo json_encode(['available' => false]);
        } else {
            echo json_encode(['available' => true]);
        }
    } else {
        echo json_encode(['error' => 'Invalid input']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
