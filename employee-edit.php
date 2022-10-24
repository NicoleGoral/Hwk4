<?php require_once("header.php"); ?>
<h1>Edit Employee</h1>
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

$sql = "SELECT instructorID, instructorName, courseID, sectionID FROM Instructor where instructorID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['iID']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    ?>
<form method="post" action="instructor-edit-save.php">
  <div class="mb-3">
    <label for="instructorName" class="form-label">Name</label>
    <input type="text" class="form-control" id="employeeName" aria-describedby="nameHelp" name="iName">
    <div id="nameHelp" class="form-text">Enter the instructor's name</div>
     <label for="instructorID" class="form-label">instructor ID</label>
    <input type="text" class="form-control" id="instructorID" aria-describedby="nameHelp" name="iID">
    <div id="nameHelp" class="form-text">Enter the instructor's ID</div>
     <label for="courseID" class="form-label">Course ID</label>
    <input type="text" class="form-control" id="courseID" aria-describedby="nameHelp" name="cID">
    <div id="nameHelp" class="form-text">Enter the instructor's course ID</div>
    <label for="sectionID" class="form-label">Section ID</label>
    <input type="text" class="form-control" id="sectionID" aria-describedby="nameHelp" name="sID">
    <div id="nameHelp" class="form-text">Enter the instructor's section ID</div>
  </div>
  <input type="hidden" name="iID" value="<?=$row['instructorID']?>">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
