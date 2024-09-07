<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = ""; 
$dbname = "sqlAdmn"; 


$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {


  $isEmpty = false;
  if (empty($_POST['fName']) || empty($_POST['lName']) || empty($_POST['email'])) {

    $isEmpty = true;
  }

  if (!$isEmpty) {
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];

    $sql = "INSERT INTO data_insert (firstname, lastname, email) VALUES ('$firstName', '$lastName', '$email')";

    if ($conn->query($sql) === TRUE) {
      echo "<script>alert('New record created successfully.');</script>";
      echo "<script>window.location.href = 'insert.html';</script>";
    } else {
      echo "<script>alert('Error: " . $sql . "<br>');</script>";
    }
  } else {
    echo "<script>alert('Please fill in all fields.');</script>";
    echo "<script>window.location.href = 'insert.html';</script>";
  }
}


$conn->close();
?>
