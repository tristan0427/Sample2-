<?php
 $dbhost= 'localhost'; 
$dbuser= 'root'; 
$dbpass= ''; 
$dbname= "sqlAdmn";
 $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname); 
if ($conn->connect_errno) {
 printf("Connection failed: %s\n", $mysqli->connect_error);
 exit();}

 $result = mysqli_query($conn,"SELECT* FROM data_insert");
 if (mysqli_num_rows($result) > 0) {
 echo "<table border='2' cellspacing='2' cellpadding='2'>";
 echo "<tr>";
 echo "<td>" . 'ID' . "</td>";
 echo "<td>" . 'FIRST NAME' . "</td>";
 echo "<td>" . 'LAST NAME' . "</td>";
 echo "<td>" . 'EMAIL' . "</td>";
 echo "</tr>";
 while($row = mysqli_fetch_array($result)) {
    ?>
    <tr>
    <td><?php echo $row["id"]; ?></td>
    <td><?php echo $row["firstname"]; ?></td>
    <td><?php echo $row["lastname"]; ?></td>
    <td><?php echo $row["email"]; ?></td>
    </tr>
    <?php
    }
    echo "</table>"; }
    else{
    echo "No result found"; } 
    
    ?>