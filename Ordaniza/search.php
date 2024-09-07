<?php
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $conn = new mysqli('localhost', 'root', '', 'sqladmn');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_POST['id'];
    $sql = "SELECT * FROM data_insert WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>User Details</title>
                <style>
                    *{
                        font-family: Arial, Helvetica, sans-serif;
                        color: black;
                    }
                    .container{
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        height: 100vh;
                    }
                    .content{
                        border: 1px solid black;
                        width: 40%;
                        height: 80%;
                        background-color: cadetblue;
                    }
                    .formIn{
                        position: absolute;
                        top: 30%;
                        left: 50%;
                        transform: translate(-50% , -50%);
                    }
                    h2{
                        position: relative;
                        left: 38%;
                    }
                    .user-details {
                        margin: 20px;
                        padding: 10px;
                    }

                    a{
                        color:white;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="content">
                        <h2>User Details</h2>
                        <div class="formIn">
                            <div class="user-details">
                                <p>ID: ' . $row['id'] . '</p>
                                <p>Firstname: ' . $row['firstname'] . '</p>
                                <p>Lastname: ' . $row['lastname'] . '</p>
                                <p>Email: ' . $row['email'] . '</p>
                                <a href="mainmenu.php" class="back-button">Back to Main Menu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
            </html>';
        }
    } else {
        echo "No user found with ID: $id";
    }

    // Close connection
    $conn->close();
} else {
    echo "Invalid ID";
}
?>
