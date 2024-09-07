<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "CREATE DATABASE IF NOT EXISTS sqlAdmn";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}
mysqli_close($conn);
?>


<?php
$username = 'clark2001';
$password = 12345;

if ($_POST["Username"] == $username && $_POST["password"] == $password && isset($_POST["sub"])) {
    
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = ""; 
    $dbname = "sqlAdmn"; 

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "CREATE TABLE IF NOT EXISTS data_insert (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(50)
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table 'data_insert' created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $conn->close();

    echo "<script>window.location.href = 'mainmenu.php';</script>";
    exit();
} else if ($_POST["Username"] != $username) {
    echo "<script>alert('Incorrect username. Please try again.');</script>";
    echo "<script>window.location.href = 'login.html';</script>";
} else if ($_POST["password"] != $password) {
    echo "<script>alert('Incorrect password. Please try again.');</script>";
    echo "<script>window.location.href = 'login.html';</script>";
}
?>
