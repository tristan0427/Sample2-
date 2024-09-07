<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <label for="user_type">User Type:</label><br>
        <select id="user_type" name="user_type">
            <option value="user1">User 1</option>
            <option value="user2">User 2</option>
            <option value="user3">User 3</option>
        </select><br>
        <input type="submit" value="Login">
    </form>
    <?php
    // Database connection
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Fetching values from form
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user_type = $_POST['user_type'];

        // SQL injection prevention
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

        // Query to check user credentials
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password' AND user_type='$user_type'";
        $result = $conn->query($query);

        if ($result->num_rows == 1) {
            // Valid credentials, redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            // Invalid credentials, show error message
            echo "<p>Invalid username, password, or user type. Please try again.</p>";
        }
    }

    $conn->close();
    ?>
</body>
</html>
