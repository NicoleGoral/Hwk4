<?php require_once("header.php"); ?>
<h1>Instructors</h1>
<!doctype html>
<html lang="en">

  <table class="table table-striped">
  <thead>
    <tr>
      <th>Instructor ID</th>
      <th>Instructor Name</th>
      <th>Course ID</th>
      <th>Section ID</th>
    </tr>
  </thead>
  <tbody>
<?php
$servername = "localhost";
$username = "ngoralou_homework3";
$password = "Createou!";
$dbname = "ngoralou_homework3";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT instructorID, instructorName, courseID, sectionID FROM instructor";
$result = $conn->query($sql);
       
 if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {


        echo '<tr>              
                  <td scope="row">' . $row["instructorID"]. '</td>
                  <td>' . $row["instructorName"] .'</td>
                  <td>' . $row["courseID"] .'</td>
                  <td>' . $row["sectionID"] .'</td>
                  <td>
      <form method="post" action="instructorstudent.php">
        <input type="hidden" name="id" value="<?=$row["courseID"]?>" />
        <input type="submit" value="Students" />
      </form>
    </td>
                   <br>                
                </tr>';
    }
} else {
    echo "0 results";
} 
?>
       </tbody>    
      </table>
    </div>
</table>
