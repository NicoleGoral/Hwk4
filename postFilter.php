<?php require_once("header.php"); ?>
    <h1>Courses</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Course ID</th>
      <th>Prefix</th>
      <th>Number</th>
      <th>Description</th>
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
$prefix = $_POST["PrefixClass"];
//echo $iid;
$sql = "select courseID, coursePrefix, courseNumber, courseDescription from course WHERE coursePrefix like '" . $prefix . "'";
//echo $sql;
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["courseID"]?></td>
    <td><?=$row["coursePrefix"]?></td>
    <td><?=$row["courseNumber"]?></td>
    <td><?=$row["courseDescription"]?></td>
  </tr>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
  </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
