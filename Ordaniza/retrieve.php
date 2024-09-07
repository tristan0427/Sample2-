<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $conn = new mysqli('localhost', 'root', '', 'sqlAdmn');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_POST['id'];
    $sql = "SELECT * FROM data_insert WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
 
    echo'<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Data</title>
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
                top: 40%;
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
            input{
                display: flex;
             }

            a{
                color:white;
            }
                    
        </style>
    </head>
    <body>
      
    <div class="container">
            <div class="content">
                <h2>Edit User</h2>
            <div class="formIn">
            <form action="delete.php" method="POST">
                    <input type="hidden" name="id" value="' . $id . '">
                    <label for="firstname">Firstname:</label>
                    <input type="text" id="firstname" name="firstname" value="' . $firstname . '"><br>
                    <label for="lastname">Lastname:</label>
                    <input type="text" id="lastname" name="lastname" value="' . $lastname . '"><br>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="' . $email . '"><br>
                    <button type="submit">Delete</button>
                </form>
                <a href="mainmenu.php" class="back-button">Back to Main Menu</a>
        </div>
        
                </div>
            </div>
        </body>
        </html>
        ';
    } else {
        echo "<script>alert('No data found for ID: $id');</script>";
        echo "<script>window.location.href = 'delete.html';</script>";
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
  