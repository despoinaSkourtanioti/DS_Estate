<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <?php include 'navbar.php'; ?>
  <div class="container">  
        <div class="login-register-container">
            <form id="login-form" action="login_process.php" method="POST">
                <h2>Login</h2>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <p id="p">Don't have an account? <a id="a" href="#" onclick="showRegisterForm()">Register here</a></p>
            <form id="register-form" method="post" action="register.php" style="display:none;">              
                <h2>Register</h2>
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" pattern="[A-Za-z]+" placeholder="Only Characters" required>
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" pattern="[A-Za-z]+" placeholder="Only Characters" required>
                <label for="username">Username:</label>
                <input type="text" id="reg_username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="reg_password" name="password" pattern="(?=.*\d)[A-Za-z\d]{4,10}" placeholder="At least 1 number and 4-10 characters"required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <button type="submit">Register</button>
            </form>
            <?php
            // Check if there is an error message in the URL
            if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials') {
              echo '<script>alert("Invalid email or password. Please try again.");</script>';
            }
            if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials2') {
              echo '<script>alert("Email or username already exists in the database.");</script>';
            }
            ?>
        </div>
  </div>
  <?php include 'footer.php'; ?>
  <script>
  function showRegisterForm() {
    // don't display
    document.getElementById('login-form').style.display = 'none';
    document.getElementById('p').style.display = 'none';
    document.getElementById('a').style.display = 'none';
    // display
    document.getElementById('register-form').style.display = 'block';
  }
</script>
</body>
</html>