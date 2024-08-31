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
<?php
if (isset($_POST['search'])) {
    $subCode = $_POST['code'];
    $sql = "SELECT * FROM subjects WHERE sub_code = '$subCode'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $descrip = $row['sub_des'];
        $sched = $row['sub_sched'];
        $teacher = $row['sub_teach'];
        $unit = $row['sub_unit'];
    } else {
        echo "<script>alert('No results found for Subject Code: $subCode');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject</title>
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


        <form method="post">
            <div class="forms">
                <div class="form-group">
                    <label for="id">Subject Code:</label>
                    <input type="text" id="code" name="code" value="<?php echo isset($subCode) ? $subCode : ''; ?>" required>
                    <button class="srch" type="submit" name="search">SEARCH</button>
                </div>


                <div class="form-group">
                    <label for="name">Subject Description:</label>
                    <input type="text" id="des" name="descrip" value="<?php echo isset($descrip) ? $descrip : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="add">Schedule:</label>
                    <input type="text" id="sched" name="schedule" value="<?php echo isset($sched) ? $sched : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="course">Teacher:</label>
                    <div class="label-flex">
                        <input type="text" id="teach" name="teacher" value="<?php echo isset($teacher) ? $teacher : ''; ?>"><span> <button class="cump" type="submit" name="add">ADD</button></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="year">Units:</label>
                    <div class="label-flex">
                        <input type="text" id="unit" name="units" value="<?php echo isset($unit) ? $unit : ''; ?>"><span> <button class="cump" type="submit" name="edit">EDIT</button></span>
                    </div>
                </div>
            </div>
            <div class="buttons">
                <button class="btn" type="button" id="cancelButton" name="can">CANCEL</button>
                <div class="Men">
                    <button class="btn" onclick="window.location.href = 'Menu.html';" type="button">BACK</button>
                    <button class="btn" type="submit" name="delete">DELETE</button>
                </div>
            </div>


        </form>


    </div>


    <?php
    if (isset($_POST['add'])) {

        $isEmpty = false;
        if (empty($_POST['code']) || empty($_POST['descrip']) || empty($_POST['schedule']) || empty($_POST['teacher']) || empty($_POST['units'])) {

            $isEmpty = true;
        }
        if (!$isEmpty) {
            $subCode = $_POST['code'];
            $descrip = $_POST['descrip'];
            $sched = $_POST['schedule'];
            $teacher = $_POST['teacher'];
            $unit = $_POST['units'];

            $dupChecker = "SELECT * FROM Subjects WHERE sub_code = '$subCode'";
            $result = $conn->query($dupChecker);

            if ($result->num_rows > 0) {
                echo "<script>alert('A record with this Subject Code already exists.');</script>";
                echo "<script>window.location.href = 'Subject.php';</script>";
            } else {
                $sql = "INSERT INTO Subjects (sub_code, sub_des, sub_sched, sub_teach, sub_unit) VALUES ('$subCode', '$descrip', '$sched', '$teacher', '$unit' )";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('New subject created successfully.');</script>";
                    echo "<script>window.location.href = 'Subject.php';</script>";
                } else {
                    echo "<script>alert('Error: " . $sql . "<br>');</script>";
                }
            }
        } else {
            echo "<script>alert('Please fill in all fields.');</script>";
            echo "<script>window.location.href = 'Subject.php';</script>";
        }
    }


    ?>


    <?php
    if (isset($_POST['edit'])) {
        $isEmpty = false;
        if (empty($_POST['code']) || empty($_POST['descrip']) || empty($_POST['schedule']) || empty($_POST['teacher']) || empty($_POST['units'])) {

            $isEmpty = true;
        }
        if (!$isEmpty) {
            $subCode = $_POST['code'];
            $descrip = $_POST['descrip'];
            $sched = $_POST['schedule'];
            $teacher = $_POST['teacher'];
            $unit = $_POST['units'];


            $sql = "UPDATE Subjects SET sub_des = '$descrip', sub_sched = '$sched', sub_teach = '$teacher', sub_unit = '$unit' WHERE sub_code = '$subCode'";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Subject record updated successfully');</script>";
                echo "<script> window.location.href = 'Subject.php';</script>";
            } else {
                echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Please fill in all fields.');</script>";
            echo "<script>window.location.href = 'Subject.php';</script>";
        }
    }


    ?>

    <?php
    if (isset($_POST['delete'])) {

        $subCode = $_POST['code'];


        $sql = "DELETE FROM Subjects WHERE sub_code = '$subCode'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Subject record deleted successfully');</script>";
            echo "<script> window.location.href = 'Subject.php';</script>";
        } else {
            echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
        }
    }

    $conn->close();
    ?>




    <script>
        document.getElementById("cancelButton").addEventListener("click", function() {
            alert('Canceled');
            window.location.href = 'Subject.php';
        });
    </script>




</body>

</html>