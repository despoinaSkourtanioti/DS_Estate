-- Πίνακας users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    email VARCHAR(100) UNIQUE
);

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `email`) VALUES
(1, 'despoina', 'skourtanioti', 'despoina', '$2y$10$lJTL3AlyRNUgwbsrYQRmKuTnT1y6Qd5Sb8mrHRQ2483sx8t77TECG', 'despoina@dsestate.com');

-- Πίνακας listings
CREATE TABLE listings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    photo VARCHAR(255),
    title VARCHAR(100),
    area VARCHAR(100),
    rooms INT,
    price_per_night INT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO `listings` (`id`, `photo`, `title`, `area`, `rooms`, `price_per_night`, `user_id`) VALUES
(1, 'stock_photo.jpg', 'apartmentOne', 'areaOne', '1', '100', '1'),
(2, 'stock_photo2.jpg', 'apartmentTwo', 'areaTwo', '2', '200', '1'),
(3, 'stock_photo3.png', 'apartmentThree', 'areaThree', '3', '300', '1');

-- Πίνακας reservations
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    listing_id INT,
    user_id INT,
    check_in DATE,
    check_out DATE,
    first_name VARCHAR(40),
    last_name VARCHAR(40),
    email VARCHAR(40),
    FOREIGN KEY (listing_id) REFERENCES listings(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

