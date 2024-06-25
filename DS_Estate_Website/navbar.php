<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>DS Estate</title>
</head>
<link rel="stylesheet" type="text/css" href="styles.css">
<body>
    <header>
        <nav>
            <div class="logo">
                <a href="feed.php">DS Estate</a>
            </div>
            <div class="menu-icon" onclick="toggleMenu()">
                &#9776;
            </div>
            <ul class="nav-links" id="navLinks">
                <li><a href="feed.php">Feed</a></li>
                <?php if (isset($_SESSION['user_id'])) { ?>
                <li><a href="create_listing.php">Create Listing</a></li>
                <?php } else { ?>
                <li><a href="login.php">Create Listing</a></li>
                <?php } ?>
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <li><a href="logout.php" id="logoutLink">Logout</a></li>
                        <?php } else { ?>
                            <li><a href="login.php" id="loginLink">Login/Register</a></li>
                        <?php } ?>
            </ul>
        </nav>
    </header>
    <script>
        function toggleMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('show');
        }
    </script>
</body>
</html>
