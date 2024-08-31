<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "CREATE DATABASE IF NOT EXISTS Enrollment_System";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}
mysqli_close($conn);
?>

<?php 
 $servername = "localhost";
 $dbusername = "root";
 $dbpassword = ""; 
 $dbname = "Enrollment_System"; 

 $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }


 $sqlSdt = "CREATE TABLE IF NOT EXISTS Student (
     st_id INT PRIMARY KEY,
     st_name VARCHAR(255) NOT NULL,
     st_add VARCHAR(255) NOT NULL,
     crse VARCHAR(255) NOT NULL,
     st_year VARCHAR(255) NOT NULL
 )";


 if ($conn->query($sqlSdt) === TRUE) {
    echo "<script>alert('Table 'Student' created successfully');</script>";
} 
 else {
    echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
 }

 $sqlSub = "CREATE TABLE IF NOT EXISTS Subjects (
    sub_code INT PRIMARY KEY,
    sub_des VARCHAR(255) NOT NULL,
    sub_sched VARCHAR(255) NOT NULL,
    sub_teach VARCHAR(255) NOT NULL,
    sub_unit INT
)";

if ($conn->query($sqlSub) === TRUE) {
    echo "<script>alert('Table 'Subject' created successfully');</script>";
} 
 else {
    echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
 }
 $sqlenroll = "CREATE TABLE IF NOT EXISTS Enrolled (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(50),
    subjects_enrolled TEXT,
    tuition DECIMAL(10, 2) DEFAULT 0.00
)";

if ($conn->query($sqlenroll) === TRUE) {
    echo "<script>alert('Table 'Enrolled' created successfully');</script>";
} 
 else {
    echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
 }

 

 $conn->close();


?>