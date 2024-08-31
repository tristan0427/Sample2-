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
    <title>Assessment</title>
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

        .form-group .subs {
            display: block;
            margin-left: 40px;
            font-weight: bold;
        }

        .form-group .total {
            display: block;
            margin-top: 20px;
            margin-left: 60%;
            font-weight: bold;
        }

        .form-group .amount {
            margin-left: 15px;
            text-decoration: underline;
        }

        .form-group input {
            margin-left: 20px;
            width: 50%;
            padding: 8px;
            color: black;
            border: 2px solid black;
            border-radius: 4px;
        }

        .form-group select {
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
            justify-content: start;
            gap: 50px;
        }

        .Men {
            width: 100%;
            display: flex;
            justify-content: end;
            gap: 50px;
        }

        .form-group .label-flex {
            display: flex;
            width: 100%;
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
            margin-top: 30px;
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
            margin-top: 30px;
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


        <form method="post" id="enrollmentForm" >
            <div class="forms">
                <div class="form-group">
                    <label for="id">Student Name:</label>
                    <select name="stID" id="stID">
                        <?php

                        $selectedStudentName = isset($_POST['stID']) ? $_POST['stID'] : '';

                        $sql = "SELECT st_name FROM Student";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                                $selected = ($row["st_name"] == $selectedStudentName) ? 'selected' : '';
                                echo "<option value='" . $row["st_name"] . "' $selected>" . $row["st_name"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No Subjects found</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="course">Subject Code:</label>
                    <div class="label-flex">
                        <select name="code" id="code">
                            <?php
                            $sql = "SELECT sub_code, sub_des FROM Subjects";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["sub_code"] . "'>" . $row["sub_code"] . " - " . $row["sub_des"] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No Subjects found</option>";
                            }
                            ?>
                        </select>
                        <span><button class="cump" type="submit" name="add">ADD SUBJECT</button></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">List of Subjects Enrolled:</label>
                    <?php
                    $selected_subjects = isset($_POST['selected_subjects']) ? explode(',', $_POST['selected_subjects']) : [];

                    if (isset($_POST['add'])) {
                        $selectedCode = $_POST['code'];

                        if (!in_array($selectedCode, $selected_subjects)) {
                            $selected_subjects[] = $selectedCode;
                        } else {
                            echo "<script>alert('Already Added.');</script>";
                        }
                    }
                    $selected_subjects_string = implode(',', $selected_subjects);
                    echo "<input type='hidden' name='selected_subjects' value='" . htmlspecialchars($selected_subjects_string) . "'>";

                    $counter = 1;
                    $totalTuition = 0;
                    foreach ($selected_subjects as $sub_code) {
                        $sql = "SELECT sub_des, sub_unit FROM Subjects WHERE sub_code = '$sub_code'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $des = $row["sub_des"];
                                echo "<label class='subs' for='name'>Subject " . $counter . ": " . $row["sub_des"] . "</label><br>";
                                $totalTuition += $row["sub_unit"] * 200;
                                $counter++;
                            }
                        }
                    }
                    echo "<label class='total' for='tuition' >Total Tuition: <span class='amount' name='tuition'>" . $totalTuition . "</span></label>";
                    ?>
                </div>
            </div>
            <div class="buttons">
                <button class="btn" type="submit" id="enroll" name="enroll">ENROLL</button>
                <button class="btn" type="button" id="cancelButton" name="can">CANCEL</button>
                <div class="Men">
                    <button class="btn" onclick="window.location.href = 'Menu.html';" type="button">BACK</button>
                    <button class="srch" type="submit" name="print" onclick="setFormAction('receipt.php')">PRINT</button>
                </div>
            </div>
        </form>


    </div>

    <?php
    if (isset($_POST['enroll'])) {
        $studentname = $_POST['stID'];
        $selectedCode = $_POST['code'];

        $selected_subject_descriptions = [];
        foreach ($selected_subjects as $sub_code) {
            $sql_des = "SELECT sub_des FROM Subjects WHERE sub_code = '$sub_code'";
            $result_des = $conn->query($sql_des);

            if ($result_des->num_rows > 0) {
                while ($row_des = $result_des->fetch_assoc()) {
                    $selected_subject_descriptions[] = $row_des["sub_des"];
                }
            }
        }


        $subject_descriptions_string = implode(', ', $selected_subject_descriptions);


        $sql_enroll = "INSERT INTO Enrolled (student_name, subjects_enrolled, tuition)
                   VALUES ('$studentname', '$subject_descriptions_string', $totalTuition)";

        if ($conn->query($sql_enroll) === TRUE) {
            echo "<script>alert('Enrollment successful!');</script>";
        } else {
            echo "Error: " . $sql_enroll . "<br>" . $conn->error;
        }
    }

    ?>

    <script>
        function setFormAction(action) {
            document.getElementById('enrollmentForm').action = action;
        }
    </script>

    <script>
        document.getElementById("cancelButton").addEventListener("click", function() {
            alert('Canceled');
            window.location.href = 'Assessment.php';
        });
    </script>





</body>

</html>