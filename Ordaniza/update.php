<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $conn = new mysqli('localhost', 'root', '', 'sqlAdmn');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];


    $sql = "UPDATE data_insert SET firstname = '$firstname', lastname = '$lastname', email = '$email' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record updated successfully');</script>";
        echo "<script>window.location.href = 'edit.html';</script>";
    } else {
        echo "<script>alert('Error updating record: ' . $conn->error');</script>";
        echo "<script>window.location.href = 'edit.html';</script>";
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
