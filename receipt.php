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
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: black;
            background-color: gray;
            margin: 0;
            padding: 0;
        }

        .container {
            position: relative;
            margin: 50px auto;
            width: 50%;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        .header {
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 40px;
        }

        .forms {
            position: relative;
            width: 100%;
            left: 40%;
            top: 80%;
            transform: translate(-50%, -0%);
            padding-left: 20%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .form-group label[for='subjects']  {
            margin-left: 8%;
        }


        .form-group input {
            margin-left: 20px;
            width: 50%;
            padding: 8px;
            color: black;
            border: 2px solid black;
            border-radius: 4px;
        }

        span {
            margin-left: 20px;
            font-weight: bold;
            text-decoration: underline;
        }


        .buttons {
            margin-top: 20%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 50px;
        }
        .buttons label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .Men {
            width: 100%;
            display: flex;
            justify-content: end;
            gap: 50px;
        }

        .form-group .label-flex {
            display: flex;
            width: 70%;
            justify-content: space-between;
            align-items: center;
        }

        .cump {
            text-align: center;
            width: 100%;
            padding: 10px 30px;
            border: none;
            background-color: blue;
            color: white;
            font-weight: 600;
            border-radius: 4px;
            cursor: pointer;
            margin-left: auto;
        }

        .btn {
            display: block;
            width: 20%;
            padding: 10px;
            border: none;
            background-color: blue;
            color: white;
            font-weight: 600;
            border-radius: 4px;
            cursor: pointer;
        }

        .srch {
            text-align: center;
            width: 15%;
            padding: 8px 5px 8px 5px;
            border: none;
            background-color: blue;
            color: white;
            font-weight: 600;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>



<body>
    <div class="container">
        <div class="header">
            <h1>ENROLLMENT INFORMATION SYSTEM</h1>
            <h3>OFFICIAL RECEIPT</h3>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $studentID = $_POST['stID'];
            $selected_subjects = isset($_POST['selected_subjects']) ? explode(',', $_POST['selected_subjects']) : [];

            $sql = "SELECT st_id, st_name, crse, st_year FROM Student WHERE st_name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $studentID);
            $stmt->execute();
            $result = $stmt->get_result();
            $student = $result->fetch_assoc();

        ?>
            <form method="post">
                <div class="forms">
                    <div class="form-group">
                        <label for="id">Student ID:<span><?php echo htmlspecialchars($student['st_id']); ?></span></label>
                    </div>


                    <div class="form-group">
                        <label for="name">Student Name:<span><?php echo htmlspecialchars($student['st_name']); ?></span></label>
                    </div>

                    <div class="form-group">
                        <div class="label-flex">
                            <label for="course">Course:<span><?php echo htmlspecialchars($student['crse']); ?></span></label>
                            <label for="year">Year:<span><?php echo htmlspecialchars($student['st_year']); ?></span></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="list">Subject Enrolled: </label>
                        <?php

                        $counter = 1;
                        $totalTuition = 0;
                        foreach ($selected_subjects as $sub_code) {
                            $sql = "SELECT sub_des, sub_unit FROM Subjects WHERE sub_code = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $sub_code);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<label for='subjects'>Subject " . $counter . ": <span>" . htmlspecialchars($row["sub_des"]) ."</span></label><br>";
                                    $totalTuition += $row["sub_unit"] * 200;
                                    $counter++;
                                }
                            }
                        }


                        ?>
                    </div>
                </div>
                <div class="buttons">
                    <label for='tuition'>Total Assessment:<span><?php echo htmlspecialchars($totalTuition); ?></span></label>
                    <button class="btn" onclick="window.location.href = 'Menu.html';" type="button">BACK</button>
                </div>
            </form>
        <?php


          }

        ?>

    </div>





    <script>
        document.getElementById("cancelButton").addEventListener("click", function() {
            alert('Canceled');
            window.location.href = 'Student.php';
        });
    </script>




</body>

</html>