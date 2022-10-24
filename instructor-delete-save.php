<?php require_once("header.php"); ?>
<h1>Delete instructor</h1>
<div class="alert alert-success" role="alert">
  Your instructor has been deleted from the database!
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

$sql = "DELETE from Instructor where instructorID=?";
    $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $_POST['iID']);
    $stmt->execute();
?>
<a href="instructor.php" class="btn btn-primary">Go back</a>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
