<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $conn = new mysqli('localhost', 'root', '', 'sqlAdmn');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_POST['id'];

    $sql = "DELETE FROM data_insert WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record deleted successfully');</script>";
        echo "<script>window.location.href = 'edit.html';</script>";
    } else {
        echo "<script>alert('Error deleting record: ' . $conn->error');</script>";
        echo "<script>window.location.href = 'edit.html';</script>";
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
