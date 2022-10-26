<?php require_once("header.php"); ?>
<h1>Instructors</h1>
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "insert into instructor (instructorID, instructorName, courseID, sectionID) value (?,?,?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("sisi", $_POST['iID'], $_POST['iName'], $_POST['cID'], $_POST['seID']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Instructor added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update instructor set instructorName=?, instructorID=?, courseID=?, sectionID=? where instructorID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("sisii", $_POST['iID'], $_POST['iName'], $_POST['cID'], $_POST['seID'], $_POST['iID']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Instructor edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from instructor where instructorID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['iID']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Instructor deleted.</div>';
      break;
  }
}
?>         
<?php
$sql = "SELECT instructorID, instructorName, courseID, sectionID FROM instructor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
            <td><?=$row["instructorID"]?></td>
            <td><?=$row["instructorName"]?></td>
            <td><?=$row["courseID"]?></td>
            <td><?=$row["sectionID"]?></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editInstructor<?=$row["instructorID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editInstructor<?=$row["instructorID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInstructor<?=$row["instructorID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editInstructor<?=$row["instructorID"]?>Label">Edit Instructor</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editInstructor<?=$row["instructorID"]?>Name" class="form-label">Instructor Name</label>
                          <input type="text" class="form-control" id="editInstructor<?=$row["instructorID"]?>Name" aria-describedby="editInstructor<?=$row["instructorID"]?>Help" name="iName" value="<?=$row['instructorName']?>">
                          <div id="editInstructor<?=$row["instructorID"]?>Help" class="form-text">Enter the Instructor's name.</div>                          
                          <label for="courseID" class="form-label">course ID</label>
                          <input type="text" class="form-control" id="cID" aria-describedby="nameHelp" name="cID" value="<?=$row['courseID']?>">
                          <div id="nameHelp" class="form-text">Enter the course ID</div>
                          <label for="sectionID" class="form-label">Section ID</label>
                          <input type="text" class="form-control" id="seID" aria-describedby="nameHelp" name="seID" value="<?=$row['sectionID']?>">
                          <div id="nameHelp" class="form-text">Enter the section ID</div>
                        </div>
                        <input type="hidden" name="iID" value="<?=$row['instructorID']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <input type="submit" class="btn btn-primary" value="Submit">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <form method="post" action="">
                <input type="hidden" name="iID" value="<?=$row["instructorID"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
              </form>
            </td>
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
      <br />
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomer">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addInstructor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addInstructorLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addInstructorLabel">Add Instructor</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="instructorName" class="form-label">Instructor Name</label>
                  <input type="text" class="form-control" id="iName" aria-describedby="nameHelp" name="iName">
                  <div id="nameHelp" class="form-text">Enter the Instructor's name.</div>
                   <label for="instructorID" class="form-label">Instructor ID</label>
                   <input type="text" class="form-control" id="iID" aria-describedby="nameHelp" name="iID">
                   <div id="nameHelp" class="form-text">Enter the Instructor's ID</div>
                          <label for="courseID" class="form-label">course ID</label>
                          <input type="text" class="form-control" id="cID" aria-describedby="nameHelp" name="cID" value="<?=$row['courseID']?>">
                          <div id="nameHelp" class="form-text">Enter the course ID</div>
                          <label for="sectionID" class="form-label">Section ID</label>
                          <input type="text" class="form-control" id="seID" aria-describedby="nameHelp" name="seID" value="<?=$row['sectionID']?>">
                          <div id="nameHelp" class="form-text">Enter the section ID</div>
                </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
