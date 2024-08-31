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
    $stID    = $_POST['stID'];
    $sql = "SELECT * FROM student WHERE st_id = '$stID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stName = $row['st_name'];
        $address = $row['st_add'];
        $course = $row['crse'];
        $year = $row['st_year'];
    } else {
        echo "<script>alert('No results found for Student ID: $stID');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
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
                    <label for="id">Student ID:</label>
                    <input type="text" id="stID" name="stID" value="<?php echo isset($stID) ? $stID : ''; ?>" required>
                    <button class="srch" type="submit" name="search">SEARCH</button>
                </div>


                <div class="form-group">
                    <label for="name">Student Name:</label>
                    <input type="text" id="stName" name="stName" value="<?php echo isset($stName) ? $stName : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="add">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo isset($address) ? $address : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="course">Course:</label>
                    <div class="label-flex">
                        <input type="text" id="crs" name="crs" value="<?php echo isset($course) ? $course : ''; ?>"><span> <button class="cump" type="submit" name="add">ADD</button></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="year">Year:</label>
                    <div class="label-flex">
                        <input type="text" id="year" name="year" value="<?php echo isset($year) ? $year : ''; ?>"><span> <button class="cump" type="submit" name="edit">EDIT</button></span>
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
        if (empty($_POST['stID']) || empty($_POST['stName']) || empty($_POST['address']) || empty($_POST['crs']) || empty($_POST['year'])) {
            $isEmpty = true;
        }
        if (!$isEmpty) {
            $id = $_POST['stID'];
            $name = $_POST['stName'];
            $address = $_POST['address'];
            $course = $_POST['crs'];
            $year = $_POST['year'];

            $dupChecker = "SELECT * FROM Student WHERE st_id = '$id'";
            $result = $conn->query($dupChecker);

            if ($result->num_rows > 0) {
                echo "<script>alert('A record with this ID already exists.');</script>";
                echo "<script>window.location.href = 'Student.php';</script>";
            } else {

                $sql = "INSERT INTO Student (st_id, st_name, st_add, crse, st_year) VALUES ('$id', '$name', '$address', '$course', '$year')";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('New student added successfully.');</script>";
                    echo "<script>window.location.href = 'Student.php';</script>";
                } else {
                    echo "<script>alert('Error: " . $conn->error . "');</script>";
                }
            }
        } else {
            echo "<script>alert('Please fill in all fields.');</script>";
            echo "<script>window.location.href = 'Student.php';</script>";
        }
    }
    ?>



    <?php
    if (isset($_POST['edit'])) {
        $isEmpty = false;
        if (empty($_POST['stID']) || empty($_POST['stName']) || empty($_POST['address']) || empty($_POST['crs']) || empty($_POST['year'])) {

            $isEmpty = true;
        }

        if (!$isEmpty) {
            $id = $_POST['stID'];
            $name = $_POST['stName'];
            $address = $_POST['address'];
            $course = $_POST['crs'];
            $year = $_POST['year'];

            $sql = "UPDATE Student SET st_name = '$name', st_add = '$address', crse = '$course', st_year = '$year' WHERE st_id = '$id'";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Student record updated successfully');</script>";
                echo "<script> window.location.href = 'Student.php';</script>";
            } else {
                echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Please fill in all fields.');</script>";
            echo "<script>window.location.href = 'Student.php';</script>";
        }
    }


    ?>

    <?php
    if (isset($_POST['delete'])) {

        $id = $_POST['stID'];


        $sql = "DELETE FROM Student WHERE st_id = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Student record deleted successfully');</script>";
            echo "<script> window.location.href = 'Student.php';</script>";
        } else {
            echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
        }
    }

    $conn->close();
    ?>




    <script>
        document.getElementById("cancelButton").addEventListener("click", function() {
            alert('Canceled');
            window.location.href = 'Student.php';
        });
    </script>




</body>

</html>