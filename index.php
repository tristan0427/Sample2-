<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Enrollment_System";


$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            color: black;
            background-color: gray;
            margin: 0;
            padding: 0;
        }

        .container {
            position: absolute;
            top: 35%;
            left: 50%;
            width: 35%;
            height: 35%;
            transform: translate(-50%, -50%);
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 50px;
        }

        .header h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input {
            margin-left: 20px;
            width: 50%;
            padding: 8px;
            color: black;
            border: 2px solid black;
            border-radius: 4px;
        }

        .buttons {
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 50px;
        }

        .btn {
            display: block;
            width: 30%;
            padding: 10px;
            border: none;
            background-color: blue;
            color: white;
            font-weight: 600;
            border-radius: 4px;
            cursor: pointer;
        }

        ::placeholder {
            font-style: italic;
        }

        .btn:nth-child(2) {
            background-color: red;
        }

        .btn:nth-child(2):hover {
            background-color: #c10303;
        }

        .btn:not(:nth-child(2)):hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>ENROLLMENT INFORMATION SYSTEM</h1>
        </div>
        <form method="POST">
            <div class="form-group">
                <label for="username">USERNAME: </label>
                <input type="text" id="username" name="username" placeholder="Admin001" required>
            </div>
            <div class="form-group">
                <label for="password">PASSWORD: </label>
                <input type="password" id="password" name="password" placeholder="12345" required>
            </div>
            <div class="buttons">
                <button type="submit" name="sub" class="btn">LOGIN</button>
                <button type="button" id="cancelButton" name="can" class="btn">CANCEL</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById("cancelButton").addEventListener("click", function() {
            alert('Login Canceled');
            window.location.href = 'login.php';
        });
    </script>



    <?php
    if (isset($_POST['sub'])) {
        $username = 'Admin001';
        $password = 12345;

        if ($_POST["username"] == $username && $_POST["password"] == $password && isset($_POST["sub"])) {
            echo "<script>window.location.href = 'Menu.html';</script>";
            exit();
        } else if ($_POST["username"] != $username) {
            echo "<script>alert('Incorrect username. Please try again.');</script>";
            echo "<script>window.location.href = 'index.php';</script>";
        } else if ($_POST["password"] != $password) {
            echo "<script>alert('Incorrect password. Please try again.');</script>";
            echo "<script>window.location.href = 'index.php';</script>";
        }
    }
    ?>
</body>

</html>