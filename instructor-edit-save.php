<?php require_once("header.php"); ?>
<h1>Edit Instructor</h1>
<div class="alert alert-success" role="alert">
  Your instructor has been edited in the database!
</div>
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

$iName = $_POST['instructorName'];
$iID = $_POST['InstructorID'];
$cID = $_POST['courseID'];
$sID = $_POST['sectionID'];
$sql = "INSERT into Insructor (instructorName, instructorID, courseID, sectionID) value (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sis", $iName, $iID, $cID, $sID);
    $stmt->execute();
?>
<a href="instructor.php" class="btn btn-primary">Go back</a>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
